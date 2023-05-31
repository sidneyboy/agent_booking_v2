<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bad_order extends Model
{
    use HasFactory;

    protected $fillable = [
        'pcm_number',
        'total_bo',
        'agent_id',
        'customer_id',
        'principal_id',
        'sales_register_id',
    ];

    public function customer()
    {
        return $this->belongsTo('App\Models\Customer', 'customer_id');
    }

    public function principal()
    {
        return $this->belongsTo('App\Models\Principal', 'principal_id');
    }
}
