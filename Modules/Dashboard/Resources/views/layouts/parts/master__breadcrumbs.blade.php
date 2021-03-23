<ol class="breadcrumb float-sm-right">
    @if(isset($breadcrumbs) && !empty($breadcrumbs))
        @foreach($breadcrumbs as $breadcrumb)
            <li class="breadcrumb-item {{ $loop->last ? 'active' : '' }}">
                @if($loop->last)
                    {{ $breadcrumb['name'] }}
                @else
                    <a href="{{ $breadcrumb['route'] }}">{{ $breadcrumb['name'] }}</a>
                @endif

            </li>
        @endforeach
    @endif
</ol>
