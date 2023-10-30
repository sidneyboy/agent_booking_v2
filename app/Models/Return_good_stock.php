<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Return_good_stock extends Model
{
    use HasFactory;

    protected $fillable = [
        'pcm_number',
        'total_bo',
        'agent_id',
        'customer_id',
        'principal_id',
        'status',
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
