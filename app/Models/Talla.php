<?php

namespace App\Models;

use App\Models\Producto;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Talla extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'nombre'
    ];

    public function producto()
    {
        return $this->belongsToMany(Producto::class, 'producto_talla');
    }
}
