<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    public $timestamps = false;
    
    protected $fillable = [
        'sale_date',
        'sale_value',
    ];
}
