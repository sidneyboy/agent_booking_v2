<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
    	'sku_code',
    	'description',
    	'sku_type',
    	'principal_id',
		'uom',
    	'running_balance',
    	'price_1',
    	'price_2',
    	'price_3',
    	'price_4',
    ];
}
