<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class Category extends Model
{
    protected $fillable = [
        'name',
        'status_id'
    ];

    public function product(): HasMany 
    {
        return $this->hasMany(Product::class);
    }

    public function status(): BelongsTo
{
    return $this->belongsTo(Status::class);
}

}   
