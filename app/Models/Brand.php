<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Brand extends Model
{
    protected $fillable = [
        'name',
        'status_id'
    ];

    public function products(): HasMany 
    {
        return $this->hasMany(Product::class);
    }

     public function status(): BelongsTo
{
    return $this->belongsTo(Status::class);
}

}
