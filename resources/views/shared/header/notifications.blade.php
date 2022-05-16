<li class="c-header-nav-item dropdown">
    <a class="c-header-nav-link" href="#" data-toggle="dropdown" role="button" aria-haspopup="true"
       aria-expanded="false">
        <svg class="c-icon" fill="black">
            <use xlink:href="{{ url('/icons/sprites/free.svg#cil-envelope-open') }}"></use>
        </svg>
    </a>
    <div class="dropdown-menu dropdown-menu-right pt-0">
        <div class="dropdown-header bg-light"><strong>You have 4 messages</strong></div>
        <a class="dropdown-item" href="#">
            <div class="message">
                <div class="py-3 mfe-3 float-left">
                    <div class="c-avatar"><img class="c-avatar-img" src="{{ asset('assets/img/avatars/7.jpg') }}"
                                               alt="user@email.com"><span
                            class="c-avatar-status bg-success"></span></div>
                </div>
                <div><small class="text-muted">John Doe</small><small class="text-muted float-right mt-1">Just
                        now</small></div>
                <div class="text-truncate font-weight-bold"><span class="text-danger">!</span> Important message
                </div>
                <div class="small text-muted text-truncate">Lorem ipsum dolor sit amet, consectetur adipisicing
                    elit, sed do eiusmod tempor incididunt...
                </div>
            </div>
        </a>
        <a class="dropdown-item text-center border-top" href="#"><strong>View all messages</strong></a>
    </div>
</li>
