<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Pendaftaran SIGAP</title>
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    
    <style>
        :root {
            --primary: #005B8F;
            --secondary: #00C4CC;
            --dark: #003366;
            --soft: #F8F9FA;
            --border-radius: 1.5rem;
            --sidebar-width: 80px;
            --sidebar-expanded-width: 250px;
            --transition-speed: 0.3s;
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f5f7fb;
            overflow-x: hidden;
        }
        
        /* Sidebar Styles */
        #sidebar {
            position: fixed;
            top: 0;
            left: 0;
            height: 100vh;
            width: var(--sidebar-width);
            background-color: var(--dark);
            color: white;
            transition: all var(--transition-speed) ease;
            z-index: 1000;
            overflow: hidden;
            box-shadow: 3px 0 15px rgba(0, 0, 0, 0.1);
        }
        
        #sidebar:hover {
            width: var(--sidebar-expanded-width);
        }
        
        #sidebar .sidebar-header {
            padding: 1.5rem 1rem;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            display: flex;
            align-items: center;
            justify-content: flex-start;
            white-space: nowrap;
        }
        
        #sidebar .sidebar-header .logo-icon {
            font-size: 2rem;
            margin-right: 15px;
            color: var(--secondary);
            min-width: 50px;
        }
        
        #sidebar .sidebar-header h3 {
            font-size: 1.2rem;
            margin: 0;
            opacity: 0;
            transition: opacity var(--transition-speed) ease;
            white-space: nowrap;
        }
        
        #sidebar:hover .sidebar-header h3 {
            opacity: 1;
        }
        
        #sidebar .sidebar-menu {
            padding: 1rem 0;
        }
        
        #sidebar .sidebar-menu .nav-item {
            position: relative;
            margin-bottom: 5px;
        }
        
        #sidebar .sidebar-menu .nav-link {
            color: rgba(255, 255, 255, 0.8);
            padding: 0.8rem 1rem;
            display: flex;
            align-items: center;
            text-decoration: none;
            transition: all 0.2s ease;
            white-space: nowrap;
            border-left: 4px solid transparent;
        }
        
        #sidebar .sidebar-menu .nav-link:hover,
        #sidebar .sidebar-menu .nav-link.active {
            background-color: rgba(255, 255, 255, 0.1);
            color: white;
            border-left-color: var(--secondary);
        }
        
        #sidebar .sidebar-menu .nav-link i {
            font-size: 1.5rem;
            margin-right: 15px;
            min-width: 30px;
            text-align: center;
        }
        
        #sidebar .sidebar-menu .nav-link span {
            opacity: 0;
            transition: opacity var(--transition-speed) ease;
        }
        
        #sidebar:hover .sidebar-menu .nav-link span {
            opacity: 1;
        }
        
        /* Navbar Styles */
        #navbar {
            background-color: white;
            padding: 1rem 1.5rem;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.05);
            position: fixed;
            top: 0;
            right: 0;
            left: var(--sidebar-width);
            z-index: 999;
            transition: left var(--transition-speed) ease;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        #sidebar:hover + #main-content #navbar {
            left: var(--sidebar-expanded-width);
        }
        
        #navbar .navbar-title h1 {
            font-size: 1.5rem;
            color: var(--dark);
            margin: 0;
            font-weight: 600;
        }
        
        #navbar .profile-menu {
            display: flex;
            align-items: center;
        }
        
        #navbar .profile-menu .user-info {
            margin-right: 15px;
            text-align: right;
        }
        
        #navbar .profile-menu .user-name {
            font-weight: 600;
            color: var(--dark);
            font-size: 0.95rem;
        }
        
        #navbar .profile-menu .user-role {
            font-size: 0.8rem;
            color: #6c757d;
        }
        
        #navbar .profile-menu .avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background-color: var(--secondary);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: bold;
            cursor: pointer;
        }
        
        /* Main Content */
        #main-content {
            margin-left: var(--sidebar-width);
            margin-top: 80px;
            padding: 1.5rem;
            transition: margin-left var(--transition-speed) ease;
        }
        
        #sidebar:hover + #main-content {
            margin-left: var(--sidebar-expanded-width);
        }
        
        /* Breadcrumb */
        .breadcrumb {
            background-color: transparent;
            padding: 0;
            margin-bottom: 1.5rem;
        }
        
        .breadcrumb-item a {
            color: var(--primary);
            text-decoration: none;
        }
        
        /* Card Styles */
        .card {
            border: none;
            border-radius: var(--border-radius);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            margin-bottom: 1.5rem;
            transition: transform 0.3s ease;
        }
        
        .card:hover {
            transform: translateY(-5px);
        }
        
        .card-header {
            background-color: white;
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
            padding: 1.2rem 1.5rem;
            border-radius: var(--border-radius) var(--border-radius) 0 0 !important;
            font-weight: 600;
            color: var(--dark);
        }
        
        .card-body {
            padding: 1.5rem;
        }
        
        /* Statistic Cards */
        .stat-card {
            border-radius: var(--border-radius);
            padding: 1.5rem;
            color: white;
            margin-bottom: 1.5rem;
            height: 100%;
        }
        
        .stat-card.total {
            background: linear-gradient(135deg, var(--primary), #0077b6);
        }
        
        .stat-card.lulus {
            background: linear-gradient(135deg, #28a745, #20c997);
        }
        
        .stat-card.belum {
            background: linear-gradient(135deg, #ffc107, #fd7e14);
        }
        
        .stat-card.tidak {
            background: linear-gradient(135deg, #dc3545, #c82333);
        }
        
        .stat-card i {
            font-size: 2.5rem;
            opacity: 0.8;
            margin-bottom: 10px;
        }
        
        .stat-card .number {
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 5px;
        }
        
        .stat-card .label {
            font-size: 0.9rem;
            opacity: 0.9;
        }
        
        /* Badges */
        .badge {
            padding: 0.4rem 0.8rem;
            border-radius: 50px;
            font-weight: 500;
        }
        
        .badge-pending {
            background-color: #fff3cd;
            color: #856404;
        }
        
        .badge-lolos {
            background-color: #d4edda;
            color: #155724;
        }
        
        .badge-tidak {
            background-color: #f8d7da;
            color: #721c24;
        }
        
        /* Table Styles */
        .table-responsive {
            border-radius: var(--border-radius);
            overflow: hidden;
        }
        
        .table {
            margin-bottom: 0;
        }
        
        .table thead th {
            background-color: var(--soft);
            border-bottom: none;
            padding: 1rem;
            font-weight: 600;
            color: var(--dark);
        }
        
        .table tbody td {
            padding: 1rem;
            vertical-align: middle;
            border-top: 1px solid rgba(0, 0, 0, 0.03);
        }
        
        .table tbody tr:hover {
            background-color: rgba(0, 91, 143, 0.03);
        }
        
        /* Buttons */
        .btn {
            border-radius: 50px;
            padding: 0.4rem 1rem;
            font-weight: 500;
            transition: all 0.3s ease;
        }
        
        .btn-primary {
            background-color: var(--primary);
            border-color: var(--primary);
        }
        
        .btn-primary:hover {
            background-color: #004a75;
            border-color: #004a75;
            transform: translateY(-2px);
        }
        
        .btn-outline-primary {
            color: var(--primary);
            border-color: var(--primary);
        }
        
        .btn-outline-primary:hover {
            background-color: var(--primary);
            border-color: var(--primary);
        }
        
        .btn-sm {
            padding: 0.25rem 0.75rem;
            font-size: 0.875rem;
        }
        
        .btn-action {
            width: 36px;
            height: 36px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            margin-right: 5px;
        }
        
        /* Filter Styles */
        .filter-container {
            background-color: white;
            border-radius: var(--border-radius);
            padding: 1.5rem;
            margin-bottom: 1.5rem;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        }
        
        .filter-title {
            font-weight: 600;
            margin-bottom: 1rem;
            color: var(--dark);
            display: flex;
            align-items: center;
        }
        
        .filter-title i {
            margin-right: 10px;
            color: var(--secondary);
        }
        
        /* Chart Container */
        .chart-container {
            position: relative;
            height: 300px;
            width: 100%;
        }
        
        /* Modal Styles */
        .modal-content {
            border-radius: var(--border-radius);
            border: none;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }
        
        .modal-header {
            background-color: var(--primary);
            color: white;
            border-radius: var(--border-radius) var(--border-radius) 0 0;
            padding: 1.5rem;
        }
        
        .modal-header .btn-close {
            filter: invert(1);
        }
        
        .detail-item {
            margin-bottom: 1rem;
            padding-bottom: 1rem;
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
        }
        
        .detail-item:last-child {
            border-bottom: none;
            margin-bottom: 0;
            padding-bottom: 0;
        }
        
        .detail-label {
            font-weight: 600;
            color: var(--dark);
            margin-bottom: 0.25rem;
        }
        
        /* Mobile Responsiveness */
        @media (max-width: 992px) {
            #sidebar {
                left: calc(-1 * var(--sidebar-expanded-width));
                width: var(--sidebar-expanded-width);
            }
            
            #sidebar.mobile-open {
                left: 0;
            }
            
            #navbar {
                left: 0 !important;
            }
            
            #main-content {
                margin-left: 0;
            }
            
            .navbar-toggler {
                display: block;
                margin-right: 15px;
            }
        }
        
        @media (min-width: 993px) {
            .navbar-toggler {
                display: none;
            }
        }
        
        /* Mobile Sidebar Toggler */
        .navbar-toggler {
            border: none;
            background-color: transparent;
            font-size: 1.5rem;
            color: var(--dark);
            padding: 0;
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            transition: all 0.3s ease;
        }
        
        .navbar-toggler:hover {
            background-color: rgba(0, 0, 0, 0.05);
        }
        
        /* Offcanvas Overlay */
        .sidebar-overlay {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 999;
            display: none;
        }
        
        .sidebar-overlay.mobile-open {
            display: block;
        }
        
        /* Footer */
        footer {
            margin-top: 2rem;
            padding: 1.5rem;
            text-align: center;
            color: #6c757d;
            font-size: 0.9rem;
            border-top: 1px solid rgba(0, 0, 0, 0.05);
        }
    </style>
