<?php

namespace App\Http\Controllers;

use App\Models\Agent_user;
use App\Models\Sales_register;
use App\Models\Sales_order;
use App\Models\Customer;
use App\Models\Collection;
use App\Models\Collection_details;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Collection_controller extends Controller
{
    public function index()
    {
        $agent_user = Agent_user::first();
        $customer = Customer::select('id', 'store_name')->get();
        return view('collection', [
            'customer' => $customer,
        ])->with('active', 'collection')
            ->with('agent_user', $agent_user);
    }

    public function collection_generate_customer_payables(Request $request)
    {
        $sales_register = Sales_register::select('id', 'dr', 'date_delivered', 'principal_id', 'status', 'total_amount', 'sku_type', 'customer_id', 'amount_paid')
            ->where('customer_id', $request->input('customer_id'))
            ->where('status', '!=', 'paid')
            ->get();


        $sales_order = Sales_order::select('id', 'total_amount', 'principal_id', 'sku_type', 'status', 'customer_id', 'amount_paid')
            ->where('customer_id', $request->input('customer_id'))
            ->where('status', '!=', 'paid')
            ->get();

        return view('collection_generate_customer_payables', [
            'sales_register' => $sales_register,
            'sales_order' => $sales_order,
        ])->with('customer_id', $request->input('customer_id'));
    }

    public function collection_generate_generate_number_of_transactions(Request $request)
    {
        //return $request->input();
        //return $request->input();

        $sales_register_number_of_transactions = array_filter($request->input('sales_register_number_of_transactions'));


        return view('collection_generate_generate_number_of_transactions', [
            'sales_register_dr' => $request->input('sales_register_dr'),
            'sales_register_principal' => $request->input('sales_register_principal'),
            'sales_register_sku_type' => $request->input('sales_register_sku_type'),
            'sales_register_remarks' => $request->input('sales_register_remarks'),
            'sales_register_mode_of_transaction' => $request->input('sales_register_mode_of_transaction'),
            'sales_register_store_name' => $request->input('sales_register_store_name'),
            'sales_register_balance' => $request->input('sales_register_balance'),
            'sales_register_total_bo' => $request->input('sales_register_total_bo'),
            'sales_register_total_rgs' => $request->input('sales_register_total_rgs'),
            'sales_register_number_of_transactions' => $sales_register_number_of_transactions,
            'sales_register_total_amount' => $request->input('sales_register_total_amount'),
            'sales_register_amount_paid' => $request->input('sales_register_amount_paid'),
            'sales_register_id' => $request->input('sales_register_id'),




            'sales_order_dr' => $request->input('sales_order_dr'),
            'sales_order_principal' => $request->input('sales_order_principal'),
            'sales_order_sku_type' => $request->input('sales_order_sku_type'),
            'sales_order_remarks' => $request->input('sales_order_remarks'),
            'sales_order_mode_of_transaction' => $request->input('sales_order_mode_of_transaction'),
            'sales_order_store_name' => $request->input('sales_order_store_name'),
            'sales_order_balance' => $request->input('sales_order_balance'),
            // 'sales_order_number_of_transactions' => $request->input('sales_order_number_of_transactions'),

            'customer_id' => $request->input('customer_id'),
        ]);
    }

    public function collection_generate_final_summary(Request $request)
    {

        //return $request->input();

        return view('collection_generate_final_summary', [
            'customer_id' => $request->input('customer_id'),
            'sales_register_amount_paid' => $request->input('sales_register_amount_paid'),
            'sales_register_cash' => str_replace(',', '', $request->input('sales_register_cash')),
            'sales_register_cash_add_refer' => str_replace(',', '', $request->input('sales_register_cash_add_refer')),
            'sales_register_cheque' => str_replace(',', '', $request->input('sales_register_cheque')),
            'sales_register_cheque_add_refer' => str_replace(',', '', $request->input('sales_register_cheque_add_refer')),
            'sales_register_less_refer' => str_replace(',', '', $request->input('sales_register_less_refer')),
            'lower_sales_register_cash' => str_replace(',', '', $request->input('lower_sales_register_cash')),
            'lower_sales_register_cash_add_refer' => str_replace(',', '', $request->input('lower_sales_register_cash_add_refer')),
            'lower_sales_register_cheque' => str_replace(',', '', $request->input('lower_sales_register_cheque')),
            'lower_sales_register_cheque_add_refer' => str_replace(',', '', $request->input('lower_sales_register_cheque_add_refer')),
            'lower_sales_register_less_refer' => str_replace(',', '', $request->input('lower_sales_register_less_refer')),
            'sales_register_dr' => $request->input('sales_register_dr'),
            'sales_register_id' => $request->input('sales_register_id'),
            'sales_register_mode_of_transaction' => $request->input('sales_register_mode_of_transaction'),
            'sales_register_principal' => $request->input('sales_register_principal'),
            'sales_register_remarks' => $request->input('sales_register_remarks'),
            'lower_sales_register_remarks' => $request->input('lower_sales_register_remarks'),
            'sales_register_sku_type' => $request->input('sales_register_sku_type'),
            'sales_register_specify' => $request->input('sales_register_specify'),
            'lower_sales_register_specify' => $request->input('lower_sales_register_specify'),
            'sales_register_store_name' => $request->input('sales_register_store_name'),
            'sales_register_total_amount' => $request->input('sales_register_total_amount'),
            'sales_register_total_bo' => $request->input('sales_register_total_bo'),
            'sales_register_total_rgs' => $request->input('sales_register_total_rgs'),
            'sales_register_number_of_transactions' => $request->input('sales_register_number_of_transactions'),
            'sales_register_balance' => $request->input('sales_register_balance'),
            'sales_register_or_number' => $request->input('sales_register_or_number'),

        ]);
    }

    public function collection_save(Request $request)
    {
        //return $request->input();

        $date = DB::select('SELECT CURDATE()');
        $time = DB::select('SELECT CURTIME()');

        foreach ($request->input('sales_register_number_of_transactions') as $key => $number_of_transactions) {
            if ($number_of_transactions == 1) {

                $sales_register_collection_saved = new Collection([
                    'or_number' => $request->input('sales_register_or_number')[$key],
                    'customer_id' => $request->input('customer_id'),
                    'principal' => $request->input('sales_register_principal')[$key],
                    'total_amount' => $request->input('sales_register_total_amount')[$key],
                    'amount_paid' => $request->input('sales_register_amount_paid')[$key],
                    'mode_of_transaction' => $request->input('sales_register_mode_of_transaction')[$key],
                    'dr' => $request->input('sales_register_dr')[$key],
                    'sku_type' => $request->input('sales_register_sku_type')[$key],
                    'balance' => 0,
                    'remarks' => $request->input('sales_register_remarks')[$key],
                    'exported' => '',
                    'total_bo' => $request->input('sales_register_total_bo')[$key],
                    'total_rgs' => $request->input('sales_register_total_rgs')[$key],
                    'date' => $date[0]->{'CURDATE()'},
                    'time' => $time[0]->{'CURTIME()'},
                ]);

                $sales_register_collection_saved->save();

                $sales_register_collection_details_saved = new Collection_details([
                    'collection_id' => $sales_register_collection_saved->id,
                    'image' => '',
                    'cash' => $request->input('sales_register_cash')[$key],
                    'cash_add_refer' => $request->input('sales_register_cash_add_refer')[$key],
                    'cheque' => $request->input('sales_register_cheque')[$key],
                    'cheque_add_refer' => $request->input('sales_register_cheque_add_refer')[$key],
                    'less_refer' => $request->input('sales_register_less_refer')[$key],
                    'specify' => $request->input('sales_register_specify')[$key],
                    'remarks' => $request->input('sales_register_remarks')[$key],
                    'balance' => $request->input('sales_register_updated_balance')[$key],
                ]);

                $sales_register_collection_details_saved->save();
            } else {

                $sales_register_collection_saved = new Collection([
                    'or_number' => $request->input('sales_register_or_number')[$key],
                    'customer_id' => $request->input('customer_id'),
                    'principal' => $request->input('sales_register_principal')[$key],
                    'total_amount' => $request->input('sales_register_total_amount')[$key],
                    'amount_paid' => $request->input('sales_register_amount_paid')[$key],
                    'mode_of_transaction' => $request->input('sales_register_mode_of_transaction')[$key],
                    'dr' => $key,
                    'sku_type' => $request->input('sales_register_sku_type')[$key],
                    'balance' => 0,
                    'remarks' => $request->input('sales_register_remarks')[$key],
                    'exported' => '',
                    'total_bo' => $request->input('sales_register_total_bo')[$key],
                    'total_rgs' => $request->input('sales_register_total_rgs')[$key],
                    'date' => $date[0]->{'CURDATE()'},
                    'time' => $time[0]->{'CURTIME()'},
                ]);

                $sales_register_collection_saved->save();

                $sales_register_collection_details_saved = new Collection_details([
                    'collection_id' => $sales_register_collection_saved->id,
                    'image' => '',
                    'cash' => $request->input('sales_register_cash')[$key],
                    'cash_add_refer' => $request->input('sales_register_cash_add_refer')[$key],
                    'cheque' => $request->input('sales_register_cheque')[$key],
                    'cheque_add_refer' => $request->input('sales_register_cheque_add_refer')[$key],
                    'less_refer' => $request->input('sales_register_less_refer')[$key],
                    'specify' => $request->input('sales_register_specify')[$key],
                    'remarks' => $request->input('sales_register_remarks')[$key],
                    'balance' => $request->input('sales_register_updated_balance')[$key],
                ]);

                $sales_register_collection_details_saved->save();

                $final_sales_register_number_of_transactions = $request->input('sales_register_number_of_transactions')[$key] - 1;

                for ($i = 0; $i < $final_sales_register_number_of_transactions; $i++) {
                    $sales_register_collection_details_saved = new Collection_details([
                        'collection_id' => $sales_register_collection_saved->id,
                        'image' => '',
                        'cash' => 0,
                        'cash_add_refer' => $request->input('lower_sales_register_cash_add_refer')[$key . "-" . $i],
                        'cheque' => 0,
                        'cheque_add_refer' => $request->input('lower_sales_register_cheque_add_refer')[$key . "-" . $i],
                        'less_refer' => $request->input('lower_sales_register_less_refer')[$key . "-" . $i],
                        'specify' => $request->input('lower_sales_register_specify')[$key . "-" . $i],
                        'remarks' => $request->input('lower_sales_register_remarks')[$key . "-" . $i],
                        'balance' => $request->input('lower_sales_register_updated_balance')[$key . "-" . $i],
                    ]);

                    $sales_register_collection_details_saved->save();
                }
            }
        }



        // return 'saved';
    }

    public function collection_export()
    {
        date_default_timezone_set('Asia/Manila');
        $date = date('Y-m-d H:i:s');
        $agent_user = Agent_user::first();
        //$collection = Collection::where('exported', '!=', 'exported')->get();
        return view('collection_export')->with('active', 'collection_export')
            ->with('agent_user', $agent_user)
            ->with('date', $date);
    }

    public function collection_generate_date(Request $request)
    {
        //return $request->input();
        $explode = explode('-', $request->input('date_range'));
        $date_from = date('Y-m-d', strtotime($explode[0]));
        $date_to = date('Y-m-d', strtotime($explode[1]));

        $collection = Collection::whereBetween('date', [$date_from, $date_to])->get();
        $agent_user = Agent_user::first();
        return view('collection_generate_date', [
            'collection' => $collection,
            'agent_user' => $agent_user,
            'date_from' => $date_from,
            'date_to' => $date_to,
        ]);
    }
}
