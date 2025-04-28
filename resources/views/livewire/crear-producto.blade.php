<form class="md:w-1/2 space-y-5" wire:submit.prevent='crearProducto'>   
    {{-- Titulo Producto --}}
    <div>
        <x-input-label for="titulo" :value="__('Titulo Producto')" />
        <x-text-input 
            id="titulo" 
            class="block mt-1 w-full" 
            type="text" 
            wire:model="titulo"
            placeholder="Titulo Producto"
            />

        @error('titulo')
            <livewire:mostrar-alerta :message="$message" />
        @enderror
    </div>

    {{-- Codigo de barras --}}
    <div>
        <x-input-label for="codigo_barras" :value="__('Código de Barras')" />
        <x-text-input 
            id="codigo_barras" 
            class="block mt-1 w-full" 
            type="text"
            wire:model="codigo_barras"
            placeholder="Escanea o ingresa el código de barras"
            />
        @error('codigo_barras')
        <livewire:mostrar-alerta :message="$message" />
        @enderror
    </div>

    {{-- Precio --}}
    <div>
        <x-input-label for="precio" :value="__('Precio Producto')" />
        <x-text-input 
            id="precio" 
            class="block mt-1 w-full" 
            type="number" 
            step="0.01"
            wire:model="precio" 
        />
        @error('precio')
        <livewire:mostrar-alerta :message="$message" />
        @enderror
    </div>

    {{-- Categoría --}}
    <div>
        <x-input-label for="categoria" :value="__('Categoría')" />
        <select 
            id="categoria" 
            wire:model="categoria_id" 
            class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 w-full">
            <option>-- Seleccione una categoría --</option>
            @foreach($categorias as $categoria)
                <option value="{{ $categoria->id }}">{{ $categoria->nombre }}</option>
            @endforeach
        </select>
        @error('categoria_id')
        <livewire:mostrar-alerta :message="$message" />
        @enderror
    </div>

    {{-- Marca Producto --}}
    <div>
        <x-input-label for="marca" :value="__('Marca Producto')" />
        <x-text-input 
            id="marca" 
            class="block mt-1 w-full" 
            type="text"
            wire:model="marca"
            placeholder="Marca: ej. Nike, Adidas, Puma"
        />
        @error('marca')
        <livewire:mostrar-alerta :message="$message" />
        @enderror
    </div>

    {{-- Genero --}}
    <div>
        <x-input-label for="sexoSeleccionado" :value="__('Genero')" />
        <select 
            id="sexoSeleccionado" 
            wire:model="sexoSeleccionado"
            class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 w-full"
            >
            <option class="ml-2 text-gray-700" value="">Seleccionar género(s)…</option>
            @foreach($sexos as $sexo)
                <option value="{{ $sexo->id }}">{{ $sexo->nombre }}</option>
            @endforeach
        </select>
        @error('sexoSeleccionado')
        <livewire:mostrar-alerta :message="$message" />
        @enderror
    </div>

    {{-- Talla --}}
    <div>
        <x-input-label :value="__('Talla(s)')" />
    
        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4 mt-2">
            @foreach($tallas as $talla)
            <label class="block cursor-pointer">
                {{-- ocultamos el checkbox real --}}
                <input
                type="checkbox"
                wire:model="tallasSeleccionadas"
                value="{{ $talla->id }}"
                class="sr-only peer"
                />
        
                {{-- Tarjeta de seleccionar --}}
                <div
                class="flex items-center justify-center h-12 px-3 border rounded-lg
                        peer-checked:border-blue-800 peer-checked:bg-blue-50
                        hover:border-gray-400 transition"
                >
                <span class="text-gray-700 peer-checked:text-blue-600">
                    {{ $talla->nombre }}
                </span>
                </div>
            </label>
            @endforeach
        </div>
    
        @error('tallasSeleccionadas')
            <livewire:mostrar-alerta :message="$message" />
        @enderror
    </div>
    
    {{-- Stock del Producto --}}
    <div>
        <x-input-label for="stock" :value="__('Stock Producto')" />
        <x-text-input 
            id="stock" 
            class="block mt-1 w-full" 
            type="number" 
            wire:model="stock"
            min="0" 
            step="1"
            placeholder="Stock del producto ej. 1,2,3"
        />
        @error('stock')
        <livewire:mostrar-alerta :message="$message" />
        @enderror
    </div>

    {{-- Descripcion Producto --}}
    <div>
        <x-input-label for="descripcion" :value="__('Descripcion Producto')" />
        <textarea
            id="descripcion"
            wire:model="descripcion"
            placeholder="Descripcion general del producto"
            class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 w-full h-72"
        ></textarea>
        @error('descripcion')
        <livewire:mostrar-alerta :message="$message" />
        @enderror
    </div>

    <div 
        wire:ignore 
        x-data 
        x-init="
            // Registrar el plugin de imagen para mostrar preview
            FilePond.registerPlugin(FilePondPluginImagePreview);
            
            // Crear la instancia del input FilePond
            const pond = FilePond.create($refs.input);
            
            pond.setOptions({
                allowMultiple: true,
                maxFiles: 5,
                acceptedFileTypes: ['image/*'],
                labelIdle: 'Arrastra tus imágenes aquí o haz clic para seleccionar (máximo 5)',
                server: {
                    process: (fieldName, file, metadata, load, error, progress, abort) => {
                        @this.upload('imagenes', file, load, error, progress);
                    },
                    revert: (filename, load) => {
                        @this.removeUpload('imagenes', filename, load);
                    }
                }
            });
        "
        class="w-full max-w-xl mx-auto my-6"
    >
        <input type="file" x-ref="input" wire:model="imagenes" name="imagenes[]" multiple>
        
        <div class="mt-4" wire:loading wire:target="imagenes">
            Subiendo imágenes...
        </div>

        @if(count($imagenes ?? []))
            <div class="mt-4">
                <h3 class="text-green-700 font-bold">Imágenes cargadas:</h3>
                <ul>
                    @foreach($imagenes as $key => $img)
                        <li>Imagen {{ $key + 1 }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>

    {{-- Estado de Disponibilidad --}}
    <div>
        <x-input-label :value="__('Disponibilidad en web')" />
        <label class="flex items-center cursor-pointer">
            <div class="relative">
                <input 
                    type="checkbox" 
                    wire:model="disponible" 
                    class="sr-only peer"
                    >
                <div class="w-10 h-5 bg-gray-300 rounded-full peer-checked:bg-blue-600"></div>
                <div class="absolute left-1 top-1 w-3 h-3 bg-white rounded-full transition peer-checked:translate-x-5"></div>
            </div>
            <span class="ml-2 text-gray-700">Disponible</span>
        </label>
        @error('disponible')
        <livewire:mostrar-alerta :message="$message" />
        @enderror
    </div>

    {{-- ######################## --}}
    {{-- sección dinámcia de ofertas --}}
    <div class="border p-4 rounded-lg">
        <div class="flex justify-between items-center mb-2">
        <h3 class="font-semibold">Ofertas del Producto</h3>
        <button 
            type="button"
            wire:click.prevent="addOferta"
            class="px-3 py-1 bg-green-600 hover:bg-green-900 text-white rounded"
        >
            + Agregar Oferta
        </button>
        </div>

        @foreach($ofertasData as $i => $of)
        <div class="grid grid-cols-3 gap-4 mb-4 items-end">
            <div>
            <x-input-label :for="'precio_oferta.'.$i" :value="__('Precio Oferta')" />
            <x-text-input 
                :id="'precio_oferta.'.$i" 
                wire:model="ofertasData.{{ $i }}.precio_oferta" 
                type="number" step="0.01"
                class="mt-1 w-full"
            />
            @error("ofertasData.$i.precio_oferta") 
                <livewire:mostrar-alerta :message="$message" /> 
            @enderror
            </div>

            <div>
            <x-input-label :for="'stock_oferta.'.$i" :value="__('Stock Oferta')" />
            <x-text-input 
                :id="'stock_oferta.'.$i" 
                wire:model="ofertasData.{{ $i }}.stock_oferta" 
                type="number"
                class="mt-1 w-full"
            />
            @error("ofertasData.$i.stock_oferta") 
                <livewire:mostrar-alerta :message="$message" /> 
            @enderror
            </div>

            <button 
            type="button"
            wire:click.prevent="removeOferta({{ $i }})"
            class="px-3 py-1 bg-red-600 text-white rounded"
            >
            Eliminar
            </button>
        </div>
        @endforeach
    </div>
    {{-- ######################## --}}

    <x-primary-button>
        Crear Producto
    </x-primary-button>
</form>