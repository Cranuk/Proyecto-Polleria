<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    // Si el nombre de la tabla no sigue la convención (plural en inglés), especifícalo:
    protected $table = 'products';

    // Definir relación con el modelo Sale
    public function sales(){
        return $this->hasMany(Sale::class, 'product_id'); // 'product_id' es la clave foránea en la tabla 'sales'
    }

    public function offers(){
        return $this->hasMany(Offer::class);
    }
}
