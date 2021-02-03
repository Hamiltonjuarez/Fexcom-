<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Provider;
use App\Models\User;
use App\Models\Company;
use App\Models\InvoiceType;
use App\Models\AccountsPayable;
use App\Models\PayableDetail;
use App\Models\Country;
use Illuminate\Support\Facades\Redirect;
use App\Models\ProviderFoil;
use Carbon\Carbon;
use Auth;

class PurchasesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
                
        $company = Company::find(Auth::user()->current_company);

        $purchases = new AccountsPayable();
        $purchases->addConnection($company->model_name);
        $purchases->changeTable($company->model_name);

        $providers = new Provider();
        $providers->addConnection($company->model_name);
        $providers->changeTable($company->model_name);

        $countries = Country::get(); 
       
       /*  $purchases->Join('providers','providers.id','=','accounts_payables.provider_id')->get();
        return $purchases;  */

        
        return Inertia::render("Purchase/Index",[
            'purchases'    =>    $purchases->orderBy('id','DESC')
                                    ->filter($request->only('search'))->paginate(5)
                                    ->transform(function($query){
                                    return [
                                        'id'            => $query->id,                                            
                                        'supplier'      => $query->getSupplier($query->provider_id), 
                                        'type'          => $query->getType($query->purchase_type), 
                                        'date'          => $query->date,
                                        'foil'          => $query->foil,
                                        'terms'         => $query->payment_terms,
                                        'dNumber'       => $query->doc_number,
                                        'iva'           => $query->perceived_iva,
                                        'exemptP'       => $query->exempt_purchases,
                                        'taxedP'        => $query->taxed_purchases,
                                        'total'         => $query->total                
                                        
                                    ];
                                }),
            'countries'    =>    $countries,                   
            'providers'    =>   $providers->get(),   
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $company = Company::find(Auth::user()->current_company);
        $purchase = new AccountsPayable();
        $purchase->changeTable($company->model_name);
        $purchase->addConnection($company->model_name);

        $purchas = $purchase->where('created_by',Auth::user()->id)->where('status','req_products')->first();
        

        return Inertia::render("Purchase/Create",[
            'purchase'     =>   $purchas,
            'supplier'      =>  $purchas->getSupplier($purchas->provider_id),
            'docType'      =>   $purchas->getType($purchas->purchase_type),
        ]);
    }

    public function purchaseLocation($location, $supplier_id){//user is requested to be logged on a company to access 

        $company = Company::find(Auth::user()->current_company);

        $provider = new Provider(); 
        $provider->changeTable($company->model_name);
        $provider->addConnection($company->model_name);

        $invoices = new InvoiceType();
        $invoices->changeTable($company->model_name);
        $invoices->addConnection($company->model_name);

       if($location == 'local'){   
            return Inertia::render('Purchase/LocalPurchases',[
                'supplier'     =>  $provider->find($supplier_id)->load('activeFoil'),
                'invoices'      =>  $invoices->where('name','!=','Importacion')->get()
            ]);
       }else{
            return Inertia::render('Purchase/ForeignPurchases',[
                'supplier'     =>  $provider->find($supplier_id)->load('activeFoil'),
                'invoices'      =>  $invoices->where('name','=','Importacion')->first()
            ]);
       }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        return Redirect::route('purchases.index');
    }

    //store local purchase 
    public function saveLocal(Request $request){ 
        
        $thidRetention = 0;  
        $thirdTotal     = 0;  
        $totalToEvaluate = 0; 
        $advancePayment = 0; 

        $company = Company::find(Auth::user()->current_company);

         $purchase = new AccountsPayable();
         $purchase->addConnection($company->model_name);
         $purchase->changeTable($company->model_name);

         $provider = new Provider(); 
         $provider->changeTable($company->model_name);
         $provider->addConnection($company->model_name);
         
         $id = $request['settings']['supplier']['id'];       
         $provider = $provider->find($id);
        
        if($request['settings']['supplier']['contributor']){
            if($request['settings']['supplier']['active_foil']['foil'] != $request['settings']['foil']){

                $foil = new ProviderFoil();
                $foil->changeTable($company->model_name);
                $foil->addConnection($company->model_name);
                $foil->provider_id      = $provider->id;
                $foil->foil             = $request['settings']['foil'];
                $foil->status           = 'active';
                $foil->save();
    
                $oldFoil = new ProviderFoil();
                $oldFoil->changeTable($company->model_name);
                $oldFoil->addConnection($company->model_name);
                $oldFoil->find($request['settings']['supplier']['active_foil']);
                $oldFoil->update([
                    'status'    =>  'inactive',
                ]);
    
                 $provider->update([
                    'active_foil'       => $foil->id
                 ]);
             }
        }
         
         $purchase->provider_id = $provider->id;
         $purchase->purchase_type = $request['settings']['docType']['id'];
         $purchase->date = $request['settings']['date'];
         $purchase->foil = $request['settings']['foil'];
         $purchase->payment_terms = $request['settings']['terms'];
         $purchase->doc_number =  $request['settings']['docNumber'];
         $purchase->concept = $request['settings']['docConcept'];
         $purchase->status = 'loaded';
         $purchase->created_by = Auth::user()->id;   
         $purchase->perceived_iva = 0; //references iva added to the products when a product applies to iva. 
         $purchase->exempt_purchases = 0;
         $purchase->taxed_purchases =  0;
         $purchase->total =  0;
         $purchase->other_taxes = 0; 
         $purchase->advance_payment = 0; 
         $purchase->retained_one = 0; 
         $purchase->retained_ten = 0; 
         $purchase->excluded_subjets_total = 0;
         $purchase->third_parties_retention = 0;         
         $purchase->save();

         foreach ($request['products'] as $product) {
            $detail = new PayableDetail();
            $detail->addConnection($company->model_name);
            $detail->changeTable($company->model_name);

            $detail->payable_id = $purchase->id;
            $detail->description = $product['description'];
            $detail->quantity = $product['quantity'];
            $detail->unitary_price = $product['uPrice'];
            $detail->total = $product['total'];
            $detail->iva = $product['iva'];
            $detail->save();
         }
         //retention and taxes,
         if($request['settings']['purchaseType'] == 'adelanto' || $request['settings']['purchaseType'] == 'servicios'){
             $totalToEvaluate = $request['settings']['total'];
         }else{
            $totalToEvaluate = $request['purchaseTotal'];
         }
         
         $totalonePerception = $totalToEvaluate * $request['settings']['oneRetention'];
         $totalonePerception  = round($totalonePerception, 2);   
         
         $totalTenPerception = $totalToEvaluate * $request['settings']['tenRetention'];
         $totalTenPerception  = round($totalTenPerception, 2); 
         
         $otherTaxes = $totalToEvaluate * $request['settings']['otherTaxes'];
         $otherTaxes = round($otherTaxes, 2);

         $total = $totalToEvaluate + $totalonePerception; 
         $total = $total + $otherTaxes; 
         $total = $total - $totalTenPerception;

        //okk dd($total);

         $totalIva = $request['totalIva'];
         $iva = round($totalIva * 0.13, 2);

        
         if($request['settings']['purchaseType'] == 'adelanto'){
             $advancePayment = $total; 
         } 
         
         if(!$provider->contributor){
             $thidRetention = $totalTenPerception;
             $thirdTotal = $request['settings']['total']; 
         }

        //okkk dd($total);

         $purchase->update([
            'perceived_iva'        => $iva,
            'exempt_purchases'     => $request['totalNoIva'],
            'taxed_purchases'      => $request['totalIva'],
            'advance_payment'      => $advancePayment,
            'retained_one'         => $totalonePerception,
            'retained_ten'         => $totalTenPerception, 
            'other_taxes'          => $otherTaxes,
            'excluded_subjets_total' => $thirdTotal, 
            'third_parties_retention' => $thidRetention, 
            'total'                => $total
         ]);
         return Redirect::route('purchases.index');

         
    }    

    public function saveForeign(Request $request){

       // dd($request);
       
        $company = Company::find(Auth::user()->current_company);

        $purchase = new AccountsPayable();
        $purchase->addConnection($company->model_name);
        $purchase->changeTable($company->model_name);

        $provider = new Provider(); 
        $provider->changeTable($company->model_name);
        $provider->addConnection($company->model_name); 
        $provider = $provider->find($request['settings']['supplier']['id']);

        $importation = new Importation();
        $importation->addConnection($company->model_name);
        $importation->changeTable();

        $cifTotal = $request['purchaseTotal'] + $request['settings']['importRise'];
        $cifIva   = $cifTotal * 0.13;
        $cifIva   = round($cifIva ,2);
        
        $totalDai = 0;
        $daiIva = 0;
        foreach ($request['products'] as $product) {
            $totalDai = $product['dai'] + $totalDai;
        }
        $daiIva = $totalDai * 0.13;

        
        $totalLocalTaxes = 0; 
        $totalLocalExpenses = 0;
        //add iva 
        $localIva  = 0; 

        foreach ($request['taxes'] as $tax) {
            if($tax['type'] == 'tax'){
                $percent = $tax['amount'] * $cifTotal;
                if($tax['iva']){
                    $sumIva = $percent * 0.13;
                    $localIva = $localIva + $sumIva;
                }
                $totalLocalTaxes = $totalLocalTaxes + $percent;
            }else{
               if($tax['iva']){
                    $sumIva = $tax['amount'] * 0.13;
                    $localIva = $localIva + $sumIva;
               }
                $totalLocalExpenses = $tax['amount'] + $totalLocalExpenses;
            }
        }
       

        $importation->provider_id           = $provider->id;
        $importation->created_by            = Auth::user()->id;
        $importation->duca                  = $request['settings']['duca'];
        $importation->doc_number            = $request['settings']['docNumber'];
        $importation->doc_concept           = $request['settings']['docConcept'];
        $importation->country               = $request['settings']['country'];
        $importation->payment_terms         = $request['settings']['terms'];
        $importation->date                  = $request['settings']['date'];
        $importation->fob_total             = $request['purchaseTotal'];
        $importation->importation_expenses  = $request['settings']['importRise'];
        $importation->cif_total             = $cifTotal; 
        $importation->cif_iva               = $cifIva;
        $importation->dai_total             = $totalDai;
        $importation->dai_iva               = $daiIva; 
        $importation->other_local_taxes     = 0;
        $importation->other_local_expenses  = 0;
        $importation->other_local_total     = 0;
        $importation->ohter_local_iva       = 0;
        $importation->total                 = 0;
        $importation->iva_sumary            = 0;
        $importation->total_w_iva           = 0;
        $importation->save();        

        


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
