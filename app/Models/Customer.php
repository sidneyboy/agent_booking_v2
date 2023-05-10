<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

     protected $fillable = [
        'id',
        'location_id',
        'store_name',
        'credit_limit',
        'allowed_number_of_sales_order',
        'special_account',
        'mode_of_transaction',
        'status',
        'longitude',
        'latitude',
        'kob',
        'contact_person',
        'contact_number',
        'detailed_address',
    ];

    public function location()
    {
      return $this->belongsTo('App\Models\Location', 'location_id');
    }

    public function customer_principal_price()
    {
      return $this->hasMany('App\Models\Customer_principal_price', 'customer_id');
    }

    public function customer_principal_code()
    {
      return $this->hasMany('App\Models\Customer_principal_code', 'customer_id');
    }

    public function customer_principal_discount()
    {
      return $this->hasMany('App\Models\Customer_principal_discount', 'customer_id');
    }
}
