<?php

namespace App\Http\Controllers;

use App\Models\Agent_user;
use App\Models\Location;
use App\Models\Customer;
use App\Models\Inventory;
use App\Models\Principal;
use App\Models\Sales_order;
use App\Models\Sales_order_for_new_customer;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

class Landing_page_controller extends Controller
{
    public function proceed_to_controller()
    {
        $user_check = Agent_user::count();
        $agent_user = Agent_user::first();
        if ($user_check == 0) {
            return view('user_login');
        } else {
            $customer = Customer::count();
            $inventory = Inventory::count();
            $location = Location::count();
            $principal = Principal::count();
            if ($location == 0) {
                return view('location_upload')
                    ->with('agent_user', $agent_user)
                    ->with('active', 'location_upload');
            } elseif ($principal == 0) {
                return view('principal_upload')
                    ->with('agent_user', $agent_user)
                    ->with('active', 'principal_upload');
            } elseif ($customer == 0) {
                return view('customer_upload')
                    ->with('agent_user', $agent_user)
                    ->with('active', 'customer_upload');
            } elseif ($inventory == 0) {
                return view('inventory_upload')
                    ->with('agent_user', $agent_user)
                    ->with('active', 'inventory_upload');
            } else {
                $agent_user = Agent_user::first();
                $customer = Customer::select('id', 'store_name')->get();
                $principal = Principal::select('id', 'principal')->where('principal', '!=', 'NONE')->get();
                $sales_order_check = Sales_order::where('exported', 'not_yet_exported')->count();
                $sales_order_new_customer_check = Sales_order_for_new_customer::where('exported', null)->count();

                return view('work_flow', [
                    'customer' => $customer,
                    'principal' => $principal,
                ])->with('active', 'work_flow')
                    ->with('agent_user', $agent_user)
                    ->with('sales_order_check', $sales_order_check)
                    ->with('sales_order_new_customer_check', $sales_order_new_customer_check);
            }
        }
    }

    public function user_credential(Request $request)
    {

        $user_save = new Agent_user([
            'agent_id' => strtoupper($request->input('user_id')),
            'agent_name' => strtoupper($request->input('agent_name')),
            'agent_image' => '123123',
            'area' => strtoupper($request->input('area')),
        ]);

        $user_save->save();
        return redirect('location_upload');
    }

    public function sign_out()
    {
        Schema::disableForeignKeyConstraints();
        DB::table('agent_users')->truncate();
        Schema::enableForeignKeyConstraints();

        return redirect('/');
    }
}
