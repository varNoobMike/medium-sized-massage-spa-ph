<nav aria-label="breadcrumb">
    <ol class="breadcrumb mb-0 text-muted">
        @foreach ($crumbs as $crumb)
            @if (!empty($crumb['url']))
                <li class="breadcrumb-item">
                    <a href="{{ $crumb['url'] }}" class="text-dark text-decoration-none">     
                        <span class="small">
                            {{ $crumb['title'] }}
                        </span>
                    </a>
                </li>
            @else
                <li class="breadcrumb-item active" aria-current="page">
                    <span class="small">
                        {{ $crumb['title'] }}
                    </span>
                </li>
            @endif
        @endforeach
    </ol>
</nav>
