<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sales_order_new_customer extends Model
{
    use HasFactory;

    protected $fillable = [
        'sales_order_id',
        'store_name',
        'kob',
        'contact_person',
        'contact_number',
        'location',
        'location_id',
        'detailed_address',
        'longitude',
        'latitude',
        'status',
    ];
}
