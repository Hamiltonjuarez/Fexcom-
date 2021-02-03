<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use App\Models\Chart_of_account;
use App\Models\Chart_of_accounts_detail;
use Maatwebsite\Excel\Concerns\ToCollection;
use App\Models\Account_type;


class ChartAccountsImport implements ToCollection
{

    public function  __construct($chart_id , $company)
    {
        $this->chart_id = $chart_id;
        $this->company = $company;
    }

    /**
    * @param Collection $collection
    */


    public function collection(Collection $rows)
    {
        $i = 0 ;

        $types = new Account_type();
        $types->changeTable($this->company->model_name);
        $types->addConnection($this->company->model_name);   
        $types = $types->get();    
       
        foreach ($rows as $row) 
        {
            $detail = 0;
            $balanceType = "";

            foreach ($types as $type) {
                if($row[3] == $type->position){
                    switch ($type->name) {
                        case 'ACTIVO':
                            $balanceType = "debit";
                            break;
                        case 'PASIVO':
                            $balanceType = "credit";
                            break;
                        case 'GASTOS':
                            $balanceType = "debit";
                            break;
                        case 'COSTOS':
                            $balanceType = "debit";
                            break;
                        case 'PATRIMONIO':
                            $balanceType = "credit";
                            break;                        
                        case 'INGRESOS':
                            $balanceType = "credit";
                            break;
                        case 'CUENTA DE MEMORANDO DEUDORAS':
                            $balanceType = "debit";
                            break;
                        case 'CUENTA DE MEMORANDO ACREEDORAS':
                            $balanceType = "credit";
                            break;    
                    }
                }
            }

           
            if($row[2] == "no"){
                $detail = 0;
            }elseif($row[2] == "si"){
                $detail = 1;
            }

            $chart_accounts = new Chart_of_accounts_detail();
            $chart_accounts->changeTable($this->company->model_name);
            $chart_accounts->addConnection($this->company->model_name);

            
            if( $i >= 2 ){

                $chart_accounts->chart_accounts_id = $this->chart_id;
                $chart_accounts->name = $row[1];
                $chart_accounts->account_type_id = $row[3]; 
                $chart_accounts->account_balance = '0';
                $chart_accounts->balance_type = $balanceType;
                $chart_accounts->account_code = $row[0];
                $chart_accounts->father_account_code = $row[4];
                $chart_accounts->detail_account = $detail;
                $chart_accounts->save();
               
            }
            $i = $i+1;
        }
    }
}
