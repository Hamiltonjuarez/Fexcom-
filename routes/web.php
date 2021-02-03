<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;
use App\Http\Controllers\User\UsersController;
use App\Http\Controllers\Provider\ProvidersController;
use App\Http\Controllers\Company\CompaniesController;
use App\Http\Controllers\Company\ChartAccountsController;
use App\Http\Controllers\User\RolesController;
use App\Http\Controllers\PurchasesController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [UsersController::class , 'getWelcome']);


/* Route::get('/userslogin ',[Controller::class,'testing'])->name('users.login');

Route::get('/userslog' , [UsersController::class,'login'])->name('users.log'); */

Route::resource('/users', UsersController::class);

Route::resource('/companies',CompaniesController::class);

Route::resource('/providers', ProvidersController::class);

Route::resource('/roles',RolesController::class);

//purchases routes
Route::resource('/purchases',PurchasesController::class);

Route::get('/purchases/new/{location}/{supplier_id}',[PurchasesController::class,'purchaseLocation'])->name('purchases.location');

Route::post('/purchases/savelocal',[PurchasesController::class,'saveLocal'])->name('purchases.savelocal');

Route::post('/purchases/saveforeign',[PurchasesController::class,'saveForeign'])->name('purchases.saveforeign');

Route::post('/addAccount/{user_id}',[UsersController::class, 'addaccount'])->name('users.addaccount');

Route::get('/addsettings/{company_id}',[CompaniesController::class, 'addmanual'])->name('companies.addsettings');

Route::get('/addprovider/{company_id}',[CompaniesController::class,'addProvider'])->name('companies.addprovider');

Route::post('/storeprovider',[CompaniesController::class, 'storeProvider'])->name('companies.storeprovider');


//operators of a company 

Route::get('/operators/{company_id}',[CompaniesController::class,'operators'])->name('companies.operators');

Route::get('/addoperator/{company_id}',[CompaniesController::class,'addOperator'])->name('companies.addoperator');

Route::post('/saveoperators/{company_id}',[CompaniesController::class,'saveOperators'])->name('companies.saveoperators');

/* Route::post('/saveoperator/{company_id}',[CompaniesController::class,'saveOperator'])->name('companies.saveoperator'); */

Route::post('/savesettings/{company_id}',[CompaniesController::class,'savesettings'])->name('companies.savesettings');

Route::post('/savecatalogue/{company_id}',[CompaniesController::class,'saveCatalogue'])->name('companies.savecatalogue');

Route::post('/storeCompany',[CompaniesController::class,'storeCompany']);

Route::post('/storeModules',[CompaniesController::class,'storeModules']);

Route::post('/storeRepresentative',[CompaniesController::class,'storeRepresentative']);

Route::post('/companies/storeAccountants/{company_id}',[CompaniesController::class,'storeAccountants'])->name('companies.storeaccountants');

Route::group(['prefix' => 'companies'], function () {
    Route::get('catalogue/{company_id}',[CompaniesController::class, 'addCatalogue'])->name('companies.catalogue');
    Route::get('catalogue/show/{company_id}',[CompaniesController::class,'showCatalogue'])->name('companies.showcatalogue');
});

//user login settings
Route::post('/Acompany',[UsersController::class,'selectedCompany'])->name('users.acompany');

Route::get('welcome',[UsersController::class,'setWelcome'])->name('users.welcome');

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', [UsersController::class, 'checkUserRol'])->name('dashboard');

//adding provider list depending of company 
Route::get('suppliers/{company_id}',[CompaniesController::class, 'companySuppliers'])->name('company.suppliers');


Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});
