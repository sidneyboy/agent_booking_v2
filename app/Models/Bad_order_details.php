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
    

    public function inventory()
    {
        return $this->belongsTo('App\Models\Inventory', 'inventory_id');
    }

    public function pcm()
    {
        return $this->belongsTo('App\Models\Bad_order', 'bad_order_id');
    }
}
