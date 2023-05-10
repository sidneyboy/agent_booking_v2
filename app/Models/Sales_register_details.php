<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sales_register_details extends Model
{
    use HasFactory;

    protected $fillable = [
        'sales_register_id',
        'inventory_id',
        'delivered_quantity',
        'unit_price',
        'sku_type',
    ];

    public function inventory()
    {
      return $this->belongsTo('App\Models\Inventory', 'inventory_id');
    }
}

