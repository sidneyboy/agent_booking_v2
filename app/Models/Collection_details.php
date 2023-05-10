<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Collection_details extends Model
{
    use HasFactory;

    protected $fillable = [
        'collection_id',
        'image',
       'cash',
       'cash_add_refer',
       'cheque',
       'cheque_add_refer',
       'less_refer',
       'specify',
       'remarks',
       'balance',
    ];
}
