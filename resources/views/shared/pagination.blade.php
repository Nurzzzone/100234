<div class="row">
    <div class="col-md-12">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <span>{{ 'кол-во: '. $paginator->total() }}</span>
            </div>
            @if ($paginator->hasPages())
                <nav>
                    <ul class="pagination mb-0">
                        {{-- Previous Page Link --}}
                        @if (!$paginator->onFirstPage())
                            <li class="page-item">
                                <a class="page-link text-dark" 
                                    href="{{ $paginator->previousPageUrl() }}" 
                                    rel="prev" 
                                    aria-label="@lang('pagination.previous')">&lsaquo;</a>
                            </li>
                        @endif
                
                        {{-- Pagination Elements --}}
                        @foreach ($elements as $element)
                            {{-- "Three Dots" Separator --}}
                            @if (is_string($element))
                                <li class="page-item disabled" aria-disabled="true">
                                    <span class="page-link">{{ $element }}</span>
                                </li>
                            @endif
                
                            {{-- Array Of Links --}}
                            @if (is_array($element))
                                @foreach ($element as $page => $url)
                                    @if ($page == $paginator->currentPage())
                                        <li class="page-item active" aria-current="page">
                                            <span class="page-link bg-dark border-dark">{{ $page }}</span>
                                        </li>
                                    @else
                                        <li class="page-item">
                                            <a class="page-link text-dark" href="{{ $url }}">{{ $page }}</a>
                                        </li>
                                    @endif
                                @endforeach
                            @endif
                        @endforeach
                
                        {{-- Next Page Link --}}
                        @if ($paginator->hasMorePages())
                            <li class="page-item">
                                <a class="page-link text-dark" 
                                    href="{{ $paginator->nextPageUrl() }}" 
                                    rel="next" 
                                    aria-label="@lang('pagination.next')">&rsaquo;</a>
                            </li>
                        @endif
                    </ul>
                </nav>
            @endif
        </div>
    </div>
</div>
