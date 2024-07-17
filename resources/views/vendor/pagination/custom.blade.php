@if ($paginator->hasPages())
    <div class="col">
        <div class="demo-inline-spacing">
            <!-- Basic Pagination -->
            <nav aria-label="Page navigation">
                <ul class="pagination">
                    {{-- İlk Sayfa Linki --}}
                    @if ($paginator->onFirstPage())
                        <li class="page-item first disabled" aria-disabled="true" aria-label="@lang('pagination.first')">
                            <span class="page-link" aria-hidden="true"><i class="tf-icon bx bx-chevrons-left"></i></span>
                        </li>
                    @else
                        <li class="page-item first">
                            <a class="page-link" href="{{ $paginator->url(1) }}" aria-label="@lang('pagination.first')">
                                <i class="tf-icon bx bx-chevrons-left"></i>
                            </a>
                        </li>
                    @endif

                    {{-- Önceki Sayfa Linki --}}
                    @if ($paginator->onFirstPage())
                        <li class="page-item prev disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">
                            <span class="page-link" aria-hidden="true"><i class="tf-icon bx bx-chevron-left"></i></span>
                        </li>
                    @else
                        <li class="page-item prev">
                            <a class="page-link" href="{{ $paginator->previousPageUrl() }}" aria-label="@lang('pagination.previous')">
                                <i class="tf-icon bx bx-chevron-left"></i>
                            </a>
                        </li>
                    @endif

                    {{-- Pagination Linkleri --}}
                    @foreach ($elements as $element)
                        {{-- "Three Dots" Separator --}}
                        @if (is_string($element))
                            <li class="page-item disabled" aria-disabled="true"><span class="page-link">{{ $element }}</span></li>
                        @endif

                        {{-- Array Of Links --}}
                        @if (is_array($element))
                            @foreach ($element as $page => $url)
                                @if ($page == $paginator->currentPage())
                                    <li class="page-item active" aria-current="page"><span class="page-link">{{ $page }}</span></li>
                                @else
                                    <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                                @endif
                            @endforeach
                        @endif
                    @endforeach

                    {{-- Sonraki Sayfa Linki --}}
                    @if ($paginator->hasMorePages())
                        <li class="page-item next">
                            <a class="page-link" href="{{ $paginator->nextPageUrl() }}" aria-label="@lang('pagination.next')">
                                <i class="tf-icon bx bx-chevron-right"></i>
                            </a>
                        </li>
                    @else
                        <li class="page-item next disabled" aria-disabled="true" aria-label="@lang('pagination.next')">
                            <span class="page-link" aria-hidden="true"><i class="tf-icon bx bx-chevron-right"></i></span>
                        </li>
                    @endif

                    {{-- Son Sayfa Linki --}}
                    @if ($paginator->hasMorePages())
                        <li class="page-item last">
                            <a class="page-link" href="{{ $paginator->url($paginator->lastPage()) }}" aria-label="@lang('pagination.last')">
                                <i class="tf-icon bx bx-chevrons-right"></i>
                            </a>
                        </li>
                    @else
                        <li class="page-item last disabled" aria-disabled="true" aria-label="@lang('pagination.last')">
                            <span class="page-link" aria-hidden="true"><i class="tf-icon bx bx-chevrons-right"></i></span>
                        </li>
                    @endif
                </ul>
            </nav>
            <!--/ Basic Pagination -->
        </div>
    </div>
@endif