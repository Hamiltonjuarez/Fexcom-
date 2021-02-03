<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;
use Auth;

class User extends \TCG\Voyager\Models\User
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    
    //Ingresar todos los datos al modelo 
    protected $guarded = [ ];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
    ];
   
   /*  public function companies()
    {   
        $companies = '';    
        if(Auth::user()->rol->name == 'admon'){
            $companies = Company::orderBy('created_at','DESC')->get();
        }else{
            $companies = Company::join('user_company_rols', 'company_id','companies.id')
            ->Join('users','users.id','user_id')
            ->Join('roles','roles.id','user_company_rols.role_id')
            ->where('users.id',Auth::user()->id)
            ->select('companies.*','roles.name as rol')->orderBy('created_at','DESC')->get();
        }        
        return $companies;
        
    } */

    /* public function client()
    {
        return $this->belongsTo('App\Models\client', 'client_id','id');
    } */

    public function rol()
    {
        return $this->belongsTo('App\Models\Rol', 'role_id', 'id');
    }

    public function getRoles(){
        if(Auth::user()->rol->name == 'admin'){
            return $roles = Rol::get();
        }
        if(Auth::user()->rol->name == 'admon'){
            return $roles = Rol::where('name','!=','admin')->get();
        }
        if(Auth::user()->rol->name == 'accountant'){
            return '';
        }
        
    }

    public function getCompaniesAttribute()
    {
        switch ($this->rol->name) {
            case 'admon': return Company::all();
            case 'accountant': return $this->companiesassigment;
        }

        /* $companies = '';
        if(Auth::user()->rol->name == 'admon'){
            $companies = Company::orderBy('created_at','DESC')->get();
        }else{
            $companies = Company::join('user_company_rols', 'company_id','companies.id')
            ->Join('users','users.id','user_id')
            ->Join('roles','roles.id','user_company_rols.role_id')
            ->where('users.id',Auth::user()->id)
            ->select('companies.*','roles.name as rol')->orderBy('created_at','DESC')->get();
        }
        return $companies; */
        
    }

    public function companiesassigment()
    {
        return $this->belongsToMany('App\Models\Company', 'user_company_rols', 'user_id', 'company_id');
    }

   /*  public function companyRol(){       
        return $this->belongsToMany('App\Models\Rol', 'user_company_rols', 'user_id', 'role_id'); 
    } */

    public function currentCompany (){       
        return $this->belongsTo('App\Models\Company', 'current_company', 'id');

      /*  $rol = UserCompanyRol::where('company_id', Auth::user()->current_company)->where('user_id',Auth::user()->id)->first();

       return $rol;  */
    }
}
