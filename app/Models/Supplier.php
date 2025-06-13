<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    protected $fillable = [
        'name',
        'email',
        'phone',
        'observation'
    ];

    public function status()
    {
        return $this->belongsTo(Status::class);
    }
}
