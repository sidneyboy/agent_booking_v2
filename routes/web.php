<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('landing_page');
});



Route::get('/proceed_to_controller', [App\Http\Controllers\Landing_page_controller::class, 'proceed_to_controller'])->name('proceed_to_controller');
Route::post('/user_credential', [App\Http\Controllers\Landing_page_controller::class, 'user_credential'])->name('user_credential');

Route::get('/sign_out', [App\Http\Controllers\Landing_page_controller::class, 'sign_out'])->name('sign_out');



Route::get('/location_upload', [App\Http\Controllers\Location_controller::class, 'index'])->name('location_upload');
Route::post('/location_upload_process', [App\Http\Controllers\Location_controller::class, 'location_upload_process'])->name('location_upload_process');


Route::get('/principal_upload', [App\Http\Controllers\Principal_controller::class, 'index'])->name('principal_upload');
Route::post('/principal_upload_process', [App\Http\Controllers\Principal_controller::class, 'principal_upload_process'])->name('principal_upload_process');


Route::get('/customer_upload', [App\Http\Controllers\Customer_controller::class, 'index'])->name('customer_upload');
Route::post('/customer_upload_process', [App\Http\Controllers\Customer_controller::class, 'customer_upload_process'])->name('customer_upload_process');
Route::get('/customer_principal_code_upload', [App\Http\Controllers\Customer_controller::class, 'customer_principal_code_upload'])->name('customer_principal_code_upload');
Route::post('/customer_principal_code_upload_process', [App\Http\Controllers\Customer_controller::class, 'customer_principal_code_upload_process'])->name('customer_principal_code_upload_process');
Route::get('/customer_principal_price_upload', [App\Http\Controllers\Customer_controller::class, 'customer_principal_price_upload'])->name('customer_principal_price_upload');
Route::post('/customer_principal_price_upload_process', [App\Http\Controllers\Customer_controller::class, 'customer_principal_price_upload_process'])->name('customer_principal_price_upload_process');
Route::get('/customer_principal_discount_upload', [App\Http\Controllers\Customer_controller::class, 'customer_principal_discount_upload'])->name('customer_principal_discount_upload');
Route::post('/customer_principal_discount_process', [App\Http\Controllers\Customer_controller::class, 'customer_principal_discount_process'])->name('customer_principal_discount_process');



Route::get('/inventory_upload', [App\Http\Controllers\Inventory_controller::class, 'index'])->name('inventory_upload');
Route::post('/inventory_upload_process', [App\Http\Controllers\Inventory_controller::class, 'inventory_upload_process'])->name('inventory_upload_process');

Route::get('/sales_register_upload', [App\Http\Controllers\Sales_register_controller::class, 'index'])->name('sales_register_upload');
Route::post('/sales_register_upload_process', [App\Http\Controllers\Sales_register_controller::class, 'sales_register_upload_process'])->name('sales_register_upload_process');




Route::get('/work_flow', [App\Http\Controllers\Work_flow_controller::class, 'index'])->name('work_flow');
Route::post('/work_flow_show_inventory', [App\Http\Controllers\Work_flow_controller::class, 'work_flow_show_inventory'])->name('work_flow_show_inventory');
Route::post('/work_flow_inventory_save_as_draft', [App\Http\Controllers\Work_flow_controller::class, 'work_flow_inventory_save_as_draft'])->name('work_flow_inventory_save_as_draft');
Route::post('/work_flow_proceed_to_pre_inventory', [App\Http\Controllers\Work_flow_controller::class, 'work_flow_proceed_to_pre_inventory'])->name('work_flow_proceed_to_pre_inventory');












Route::post('/work_flow_suggested_sales_order_data', [App\Http\Controllers\Work_flow_controller::class, 'work_flow_suggested_sales_order_data'])->name('work_flow_suggested_sales_order_data');

