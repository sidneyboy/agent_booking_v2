<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Collection extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'principal',
        'total_amount',
        'amount_paid',
        'mode_of_transaction',
        'dr',
        'sku_type',
        'balance',
        'exported',
        'remarks',
        'total_bo',
        'or_number',
        'total_rgs',
        'date',
        'time',
    ];

    public function customer()
    {
        return $this->belongsTo('App\Models\Customer', 'customer_id');
    }

    public function collection_details_first()
    {
        return $this->hasOne('App\Models\Collection_details', 'collection_id')->orderBy('id')->limit(1);
    }

    public function collection_details()
    {
        return $this->hasMany('App\Models\Collection_details', 'collection_id')->skip(1)->take(PHP_INT_MAX);
    }
}
