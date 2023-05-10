<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer_principal_discount extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'principal_id',
        'discount_name',
        'discount_rate',
    ];
}
