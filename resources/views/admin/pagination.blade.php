@if ($paginator->hasPages())
 <nav aria-label="Page navigation example">
  <ul class="pagination">
    @if ($paginator->onFirstPage())
        <!--<li class="page-item"><span page-link disabled></span></li>-->
    @else
        <li class="page-item"><a href="{{ $paginator->previousPageUrl() }}" rel="prev" class="page-link">Prev</a></li>
    @endif

        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
                <li class="page-item"><span class="page-link"><span>{{ $element }}</span></span></li>
            @endif

            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                         <li class="page-item active"><span>{{ $page }}</span></li>
                    @else
                        <li class="page-item"><a href="{{ $url }}" class="page-link">{{ $page }}</a></li>
                    @endif
                @endforeach
            @endif
        @endforeach

    @if ($paginator->hasMorePages())
       <li class="page-item"> <a class="page-link" href="{{ $paginator->nextPageUrl() }}" rel="next">Next</a></li>
    @else
        <!--<li class="page-item"> <span page-link disabled></span></li>-->
    @endif 
    </ul>
</div>
@endif