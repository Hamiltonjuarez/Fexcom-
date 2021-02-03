<?php
namespace App\Classes;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Config;
use App\Models\InvoiceType;
use App;


class NewCompany{
    public function createProvidersTable($company){      
        
        Schema::connection($company->model_name.'_mysql')->create('providers', function($table)
        {
            $table->increments('id');
            $table->foreignId('country_id');
            $table->foreignId('detail_account');           
            $table->foreignId('active_foil')->nullable();
            $table->boolean('contributor');    
            $table->string('code');
            $table->string('nit');
            $table->string('ncr');
            $table->string('name');
            $table->string('business_size');//big medium or small business
            $table->string('address');
            $table->string('phone');
            $table->string('business_activitie');            
        });       
    }

    public function createProvidersFoilsTable($company){      
        
        Schema::connection($company->model_name.'_mysql')->create('provider_foils', function($table)
        {
            $table->increments('id');
            $table->foreignId('provider_id');
            $table->string('foil');   
            $table->string('status');        
                      
        });       
    }

    public function createCompanyTypesTable($company){
        Schema::connection($company->model_name.'_mysql')->create('account_types', function($table)
        {
            $table->increments('id');          
            $table->string('name');
            $table->integer('position');
        });        
    }

    public function createContableSettingsTable($company){
       /*  Schema::connection($company->model_name.'_mysql')->create('contable_settings', function($table)
        {
            $table->increments('id');   
            $table->integer('auditor_id');
            $table->integer('mayor_digits');
            $table->date('start_date');          
        }); */ 
        Schema::connection($company->model_name.'_mysql')->create('contable_settings', function($table)
        {
            $table->increments('id');   
            $table->integer('auditor_id');
            $table->integer('mayor_digits');
            $table->date('start_date');          
        });
    }

    public function createChartOfAccountsTable($company){
        Schema::connection($company->model_name.'_mysql')->create('chart_of_accounts', function($table)
        {
            $table->increments('id');   
            $table->string('type');                 
        }); 
    }

    public function createChartOfAccountsDetailsTable($company){
        Schema::connection($company->model_name.'_mysql')->create('chart_of_accounts_details', function($table)
        {
            $table->increments('id');   
            $table->foreignId('chart_accounts_id');   
            $table->foreignId('account_type_id');
            $table->string('account_code');
            $table->string('name');
            $table->string('balance_type');
            $table->double('account_balance');
            $table->string('father_account_code');
            $table->boolean('detail_account');            
        }); 
    }

    public function createInvoiceTypesTable($company){
        Schema::connection($company->model_name.'_mysql')->create('invoice_types', function($table)
        {
            $table->id();
            $table->string('type');
            $table->string('name');         
        }); 

        $this->fillInvoiceTypesTable($company);
    }

    public function fillInvoiceTypesTable($company){
       
        $invoice = new InvoiceType();
        $invoice->changeTable($company->model_name);
        $invoice->addConnection($company->model_name);

        $invoice->type = 'CCF';
        $invoice->name  = 'CCF';
        $invoice->save();

        $invoice = new InvoiceType();
        $invoice->changeTable($company->model_name);
        $invoice->addConnection($company->model_name);

        $invoice->type = 'Factura';
        $invoice->name  = 'Factura';
        $invoice->save();

        $invoice = new InvoiceType();
        $invoice->changeTable($company->model_name);
        $invoice->addConnection($company->model_name);

        $invoice->type = 'Importacion';
        $invoice->name  = 'Importacion';
        $invoice->save();

        $invoice = new InvoiceType();
        $invoice->changeTable($company->model_name);
        $invoice->addConnection($company->model_name);

        $invoice->type = 'Factura Sujeto Excluido';
        $invoice->name  = 'Factura Sujeto Excluido ';
        $invoice->save();
    }


