<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sales_order_for_new_customer_details extends Model
{
    use HasFactory;

    protected $fillable = [
        'sales_order_new_id',
        'inventory_id',
        'quantity',
        'unit_price',
        'sku_type',
    ];

    public function inventory()
    {
        return $this->belongsTo('App\Models\Inventory', 'inventory_id');
    }
}
