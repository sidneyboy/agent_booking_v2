<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bad_order_details extends Model
{
    use HasFactory;

    protected $fillable = [
        'bad_order_id',
        'inventory_id',
        'quantity',
        'unit_price',
    ];
}
