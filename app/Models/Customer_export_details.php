<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer_export_details extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_export_id',
        'customer_id',
        'principal_id',
        'price_level',
    ];
}
