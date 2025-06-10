@if ($paginator->hasPages())
    <nav class="pagination-container" aria-label="Pagination Navigation">
        <div class="pagination-info d-none d-md-block">
            <span class="text-muted">
                Trang {{ $paginator->currentPage() }} / {{ $paginator->lastPage() }}
                ({{ $paginator->total() }} kết quả)
            </span>
        </div>
        
        <ul class="pagination pagination-custom">
            {{-- First Page Link --}}
            @if ($paginator->onFirstPage())
                <li class="page-item disabled" aria-disabled="true">
                    <span class="page-link page-link-first" aria-hidden="true">
                        <i class="fas fa-angle-double-left"></i>
                    </span>
                </li>
            @else
                <li class="page-item">
                    <a class="page-link page-link-first" href="{{ $paginator->url(1) }}" aria-label="First">
                        <i class="fas fa-angle-double-left"></i>
                    </a>
                </li>
            @endif

            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">
                    <span class="page-link" aria-hidden="true">
                        <i class="fas fa-chevron-left"></i>
                    </span>
                </li>
            @else
                <li class="page-item">
                    <a class="page-link" href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="@lang('pagination.previous')">
                        <i class="fas fa-chevron-left"></i>
                    </a>
                </li>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <li class="page-item disabled d-none d-md-block" aria-disabled="true">
                        <span class="page-link">{{ $element }}</span>
                    </li>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="page-item active" aria-current="page">
                                <span class="page-link">{{ $page }}</span>
                            </li>
                        @else
                            <li class="page-item d-none d-md-block">
                                <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                            </li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Mobile Current/Total --}}
            <li class="page-item d-md-none">
                <span class="page-link page-link-info">
                    {{ $paginator->currentPage() }}/{{ $paginator->lastPage() }}
                </span>
            </li>

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li class="page-item">
                    <a class="page-link" href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')">
                        <i class="fas fa-chevron-right"></i>
                    </a>
                </li>
            @else
                <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.next')">
                    <span class="page-link" aria-hidden="true">
                        <i class="fas fa-chevron-right"></i>
                    </span>
                </li>
            @endif

            {{-- Last Page Link --}}
            @if ($paginator->hasMorePages())
                <li class="page-item">
                    <a class="page-link page-link-last" href="{{ $paginator->url($paginator->lastPage()) }}" aria-label="Last">
                        <i class="fas fa-angle-double-right"></i>
                    </a>
                </li>
            @else
                <li class="page-item disabled" aria-disabled="true">
                    <span class="page-link page-link-last" aria-hidden="true">
                        <i class="fas fa-angle-double-right"></i>
                    </span>
                </li>
            @endif
        </ul>
    </nav>
@endif