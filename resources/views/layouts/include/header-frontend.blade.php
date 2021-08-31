<header id="header" class="transparent-header dark" data-sticky-class="not-dark" data-responsive-class="not-dark" data-menu-padding="28">
    <div id="header-wrap">
        <div class="container">
            <div class="header-row">

                <!-- Logo
                ============================================= -->
                <div id="logo">
                    <a href="demo-travel.html" class="standard-logo" data-dark-logo="images/logo-dark.png"><img src="{{asset('images/logo.png')}}" alt="Canvas Logo"></a>
                    <a href="demo-travel.html" class="retina-logo" data-dark-logo="images/logo-dark@2x.png"><img src="{{asset('images/logo@2x.png')}}" alt="Canvas Logo"></a>
                </div><!-- #logo end -->

                <div id="primary-menu-trigger">
                    <svg class="svg-trigger" viewBox="0 0 100 100"><path d="m 30,33 h 40 c 3.722839,0 7.5,3.126468 7.5,8.578427 0,5.451959 -2.727029,8.421573 -7.5,8.421573 h -20"></path><path d="m 30,50 h 40"></path><path d="m 70,67 h -40 c 0,0 -7.5,-0.802118 -7.5,-8.365747 0,-7.563629 7.5,-8.634253 7.5,-8.634253 h 20"></path></svg>
                </div>

                <!-- Primary Navigation
                ============================================= -->
                <nav class="primary-menu style-4 menu-spacing-margin">

                    <ul class="menu-container">
                        <li class="menu-item current"><a class="menu-link" href="#"><div><i class="icon-building"></i>Kos Kosan</div></a></li>
                        <li class="menu-item"><a class="menu-link" href="#"><div><i class="icon-phone3"></i>089694551719</div></a></li>
                        @if(isset(Auth::user()->id) && Auth::user()->id)
                            <li class="menu-item"><a class="menu-link" href="{{route('login')}}"><div><i class="icon-home"></i>Dashboard</div></a></li>
                        @else
                            <li class="menu-item"><a class="menu-link" href="{{route('login')}}"><div><i class="icon-user"></i>Login</div></a></li>
                        @endif
                    </ul>

                </nav><!-- #primary-menu end -->

            </div>
        </div>
    </div>
    <div class="header-wrap-clone"></div>
</header><!-- #header end -->
