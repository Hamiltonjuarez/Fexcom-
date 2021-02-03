<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Base_model;
use Illuminate\Support\Facades\Config;
use App;



class Provider extends Model
{
    protected $table = null;

    protected $guarded = [];

    public $timestamps = false ;

    protected $connection;


    public function changeTable( string $name)
    {
      
        $this->setTable('providers');
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

    public function country()// if you use a new connection the model of the relationship that eloquent is going to search would be the same new connection 
    {
        return $this->belongsTo('App\Models\Country', 'country_id', 'id');
    }

    public function activeFoil()
    {
        return $this->belongsTo('App\Models\ProviderFoil', 'active_foil', 'id');
    }
}
