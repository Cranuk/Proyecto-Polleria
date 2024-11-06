<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplie extends Model
{
    use HasFactory;

    // Si el nombre de la tabla no sigue la convención (plural en inglés), especifícalo:
    protected $table = 'supplies';
}