</head>
<body>
    <!-- Sidebar -->
    <nav id="sidebar">
        <div class="sidebar-header">
            <div class="logo-icon">
                <i class="fas fa-graduation-cap"></i>
            </div>
            <h3>SIGAP PPDB</h3>
        </div>
        
        <ul class="sidebar-menu nav flex-column">
            <li class="nav-item">
                <a href="#" class="nav-link active">
                    <i class="fas fa-tachometer-alt"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="fas fa-users"></i>
                    <span>Pendaftar</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="fas fa-chart-bar"></i>
                    <span>Statistik</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="fas fa-cog"></i>
                    <span>Pengaturan</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="fas fa-file-export"></i>
                    <span>Laporan</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="fas fa-question-circle"></i>
                    <span>Bantuan</span>
                </a>
            </li>
        </ul>
    </nav>
    
    <!-- Offcanvas Overlay for Mobile -->
    <div class="sidebar-overlay" id="sidebarOverlay"></div>
    
    <!-- Main Content -->
    <div id="main-content">
        <!-- Navbar -->
        <nav id="navbar">
            <div class="d-flex align-items-center">
                <button class="navbar-toggler" id="sidebarToggle">
                    <i class="fas fa-bars"></i>
                </button>
                <div class="navbar-title">
                    <h1>Dashboard Pendaftaran SIGAP</h1>
                </div>
            </div>
            
            <div class="profile-menu">
                <div class="user-info d-none d-md-block">
                    <div class="user-name">Admin SIGAP</div>
                    <div class="user-role">Super Administrator</div>
                </div>
                <div class="avatar">
                    <span>AS</span>
                </div>
            </div>
        </nav>
        
        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i></a></li>
                <li class="breadcrumb-item active" aria-current="page">Dashboard Pendaftaran</li>
            </ol>
        </nav>
        
        <!-- Statistic Cards -->
        <div class="row">
            <div class="col-xl-3 col-lg-6 col-md-6">
                <div class="stat-card total">
                    <i class="fas fa-user-graduate"></i>
                    <div class="number">1,245</div>
                    <div class="label">Total Pendaftar</div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-6 col-md-6">
                <div class="stat-card lulus">
                    <i class="fas fa-check-circle"></i>
                    <div class="number">892</div>
                    <div class="label">Lulus Seleksi</div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-6 col-md-6">
                <div class="stat-card belum">
                    <i class="fas fa-clock"></i>
                    <div class="number">187</div>
                    <div class="label">Belum Diverifikasi</div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-6 col-md-6">
                <div class="stat-card tidak">
                    <i class="fas fa-times-circle"></i>
                    <div class="number">166</div>
                    <div class="label">Tidak Lulus</div>
                </div>
            </div>
        </div>
        
        <!-- Filter Section -->
        <div class="filter-container">
            <div class="filter-title">
                <i class="fas fa-filter"></i> Filter Data Pendaftar
            </div>
            <div class="row">
                <div class="col-md-3 mb-3">
                    <label class="form-label">Tahun Ajaran</label>
                    <select class="form-select">
                        <option selected>2023/2024</option>
                        <option>2022/2023</option>
                        <option>2021/2022</option>
                    </select>
                </div>
                <div class="col-md-3 mb-3">
                    <label class="form-label">Gelombang</label>
                    <select class="form-select">
                        <option selected>Semua Gelombang</option>
                        <option>Gelombang 1</option>
                        <option>Gelombang 2</option>
                        <option>Gelombang 3</option>
                    </select>
                </div>
                <div class="col-md-3 mb-3">
                    <label class="form-label">Status Verifikasi</label>
                    <select class="form-select">
                        <option selected>Semua Status</option>
                        <option>Pending</option>
                        <option>Lolos</option>
                        <option>Tidak Lolos</option>
                    </select>
                </div>
                <div class="col-md-3 mb-3 d-flex align-items-end">
                    <button class="btn btn-primary w-100">
                        <i class="fas fa-search me-2"></i> Terapkan Filter
                    </button>
                </div>
            </div>
        </div>
        
        <!-- Charts and Data Table -->
        <div class="row">
            <!-- Charts -->
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-header">
                        <i class="fas fa-chart-line me-2"></i> Statistik Pendaftar per Gelombang
                    </div>
                    <div class="card-body">
                        <div class="chart-container">
                            <canvas id="registrationChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Quick Actions -->
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-header">
                        <i class="fas fa-bolt me-2"></i> Aksi Cepat
                    </div>
                    <div class="card-body">
                        <div class="d-grid gap-2">
                            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#detailModal">
                                <i class="fas fa-eye me-2"></i> Lihat Detail Contoh
                            </button>
                            <button class="btn btn-outline-primary">
                                <i class="fas fa-file-export me-2"></i> Ekspor Data
                            </button>
                            <button class="btn btn-outline-primary">
                                <i class="fas fa-print me-2"></i> Cetak Laporan
                            </button>
                            <button class="btn btn-outline-primary">
                                <i class="fas fa-sync-alt me-2"></i> Refresh Data
                            </button>
                        </div>
                        
                        <div class="mt-4">
                            <h6 class="mb-3">Status Pendaftaran</h6>
                            <div class="d-flex justify-content-between mb-2">
                                <span>Lolos Verifikasi</span>
                                <span class="fw-bold">72%</span>
                            </div>
                            <div class="progress mb-3" style="height: 8px;">
                                <div class="progress-bar bg-success" style="width: 72%"></div>
                            </div>
                            
                            <div class="d-flex justify-content-between mb-2">
                                <span>Pending</span>
                                <span class="fw-bold">15%</span>
                            </div>
                            <div class="progress mb-3" style="height: 8px;">
                                <div class="progress-bar bg-warning" style="width: 15%"></div>
                            </div>
                            
                            <div class="d-flex justify-content-between mb-2">
                                <span>Tidak Lolos</span>
                                <span class="fw-bold">13%</span>
                            </div>
                            <div class="progress" style="height: 8px;">
                                <div class="progress-bar bg-danger" style="width: 13%"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Data Table -->
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <div>
                    <i class="fas fa-table me-2"></i> Data Pendaftar
                </div>
                <button class="btn btn-sm btn-primary">
                    <i class="fas fa-plus me-1"></i> Tambah Data
                </button>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Nama Pendaftar</th>
                                <th>Gelombang</th>
                                <th>Tanggal Daftar</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>Andi Setiawan</td>
                                <td>Gelombang 1</td>
                                <td>15 Jan 2023</td>
                                <td><span class="badge badge-lolos">Lolos</span></td>
                                <td>
                                    <button class="btn btn-sm btn-action btn-outline-primary" data-bs-toggle="modal" data-bs-target="#detailModal" title="Lihat Detail">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <button class="btn btn-sm btn-action btn-outline-success" title="Verifikasi">
                                        <i class="fas fa-check"></i>
                                    </button>
                                    <button class="btn btn-sm btn-action btn-outline-danger" title="Hapus">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>Budi Santoso</td>
                                <td>Gelombang 2</td>
                                <td>22 Feb 2023</td>
                                <td><span class="badge badge-pending">Pending</span></td>
                                <td>
                                    <button class="btn btn-sm btn-action btn-outline-primary" data-bs-toggle="modal" data-bs-target="#detailModal" title="Lihat Detail">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <button class="btn btn-sm btn-action btn-outline-success" title="Verifikasi">
                                        <i class="fas fa-check"></i>
                                    </button>
                                    <button class="btn btn-sm btn-action btn-outline-danger" title="Hapus">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td>Citra Dewi</td>
                                <td>Gelombang 1</td>
                                <td>10 Mar 2023</td>
                                <td><span class="badge badge-tidak">Tidak Lolos</span></td>
                                <td>
                                    <button class="btn btn-sm btn-action btn-outline-primary" data-bs-toggle="modal" data-bs-target="#detailModal" title="Lihat Detail">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <button class="btn btn-sm btn-action btn-outline-success" title="Verifikasi">
                                        <i class="fas fa-check"></i>
                                    </button>
                                    <button class="btn btn-sm btn-action btn-outline-danger" title="Hapus">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                            <tr>
                                <td>4</td>
                                <td>Dian Pratama</td>
                                <td>Gelombang 3</td>
                                <td>5 Apr 2023</td>
                                <td><span class="badge badge-lolos">Lolos</span></td>
                                <td>
                                    <button class="btn btn-sm btn-action btn-outline-primary" data-bs-toggle="modal" data-bs-target="#detailModal" title="Lihat Detail">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <button class="btn btn-sm btn-action btn-outline-success" title="Verifikasi">
                                        <i class="fas fa-check"></i>
                                    </button>
                                    <button class="btn btn-sm btn-action btn-outline-danger" title="Hapus">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                            <tr>
                                <td>5</td>
                                <td>Eka Putri</td>
                                <td>Gelombang 2</td>
                                <td>18 Mei 2023</td>
                                <td><span class="badge badge-pending">Pending</span></td>
                                <td>
                                    <button class="btn btn-sm btn-action btn-outline-primary" data-bs-toggle="modal" data-bs-target="#detailModal" title="Lihat Detail">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <button class="btn btn-sm btn-action btn-outline-success" title="Verifikasi">
                                        <i class="fas fa-check"></i>
                                    </button>
                                    <button class="btn btn-sm btn-action btn-outline-danger" title="Hapus">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                
                <nav aria-label="Page navigation" class="mt-3">
                    <ul class="pagination justify-content-center">
                        <li class="page-item disabled">
                            <a class="page-link" href="#" tabindex="-1">Previous</a>
                        </li>
                        <li class="page-item active"><a class="page-link" href="#">1</a></li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item">
                            <a class="page-link" href="#">Next</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
        
        <!-- Footer -->
        <footer>
            <p>&copy; 2023 Sistem Pendaftaran SIGAP. Hak Cipta Dilindungi.</p>
            <p class="text-muted small">Template Dashboard v2.1 - Dibuat dengan Bootstrap 5</p>
        </footer>
    </div>
    
    <!-- Detail Modal -->
    <div class="modal fade" id="detailModal" tabindex="-1" aria-labelledby="detailModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="detailModalLabel">
                        <i class="fas fa-user-graduate me-2"></i> Detail Pendaftar
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-4 text-center mb-4">
                            <div class="mb-3">
                                <div class="avatar mx-auto" style="width: 100px; height: 100px; font-size: 2.5rem;">
                                    <span>AS</span>
                                </div>
                            </div>
                            <h5>Andi Setiawan</h5>
                            <span class="badge badge-lolos">Lolos Seleksi</span>
                        </div>
                        <div class="col-md-8">
                            <div class="detail-item">
                                <div class="detail-label">Nomor Pendaftaran</div>
                                <div>SIGAP-2023-00123</div>
                            </div>
                            <div class="detail-item">
                                <div class="detail-label">Gelombang Pendaftaran</div>
                                <div>Gelombang 1</div>
                            </div>
                            <div class="detail-item">
                                <div class="detail-label">Tanggal Pendaftaran</div>
                                <div>15 Januari 2023</div>
                            </div>
                            <div class="detail-item">
                                <div class="detail-label">Jalur Pendaftaran</div>
                                <div>Prestasi Akademik</div>
                            </div>
                            <div class="detail-item">
                                <div class="detail-label">Asal Sekolah</div>
                                <div>SMP Negeri 1 Jakarta</div>
                            </div>
                            <div class="detail-item">
                                <div class="detail-label">Nilai Rata-rata</div>
                                <div>88.5</div>
                            </div>
                            <div class="detail-item">
                                <div class="detail-label">Email</div>
                                <div>andi.setiawan@email.com</div>
                            </div>
                            <div class="detail-item">
                                <div class="detail-label">No. Telepon</div>
                                <div>0812-3456-7890</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="button" class="btn btn-primary">Cetak Formulir</button>
                    <button type="button" class="btn btn-success">Verifikasi Pendaftaran</button>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        // Sidebar Toggle for Mobile
        document.addEventListener('DOMContentLoaded', function() {
            const sidebar = document.getElementById('sidebar');
            const sidebarToggle = document.getElementById('sidebarToggle');
            const sidebarOverlay = document.getElementById('sidebarOverlay');
            
            sidebarToggle.addEventListener('click', function() {
                sidebar.classList.toggle('mobile-open');
                sidebarOverlay.classList.toggle('mobile-open');
            });
            
            sidebarOverlay.addEventListener('click', function() {
                sidebar.classList.remove('mobile-open');
                sidebarOverlay.classList.remove('mobile-open');
            });
            
            // Initialize Charts
            const ctx = document.getElementById('registrationChart').getContext('2d');
            
            // Data for the chart
            const registrationChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: ['Gelombang 1', 'Gelombang 2', 'Gelombang 3', 'Gelombang 4'],
                    datasets: [
                        {
                            label: 'Total Pendaftar',
                            data: [420, 380, 315, 130],
                            backgroundColor: '#005B8F',
                            borderColor: '#004a75',
                            borderWidth: 1,
                            borderRadius: 5
                        },
                        {
                            label: 'Lulus Seleksi',
                            data: [320, 290, 240, 85],
                            backgroundColor: '#28a745',
                            borderColor: '#218838',
                            borderWidth: 1,
                            borderRadius: 5
                        },
                        {
                            label: 'Belum Diverifikasi',
                            data: [65, 55, 45, 22],
                            backgroundColor: '#ffc107',
                            borderColor: '#e0a800',
                            borderWidth: 1,
                            borderRadius: 5
                        }
                    ]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'top',
                        },
                        tooltip: {
                            mode: 'index',
                            intersect: false
                        }
                    },
                    scales: {
                        x: {
                            grid: {
                                display: false
                            }
                        },
                        y: {
                            beginAtZero: true,
                            ticks: {
                                stepSize: 100
                            },
                            grid: {
                                borderDash: [5, 5]
                            }
                        }
                    },
                    interaction: {
                        intersect: false,
                        mode: 'nearest'
                    }
                }
            });
            
            // Add hover effect to table rows
            const tableRows = document.querySelectorAll('.table tbody tr');
            tableRows.forEach(row => {
                row.addEventListener('click', function() {
                    // Remove active class from all rows
                    tableRows.forEach(r => r.classList.remove('table-active'));
                    // Add active class to clicked row
                    this.classList.add('table-active');
                });
            });
            
            // Simulate loading animation for statistic cards
            const statCards = document.querySelectorAll('.stat-card .number');
            statCards.forEach(card => {
                const originalText = card.textContent;
                card.textContent = '0';
                
                let counter = 0;
                const target = parseInt(originalText.replace(/,/g, ''));
                const increment = target / 50;
                
                const updateCounter = () => {
                    if (counter < target) {
                        counter += increment;
                        card.textContent = Math.floor(counter).toLocaleString();
                        setTimeout(updateCounter, 20);
                    } else {
                        card.textContent = originalText;
                    }
                };
                
                setTimeout(updateCounter, 300);
            });
        });
    </script>
</body>
</html>