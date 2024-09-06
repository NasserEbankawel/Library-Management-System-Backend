<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class Cartitem extends Model
{
    use HasFactory;

    protected $guarded = [];  

    public function cart(): BelongsTo
    {
        return $this->belongsTo(Cart::class) ;
    }

    public function book(): BelongsTo
    {
        return $this->belongsTo(Book::class) ;
    }


    

}


