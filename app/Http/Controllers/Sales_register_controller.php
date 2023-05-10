<?php

namespace App\Http\Controllers;

use App\Models\Agent_user;
use App\Models\Sales_register;
use App\Models\Audit_trail;
use App\Models\Sales_register_details;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

class Sales_register_controller extends Controller
{
    public function index()
    {
        $agent_user = Agent_user::first();

        return view('sales_register_upload')->with('active', 'sales_register_upload')
            ->with('agent_user', $agent_user);
    }

    public function sales_register_upload_process(Request $request)
    {
        date_default_timezone_set('Asia/Manila');
        $date = date('Y-m-d');

        $fileName = $_FILES["agent_csv_file"]["tmp_name"];
        $csv = array();

        if (($handle = fopen($fileName, "r")) !== FALSE) {
            while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                $csv[] = $data;
            }
        }


        //
       // return $csv;
        $counter = count($csv);
        //delete puhon ayaw sa karun kay testing pa.
        //$sales_register = Sales_register::where('customer_id',$csv[1][0])->first();


        if ($csv[0][3] == 'SR-CODE') {
            $sales_register_saved = new Sales_register([
                'customer_id' => $csv[1][0],
                'principal_id' => $csv[1][1],
                'export_code' => $csv[1][3],
                'total_amount' => $csv[1][4],
                'dr' => $csv[1][5],
                'date_delivered' => $csv[1][6],
                'status' => '',
                'sku_type' => strtoupper($csv[1][7]),
                'amount_paid' => '0',
            ]);
            $sales_register_saved->save();
            $sales_register_saved_last_id = $sales_register_saved->id;

            for ($i = 2; $i < $counter; $i++) {
                $sales_register_details = new Sales_register_details([
                    'sales_register_id' => $sales_register_saved_last_id,
                    'inventory_id' => $csv[$i][0],
                    'delivered_quantity' => $csv[$i][1],
                    'unit_price' => $csv[$i][2],
                    'sku_type' => strtoupper($csv[$i][3]),
                ]);

                $sales_register_details->save();
            }



            fclose($handle);

            $audit_trail = new Audit_trail([
                'description' => 'Uploaded Sales Register',
            ]);

            $audit_trail->save();

            return 'saved';
        }else{
            return 'incorrect_file';
        }

       
    }
}
