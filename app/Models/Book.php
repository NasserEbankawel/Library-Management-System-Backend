<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;


class Book extends Model
{
    use HasFactory;

    protected $guarded = [];  

    public function cartitems(): HasMany
    {
        return $this->hasMany(Cartitem::class);
        
    }

    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class);
        
    }

    public function authors(): BelongsToMany
    {
        return $this->belongsToMany(Author::class, 'book_author');
    }



 
}

