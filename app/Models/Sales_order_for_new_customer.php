<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sales_order_for_new_customer extends Model
{
    use HasFactory;

    protected $fillable = [
        'principal_id',
        'agent_id',
        'mode_of_transaction',
        'sku_type',
        'status',
        'exported',
        'sales_order_number',
        'total_amount',
    ];

    public function sales_order_details()
    {
        return $this->hasMany('App\Models\Sales_order_for_new_customer_details', 'sales_order_new_id');
    }

    public function sales_order_new_customer()
    {
        return $this->hasOne('App\Models\Sales_order_new_customer', 'sales_order_id');
    }

    public function principal()
    {
        return $this->belongsTo('App\Models\Principal', 'principal_id');
    }

    // public function customer()
    // {
    //     return $this->belongsTo('App\Models\Customer', 'customer_id');
    // }

    public function agent()
    {
        return $this->belongsTo('App\Models\Agent_user', 'agent_id', 'id');
    }
}
