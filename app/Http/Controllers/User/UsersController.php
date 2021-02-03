<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Hash;
use App\Models\Company;
use App\Models\company_user;
use App\Models\Client;
use App\Models\Rol;
use App\Models\UserCompanyRol;
use Carbon\Carbon;
use Auth;
class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {    
        //return $user=User::get()->load('rol');    
        // Auth::user()->client->id; //get client id from the authenticated user          
        return Inertia::render('User/Index',[
            'users'  => User::get()->load('rol')->transform(function($user){
                return [
                    'created_at'        => Carbon::parse($user->created_at)->format('Y/m/d'),
                    'rol'               => $user->rol,
                    'name'              => $user->name,
                    'email'             => $user->email,
                    'id'                => $user->id,
                ];
            }),           
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        return Inertia::render('User/Create',[
            'roles'         => Auth::user()->getRoles()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {       
        $user = User::create([
            'name' => $request->name,           
            'email'=> $request->address,
            'password' => Hash::make($request->password),
            'role_id' => $request->rolId
        ]); 

        return Redirect::route('providers.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {      
        $companies = Company::get();
        $roles = Rol::where('name' ,'!=', 'admin')->where('name','!=','admon')->get();        
        return Inertia::render('User/Show',[
            'usuario'               => $user,
            'userCompanies'      => $user->companies,
            'companies'          => $companies,
            'roles'              => $roles
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $roles = $user->getRoles();

        return Inertia::render('User/Edit',[
            'user' => $user->load('rol'),
            'roles' => $roles
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $password;
        if($request->password == null){
            $password = $user->password;
        }else{
            $password = $request->password;
        }
        
        $user->update([
            'name'      => $request->name,
            'email'     => $request->address,
            'role_id'   => $request->roleId,
            'password'  => Hash::make($password)
        ]);

        return Redirect::route('users.show',$user->id);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response.
     */
    public function destroy(User $user)
    {
        $user->delete();
        return Redirect::route('users.index');

    }


    public function login(Request $request){
       return Inertia::render('User/LoginTest');
    }

    public function addaccount(Request $request, $userId)
    {             
        $user = User::find($userId); 

         $company_user = UserCompanyRol::create([
            'user_id'       => $user->id,
            'company_id'    => $request->newCompany,
            'role_id'        => $request->rol,
         ]);
        
         return Redirect::route('users.show',$user->id);
    }

    public function checkUserRol(){
        
       if(Auth::user()->role->name == 'accountant' || Auth::user()->role->name == 'auditor'){
            $companies = Auth::user()->companies;
            return view('Accountant/Companies',compact('companies'));
       } else {
            return redirect('/');
       }
    }

    public function selectedCompany(Request $request)
    {       

        $company = Company::find($request->company);       

        $user = Auth::user()->update([
            'current_company'    => $company->id
        ]);

        return redirect('/welcome');
        
    }

    public function getWelcome(){ //check user rol and send to select company or the main page depending of that 
        if(Auth::user()){
            if(Auth::user()->role->name == 'admon' || Auth::user()->role->name == 'manager' ){
                return Redirect::route('companies.index');
            }else{
                //return Inertia::render('User/Accountant/Welcome'); redirect to welcome page 

                $company = Company::find(Auth::user()->current_company);

                if($company->status != 'operational'){
                    return Redirect::route('companies.show',$company->id);
                }else{
                    return Redirect::route('purchases.index');
                }
                
            }
        }else{
            return Redirect::route('login');
        }
    }

    public function setWelcome()
    {
        //return Inertia::render('User/Accountant/Welcome'); // redirect to welcome page

        $company = Company::find(Auth::user()->current_company);

                if($company->status != 'operational'){
                    return Redirect::route('companies.show',$company->id);
                }else{
                    return Redirect::route('purchases.index');
                }
    }
}
