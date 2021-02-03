<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Inertia\Inertia;
use App\Models\UserCompanyRol;
use App\Models\Company;
use Illuminate\Support\Facades\Redirect;
use App\Models\Rol;
use Auth;
use Illuminate\Support\Str;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Inertia::share('company', function() {
           $company = Company::find(Auth::user()->current_company);
           return $company;
        });
        Inertia::share('menu', function() {
            if(Auth::check()){

                if(Auth::user()->role->name != 'admon' && Auth::user()->role->name != 'manager'){
                    $rol = Rol::whereHas('companies', function($query) {
                        $query->where('companies.id', Auth::user()->current_company);
                    })->first();
                    /*  UserCompanyRol::Join('roles','user_company_rols.role_id','roles.id')
                    ->where('company_id', Auth::user()->current_company)->where('user_id',Auth::user()->id)->first(); */
                }else{
                    $rol = Auth::user()->role;
                }

               if($rol != null){
                return collect(menu($rol->name,'_json'))->transform(function($menu){
                    return [
                        'title'     => $menu->title,
                        'route'     => $menu->route,
                        'icon'      => $menu->icon_class,
                        'active'    =>  collect(Str::of($menu->route)->explode('.'))->first().'*',
                        'children' =>  collect($menu->children)->transform(function($child){
                            return [
                                'title'     => $child->title,
                                'route'     => $child->route,
                                'icon'      => $child->icon_class,
                                'active'    =>  collect(Str::of($child->route)->explode('.'))->first().'*' 
                            ];
                        })      
                    ];
                });
               }
            }else{
                return Redirect::route('login');
            }
        }); 
    }
}
