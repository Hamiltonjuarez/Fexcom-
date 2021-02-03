<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Base_model extends Eloquent
{

    public static function year($year){
        $instance = new static;
        return $instance->newQuery();
    }



    protected $year = null;

    public function setYear($year){
        $this->year = $year;
        if($year != null){
            $this->table = 'gamedata_'.$year.'_'.$this->getTable(); 
          }
    }
}
