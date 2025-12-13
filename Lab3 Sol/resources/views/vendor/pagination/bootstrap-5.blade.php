@if ($paginator->hasPages())
  <nav>
    <ul class="pagination">
      <li class="page-item {{ $paginator->onFirstPage() ? 'disabled' : '' }}">
        <a class="page-link" href="{{ $paginator->previousPageUrl() }}">&laquo;</a>
      </li>

      @foreach ($elements as $element)
        @if (is_array($element))
          @foreach ($element as $page => $url)
            <li class="page-item {{ $page == $paginator->currentPage() ? 'active' : '' }}">
              <a class="page-link" href="{{ $url }}">{{ $page }}</a>
            </li>
          @endforeach
        @endif
      @endforeach

      <li class="page-item {{ !$paginator->hasMorePages() ? 'disabled' : '' }}">
        <a class="page-link" href="{{ $paginator->nextPageUrl() }}">&raquo;</a>
      </li>
    </ul>
  </nav>
@endif
