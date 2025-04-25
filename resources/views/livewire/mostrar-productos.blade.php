<div>
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">

        @forelse ($productos as $producto)
            <div class="p-6 bg-white border-b border-gray-200 md:flex md:justify-between md:items-center">
                <div class="space-y-2">
                    <a href="#" class="text-xl font-bold">
                        {{ $producto->titulo}}
                    </a>
                    <p class="text-sm text-gray-600">Stock: <span class="text-slate-900 font-black">{{ $producto->stock }}</span> unidades</p>
                    <p class="text-sm text-gray-600">Precio: <span class="text-green-600 font-bold">${{ $producto->precio }}</span></p>
                    <p class="text-sm text-gray-600">Disponible en web: 
                        @if ($producto->disponible)
                            <span class="text-green-600 font-bold">Disponible</span>
                        @else
                            <span class="text-red-600 font-bold">No Disponible</span>
                        @endif
                    </p>
                </div>

                <div class="flex flex-col md:flex-row items-stretch gap-3 mt-5 md:mt-0">
                    <a 
                        href="#"
                        class="bg-yellow-500 hover:bg-yellow-900 py-2 px-4 rounded-lg text-white uppercase font-bold flex gap-1 justify-center"
                    >
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                        </svg>
                        Editar
                    </a>

                    <a 
                        href="#"
                        class="bg-red-600 hover:bg-red-900 py-2 px-4 rounded-lg text-white uppercase font-bold flex gap-1 justify-center"
                    >
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                        </svg>
                        Eliminar
                    </a>
                </div>
            </div>
        @empty
            <p class="p-3 text-center text-sm text-gray-600">No hay productos que mostrar</p>
        @endforelse
    </div>

    {{-- Links de paginación --}}
    <div class="mt-10">
        {{ $productos->links('components.pagination') }}
    </div>
</div>
