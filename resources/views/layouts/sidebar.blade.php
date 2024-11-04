<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Sidebar</title>
  <link rel="stylesheet" href="{{ url('resources/css/sidebar.css') }}">
  <script src="https://unpkg.com/@phosphor-icons/web"></script>
</head>
<body>
  <div class="container">
    <div class="sidebar">
      <!-- <div class="menu-btn"><i class="ph-bold ph-caret-left"></i></div> -->
      <div class="head">
        <div class="user-img"><img src="https://images.unsplash.com/photo-1496181133206-80ce9b88a853?crop=entropy&cs=srgb&fm=jpg&ixid=M3wzMjM4NDZ8MHwxfHJhbmRvbXx8fHx8fHx8fDE3MTUzMjAyMTh8&ixlib=rb-4.0.3&q=85" alt=""></div>
        <div class="user-details">
          <p class="title">
              {{ Auth::user()->identify_as == 1 ? 'Admin' : 'Warehouse' }}
          </p>
          <p class="name">{{Auth::user()->name}}</p>
        </div>
      </div>
      <div class="nav">
        <div class="menu">
          <p class="title">Main</p>
          <ul>
            <li><a href="{{ route('dashboard') }}"><i class="icon ph-bold ph-house-simple"></i><span class="text">Dashboard</span></a></li>
            <li><a href="#"><i class="icon ph-bold ph-user"></i><span class="text">Viewers</span><i class="arrow ph-bold ph-caret-down"></i></a>
              <ul class="sub-menu">
                <li><a href="{{ route('user.management') }}"><span class="text">Users</span></a></li>
                <li><a href="{{ route('warehouses.management') }}"><span class="text">WareHouses</span></a></li>
              </ul>
            </li>
            <!-- <li><a href="#"><i class="icon ph-bold ph-calendar-blank"></i><span class="text">Agenda</span></a></li> -->
            <li><a href="#"><i class="icon ph-bold ph-chart-bar"></i><span class="text">Revenue</span><i class="arrow ph-bold ph-caret-down"></i></a>
              <ul class="sub-menu">
                <li><a href="#"><span class="text">Earnings</span></a></li>
                <li><a href="#"><span class="text">Funds</span></a></li>
                <li><a href="#"><span class="text">Declines</span></a></li>
                <li><a href="#"><span class="text">Payouts</span></a></li>
              </ul>
            </li>
            <!-- <li class="active"><a href="#"><i class="icon ph-bold ph-file-text"></i><span class="text">Articles</span></a></li> -->
          </ul>
        </div>
        <div class="menu">
          <p class="title">Settings</p>
          <ul>
            <li><a href="#"><i class="icon ph-bold ph-gear"></i><span class="text">Settings</span></a></li>
          </ul>
        </div>
      </div>
      <div class="menu">
        <p class="title">Account</p>
        <ul>
          <li><a href="#"><i class="icon ph-bold ph-info"></i><span class="text">FAQ</span></a></li>
          <li>
              <a href="{{ route('logout') }}"
                 onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                  <i class="icon ph-bold ph-sign-out"></i>
                  <span class="text">Logout</span>
              </a>
              <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                  @csrf
              </form>
          </li>
        </ul>
      </div>
    </div>
  </div>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.js" integrity="sha512-8Z5++K1rB3U+USaLKG6oO8uWWBhdYsM3hmdirnOEWp8h2B1aOikj5zBzlXs8QOrvY9OxEnD2QDkbSKKpfqcIWw==" crossorigin="anonymous"></script>
  <script src="{{ url('resources/js/sidebar.js') }}"></script>
</body>
</html>
