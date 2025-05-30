@if ($paginator->hasPages())
    <div class="custom-pagination">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <span class="nav-button disabled">«</span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}" class="nav-button">«</a>
        @endif

        {{-- Page Numbers --}}
        @foreach ($elements as $element)
            @if (is_string($element))
                <span class="nav-button disabled">{{ $element }}</span>
            @endif

            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <span class="nav-button active">{{ $page }}</span>
                    @else
                        <a href="{{ $url }}" class="nav-button">{{ $page }}</a>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" class="nav-button">»</a>
        @else
            <span class="nav-button disabled">»</span>
        @endif
    </div>
@endif