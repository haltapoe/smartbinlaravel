@extends('layouts.app')
@section('content')
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>SmartBin | Rute</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- map leaflet -->
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css" />
  <link rel="stylesheet" href="https://unpkg.com/leaflet-routing-machine/dist/leaflet-routing-machine.css" />
</head>

<body class="hold-transition dark-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
  <div class="wrapper">

    <!-- Preloader -->
    <div class="preloader flex-column justify-content-center align-items-center">
      <img class="animation__wobble" src="icon-smartbin.png" alt="SmartBin Logo" height="60" width="60">
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
                  <a href="{{ route('get-lokasi') }}" class="nav-link">
                    <img width="25" height="25" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADAAAAAwCAYAAABXAvmHAAAACXBIWXMAAAsTAAALEwEAmpwYAAABz0lEQVR4nO3YzYtOURzA8RPFJAtJIVlIXqJsLFBjYScWpCwslJ2XjZ2dUhaslJUUq1nZWGnKRpGysFHKRpmiyZS8phhm5qNbtzw9YZ7nnnvuPY/u9y/4fm/3nN85J4SOjo6OVGAzxsMogQ24hfd+8xHrQ65gBS7jtb/zMOQEluA0nmPB4kyFHMBBPMIPw3G37cU4gc+qs6tp6dW4hhnxvGtKehnO4cWA//Wg3EgtfgRPMC8Na1NI78UkZqVlqk7pTbjZN2RSczFWelU5ZN5onnmMxchfrXkxDsuzGPmT2udUVfndFSZl3czGfP1iobbNg5iA223b40BMwD78bFH+S2X5noj9xS7QUsCd6ICeM/txvGo4YEctAX2HtPPl1S41M7XK/+GIXAy3bwkDricL6AnZWG61czXLL2BN8oCekJ24V2PAy8bk+0IOYbqGgAutBJQR2/A1Qn6u2CxaCygjLkUEPG1VvgxYibcVA06EHMDZCvLfQy5gafkqMQz3Q07g2JAB4yE38HhA+U8hR7BnwPv0RMiV4kF2gIAtIVewdZG79XTIneJd8x8BZ0LuYF1xRewTL9bGlTAq4HDxRF7Kf8DRMGpgDNuxvG2Xjo7/iV8o958YCuMy6QAAAABJRU5ErkJggg==" />
                    <p>Lokasi</p>
                  </a>
                </li>
                <li class="nav-item menu-open">
                  <a href="#" class="nav-link active">
                    <img width="25" height="25" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADIAAAAyCAYAAAAeP4ixAAAACXBIWXMAAAsTAAALEwEAmpwYAAACxUlEQVR4nO2Yu49NQRzHZ7FIECFeHSJLIYhC9rrWo1LQildCFB6F6GhWxKNQYCMi/gBEsSHRUCGLpZFNUCg8glVZiY2VEGL5yMjv2FnnfWfOnXvjfLsz8zu/7/nM+c3jHKVKlSpVqtT/JKAF6CG7elUjClhJPt1XjSjgrDzgGdXkZdUvIO2qWQVUBeKdhlLNKoooK+Ah/lRxCeJL/UFZpQxmT6byw5/+lpWTN0dYVevXPDr/qrSHCxpU+N4u6eqqBaTDMcjqpLJKAalExWcFqYdGrVYJIC3A20zl5QmkPQtIrvLyABEqEwc5H+RJUnU00UMj6wCEPEk6HE30im8QF4o8W7lIrIBb1E+RE9ZFYiWJ5gGbgdPAXeAzDXi2In5zJe6GscBiYBdwAXgEfLeESN/UUqTnaS6QmCTjBG4ncA7oA37m3QSBLZYDYg0yJqJtCrAOOARcNXbh2LKSOK8gQ3KkPgVsAubGxM0CNgLHgJvAB+COHDcmA198g0RpALgBHAU2ADNTcug3V4hUBoBW4ESOnG+AbuAgsBaYqgHl+ocXEGCi/p8kscPANWA/sB04DDx2/DzDtXqkgVyWuFfAkoh+Xff7HCzN1h4qAWKFxAwC81OAtZGNrD1Uwo2XJKbTaFsjr3pIltEZxqg9sQCx9lAJIM8kZqFcT5eRM9VtxB+xALH2UAkgXyVmglyvj7h/0IjfYQFi69GbBKI3Mq3Zct0G/PonQZ8Rf0DazscmDXsMFO2hZDfW2ma0HTeMPurTqNF3Xdp3N5KHMlaJp8B4o71NSmCa0bZc9oBvweTM6LGnaA+lEwMvxUjvJ60xcQuA1xJ3MrPBiMfzIj3+CFhmfGTppW8rMEceYJGsIp+k/14wafMIWCpLbWEeJswLknUFmFSTwQhMoR6BkR6dvcBt4L0cF/S3x0X9p8QqeR09SpUqpZpfvwEgyUkisbZ/cwAAAABJRU5ErkJggg=="></i>
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
                      <a href="{{ route('smartbin-visit-rute') }}" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Smartbin Visit</p>
                      </a>
                    </li>
                    <li class="nav-item ml-4">
                      <a href="#Jadwal" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Jadwal </p>
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

    <div class="content-wrapper" style="min-height: 638.2px;">
      <!-- main content -->
      <section class="content">
        <!-- CSS map peta -->
        <style>
          #map {
            height: 100vh;
            width: 100%;

          }

          #map-input {
            padding: 10px;
            /* Tambahkan padding sesuai kebutuhan Anda */
          }

          .form-control-sidebar {
            max-width: 200px;
          }

          .highlighted {
            background-color: rgba(255, 255, 255, 0.725);
            /* Nilai alpha antara 0 (transparan) hingga 1 (tidak transparan) */
            padding: 1px;
            /* Tambahkan padding sesuai kebutuhan Anda */
            margin: 1px 0;
            /* Tambahkan margin sesuai kebutuhan Anda */
            display: block;
            /* Agar elemen menempati satu baris penuh */
          }

          .leaflet-routing-container {
            color: black !important;
            background-color: white !important;
          }

          .legend {
            background-color: #343a40;
            padding: 10px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            position: absolute;
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

          .legend-item-kanan{
            right: 20px;
            left: auto;
            bottom: 20px;
          }

          .legend-item-kiri{
            right: auto;
            left: 20px;
            bottom: 20px;
          }
        </style>

        <div id="map-input">
          <form id="route-form">
            <div class="input-group">
              <span class="input-group-text">Titik Awal</span>
              <input type="text" class="form-control form-control-sidebar" id="startCoord" name="startCoord" placeholder="Lat, Long">
              <span class="input-group-text">Titik Tujuan</span>
              <input type="text" class="form-control form-control-sidebar" id="endCoord" name="endCoord" placeholder="Lat, Long">
              <button type="button" class="btn btn-outline-secondary" onclick="calculateRoute()"><i class="fas fa-fw fa-search"></i></button>
          </form>
        </div>
    </div>
    <!-- Map Peta -->
    <div id="map">

      <!-- Legenda -->
      <div class="legend legend-item-kiri">
        <div class="legend-item">
          <img src="https://img.icons8.com/plasticine/100/filled-trash.png" height="20" width="20"></img>
          Kapasitas 100 L
        </div>
      </div>
      <div class="legend legend-item-kanan">
        <div class="legend-item">
          <i class="fas fa-circle nav-icon mr-2 text-danger"></i>
          Penuh
        </div>
        <div class="legend-item">
          <i class="fas fa-circle nav-icon mr-2 text-warning"></i>
          Setengah
        </div>
        <div class="legend-item">
          <i class="fas fa-circle nav-icon mr-2 text-success"></i>
          Kosong
        </div>
      </div>

      <script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js"></script>
      <script src="https://unpkg.com/leaflet-routing-machine/dist/leaflet-routing-machine.js"></script>
      <script>
        var map = L.map('map').setView([-6.244528, 106.832361], 16);
        var osm = L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
          attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        });
        osm.addTo(map);

        var redMarkerIcon = L.icon({
          iconUrl: 'https://img.icons8.com/plasticine/100/filled-trash.png',
          shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.7.1/images/marker-shadow.png',
          iconSize: [25, 41],
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
          var marker = L.marker(coordinates[i], {
            icon: redMarkerIcon
          }).bindPopup('Titik ' + (i + 1));
          marker.addTo(map);
        }

        var routingControl = L.Routing.control({
          waypoints: [
            L.latLng(-6.244528, 106.832361),
            L.latLng(-6.245111, 106.832306),
            L.latLng(-6.245233, 106.831592),
            L.latLng(-6.245192, 106.831250),
            L.latLng(-6.245311, 106.830833),
            L.latLng(-6.245233, 106.830694),
            L.latLng(-6.244889, 106.830750),
            L.latLng(-6.244500, 106.830917),
            L.latLng(-6.244417, 106.830917),
            L.latLng(-6.244306, 106.830944),
            L.latLng(-6.244306, 106.830833),
            L.latLng(-6.243806, 106.830750),
            L.latLng(-6.243750, 106.830806),
            L.latLng(-6.243667, 106.830750),
            L.latLng(-6.243389, 106.830694),
            L.latLng(-6.243333, 106.830750),
            L.latLng(-6.243194, 106.830694),
            L.latLng(-6.242972, 106.830583),
            L.latLng(-6.242972, 106.830750),
            L.latLng(-6.242972, 106.830917),
            L.latLng(-6.242972, 106.831639),
            L.latLng(-6.242972, 106.831694),
            L.latLng(-6.242972, 106.831889),
            L.latLng(-6.242972, 106.832194),
            L.latLng(-6.242972, 106.832528),
            L.latLng(-6.242972, 106.882333),
            L.latLng(-6.242972, 106.882778),
            L.latLng(-6.242972, 106.882639),
            L.latLng(-6.242972, 106.882917),
            L.latLng(-6.242972, 106.882222),
            L.latLng(-6.242972, 106.882667),
            L.latLng(-6.242972, 106.882250),
            L.latLng(-6.242972, 106.882222),
            L.latLng(-6.242972, 106.882361),
            L.latLng(-6.242972, 106.881917)
          ],
          routeWhileDragging: true
        }).addTo(map);

        function calculateRoute() {
          var startCoord = document.getElementById('startCoord').value.split(',').map(parseFloat);
          var endCoord = document.getElementById('endCoord').value.split(',').map(parseFloat);
          routingControl.setWaypoints([L.latLng(startCoord), L.latLng(endCoord)]);
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

    <!-- Menu Jadwal -->
    <div id="Jadwal">
      <div class="col-md-20 mt-3">
        <div class="card">
          <div class="card-header border-transparent">
            <h3 class="card-title">Jadwal SmartBin</h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body p-0">
            <div class="table-responsive">
              <table class="table m-0">
                <thead>
                  <tr>
                    <th>Alamat</th>
                    <th>Tanggal</th>
                    <th>Indikator Sampah</th>
                    <th>Kapasitas</th>
                    <th>Titik Kordinat</th>
                  </tr>
                </thead>
              </table>
            </div>
            <!-- /.table-responsive -->
          </div>
          <!-- /.card-body -->
          <div class="card-footer clearfix">
            <a href="javascript:void(0)" class="btn btn-sm btn-info float-left" id="inputDataBtn">Input Data</a>
            <a href="javascript:void(0)" class="btn btn-sm btn-secondary float-right">Jadwal kendaraan</a>
            <button type="button" class="btn btn-sm btn-danger float-right mr-2" onclick="deleteSelected()">Hapus</button>
          </div>
          <!-- /.card-footer -->
        </div>
      </div>
    </div>
    </section>

    <!-- Tambahkan script Bootstrap dan jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <!-- Tambahkan script Bootstrap (pastikan untuk menyertakan file Bootstrap sebelumnya) -->
    <script src="path/to/bootstrap.min.js"></script>

    <!-- Tambahkan script JavaScript -->
    <script>
      document.getElementById('inputDataBtn').addEventListener('click', function() {
        // Tampilkan popup untuk mengisi data
        $('#inputDataModal').modal('show');
      });

      function addData() {
        // Logika untuk mengambil data dari inputan popup dan menambahkannya ke dalam tabel
        var jadwalTable = document.getElementById('Jadwal').querySelector('table tbody');

        // Ambil data dari inputan popup
        var newData = [
          document.getElementById('inputAlamat').value,
          document.getElementById('inputTanggal').value,
          document.getElementById('inputIndikator').value,
          document.getElementById('inputKapasitas').value,
          document.getElementById('inputKoordinat').value
        ];

        // Buat elemen baris baru
        var newRow = jadwalTable.insertRow();

        // Isi data ke dalam baris
        for (var i = 0; i < newData.length; i++) {
          var cell = newRow.insertCell(i);
          cell.innerHTML = newData[i];
        }

        // Sembunyikan popup setelah menambahkan data
        $('#inputDataModal').modal('hide');
      }
    </script>

    <!-- Popup Modal -->
    <div class="modal fade" id="inputDataModal" tabindex="-1" role="dialog" aria-labelledby="inputDataModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="inputDataModalLabel">Input Data</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <!-- Form untuk mengisi data -->
            <form action="{{ url('/simpan-jadwal') }}" method="post">
              @csrf
              <div class="form-group">
                <label for="inputAlamat">Alamat</label>
                <input type="text" class="form-control" id="inputAlamat" placeholder="Masukkan alamat" name="alamat" required>
              </div>
              <div class="form-group">
                <label for="inputTanggal">Tanggal</label>
                <input type="text" class="form-control" id="inputTanggal" placeholder="Masukkan tanggal" name="tanggal" required>
              </div>
              <div class="form-group">
                <label for="inputIndikator">Indikator Sampah</label>
                <input type="text" class="form-control" id="inputIndikator" placeholder="Masukkan indikator sampah" name="indikator" required>
              </div>
              <div class="form-group">
                <label for="inputKapasitas">Kapasitas</label>
                <input type="text" class="form-control" id="inputKapasitas" placeholder="Masukkan kapasitas" name="kapasitas" required>
              </div>
              <div class="form-group">
                <label for="inputKoordinat">Titik Koordinat</label>
                <input type="text" class="form-control" id="inputKoordinat" placeholder="Masukkan titik koordinat" name="koordinat" required>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" onclick="closeModal()">Tutup</button>
                <button type="button" class="btn btn-primary">Simpan</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>

    <!-- Skrip JavaScript untuk menangani aksi penutup modal -->
    <script>
      function closeModal() {
        // Sembunyikan modal
        $('#inputDataModal').modal('hide');

        // Reset nilai formulir jika diperlukan
        document.getElementById('inputAlamat').value = '';
        document.getElementById('inputTanggal').value = '';
        document.getElementById('inputIndikator').value = '';
        document.getElementById('inputKapasitas').value = '';
        document.getElementById('inputKoordinat').value = '';
      }
    </script>

    <!-- Tambahkan script Bootstrap (pastikan untuk menyertakan file Bootstrap sebelumnya) -->
    <script src="path/to/bootstrap.min.js"></script>

    <!-- Tambahkan script JavaScript -->
    <script>
      // Memeriksa apakah ada data yang sudah disimpan di lokal penyimpanan
      var savedData = JSON.parse(localStorage.getItem('savedData')) || [];

      // Memulai dengan memuat data yang sudah ada
      loadSavedData();

      document.getElementById('inputDataBtn').addEventListener('click', function() {
        // Tampilkan popup untuk mengisi data
        $('#inputDataModal').modal('show');
      });

      function addData() {
        // Logika untuk mengambil data dari inputan popup dan menambahkannya ke dalam tabel
        var jadwalTable = document.getElementById('Jadwal').querySelector('table tbody');

        // Ambil data dari inputan popup
        var newData = [
          document.getElementById('inputAlamat').value,
          document.getElementById('inputTanggal').value,
          document.getElementById('inputIndikator').value,
          document.getElementById('inputKapasitas').value,
          document.getElementById('inputKoordinat').value
        ];

        // Tambahkan data baru ke dalam array
        savedData.push(newData);

        // Simpan data ke lokal penyimpanan
        localStorage.setItem('savedData', JSON.stringify(savedData));

        // Tambahkan data ke dalam tabel
        addDataToTable(newData);

        // Sembunyikan popup setelah menambahkan data
        $('#inputDataModal').modal('hide');

        // Reset nilai formulir jika diperlukan
        resetForm();
      }

      function loadSavedData() {
        // Hapus semua baris yang ada di tabel sebelum memuat data
        var jadwalTable = document.getElementById('Jadwal').querySelector('table tbody');
        jadwalTable.innerHTML = '';

        // Tampilkan data yang masih ada di lokal penyimpanan
        for (var i = 0; i < savedData.length; i++) {
          if (!isRowDeleted(savedData[i])) {
            addDataToTable(savedData[i]);
          }
        }
      }

      function isRowDeleted(data) {
        // Periksa apakah data dengan ID yang sama sudah dihapus
        var jadwalTable = document.getElementById('Jadwal').querySelector('table tbody');
        for (var i = 0; i < jadwalTable.rows.length; i++) {
          var row = jadwalTable.rows[i];
          if (row.dataset.id === generateIdFromData(data)) {
            return false; // Baris masih ada di tabel, belum dihapus
          }
        }
        return true; // Baris sudah dihapus
      }

      function generateIdFromData(data) {
        // Buat ID dari data (sesuaikan dengan cara Anda menyimpan ID)
        return data.join('_'); // Contoh, menggabungkan semua nilai sebagai ID
      }

      function addDataToTable(data) {
        // Tambahkan data ke dalam tabel
        var jadwalTable = document.getElementById('Jadwal').querySelector('table tbody');
        var newRow = jadwalTable.insertRow();

        for (var i = 0; i < data.length; i++) {
          var cell = newRow.insertCell(i);
          cell.innerHTML = data[i];
        }

        // Tambahkan checkbox pada setiap baris
        var checkboxCell = newRow.insertCell(data.length);
        var checkbox = document.createElement('input');
        checkbox.type = 'checkbox';
        checkboxCell.appendChild(checkbox);
        // Tambahkan data-id attribute ke setiap baris
        newRow.dataset.id = generateUniqueId();
      }

      function resetForm() {
        // Reset nilai formulir
        document.getElementById('inputAlamat').value = '';
        document.getElementById('inputTanggal').value = '';
        document.getElementById('inputIndikator').value = '';
        document.getElementById('inputKapasitas').value = '';
        document.getElementById('inputKoordinat').value = '';
      }

      function deleteSelected() {
        var jadwalTable = document.getElementById('Jadwal').querySelector('table tbody');
        var selectedRows = [];

        // Cari baris yang dipilih
        for (var i = 0; i < jadwalTable.rows.length; i++) {
          var row = jadwalTable.rows[i];

          // Periksa apakah ada elemen checkbox pada baris
          var checkbox = row.cells[row.cells.length - 1].querySelector('input[type="checkbox"]');
          if (checkbox && checkbox.checked) {
            selectedRows.push(row);
          }
        }

        // Hapus baris yang dipilih dari penyimpanan lokal dan tabel
        for (var i = selectedRows.length - 1; i >= 0; i--) {
          var row = selectedRows[i];
          var index = row.rowIndex - 1; // Mengurangkan satu karena baris header tidak dihitung

          // Kirim permintaan Ajax ke server untuk menghapus data
          var id = row.dataset.id; // Sesuaikan dengan cara Anda menyimpan ID
          deleteDataOnServer(id); // Panggil fungsi untuk menghapus data di server

          savedData.splice(index, 1);
          localStorage.setItem('savedData', JSON.stringify(savedData));
          jadwalTable.deleteRow(index);
        }
      }
      // Fungsi untuk menghapus data pada server
      function deleteDataOnServer(id) {
        $.ajax({
          type: 'POST',
          url: '/delete-endpoint',
          data: {
            id: id
          },
          success: function(response) {
            // Handle respons dari server
            console.log(response);
          },
          error: function(error) {
            console.error('Error:', error);
          }
        });
        // Tambahkan CSRF token ke setiap permintaan Ajax
        $.ajaxSetup({
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
        });
      }
    </script>

    <!-- Popup Modal -->
    <div class="modal fade" id="inputDataModal" tabindex="-1" role="dialog" aria-labelledby="inputDataModalLabel" aria-hidden="true">
      <!-- ... (sesuaikan dengan bagian sebelumnya) ... -->
    </div>

    <!-- Skrip JavaScript untuk menangani aksi penutup modal -->
    <script>
      function closeModal() {
        // Sembunyikan modal
        $('#inputDataModal').modal('hide');

        // Reset nilai formulir jika diperlukan
        resetForm();
      }
    </script>

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
      <!-- Control sidebar content goes here -->
    </aside>
    <!-- ./wrapper -->
  </div>
  </div>
  <!-- REQUIRED SCRIPTS -->
  <!-- jQuery -->
  <script src="plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap -->
  <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- overlayScrollbars -->
  <script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
  <!-- AdminLTE App -->
  <script src="dist/js/adminlte.js"></script>

  <!-- PAGE PLUGINS -->
  <!-- jQuery Mapael -->
  <script src="plugins/jquery-mousewheel/jquery.mousewheel.js"></script>
  <script src="plugins/raphael/raphael.min.js"></script>
  <script src="plugins/jquery-mapael/jquery.mapael.min.js"></script>
  <script src="plugins/jquery-mapael/maps/usa_states.min.js"></script>
  <!-- ChartJS -->
  <script src="plugins/chart.js/Chart.min.js"></script>

</body>

</html>
@endsection