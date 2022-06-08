<ul class="c-sidebar-nav" id="sidebar-menu">
    <li class="c-sidebar-nav-item py-2" style="padding: 0.75rem 1rem;">
        <v-sidebar-search></v-sidebar-search>
    </li>
    @isset($appMenus['sidebar menu'])
        @foreach($appMenus['sidebar menu'] as $element)
            @if($element['slug'] === 'link')
                <x-menu.link name="{{ $element['name'] }}"
                     icon="{{ $element['icon'] ?? null }}"
                     href="{{ $element['href'] }}"></x-menu.link>
            @elseif($element['slug'] === 'dropdown')
                <x-menu.dropdown name="{{ $element['name'] }}"
                     icon="{{ $element['icon'] }}"
                     :children="$element['elements']"></x-menu.dropdown>
            @elseif($element['slug'] === 'title')
                <x-menu.title name="{{ $element['name'] }}"></x-menu.title>
            @endif
        @endforeach
    @endisset
</ul>

<button class="c-sidebar-minimizer c-class-toggler" 
        type="button" 
        data-target="_parent"
        data-class="c-sidebar-minimized">
</button>
