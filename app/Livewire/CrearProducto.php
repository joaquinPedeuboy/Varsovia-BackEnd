<?php

namespace App\Livewire;

use App\Models\Sexo;
use App\Models\Imagen;
use Livewire\Component;
use App\Models\Producto;
use App\Models\Talla;
use Livewire\WithFileUploads;

class CrearProducto extends Component
{
    use WithFileUploads;

    public $titulo;
    public $codigo_barras;
    public $precio;
    public $categoria_id;
    public $marca;
    public $sexoSeleccionado;
    public $tallasSeleccionadas = [];
    public $stock;
    public $descripcion;
    public $disponible = false;
    public $imagenes = []; // Aquí se guardarán los archivos subidos

    protected $rules = [
        'titulo'        => 'required|string',
        'codigo_barras' => 'required|string|regex:/^[0-9]{6,13}$/',
        'precio'        => 'required|numeric',
        'categoria_id'  => 'required',
        'marca'         => 'required|string',
        'sexoSeleccionado' => 'required|exists:sexos,id',
        'tallasSeleccionadas'        => 'required|array|min:1',
        'tallasSeleccionadas.*' => 'exists:tallas,id',
        'stock'         => 'required|numeric',
        'descripcion'   => 'required',
        'disponible'    => 'boolean',
        'imagenes.*'    => 'image|max:3072',
        'imagenes'      => 'required|array|min:1',
        
    ];

    protected $messages = [
        'imagenes.required' => 'Debes subir al menos una imagen.',
        'imagenes.min' => 'Debes subir al menos una imagen.',
        'imagenes.*.image' => 'Cada archivo debe ser una imagen.',
        'imagenes.*.max' => 'Cada imagen no debe superar los 3MB.',
    ];
    

    public function crearProducto()
    {
        $datos = $this->validate();

        $datos['disponible'] = $this->disponible ? 1 : 0;

         // Crear el producto
        $producto = Producto::create([
            'titulo'        => $datos['titulo'],
            'codigo_barras' => $datos['codigo_barras'],
            'precio'        => $datos['precio'],
            'categoria_id'  => $datos['categoria_id'],
            'marca'         => $datos['marca'],
            'stock'         => $datos['stock'],
            'descripcion'   => $datos['descripcion'],
            'disponible'    => $datos['disponible'],
        ]);

        // sincronizar pivot producto_sexo
        $producto->sexos()->sync([$this->sexoSeleccionado]);

        // sincronizar pivot producto_talla
        $producto->tallas()->sync($this->tallasSeleccionadas);

        // Guardamos las imágenes en la tabla separada
        foreach ($this->imagenes as $imagen) {
            // Guardamos la imagen en la carpeta 'productos' en el disco 'public'
            $ruta = $imagen->store('public/productos', 'public');
            $nombre_imagen = str_replace('public/productos/', '', $ruta);

            // Creamos el registro en la tabla producto_imagenes
            Imagen::create([
                'producto_id' => $producto->id,
                'ruta'        => $nombre_imagen,
            ]);
        }

        // Reinicia las propiedades del componente
        $this->reset([
            'titulo',
            'codigo_barras', 
            'precio', 
            'categoria_id', 
            'marca',
            'sexoSeleccionado', 
            'tallasSeleccionadas', 
            'stock', 
            'descripcion', 
            'disponible', 
            'imagenes'
        ]);
        session()->flash('message', '¡Producto creado con éxito!');

        // Redirrecionar al usuario
        return redirect()->route('productos.index');
    }

    public function render()
    {
        $categorias = \App\Models\Categoria::all();
        $sexos      = Sexo::all();
        $tallas      = Talla::all();

        return view('livewire.crear-producto', compact('categorias', 'sexos', 'tallas'));
    }
}
