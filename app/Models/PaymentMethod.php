<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentMethod extends Model
{
    use HasFactory;

    // Si el nombre de la tabla no sigue la convención (plural en inglés), especifícalo:
    protected $table = 'payment_method';

    public function sales()
    {
        return $this->hasMany(Sale::class, 'payment_id'); // 'payment_id' es la clave foránea en la tabla 'sales'
    }
}
