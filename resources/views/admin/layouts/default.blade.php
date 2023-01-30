<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>SLTravel</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
    integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
  <link href="{{ asset('plugins/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet">
  @yield('style')
</head>

<body class="hold-transition sidebar-mini">
  <!-- Site wrapper -->
  <div class="wrapper">
    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-dark navbar-indigo">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
      </ul>


      <!-- Right navbar links -->
      <ul class="navbar-nav ml-auto">
        <!-- Messages Dropdown Menu -->

        <li class="nav-item">
          <a class="nav-link" href="/" onclick="event.preventDefault();
        document.getElementById('logout-form').submit();" role="button">
            <i class="fas fa-sign-out-alt"></i>{{ __('Logout') }}
          </a>
          <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
          </form>
        </li>
      </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-indigo elevation-4">
      <!-- Brand Logo -->
      <a href="{{ route('public_laniding') }}" class="brand-link">
        <img src="{{ asset('dist/img/SltravelLogo.jpg') }}" alt="SLTravel Logo" class="brand-image img-circle elevation-3"
          style="opacity: .8">
        <span class="brand-text font-weight-light">SL Travel</span>
      </a>

      <!-- Sidebar -->
      <div class="sidebar">
        <!-- Sidebar user (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
          <div class="image">
            @if (!empty(auth()->user()->prof_pic))
            <img src="{{ Storage::url(auth()->user()->prof_pic) }}" style="width:35px;height:35px;" class="img-circle elevation-2" alt="User Image">
            @else
            <img src="{{ asset('dist/img/flower.jpg') }}" class="img-circle elevation-2" alt="User Image">
            @endif
          </div>
          <div class="info">
            <a href="#" class="d-block">{{ auth()->user()->fname }} {{ auth()->user()->lname }}</a>
          </div>
        </div>



        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column nav-child-indent text-sm" data-widget="treeview" role="menu"
            data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

            <li class="nav-item">
              <a href="{{route('dashboard')}}" class="nav-link">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>Dashboard</p>
              </a>
            </li>
            @if (in_array(Auth::user()->user_role, ['ADMIN', 'EMP']))
            <li class="nav-item">
              <a href="# " class="nav-link">
                <i class="nav-icon fas fa-address-card "></i>
                <p>
                  Vendor
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="vendor" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Approve/Reject</p>
                  </a>
                </li>
              </ul>
            </li>
            @endif
            @if (in_array(Auth::user()->user_role, ['ADMIN']))
            <li class="nav-item">
              <a href="employee" class="nav-link">
                <i class="fas fa-briefcase nav-icon"></i>
                <p>Employee</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{route('destn.search')}}" class="nav-link">
                <i class="fas fa-globe-asia nav-icon"></i>
                <p>Destinations</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-network-wired"></i>
                <p>
                  Master
                  <i class="right fas fa-angle-left"></i>
                </p>

              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="province" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>
                      Province
                    </p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="district" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>
                      District
                    </p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="city" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>
                      City
                    </p>
                  </a>
                </li>
              </ul>
            </li>
            @endif
            @if (in_array(Auth::user()->user_role, ['ADMIN', 'EMP']))
            <li class="nav-item">
              <a href="{{route('contact.search')}}" class="nav-link">
                <i class="fas fa-user nav-icon"></i>
                <p>Contact Requests</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{route('hotel_review.report.search')}}" class="nav-link">
                <i class="fas fa-hotel nav-icon"></i>
                <p>Hotel Review Reports</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{route('reports.bookings')}}" class="nav-link">
                <i class="fas fa-book nav-icon"></i>
                <p>Reports</p>
              </a>
            </li>
            @endif
            @if (in_array(Auth::user()->user_role, ['VEN']))
            <li class="nav-item">
              <a href="{{route('hotels.search')}}" class="nav-link">
                <i class="fas fa-hotel nav-icon"></i>
                <p>Hotels</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{route('hotel_review.search')}}" class="nav-link">
                <i class="fas fa-pencil nav-icon"></i>
                <p>Reviews</p>
              </a>
            </li>
            @endif
            @if (in_array(Auth::user()->user_role, ['CUS', 'VEN']))
            <li class="nav-item">
              <a href="{{route('hotel_booking.index')}}" class="nav-link">
                <i class="fas fa-hotel nav-icon"></i>
                <p>Bookings</p>
              </a>
            </li>
            @endif
            @if (in_array(Auth::user()->user_role, ['CUS']))
            <li class="nav-item">
              <a href="{{route('hotel_wishlist.index')}}" class="nav-link">
                <i class="fas fa-heart nav-icon"></i>
                <p>Wishlist</p>
              </a>
            </li>
            @endif
            <li class="nav-item">
              <a href="{{route('user_profile.edit')}}" class="nav-link">
                <i class="fas fa-user nav-icon"></i>
                <p>Profile</p>
              </a>
            </li>
          </ul>
        </nav>
        <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1>@yield('title')</h1>
            </div>
          </div>
        </div><!-- /.container-fluid -->
      </section>

      <!-- Main content -->
      <section class="content">

        <!-- Default box -->
        @yield('content')

        <!-- /.card -->

      </section>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <footer class="main-footer">
      <div class="float-right d-none d-sm-block test-sm">
      </div>
      <strong>Copyright &copy; 2014-2022 <a href="./">SL Travel</a>.</strong> All rights reserved.
    </footer>

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
      <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
  </div>
  <!-- ./wrapper -->

  <!-- jQuery -->
  <script src="{{asset('plugins/jquery/jquery.min.js')}}"></script>
  <!-- Bootstrap 4 -->
  <script src="{{asset('plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
  <!-- AdminLTE App -->
  <script src="{{asset('dist/js/adminlte.min.js')}}"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="{{asset('dist/js/demo.js')}}"></script>
  <script src="{{ asset('plugins/sweetalert2/sweetalert2.min.js') }}"></script>
  @if(Session::has('success'))
  <script>
    $(document).ready(function () {
            Swal.fire({
                position: 'top-center',
                icon: 'success',
                title: '{{ Session::get('success') }}',
                showConfirmButton: false,
                timer: 5000
            })
        });
  </script>
  @endif
  @if(Session::has('error'))
  <script>
    $(document).ready(function () {
            Swal.fire({
                position: 'top-center',
                icon: 'error',
                title: '{{ Session::get('error') }}',
                showConfirmButton: false,
                timer: 5000
            })
        });
  </script>
  @endif
  @yield('script')
</body>

</html>