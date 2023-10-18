  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <a href="index3.html" class="brand-link">
          <img src="{{ asset('img/logo/logo2.png') }}" alt="AdminLTE Logo" class="brand-image" style="opacity: .8">
          <span class="brand-text font-weight-light">Kadang Koding</span>
      </a>

      <!-- Sidebar -->
      <div class="sidebar">
          <!-- Sidebar user panel (optional) -->
          <div class="user-panel mt-3 pb-3 mb-3 d-flex">
              <div class="image">
                @if (auth()->check() && auth()->user()->role == 'user')
                @auth
                @if (auth()->user()->intern)
                <img src="{{ asset('files/photo/' . auth()->user()->intern->first()->photo) }}" class=" elevation-2" alt="User Image" width="300px" height="150px">
                @else
                    <!-- Tampilkan foto default atau pesan jika tidak ada foto -->
                    <img src="{{ asset('img/profile1.jpg') }}" class="img-circle elevation-2" alt="User Image">
                @endif
            @endauth
            @endif
            @if (auth()->check() && auth()->user()->role == 'admin')
            <img src="{{ asset('img/profile1.jpg') }}" class="img-circle elevation-2" alt="User Image">
            @endif
              </div>
              <div class="info">
                <span class="ms-1 font-weight-bold text-white">
                    @auth
                        {{ auth()->user()->name }}
                    @else
                        Kadang Koding
                    @endauth</span>
              </div>
          </div>

          <!-- SidebarSearch Form -->
          <div class="form-inline">
              <div class="input-group" data-widget="sidebar-search">
                  <input class="form-control form-control-sidebar" type="search" placeholder="Search"
                      aria-label="Search">
                  <div class="input-group-append">
                      <button class="btn btn-sidebar">
                          <i class="fas fa-search fa-fw"></i>
                      </button>
                  </div>
              </div>
          </div>

          <!-- Sidebar Menu -->
          <nav class="mt-2">
              <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                  data-accordion="false">
                  @if (auth()->check() && auth()->user()->role == 'admin')
                  <li class="nav-item">
                      <a class="nav-link {{ str_contains(request()->url(), 'admin/dashboard') == true ? 'active' : '' }} "
                          href="{{url('admin/dashboard')}}">
                          <i class="nav-icon fas fa-tachometer-alt"></i>
                          <p>
                              Dashboard
                          </p>
                      </a>
                  </li>

                  <li class="nav-header">Master Data</li>
                  <li class="nav-item {{ request()->is('intern*', 'position*', 'user*') ? 'menu-open' : '' }}">
                      <a href="#"
                          class="nav-link {{ request()->is('intern*', 'position*', 'user*') ? 'active' : '' }}">
                          <i class="nav-icon fas fa-folder-open"></i>
                          <p>
                              Management Data
                              <i class="right fas fa-angle-left"></i>
                          </p>
                      </a>
                      <ul class="nav nav-treeview">
                          <li class="nav-item">
                              <a class="nav-link {{ request()->is('intern*') ? 'active' : '' }}" href="{{url('intern')}}">
                                  <i class="nav-icon fas fa-list-ul"></i>
                                  <p>
                                      Intern Management
                                  </p>
                              </a>
                          </li>
                          <li class="nav-item">
                              <a class="nav-link {{ request()->is('position*') ? 'active' : '' }}" href="{{url('position')}}">
                                  <i class="nav-icon fas fa-briefcase"></i>
                                  <p>
                                      Position Management
                                  </p>
                              </a>
                          </li>
                          <li class="nav-item">
                              <a class="nav-link {{ request()->is('users*') ? 'active' : '' }}" href="{{url('users')}}">
                                  <i class="nav-icon fas fa-users"></i>
                                  <p>
                                      User Management
                                  </p>
                              </a>
                          </li>
                          <li class="nav-item">
                            <a class="nav-link {{ request()->is('report*') ? 'active' : '' }}" href="{{url('reports')}}">
                                <i class="nav-icon fas fa-clipboard"></i>
                                <p>
                                    Report Management
                                </p>
                            </a>
                        </li>
                      </ul>
                  </li>
                  
                  <li class="nav-header">Account Pages</li>
                  <li class="nav-item">
                    <a class="nav-link {{ request()->is('admin/profile*') ? 'active' : '' }}" href="{{url('admin/profile')}}">
                        <i class="nav-icon fas fa-user"></i>
                        <p>
                            Profile
                        </p>
                    </a>
                </li>
                  @endif
              {{-- </ul> --}}
                @if (auth()->check() && auth()->user()->role == 'user')
                <li class="nav-item">
                  <a class="nav-link {{ str_contains(request()->url(), 'user/dashboard') == true ? 'active' : '' }} "
                      href="{{url('user/dashboard')}}">
                      <i class="nav-icon fas fa-tachometer-alt"></i>
                      <p>
                          Dashboard
                      </p>
                  </a>
                  </li>
                  <li class="nav-item">
                  <a class="nav-link {{ str_contains(request()->url(), 'report') == true ? 'active' : '' }} "
                      href="{{url('#')}}">
                      <i class="nav-icon fas fa-folder-open"></i>
                      <p>
                          Report Management
                      </p>
                  </a>
                  </li>
                  <li class="nav-header">Account Pages</li>
                <li class="nav-item">
                  <a class="nav-link {{ request()->is('profile*') ? 'active' : '' }}" href="{{ url('profile') }}">
                      <i class="nav-icon fas fa-user"></i>
                      <p>
                          Profile
                      </p>
                  </a>
              </li>
              
                  @endif
              </ul>
          </nav>
          <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
  </aside>
