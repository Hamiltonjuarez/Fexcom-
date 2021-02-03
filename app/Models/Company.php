<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Company extends Model
{
    use HasFactory;
    protected $guarded = [];//funciona para llenar todos los campos de esa tabla al dejarla en blanco
    //protected $filable = [];//funciona para llenar los campos de la bd que uno quiera

    public function operators($company)
    {
      return  $operators = User::Join('user_company_rols','user_id','users.id')
              ->Join('companies','companies.id','company_id')
              ->Join('roles','roles.id','users.role_id')
              ->where('companies.id',$company->id)
              ->select('users.*','roles.name as rname')->get();
    }

    public function chart_of_account()
    {
       // return $this->belongsToMany('App\Models\Chart_of_accounts_detail', 'chart_of_accounts', 'chart_of_accounts_id', 'id'); 
        return $this->belongsToMany('App\Models\Chart_of_accounts_detail', 'chart_of_accounts', 'chart_accounts_id', 'chart_of_accounts_id');    
    }

    public function getRoles()
    {
        return $this->belongsToMany('App\Models\Rol', 'user_company_rols', 'company_id', 'id');
        
    }


    public function roles()
    {
        return $this->belongsToMany('App\Models\Rol', 'user_company_rols', 'company_id', 'role_id');
    }

    //return all providers of a specific company
    public function getProviders($company){ 
        $providers = new Provider();
        $providers->changeTable($company->model_name);
        $providers->addConnection($company->model_name);

        return $providers->get()->load('activeFoil');
    }
  
}
