<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sales_register extends Model
{
  use HasFactory;

  protected $fillable = [
    'customer_id',
    'export_code',
    'total_amount',
    'dr',
    'date_delivered',
    'sku_type',
    'principal_id',
    'status',
    'amount_paid'
  ];

  public function sales_register_details()
  {
    return $this->hasMany('App\Models\Sales_register_details', 'sales_register_id');
  }

  public function principal()
  {
    return $this->belongsTo('App\Models\Principal', 'principal_id');
  }

  public function bad_order()
  {
    return $this->belongsTo('App\Models\Bad_order', 'customer_id', 'customer_id');
  }

  public function bad_order_total()
  {
    return $this->belongsTo('App\Models\Bad_order', 'customer_id', 'customer_id')->select('total_bo');
  }

  public function rgs_total()
  {
    return $this->belongsTo('App\Models\Return_good_stock', 'customer_id', 'customer_id')->select('total_bo');
  }

  public function customer()
  {
    return $this->belongsTo('App\Models\Customer', 'customer_id');
  }

  public function sales_register_details_for_inventory_filter()
  {
    return $this->hasMany('App\Models\Sales_register_details', 'sales_register_id')->select('inventory_id');
  }
}
