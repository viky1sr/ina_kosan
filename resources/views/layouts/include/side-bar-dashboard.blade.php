<div class="navbar-wrapper  ">
    <div class="navbar-content scroll-div " >

        <div class="">
            <div class="main-menu-header">
                <img class="img-radius" src="{{asset('default.jpg')}}" alt="User-Profile-Image">
                <div class="user-details">
                    <div id="more-details">{{Auth::user()->name}}<i class="fa fa-caret-down"></i></div>
                </div>
            </div>
            <div class="collapse" id="nav-user-link">
                <ul class="list-inline">
                    <li class="list-inline-item"><a href="#" data-toggle="tooltip" title="View Profile"><i class="feather icon-user"></i></a></li>
                    <li class="list-inline-item"><a href="#"><i class="feather icon-mail" data-toggle="tooltip" title="Messages"></i><small class="badge badge-pill badge-primary">5</small></a></li>
                    <li class="list-inline-item">
                        <a href="{{ route('logout') }}" data-toggle="tooltip" title="Logout" class="text-danger"
                                                    onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                            <i class="feather icon-power"></i>
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" >
                            @csrf
                        </form>
                    </li>
                </ul>
            </div>
        </div>

        <ul class="nav pcoded-inner-navbar ">
            <li class="nav-item pcoded-menu-caption">
                <label>Navigation</label>
            </li>
            <li class="nav-item">
                <a href="{{route('home')}}" class="nav-link"><span class="pcoded-micon"><i class="feather icon-home"></i></span><span class="pcoded-mtext">Dashboard</span></a>
            </li>
            <li class="nav-item">
                <a href="{{url('/')}}" class="nav-link"><span class="pcoded-micon"><i class="feather icon-share"></i></span><span class="pcoded-mtext">Home</span></a>
            </li>
            @role('visitor')
            <li class="nav-item">
                <a href="{{route('visitor.visitor-create',Auth::user()->id)}}" class="nav-link"><span class="pcoded-micon"><i class="feather icon-user-check"></i></span><span class="pcoded-mtext">Activation Member</span></a>
            </li>
            @endrole

            @if(!Auth::user()->hasRole('visitor'))
                <li class="nav-item">
                    <a href="{{ route('bukti-trasnfer.index') }}" class="nav-link"><span class="pcoded-micon"><i class="feather icon-user-check"></i></span><span class="pcoded-mtext">
                                @if(Auth::user()->hasRole('member'))
                                Transfer
                            @else
                                List Bukti Trasnfer
                            @endif
                            </span>
                    </a>
                </li>
            @endif

            @role('admin')
{{--            <li class="nav-item">--}}
{{--                <a href="{{route('transfer.index')}}" class="nav-link"><span class="pcoded-micon"><i class="feather icon-target"></i></span><span class="pcoded-mtext">Trasnfer Virtual</span></a>--}}
{{--            </li>--}}
            <li class="nav-item pcoded-hasmenu">
                <a href="#!" class="nav-link has-ripple"><span class="pcoded-micon"><i class="feather icon-users"></i></span><span class="pcoded-mtext">User</span><span class="ripple ripple-animate" style="height: 210px; width: 210px; animation-duration: 0.7s; animation-timing-function: linear; background: rgb(70, 128, 255); opacity: 0.4; top: -78px; left: -12px;"></span></a>
                <ul class="pcoded-submenu" >
                    <li><a href="{{route('visitor.index')}}">Visitor</a></li>
                    <li><a href="{{route('member.index')}}">Member</a></li>
                </ul>
            </li>
            @endrole

            <li class="nav-item pcoded-hasmenu">
                <a class="nav-link has-ripple"><span class="pcoded-micon"><i class="feather icon-book"></i></span><span class="pcoded-mtext">Kos Kosan</span><span class="ripple ripple-animate" style="height: 210px; width: 210px; animation-duration: 0.7s; animation-timing-function: linear; background: rgb(70, 128, 255); opacity: 0.4; top: -83px; left: 57px;"></span></a>
                <ul class="pcoded-submenu">
                    <li><a href="{{route('kos-kosan.pria-index')}}">Pria</a></li>
                    <li><a href="{{route('kos-kosan.wanita-index')}}">Wanita</a></li>
                    <li><a href="{{route('kos-kosan.campur-index')}}">Campur</a></li>
                </ul>
            </li>

            @if(Auth::user()->status == 1)
{{--                <li class="nav-item pcoded-hasmenu">--}}
{{--                    <a  class="nav-link has-ripple"><span class="pcoded-micon"><i class="feather icon-file-minus"></i></span><span class="pcoded-mtext">Invoice</span><span class="ripple ripple-animate" style="height: 210px; width: 210px; animation-duration: 0.7s; animation-timing-function: linear; background: rgb(70, 128, 255); opacity: 0.4; top: -86px; left: 38px;"></span></a>--}}
{{--                    <ul class="pcoded-submenu" >--}}
{{--                        <li><a href="invoice.html">Tagihan</a></li>--}}
{{--                        <li><a href="invoice-summary.html">Masa Kosan</a></li>--}}
{{--                    </ul>--}}
{{--                </li>--}}

                <li class="nav-item">
                    <a href="{{route('my-kosan.index')}}" class="nav-link "><span class="pcoded-micon"><i class="feather icon-shopping-cart"></i></span><span class="pcoded-mtext">My Kosan</span></a>
                </li>
                <li class="nav-item">
                    <a href="{{route('virtaul-account.show',Auth::user()->virtual_acc['id'])}}" class="nav-link "><span class="pcoded-micon"><i class="feather icon-star"></i></span><span class="pcoded-mtext">Virtual Account</span></a>
                </li>
            @endif

        </ul>

    </div>
</div>
