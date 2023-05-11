<?php

namespace App\Http\Controllers;
use App\Models\Principal;
use App\Models\Agent_user;
use App\Models\Audit_trail;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

class Principal_controller extends Controller
{
    public function index()
    {
        $agent_user = Agent_user::first();

        return view('principal_upload')->with('active','principal_upload')
            ->with('agent_user', $agent_user);
    }

    public function principal_upload_process(Request $request)
    {
        date_default_timezone_set('Asia/Manila');
        $date = date('Y-m-d');

        $fileName = $_FILES["agent_csv_file"]["tmp_name"];
        $csv = array();

         if(($handle = fopen($fileName, "r")) !== FALSE)
         {
            while(($data = fgetcsv($handle, 1000, ",")) !== FALSE)
            {
                $csv[] = $data;
            }
         }

         $counter = count($csv);

         Schema::disableForeignKeyConstraints();
         DB::table('principals')->truncate();
         Schema::enableForeignKeyConstraints();

         for ($i=1; $i < $counter; $i++) { 
            $principal_search = Principal::where('principal',$csv[$i][1])->first();
            if (!$principal_search) {
                $principal_saved = new Principal([
                    'id' => $csv[$i][0],
                    'principal' => $csv[$i][1],
                ]);
                $principal_saved->save();
            }
         }

         $audit_trail = new Audit_trail([
            'description' => 'Uploaded Principal',
         ]);

         $audit_trail->save();
         

         fclose($handle);

         return 'saved';
    }
}
