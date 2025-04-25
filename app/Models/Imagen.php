<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Imagen extends Model
{
    use HasFactory;

    // Indicar el nombre correcto de la tabla.
    protected $table = 'imagenes';

    protected $fillable = ['producto_id', 'ruta'];

    public function producto()
    {
        return $this->belongsTo(Producto::class);
    }
}
