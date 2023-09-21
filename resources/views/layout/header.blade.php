<nav class="navbar">
    <a href="#" class="sidebar-toggler">
        <i data-feather="menu"></i>
    </a>
    <div class="navbar-content">
        {{--    <form class="search-form">--}}
        {{--      <div class="input-group">--}}
        {{--        <div class="input-group-prepend">--}}
        {{--          <div class="input-group-text">--}}
        {{--            <i data-feather="search"></i>--}}
        {{--          </div>--}}
        {{--        </div>--}}
        {{--        <input type="text" class="form-control" id="navbarForm" placeholder="Search here...">--}}
        {{--      </div>--}}
        {{--    </form>--}}
        <ul class="navbar-nav">
            {{--<li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="languageDropdown" role="button" data-toggle="dropdown"
                   aria-haspopup="true" aria-expanded="false">
                    <i class="flag-icon flag-icon-{{ LaravelLocalization::getCurrentLocale() == 'ar'? 'eg':'us' }} mt-1"
                       title="{{ LaravelLocalization::getCurrentLocale() == 'ar'? 'eg':'us' }}"></i> <span
                        class="font-weight-medium ml-1 mr-1">{{ LaravelLocalization::getCurrentLocaleNative() }}</span>
                </a>
                <div class="dropdown-menu" aria-labelledby="languageDropdown">
                    <a href="{{URL::to('/en')}}" class="dropdown-item py-2"><i class="flag-icon flag-icon-us" title="us"
                                                                               id="us"></i> <span
                            class="ml-1"> English </span></a>
                    <a href="{{URL::to('/ar')}}" class="dropdown-item py-2"><i class="flag-icon flag-icon-eg" title="eg"
                                                                               id="eg"></i> <span
                            class="ml-1"> العربيه </span></a>
                </div>
            </li>--}}
            @if(!auth()->check())
                <li class="nav-item">
                    <a class="nav-link " href="{{route('login')}}">
                        <i data-feather="user-check"></i> Login
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link " href="{{route('register')}}">
                        <i data-feather="user-plus"></i> Register
                    </a>
                </li>
            @endif

            {{--      <li class="nav-item dropdown nav-messages">--}}
            {{--        <a class="nav-link dropdown-toggle" href="#" id="messageDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">--}}
            {{--          <i data-feather="mail"></i>--}}
            {{--        </a>--}}
            {{--        <div class="dropdown-menu" aria-labelledby="messageDropdown">--}}
            {{--          <div class="dropdown-header d-flex align-items-center justify-content-between">--}}
            {{--            <p class="mb-0 font-weight-medium">9 New Messages</p>--}}
            {{--            <a href="javascript:;" class="text-muted">Clear all</a>--}}
            {{--          </div>--}}
            {{--          <div class="dropdown-body">--}}
            {{--            <a href="javascript:;" class="dropdown-item">--}}
            {{--              <div class="figure">--}}
            {{--                <img src="{{ url('https://via.placeholder.com/30x30') }}" alt="userr">--}}
            {{--              </div>--}}
            {{--              <div class="content">--}}
            {{--                <div class="d-flex justify-content-between align-items-center">--}}
            {{--                  <p>Leonardo Payne</p>--}}
            {{--                  <p class="sub-text text-muted">2 min ago</p>--}}
            {{--                </div>--}}
            {{--                <p class="sub-text text-muted">Project status</p>--}}
            {{--              </div>--}}
            {{--            </a>--}}
            {{--            <a href="javascript:;" class="dropdown-item">--}}
            {{--              <div class="figure">--}}
            {{--                <img src="{{ url('https://via.placeholder.com/30x30') }}" alt="userr">--}}
            {{--              </div>--}}
            {{--              <div class="content">--}}
            {{--                <div class="d-flex justify-content-between align-items-center">--}}
            {{--                  <p>Carl Henson</p>--}}
            {{--                  <p class="sub-text text-muted">30 min ago</p>--}}
            {{--                </div>--}}
            {{--                <p class="sub-text text-muted">Client meeting</p>--}}
            {{--              </div>--}}
            {{--            </a>--}}
            {{--            <a href="javascript:;" class="dropdown-item">--}}
            {{--              <div class="figure">--}}
            {{--                <img src="{{ url('https://via.placeholder.com/30x30') }}" alt="userr">--}}
            {{--              </div>--}}
            {{--              <div class="content">--}}
            {{--                <div class="d-flex justify-content-between align-items-center">--}}
            {{--                  <p>Jensen Combs</p>--}}
            {{--                  <p class="sub-text text-muted">1 hrs ago</p>--}}
            {{--                </div>--}}
            {{--                <p class="sub-text text-muted">Project updates</p>--}}
            {{--              </div>--}}
            {{--            </a>--}}
            {{--            <a href="javascript:;" class="dropdown-item">--}}
            {{--              <div class="figure">--}}
            {{--                <img src="{{ url('https://via.placeholder.com/30x30') }}" alt="userr">--}}
            {{--              </div>--}}
            {{--              <div class="content">--}}
            {{--                <div class="d-flex justify-content-between align-items-center">--}}
            {{--                  <p>Amiah Burton</p>--}}
            {{--                  <p class="sub-text text-muted">2 hrs ago</p>--}}
            {{--                </div>--}}
            {{--                <p class="sub-text text-muted">Project deadline</p>--}}
            {{--              </div>--}}
            {{--            </a>--}}
            {{--            <a href="javascript:;" class="dropdown-item">--}}
            {{--              <div class="figure">--}}
            {{--                <img src="{{ url('https://via.placeholder.com/30x30') }}" alt="userr">--}}
            {{--              </div>--}}
            {{--              <div class="content">--}}
            {{--                <div class="d-flex justify-content-between align-items-center">--}}
            {{--                  <p>Yaretzi Mayo</p>--}}
            {{--                  <p class="sub-text text-muted">5 hr ago</p>--}}
            {{--                </div>--}}
            {{--                <p class="sub-text text-muted">New record</p>--}}
            {{--              </div>--}}
            {{--            </a>--}}
            {{--          </div>--}}
            {{--          <div class="dropdown-footer d-flex align-items-center justify-content-center">--}}
            {{--            <a href="javascript:;">View all</a>--}}
            {{--          </div>--}}
            {{--        </div>--}}
            {{--      </li>--}}
            {{--      <li class="nav-item dropdown nav-notifications">--}}
            {{--        <a class="nav-link dropdown-toggle" href="#" id="notificationDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">--}}
            {{--          <i data-feather="bell"></i>--}}
            {{--          <div class="indicator">--}}
            {{--            <div class="circle"></div>--}}
            {{--          </div>--}}
            {{--        </a>--}}
            {{--        <div class="dropdown-menu" aria-labelledby="notificationDropdown">--}}
            {{--          <div class="dropdown-header d-flex align-items-center justify-content-between">--}}
            {{--            <p class="mb-0 font-weight-medium">6 New Notifications</p>--}}
            {{--            <a href="javascript:;" class="text-muted">Clear all</a>--}}
            {{--          </div>--}}
            {{--          <div class="dropdown-body">--}}
            {{--            <a href="javascript:;" class="dropdown-item">--}}
            {{--              <div class="icon">--}}
            {{--                <i data-feather="user-plus"></i>--}}
            {{--              </div>--}}
            {{--              <div class="content">--}}
            {{--                <p>New customer registered</p>--}}
            {{--                <p class="sub-text text-muted">2 sec ago</p>--}}
            {{--              </div>--}}
            {{--            </a>--}}
            {{--            <a href="javascript:;" class="dropdown-item">--}}
            {{--              <div class="icon">--}}
            {{--                <i data-feather="gift"></i>--}}
            {{--              </div>--}}
            {{--              <div class="content">--}}
            {{--                <p>New Order Recieved</p>--}}
            {{--                <p class="sub-text text-muted">30 min ago</p>--}}
            {{--              </div>--}}
            {{--            </a>--}}
            {{--            <a href="javascript:;" class="dropdown-item">--}}
            {{--              <div class="icon">--}}
            {{--                <i data-feather="alert-circle"></i>--}}
            {{--              </div>--}}
            {{--              <div class="content">--}}
            {{--                <p>Server Limit Reached!</p>--}}
            {{--                <p class="sub-text text-muted">1 hrs ago</p>--}}
            {{--              </div>--}}
            {{--            </a>--}}
            {{--            <a href="javascript:;" class="dropdown-item">--}}
            {{--              <div class="icon">--}}
            {{--                <i data-feather="layers"></i>--}}
            {{--              </div>--}}
            {{--              <div class="content">--}}
            {{--                <p>Apps are ready for update</p>--}}
            {{--                <p class="sub-text text-muted">5 hrs ago</p>--}}
            {{--              </div>--}}
            {{--            </a>--}}
            {{--            <a href="javascript:;" class="dropdown-item">--}}
            {{--              <div class="icon">--}}
            {{--                <i data-feather="download"></i>--}}
            {{--              </div>--}}
            {{--              <div class="content">--}}
            {{--                <p>Download completed</p>--}}
            {{--                <p class="sub-text text-muted">6 hrs ago</p>--}}
            {{--              </div>--}}
            {{--            </a>--}}
            {{--          </div>--}}
            {{--          <div class="dropdown-footer d-flex align-items-center justify-content-center">--}}
            {{--            <a href="javascript:;">View all</a>--}}
            {{--          </div>--}}
            {{--        </div>--}}
            {{--      </li>--}}
            @if(auth()->check())
                <li class="nav-item dropdown nav-profile">
                    <a class="nav-link dropdown-toggle" href="#" id="profileDropdown" role="button"
                       data-toggle="dropdown"
                       aria-haspopup="true" aria-expanded="false">
                        <img src="{{ url('https://via.placeholder.com/30x30') }}" alt="profile">
                    </a>
                    <div class="dropdown-menu" aria-labelledby="profileDropdown">
                        <div class="dropdown-header d-flex flex-column align-items-center">
                            <div class="figure mb-3">
                                <img src="{{ url('https://via.placeholder.com/80x80') }}" alt="">
                            </div>
                            <div class="info text-center">
                                <p class="name font-weight-bold mb-0">{{auth()->user()->name}}</p>
                                <p class="email text-muted mb-3">{{auth()->user()->email}}</p>
                            </div>
                        </div>
                        <div class="dropdown-body">
                            <ul class="profile-nav p-0 pt-3">
                                {{--<li class="nav-item">
                                    <a href="{{ url('/general/profile') }}" class="nav-link">
                                        <i data-feather="user"></i>
                                        <span>Profile</span>
                                    </a>
                                </li>--}}

                                <li class="nav-item">
                                    <a href="{{route('owner.profile')}}" class="nav-link">
                                        <i data-feather="edit"></i>
                                        <span>Edit Profile</span>
                                    </a>
                                </li>
                                {{--
                                <li class="nav-item">
                                    <a href="javascript:;" class="nav-link">
                                        <i data-feather="repeat"></i>
                                        <span>Switch User</span>
                                    </a>
                                </li>--}}
                                <li class="nav-item">
                                    <a href="{{route('logout')}}" class="nav-link">
                                        <i data-feather="log-out"></i>
                                        <span>{{__('dashboard.logout')}}</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </li>
            @endif
        </ul>
    </div>
</nav>
