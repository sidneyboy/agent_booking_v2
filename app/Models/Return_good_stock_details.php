<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Return_good_stock_details extends Model
{
    use HasFactory;

    protected $fillable = [
        'rgs_id',
        'inventory_id',
        'quantity',
        'unit_price',
    ];
}
