<!DOCTYPE html>

<!-- =========================================================
* Sneat - Bootstrap 5 HTML Admin Template - Pro | v1.0.0
==============================================================

* Product Page: https://themeselection.com/products/sneat-bootstrap-html-admin-template/
* Created by: ThemeSelection
* License: You must have a valid license purchased in order to legally use the theme for your project.
* Copyright ThemeSelection (https://themeselection.com)

=========================================================
 -->
<!-- beautify ignore:start -->
<html
  lang="en"
  class="light-style layout-menu-fixed"
  dir="ltr"
  data-theme="theme-default"
  data-assets-path="../assets/"
  data-template="vertical-menu-template-free"
>
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"
    />

    <title>{{ $pageTitle ?? 'GOM' }}</title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('frontend-assets/image/favicon/favicon.ico')}}" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
      rel="stylesheet"
    />

    <!-- Icons. Uncomment required icon fonts -->
    {{-- <link rel="stylesheet" href="{{ asset('admin-assets/vendor/fonts/boxicons.css" /> --}}
    <link rel="stylesheet" href="{{ asset('admin-assets/vendor/fonts/boxicons.css')}}" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="{{ asset('admin-assets/vendor/css/core.css')}}" class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{ asset('admin-assets/vendor/css/theme-default.css')}}" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="{{ asset('admin-assets/css/demo.css')}}" />
    <link rel="stylesheet" href="{{ asset('admin-assets/css/gom.css')}}" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="{{ asset('admin-assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css')}}" />

    <link rel="stylesheet" href="{{ asset('admin-assets/vendor/libs/apex-charts/apex-charts.css')}}" />

    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/vanilla-datatables@4.3.0/dist/vanilla-dataTables.min.css">

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">

    <!-- Page CSS -->

    <!-- Helpers -->
    <script src="{{ asset('admin-assets/vendor/js/helpers.js')}}"></script>

    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="{{ asset('admin-assets/js/config.js')}}"></script>
  </head>

  <body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
      <div class="layout-container">
        <!-- Menu -->

        <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
          <div class="app-brand demo">
            <a href="index.html" class="app-brand-link">
              <span class="app-brand-text demo menu-text fw-bolder ms-2"><a href="{{route('dashboard')}}"id="GOM">
                <img src="{{asset('frontend-assets/image/logo.png')}}" class="logologin" alt="" style="width: 190px;" />
              </a></span>
            </a>

            <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
              <i class="bx bx-chevron-left bx-sm align-middle"></i>
            </a>
          </div>

          <div class="menu-inner-shadow"></div>

          <ul class="menu-inner py-1">
            <li class="menu-item @if(request()->routeIs('dashboard')) open @endif">
              <a href="{{route('dashboard')}}" class="menu-link ">
                  <!-- <i class="menu-icon tf-icons bx bx-home-circle"></i> -->
                  <img src="{{asset('admin-assets/admin-icons/admin.jpg')}}" width="25px" height="25px" style="margin-right:5px;">
                  <div data-i18n="Analytics">Admin</div>
              </a>
          </li>
           <!-- Extended components 1 -->
           {{-- <li class="menu-item open"> --}}
            <li class="menu-item @if(request()->routeIs('home.create') || request()->routeIs('about.create') || request()->routeIs('musicsearch.create') || request()->routeIs('licensing.create') || request()->routeIs('contact.create') || request()->routeIs('terms.create')) open @endif">
            <a href="{{route('home.create')}}" class="menu-link menu-toggle ">
              <!-- <i class="menu-icon tf-icons bx bx-copy"></i> -->
              <img src="{{asset('admin-assets/admin-icons/pages.png')}}" width="30px" height="30px" style="margin-right:5px;">
              <div data-i18n="Extended UI">Pages</div>
            </a>
            <ul class="menu-sub">
              <li class="menu-item @if(request()->routeIs('home.create')) open @endif">
                <a href="{{route('home.create')}}" class="menu-link">
                  <div data-i18n="Perfect Scrollbar">Home</div>
                </a>
              </li>
              <li class="menu-item @if(request()->routeIs('about.create')) open @endif">
                <a href="{{route('about.create')}}" class="menu-link">
                  <div data-i18n="Text Divider">About</div>
                </a>
              </li>
              <li class="menu-item @if(request()->routeIs('musicsearch.create')) open @endif">
                <a href="{{route('musicsearch.create')}}" class="menu-link">
                  <div data-i18n="Text Divider">Music Search</div>
                </a>
              </li>
              <li class="menu-item @if(request()->routeIs('licensing.create')) open @endif">
                <a href="{{route('licensing.create')}}" class="menu-link">
                  <div data-i18n="Text Divider">Licensing</div>
                </a>
              </li>
              <li class="menu-item @if(request()->routeIs('contact.create')) open @endif">
                <a href="{{route('contact.create')}}" class="menu-link">
                  <div data-i18n="Text Divider">Contact</div>
                </a>
              </li>
              <li class="menu-item @if(request()->routeIs('terms.create')) open @endif">
                <a href="{{route('terms.create')}}" class="menu-link">
                  <div data-i18n="Text Divider">Terms</div>
                </a>
              </li>
            </ul>
          </li>
          
          <li class="menu-item @if(request()->routeIs('slider')) open @endif">
              <a href="{{route('slider')}}" class="menu-link">
                  <!-- <i class="menu-icon tf-icons bx bx-layout"></i> -->
                  <img src="{{asset('admin-assets/admin-icons/slider.png')}}" width="30px" height="30px" style="margin-right:5px;">
                  <div data-i18n="Analytics">Slider</div>
              </a>
          </li>
          <li class="menu-item @if(request()->routeIs('faqs')) open @endif">
            <a href="{{route('faqs')}}" class="menu-link" style="margin-left:20px;">
                <!-- <i class="menu-icon tf-icons bx bx-layout"></i> -->
                <img src="{{asset('admin-assets/admin-icons/faq.png')}}" width="22px" height="22px" style="margin-right:5px; object-fit:cover;">
                <div data-i18n="Analytics">FAQ's</div>
            </a>
          </li>
          <li class="menu-item @if(request()->routeIs('coupon')) open @endif">
            <a href="{{route('coupon')}}" class="menu-link" style="margin-left:22px;">
                <!-- <i class="menu-icon tf-icons bx bx-layout"></i> -->
                <img src="{{asset('admin-assets/admin-icons/coupon.png')}}" width="20px" height="25px" style="margin-right:5px;">
                <div data-i18n="Analytics">Coupons</div>
            </a>
          </li>
          <li class="menu-item @if(request()->routeIs('artist')) open @endif">
            <a href="{{route('artist')}}" class="menu-link">
                <!-- <i class="menu-icon tf-icons bx bx-layout"></i> -->
                <img src="{{asset('admin-assets/admin-icons/slider.png')}}" width="30px" height="30px" style="margin-right:5px;">
                <div data-i18n="Analytics">Artists</div>
            </a>
        </li>          
          <li class="menu-item @if(request()->routeIs('musictitles')) open @endif">
              <a href="{{route('musictitles')}}" class="menu-link">
                  <!-- <i class="menu-icon tf-icons bx bx-layout"></i> -->
                  <img src="{{asset('admin-assets/admin-icons/music-title.png')}}" width="30px" height="30px" style="margin-right:5px;">
                  <div data-i18n="Analytics">Music Titles</div>
              </a>
          </li>
           <!-- Extended components 2 -->
           <li class="menu-item @if(request()->routeIs('genre') || request()->routeIs('tempo') || request()->routeIs('version'))   open @endif">
            <a href="javascript:void(0)" class="menu-link menu-toggle">
              <!-- <i class="menu-icon tf-icons bx bx-copy"></i> --> 
              <img src="{{asset('admin-assets/admin-icons/music-field.png')}}" width="30px" height="30px" style="margin-right:5px;">
              <div data-i18n="Extended UI">Music Fields</div>
            </a>
            <ul class="menu-sub">
              <li class="menu-item @if(request()->routeIs('genre')) open @endif">
                <a href="{{route('genre')}}" class="menu-link ">
                  <div data-i18n="Perfect Scrollbar">Genre</div>
                </a>
              </li>
              <li class="menu-item @if(request()->routeIs('tempo')) open @endif">
                <a href="{{route('tempo')}}" class="menu-link">
                  <div data-i18n="Text Divider">Tempo</div>
                </a>
              </li>
              <li class="menu-item @if(request()->routeIs('version')) open @endif">
                <a href="{{route('version')}}" class="menu-link">
                  <div data-i18n="Text Divider">Version</div>
                </a>
              </li>
            </ul>
          </li>
         
            

             <!-- Extended components 3 -->
           <li  class="menu-item  @if(request()->routeIs('license') || request()->routeIs('territory') || request()->routeIs('term'))  open @endif">
            <a href="javascript:void(0)" class="menu-link menu-toggle">
              <!-- <i class="menu-icon tf-icons bx bx-copy"></i> -->
              <img src="{{asset('admin-assets/admin-icons/licencing.png')}}" width="30px" height="30px" style="margin-right:5px;">
              <div data-i18n="Extended UI">Licensing</div>
            </a>
            <ul class="menu-sub">
              <li class="menu-item @if(request()->routeIs('license')) open @endif">
                <a href="{{route('license')}}" class="menu-link">
                  <div data-i18n="Perfect Scrollbar">License</div>
                </a>
              </li>
              <li class="menu-item @if(request()->routeIs('territory')) open @endif">
                <a href="{{route('territory')}}" class="menu-link">
                  <div data-i18n="Text Divider">Territory</div>
                </a>
              </li>
              <li class="menu-item @if(request()->routeIs('term')) open @endif">
                <a href="{{route('term')}}" class="menu-link">
                  <div data-i18n="Text Divider">Term</div>
                </a>
              </li>
            </ul>
          </li>
            
          <li class="menu-item @if(request()->routeIs('purchase')) open @endif">
              <a href="{{ route('purchase') }}" class="menu-link">
                  <!-- <i class="menu-icon tf-icons bx bx-layout"></i> -->
                  <img src="{{asset('admin-assets/admin-icons/purchase.png')}}" width="30px" height="30px" style="margin-right:5px;">
                  <div data-i18n="Analytics">Purchases</div>
              </a>
          </li>

        <li class="menu-item @if(request()->routeIs('reports')) open @endif" >
            <a href="{{ route('reports') }}" class="menu-link">
                <!-- <i class="menu-icon tf-icons bx bx-layout"></i> -->
                <img src="{{asset('admin-assets/admin-icons/reports.png')}}" width="30px" height="30px" style="margin-right:5px;">
                <div data-i18n="Analytics">Reports</div>
            </a>
        </li>

      <li class="menu-item @if(request()->routeIs('promotion')) open @endif">
        <a href="{{ route('promotion') }}" class="menu-link">
            <!-- <i class="menu-icon tf-icons bx bx-layout"></i> -->
            <img src="{{asset('admin-assets/admin-icons/promotion.png')}}" width="30px" height="30px" style="margin-right:5px;">
            <div data-i18n="Analytics">Promotion</div>
        </a>
    </li>

        <li class="menu-item @if(request()->routeIs('state')) open @endif">
          <a href="{{route('state')}}" class="menu-link">
              <!-- <i class="menu-icon tf-icons bx bx-layout"></i> -->
              <img src="{{asset('admin-assets/admin-icons/state.png')}}" width="30px" height="30px" style="margin-right:5px;">
              <div data-i18n="Analytics">State</div>
          </a>
      </li>
      <li class="menu-item @if(request()->routeIs('country')) open @endif">
        <a href="{{route('country')}}" class="menu-link">
            <!-- <i class="menu-icon tf-icons bx bx-layout"></i> -->
            <img src="{{asset('admin-assets/admin-icons/country.png')}}" width="30px" height="30px" style="margin-right:5px;">
            <div data-i18n="Analytics">Country</div>
        </a>
    </li>
    
    <li class="menu-item @if(request()->routeIs('users')) open @endif">
      <a href="{{route('users')}}" class="menu-link">
          <!-- <i class="menu-icon tf-icons bx bx-layout"></i> -->
          <img src="{{asset('admin-assets/admin-icons/user.png')}}" width="30px" height="30px" style="margin-right:5px;">
          <div data-i18n="Analytics">Users</div>
      </a>
  </li>
    
    <li class="menu-item @if(request()->routeIs('subscribe')) open @endif">
      <a href="{{route('subscribe')}}" class="menu-link">
          <!-- <i class="menu-icon tf-icons bx bx-layout"></i> -->
          <img src="{{asset('admin-assets/admin-icons/newsletter.png')}}" width="30px" height="30px" style="margin-right:5px;">
          <div data-i18n="Analytics">Newsletter Subscribers</div>
      </a>
  </li>
  <li class="menu-item @if(request()->routeIs('contact')) open @endif">
    <a href="{{route('contact')}}" class="menu-link">
        <!-- <i class="menu-icon tf-icons bx bx-layout"></i> -->
        <img src="{{asset('admin-assets/admin-icons/contact.png')}}" width="30px" height="30px" style="margin-right:5px;">
        <div data-i18n="Analytics">Contact</div>
    </a>
  </li>
            
        </aside>
        <!-- / Menu -->

        <!-- Layout container -->
        <div class="layout-page">
          <!-- Navbar -->

          <nav
            class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme"
            id="layout-navbar"
          >
            <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
              <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
                <i class="bx bx-menu bx-sm"></i>
              </a>
            </div>

            <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
              <!-- Search -->
              {{-- <div class="navbar-nav align-items-center">
                <div class="nav-item d-flex align-items-center">
                  <i class="bx bx-search fs-4 lh-0"></i>
                  <input
                    type="text"
                    class="form-control border-0 shadow-none"
                    placeholder="Search..."
                    aria-label="Search..."
                  />
                </div>
              </div> --}}
              <!-- /Search -->

              <ul class="navbar-nav flex-row align-items-center ms-auto">
                <!-- Place this tag where you want the button to render. -->
                {{-- <li class="nav-item lh-1 me-3">
                  <a
                    class="github-button"
                    href="https://github.com/themeselection/sneat-html-admin-template-free"
                    data-icon="octicon-star"
                    data-size="large"
                    data-show-count="true"
                    aria-label="Star themeselection/sneat-html-admin-template-free on GitHub"
                    >Star</a
                  >
                </li> --}}

                <!-- User -->
                <?php
                $user = App\Models\Login::first();
                ?>
                <li class="nav-item navbar-dropdown dropdown-user dropdown">
                  <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                    <div class="avatar avatar-online">
                      @if($user->image)
                      <img src="{{ asset('admin-assets/images/adminprofile.png')}}" alt class="w-px-40 h-px-40 rounded-circle" />
                      @else
                      <img src="{{ asset('admin-assets/img/avatars/user.jpg')}}" alt class="w-px-40 h-auto rounded-circle" />
                      @endif
                    </div>
                  </a>
                  <ul class="dropdown-menu dropdown-menu-end">
                    <li>
                      <a class="dropdown-item">
                        <div class="d-flex">
                          <div class="flex-shrink-0 me-3">
                            <div class="avatar avatar-online">
                              @if($user->image)
                              <img src="{{ asset('admin-assets/images/adminprofile.png')}}" alt class="w-px-40 h-px-40 rounded-circle" />
                              @else
                              <img src="{{ asset('admin-assets/img/avatars/user.jpg')}}" alt class="w-px-40 h-auto rounded-circle" />
                              @endif
                            </div>
                          </div>
                          <div class="flex-grow-1">
                            <span class="fw-semibold d-block">{{$user->name}}</span>
                            <small class="text-muted">admin</small>
                          </div>
                        </div>
                      </a>
                    </li>
                    <li>
                      <div class="dropdown-divider"></div>
                    </li>
                    <li>
                      <a class="dropdown-item" href="{{route('profile')}}">
                        <i class="bx bx-user me-2"></i>
                        <span class="align-middle">My Profile</span>
                      </a>
                    </li>
                    <li>
                      <a class="dropdown-item" href="{{route('settings')}}">
                        <i class="bx bx-cog me-2"></i>
                        <span class="align-middle">Settings</span>
                      </a>
                    </li>
                    {{-- <li>
                      <a class="dropdown-item" href="#">
                        <span class="d-flex align-items-center align-middle">
                          <i class="flex-shrink-0 bx bx-credit-card me-2"></i>
                          <span class="flex-grow-1 align-middle">Billing</span>
                          <span class="flex-shrink-0 badge badge-center rounded-pill bg-danger w-px-20 h-px-20">4</span>
                        </span>
                      </a>
                    </li> --}}
                    <li>
                      <div class="dropdown-divider"></div>
                    </li>
                    <li>
                      <a class="dropdown-item" href="{{route('logout')}}">
                        <i class="bx bx-power-off me-2"></i>
                        <span class="align-middle">Log Out</span>
                      </a>
                    </li>
                  </ul>
                </li>
                <!--/ User -->
              </ul>
            </div>
          </nav>

          <!-- / Navbar -->

          <!-- Content wrapper -->
          <div class="content-wrapper">
            <!-- Content -->
