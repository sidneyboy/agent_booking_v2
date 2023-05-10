<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer_export extends Model
{
    use HasFactory;

    protected $fillable = [
        'store_name',
        'contact_person',
        'contact_number',
        'location',
        'location_id',
        'detailed_address',
        'longitude',
        'latitude',
        'kob',
        'status',
        'customer_id',
        'principal_id',
        'price_level',
        'mode_of_transaction',
    ];

    public function customer_export_details()
    {
        return $this->hasMany('App\Models\Customer_export_details', 'customer_export_id');
    }
}
