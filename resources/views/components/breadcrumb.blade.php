<nav aria-label="breadcrumb" class="mt-3">
    <ol class="breadcrumb">
        @foreach($breadcrumb as $row)
            <li class="breadcrumb-item {{ $row['url'] === false ? 'active' : '' }}" {{ $row['url'] === false ? 'aria-current="page"' : '' }}>
                @if($row['url'] !== false)
                    <a href="{{ $row['url'] }}">{{ $row['title'] }}</a>
                @else
                    {{ $row['title'] }}
                @endif
            </li>
        @endforeach
    </ol>
</nav>
