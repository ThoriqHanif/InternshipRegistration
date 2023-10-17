<body class="hold-transition sidebar-mini layout-fixed">
  <div class="wrapper">  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      {{-- <li class="nav-item d-none d-sm-inline-block">
        <a href="index3.html" class="nav-link">Home</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link">Contact</a>
      </li> --}}
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Navbar Search -->
      <form id="logout-form" action="{{ url('logout') }}" method="POST" ">
        @csrf
        <a href="{{ url('logout') }}"
        onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
            class="nav-link text-white font-weight-bold px-0">
            {{-- <i class="fa fa-user me-sm-1"></i> --}}
            <button class="btn btn-md btn-danger d-sm-inline d-none" id="logout">Log out</button>
        </a>
    </form>
    </ul>
  </nav>
  <!-- /.navbar -->