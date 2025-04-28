<?php

namespace App\Models;

use App\Models\Sexo;
use App\Models\Talla;
use App\Models\Imagen;
use App\Models\Oferta;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Producto extends Model
{
    use HasFactory;

    protected $fillable = [
        'titulo',
        'codigo_barras',
        'precio',
        'marca',
        'categoria_id',
        'stock',
        'descripcion',
        'disponible'
    ];

    // Relacion con imagenes
    public function imagenes()
    {
        return $this->hasMany(Imagen::class);
    }

    // Relacion con sexo
    public function sexos()
    {
        return $this->belongsToMany(Sexo::class, 'producto_sexo');
    }

    // Relacion con talla
    public function tallas()
    {
        return $this->belongsToMany(Talla::class, 'producto_talla');
    }

    public function ofertas()
    {
        return $this->belongsToMany(Oferta::class, 'producto_oferta');
    }

}
