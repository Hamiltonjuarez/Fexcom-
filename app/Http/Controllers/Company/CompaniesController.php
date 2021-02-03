<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\File;
use App\Models\Chart_of_account;
use App\Models\Chart_of_accounts_detail;
use Maatwebsite\Excel\Concerns\ToCollection;
use App\Models\CompanyModule;
use App\Models\Module;
use App\Models\Provider_company; 
use App\Classes\NewCompany;
use App\Models\UserCompanyRol;
use App\Models\Provider;
use App\Models\Account_type;
use App\Imports\ChartAccountsImport;
use App\Models\LegalRepresentative;
use App\Models\CompanyRepresentative;
use App\Models\CompanyContableSetting;
use App\Models\Company;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\User;
use App\Models\Rol;
use App\Models\Country;
use Auth;
use Excel;
use App;
use App\Models\company_user;
use Illuminate\Support\Str;
use Carbon\Carbon;
use App\Models\CompanyAccountType;
use App\Models\InvoiceType;


class CompaniesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      
        return Inertia::render('Company/Index',[
            'companies'         => Auth::user()->companies,
           
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = new User();
        $roles = $roles->getRoles();        
        $accountants = User::get()->load('rol')->where('rol.name', 'accountant');       
        $modules = Module::get();              
        $representatives = LegalRepresentative::get();

        $countries = Country::get();
        
        return Inertia::render('Company/Create',[
            'accountants'       => $accountants,
            'representatives'   => $representatives,
            'modules'           => $modules,
            'roles'             => $roles,
            'countries'         => $countries
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {  
       // dd($request);
       $noSpaces = str_replace(' ', '', $request->name);
       $noDots = str_replace('.', '', $noSpaces); 

       $company = Company::create([
           'Name'       => $request->name,          
           'nit'        => $request->nit,
           'ncr'        => $request->ncr,
           'model_name' => $noDots,
           'phone'      => $request->phone,
           'business_activitie'     => $request->comercialActivity,
           'business_name'          => $request->comercialName,  
           'country_id'             => $request->country_id,
           'address'                => $request->address,
           'status'                 => 'req_modules'    
       ]);
        
       return response()->json(
         $company
       );

       if(count($request->modules) > 0 ){
           foreach ($request->modules as $module) {
               $companyModules = CompanyModule::create([
                   'company_id'     => $company->id,
                   'module_id'      => $module
               ]);
           }
       }

       if($request->representantive_id != null){          
           $representative = CompanyRepresentative::create([
               'company_id'     => $company->id,
               'representative_id'  => $request->representantive_id    
           ]);
       }else if($request->repname != null){ 
            $representative = LegalRepresentative::create([
                'name'      => $request->repname,
                'nit'       => $request->repnit,
                'dui'       => $request->repdui,
                'company_position'      => $request->reppos
            ]);
            $representative = CompanyRepresentative::create([
                'company_id'     => $company->id,
                'representative_id'  => $representative->id   
            ]);
       }

       if(count($request->operators) > 0){        
         foreach ($request->operators as $operator) {
             UserCompanyRol::create([
                'user_id'       => $operator['accountantId'],
                'role_id'        => $operator['rolId'],
                'company_id'    => $company->id
             ]);
         }  
       }

       $newCompany = new NewCompany();
       $newCompany->createProvidersTable($company);
       $newCompany->createCompanyTypesTable($company); 
       $newCompany->createContableSettingsTable($company);
       $newCompany->createChartOfAccountsTable($company);
       $newCompany->createChartOfAccountsDetailsTable($company);

     

    /*    if(File::exists($request->excel)){
            $chart_accounts = Chart_of_account::create([
                'type'      => 'estandar',                
            ]);         
            
            Excel::import(new ChartAccountsImport($chart_id), $request->excel);

            $company->update([
                'chart_of_accounts_id' => $chart_accounts->id
            ]);
      }else if($request->counter > 0){      
            $i = 0;      
           $chart_accounts = Chart_of_account::create([
               'type'   => 'estandar'
           ]);  

           while ($i < $request->counter) {
                 $chart_details = Chart_of_accounts_detail::create([
                    'name'                  => $request->names[$i],
                    'chart_accounts_id'     => $chart_accounts->id,
                    'account_type_id'       => $request->types[$i],
                    'account_code'          => $request->codes[$i],
                    'account_balance'       => $request->balances[$i],
                    'father_account_code'   => $request->fathers[$i],
                    'detail_account'        => $request->details[$i],
                ]);
                $i++;
          }

          $company->update([
            'chart_of_accounts_id' => $chart_accounts->id
        ]);        
      } */


       return Redirect::route('companies.index');
    }

    public function storeCompany(Request $request){
       
        $noSpaces = str_replace(' ', '', $request->name);
        $noDots = str_replace('.', '', $noSpaces); 
        $modelName = strtolower($noDots);
 
        $company = Company::create([
            'Name'       => $request->name,          
            'nit'        => $request->nit,
            'ncr'        => $request->ncr,
            'model_name' => $modelName,
            'phone'      => $request->phone,
            'business_activitie'     => $request->comercialActivity,
            'business_name'          => $request->comercialName,  
            'country_id'             => $request->country_id,
            'address'                => $request->address,
            'status'                 => 'req_modules'    
        ]);

        $instance = new NewCompany();
        $instance->createCompanyDataBase($company);
        //$instance->createContableSettingsTable($company);
   
         
        return response()->json(
          $company
        );
    }
    public function storeModules(Request $request){
        //dd($request['params']['company_id']);
       // dd($request->modules);
       $company = Company::find($request['params']['company_id']);            
      foreach ($request['params']['modules'] as $module) {
        $cModules = CompanyModule::create([
            'module_id'      => $module,
            'company_id'     => $company->id
        ]);
      }

      $company->update([
          'status'      => 'req_representative'
      ]);

      return response()->json(
        $company
      );
    }

    public function storeRepresentative(Request $request){ 

        $company = Company::find($request['params']['company_id']);

        if($request['params']['representative']['repId'] == null){
            $legal = LegalRepresentative::create([
                'name'      => $request['params']['representative']['name'],
                'nit'       => $request['params']['representative']['nit'],
                'dui'       => $request['params']['representative']['dui'],
                'company_position'      => $request['params']['representative']['position'],
            ]);
            $representative = CompanyRepresentative::create([
                'company_id'    => $company->id,
                'representative_id' => $legal->id,
            ]);
        }else{
            $representative = CompanyRepresentative::create([
                'company_id'    => $company->id,
                'representative_id' => $request['params']['representative']['repId'],
            ]);
        }
        
        $company->update([
            'status'    => 'incomplete'
        ]);

        return response()->json(
            $company
          );
         
    }

    public function storeAccountants(Request $request, $company_id){
            $company = Company::find($company_id);
            if(count($request->operators) > 0){        
                foreach ($request->operators as $operator) {
                    UserCompanyRol::create([
                        'user_id'       => $operator['accountantId'],
                        'role_id'        => $operator['rolId'],
                        'company_id'    => $company->id
                    ]);
                }  
            }

            $company->update([
                'status'        => 'incomplete'
            ]);

            return Redirect::route('companies.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function show(Company $company)
    {       
        $legalRep = LegalRepresentative::Join('company_representatives','company_representatives.representative_id','legal_representatives.id')
        ->where('company_representatives.company_id',$company->id)
        ->select('legal_representatives.name','legal_representatives.dui')->first();  

        /* $operators = new User();
        $operators->getUsers($company); */
    
       return Inertia::render('Company/Show',[
           'company'       => $company,  
           'legalRep'     => $legalRep      
       ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function edit(Company $company)
    {
        $accountans = User::get();
        return Inertia::render('Company/Edit',[
            'company' => $company,
            'accountants' => $accountans
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Company $company)
    {
        //dd($request);
        $company->update([
            'Name' => $request->name,
            'business_name' => $request->comercialName,
            'phone' => $request->phone,
            'business_activitie' => $request->comercialActivity,  
        ]);
        
        if($request->accountant_id){
        $company_user = company_user::create([
            'user_id' => $request->accountant_id,
            'company_id' => $company->id,
        ]);
        }
        return Redirect::route('companies.show',$company->id);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function destroy(Company $company)
    {
        $companyModules = CompanyModule::where('company_id',$company->id)->get();
        $representatives = CompanyRepresentative::where('company_id',$company->id)->get();
        $userCompanyRol  = userCompanyRol::where('company_id',$company->id)->get();
        
        foreach ($companyModules as $module) {
            $module->delete();
        }

        foreach ($representatives as $representative) {
            $representative->delete();
        }

        foreach ($userCompanyRol as $user) {
            $user->delete();
        }
        
        $company->delete();
        
        return response()->json(
            'ok'
       );

        return Redirect::route('companies.index');
    }

    
    public function addbusinessaccount(Request $request, $userId)
    {      
            $companies = User::find($userId);       
            $company_user = company_user::create([
            'user_id'       => $user->id,
            'company_id'    => $request->newCompany
         ]);

        return Redirect::route('companies.show',$companies->id);
    }

    public function addmanual($company_id){

        $company = Company::find($company_id);
        $types = Account_type::get();

        $auditors = User::get();     

        return Inertia::render('Company/CompanySetup',[
            'types'       => $types,
            'auditors'    => $auditors,
            'company'     => $company,
        ]);
    }

    public function addProvider($company_id){
        $company = Company::find($company_id);
        $providers = Provider::get();
        
        return Inertia::render('Company/AddProvider',[
            'company'       => $company,
            'providers'     => $providers
        ]);
    }

    public function storeProvider(Request $request){
        

        $provider_company = Provider_company::create([
            'company_id'      => $request->company_id,
            'provider_id'     => $request->provider_id,
            'taxt_credit_date'  => $request->picker,
            'payment_terms'     => $request->lapse
        ]);
    }

    public function operators ($company_id){ //return a list of company operators 

       $company = Company::find($company_id);     
          
       return Inertia::render('Company/operatorsIndex',[
           'company'        => $company,
           'selOperators'   => $company->operators($company),           
       ]);
    }

    public function addOperator($company_id){ //return view to insert operator to specified company 

        $company = Company::find($company_id);
        $operators = User::get()->load('rol')->whereIn('rol.name',['accountant','auditor']); //TODO check that the user is not already on company 
        $roles = Rol::whereIn('name',['accountant','auditor'])->get();

        return Inertia::render('Company/AddOperator',[
            'company'       => $company,
            'operators'     => $operators,
            'roles'         => $roles
        ]);
    }

    public function saveOperators($company_id, Request $request){

        $company = Company::find($company_id);        
            if(count($request->operators) > 0){        
                foreach ($request->operators as $operator) {
                    UserCompanyRol::create([
                        'user_id'       => $operator['accountantId'],
                        'role_id'        => $operator['rolId'],
                        'company_id'    => $company->id
                    ]);
                }  
            }

        return Redirect::route('companies.show',$company_id);
    }



    public function savesettings($company_id, Request $request){
      
        $date = Carbon::parse($request->contability_date)->format('Y-m-d h:m:s');    

       $company = Company::find($company_id);      

       $settings = new CompanyContableSetting();
       $settings->addConection($company->model_name);
       $settings->changetable($company->model_name);  

       $settings->auditor_id    = $request->auditor['id'];
       $settings->mayor_digits  = $request->digits_number;
       $settings->start_date    = $date;
       $settings->save();      

        foreach ($request->account_types as $type) { 
            $types = new Account_type();
            $types->addConnection($company->model_name);
            $types->changetable($company->model_name);

            $types->name = $type['name'];
            $types->position = $type['position'];
            $types->save();         
        }      

        $company->update([
            'status'     => 'addacounts'
        ]);

        return Redirect::route('companies.catalogue',$company_id);
    }

    public function addCatalogue($company_id){

        $company = Company::find($company_id);
        $types = new Account_type(); 
        $types->changetable($company->model_name);
        $types->addConnection($company->model_name);                      

        return Inertia::render("Company/AddCatalogue",[
            'company'   => $company,
            'types'     => $types->get(), 
        ]);
    }

    public function saveCatalogue(Request $request, $company_id){

        
        $company = Company::find($company_id);

        $chart_accounts = new Chart_of_account(); 
        $chart_accounts->changeTable($company->model_name);
        $chart_accounts->addConnection($company->model_name);

        $chart_accounts->type = 'estandar'; 
        $chart_accounts->save();
        
       if( File::exists($request->excel)){                    
        
            Excel::import(new ChartAccountsImport($chart_accounts->id, $company), $request->excel);
            
       }else{

            foreach ($request->accounts as $account) {
                $balanceType = "";
                        switch ($account['type']['name']) {
                            case 'ACTIVO':
                                $balanceType = "debit";
                                break;
                            case 'PASIVO':
                                $balanceType = "credit";
                                break;
                            case 'GASTOS':
                                $balanceType = "debit";
                                break;
                            case 'COSTOS':
                                $balanceType = "debit";
                                break;
                            case 'PATRIMONIO':
                                $balanceType = "credit";
                                break;
                            
                            case 'INGRESOS':
                                $balanceType = "credit";
                                break;
                            case 'CUENTA DE MEMORANDO DEUDORAS':
                                $balanceType = "debit";
                                break;
                            case 'CUENTA DE MEMORANDO ACREEDORAS':
                                $balanceType = "credit";
                                break;    
                        }
                  

                $chart_detail = new Chart_of_accounts_detail();
                $chart_detail->changeTable($company->model_name);
                $chart_detail->addConnection($company->model_name);

                $chart_detail->chart_accounts_id = $chart_accounts->id;
                $chart_detail->account_type_id = $account['type']['position'];
                $chart_detail->account_code = $account['code'];
                $chart_detail->name = $account['name'];
                $chart_detail->account_balance = 0;
                $chart_detail->balance_type = $balanceType;
                $chart_detail->father_account_code = $account['father'];
                $chart_detail->detail_account = $account['detail'];
                $chart_detail->save();  

            }
       }

       $company->update([        
        'status'        => 'operational'
    ]);

    return Redirect::route('companies.show',$company->id);

    }

    public function showCatalogue($company_id){

        $company = Company::find($company_id);

        $chart = new Chart_of_account();
        $chart->changetable($company->model_name);
        $chart->addConnection($company->model_name);

        $chart = $chart->orderBy('id','DESC')->first();

        $accountsObjet = new Chart_of_accounts_detail();
        $accountsObjet->changetable($company->model_name);
        $accountsObjet->addConnection($company->model_name);

        $accounts = $accountsObjet->where('chart_accounts_id',$chart->id)->orderBy('account_code','ASC')->get();

        $types = new Account_type();
        $types->changetable($company->model_name);
        $types->addConnection($company->model_name);

        $types = $types->get();
        
        
        return Inertia::render("Company/ShowCatalogue",[
            'company'           =>      $company,
            'accounts'          =>      $accounts                                        
                                        ->transform(function($query){
                                            return [
                                                'id'            => $query->id,                                            
                                                'name'          => $query->name,
                                                'code'          => $query->account_code,
                                                'type'          => $query->account_type_id,
                                                'balanceType'    => $query->balance_type,
                                                'balance'        => $query->account_balance,
                                                'father'         => $query->father_account_code,
                                                'detail'         => $query->detail_account,
                                                
                                            ];
                                        }),
            'types'             =>      $types
        ]);
    }

    //returning suppliers depending of selected company 

    public function companySuppliers($company_id)
    {
        $company = Company::find($company_id);

        return Inertia::render('Provider/Index',[
            'providers'    =>   $company->getProviders($company),
        ]);
        
    }

}
