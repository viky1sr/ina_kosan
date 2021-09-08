<header id="header" class="transparent-header dark" data-sticky-class="not-dark" data-responsive-class="not-dark" data-menu-padding="28">
    <div id="header-wrap">
        <div class="container">
            <div class="header-row">

                <!-- Logo
                ============================================= -->
                <div id="logo">
{{--                    <a href="#" class="standard-logo" data-dark-logo="{{asset('home_1.png')}}"><img src="{{asset('home_1.png')}}" alt="Canvas Logo"></a>--}}
{{--                    <a href="#" class="retina-logo" data-dark-logo="{{asset('home_1.png')}}"><img src="{{asset('home_1.png')}}" alt="Canvas Logo"></a>--}}
                </div><!-- #logo end -->

                <div id="primary-menu-trigger">
                    <svg class="svg-trigger" viewBox="0 0 100 100"><path d="m 30,33 h 40 c 3.722839,0 7.5,3.126468 7.5,8.578427 0,5.451959 -2.727029,8.421573 -7.5,8.421573 h -20"></path><path d="m 30,50 h 40"></path><path d="m 70,67 h -40 c 0,0 -7.5,-0.802118 -7.5,-8.365747 0,-7.563629 7.5,-8.634253 7.5,-8.634253 h 20"></path></svg>
                </div>

                <!-- Primary Navigation
                ============================================= -->
                <nav class="primary-menu style-4 menu-spacing-margin">

                    <ul class="menu-container">
                        <li class="menu-item"><a class="menu-link" href="{{route('lading-page')}}"><div><i class="icon-building"></i>Kos Kosan</div></a></li>
                       @if(isset(Auth::user()->id) && Auth::user()->id)
                            <li class="menu-item"><a class="menu-link" href="{{route('home')}}"><div><i class="icon-home"></i>Dashboard</div></a></li>
                            <li class="menu-item">
                                <a href="{{route('logout')}}" class="menu-link" title="Logout"
                                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    <div><i class="icon-lock"></i>Logout</div>
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </li>
                        @else
                            <li class="menu-item"><a class="menu-link" href="{{route('register-vendor')}}"><div><i class="icon-user"></i>Register Vendor</div></a></li>

                            <li class="menu-item"><a class="menu-link" href="{{route('login')}}"><div><i class="icon-user"></i>Login</div></a></li>
                        @endif
                    </ul>

                </nav><!-- #primary-menu end -->

            </div>
        </div>
    </div>
    <div class="header-wrap-clone"></div>
</header><!-- #header end -->
