@php
    use App\Utility;
    $users=\Auth::user();
    $currantLang = $users->currentLanguage();
    $languages=Utility::languages();
    $profile=asset(Storage::url('uploads/avatar/'));

    $logo=asset(Storage::url('uploads/logo/'));
    $company_logo=Utility::getValByName('company_logo');
    $company_small_logo=Utility::getValByName('company_small_logo');
@endphp
<!-- Topbar Start -->
<div class="navbar-custom">
    <div class="container-fluid">
        <ul class="list-unstyled topnav-menu float-right mb-0">
            <!-- <li class="d-none d-lg-block">
                <form class="app-search">
                    <div class="app-search-box">
                        <div class="input-group">
                            <input type="search" class="form-control" placeholder="Search..." id="top-search">
                            <div class="input-group-append">
                                <button class="btn" type="submit">
                                    <i class="fe-search"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </li> -->

            <!-- <li class="dropdown d-inline-block d-lg-none">
                <a class="nav-link dropdown-toggle arrow-none waves-effect waves-light" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                    <i class="fe-search noti-icon"></i>
                </a>
                <div class="dropdown-menu dropdown-lg dropdown-menu-right p-0">
                    <form class="p-3">
                        <input type="text" class="form-control" placeholder="Search ..." aria-label="Recipient's username">
                    </form>
                </div>
            </li> -->

            @if(Auth::user()->type != 'super admin')
                <li class="dropdown notification-list topbar-dropdown">
                    <a class="nav-link dropdown-toggle waves-effect waves-light" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                        <i class="fe-bell noti-icon"></i>
                        <span class="badge badge-danger rounded-circle noti-icon-badge">4</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right dropdown-lg">

                        <!-- item-->
                        <div class="dropdown-item noti-title">
                            <h5 class="m-0">
                                <span class="float-right">
                                    <a href="" class="text-dark">
                                        <small>{{__('Mark All As Read')}}</small>
                                    </a>
                                </span>{{__('Notification')}}
                            </h5>
                        </div>

                        <div class="noti-scroll" data-simplebar="">
                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item notify-item">
                                <div class="notify-icon bg-warning">
                                    <i class="mdi mdi-account-plus"></i>
                                </div>
                                <p class="notify-details">New user registered.
                                    <small class="text-muted">5 hours ago</small>
                                </p>
                            </a>

                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item notify-item">
                                <div class="notify-icon bg-info">
                                    <i class="mdi mdi-comment-account-outline"></i>
                                </div>
                                <p class="notify-details">Caleb Flakelar commented on Admin
                                    <small class="text-muted">4 days ago</small>
                                </p>
                            </a>

                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item notify-item">
                                <div class="notify-icon bg-secondary">
                                    <i class="mdi mdi-heart"></i>
                                </div>
                                <p class="notify-details">Carlos Crouch liked
                                    <b>Admin</b>
                                    <small class="text-muted">13 days ago</small>
                                </p>
                            </a>
                        </div>

                        <!-- All-->
                        <a href="{{url('messages')}}" class="dropdown-item text-center text-primary notify-item notify-all">{{__('View All')}} <i class="fe-arrow-right"></i></a>

                    </div>
                </li>
            @endif

            <!-- <li class="dropdown dropdown-list-toggle"><a href="#" data-toggle="dropdown" class="nav-link notification-toggle nav-link-lg language-dd"><i class="fas fa-language"></i></a>
                <div class="dropdown-menu dropdown-list dropdown-menu-right">
                    <div class="dropdown-header">{{__('Choose Language')}}
                    </div>
                    @can('Create Language')
                        <a href="{{route('manage.language',[$currantLang])}}" class="dropdown-item btn manage-language-btn">
                            <span> {{ __('Create & Customize') }}</span>
                        </a>
                    @endcan
                    <div class="dropdown-list-content dropdown-list-icons">
                        @foreach($languages as $language)
                            <a href="{{route('change.language',$language)}}" class="dropdown-item dropdown-item-unread @if($language == $currantLang) active-language @endif">
                                <span> {{Str::upper($language)}}</span>
                            </a>
                        @endforeach
                    </div>
                </div>
            </li> -->




            <li class="dropdown notification-list topbar-dropdown">
                <a class="nav-link dropdown-toggle nav-user mr-0 waves-effect waves-light" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                    <img src="{{(!empty($users->avatar)? $profile.'/'.$users->avatar : $profile.'/avatar.png')}}" alt="user-image" class="rounded-circle">
                    <span class="pro-user-name ml-1">
                        {{__('Hi')}}, {{\Auth::user()->name}} <i class="mdi mdi-chevron-down"></i>
                    </span>
                </a>
                <div class="dropdown-menu dropdown-menu-right profile-dropdown ">
                    <!-- item-->
                    <div class="dropdown-header noti-title">
                        <h6 class="text-overflow m-0">{{__('Welcome!')}}</h6>
                    </div>

                    <a href="{{route('profile')}}" class="dropdown-item notify-item">
                        <i class="fe-user"></i>
                        <span>{{__('My profile')}}</span>
                    </a>

                    <div class="dropdown-divider"></div>

                    <!-- item-->
                    <a href="{{ route('logout') }}"  onclick="event.preventDefault(); document.getElementById('frm-logout').submit();" class="dropdown-item notify-item">
                        <i class="fe-log-out"></i>
                        <span>{{__('Logout')}}</span>
                    </a>

                    <form id="frm-logout" action="{{ route('logout') }}" method="POST" class="d-none">
                        {{ csrf_field() }}
                    </form>

                </div>
            </li>

            <!-- <li class="dropdown notification-list">
                <a href="javascript:void(0);" class="nav-link right-bar-toggle waves-effect waves-light">
                    <i class="fe-settings noti-icon"></i>
                </a>
            </li> -->

        </ul>

        <!-- LOGO -->
        <div class="logo-box">
            <a href="{{route('home')}}" class="logo logo-dark text-center">
                <span class="logo-sm">
                    <img src="{{$logo.'/'.(isset($company_small_logo) && !empty($company_small_logo)?$company_small_logo:'small_logo.png')}}" alt="" height="35">
                    <!-- <span class="logo-lg-text-light">Highdmin</span> -->
                </span>
                <span class="logo-lg">
                    <img src="{{$logo.'/'.(isset($company_logo) && !empty($company_logo)?$company_logo:'logo.png')}}" alt="" height="52">
                    <!-- <span class="logo-lg-text-light">H</span> -->
                </span>
            </a>

            <a href="{{route('home')}}" class="logo logo-light text-center">
              <span class="logo-sm">
                  <img src="{{$logo.'/'.(isset($company_small_logo) && !empty($company_small_logo)?$company_small_logo:'small_logo.png')}}" alt="" height="35">
                  <!-- <span class="logo-lg-text-light">Highdmin</span> -->
              </span>
              <span class="logo-lg">
                  <img src="{{$logo.'/'.(isset($company_logo) && !empty($company_logo)?$company_logo:'logo.png')}}" alt="" height="52">
                  <!-- <span class="logo-lg-text-light">H</span> -->
              </span>
            </a>
        </div>

        <ul class="list-unstyled topnav-menu topnav-menu-left m-0">
            <li>
                <button class="button-menu-mobile waves-effect waves-light">
                    <i class="fe-menu"></i>
                </button>
            </li>

            <li>
                <!-- Mobile menu toggle (Horizontal Layout)-->
                <a class="navbar-toggle nav-link" data-toggle="collapse" data-target="#topnav-menu-content">
                    <div class="lines">
                        <span></span>
                        <span></span>
                        <span></span>
                    </div>
                </a>
                <!-- End mobile menu toggle-->
            </li>

            <li>
                <div class="page-title-box">
                    <h4 class="page-title">@@title</h4>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">@@subtitle</a></li>
                        <li class="breadcrumb-item"><a href="#">@@item</a></li>
                        <li class="breadcrumb-item active">@@activeitem</li>
                    </ol>
                </div>
            </li>

        </ul>
        <div class="clearfix"></div>
    </div>
</div>
<!-- end Topbar -->
