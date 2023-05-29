<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventory_draft_details extends Model
{
    use HasFactory;

    protected $fillable = [
        'inventory_draft_id',
        'inventory_id',
        'remaining_quantity',
        'delivered_quantity',
        'bo',
        'rgs',
        'unit_price',
        'sku_type',
    ];


    public function inventory()
    {
        return $this->belongsTo('App\Models\Inventory', 'inventory_id');
    }
}
