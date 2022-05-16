<ul class="c-sidebar-nav">
    @if(isset($appMenus['sidebar menu']))
        @foreach($appMenus['sidebar menu'] as $menuel)
            @if($menuel['slug'] === 'link')
                <li class="c-sidebar-nav-item">
                    <a class="c-sidebar-nav-link" href="{{ url($menuel['href']) }}">
                        @if($menuel['hasIcon'] === true)
                            @if($menuel['iconType'] === 'coreui')
                                <i class="{{ $menuel['icon'] }} c-sidebar-nav-icon"></i>
                            @endif
                        @endif
                        {{$menuel['name']}}
                    </a>
                </li>
            @elseif($menuel['slug'] === 'dropdown')
                <?php renderDropdown($menuel) ?>
            @elseif($menuel['slug'] === 'title')
                <li class="c-sidebar-nav-title">
                    @if($menuel['hasIcon'] === true)
                        @if($menuel['iconType'] === 'coreui')
                            <i class="{{ $menuel['icon'] }} c-sidebar-nav-icon"></i>
                        @endif
                    @endif
                    {{$menuel['name']}}
                </li>
            @endif
        @endforeach
    @endif
</ul>
<button class="c-sidebar-minimizer c-class-toggler" type="button" data-target="_parent"
        data-class="c-sidebar-minimized"></button>