    public function createAccountPayablesTable($company){
        Schema::connection($company->model_name.'_mysql')->create('accounts_payables', function($table)
        {
            $table->id();
            $table->foreignId('provider_id');
            $table->foreignId('purchase_type');
            $table->foreignId('created_by');
            $table->date('date');           
            $table->string('foil');
            $table->string('concept');
            $table->string('status');         
            $table->string('payment_terms');
            $table->string('doc_number');           
            $table->double('perceived_iva');    //references iva of items or products.       
            $table->double('exempt_purchases');            
            $table->double('taxed_purchases');
            $table->double('retained_one');
            $table->double('retained_ten');
            $table->double('other_taxes');
            $table->double('advance_payment');
            $table->double('excluded_subjets_total');
            $table->double('third_parties_retention');
            $table->double('total');  
            $table->timestamps();
        }); 
    }

    public function createPayableDetailsTable($company){
        Schema::connection($company->model_name.'_mysql')->create('payable_details', function($table)
        {
            $table->id();
            $table->foreignId('payable_id');
            $table->string('description');
            $table->double('quantity');
            $table->double('unitary_price');
            $table->double('total');
            $table->string('iva');      
        }); 
    }

    public function createImportationsTable($company){
        Schema::connection($company->model_name.'_mysql')->create('importations', function($table)
        {
            $table->id();
            $table->foreignId('provider_id');
            $table->foreignId('created_by');
            $table->string('duca');
            $table->string('doc_number');
            $table->string('doc_concept');
            $table->string('country');
            $table->string('payment_terms');           
            $table->date('date');
            $table->double('fob_total');
            $table->double('importation_expenses'); 
            $table->double('cif_total');  
            $table->double('cif_iva');         
            $table->double('dai_total');            
            $table->double('dai_iva');
            $table->double('other_local_taxes');
            $table->double('other_local_expenses');
            $table->double('other_local_total');
            $table->double('ohter_local_iva');            
            $table->double('total');       // cif_total + dai_total + local_total  
            $table->double('iva_sumary'); //localiva + dai iva + importation iva 
            $table->double('total_w_iva'); //total + iva_sumary 
        }); 
    }

    public function createImportationDetailsTable($company){
        Schema::connection($company->model_name.'_mysql')->create('importation_details', function($table)
        {
            $table->id();
            $table->foreignId('importation_id');
            $table->string('concept');
            $table->double('quantity');
            $table->double('u_price');            
            $table->double('percentage');
            $table->double('product_fob');
            $table->double('importation_expenses');
            $table->double('cif');
            $table->double('cif_iva');
            $table->double('dai_percentage');
            $table->double('product_dai');
            $table->double('dai_iva');            
            $table->double('other_expenses');
            $table->double('other_expenses_iva');           
            $table->double('iva_sumary');
            $table->double('total');
            $table->double('total_w_iva');
        }); 
    }

    public function createLocalExpensesTable($company){
        Schema::connection($company->model_name.'_mysql')->create('local_expenses', function($table)
        {
            $table->id();
            $table->foreignId('importation_id');
            $table->string('concept');
            $table->boolean('iva');
            $table->double('cost');            
            $table->string('type');           
        }); 
    }

    public function createCompanyDataBase($company){
        
        $dbName = $company->model_name.'_db';

        \DB::statement('CREATE DATABASE'.' '.$dbName);
        $config = App::make('config');        
        $connections = $config->get('database.connections');       
        $defaultConnection = $connections[$config->get('database.default')];
        $newConnection = $defaultConnection;      
        $newConnection['database'] = $dbName;    
       

       Config::set("database.connections.".$company->model_name.'_mysql',$newConnection );

       $this->createContableSettingsTable($company);
       $this->createProvidersTable($company);
       $this->createCompanyTypesTable($company);
       $this->createChartOfAccountsTable($company);
       $this->createChartOfAccountsDetailsTable($company);
       $this->createInvoiceTypesTable($company);
       $this->createAccountPayablesTable($company);
       $this->createPayableDetailsTable($company);
       $this->createProvidersFoilsTable($company);
       $this->createImportationsTable($company);
       $this->createImportationDetailsTable($company);
       $this->createLocalExpensesTable($company);
    }
    
}