<div class="page-header">
    <div class="header-wrapper row m-0">
      <div class="header-logo-wrapper col-auto p-0">
        <div class="logo-wrapper"><a href="index.html"> <img class="img-fluid for-light" src="../assets/images/logo/logo.png" alt=""><img class="img-fluid for-dark" src="../assets/images/logo/logo_dark.png" alt=""></a></div>
        <div class="toggle-sidebar">
          <svg class="sidebar-toggle">
            <use href="{{asset('assets/svg/icon-sprite.svg#stroke-animation')}}"></use>
          </svg>
        </div>
      </div>
      <form class="col-sm-4 form-inline search-full d-none d-xl-block" action="#" method="get">
        <div class="form-group">
          <div class="Typeahead Typeahead--twitterUsers">
            <div class="u-posRelative">
              <input class="demo-input Typeahead-input form-control-plaintext w-100" type="text" placeholder="Type to Search .." name="q" title="" autofocus="">
              <svg class="search-bg svg-color">
                <use href="{{asset('assets/svg/icon-sprite.svg#search')}}"></use>
              </svg>
            </div>
          </div>
        </div>
      </form>
      <div class="nav-right col-xl-8 col-lg-12 col-auto pull-right right-header p-0">
        <ul class="nav-menus">
          <li class="serchinput">
            <div class="serchbox">
              <svg>
                <use href="{{asset('/assets/svg/icon-sprite.svg#search')}}"></use>
              </svg>
            </div>
            <div class="form-group search-form">
              <input type="text" placeholder="Search here...">
            </div>
          </li>
          <li class="onhover-dropdown">
            <div class="notification-box">
              <svg>
                <use href="{{asset('assets/svg/icon-sprite.svg#Bell')}}"></use>
              </svg>
            </div>
            <div class="onhover-show-div notification-dropdown">
              <h6 class="f-18 mb-0 dropdown-title">Notifications</h6>
              <div class="notification-card">
                <ul>

                    <li>
                        <div class="user-notification">

                          <div class="user-description"><a href="letter-box.html">
                              <h4>Sorry No Notifications</h4></a><span>Today 00:00 PM</span></div>
                        </div>

                        <div class="show-btn"> <a href="index.html"> <span>Show</span></a></div>
                      </li>

                  {{-- <li>
                    <div class="user-notification">
                      <div><img src="../assets/images/avtar/19.jpg" alt="avatar"></div>
                      <div class="user-description"><a href="letter-box.html">
                          <h4>Congrats! you all task for today.</h4></a><span>Today 06:55pm</span></div>
                    </div>
                    <div class="notification-btn">
                      <button class="btn btn-pill btn-primary" type="button" title="btn btn-pill btn-primary">Accpet</button>
                      <button class="btn btn-pill btn-secondary" type="button" title="btn btn-pill btn-primary">Decline</button>
                    </div>
                    <div class="show-btn"> <a href="index.html"> <span>Show</span></a></div>
                  </li> --}}
                  <li> <a class="f-w-700" href="letter-box.html">Check all </a></li>
                </ul>
              </div>
            </div>
          </li>
          <li class="onhover-dropdown">
            <svg>
              <use href="{{asset('assets/svg/icon-sprite.svg#Bookmark')}}"></use>
            </svg>
            <div class="onhover-show-div bookmark-flip">
              <div class="flip-card">
                <div class="flip-card-inner">
                  <div class="front">
                    <h6 class="f-18 mb-0 dropdown-title">Bookmark</h6>
                    <ul class="bookmark-dropdown">
                      <li>
                        <div class="row">
                          <div class="col-4 text-center"><a href="form-validation.html">
                              <div class="bookmark-content">
                                <div class="bookmark-icon bg-light-primary"><i data-feather="file-text"></i></div><span>Forms</span>
                              </div></a></div>
                          <div class="col-4 text-center"><a href="user-profile.html">
                              <div class="bookmark-content">
                                <div class="bookmark-icon bg-light-secondary"><i data-feather="user"></i></div><span>Profile</span>
                              </div></a></div>
                          <div class="col-4 text-center"><a href="bootstrap-basic-table.html">
                              <div class="bookmark-content">
                                <div class="bookmark-icon bg-light-warning"> <i data-feather="server"> </i></div><span>Tables </span>
                              </div></a></div>
                        </div>
                      </li>
                      <li class="text-centermedia-body"> <a class="flip-btn f-w-700" id="flip-btn" href="javascript:void(0)">Add New Bookmark</a></li>
                    </ul>
                  </div>
                  <div class="back">
                    <ul>
                      <li>
                        <div class="bookmark-dropdown flip-back-content">
                          <input type="text" placeholder="search...">
                        </div>
                      </li>
                      <li><a class="f-w-700 d-block flip-back" id="flip-back" href="javascript:void(0)">Back</a></li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
          </li>
          <li class="onhover-dropdown">
            <div class="message position-relative">
              <svg>
                <use href="{{asset('assets/svg/icon-sprite.svg#Message')}}"></use>
              </svg><span class="rounded-pill badge-danger"></span>
            </div>
            <div class="onhover-show-div message-dropdown">
              <h6 class="f-18 mb-0 dropdown-title">Message                               </h6>
              <ul>
                <li>
                    <div class="d-flex align-items-start">

                      <div class="flex-grow-1">

                        <p>Currently No Message</p>
                      </div>
                      {{-- <div class="notification-right"><i data-feather="x"></i></div> --}}
                    </div>
                  </li>
                {{-- <li>
                  <div class="d-flex align-items-start">
                    <div class="message-img bg-light-primary"><img src="../assets/images/user/10.jpg" alt=""></div>
                    <div class="flex-grow-1">
                      <h5> <a href="letter-box.html">Sarah Loren</a></h5>
                      <p>What`s the project report update?</p>
                    </div>
                    <div class="notification-right"><i data-feather="x"></i></div>
                  </div>
                </li> --}}
                <li> <a class="f-w-700" href="private-chat.html">Check all</a></li>
              </ul>
            </div>
          </li>

          <li>
            <div class="mode">
              <svg class="for-dark">
                <use href="{{asset('assets/svg/icon-sprite.svg#moon')}}"></use>
              </svg>
              <svg class="for-light">
                <use href="{{asset('assets/svg/icon-sprite.svg#Sun')}}"></use>
              </svg>
            </div>
          </li>

          <li class="profile-nav onhover-dropdown pe-0 py-0">
            <div class="d-flex align-items-center profile-media">
                <img class="lazy" style="width: 35px; height: 35px; border-radius: 50%; object-fit: cover;"
     src="{{ filter_var(Auth::user()->avatar, FILTER_VALIDATE_URL)
         ? Auth::user()->avatar
         : (Auth::user()->avatar
             ? asset(Auth::user()->avatar)
             : asset('assets/images/user/default-avatar.jpg')) }}"
     alt="{{ Auth::user()->name }}">

              <div class="flex-grow-1 user"><span>{{ Auth::user()->name }}</span>
                <p class="mb-0 font-nunito">{{ Auth::user()->email }}
                  <svg>
                    <use href="{{asset('assets/svg/icon-sprite.svg#header-arrow-down')}}"></use>
                  </svg>
                </p>
              </div>
            </div>
            <ul class="profile-dropdown onhover-show-div">
                <li><a href="{{ route('admin_profile') }}"><i data-feather="user"></i><span>Account </span></a></li>

              <li><a href=""><i data-feather="settings"></i><span>Settings</span></a></li>
              <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>

            <li>
                <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i data-feather="log-out"></i>
                    <span>Log Out</span>
                </a>
            </li>

            </ul>
          </li>
        </ul>
      </div>

    </div>
  </div>
