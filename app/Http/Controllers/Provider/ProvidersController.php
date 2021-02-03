<?php

namespace App\Http\Controllers\Provider;

use App\Http\Controllers\Controller;
use App\Models\Provider;
use Illuminate\Support\Facades\Redirect;//objeto redirect
use Illuminate\Http\Request;
use Inertia\Inertia; // esto se tiene que declarar para mandar a llamar a la vista
use App\Models\Chart_of_account;
use App\Models\User;
use App\Models\Company;
use App\Models\Country;
use App\Models\ProviderFoil;
use Auth;
class ProvidersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {       
        $company = Company::find(Auth::user()->current_company);

        return Inertia::render('Provider/Index',[
            'providers'     => $company->getProviders($company),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $countries = Country::get();

        return Inertia::render('Provider/Create',[
            'countries'     => $countries
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
       
        $company = Company::find(Auth::user()->current_company);

        $instance = new Provider();
        $instance->changeTable($company->model_name);
        $instance->addConnection($company->model_name);

        $instance->code               = $request->code;
        $instance->nit                =  $request->nit;
        $instance->ncr                =  $request->ncr; 
        $instance->name               = $request->name;
        $instance->address            = $request->email; 
        $instance->phone              = $request->phone; 
        $instance->business_size      = $request->type;
        $instance->contributor        = $request->contributor;
        $instance->active_foil        = 0;
        $instance->detail_account     = '0'; 
        $instance->business_activitie = $request->business_activitie;        
        $instance->country_id         = $request->country_id;
        $instance->save(); 

        if($request->contributor){
            $foil = new ProviderFoil();
            $foil->addConnection($company->model_name);
            $foil->changeTable($company->model_name);
            
            $foil->provider_id            = $instance->id;
            $foil->foil                   = $request->foil;
            $foil->status                 = 'active';
            $foil->save(); 

            $instance->update([
                'active_foil'              => $foil->id
            ]);
        }
        
        return Redirect::route('providers.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Provider  $provider
     * @return \Illuminate\Http\Response
     */
    public function show($providerId)
    {
       

        return Inertia::render('Provider/Show',[
            'provider' => $provider,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Provider  $provider
     * @return \Illuminate\Http\Response
     */
    public function edit($providerId)
    {
        $company = Company::find(Auth::user()->current_company);

        $instance = new Provider();
        $instance->changeTable($company->model_name);
        $instance->addConnection($company->model_name);

        $provider = $instance->find($providerId);

        return Inertia::render('Provider/Edit',[ //renderizar la vista edir de providers
            'provider' => $provider
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Provider  $provider
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Provider $provider)
    {
        $provider->update([
            'code' => $request->code,
            'nit' => $request->nit,
            'ncr'=> $request->ncr,
            'name' => $request->name,
            'address'=> $request->email,//request es lo que se trae del formulario
            'phone' => $request->phone,
            'business_activitie' => $request->business_activitie,
            'contact' => $request->contact,
            'country_id'=> '1'
        ]);

        return Redirect::route('providers.index',$provider->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Provider  $provider
     * @return \Illuminate\Http\Response
     */
    public function destroy(Provider $provider)
    {  // return "Elimando proveedor";
        
        $provider->delete();
        return Redirect::route('providers.index');
    }
}
