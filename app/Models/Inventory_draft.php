<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventory_draft extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'principal_id',
        'sku_type',
        'sales_register_id',
        'date_delivered',
        'status',
    ];

    public function inventory_draft_details()
    {
        return $this->hasMany('App\Models\Inventory_draft_details', 'inventory_draft_id');
    }
    

    public function sales_register()
    {
        return $this->hasMany('App\Models\Sales_register', 'sales_register_id');
    }

    public function principal()
    {
        return $this->belongsTo('App\Models\Principal', 'principal_id');
    }

    public function customer()
    {
        return $this->belongsTo('App\Models\Customer', 'customer_id');
    }

}
