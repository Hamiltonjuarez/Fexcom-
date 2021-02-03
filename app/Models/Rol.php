<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rol extends Model
{
    use HasFactory;

    public function companies()
    {
        return $this->belongsToMany('App\Models\Company', 'user_company_rols', 'role_id', 'company_id');
    }

    protected $table = 'Roles';
}
