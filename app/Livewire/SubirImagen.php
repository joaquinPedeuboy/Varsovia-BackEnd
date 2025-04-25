<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;

class SubirImagen extends Component
{
    use WithFileUploads;

    // Definir la propiedad como un array vacío.
    public $imagenes = [];

    // Si deseas validar cada imagen que se suba:
    public function updatedImagenes()
    {
        $this->validate([
            'imagenes' => 'required|array|min:1',
            'imagenes.*' => 'image|max:3072',
        ]);
    }

    public function render()
    {
        return view('livewire.subir-imagen');
    }
}
