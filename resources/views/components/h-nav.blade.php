<div class="sidebar-wrapper" data-layout="stroke-svg">
    <div>
        <div class="logo-wrapper">
            <a href="{{Request::url();}}">
                <img class="img-fluid for-light" src="{{ asset('assets/images/egspec_f.webp') }}" alt="EGSPEC">
                <img class="img-fluid for-dark" src="{{ asset('assets/images/w_egspec_f.webp') }}" alt="EGSPEC White">
            </a>
            <div class="toggle-sidebar">
                <svg class="sidebar-toggle">
                    <use href="{{asset('assets/svg/icon-sprite.svg#toggle-icon')}}"></use>
                </svg>
            </div>
        </div>
        <nav class="sidebar-main">
            <div id="sidebar-menu">
                <ul class="sidebar-links" id="simple-bar">
                    <br>
                    <li class="sidebar-main-title">
                        <div>
                          <h6 class="lan-1">General</h6>
                        </div>
                      </li>
                    <li class="sidebar-list">
                        <i class="fa fa-thumb-tack"></i>

                        <a class="sidebar-link" href="{{route('admin_dashboard')}}">
                            <svg class="stroke-icon">
                                <use href="{{asset('assets/svg/icon-sprite.svg#stroke-home')}}"></use>
                              </svg>
                              <svg class="fill-icon">
                                <use href="{{asset('assets/svg/icon-sprite.svg#fill-home')}}"></use>
                              </svg>
                            <span>Dashboard</span>
                        </a>
                    </li>


                    <li class="sidebar-list">
                        <a class="sidebar-link sidebar-title" href="#">
                            <svg class="stroke-icon">
                                <use href="{{asset('assets/svg/icon-sprite.svg#stroke-job-search')}}"></use>
                              </svg>
                              <svg class="fill-icon">
                                <use href="{{asset('assets/svg/icon-sprite.svg#fill-job-search')}}"></use>
                              </svg>
                            <span>Categories</span>
                        </a>
                        <ul class="sidebar-submenu">
                            <li><a href="#">Categories</a></li>
                            <li><a href="#">Sub Categories</a></li>
                        </ul>
                    </li>

                    <li class="sidebar-list">
                        <a class="sidebar-link sidebar-title" href="#">
                            <svg class="stroke-icon">
                                <use href="{{asset('assets/svg/icon-sprite.svg#stroke-to-do')}}"></use>
                              </svg>
                              <svg class="fill-icon">
                                <use href="{{asset('assets/svg/icon-sprite.svg#fill-to-do')}}"></use>
                              </svg>
                            <span>Post</span>
                        </a>
                        <ul class="sidebar-submenu">
                            <li><a href="#">Add Post</a></li>
                            <li><a href="#">Add Video</a></li>
                            <li><a href="#">Pending Post</a></li>
                            <li><a href="#">Posts</a></li>
                            <li><a href="#">Slider Post</a></li>
                        </ul>
                    </li>

                    <li class="sidebar-list">
                        <a class="sidebar-link sidebar-title" href="#">
                            <svg class="stroke-icon">
                                <use href="{{asset('assets/svg/icon-sprite.svg#stroke-gallery')}}"></use>
                              </svg>
                              <svg class="fill-icon">
                                <use href="{{asset('assets/svg/icon-sprite.svg#fill-gallery')}}"></use>
                              </svg>
                            <span>Gallery</span>
                        </a>
                        <ul class="sidebar-submenu">
                            <li><a href="#">Albums</a></li>
                            <li><a href="#">Categories</a></li>
                            <li><a href="#">Images</a></li>
                        </ul>
                    </li>

                    <li class="sidebar-list">
                        <a class="sidebar-link" href="#">
                            <svg class="stroke-icon">
                                <use href="{{asset('assets/svg/icon-sprite.svg#stroke-email')}}"></use>
                              </svg>
                              <svg class="fill-icon">
                                <use href="{{asset('assets/svg/icon-sprite.svg#fill-email')}}"></use>
                              </svg>
                            <span>Newsletter</span>
                        </a>
                    </li>

                    <li class="sidebar-list">
                        <a class="sidebar-link sidebar-title" href="#">
                            <svg class="stroke-icon">
                                <use href="{{asset('assets/svg/icon-sprite.svg#stroke-user')}}"></use>
                              </svg>
                              <svg class="fill-icon">
                                <use href="{{asset('assets/svg/icon-sprite.svg#fill-user')}}"></use>
                              </svg>
                            <span>Users</span>
                        </a>
                        <ul class="sidebar-submenu">
                            <li><a href="#">Add Users</a></li>
                            <li><a href="#">Users</a></li>
                        </ul>
                    </li>
                    <li class="sidebar-list">
                        <a class="sidebar-link" href="#">
                            <svg class="stroke-icon">
                                <use href="{{asset('assets/svg/icon-sprite.svg#stroke-faq')}}"></use>
                              </svg>
                              <svg class="fill-icon">
                                <use href="{{asset('assets/svg/icon-sprite.svg#fill-faq')}}"></use>
                              </svg>
                            <span>Cache System</span>
                        </a>
                    </li>
                    <li class="sidebar-list">
                        <a class="sidebar-link" href="#">
                            <svg class="stroke-icon">
                                <use href="{{asset('assets/svg/icon-sprite.svg#stroke-chat')}}"></use>
                              </svg>
                              <svg class="fill-icon">
                                <use href="{{asset('assets/svg/icon-sprite.svg#fill-chat')}}"></use>
                              </svg>
                            <span>RSS Feed</span>
                        </a>
                    </li>
                    <li class="sidebar-list">
                        <a class="sidebar-link" href="#">
                            <svg class="stroke-icon">
                                <use href="{{asset('assets/svg/icon-sprite.svg#stroke-learning')}}"></use>
                              </svg>
                              <svg class="fill-icon">
                                <use href="{{asset('assets/svg/icon-sprite.svg#fill-learning')}}"></use>
                              </svg>
                            <span>Roles & Permission</span>
                        </a>
                    </li>

                    <li class="sidebar-list">
                        <a class="sidebar-link" href="#">
                            <svg class="stroke-icon">
                                <use href="{{asset('assets/svg/icon-sprite.svg#stroke-maps')}}"></use>
                              </svg>
                              <svg class="fill-icon">
                                <use href="{{asset('assets/svg/icon-sprite.svg#fill-maps')}}"></use>
                              </svg>
                            <span>Sitemap</span>
                        </a>
                    </li>

                    <li class="sidebar-main-title">
                        <div>
                          <h6 class="">Website Direct</h6>
                        </div>
                      </li>
                    <li class="sidebar-list">
                        <a class="sidebar-link sidebar-title" href="#">
                            <svg class="stroke-icon">
                                <use href="{{asset('assets/svg/icon-sprite.svg#stroke-sample-page')}}"></use>
                              </svg>
                              <svg class="fill-icon">
                                <use href="{{asset('assets/svg/icon-sprite.svg#fill-sample-page')}}"></use>
                              </svg>
                            <span>EGSPEC</span>
                        </a>
                        <ul class="sidebar-submenu">
                            <li><a href="{{route('sa_event_index')}}">Events</a></li>
                            <li><a href="{{route('sa_circular_index')}}">Circular</a></li>
                            <li><a href="{{route('sa_newspcc_index')}}">Newspaper Cuts</a></li>
                            <li><a href="#">Placement Statistics</a></li>
                            <li><a href="#">Main Page Slider</a></li>
                            <li><a href="#">Sports Data</a></li>
                            <li><a href="#">Students Achivements</a></li>
                        </ul>
                    </li>
                    <li class="sidebar-list">
                        <a class="sidebar-link" href="#">
                            <svg class="stroke-icon">
                                <use href="{{asset('assets/svg/icon-sprite.svg#stroke-editors')}}"></use>
                              </svg>
                              <svg class="fill-icon">
                                <use href="{{asset('assets/svg/icon-sprite.svg#fill-editors')}}"></use>
                              </svg>
                            <span>Department</span>
                        </a>
                    </li>

                    {{-- oppo --}}


                    <li class="sidebar-main-title">
                        <div>
                          <h6 class="">Settings</h6>
                        </div>
                      </li>
                    <li class="sidebar-list">
                        <a class="sidebar-link sidebar-title" href="#">
                            <svg class="stroke-icon">
                                <use href="{{asset('assets/svg/icon-sprite.svg#stroke-knowledgebase')}}"></use>
                              </svg>
                              <svg class="fill-icon">
                                <use href="{{asset('assets/svg/icon-sprite.svg#fill-knowledgebase')}}"></use>
                              </svg>
                            <span>App Settings</span>
                        </a>
                        <ul class="sidebar-submenu">
                            <li><a href="#">Custom Footer Code</a></li>
                            <li><a href="#">Custom Header Code</a></li>
                            <li><a href="#">General Setting</a></li>
                        </ul>
                    </li>
                    <li class="sidebar-list">
                        <a class="sidebar-link" href="{{ route('admin_profile') }}">
                            <svg class="stroke-icon">
                                <use href="{{asset('assets/svg/icon-sprite.svg#stroke-editors')}}"></use>
                              </svg>
                              <svg class="fill-icon">
                                <use href="{{asset('assets/svg/icon-sprite.svg#fill-editors')}}"></use>
                              </svg>
                            <span>Profile</span>
                        </a>
                    </li>

                </ul>
            </div>
        </nav>
    </div>
</div>
