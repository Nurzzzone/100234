<header class="c-header c-header-light c-header-fixed c-header-with-subheader">
    <button class="c-header-toggler c-class-toggler d-lg-none mr-auto" type="button" data-target="#sidebar"
            data-class="c-sidebar-show">
        <span class="c-header-toggler-icon"></span>
    </button>
    <button class="c-header-toggler c-class-toggler ml-3 d-md-down-none" type="button" data-target="#sidebar"
            data-class="c-sidebar-lg-show" responsive="true"><span class="c-header-toggler-icon"></span></button>
    <ul class="c-header-nav ml-auto mr-4">
        <li class="c-header-nav-item dropdown">
            @php
                $options = [
                  'method' => 'POST',
                  'class'  => 'p-0',
                  'url'    => route('logout'),
                ];
                $icon = "<svg class='c-icon mr-2'><use xlink:href="
                        .url('/icons/sprites/free.svg#cil-account-logout')
                        ."></use></svg>"
                        .trans('buttons.logout');
            @endphp
            {{ Form::open($options) }}
            {{ Form::button($icon, ['class' => 'btn w-100 d-flex px-3', 'type' => 'submit'])  }}
            {{ Form::close() }}
        </li>
    </ul>
</header>

