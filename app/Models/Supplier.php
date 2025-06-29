<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Supplier extends Model
{
    protected $fillable = [
        'name',
        'email',
        'phone',
        'observation',
        'status_id'
    ];

    public function status(): BelongsTo
{
    return $this->belongsTo(Status::class);
}

}
