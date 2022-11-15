@if($configData["mainLayoutType"] == 'horizontal' && isset($configData["mainLayoutType"]))
<nav class="header-navbar navbar-expand-lg navbar navbar-with-menu {{ $configData['navbarColor'] }} navbar-fixed">
  <div class="navbar-header d-xl-block d-none">
    <ul class="nav navbar-nav flex-row">
    </ul>
  </div>
  @else
  <nav
    class="header-navbar navbar-expand-lg navbar navbar-with-menu {{ $configData['navbarClass'] }} navbar-light navbar-shadow {{ $configData['navbarColor'] }}">
    @endif
    <div class="navbar-wrapper">
      <div class="navbar-container content">
        <div class="navbar-collapse" id="navbar-mobile">
          <div class="mr-auto float-left bookmark-wrapper d-flex align-items-center">
            <ul class="nav navbar-nav">
              <li class="nav-item mobile-menu d-xl-none mr-auto"><a class="nav-link nav-menu-main menu-toggle hidden-xs"
                  href="#"><i class="ficon feather icon-menu"></i></a></li>
            </ul>
            <ul class="nav navbar-nav">
            </ul>
          </div>
          <ul class="nav navbar-nav float-right">
            <li class="nav-item d-none d-lg-block"><a class="nav-link nav-link-expand"><i
                  class="ficon feather icon-maximize"></i></a></li>
            <li class="dropdown dropdown-user nav-item"><a class="dropdown-toggle nav-link dropdown-user-link" href="#"
                data-toggle="dropdown">
                <div class="user-nav d-sm-flex d-none"><span class="user-name text-bold-600">{{ Auth::user()->name}}</span><span class="user-status">Available</span></div><span><img class="round"
                    src="{{asset('images/pages/3-convex.png') }}" alt="avatar" height="40"
                    width="40" /></span>
              </a>
              <div class="dropdown-menu dropdown-menu-right">
                {{-- <a class="dropdown-item" href="javascript:void(0)"><i
                    class="feather icon-user"></i> Edit Profile</a><a class="dropdown-item" href="javascript:void(0)"><i
                    class="feather icon-mail"></i> My Inbox</a><a class="dropdown-item" href="javascript:void(0)"><i class="feather icon-check-square"></i>
                  Task</a><a class="dropdown-item" href="javascript:void(0)"><i class="feather icon-message-square"></i>
                  Chats</a>
                <div class="dropdown-divider"></div> --}}
                <a class="dropdown-item" href="{{url('auth-login')}}"><i
                    class="feather icon-power"></i> Logout</a>
              </div>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </nav>

  <!-- END: Header-->