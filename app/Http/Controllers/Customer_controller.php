<?php

namespace App\Http\Controllers;

use App\Models\Agent_user;
use App\Models\Customer_principal_code;
use App\Models\Customer_principal_price;
use App\Models\Customer;
use App\Models\Location;
use App\Models\Audit_trail;
use App\Models\Customer_principal_discount;
use App\Models\Customer_export;
use App\Models\Customer_export_details;
use App\Models\Principal;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

class Customer_controller extends Controller
{
    public function index()
    {
        $agent_user = Agent_user::first();

        return view('customer_upload')->with('active', 'customer_upload')
            ->with('agent_user', $agent_user);
    }

    public function customer_upload_process(Request $request)
    {

        Schema::disableForeignKeyConstraints();
        DB::table('customers')->truncate();
        DB::table('customer_principal_prices')->truncate();
        Schema::enableForeignKeyConstraints();

        date_default_timezone_set('Asia/Manila');
        $date = date('Y-m-d');

        $fileName = $_FILES["agent_csv_file"]["tmp_name"];
        $csv = array();

        if (($handle = fopen($fileName, "r")) !== FALSE) {
            while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                $csv[] = $data;
            }
        }

        //return $csv;
        $counter = count($csv);

        if ($csv[0][0] == 'BOOKING CUSTOMER') {
            for ($i = 1; $i < $counter; $i++) {
                if ($csv[$i][0] == 'CUSTOMER DATA') {
                    $customer = Customer::find($csv[$i][1]);
                    if ($customer) {
                        if ($csv[$i][13] == '' or $csv[$i][13] == null) {
                            $allowed = 1;
                        } else {
                            $allowed = $csv[$i][13];
                        }
                        Customer::where('id', $csv[$i][1])
                            ->update([
                                'id' => $csv[$i][1],
                                'store_name' => $csv[$i][2],
                                'kob' => $csv[$i][3],
                                'credit_limit' => str_replace(',', '', $csv[$i][5]),
                                'location_id' => $csv[$i][7],
                                'contact_person' => $csv[$i][8],
                                'contact_number' => $csv[$i][9],
                                'latitude' => $csv[$i][10],
                                'longitude' => $csv[$i][11],
                                'mode_of_transaction' => $csv[$i][12],
                                'allowed_number_of_sales_order' => $allowed,
                            ]);
                    } else {
                        if ($csv[$i][13] == '' or $csv[$i][13] == null) {
                            $allowed = 1;
                        } else {
                            $allowed = $csv[$i][13];
                        }
                        $customer_saved = new Customer([
                            'id' => $csv[$i][1],
                            'store_name' => $csv[$i][2],
                            'kob' => $csv[$i][3],
                            'credit_limit' => str_replace(',', '', $csv[$i][5]),
                            'location_id' => $csv[$i][7],
                            'contact_person' => $csv[$i][8],
                            'contact_number' => $csv[$i][9],
                            'latitude' => $csv[$i][10],
                            'longitude' => $csv[$i][11],
                            'mode_of_transaction' => $csv[$i][12],
                            'allowed_number_of_sales_order' => $allowed,
                        ]);
                        $customer_saved->save();
                    }
                } elseif ($csv[$i][0] == 'CUSTOMER PRICE') {
                    $check_price_level = Customer_principal_price::where('principal_id', $csv[$i][2])->where('customer_id', $csv[$i][1])->first();
                    if ($check_price_level) {
                        Customer_principal_price::where('customer_id', $csv[$i][1])
                            ->where('principal_id', $csv[$i][1])
                            ->update([
                                'customer_id' => $csv[$i][1],
                                'principal_id' => $csv[$i][2],
                                'price_level' => $csv[$i][3],
                            ]);
                    } else {
                        $new_customer_principal_price = new Customer_principal_price([
                            'customer_id' => $csv[$i][1],
                            'principal_id' => $csv[$i][2],
                            'price_level' => $csv[$i][3],
                        ]);

                        $new_customer_principal_price->save();
                    }
                }
            }

            return 'saved';
        } else {
            return 'incorrect_file';
        }
    }

    public function customer_principal_code_upload()
    {
        $agent_user = Agent_user::first();

        return view('customer_principal_code_upload')->with('active', 'customer_principal_code_upload')
            ->with('agent_user', $agent_user);
    }

    public function customer_principal_code_upload_process(Request $request)
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

        if ($csv[0][1] != 'export_customer_principal_code') {
            return 'incorrect_file';
        } else {
            for ($i = 1; $i < $counter; $i++) {
                $customer_principal_code = new Customer_principal_code([
                    'customer_id' => $csv[$i][0],
                    'principal_id' => $csv[$i][1],
                    'store_code' => $csv[$i][2],
                ]);
                $customer_principal_code->save();
            }

            $audit_trail = new Audit_trail([
                'description' => 'Uploaded export_customer_principal_code ' . $csv[0][2] . ' Export Code',
            ]);

            $audit_trail->save();
        }

        return 'saved';
    }

    public function customer_principal_price_upload()
    {
        $agent_user = Agent_user::first();

        return view('customer_principal_price_upload')->with('active', 'customer_principal_price_upload')
            ->with('agent_user', $agent_user);
    }

    public function customer_principal_price_upload_process(Request $request)
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

        if ($csv[0][1] != 'export_customer_price_per_principal') {
            return 'incorrect_file';
        } else {
            for ($i = 1; $i < $counter; $i++) {
                $customer_principal_price = new Customer_principal_price([
                    'customer_id' => $csv[$i][0],
                    'principal_id' => $csv[$i][1],
                    'price_level' => $csv[$i][2],
                ]);
                $customer_principal_price->save();
            }

            $audit_trail = new Audit_trail([
                'description' => 'Uploaded export_customer_price_per_principal ' . $csv[0][2] . ' Export Code',
            ]);

            $audit_trail->save();
        }

        return 'saved';
    }

    public function customer_principal_discount_upload()
    {
        $agent_user = Agent_user::first();

        return view('customer_principal_discount_upload')->with('active', 'customer_principal_discount_upload')
            ->with('agent_user', $agent_user);
    }


    public function customer_principal_discount_process(Request $request)
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

        //return $csv;

        $counter = count($csv);
        $agent_user = Agent_user::select('agent_id')->first();

        if ($csv[0][4] == 'principal_discount') {
            for ($i = 1; $i < $counter; $i++) {
                $customer_saved = new Customer_principal_discount([
                    'customer_id' => $csv[$i][0],
                    'principal_id' => $csv[$i][1],
                    'discount_name' => $csv[$i][2],
                    'discount_rate' => $csv[$i][3],
                ]);
                $customer_saved->save();
            }
            return 'saved';
        } else {
            return 'incorrect_file';
        }
    }

    public function new_customer()
    {
        date_default_timezone_set('Asia/Manila');
        $date = date('Y-m-d');

        $schedule_day = date('l', strtotime($date));

        $agent_user = Agent_user::first();
        $location = location::select('id', 'location')->get();
        return view('new_customer', [
            'location' => $location,
        ])->with('active', 'new_customer')
            ->with('agent_user', $agent_user)
            ->with('schedule_day', $schedule_day);
    }




    public function customer_export_generate_customer(Request $request)
    {
        date_default_timezone_set('Asia/Manila');
        $date = date('Y-m-d');

        if ($request->input('select_mode') == 'New Customer') {
            $agent_user = Agent_user::first();
            $location = location::select('id', 'location')->get();
            return view('customer_export_generate_customer_new_customer')
                ->with('agent_user', $agent_user)
                ->with('location', $location);
        } else {
            $customer = Customer::get();
            return view('customer_export_generate_customer_data_update', [
                'customer' => $customer,
            ]);
        }
    }

    public function customer_export_generate_final_summary(Request $request)
    {
        $explode = explode('-', $request->input('location'));
        $location_id = $explode[0];
        $location = $explode[1];
        return view('customer_export_generate_final_summary')
            ->with('agent_name', $request->input('agent_name'))
            ->with('store_name', str_replace(',', ' ', $request->input('store_name')))
            ->with('contact_number', $request->input('contact_number'))
            ->with('contact_person', str_replace(',', ' ', $request->input('contact_person')))
            ->with('detailed_address', str_replace(',', ' ', $request->input('detailed_address')))
            ->with('kob', $request->input('kob'))
            ->with('latitude', $request->input('latitude'))
            ->with('longitude', $request->input('longitude'))
            ->with('location_id', $location_id)
            ->with('location', $location);
    }

    public function customer_export_new_customer_saved(Request $request)
    {
        $customer_export_saved = new Customer_export([
            'store_name' => strtoupper($request->input('store_name')),
            'contact_person' => strtoupper($request->input('contact_person')),
            'contact_number' => strtoupper($request->input('contact_number')),
            'location' => strtoupper($request->input('location')),
            'location_id' => strtoupper($request->input('location_id')),
            'detailed_address' => strtoupper($request->input('detailed_address')),
            'longitude' => strtoupper($request->input('longitude')),
            'latitude' => strtoupper($request->input('latitude')),
            'exported' => 'not_yet',
            'kob' => strtoupper($request->input('kob')),
            'status' => 'Pending Approval',
        ]);

        $customer_export_saved->save();

        return 'saved';
    }

    public function update_customer()
    {
        $agent_user = Agent_user::first();
        $customer = Customer::get();
        return view('update_customer', [
            'customer' => $customer,
        ])->with('active', 'customer_upload')
            ->with('agent_user', $agent_user);
    }

    public function update_customer_generate(Request $request)
    {
        //return $request->input();

        $customer = Customer::find($request->input('customer_id'));
        $location = Location::get();
        $agent_user = Agent_user::latest()->first();
        $customer_principal_price = Customer_principal_price::where('customer_id', $customer->id)->get();

        if (count($customer_principal_price) != 0) {
            foreach ($customer_principal_price as $key => $data) {
                $principal_id[] = $data->principal_id;
            }
            $principal = Principal::whereNotIn('id', $principal_id)->where('principal', '!=', 'None')->get();
        } else {
            $principal = Principal::where('principal', '!=', 'None')->get();
        }


        return view('update_customer_generate', [
            'customer' => $customer,
            'customer_id' => $customer->id,
            'location' => $location,
            'agent_user' => $agent_user,
            'customer_principal_price' => $customer_principal_price,
            'principal' => $principal,
        ]);
    }

    public function update_customer_generate_page_final_summary(Request $request)
    {
        $explode = explode('-', $request->input('location_id'));
        $location_id = $explode[0];
        $location = $explode[1];

        $check_principal_level = $request->input('customer_principal_price_level');
        if (isset($check_principal_level)) {
            $principal_level = $request->input('customer_principal_price_level');
        } else {
            $principal_level = 'none';
        }

        return view('update_customer_generate_page_final_summary')
            ->with('contact_number', $request->input('contact_number'))
            ->with('contact_person', str_replace(',', '', strtoupper($request->input('contact_person'))))
            ->with('detailed_address', str_replace(',', '', strtoupper($request->input('detailed_address'))))
            ->with('kob', $request->input('kob'))
            ->with('latitude', $request->input('latitude'))
            ->with('customer_id', $request->input('customer_id'))
            ->with('location_id', $location_id)
            ->with('location', $location)
            ->with('principal_level', $principal_level)
            ->with('longitude', $request->input('longitude'))
            ->with('mode_of_transaction', $request->input('mode_of_transaction'))
            ->with('principal_price_selected', $request->input('principal_price_selected'))
            ->with('store_name', str_replace(',', '', strtoupper($request->input('store_name'))));
    }

    public function update_customer_save(Request $request)
    {
        //return $request->input();
        Customer::where('id', $request->input('customer_id'))
            ->update([
                'location_id' => $request->input('location_id'),
                'store_name' => $request->input('store_name'),
                'mode_of_transaction' => $request->input('mode_of_transaction'),
                'longitude' => $request->input('longitude'),
                'latitude' => $request->input('latitude'),
                'kob' => $request->input('kob'),
                'contact_person' => $request->input('contact_person'),
                'contact_number' => $request->input('contact_number'),
                'detailed_address' => $request->input('detailed_address'),
            ]);


        $check_customer_current_price_Level = $request->input('customer_current_price_Level');

        if (isset($check_customer_current_price_Level)) {
            foreach ($request->input('customer_current_price_Level') as $key => $data) {
                $explode = explode('-', $data);
                $principal_id = $explode[1];
                $price_level = $explode[2];

                Customer_principal_price::where('customer_id', $request->input('customer_id'))
                    ->where('principal_id', $principal_id)
                    ->update([
                        'customer_id' => $request->input('customer_id'),
                        'principal_id' => $principal_id,
                        'price_level' => $price_level,
                    ]);
            }
        }

        $check_principal_price_selected = $request->input('principal_price_selected');
        if (isset($check_principal_price_selected)) {
            foreach ($request->input('principal_price_selected') as $key => $data) {
                $explode = explode('-', $data);
                $principal_id = $explode[1];
                $price_level = $explode[2];

                $filter_for_update = Customer_principal_price::where('principal_id', $principal_id)->where('customer_id', $request->input('customer_id'))->first();

                if ($filter_for_update) {
                    Customer_principal_price::where('id', $filter_for_update->id)
                        ->update(['price_level' => $price_level]);
                } else {
                    $new_principal_price = new Customer_principal_price([
                        'customer_id' => $request->input('customer_id'),
                        'principal_id' => $principal_id,
                        'price_level' => $price_level,
                    ]);

                    $new_principal_price->save();
                }
            }
        }

        $check_customer_export = Customer_export::where('principal_id', $request->input('principal_id'))->where('customer_id', $request->input('customer_id'))->first();

        if ($check_customer_export) {
            Customer_export::where('customer_id', $request->input('customer_id'))
                ->where('principal_id', $request->input('principal_id'))
                ->update([
                    'store_name' => strtoupper($request->input('store_name')),
                    'contact_person' => $request->input('contact_person'),
                    'contact_number' => $request->input('contact_number'),
                    'location' => $request->input('location'),
                    'location_id' => $request->input('location_id'),
                    'detailed_address' => str_replace(',', '', strtoupper($request->input('detailed_address'))),
                    'longitude' => $request->input('longitude'),
                    'latitude' => $request->input('latitude'),
                    'kob' => $request->input('kob'),
                    'status' => 'Pending Approval',
                    'customer_id' => $request->input('customer_id'),
                    // 'coordinates' => 'none',
                    // 'price_level' => $request->input('price_level'),
                    'mode_of_transaction' => $request->input('mode_of_transaction'),
                ]);

            $check_principal_price_selected_3 = $request->input('principal_price_selected');
            if (isset($check_principal_price_selected_3)) {
                foreach ($request->input('principal_price_selected') as $key => $data) {
                    $explode = explode('-', $data);
                    $principal_id = $explode[1];
                    $price_level = $explode[2];

                    customer_export_details::where('customer_id', $request->input('customer_id'))
                        ->where('principal_id', $principal_id)
                        ->update([
                            'customer_export_id' => $check_customer_export->id,
                            'customer_id' => $request->input('customer_id'),
                            'principal_id' => $principal_id,
                            'price_level' => $price_level,
                        ]);
                }
            }

            $check_customer_current_price_Level_3 = $request->input('customer_current_price_Level');

            if (isset($check_customer_current_price_Level_3)) {
                foreach ($request->input('customer_current_price_Level') as $key => $data) {
                    $explode = explode('-', $data);
                    $principal_id = $explode[1];
                    $price_level = $explode[2];

                    customer_export_details::where('customer_id', $request->input('customer_id'))
                        ->where('principal_id', $principal_id)
                        ->update([
                            'customer_export_id' => $check_customer_export->id,
                            'customer_id' => $request->input('customer_id'),
                            'principal_id' => $principal_id,
                            'price_level' => $price_level,
                        ]);
                }
            }
        } else {
            $new_customer_export = new Customer_export([
                'store_name' => strtoupper($request->input('store_name')),
                'contact_person' => $request->input('contact_person'),
                'contact_number' => $request->input('contact_number'),
                'location' => $request->input('location'),
                'location_id' => $request->input('location_id'),
                'detailed_address' => strtoupper($request->input('detailed_address')),
                'longitude' => $request->input('longitude'),
                'latitude' => $request->input('latitude'),
                'kob' => $request->input('kob'),
                'status' => 'Pending Approval',
                'customer_id' => $request->input('customer_id'),
                'principal_id' => $request->input('principal_id'),
                'price_level' => $request->input('price_level'),
                'mode_of_transaction' => $request->input('mode_of_transaction'),
            ]);

            $new_customer_export->save();

            $check_principal_price_selected_2 = $request->input('principal_price_selected');
            if (isset($check_principal_price_selected_2)) {
                foreach ($request->input('principal_price_selected') as $key => $data) {
                    $explode = explode('-', $data);
                    $principal_id = $explode[1];
                    $price_level = $explode[2];

                    $new_principal_price_details = new customer_export_details([
                        'customer_export_id' => $new_customer_export->id,
                        'customer_id' => $request->input('customer_id'),
                        'principal_id' => $principal_id,
                        'price_level' => $price_level,
                    ]);

                    $new_principal_price_details->save();
                }
            }

            $check_customer_current_price_Level_2 = $request->input('customer_current_price_Level');

            if (isset($check_customer_current_price_Level_2)) {
                foreach ($request->input('customer_current_price_Level') as $key => $data) {
                    $explode = explode('-', $data);
                    $principal_id = $explode[1];
                    $price_level = $explode[2];

                    $new_principal_price_details = new customer_export_details([
                        'customer_export_id' => $new_customer_export->id,
                        'customer_id' => $request->input('customer_id'),
                        'principal_id' => $principal_id,
                        'price_level' => $price_level,
                    ]);

                    $new_principal_price_details->save();
                }
            }
        }

        return 'saved';



        // $check_principal_price = Customer_principal_price::where('customer_id', $request->input('customer_id'))->where('principal_id', $request->input('principal_id'))->first();

        // if ($check_principal_price) {
        // } else {
        //     $new_principal_price = new Customer_principal_price([
        //         'customer_id' => $request->input('customer_id'),
        //         'principal_id' => $request->input('principal_id'),
        //         'price_level' => $request->input('price_level'),
        //     ]);

        //     $new_principal_price->save();
        // }
    }




















    public function customer_export_saved(Request $request)
    {
        $explode = explode('-', $request->input('location'));
        $location_id = $explode[0];
        $location = $explode[1];

        $customer_export_saved = new Customer_export([
            'schedule_day' => $request->input('schedule_day'),
            'store_name' => $request->input('store_name'),
            'contact_person' => $request->input('contact_person'),
            'contact_number' => $request->input('contact_number'),
            'location' => $location,
            'location_id' => $location_id,
            'detailed_address' => $request->input('detailed_address'),
            'coordinates' => $request->input('coordinates'),
            'exported' => 'not_yet',
            'kob' => $request->input('kob'),
        ]);

        $customer_export_saved->save();

        return 'saved';
    }

    public function new_customer_generate_csv(Request $request)
    {
        //return 'asdasd';
        //return $request->input();
        date_default_timezone_set('Asia/Manila');
        $date = date('Ymd');
        $time = date('His');

        $agent_user = Agent_user::first();
        $customer_export = Customer_export::where('exported', NULL)->get();
        return view('new_customer_generate_csv', [
            'customer_export' => $customer_export,
            'agent_user' => $agent_user,
        ])->with('date', $date)
            ->with('time', $time)
            ->with('active', 'new_customer_generate_csv');
    }

    public function customer_export(Request $request)
    {
        foreach ($request->input('customer_export_id') as $key => $data) {
            Customer_export::where('id', $data)
                ->update(['exported' => 'exported']);
        }

        return 'saved';
    }

    public function customer_export_generate_customer_data_update_generate_data(Request $request)
    {
        //return 'NO FUNCTION YET';
        $customer_data = Customer::find($request->input('customer_id'));
        $agent_user = Agent_user::first();
        $location = location::select('id', 'location')->get();
        return view('customer_export_generate_customer_data_update_generate_data', [
            'customer_data' => $customer_data,
            'agent_user' => $agent_user,
            'location' => $location,
        ]);
    }
}
