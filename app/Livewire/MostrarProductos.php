<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Producto;
use Livewire\WithPagination;

class MostrarProductos extends Component
{
    use WithPagination;

    // opcional: para que use los estilos Tailwind
    protected $paginationTheme = 'tailwind';

    public function render()
    {
        $productos = Producto::with('ofertas')    // ← eager-load
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('livewire.mostrar-productos', [
            'productos' => $productos
        ]);
    }
}
