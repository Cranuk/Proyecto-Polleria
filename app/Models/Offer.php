<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    use HasFactory;

    protected $table = 'offers';

    public function product(){
        return $this->belongsTo(Product::class, "product_id");
    }

    public function sale(){
        return $this->hasMany(Sale::class, "offer_id");
    }
}
