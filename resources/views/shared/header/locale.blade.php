<li class="c-header-nav-item dropdown">
    <a class="c-header-nav-link" href="#" data-toggle="dropdown" role="button" aria-haspopup="true"
       aria-expanded="false">
        <svg class="c-icon" fill="black">
            <use xlink:href="{{ url('/icons/sprites/free.svg#cil-globe-alt') }}"></use>
        </svg>
    </a>
    <div class="dropdown-menu dropdown-menu-right py-0">
        @foreach ($locales as $locale)
            @if ($locale['code'] == session()->get('locale'))
                <a class="dropdown-item" href="{{ url('lang/' . $locale['code']) }}">
                    <span>{{ $locale['name'] }}</span>
                    <svg class="c-icon d-inline-block ml-auto" fill="black">
                        <use xlink:href="{{ url('/icons/sprites/free.svg#cil-check-alt') }}"></use>
                    </svg>
                </a>
            @else 
                <a class="dropdown-item" href="{{ url('lang/' . $locale['code']) }}">
                    <span>{{ $locale['name'] }}</span>
                </a>
            @endif
        @endforeach
    </div>
</li>