@yield('content')

            <!-- Footer -->
            <!-- <footer class="content-footer footer bg-footer-theme">
              <div class="container-xxl d-flex flex-wrap justify-content-between py-2 flex-md-row flex-column">
                <div class="mb-2 mb-md-0">
                  ©
                  <script>
                    document.write(new Date().getFullYear());
                  </script>
                  , made with ❤️ by
                  <a href="https://themeselection.com" target="_blank" class="footer-link fw-bolder">Banttech</a>
                </div>
                {{-- <div>
                  <a href="https://themeselection.com/license/" class="footer-link me-4" target="_blank">License</a>
                  <a href="https://themeselection.com/" target="_blank" class="footer-link me-4">More Themes</a>

                  <a
                    href="https://themeselection.com/demo/sneat-bootstrap-html-admin-template/documentation/"
                    target="_blank"
                    class="footer-link me-4"
                    >Documentation</a
                  >

                  <a
                    href="https://github.com/themeselection/sneat-html-admin-template-free/issues"
                    target="_blank"
                    class="footer-link me-4"
                    >Support</a
                  >
                </div> --}}
              </div> -->
            </footer>
            <!-- / Footer -->

            <div class="content-backdrop fade"></div>
          </div>
          <!-- Content wrapper -->
        </div>
        <!-- / Layout page -->
      </div>

      <!-- Overlay -->
      <div class="layout-overlay layout-menu-toggle"></div>
    </div>
    <!-- / Layout wrapper -->

    {{-- <div class="buy-now">
      <a
        href="https://themeselection.com/products/sneat-bootstrap-html-admin-template/"
        target="_blank"
        class="btn btn-danger btn-buy-now"
        >Upgrade to Pro</a
      >
    </div> --}}

    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    <script src="{{ asset('admin-assets/vendor/libs/jquery/jquery.js')}}"></script>
    <script src="{{ asset('admin-assets/vendor/libs/popper/popper.js')}}"></script>
    <script src="{{ asset('admin-assets/vendor/js/bootstrap.js')}}"></script>
    <script src="{{ asset('admin-assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js')}}"></script>

    <script src="{{ asset('admin-assets/vendor/js/menu.js')}}"></script>
    <!-- endbuild -->

    <!-- Vendors JS -->
    <script src="{{ asset('admin-assets/vendor/libs/apex-charts/apexcharts.js')}}"></script>

    <!-- Main JS -->
    <script src="{{ asset('admin-assets/js/main.js')}}"></script>

    <!-- Page JS -->
    <script src="{{ asset('admin-assets/js/dashboards-analytics.js')}}"></script>

    <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="{{ asset('admin-assets/https://buttons.github.io/buttons.js')}}"></script>


    <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
  </body>
</html>
