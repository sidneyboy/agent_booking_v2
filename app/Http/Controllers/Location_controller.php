<?php

namespace App\Http\Controllers;

use App\Models\Location;
use App\Models\Agent_user;
use App\Models\Audit_trail;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

class Location_controller extends Controller
{
    public function index()
    {
        $agent_user = Agent_user::first();

        return view('location_upload')->with('active', 'location_upload')
            ->with('agent_user', $agent_user);
    }

    public function location_upload_process(Request $request)
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



        $counter = count($csv);

        for ($i = 1; $i < $counter; $i++) {
            $location = Location::find($csv[$i][0]);
            if (!$location) {
                $location_saved = new Location([
                    'id' => $csv[$i][0],
                    'location' => $csv[$i][1],
                ]);
                $location_saved->save();
            }
        }


        fclose($handle);

        $audit_trail = new Audit_trail([
            'description' => 'Uploaded Location',
        ]);

        $audit_trail->save();

        return 'saved';
    }
}
