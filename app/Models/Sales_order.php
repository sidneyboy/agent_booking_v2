<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sales_order extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'principal_id',
        'mode_of_transaction',
        'sku_type',
        'total_amount',
        'agent_id',
        'status',
        'exported',
        'amount_paid',
        'sales_order_number',
    ];

    
    public function sales_order_details()
    {
        return $this->hasMany('App\Models\Sales_order_details', 'sales_order_id');
    }

    public function principal()
    {
        return $this->belongsTo('App\Models\Principal', 'principal_id');
    }

    public function customer()
    {
        return $this->belongsTo('App\Models\Customer', 'customer_id');
    }

    public function agent()
    {
        return $this->belongsTo('App\Models\Agent_user', 'agent_id','agent_id');
    }
}
