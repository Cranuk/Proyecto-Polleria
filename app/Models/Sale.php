<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;

    // Si el nombre de la tabla no sigue la convención (plural en inglés), especifícalo:
    protected $table = 'sales';

    // Definir relación con el modelo Product
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    // Definir relación con el modelo PaymentMethod
    public function paymentMethod()
    {
        return $this->belongsTo(PaymentMethod::class, 'payment_id');
    }
}
