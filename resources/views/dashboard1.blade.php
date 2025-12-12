<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
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
            --success: #28a745;
            --warning: #ffc107;
            --danger: #dc3545;
            --info: #17a2b8;
            --card-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            --navbar-shadow: 0 2px 12px rgba(0, 0, 0, 0.08);
            --sidebar-width: 260px;
            --header-height: 70px;
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
        }

        /* Layout Container */
        .dashboard-container {
            display: flex;
            min-height: 100vh;
        }

        /* Sidebar Styles */
        .sidebar {
            width: var(--sidebar-width);
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
            height: var(--header-height);
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
            gap: 12px;
            padding: 12px 20px;
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

        .nav-icon {
            font-size: 1.1rem;
            width: 24px;
            text-align: center;
        }

        /* Main Content Area */
        .main-content {
            flex: 1;
            margin-left: var(--sidebar-width);
            transition: margin-left 0.3s ease;
        }

        /* Header Styles */
        .header {
            background-color: var(--text-white);
            box-shadow: var(--navbar-shadow);
            height: var(--header-height);
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 30px;
            position: sticky;
            top: 0;
            z-index: 90;
        }

        .header-left {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .mobile-menu-btn {
            display: none;
            background: none;
            border: none;
            font-size: 1.5rem;
            color: var(--primary);
            cursor: pointer;
        }

        .header-title h1 {
            font-size: 1.5rem;
            font-weight: 600;
            color: var(--dark);
        }

        .header-right {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .search-container {
            position: relative;
            width: 250px;
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

        .user-profile {
            display: flex;
            align-items: center;
            gap: 10px;
            cursor: pointer;
            padding: 8px 12px;
            border-radius: 6px;
            transition: background-color 0.2s;
        }

        .user-profile:hover {
            background-color: rgba(0, 0, 0, 0.03);
        }

        .avatar {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 600;
            font-size: 0.9rem;
        }

        .user-info h4 {
            font-size: 0.95rem;
            font-weight: 600;
            margin-bottom: 2px;
        }

        .user-info p {
            font-size: 0.8rem;
            color: var(--text-light);
        }

        /* Content Area */
        .content-area {
            padding: 30px;
        }

        /* Dashboard Grid */
        .dashboard-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 25px;
            margin-bottom: 30px;
        }

        /* Cards */
        .card {
            background-color: var(--text-white);
            border-radius: 10px;
            padding: 25px;
            box-shadow: var(--card-shadow);
            transition: transform 0.2s, box-shadow 0.2s;
        }

        .card:hover {
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
        }

        .card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .card-title {
            font-size: 1.1rem;
            font-weight: 600;
            color: var(--dark);
        }

        .card-icon {
            width: 48px;
            height: 48px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.3rem;
            color: white;
        }

        .icon-primary {
            background: linear-gradient(135deg, var(--primary), #0077b3);
        }

        .icon-success {
            background: linear-gradient(135deg, var(--success), #20c997);
        }

        .icon-warning {
            background: linear-gradient(135deg, var(--warning), #ffd166);
        }

        .icon-secondary {
            background: linear-gradient(135deg, var(--secondary), #00e6e6);
        }

        .card-value {
            font-size: 2rem;
            font-weight: 700;
            color: var(--dark);
            margin-bottom: 5px;
        }

        .card-change {
            font-size: 0.9rem;
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .card-change.positive {
            color: var(--success);
        }

        .card-change.negative {
            color: var(--danger);
        }

        /* Chart Container */
        .chart-container {
            background-color: var(--text-white);
            border-radius: 10px;
            padding: 25px;
            box-shadow: var(--card-shadow);
            margin-bottom: 30px;
        }

        .chart-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
        }

        .chart-title {
            font-size: 1.2rem;
            font-weight: 600;
            color: var(--dark);
        }

        .chart-actions {
            display: flex;
            gap: 10px;
        }

        .chart-btn {
            padding: 8px 16px;
            background-color: var(--soft-bg);
            border: 1px solid var(--border-color);
            border-radius: 6px;
            font-family: 'Inter', sans-serif;
            font-size: 0.9rem;
            color: var(--text-light);
            cursor: pointer;
            transition: all 0.2s;
        }

        .chart-btn.active {
            background-color: var(--primary);
            color: white;
            border-color: var(--primary);
        }

        .chart-btn:hover:not(.active) {
            background-color: #e9ecef;
        }

        .chart-placeholder {
            height: 300px;
            background-color: #f8f9fa;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--text-light);
            font-size: 0.9rem;
            border: 1px dashed var(--border-color);
        }

        /* Recent Activity */
        .activity-container {
            background-color: var(--text-white);
            border-radius: 10px;
            padding: 25px;
            box-shadow: var(--card-shadow);
            margin-bottom: 30px;
        }

        .activity-list {
            list-style: none;
        }

        .activity-item {
            display: flex;
            align-items: flex-start;
            gap: 15px;
            padding: 15px 0;
            border-bottom: 1px solid var(--border-color);
        }

        .activity-item:last-child {
            border-bottom: none;
        }

        .activity-icon {
            width: 36px;
            height: 36px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1rem;
            color: white;
            flex-shrink: 0;
        }

        .activity-content h4 {
            font-size: 0.95rem;
            font-weight: 600;
            margin-bottom: 5px;
        }

        .activity-content p {
            font-size: 0.85rem;
            color: var(--text-light);
        }

        .activity-time {
            font-size: 0.8rem;
            color: var(--text-light);
            margin-top: 5px;
        }

        /* Table */
        .table-container {
            background-color: var(--text-white);
            border-radius: 10px;
            padding: 25px;
            box-shadow: var(--card-shadow);
            overflow: hidden;
        }

        .table-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th {
            background-color: var(--soft-bg);
            color: var(--text-dark);
            font-weight: 600;
            text-align: left;
            padding: 15px;
            border-bottom: 1px solid var(--border-color);
        }

        td {
            padding: 15px;
            border-bottom: 1px solid var(--border-color);
            color: var(--text-light);
        }

        tr:hover {
            background-color: rgba(0, 91, 143, 0.03);
        }

        .status-badge {
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 500;
            display: inline-block;
        }

        .status-active {
            background-color: rgba(40, 167, 69, 0.1);
            color: var(--success);
        }

        .status-pending {
            background-color: rgba(255, 193, 7, 0.1);
            color: var(--warning);
        }

        .status-inactive {
            background-color: rgba(220, 53, 69, 0.1);
            color: var(--danger);
        }

        /* Button */
        .btn {
            padding: 10px 20px;
            border-radius: 6px;
            font-family: 'Inter', sans-serif;
            font-weight: 500;
            font-size: 0.9rem;
            border: none;
            cursor: pointer;
            transition: all 0.2s;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .btn-primary {
            background-color: var(--primary);
            color: white;
        }

        .btn-primary:hover {
            background-color: #004a75;
        }

        .btn-secondary {
            background-color: var(--soft-bg);
            color: var(--text-dark);
            border: 1px solid var(--border-color);
        }

        .btn-secondary:hover {
            background-color: #e9ecef;
        }

        /* Footer */
        .footer {
            margin-top: 40px;
            padding-top: 20px;
            border-top: 1px solid var(--border-color);
            color: var(--text-light);
            font-size: 0.85rem;
            text-align: center;
        }

        /* Mobile Responsiveness */
        @media (max-width: 1024px) {
            .sidebar {
                transform: translateX(-100%);
            }
            
            .sidebar.active {
                transform: translateX(0);
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
            
            .dashboard-grid {
                grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            }
        }

        @media (max-width: 768px) {
            .header {
                padding: 0 15px;
            }
            
            .content-area {
                padding: 20px;
            }
            
            .search-container {
                display: none;
            }
            
            .dashboard-grid {
                grid-template-columns: 1fr;
            }
            
            .chart-actions {
                flex-wrap: wrap;
            }
            
            .table-container {
                overflow-x: auto;
            }
            
            table {
                min-width: 600px;
            }
        }

        @media (max-width: 576px) {
            .header-right {
                gap: 10px;
            }
            
            .user-info {
                display: none;
            }
            
            .chart-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 15px;
            }
            
            .chart-actions {
                width: 100%;
                justify-content: space-between;
            }
            
            .chart-btn {
                flex: 1;
                text-align: center;
            }
        }
    </style>
</head>
<body>
    <div class="dashboard-container">
        <!-- Sidebar -->
        <aside class="sidebar" id="sidebar">
            <div class="sidebar-header">
                <div class="logo-container">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M19 3H5C3.89543 3 3 3.89543 3 5V19C3 20.1046 3.89543 21 5 21H19C20.1046 21 21 20.1046 21 19V5C21 3.89543 20.1046 3 19 3Z" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M16 3V9L12 7L8 9V3" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M9 21V15H15V21" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </div>
                <div>
                    <h2>Admin Panel</h2>
                    <div style="font-size: 0.75rem; opacity: 0.8; margin-top: 2px;">v2.1.0</div>
                </div>
            </div>
            <nav class="sidebar-nav">
                <div class="nav-section">
                    <h3>Main</h3>
                    <ul class="nav-links">
                        <li><a href="#" class="active"><i class="fas fa-tachometer-alt nav-icon"></i><span>Dashboard</span></a></li>
                        <li><a href="#"><i class="fas fa-chart-line nav-icon"></i><span>Analytics</span></a></li>
                        <li><a href="#"><i class="fas fa-users nav-icon"></i><span>Users</span></a></li>
                        <li><a href="#"><i class="fas fa-shopping-cart nav-icon"></i><span>Orders</span></a></li>
                        <li><a href="#"><i class="fas fa-box nav-icon"></i><span>Products</span></a></li>
                    </ul>
                </div>
                <div class="nav-section">
                    <h3>Management</h3>
                    <ul class="nav-links">
                        <li><a href="#"><i class="fas fa-cog nav-icon"></i><span>Settings</span></a></li>
                        <li><a href="#"><i class="fas fa-bell nav-icon"></i><span>Notifications</span></a></li>
                        <li><a href="#"><i class="fas fa-file-alt nav-icon"></i><span>Reports</span></a></li>
                        <li><a href="#"><i class="fas fa-tags nav-icon"></i><span>Categories</span></a></li>
                    </ul>
                </div>
                <div class="nav-section">
                    <h3>Support</h3>
                    <ul class="nav-links">
                        <li><a href="#"><i class="fas fa-question-circle nav-icon"></i><span>Help Center</span></a></li>
                        <li><a href="#"><i class="fas fa-comments nav-icon"></i><span>Messages</span><span class="notification-badge">3</span></a></li>
                        <li><a href="#"><i class="fas fa-sign-out-alt nav-icon"></i><span>Logout</span></a></li>
                    </ul>
                </div>
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="main-content">
            <!-- Header -->
            <header class="header">
                <div class="header-left">
                    <button class="mobile-menu-btn" id="mobile-menu-btn">
                        <i class="fas fa-bars"></i>
                    </button>
                    <div class="header-title">
                        <h1>Dashboard Overview</h1>
                    </div>
                </div>
                <div class="header-right">
                    <div class="search-container">
                        <i class="fas fa-search search-icon"></i>
                        <input type="text" class="search-input" placeholder="Search...">
                    </div>
                    <div class="user-profile" id="user-profile">
                        <div class="avatar">JD</div>
                        <div class="user-info">
                            <h4>John Doe</h4>
                            <p>Administrator</p>
                        </div>
                        <i class="fas fa-chevron-down" style="font-size: 0.8rem;"></i>
                    </div>
                </div>
            </header>

            <!-- Content Area -->
            <div class="content-area">
                <!-- Stats Cards -->
                <div class="dashboard-grid">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Total Revenue</h3>
                            <div class="card-icon icon-primary">
                                <i class="fas fa-dollar-sign"></i>
                            </div>
                        </div>
                        <div class="card-value">$24,580</div>
                        <div class="card-change positive">
                            <i class="fas fa-arrow-up"></i>
                            <span>12.5% from last month</span>
                        </div>
                    </div>
                    
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Total Users</h3>
                            <div class="card-icon icon-success">
                                <i class="fas fa-users"></i>
                            </div>
                        </div>
                        <div class="card-value">1,842</div>
                        <div class="card-change positive">
                            <i class="fas fa-arrow-up"></i>
                            <span>8.2% from last month</span>
                        </div>
                    </div>
                    
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Active Orders</h3>
                            <div class="card-icon icon-warning">
                                <i class="fas fa-shopping-cart"></i>
                            </div>
                        </div>
                        <div class="card-value">156</div>
                        <div class="card-change negative">
                            <i class="fas fa-arrow-down"></i>
                            <span>3.1% from last month</span>
                        </div>
                    </div>
                    
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Conversion Rate</h3>
                            <div class="card-icon icon-secondary">
                                <i class="fas fa-chart-pie"></i>
                            </div>
                        </div>
                        <div class="card-value">4.7%</div>
                        <div class="card-change positive">
                            <i class="fas fa-arrow-up"></i>
                            <span>1.8% from last month</span>
                        </div>
                    </div>
                </div>

                <!-- Chart Section -->
                <div class="chart-container">
                    <div class="chart-header">
                        <h2 class="chart-title">Revenue Overview</h2>
                        <div class="chart-actions">
                            <button class="chart-btn active">7 Days</button>
                            <button class="chart-btn">30 Days</button>
                            <button class="chart-btn">90 Days</button>
                            <button class="chart-btn">1 Year</button>
                        </div>
                    </div>
                    <div class="chart-placeholder">
                        <div style="text-align: center;">
                            <i class="fas fa-chart-line" style="font-size: 2rem; margin-bottom: 10px; color: var(--primary);"></i>
                            <p>Revenue chart would be displayed here</p>
                            <p style="font-size: 0.8rem; margin-top: 5px;">(Interactive chart implementation would go here)</p>
                        </div>
                    </div>
                </div>

                <!-- Recent Activity & Table -->
                <div class="dashboard-grid" style="grid-template-columns: 1fr 2fr;">
                    <!-- Recent Activity -->
                    <div class="activity-container">
                        <h2 class="chart-title" style="margin-bottom: 20px;">Recent Activity</h2>
                        <ul class="activity-list">
                            <li class="activity-item">
                                <div class="activity-icon icon-primary">
                                    <i class="fas fa-user-plus"></i>
                                </div>
                                <div class="activity-content">
                                    <h4>New user registered</h4>
                                    <p>John Smith joined the platform</p>
                                    <div class="activity-time">10 minutes ago</div>
                                </div>
                            </li>
                            <li class="activity-item">
                                <div class="activity-icon icon-success">
                                    <i class="fas fa-shopping-cart"></i>
                                </div>
                                <div class="activity-content">
                                    <h4>New order placed</h4>
                                    <p>Order #4582 for $245.00</p>
                                    <div class="activity-time">45 minutes ago</div>
                                </div>
                            </li>
                            <li class="activity-item">
                                <div class="activity-icon icon-warning">
                                    <i class="fas fa-exclamation-triangle"></i>
                                </div>
                                <div class="activity-content">
                                    <h4>System alert</h4>
                                    <p>High server load detected</p>
                                    <div class="activity-time">2 hours ago</div>
                                </div>
                            </li>
                            <li class="activity-item">
                                <div class="activity-icon icon-secondary">
                                    <i class="fas fa-chart-line"></i>
                                </div>
                                <div class="activity-content">
                                    <h4>Report generated</h4>
                                    <p>Monthly sales report ready</p>
                                    <div class="activity-time">5 hours ago</div>
                                </div>
                            </li>
                        </ul>
                    </div>

                    <!-- Recent Orders Table -->
                    <div class="table-container">
                        <div class="table-header">
                            <h2 class="chart-title">Recent Orders</h2>
                            <button class="btn btn-secondary">
                                <i class="fas fa-download"></i>
                                <span>Export</span>
                            </button>
                        </div>
                        <table>
                            <thead>
                                <tr>
                                    <th>Order ID</th>
                                    <th>Customer</th>
                                    <th>Date</th>
                                    <th>Amount</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>#4582</td>
                                    <td>John Smith</td>
                                    <td>Nov 15, 2023</td>
                                    <td>$245.00</td>
                                    <td><span class="status-badge status-active">Completed</span></td>
                                    <td><button class="btn btn-secondary" style="padding: 5px 10px; font-size: 0.8rem;">View</button></td>
                                </tr>
                                <tr>
                                    <td>#4581</td>
                                    <td>Sarah Johnson</td>
                                    <td>Nov 14, 2023</td>
                                    <td>$189.50</td>
                                    <td><span class="status-badge status-active">Completed</span></td>
                                    <td><button class="btn btn-secondary" style="padding: 5px 10px; font-size: 0.8rem;">View</button></td>
                                </tr>
                                <tr>
                                    <td>#4580</td>
                                    <td>Michael Brown</td>
                                    <td>Nov 13, 2023</td>
                                    <td>$320.75</td>
                                    <td><span class="status-badge status-pending">Processing</span></td>
                                    <td><button class="btn btn-secondary" style="padding: 5px 10px; font-size: 0.8rem;">View</button></td>
                                </tr>
                                <tr>
                                    <td>#4579</td>
                                    <td>Emma Wilson</td>
                                    <td>Nov 12, 2023</td>
                                    <td>$156.20</td>
                                    <td><span class="status-badge status-active">Completed</span></td>
                                    <td><button class="btn btn-secondary" style="padding: 5px 10px; font-size: 0.8rem;">View</button></td>
                                </tr>
                                <tr>
                                    <td>#4578</td>
                                    <td>David Lee</td>
                                    <td>Nov 11, 2023</td>
                                    <td>$89.99</td>
                                    <td><span class="status-badge status-inactive">Cancelled</span></td>
                                    <td><button class="btn btn-secondary" style="padding: 5px 10px; font-size: 0.8rem;">View</button></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Quick Actions -->
                <div class="dashboard-grid" style="margin-top: 30px;">
                    <div class="card">
                        <h3 class="card-title" style="margin-bottom: 20px;">Quick Actions</h3>
                        <div style="display: flex; flex-direction: column; gap: 15px;">
                            <button class="btn btn-primary">
                                <i class="fas fa-plus"></i>
                                <span>Add New Product</span>
                            </button>
                            <button class="btn btn-secondary">
                                <i class="fas fa-user-plus"></i>
                                <span>Invite User</span>
                            </button>
                            <button class="btn btn-secondary">
                                <i class="fas fa-file-export"></i>
                                <span>Generate Report</span>
                            </button>
                            <button class="btn btn-secondary">
                                <i class="fas fa-cog"></i>
                                <span>System Settings</span>
                            </button>
                        </div>
                    </div>
                    
                    <div class="card">
                        <h3 class="card-title" style="margin-bottom: 20px;">System Status</h3>
                        <div style="display: flex; flex-direction: column; gap: 15px;">
                            <div style="display: flex; justify-content: space-between;">
                                <span>Server Load</span>
                                <span style="font-weight: 600; color: var(--success);">42%</span>
                            </div>
                            <div style="height: 8px; background-color: var(--soft-bg); border-radius: 4px; overflow: hidden;">
                                <div style="width: 42%; height: 100%; background-color: var(--success);"></div>
                            </div>
                            
                            <div style="display: flex; justify-content: space-between;">
                                <span>Database</span>
                                <span style="font-weight: 600; color: var(--success);">Normal</span>
                            </div>
                            <div style="height: 8px; background-color: var(--soft-bg); border-radius: 4px; overflow: hidden;">
                                <div style="width: 65%; height: 100%; background-color: var(--success);"></div>
                            </div>
                            
                            <div style="display: flex; justify-content: space-between;">
                                <span>Storage</span>
                                <span style="font-weight: 600; color: var(--warning);">78%</span>
                            </div>
                            <div style="height: 8px; background-color: var(--soft-bg); border-radius: 4px; overflow: hidden;">
                                <div style="width: 78%; height: 100%; background-color: var(--warning);"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Footer -->
                <div class="footer">
                    <p>© 2023 Admin Dashboard. All rights reserved. | System v2.1.0 | Last updated: Today, 10:30 AM</p>
                </div>
            </div>
        </main>
    </div>

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
            
            // Chart period buttons
            const chartBtns = document.querySelectorAll('.chart-btn');
            chartBtns.forEach(btn => {
                btn.addEventListener('click', function() {
                    chartBtns.forEach(b => b.classList.remove('active'));
                    this.classList.add('active');
                });
            });
            
            // User profile dropdown simulation
            const userProfile = document.getElementById('user-profile');
            userProfile.addEventListener('click', function() {
                alert('User profile menu would open here');
            });
            
            // Table row click
            const tableRows = document.querySelectorAll('tbody tr');
            tableRows.forEach(row => {
                row.addEventListener('click', function(e) {
                    if (!e.target.closest('button')) {
                        const orderId = this.cells[0].textContent;
                        alert(`Viewing details for order ${orderId}`);
                    }
                });
            });
            
            // Quick action buttons
            const quickActionBtns = document.querySelectorAll('.btn');
            quickActionBtns.forEach(btn => {
                btn.addEventListener('click', function(e) {
                    if (this.textContent.includes('Add New Product')) {
                        alert('Add New Product form would open');
                    } else if (this.textContent.includes('Invite User')) {
                        alert('Invite User modal would open');
                    } else if (this.textContent.includes('Generate Report')) {
                        alert('Report generation started...');
                    } else if (this.textContent.includes('System Settings')) {
                        alert('Redirecting to system settings');
                    }
                });
            });
            
            // Update current time in footer every minute
            function updateFooterTime() {
                const now = new Date();
                const options = { 
                    weekday: 'long', 
                    hour: '2-digit', 
                    minute: '2-digit',
                    hour12: false
                };
                const timeString = now.toLocaleTimeString('en-US', options);
                
                const footer = document.querySelector('.footer p');
                if (footer) {
                    footer.innerHTML = footer.innerHTML.replace(/Last updated:.*?(\|)/, `Last updated: ${timeString} $1`);
                }
            }
            
            // Update time initially and every minute
            updateFooterTime();
            setInterval(updateFooterTime, 60000);
        });
    </script>
</body>
</html>