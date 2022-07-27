<ul class="c-sidebar-nav" id="sidebar-menu">
    <li class="c-sidebar-nav-item py-2" style="padding: 0.75rem 1rem;">
        <v-sidebar-search></v-sidebar-search>
    </li>
    @isset($appMenus['sidebar menu'])
        <v-sidebar-menu :menu-elements="{{ json_encode($appMenus['sidebar menu'], 286) }}"></v-sidebar-menu>
    @endisset
</ul>

<button class="c-sidebar-minimizer c-class-toggler" 
        type="button" 
        data-target="_parent"
        data-class="c-sidebar-minimized">
</button>
