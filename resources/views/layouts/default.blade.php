<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css"
       >
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap4.min.css">
    
    <script src="https://code.jquery.com/jquery-3.5.1.js">
    </script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js">
    </script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap4.min.js">
    </script>
    <style>
        body {
                background-color: #fbfbfb;
                }
                @media (min-width: 991.98px) {
                main {
                    padding-left: 240px;
                }
                }

                /* Sidebar */
                .sidebar {
                position: fixed;
                top: 0;
                bottom: 0;
                left: 0;
                padding: 58px 0 0; /* Height of navbar */
                box-shadow: 0 2px 5px 0 rgb(0 0 0 / 5%), 0 2px 10px 0 rgb(0 0 0 / 5%);
                width: 240px;
                z-index: 600;
                }

                @media (max-width: 991.98px) {
                .sidebar {
                    width: 100%;
                }
                }
                .sidebar .active {
                border-radius: 5px;
                box-shadow: 0 2px 5px 0 rgb(0 0 0 / 16%), 0 2px 10px 0 rgb(0 0 0 / 12%);
                }

                .sidebar-sticky {
                position: relative;
                top: 0;
                height: calc(100vh - 48px);
                padding-top: 0.5rem;
                overflow-x: hidden;
                overflow-y: auto; /* Scrollable contents if viewport is shorter than content. */
                }
    </style>
    <title>Laravel</title>
</head>

<body class="antialiased">
  <!--Main Navigation-->
<header>
    <!-- Sidebar -->
    <nav id="sidebarMenu" class="collapse d-lg-block sidebar collapse bg-white">
      <div class="position-sticky">
        <div class="list-group list-group-flush mx-3 mt-4"><br>
          <a
            href="/products"
            class="list-group-item list-group-item-action py-2 ripple"
            aria-current="true"
          >
            <i class="fas fa-tachometer-alt fa-fw me-3"></i><span>Products</span>
          </a><br>
          <a href="/categories" class="list-group-item list-group-item-action py-2 ripple"
            ><i class="fas fa-lock fa-fw me-3"></i><span>Categories</span></a
          ><br>
          <a href="/order" class="list-group-item list-group-item-action py-2 ripple"
            ><i class="fas fa-chart-line fa-fw me-3"></i><span>Order</span></a
          ><br>
          <a href="/users" class="list-group-item list-group-item-action py-2 ripple"
            ><i class="fas fa-chart-line fa-fw me-3"></i><span>Users</span></a
          ><br>
           <a href="/admin/noctices" class="list-group-item list-group-item-action py-2 ripple"
          ><i class="fas fa-chart-line fa-fw me-3"></i><span>Notices</span></a
        ><br>
        </div>
      </div>
    </nav>
    <!-- Sidebar -->
  
    <!-- Navbar -->
    <nav id="main-navbar" class="navbar navbar-expand-lg navbar-light bg-white fixed-top">
      <!-- Container wrapper -->
      <div class="container-fluid">
        <!-- Toggle button -->
        <button
          class="navbar-toggler"
          type="button"
          data-mdb-toggle="collapse"
          data-mdb-target="#sidebarMenu"
          aria-controls="sidebarMenu"
          aria-expanded="false"
          aria-label="Toggle navigation"
        >
          <i class="fas fa-bars"></i>
        </button>
  
        <!-- Brand -->
        <a class="navbar-brand" href="#">
          <img
            src="https://mdbcdn.b-cdn.net/img/logo/mdb-transaprent-noshadows.webp"
            height="25"
            alt="MDB Logo"
            loading="lazy"
          />
        </a>
        <!-- Search form -->
        <form class="d-none d-md-flex input-group w-auto my-auto">
          <input
            autocomplete="off"
            type="search"
            class="form-control rounded"
            placeholder='Search (ctrl + "/" to focus)'
            style="min-width: 225px;"
          />
          <span class="input-group-text border-0"><i class="fas fa-search"></i></span>
        </form>
  
        <!-- Right links -->
        <ul class="navbar-nav ms-auto d-flex flex-row">
        
  
          <!-- Avatar -->
          <li class="nav-item">
            <a class="nav-link dropdown-toggle hidden-arrow d-flex align-items-center" href="#"id="navbarDropdownMenuLink"role="button"
              data-mdb-toggle="dropdown"
              aria-expanded="false"
            >
              <img
                src="https://mdbcdn.b-cdn.net/img/Photos/Avatars/img (31).webp"
                class="rounded-circle"
                height="22"
                alt="Avatar"
                loading="lazy"
              />
            </a>
          </li>
        </ul>
      </div>
      <!-- Container wrapper -->
    </nav>
    <!-- Navbar -->
  </header>
  <!--Main Navigation-->
  
  <!--Main layout-->
  <main style="margin-top: 58px;">
      <div class="container">
        @yield('content')
      </div>
  </main>
  <!--Main layout-->

</body>

</html>
