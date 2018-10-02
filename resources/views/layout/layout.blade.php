@include('layout.header');
<div class="inner-wrapper">
    <!-- start: sidebar -->
    <aside id="sidebar-left" class="sidebar-left">

        <div class="sidebar-header">
            <div class="sidebar-title">
                {{allsetting()['app_title']}}
            </div>
            <div class="sidebar-toggle hidden-xs" data-toggle-class="sidebar-left-collapsed" data-target="html"
                 data-fire-event="sidebar-left-toggle">
                <i class="fa fa-bars" aria-label="Toggle sidebar"></i>
            </div>
        </div>

        <div class="nano">
            <div class="nano-content">
                <nav id="menu" class="nav-main" role="navigation">
                    <ul class="nav nav-main">
                        <li class="nav-active">
                            <a class="nav-link" href="{{route('userDashboard')}}">
                                <i class="fa fa-home" aria-hidden="true"></i>
                                <span>{{__('Home')}}</span>
                            </a>
                        </li>

                        <li>
                            <a class="nav-link" href="{{route('dailyUpdateList')}}">
                                <i class="fa fa-calendar-plus-o" aria-hidden="true"></i>
                                <span>{{__('Daily Update')}}</span>
                            </a>
                        </li>
                        @if(Auth::user()->role == USER_ROLE_ADMIN)
                            <li>
                                <a class="nav-link" href="{{route('userlist')}}">
                                    <i class="fa fa-user-circle" aria-hidden="true"></i>
                                    <span>{{__('User List')}}</span>
                                </a>
                            </li>
                            <li>
                                <a class="nav-link" href="{{route('project')}}">
                                    <i class="fa fa-columns" aria-hidden="true"></i>
                                    <span>{{__('Project')}}</span>
                                </a>
                            </li>

                            <li>
                                <a class="nav-link" href="">
                                    <i class="fa fa-user-circle" aria-hidden="true"></i>
                                    <span>{{__('Setting')}}</span>
                                </a>
                            </li>
                        @endif
                        {{--
                        <li>
                            <a class="nav-link" href="">
                                <i class="fa fa-columns" aria-hidden="true"></i>
                                <span>{{__('master.container')}}</span>
                            </a>
                        </li>


                        {{--
                                                <li>
                                                    <a class="nav-link" href="">
                                                        <i class="fa fa-car" aria-hidden="true"></i>
                                                        <span>{{__('master.driver')}}</span>
                                                    </a>
                                                </li>

                                                    <li>
                                                        <a class="nav-link" href="">
                                                            <i class="fa fa-map-marker" aria-hidden="true"></i>
                                                            <span>{{__('master.address')}}</span>
                                                        </a>
                                                    </li>

                                                <li>
                                                    <a class="nav-link" href="">
                                                        <i class="fa fa-dollar" aria-hidden="true"></i>
                                                        <span>{{__('master.price_table')}}</span>
                                                    </a>
                                                </li>

                                                <li>
                                                    <a class="nav-link" href="">
                                                        <i class="fa fa-rocket" aria-hidden="true"></i>
                                                        <span>{{__('master.role_management')}}</span>
                                                    </a>
                                                </li>

                                                <li>
                                                    <a class="nav-link" href="">
                                                        <i class="fa fa-users" aria-hidden="true"></i>
                                                        <span>{{__('master.user_management')}}</span>
                                                    </a>
                                                </li>

                                                <li>
                                                    <a class="nav-link" href="">
                                                        <i class="fa fa-cog" aria-hidden="true"></i>
                                                        <span>{{__('master.settings')}}</span>
                                                    </a>
                                                </li>--}}
                    </ul>
                </nav>
            </div>

            <script>
                if (typeof localStorage !== 'undefined') {
                    if (localStorage.getItem('sidebar-left-position') !== null) {
                        var initialPosition = localStorage.getItem('sidebar-left-position'),
                            sidebarLeft = document.querySelector('#sidebar-left .nano-content');

                        sidebarLeft.scrollTop = initialPosition;
                    }
                }
            </script>


        </div>

    </aside>
    <!-- end: sidebar -->

    <section role="main" class="content-body pb-0">
        @include('layout.message')
        @yield('content')

    </section>
</div>

</section>

@include('layout.footer');