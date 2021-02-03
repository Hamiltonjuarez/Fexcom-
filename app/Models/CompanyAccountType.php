<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyAccountType extends Model
{
    use HasFactory;

    protected $guarded = [];


    public function getTypes($company_id){

      $types = CompanyAccountType::Join('account_types','account_types.id','company_account_types.account_type')
        ->where('company_id',$company_id)
        ->select('company_account_types.position','account_types.name','account_types.id')->get();  

        return $types;
    }
}