Route::post('/work_flow_suggested_sales_order', [App\Http\Controllers\Work_flow_controller::class, 'work_flow_suggested_sales_order'])->name('work_flow_suggested_sales_order');
Route::post('/work_flow_final_summary', [App\Http\Controllers\Work_flow_controller::class, 'work_flow_final_summary'])->name('work_flow_final_summary');
Route::post('/work_flow_no_inventory', [App\Http\Controllers\Work_flow_controller::class, 'work_flow_no_inventory'])->name('work_flow_no_inventory');
Route::post('/work_flow_no_inventory_proceed_to_final_summary', [App\Http\Controllers\Work_flow_controller::class, 'work_flow_no_inventory_proceed_to_final_summary'])->name('work_flow_no_inventory_proceed_to_final_summary');
Route::post('/work_flow_no_inventory_save', [App\Http\Controllers\Work_flow_controller::class, 'work_flow_no_inventory_save'])->name('work_flow_no_inventory_save');
Route::post('/work_flow_inventory_save', [App\Http\Controllers\Work_flow_controller::class, 'work_flow_inventory_save'])->name('work_flow_inventory_save');
Route::post('/work_flow_check_customer_sales_order_status', [App\Http\Controllers\Work_flow_controller::class, 'work_flow_check_customer_sales_order_status'])->name('work_flow_check_customer_sales_order_status');
Route::post('/work_flow_no_inventory_proceed_to_very_final_summary', [App\Http\Controllers\Work_flow_controller::class, 'work_flow_no_inventory_proceed_to_very_final_summary'])->name('work_flow_no_inventory_proceed_to_very_final_summary');
Route::post('/work_flow_no_inventory_save_previous_sales_register', [App\Http\Controllers\Work_flow_controller::class, 'work_flow_no_inventory_save_previous_sales_register'])->name('work_flow_no_inventory_save_previous_sales_register');
Route::post('/work_flow_new_customer_final_summary', [App\Http\Controllers\Work_flow_controller::class, 'work_flow_new_customer_final_summary'])->name('work_flow_new_customer_final_summary');
Route::post('/work_flow_new_customer_saved', [App\Http\Controllers\Work_flow_controller::class, 'work_flow_new_customer_saved'])->name('work_flow_new_customer_saved');





Route::get('/collection', [App\Http\Controllers\Collection_controller::class, 'index'])->name('collection');
Route::post('/collection_generate_customer_payables', [App\Http\Controllers\Collection_controller::class, 'collection_generate_customer_payables'])->name('collection_generate_customer_payables');
Route::post('/collection_generate_generate_number_of_transactions', [App\Http\Controllers\Collection_controller::class, 'collection_generate_generate_number_of_transactions'])->name('collection_generate_generate_number_of_transactions');


Route::post('/collection_generate_final_summary', [App\Http\Controllers\Collection_controller::class, 'collection_generate_final_summary'])->name('collection_generate_final_summary');
Route::post('/collection_save', [App\Http\Controllers\Collection_controller::class, 'collection_save'])->name('collection_save');






Route::get('/collection_export', [App\Http\Controllers\Collection_controller::class, 'collection_export'])->name('collection_export');

Route::get('/new_customer', [App\Http\Controllers\Customer_controller::class, 'new_customer'])->name('new_customer');
Route::get('/update_customer', [App\Http\Controllers\Customer_controller::class, 'update_customer'])->name('update_customer');
Route::post('/update_customer_generate', [App\Http\Controllers\Customer_controller::class, 'update_customer_generate'])->name('update_customer_generate');
Route::post('/update_customer_generate_page_final_summary', [App\Http\Controllers\Customer_controller::class, 'update_customer_generate_page_final_summary'])->name('update_customer_generate_page_final_summary');
Route::post('/update_customer_save', [App\Http\Controllers\Customer_controller::class, 'update_customer_save'])->name('update_customer_save');






Route::post('/customer_export_generate_customer', [App\Http\Controllers\Customer_controller::class, 'customer_export_generate_customer'])->name('customer_export_generate_customer');
Route::post('/customer_export_generate_final_summary', [App\Http\Controllers\Customer_controller::class, 'customer_export_generate_final_summary'])->name('customer_export_generate_final_summary');
Route::post('/customer_export_new_customer_saved', [App\Http\Controllers\Customer_controller::class, 'customer_export_new_customer_saved'])->name('customer_export_new_customer_saved');




Route::post('/customer_export_saved', [App\Http\Controllers\Customer_controller::class, 'customer_export_saved'])->name('customer_export_saved');
Route::get('/new_customer_generate_csv', [App\Http\Controllers\Customer_controller::class, 'new_customer_generate_csv'])->name('new_customer_generate_csv');
Route::post('/customer_export', [App\Http\Controllers\Customer_controller::class, 'customer_export'])->name('customer_export');
Route::post('/customer_export_generate_customer_data_update_generate_data', [App\Http\Controllers\Customer_controller::class, 'customer_export_generate_customer_data_update_generate_data'])->name('customer_export_generate_customer_data_update_generate_data');







Route::get('/sales_order_export', [App\Http\Controllers\Sales_order_export_controller::class, 'index'])->name('sales_order_export');
Route::post('/sales_order_export_process', [App\Http\Controllers\Sales_order_export_controller::class, 'sales_order_export_process'])->name('sales_order_export_process');
Route::post('/sales_order_new_customer_export_process', [App\Http\Controllers\Sales_order_export_controller::class, 'sales_order_new_customer_export_process'])->name('sales_order_new_customer_export_process');


Route::get('/pcm_export', [App\Http\Controllers\Pcm_export_controller::class, 'index'])->name('pcm_export');
Route::post('/pcm_export_generate', [App\Http\Controllers\Pcm_export_controller::class, 'pcm_export_generate'])->name('pcm_export_generate');
Route::post('/pcm_export_change_status', [App\Http\Controllers\Pcm_export_controller::class, 'pcm_export_change_status'])->name('pcm_export_change_status');

