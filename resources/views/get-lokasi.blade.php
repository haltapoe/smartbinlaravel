@extends('layouts.app')
@section('content')
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>SmartBin | Lokasi</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="plugins/summernote/summernote-bs4.min.css">
  <!-- map leaflet -->
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css" />

</head>

<body class="hold-transition sidebar-mini layout-fixed dark-mode" data-panel-auto-height-mode="height">
  <div class="wrapper">

    <!-- Preloader -->
    <div class="preloader flex-column justify-content-center align-items-center">
      <img class="animation__shake" src="icon-smartbin.png" alt="SmartBin Logo" height="60" width="60">
    </div>

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-dark">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
          <a href="{{ route('home') }}" class="nav-link">Beranda</a>
        </li>
      </ul>

      <!-- Right navbar links -->
      <ul class="navbar-nav ml-auto">
        <!-- navbar logout -->
        <li class="nav-item">
          <a class="btn btn-danger" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();"><img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADAAAAAwCAYAAABXAvmHAAAACXBIWXMAAAsTAAALEwEAmpwYAAABeklEQVR4nO2ZS0oDQRBAx4WCuosrjQfQoyQIEVFc6AVEd4KXiAcRl/EMQhD1BH5w4gfRlZ/VCE8aWmzHWYShqrVJvQNU1Zuurm56sswwDONfA0wAO0AfeEOGd+AU2AOmNYufA87R5RJY1Pry2sV/kQMz0gKubWKyLy3gej6k51pKKHYTOCjFv5OIHSZ5LSVoCsefBB6C+HkmnOAHosG/c7SBAXANtJITUMUERmUFgDXg2U0hYDm1TTwGPAVpCmA9tRV4LKWSkYgosOKLlpWIOYWA1QqJD2AzmXMAaYlhBPxJ6k5RTYpa02lIgVviMNAScPeYGORaAi3gKtkWUjiRi4pNvFE3YDQBpIuPKQB0kj7I+D0IkrtK3IsX/wctlPtp1pEMHG0Tq2ACo7ACwJLfxO5C2JYO/pL6w1a/JHAkJQHMA4faT4vbxKWr8bx+Fqn4G6AhKuAlZv2fFE0ugAXx4gOJcWALOK54sa6L+1V1AuwCU2rFG4ZhZNp8AgP1WnQOYyj4AAAAAElFTkSuQmCC" width="20px"></img>
            {{ __('Logout') }}
          </a>

          <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
          </form>
        </li>
      </ul>
    </nav>
    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <a href="{{ route('home') }}" class="brand-link">
        <img src="icon-smartbin.png" alt="SmartBin Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">SmartBin</span>
      </a>

      <!-- Sidebar -->
      <div class="sidebar">

        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
            <li class="nav-item menu-open">
              <a href="#" class="nav-link active">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>
                  Daftar Menu
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="{{ route('get-lokasi') }}" class="nav-link active">
                    <img width="25" height="25" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADAAAAAwCAYAAABXAvmHAAAACXBIWXMAAAsTAAALEwEAmpwYAAABz0lEQVR4nO3YzYtOURzA8RPFJAtJIVlIXqJsLFBjYScWpCwslJ2XjZ2dUhaslJUUq1nZWGnKRpGysFHKRpmiyZS8phhm5qNbtzw9YZ7nnnvuPY/u9y/4fm/3nN85J4SOjo6OVGAzxsMogQ24hfd+8xHrQ65gBS7jtb/zMOQEluA0nmPB4kyFHMBBPMIPw3G37cU4gc+qs6tp6dW4hhnxvGtKehnO4cWA//Wg3EgtfgRPMC8Na1NI78UkZqVlqk7pTbjZN2RSczFWelU5ZN5onnmMxchfrXkxDsuzGPmT2udUVfndFSZl3czGfP1iobbNg5iA223b40BMwD78bFH+S2X5noj9xS7QUsCd6ICeM/txvGo4YEctAX2HtPPl1S41M7XK/+GIXAy3bwkDricL6AnZWG61czXLL2BN8oCekJ24V2PAy8bk+0IOYbqGgAutBJQR2/A1Qn6u2CxaCygjLkUEPG1VvgxYibcVA06EHMDZCvLfQy5gafkqMQz3Q07g2JAB4yE38HhA+U8hR7BnwPv0RMiV4kF2gIAtIVewdZG79XTIneJd8x8BZ0LuYF1xRewTL9bGlTAq4HDxRF7Kf8DRMGpgDNuxvG2Xjo7/iV8o958YCuMy6QAAAABJRU5ErkJggg==" />
                    <p>Lokasi</p>
                  </a>
                </li>
                <li class="nav-item menu-open">
                  <a href="{{ route('get-rute') }}" class="nav-link">
                    <img width="25" height="25" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADIAAAAyCAYAAAAeP4ixAAAACXBIWXMAAAsTAAALEwEAmpwYAAACxUlEQVR4nO2Yu49NQRzHZ7FIECFeHSJLIYhC9rrWo1LQildCFB6F6GhWxKNQYCMi/gBEsSHRUCGLpZFNUCg8glVZiY2VEGL5yMjv2FnnfWfOnXvjfLsz8zu/7/nM+c3jHKVKlSpVqtT/JKAF6CG7elUjClhJPt1XjSjgrDzgGdXkZdUvIO2qWQVUBeKdhlLNKoooK+Ah/lRxCeJL/UFZpQxmT6byw5/+lpWTN0dYVevXPDr/qrSHCxpU+N4u6eqqBaTDMcjqpLJKAalExWcFqYdGrVYJIC3A20zl5QmkPQtIrvLyABEqEwc5H+RJUnU00UMj6wCEPEk6HE30im8QF4o8W7lIrIBb1E+RE9ZFYiWJ5gGbgdPAXeAzDXi2In5zJe6GscBiYBdwAXgEfLeESN/UUqTnaS6QmCTjBG4ncA7oA37m3QSBLZYDYg0yJqJtCrAOOARcNXbh2LKSOK8gQ3KkPgVsAubGxM0CNgLHgJvAB+COHDcmA198g0RpALgBHAU2ADNTcug3V4hUBoBW4ESOnG+AbuAgsBaYqgHl+ocXEGCi/p8kscPANWA/sB04DDx2/DzDtXqkgVyWuFfAkoh+Xff7HCzN1h4qAWKFxAwC81OAtZGNrD1Uwo2XJKbTaFsjr3pIltEZxqg9sQCx9lAJIM8kZqFcT5eRM9VtxB+xALH2UAkgXyVmglyvj7h/0IjfYQFi69GbBKI3Mq3Zct0G/PonQZ8Rf0DazscmDXsMFO2hZDfW2ma0HTeMPurTqNF3Xdp3N5KHMlaJp8B4o71NSmCa0bZc9oBvweTM6LGnaA+lEwMvxUjvJ60xcQuA1xJ3MrPBiMfzIj3+CFhmfGTppW8rMEceYJGsIp+k/14wafMIWCpLbWEeJswLknUFmFSTwQhMoR6BkR6dvcBt4L0cF/S3x0X9p8QqeR09SpUqpZpfvwEgyUkisbZ/cwAAAABJRU5ErkJggg==" />
                    <p>Rute
                      <i class="right fas fa-angle-left"></i>
                    </p>
                  </a>
                  <ul class="nav nav-treeview">
                    <li class="nav-item ml-4">
                      <a href="{{ route('get-rute') }}" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Nama Rute</p>
                      </a>
                    </li>
                    <li class="nav-item ml-4">
                      <a href="{{ route('get-rute') }}" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Smartbin Visit</p>
                      </a>
                    </li>
                    <li class="nav-item ml-4">
                      <a href="{{ route('get-rute') }}" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Jadwal</p>
                      </a>
                    </li>
                  </ul>
                </li>
                <li class="nav-item">
                  <a href="{{ route('get-centimeter-data') }}" class="nav-link">
                    <img width="25" height="25" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADIAAAAyCAYAAAAeP4ixAAAACXBIWXMAAAsTAAALEwEAmpwYAAABy0lEQVR4nM3ZvyuFURwG8JdikWKg5A+gpCSWy01JYWdgkJKJgYFBJoZLMjDekpKSiUFKSvJbDAwyMRBuYr9F99HpHnWHy33vvef7fN9nPJ33POfznuGt93ieowAoBjAP4BWZ8wJgzjzjBS1IbizbRLygBcm3bBLyMbf192S8oAU2UvNpCTQEwCmCk5N8IMcITo5cnMyjIuAhb0AK5FwRcuYSsq0I2XIJifooDKV8H/yOt/hYN+oSMpupLWVuXuNpMuMSMgo9yIhLSK8ipMclpE0REnYJqVWE1LiElCtCylxCCgDEFSBx0+0MYgufFSBPThG28FoBciUB2VWA7EhAVhUgK/SfC0KQiARkXAEyJgHpV4D0SUA6FCDtEpB6BUidBKRSAVIhASkE8EWEfJtO5xBbGiNC3kQQtvSWCLmRhOwTIXuSkHUiZE0SskiELEhCJomQCUnIIBEyIAnpJkI6JSGNREiDJKSaCKmShBQBSBAgCdMlBrHFnwTIhyjCFt8TIHcMyCEBcsCAbBIgGwzI8h/l5vYpnOV4upsskyUGZBrymWJAhgmQIQakiwDpZEBKAbwLImIASsQhFtMM4PK/nxE5xKx1AaApl039ADHK3/YJmOgMAAAAAElFTkSuQmCC" />
                    <p>Kapasitas Sampah</p>
                  </a>
                </li>
              </ul>
            </li>
          </ul>
        </nav>
        <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
    </aside>

    <!-- content-wrapper -->
    <div class="content-wrapper" style="min-height: 638.2px;">
      <!-- main content -->
      <section class="content">
        <!-- map peta -->
        <style>
          #map {
            height: 92vh;
            width: 100%;
          }

          .legend {
            background-color: #343a40;
            padding: 10px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            position: absolute;
            bottom: 20px;
            right: 20px;
            z-index: 1000;
            display: flex;
            flex-direction: row;
          }

          .legend-item {
            display: flex;
            align-items: center;
            margin-right: 15px;
            margin-bottom: 5px;
          }

          .legend-icon {
            width: 20px;
            height: 20px;
            margin-right: 8px;
          }
          
        </style>

        <div id="map">
          
        <!-- Legenda -->
        <div class="legend">
          <div class="legend-item">
            <i class="fas fa-circle nav-icon mr-2 text-danger"></i>
            Tertunda
          </div>
          <div class="legend-item">
            <i class="fas fa-circle nav-icon mr-2 text-warning"></i>
            Dalam Perjalanan
          </div>
          <div class="legend-item">
          <i class="fas fa-circle nav-icon mr-2 text-success"></i>
            Selesai
          </div>
          </div>

          <script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js"></script>
          <script>
            var map = L.map('map').setView([-6.244528, 106.832361], 16);

            var osm = L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
              attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
            });
            osm.addTo(map);

            var GreenHomeIcon = L.icon({
              iconUrl: 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAEAAAABACAYAAACqaXHeAAAACXBIWXMAAAsTAAALEwEAmpwYAAAHtUlEQVR4nN2bbXBU1RnHf+fsJvtyd7MJyWYTAiEvBGagkVoRnQJatR1lRqEfLENpBluhjNYP5aWijK0tM1rpdFqlo1gCaH3JUNsOOoTWCpba6kC0E6uIdjpQ+4HOFDt1Eti8YWiezjmEDGTvJlmyZu/mP/NMdjZ7nnv+/3Puuc95znMhNygGrgCuBhYDc4EiJjGKgTt0jN+rIJ2qkLMFVZwubKAzMJsOfyWdqoCzOsxHvgh7gGVAAZMANcrhKRWgJ7yQZOUjSN1BZPb7LvYeUrsfSTzAQGAOp1WQDu3n2/kqRIEK8LAO0T1lLZ/MfD0N6RGs5iUkfA1J7fAvYCl5hBrt8IGzkO76Q5kTH27TdyP+CrpUmO2AD49jng7xcfw+zo2X+MXW0GZnQ5d2eAMowaOYo0N0Tn2UgWySH7KjSPFK+nSEd4EgHkOpDvKfyq0jk294C5n6UySxzJHyK4slWulYS3yuRBJfduz/zG/S+jiGRJfQox1aAYVXoCMcKlnF2bTE25GKdX5xpoTkulsWSXNzsxw5ckROnjxp7fDhw7Jjxw77P6c0JBXr/TKr3d3XrHeQYCNdKsRDeATLC6aTnHXUvcO1v0VidY4sW75UTpw4IaPh+PHjsvT2WyVW70jt79x91r+GqCC9Zs3JNfkCHeKj6mfdOzrjl0gkHpZdT+2STLFz906JlIdlxgvuvuMbOafDHMm1AE3BeZxxHaVDSLQyLK2trXK52LdvnxRVOtZXyq3wLuJPkASuzxl7HeXtqp+lGaGFEfnh1odlvNjy0BaJL4q4XiPxPQZ0jJdzxb9CB+k1i9Lwjk3bgVQ3TJP+/v5xC2B8zJg9XabtdI8PVKFdC5xcCLAi/HlOu47M4iLZs2ePZAstLS2SuK7IdRaEPksncNuEs1cBHouvT33um1EJFQWlq6srawIkk0nrs+HNVAFK7+J/FPDIhAugi/lj1TaX6f9z5NqbFki2cc2NV9tba/j1TPCki3llwgXwxThW/Xxqhyq2IE2rv5Z1AVZ+Y4X1Pfx6pg+mLxMugI7xj5rfpHaobB1y3+ZNWRdg0+ZN1ndKrPEComP8PRcCfFDd4rIAPoh8fe0dWRdg1ZomSfzAZQa0WAHen3gBSni96onUDlU9jly/ZFHWBVh880Kp2u6yBmyza8AfJlwAFeSJ8k2pHTLZH7Ni9/X1ZY288RUuDsnMN1wCru8woII8PuECAKucG9zD4PL5Mdm/f3/WBDAhcfmCmGsc4CzmDLAyFwJUa4cek6gY3qnKHyONC+bKwMDAuMkbH3OvmiNVP1Gp+4GjiA7TA1Tlai/wN7cQ1SQupjRG5OlfPD1uAXbt3iWl8yLWZ0rM8SSii3gvJ+QtNHc7i0m6Tc3aViQad6Stre2yybe3t1sfJkOcZvon0dxFDhFWQc7UvuzewWnblcTKi+TgwYMZkz9w4IAUxaN2lN18172CqIDdDudkIzQEFeBHsdvpdeukfU4/i0QSYdmwab10dHSMStz8Zv2962yb6ufcfRqLfYVeFcjBHsAF5SpIj9sj6uIUVmJ5SGLxqHzzW6vtjDh16tQQafPZjPiau1dLUVlUEitCUv+n9P5mHrYpMbP4VeAFqDAtZffQn67DF0/b8g1a4vNjNlXmL/RZM5/Nd4mN2v5mND/mWr4ILXgIs3WEnllvj975Sx5j75y3jNr8FdFRus05BF6CjvJaxZZP6VDkIjPXMNfCg7jRnOGZU95PTYBjSMFUu/LfgBehTWDksmHJlhnfOpKDrW8GWBlsdM8TZsOCjTbu/yoehl+H+K85EMk2+Zq9iA7ysecLJrSfeyNfpCvbAkS+RLfxTR4gqoJ01b2aPfLmZEgF6AJi5ANUkG0lTfRlS4CSJs6qMNvII1TpED3mjGC85M1ZgPFl8g/kE5TD3viG8ZfKGB86yl7yEFf4YnRnGuoOPwH2Fdt7/0ryETpC22hlMyNZ5Vab8Wkjj7HEVI+4pbPGYoUzbOBzC3kMpSN8aGr9MiVv2miHf3qqGOoycWdovnv6fCQzbdDcySRAwBRI17w4dvImCWraeLEe8LKgC/l+9Da6xypA9FZ6dJAHmUQoMRXjJjc4Gvn6P9uw1wQ+pUwmqBDNU9akL6a8YFNW84lyaGYSotYcYzX8ZYSwt33oqKueSYIi4CbgfuBFHeJM+eb0ApTfbwXoAJ4Be+Iz3+QYyDOEgbXAm0CvUqpDaX1W+3xizFd6vvI7RYCjiL8M+xtjSutulDJPAhMK7x0MiDwdEyhgI9CplEpqv198BQUpph0lUx9LFWDqo4gvotzb+HyCUqeBD3NaGToCzDR91RD3pSF+MZnCulQBAjPPj/6Ibf1+AZsVNkJ7Cg8opbpH6vwlRMJccu5X/Yy998fU1tigCJ7aIb6Vbsq7j6RP/HHE1BgZ8xVjvxtre7OmgLfyg9tNp8ZK4IIIvqiylgl5OwOUMrvEm/EQSoCTmYqQsfn9opQyT4Vf49G3Q18y96f2+c5lnbjWvYP3/mZbm+JhfAbs669JzscA/XZ1z2iN8F+IBUxUaKb7v8G+I1RGHsEPfAH4LthCRkOiH+zR9hkb5CjVMfT3/Oiaxc2MtEmE/Aq4Z/DF6kmFClNPAFw1+Ob4tYOf6yb7G+R4Ef8HKqADSZcXnYgAAAAASUVORK5CYII=',
              iconSize: [40, 40],
              iconAnchor: [12, 41],
              popupAnchor: [1, -34],
              shadowSize: [41, 41]
            });

            var YellowHomeIcon = L.icon({
              iconUrl: 'data:image/png;base64,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',
              iconSize: [40, 40],
              iconAnchor: [12, 41],
              popupAnchor: [1, -34],
              shadowSize: [41, 41]
            });

            var RedHomeIcon = L.icon({
              iconUrl: 'data:image/png;base64,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',
              iconSize: [40, 40],
              iconAnchor: [12, 41],
              popupAnchor: [1, -34],
              shadowSize: [41, 41]
            });

            var coordinates = [
              [-6.244528, 106.832361],
              [-6.245111, 106.832306],
              [-6.245233, 106.831592],
              [-6.245192, 106.831250],
              [-6.245311, 106.830833],
              [-6.245233, 106.830694],
              [-6.244889, 106.830750],
              [-6.244500, 106.830917],
              [-6.244417, 106.830917],
              [-6.244306, 106.830944],
              [-6.244306, 106.830833],
              [-6.243806, 106.830750],
              [-6.243750, 106.830806],
              [-6.243667, 106.830750],
              [-6.243389, 106.830694],
              [-6.243333, 106.830750],
              [-6.243194, 106.830694],
              [-6.242972, 106.830583],
              [-6.242972, 106.830750],
              [-6.242972, 106.830917],
              [-6.242972, 106.831639],
              [-6.242972, 106.831694],
              [-6.242972, 106.831889],
              [-6.242972, 106.832194],
              [-6.242972, 106.832528],
              [-6.242972, 106.882333],
              [-6.242972, 106.882778],
              [-6.242972, 106.882639],
              [-6.242972, 106.882917],
              [-6.242972, 106.882222],
              [-6.242972, 106.882667],
              [-6.242972, 106.882250],
              [-6.242972, 106.882222],
              [-6.242972, 106.882361],
              [-6.242972, 106.881917]
            ];

            var markers = [];
            for (var i = 0; i < coordinates.length; i++) {
              var icon = i % 3 === 0 ? RedHomeIcon : i % 3 === 1 ? YellowHomeIcon : GreenHomeIcon;
              var marker = L.marker(coordinates[i], {
                icon: icon,
                draggable: true
              }).bindPopup('mark ' + (i + 1));
              marker.addTo(map);
            }

            var OpenStreetMap_BZH = L.tileLayer('https://tile.openstreetmap.bzh/br/{z}/{x}/{y}.png', {
              maxZoom: 19,
              attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, Tiles courtesy of <a href="http://www.openstreetmap.bzh/" target="_blank">Breton OpenStreetMap Team</a>',
              bounds: [
                [46.2, -5.5],
                [50, 0.7]
              ]
            });
            OpenStreetMap_BZH.addTo(map);

            var googleStreets = L.tileLayer('http://{s}.google.com/vt?lyrs=m&x={x}&y={y}&z={z}', {
              maxZoom: 20,
              subdomains: ['mt0', 'mt1', 'mt2', 'mt3']
            });
            googleStreets.addTo(map);

            var googleSat = L.tileLayer('http://{s}.google.com/vt?lyrs=s&x={x}&y={y}&z={z}', {
              maxZoom: 20,
              subdomains: ['mt0', 'mt1', 'mt2', 'mt3']
            });
            googleSat.addTo(map);

            var baseLayers = {
              "OpenStreetMap": osm,
              "Satelite": googleSat,
              "Google Map": googleStreets,
            };

            var overlays = {};
            for (var i = 0; i < markers.length; i++) {
              overlays['Titik ' + (i + 1)] = markers[i];
            };

            L.control.layers(baseLayers, overlays).addTo(map);
          </script>
        </div>
      </section>

      <!-- Control Sidebar -->
      <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
      </aside>
      <!-- /.control-sidebar -->

      <!-- ./wrapper -->
    </div>
  </div>
  <!-- jQuery -->
  <script src="plugins/jquery/jquery.min.js"></script>
  <!-- jQuery UI 1.11.4 -->
  <script src="plugins/jquery-ui/jquery-ui.min.js"></script>
  <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
  <script>
    $.widget.bridge('uibutton', $.ui.button)
  </script>
  <!-- Bootstrap 4 -->
  <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- ChartJS -->
  <script src="plugins/chart.js/Chart.min.js"></script>
  <!-- Sparkline -->
  <script src="plugins/sparklines/sparkline.js"></script>
  <!-- JQVMap -->
  <script src="plugins/jqvmap/jquery.vmap.min.js"></script>
  <script src="plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
  <!-- jQuery Knob Chart -->
  <script src="plugins/jquery-knob/jquery.knob.min.js"></script>
  <!-- daterangepicker -->
  <script src="plugins/moment/moment.min.js"></script>
  <script src="plugins/daterangepicker/daterangepicker.js"></script>
  <!-- Tempusdominus Bootstrap 4 -->
  <script src="plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
  <!-- Summernote -->
  <script src="plugins/summernote/summernote-bs4.min.js"></script>
  <!-- overlayScrollbars -->
  <script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
  <!-- AdminLTE App -->
  <script src="dist/js/adminlte.js"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="dist/js/demo.js"></script>
  <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
  <script src="dist/js/pages/dashboard.js"></script>
</body>

</html>
@endsection