@if ($paginator->hasPages())
<nav role="navigation" aria-label="Pagination Navigation" class="flex items-center justify-center my-6">
    <ul class="inline-flex items-center -space-x-px">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <li>
                <span class="px-3 py-2 ml-0 leading-tight text-gray-400 bg-white border border-gray-300 rounded-l-lg cursor-not-allowed">
                ‹
                </span>
            </li>
        @else
            <li>
                <button wire:click="previousPage"
                        class="px-3 py-2 ml-0 leading-tight text-gray-500 bg-white border border-gray-300 rounded-l-lg hover:bg-gray-100 hover:text-gray-700"
                        aria-label="Página anterior">
                ‹
                </button>
            </li>
        @endif

        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
                <li>
                <span class="px-3 py-2 leading-tight text-gray-500 bg-white border border-gray-300">
                    {{ $element }}
                </span>
                </li>
            @endif

            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <li>
                        <span aria-current="page"
                                class="px-3 py-2 leading-tight text-white bg-blue-600 border border-blue-600">
                            {{ $page }}
                        </span>
                        </li>
                    @else
                        <li>
                        <button wire:click="gotoPage({{ $page }})"
                                class="px-3 py-2 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700"
                                aria-label="Ir a la página {{ $page }}">
                            {{ $page }}
                        </button>
                        </li>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <li>
                <button wire:click="nextPage"
                        class="px-3 py-2 leading-tight text-gray-500 bg-white border border-gray-300 rounded-r-lg hover:bg-gray-100 hover:text-gray-700"
                        aria-label="Página siguiente">
                ›
                </button>
            </li>
        @else
            <li>
                <span class="px-3 py-2 leading-tight text-gray-400 bg-white border border-gray-300 rounded-r-lg cursor-not-allowed">
                ›
                </span>
            </li>
        @endif
    </ul>
</nav>
@endif
