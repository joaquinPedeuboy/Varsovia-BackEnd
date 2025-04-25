<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Productos') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if (session()->has('message'))
                <div class="uppercase border border-green-600 bg-green-100 text-green font-bold p-2 my-3 text-sm">
                    {{ session('message')}}
                </div>
            @endif
            
            <livewire:mostrar-productos>
        </div>
    </div>
</x-app-layout>
