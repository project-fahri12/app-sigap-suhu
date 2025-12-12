<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Documentation | API Docs</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary: #005B8F;
            --secondary: #00C4CC;
            --dark: #003366;
            --soft-bg: #F8F9FA;
            --text-dark: #333333;
            --text-light: #666666;
            --text-white: #FFFFFF;
            --border-color: #E0E0E0;
            --code-bg: #1E1E1E;
            --card-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            --navbar-shadow: 0 2px 12px rgba(0, 0, 0, 0.08);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            color: var(--text-dark);
            background-color: var(--soft-bg);
            line-height: 1.6;
            display: flex;
            min-height: 100vh;
        }

        /* Sidebar Styles */
        .sidebar {
            width: 260px;
            background-color: var(--dark);
            color: var(--text-white);
            position: fixed;
            height: 100vh;
            overflow-y: auto;
            z-index: 100;
            transition: transform 0.3s ease;
        }

        .sidebar-header {
            padding: 20px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .logo-container {
            width: 40px;
            height: 40px;
            border-radius: 8px;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .logo-container img {
            width: 24px;
            height: 24px;
            filter: brightness(0) invert(1);
        }

        .sidebar-header h2 {
            font-size: 1.3rem;
            font-weight: 600;
            line-height: 1.2;
        }

        .sidebar-nav {
            padding: 20px 0;
        }

        .nav-section {
            margin-bottom: 20px;
        }

        .nav-section h3 {
            font-size: 0.85rem;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            padding: 0 20px 10px;
            color: rgba(255, 255, 255, 0.7);
            font-weight: 500;
        }

        .nav-links {
            list-style: none;
        }

        .nav-links li a {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 10px 20px;
            color: rgba(255, 255, 255, 0.85);
            text-decoration: none;
            font-weight: 400;
            transition: all 0.2s;
            border-left: 3px solid transparent;
        }

        .nav-links li a:hover {
            background-color: rgba(255, 255, 255, 0.05);
            color: var(--text-white);
            border-left-color: var(--primary);
        }

        .nav-links li a.active {
            background-color: rgba(0, 91, 143, 0.2);
            color: var(--text-white);
            border-left-color: var(--secondary);
            font-weight: 500;
        }

        .nav-links li a .expand-icon {
            font-size: 0.8rem;
            transition: transform 0.3s;
        }

        .nav-links li a.expanded .expand-icon {
            transform: rotate(90deg);
        }

        .submenu {
            list-style: none;
            background-color: rgba(0, 0, 0, 0.15);
            overflow: hidden;
            max-height: 0;
            transition: max-height 0.3s ease;
        }

        .submenu.expanded {
            max-height: 300px;
        }

        .submenu li a {
            padding-left: 40px;
            font-size: 0.9rem;
        }

        /* Navbar Styles */
        .navbar {
            background-color: var(--text-white);
            box-shadow: var(--navbar-shadow);
            padding: 0 30px;
            height: 70px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: fixed;
            top: 0;
            left: 260px;
            right: 0;
            z-index: 90;
            transition: left 0.3s ease;
        }

        .navbar-left {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .navbar-logo {
            width: 36px;
            height: 36px;
            border-radius: 6px;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .navbar-logo img {
            width: 20px;
            height: 20px;
            filter: brightness(0) invert(1);
        }

        .navbar-title {
            font-size: 1.5rem;
            font-weight: 600;
            color: var(--dark);
        }

        .search-container {
            position: relative;
            width: 300px;
        }

        .search-input {
            width: 100%;
            padding: 10px 15px 10px 40px;
            border: 1px solid var(--border-color);
            border-radius: 6px;
            font-family: 'Inter', sans-serif;
            font-size: 0.9rem;
            background-color: var(--soft-bg);
            transition: border-color 0.3s;
        }

        .search-input:focus {
            outline: none;
            border-color: var(--primary);
        }

        .search-icon {
            position: absolute;
            left: 12px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--text-light);
            font-size: 0.9rem;
        }

        .mobile-menu-btn {
            display: none;
            background: none;
            border: none;
            font-size: 1.5rem;
            color: var(--primary);
            cursor: pointer;
        }

        /* Main Content */
        .main-content {
            flex: 1;
            margin-left: 260px;
            margin-top: 70px;
            padding: 30px;
            transition: margin-left 0.3s ease;
        }

        .content-wrapper {
            max-width: 900px;
        }

        /* Typography */
        h1 {
            font-size: 2.5rem;
            font-weight: 700;
            color: var(--dark);
            margin-bottom: 20px;
            line-height: 1.2;
        }

        h2 {
            font-size: 1.8rem;
            font-weight: 600;
            color: var(--dark);
            margin: 40px 0 20px;
            padding-bottom: 10px;
            border-bottom: 1px solid var(--border-color);
        }

        h3 {
            font-size: 1.4rem;
            font-weight: 600;
            color: var(--primary);
            margin: 30px 0 15px;
        }

        p {
            margin-bottom: 20px;
            color: var(--text-light);
            font-weight: 400;
        }

        a {
            color: var(--primary);
            text-decoration: none;
            transition: color 0.2s;
        }

        a:hover {
            color: var(--secondary);
        }

        /* Code Blocks */
        pre {
            background-color: var(--code-bg);
            border-radius: 8px;
            padding: 20px;
            margin: 25px 0;
            overflow-x: auto;
            box-shadow: var(--card-shadow);
        }

        code {
            font-family: 'Courier New', monospace;
            font-size: 0.9rem;
        }

        .code-block {
            color: #d4d4d4;
            line-height: 1.5;
        }

        .code-keyword {
            color: #569cd6;
        }

        .code-function {
            color: #dcdcaa;
        }

        .code-string {
            color: #ce9178;
        }

        .code-comment {
            color: #6a9955;
        }

        .code-parameter {
            color: #9cdcfe;
        }

        .inline-code {
            background-color: rgba(0, 91, 143, 0.1);
            color: var(--primary);
            padding: 2px 6px;
            border-radius: 4px;
            font-family: 'Courier New', monospace;
            font-size: 0.9rem;
        }

        /* Cards */
        .card {
            background-color: var(--text-white);
            border-radius: 8px;
            padding: 25px;
            margin: 25px 0;
            box-shadow: var(--card-shadow);
            border-left: 4px solid var(--primary);
        }

        .card-secondary {
            border-left-color: var(--secondary);
        }

        .card h3 {
            margin-top: 0;
        }

        /* Alert Boxes */
        .alert {
            padding: 18px;
            border-radius: 8px;
            margin: 25px 0;
            display: flex;
            align-items: flex-start;
            gap: 15px;
        }

        .alert-info {
            background-color: rgba(0, 196, 204, 0.1);
            border-left: 4px solid var(--secondary);
        }

        .alert-warning {
            background-color: rgba(255, 193, 7, 0.1);
            border-left: 4px solid #ffc107;
        }

        .alert-icon {
            font-size: 1.2rem;
            margin-top: 2px;
        }

        .alert-info .alert-icon {
            color: var(--secondary);
        }

        .alert-warning .alert-icon {
            color: #ffc107;
        }

        /* Tables */
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 25px 0;
            box-shadow: var(--card-shadow);
            border-radius: 8px;
            overflow: hidden;
        }

        th {
            background-color: var(--dark);
            color: var(--text-white);
            font-weight: 600;
            text-align: left;
            padding: 15px;
        }

        td {
            padding: 15px;
            border-bottom: 1px solid var(--border-color);
            color: var(--text-light);
        }

        tr:nth-child(even) {
            background-color: rgba(248, 249, 250, 0.8);
        }

        tr:hover {
            background-color: rgba(0, 91, 143, 0.05);
        }

        /* API Example */
        .api-example {
            background-color: var(--text-white);
            border-radius: 8px;
            padding: 0;
            margin: 30px 0;
            overflow: hidden;
            box-shadow: var(--card-shadow);
        }

        .api-example-header {
            background-color: var(--dark);
            color: var(--text-white);
            padding: 15px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .api-method {
            background-color: var(--secondary);
            color: var(--text-white);
            padding: 5px 12px;
            border-radius: 4px;
            font-weight: 600;
            font-size: 0.85rem;
            letter-spacing: 0.5px;
        }

        .api-endpoint {
            font-family: 'Courier New', monospace;
            font-size: 0.95rem;
        }

        .api-example-content {
            padding: 20px;
        }

        /* Mobile Responsiveness */
        @media (max-width: 1024px) {
            .sidebar {
                transform: translateX(-100%);
            }
            
            .sidebar.active {
                transform: translateX(0);
            }
            
            .navbar {
                left: 0;
            }
            
            .main-content {
                margin-left: 0;
            }
            
            .mobile-menu-btn {
                display: block;
            }
            
            .search-container {
                width: 200px;
            }
        }

        @media (max-width: 768px) {
            .navbar {
                padding: 0 15px;
            }
            
            .navbar-title {
                font-size: 1.2rem;
            }
            
            .main-content {
                padding: 20px;
            }
            
            h1 {
                font-size: 2rem;
            }
            
            h2 {
                font-size: 1.5rem;
            }
            
            .search-container {
                width: 150px;
            }
        }

        @media (max-width: 576px) {
            .search-container {
                display: none;
            }
            
            .navbar-title {
                font-size: 1.1rem;
            }
            
            .sidebar-header h2 {
                font-size: 1.1rem;
            }
        }

        /* Footer */
        .footer {
            margin-top: 60px;
            padding-top: 30px;
            border-top: 1px solid var(--border-color);
            color: var(--text-light);
            font-size: 0.9rem;
            text-align: center;
        }

        /* Utility Classes */
        .text-primary {
            color: var(--primary);
        }

        .text-secondary {
            color: var(--secondary);
        }

        .mb-20 {
            margin-bottom: 20px;
        }

        .mb-30 {
            margin-bottom: 30px;
        }
    </style>
</head>
<body>
    <!-- Sidebar Navigation -->
    <aside class="sidebar" id="sidebar">
        <div class="sidebar-header">
            <div>
            <img src="{{ asset('assets/logo-sigap-transparan.svg') }}" alt="logo-sigap" width="150">
                <div style="font-size: 0.75rem; opacity: 0.8; margin-top: 2px;"> Aplication v2.1.0</div>
            </div>
        </div>
        <nav class="sidebar-nav">
            <div class="nav-section">
                <h3>Getting Started</h3>
                <ul class="nav-links">
                    <li><a href="#pendahuluan" class="active"><span>Pendahuluan</span></a></li>
                    <li><a href="#instalasi"><span>Instalasi</span></a></li>
                    <li><a href="#autentikasi"><span>Autentikasi</span></a></li>
                </ul>
            </div>
            <div class="nav-section">
                <h3>API Reference</h3>
                <ul class="nav-links">
                    <li>
                        <a href="#endpoints" id="endpoints-toggle">
                            <span>Endpoints</span>
                            <i class="fas fa-chevron-right expand-icon"></i>
                        </a>
                        <ul class="submenu" id="endpoints-submenu">
                            <li><a href="#users-endpoint"><span>Users</span></a></li>
                            <li><a href="#products-endpoint"><span>Products</span></a></li>
                            <li><a href="#orders-endpoint"><span>Orders</span></a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="#responses" id="responses-toggle">
                            <span>Responses</span>
                            <i class="fas fa-chevron-right expand-icon"></i>
                        </a>
                        <ul class="submenu" id="responses-submenu">
                            <li><a href="#success-response"><span>Success</span></a></li>
                            <li><a href="#error-response"><span>Error</span></a></li>
                        </ul>
                    </li>
                </ul>
            </div>
            <div class="nav-section">
                <h3>Examples</h3>
                <ul class="nav-links">
                    <li><a href="#code-samples"><span>Code Samples</span></a></li>
                    <li><a href="#sdk"><span>SDK Libraries</span></a></li>
                </ul>
            </div>
            <div class="nav-section">
                <h3>Resources</h3>
                <ul class="nav-links">
                    <li><a href="#support"><span>Support</span></a></li>
                    <li><a href="#changelog"><span>Changelog</span></a></li>
                    <li><a href="#faq"><span>FAQ</span></a></li>
                </ul>
            </div>
        </nav>
    </aside>

    <!-- Navbar -->
    <header class="navbar">
        <div class="navbar-left">
            <button class="mobile-menu-btn" id="mobile-menu-btn">
                <i class="fas fa-bars"></i>
            </button>
            <div class="navbar-logo">
                <!-- Logo kecil untuk navbar -->
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M12 2L3 7V17L12 22L21 17V7L12 2Z" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M12 22V12" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M21 7L12 12L3 7" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </div>
            <h1 class="navbar-title">API Documentation</h1>
        </div>
        <div class="search-container">
            <i class="fas fa-search search-icon"></i>
            <input type="text" class="search-input" placeholder="Search documentation...">
        </div>
    </header>

    <!-- Main Content -->
    <main class="main-content">
        <div class="content-wrapper">
            <h1 id="pendahuluan">Pendahuluan</h1>
            <p>Selamat datang di dokumentasi API kami. API ini menyediakan akses yang aman dan mudah ke berbagai layanan dan data yang kami sediakan. Dokumentasi ini akan membantu Anda memahami cara mengintegrasikan API ke dalam aplikasi Anda dengan cepat.</p>
            
            <div class="alert alert-info">
                <i class="fas fa-info-circle alert-icon"></i>
                <div>
                    <p><strong>Info:</strong> Anda memerlukan kunci API untuk menggunakan semua endpoint. Dapatkan kunci API dari dashboard pengembang setelah mendaftar.</p>
                </div>
            </div>
            
            <div class="card">
                <h3>Fitur Utama</h3>
                <ul style="padding-left: 20px; color: var(--text-light); margin-bottom: 15px;">
                    <li style="margin-bottom: 8px;">Autentikasi berbasis token JWT</li>
                    <li style="margin-bottom: 8px;">RESTful API dengan respons JSON</li>
                    <li style="margin-bottom: 8px;">Rate limiting untuk keamanan</li>
                    <li style="margin-bottom: 8px;">Webhook untuk notifikasi real-time</li>
                    <li>Dokumentasi yang lengkap dengan contoh kode</li>
                </ul>
            </div>
            
            <h2 id="instalasi">Instalasi</h2>
            <p>Ikuti langkah-langkah di bawah ini untuk mulai menggunakan API:</p>
            
            <h3>Persyaratan Sistem</h3>
            <p>Pastikan sistem Anda memenuhi persyaratan berikut:</p>
            
            <table>
                <thead>
                    <tr>
                        <th>Komponen</th>
                        <th>Versi Minimum</th>
                        <th>Rekomendasi</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Node.js</td>
                        <td>14.x</td>
                        <td>18.x</td>
                    </tr>
                    <tr>
                        <td>Python</td>
                        <td>3.7</td>
                        <td>3.10+</td>
                    </tr>
                    <tr>
                        <td>PHP</td>
                        <td>7.4</td>
                        <td>8.1+</td>
                    </tr>
                    <tr>
                        <td>cURL</td>
                        <td>7.58</td>
                        <td>Terbaru</td>
                    </tr>
                </tbody>
            </table>
            
            <h3>Instalasi dengan npm</h3>
            <p>Untuk proyek Node.js, instal library resmi kami:</p>
            
            <pre><code class="code-block"><span class="code-comment"># Install menggunakan npm</span>
<span class="code-keyword">npm</span> install api-client-sdk

<span class="code-comment"># Atau menggunakan yarn</span>
<span class="code-keyword">yarn</span> add api-client-sdk</code></pre>
            
            <h3>Konfigurasi Awal</h3>
            <p>Setelah instalasi, konfigurasi kunci API Anda:</p>
            
            <pre><code class="code-block"><span class="code-keyword">const</span> <span class="code-parameter">APIClient</span> = <span class="code-function">require</span>(<span class="code-string">'api-client-sdk'</span>);

<span class="code-keyword">const</span> <span class="code-parameter">client</span> = <span class="code-keyword">new</span> <span class="code-function">APIClient</span>({
  <span class="code-parameter">apiKey</span>: <span class="code-string">'your-api-key-here'</span>,
  <span class="code-parameter">environment</span>: <span class="code-string">'production'</span> <span class="code-comment">// atau 'sandbox' untuk testing</span>
});</code></pre>
            
            <div class="alert alert-warning">
                <i class="fas fa-exclamation-triangle alert-icon"></i>
                <div>
                    <p><strong>Peringatan:</strong> Jangan pernah mengekspos kunci API Anda di sisi klien (frontend). Selalu gunakan backend server untuk panggilan API yang memerlukan kunci rahasia.</p>
                </div>
            </div>
            
            <h2 id="contoh-endpoint">Contoh Endpoint API</h2>
            <p>Berikut adalah contoh penggunaan endpoint API untuk mengambil data pengguna:</p>
            
            <div class="api-example">
                <div class="api-example-header">
                    <div>
                        <span class="api-method">GET</span>
                        <span class="api-endpoint">/api/v1/users/{id}</span>
                    </div>
                    <div>
                        <span style="font-size: 0.85rem; opacity: 0.9;">Users Endpoint</span>
                    </div>
                </div>
                <div class="api-example-content">
                    <h3>Deskripsi</h3>
                    <p>Mengambil informasi pengguna berdasarkan ID.</p>
                    
                    <h3>Parameters</h3>
                    <table>
                        <thead>
                            <tr>
                                <th>Parameter</th>
                                <th>Tipe</th>
                                <th>Deskripsi</th>
                                <th>Wajib</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>id</td>
                                <td>string</td>
                                <td>ID unik pengguna</td>
                                <td>Ya</td>
                            </tr>
                            <tr>
                                <td>fields</td>
                                <td>string</td>
                                <td>Field yang ingin disertakan (pisahkan dengan koma)</td>
                                <td>Tidak</td>
                            </tr>
                        </tbody>
                    </table>
                    
                    <h3>Contoh Request</h3>
                    <pre><code class="code-block"><span class="code-comment">// Contoh dengan cURL</span>
<span class="code-keyword">curl</span> -X GET \
  <span class="code-string">'https://api.example.com/v1/users/12345?fields=name,email,created_at'</span> \
  -H <span class="code-string">'Authorization: Bearer your-api-key-here'</span> \
  -H <span class="code-string">'Content-Type: application/json'</span></code></pre>
                    
                    <h3>Contoh Response (Success)</h3>
                    <pre><code class="code-block">{
  <span class="code-string">"status"</span>: <span class="code-string">"success"</span>,
  <span class="code-string">"data"</span>: {
    <span class="code-string">"id"</span>: <span class="code-string">"12345"</span>,
    <span class="code-string">"name"</span>: <span class="code-string">"John Doe"</span>,
    <span class="code-string">"email"</span>: <span class="code-string">"john.doe@example.com"</span>,
    <span class="code-string">"created_at"</span>: <span class="code-string">"2023-01-15T10:30:00Z"</span>,
    <span class="code-string">"updated_at"</span>: <span class="code-string">"2023-06-20T14:45:00Z"</span>
  }
}</code></pre>
                    
                    <h3>Contoh Response (Error)</h3>
                    <pre><code class="code-block">{
  <span class="code-string">"status"</span>: <span class="code-string">"error"</span>,
  <span class="code-string">"code"</span>: <span class="code-string">"USER_NOT_FOUND"</span>,
  <span class="code-string">"message"</span>: <span class="code-string">"User dengan ID yang diberikan tidak ditemukan."</span>,
  <span class="code-string">"details"</span>: {}
}</code></pre>
                </div>
            </div>
            
            <div class="card card-secondary">
                <h3>Tips Penggunaan</h3>
                <p>Selalu tangani error dengan baik di aplikasi Anda. Gunakan try-catch untuk bahasa pemrograman yang mendukung, atau periksa kode status HTTP untuk menentukan keberhasilan request.</p>
                <p>Untuk performa optimal, cache respons API jika memungkinkan, terutama untuk data yang jarang berubah.</p>
            </div>
            
            <div class="footer">
                <p>© 2023 API Documentation. Semua hak dilindungi. | Versi 2.1.0</p>
            </div>
        </div>
    </main>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Mobile menu toggle
            const mobileMenuBtn = document.getElementById('mobile-menu-btn');
            const sidebar = document.getElementById('sidebar');
            
            mobileMenuBtn.addEventListener('click', function() {
                sidebar.classList.toggle('active');
            });
            
            // Close sidebar when clicking outside on mobile
            document.addEventListener('click', function(event) {
                const isClickInsideSidebar = sidebar.contains(event.target);
                const isClickOnMobileMenuBtn = mobileMenuBtn.contains(event.target);
                const isMobile = window.innerWidth <= 1024;
                
                if (isMobile && !isClickInsideSidebar && !isClickOnMobileMenuBtn && sidebar.classList.contains('active')) {
                    sidebar.classList.remove('active');
                }
            });
            
            // Expand/collapse sidebar menu items
            const endpointsToggle = document.getElementById('endpoints-toggle');
            const endpointsSubmenu = document.getElementById('endpoints-submenu');
            const responsesToggle = document.getElementById('responses-toggle');
            const responsesSubmenu = document.getElementById('responses-submenu');
            
            endpointsToggle.addEventListener('click', function(e) {
                e.preventDefault();
                this.classList.toggle('expanded');
                endpointsSubmenu.classList.toggle('expanded');
            });
            
            responsesToggle.addEventListener('click', function(e) {
                e.preventDefault();
                this.classList.toggle('expanded');
                responsesSubmenu.classList.toggle('expanded');
            });
            
            // Smooth scroll for anchor links
            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function(e) {
                    // For sidebar navigation links
                    if (this.getAttribute('href') !== '#') {
                        e.preventDefault();
                        
                        const targetId = this.getAttribute('href').substring(1);
                        const targetElement = document.getElementById(targetId);
                        
                        if (targetElement) {
                            // Close mobile sidebar if open
                            if (window.innerWidth <= 1024) {
                                sidebar.classList.remove('active');
                            }
                            
                            window.scrollTo({
                                top: targetElement.offsetTop - 100,
                                behavior: 'smooth'
                            });
                            
                            // Update active link in sidebar
                            document.querySelectorAll('.nav-links li a').forEach(link => {
                                link.classList.remove('active');
                            });
                            this.classList.add('active');
                        }
                    }
                });
            });
            
            // Simple search functionality
            const searchInput = document.querySelector('.search-input');
            searchInput.addEventListener('keyup', function(e) {
                if (e.key === 'Enter') {
                    const searchTerm = this.value.toLowerCase();
                    const contentElements = document.querySelectorAll('h1, h2, h3, p');
                    
                    // Simple highlight for demo purposes
                    contentElements.forEach(element => {
                        const text = element.textContent.toLowerCase();
                        if (text.includes(searchTerm) && searchTerm.length > 2) {
                            element.style.backgroundColor = 'rgba(0, 196, 204, 0.2)';
                            setTimeout(() => {
                                element.style.backgroundColor = '';
                            }, 2000);
                        }
                    });
                    
                    // Scroll to first match
                    const firstMatch = Array.from(contentElements).find(el => 
                        el.textContent.toLowerCase().includes(searchTerm) && searchTerm.length > 2
                    );
                    
                    if (firstMatch) {
                        window.scrollTo({
                            top: firstMatch.offsetTop - 120,
                            behavior: 'smooth'
                        });
                    }
                }
            });
            
            // Syntax highlighting simulation
            const codeBlocks = document.querySelectorAll('pre code');
            codeBlocks.forEach(block => {
                // This is a simplified simulation of syntax highlighting
                // In a real implementation, you would use a library like Prism.js or Highlight.js
                const html = block.innerHTML;
                // Just for demonstration - in reality use a proper syntax highlighter
                block.innerHTML = html;
            });
        });
    </script>
</body>
</html>