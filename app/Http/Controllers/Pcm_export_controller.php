<?php

namespace App\Http\Controllers;

use App\Models\Agent_user;
use App\Models\Bad_order;
use App\Models\Bad_order_details;
use App\Models\Return_good_stock;
use App\Models\Return_good_stock_details;
use Faker\Core\Barcode;
use Illuminate\Http\Request;

class Pcm_export_controller extends Controller
{
    public function index()
    {
        $agent_user = Agent_user::first();
        $bad_order = Bad_order::orderBy('id', 'desc')->get();
        $rgs = Return_good_stock::orderBy('id', 'desc')->get();
        return view('pcm_export', [
            'bad_order' => $bad_order,
            'rgs' => $rgs,
        ])->with('active', 'pcm_export')
            ->with('agent_user', $agent_user);
    }

    public function pcm_export_generate(Request $request)
    {
        date_default_timezone_set('Asia/Manila');
        $date = date('Y-m-d');
        $time = date('His');

        $explode = explode('-', $request->input('pcm_id'));
        $transaction = $explode[0];
        $id = $explode[1];

        $agent_user = Agent_user::first();

        if ($transaction == 'bo') {
            $details = Bad_order_details::where('bad_order_id', $id)->get();
        } else {
            $details = Return_good_stock_details::where('rgs_id', $id)->get();
        }

        $store_name = str_replace("'","",$details[0]->pcm->customer->store_name);

        return view('pcm_export_generate', [
            'details' => $details,
            'transaction' => $transaction,
            'id' => $id,
            'store_name' => $store_name,
            'agent_user' => $agent_user,
        ])->with('date', $date)
            ->with('time', $time);
    }
}
