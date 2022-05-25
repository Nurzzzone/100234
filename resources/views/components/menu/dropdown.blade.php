<li class="c-sidebar-nav-dropdown">
    <span class="c-sidebar-nav-dropdown-toggle">
        <i class="{{ $icon }} c-sidebar-nav-icon"></i>
        <span>{{ $name }}</span>
    </span>
    <ul class="c-sidebar-nav-dropdown-items">
        @foreach($children as $child)
            <x-menu.link name="{{ $child['name'] }}"
                href="{{ $child['href'] }}"></x-menu.link>
        @endforeach
    </ul>
</li>