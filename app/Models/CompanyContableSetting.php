<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App;
use Illuminate\Support\Facades\Config;

class CompanyContableSetting extends Model
{
    use HasFactory;

    protected $guarded = [];

    public $timestamps = false ;

    protected $connection;

    public function changetable( string $name)
    {
      
        $this->setTable('contable_settings');
    }

    public function newInstance($attributes = [], $exists = false)
    {
        // Overridden in order to allow for late table binding.

        $model = parent::newInstance($attributes, $exists);
        $model->setTable($this->table);
        $model->setConnection($this->connection);

        return $model;
    }

    public function addConection(String $name){
        $config = App::make('config');        
        $connections = $config->get('database.connections');       
        $defaultConnection = $connections[$config->get('database.default')];
        $newConnection = $defaultConnection;      
        $newConnection['database'] = $name.'_db';  

       Config::set("database.connections.".$name.'_mysql',$newConnection );

       $this->setConnection($name.'_mysql');
    }
}
