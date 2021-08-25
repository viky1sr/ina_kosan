<!DOCTYPE html>
<html dir="ltr" lang="en-US">
<head>
    @include('layouts.include.meta-frontend')
</head>

<body class="stretched">

<!-- Document Wrapper
============================================= -->
<div id="wrapper" class="clearfix">

    <!-- Top Bar
    ============================================= -->
    @include('layouts.include.top-bar-frontend')

    <!-- Header
    ============================================= -->
   @include('layouts.include.header-frontend')
    <!-- Page Title
    ============================================= -->
        <!-- #page-title end -->
    <!-- Content
    ============================================= -->
   @yield('content')
            <!-- #content end -->

    <!-- Footer
    ============================================= -->
   @include('layouts.include.footer-frontend')
</div><!-- #wrapper end -->

<!-- Go To Top
============================================= -->
<div id="gotoTop" class="icon-angle-up"></div>

<!-- JavaScripts
============================================= -->
@include('layouts.include.plugins-frontend')

</body>
</html>
