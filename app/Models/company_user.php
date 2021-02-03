<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class company_user extends Model
{
    use HasFactory;

    protected $guarded = [];


    public function companies()
    {
        return $this->belongsToMany('App\Role', 'role_user_table', 'user_id', 'role_id');
    }
}
