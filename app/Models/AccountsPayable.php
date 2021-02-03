<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Config;
use Auth;
use App;


class AccountsPayable extends Model
{
    use HasFactory;

    protected $table = null;

    protected $guarded = [];

    public $timestamps = false ;

    protected $connection;


    public function changeTable( string $name)
    {
      
        $this->setTable('accounts_payables');
    }

    public function newInstance($attributes = [], $exists = false)
    {
        // Overridden in order to allow for late table binding.

        $model = parent::newInstance($attributes, $exists);
        $model->setTable($this->table);
        $model->setConnection($this->connection);
        return $model;
    }

    public function addConnection(String $name){
        $config = App::make('config');        
        $connections = $config->get('database.connections');       
        $defaultConnection = $connections[$config->get('database.default')];
        $newConnection = $defaultConnection;      
        $newConnection['database'] = $name.'_db';  

       Config::set("database.connections.".$name.'_mysql',$newConnection );

       $this->setConnection($name.'_mysql');
    }

    public function getSupplier($supplier_id){
        $company = Company::find(Auth::user()->current_company);

        $provider = new Provider();
        $provider->changeTable($company->model_name);
        $provider->addConnection($company->model_name);

        return $provider->find($supplier_id);
    }

    public function getType($type_id){
        $company = Company::find(Auth::user()->current_company);

        $type = new InvoiceType();
        $type->addConnection($company->model_name);
        $type->changeTable($company->model_name);

        return $type->find($type_id);
    }

    public function ScopeFilter($query, $filters)
    {
        $query->when($filters['search'] ?? null, function($query, $search){
            $query->where('provider_id', '=', $search);

            });
    }
}
