<header class="main-nav">
    <div class="sidebar-user text-center">
        @if(auth()->user()->image == null)
        <a class="setting-primary" href="javascript:void(0)"><i data-feather="settings"></i></a><img class="img-90 rounded-circle" src="{{asset('assets/images/dashboard/1.png')}}" alt="" />
        @else
        <a class="setting-primary" href="javascript:void(0)"><i data-feather="settings"></i></a><img class="img-90 rounded-circle" src="{{asset('files/images/'.auth()->user()->image)}}" alt="" />        
        @endif
        <a href="user-profile"> <h6 class="mt-3 f-14 f-w-600">{{ auth()->user()->name }}</h6></a>
    </div>
    <nav>
        <div class="main-navbar">
            <div class="left-arrow" id="left-arrow"><i data-feather="arrow-left"></i></div>
            <div id="mainnav">
                <ul class="nav-menu custom-scrollbar">
                    <li class="back-btn">
                        <div class="mobile-back text-end"><span>{{ __('Back') }}</span><i class="fa fa-angle-right ps-2" aria-hidden="true"></i></div>
                    </li>
                    <li class="sidebar-main-title">
                        <div>
                            <h6>{{ __('General') }}</h6>
                        </div>
                    </li>
                    <li class="dropdown">
                        <a class="nav-link menu-title link-nav" href="{{ route('home') }}"><i data-feather="home"></i><span>{{ __('Dashboard') }}</span></a>
                    </li>
                     <li class="dropdown">
                        <a class="nav-link menu-title" href="javascript:void(0)"><i data-feather="users"></i><span>{{ __('User Management') }}</span></a>                  
                        <ul class="nav-submenu menu-content" >
                            <li><a href="{{route('users.index')}}" >{{ __('User') }}</a></li>
                             <li><a href="{{route('roles.index')}}" >{{ __('Role') }}</a></li>
                          
                        </ul>
                    </li>
                    
                </ul>
            </div>
            <div class="right-arrow" id="right-arrow"><i data-feather="arrow-right"></i></div>
        </div>
    </nav>
</header>
