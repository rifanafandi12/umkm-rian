<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Dashboard - Tokoh Kue Rian</title>

  <!-- Bootstrap 5 CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
  <!-- Font Awesome 6 -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

  <style>
    :root {
      --primary-brown: #8B4513;
      --secondary-brown: #D2691E;
      --accent-color: #FF6B6B;
      --cream-color: #FFF8F0;
      --light-cream: #FFFDF8;
      --dark-brown: #5D4037;
    }

    body {
      background-color: var(--light-cream);
      overflow-x: hidden;
      font-family: 'Poppins', 'Segoe UI', sans-serif;
    }

    /* Sidebar */
    .sidebar {
      background: linear-gradient(180deg, var(--primary-brown), var(--dark-brown));
      color: var(--cream-color);
      min-height: 100vh;
      box-shadow: 0 0 20px rgba(139, 69, 19, 0.3);
      transition: all 0.3s ease;
      position: relative;
      overflow: hidden;
    }

    .sidebar::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" fill="rgba(255,255,255,0.05)"><circle cx="20" cy="20" r="2"/><circle cx="80" cy="40" r="1.5"/><circle cx="40" cy="80" r="1"/></svg>');
    }

    .sidebar .nav-link {
      color: rgba(255, 248, 240, 0.85);
      padding: 16px 20px;
      margin: 8px 15px;
      border-radius: 12px;
      transition: all 0.3s ease;
      font-weight: 500;
      position: relative;
      overflow: hidden;
    }

    .sidebar .nav-link::before {
      content: '';
      position: absolute;
      top: 0;
      left: -100%;
      width: 100%;
      height: 100%;
      background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.1), transparent);
      transition: left 0.5s;
    }

    .sidebar .nav-link:hover::before {
      left: 100%;
    }

    .sidebar .nav-link:hover,
    .sidebar .nav-link.active {
      background: linear-gradient(135deg, var(--secondary-brown), var(--accent-color));
      color: white;
      transform: translateX(8px);
      box-shadow: 0 5px 15px rgba(210, 105, 30, 0.3);
    }

    .sidebar .nav-link i {
      width: 24px;
      text-align: center;
      margin-right: 12px;
      font-size: 1.1rem;
    }

    .sidebar-brand {
      background: rgba(255, 255, 255, 0.1);
      border-radius: 15px;
      margin: 15px;
      padding: 20px;
      text-align: center;
      border: 1px solid rgba(255, 255, 255, 0.2);
    }

    /* Header */
    .navbar {
      background: linear-gradient(135deg, var(--primary-brown), var(--secondary-brown));
      box-shadow: 0 2px 15px rgba(139, 69, 19, 0.2);
      padding: 15px 0;
    }

    .navbar-brand {
      font-weight: 700;
      color: white !important;
      font-size: 1.4rem;
    }

    /* Main Content */
    .main-content {
      transition: margin-left 0.3s ease;
      background-color: var(--light-cream);
    }

    /* Toggle button styling */
    .btn-toggle {
      background: transparent;
      border: 2px solid rgba(255, 255, 255, 0.3);
      color: white;
      font-size: 1.25rem;
      border-radius: 10px;
      padding: 8px 12px;
      transition: all 0.3s ease;
    }

    .btn-toggle:hover {
      background: rgba(255, 255, 255, 0.1);
      border-color: rgba(255, 255, 255, 0.5);
    }

    /* Responsive adjustments */
    @media (max-width: 767.98px) {
      .sidebar {
        position: fixed;
        top: 0;
        left: -280px;
        z-index: 1050;
        width: 280px;
        height: 100vh;
      }

      .sidebar.show {
        left: 0;
      }

      .main-content {
        margin-left: 0 !important;
      }
    }

    @media (min-width: 768px) {
      .sidebar {
        width: 280px;
        position: fixed;
        top: 0;
        left: 0;
        z-index: 1000;
      }

      .main-content {
        margin-left: 280px;
      }
    }
  </style>
</head>

<body>
  <!-- Top Navigation -->
  <nav class="navbar navbar-expand-lg">
    <div class="container-fluid">
      <button class="btn btn-toggle d-lg-none me-3" id="sidebarToggle">
        <i class="fas fa-bars"></i>
      </button>
      <a class="navbar-brand" href="<?= base_url('admin'); ?>">
        <i class="fas fa-birthday-cake me-2"></i>Tokoh Kue Rian
      </a>

      <div class="navbar-nav ms-auto">
        <div class="nav-item dropdown">
          <a class="nav-link text-white" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown">
            <i class="fas fa-user-circle fa-lg me-2"></i>
            <?= $this->session->userdata('nama') ?? 'Admin' ?>
          </a>
          <ul class="dropdown-menu dropdown-menu-end">
            <li><a class="dropdown-item" href="<?= base_url('admin'); ?>"><i class="fas fa-tachometer-alt me-2"></i>Dashboard</a></li>
            <li>
              <hr class="dropdown-divider">
            </li>
            <li><a class="dropdown-item" href="<?= base_url('auth/logout'); ?>"><i class="fas fa-sign-out-alt me-2"></i>Logout</a></li>
          </ul>
        </div>
      </div>
    </div>
  </nav>

  <!-- Sidebar -->
  <nav class="sidebar" id="sidebar">
    <div class="sidebar-brand">
      <h5 class="text-white mb-2"><i class="fas fa-crown me-2"></i>Admin Panel</h5>
      <small class="opacity-75">Tokoh Kue Rian</small>
    </div>
    <ul class="nav flex-column px-3 mt-3">
      <li class="nav-item">
        <a class="nav-link <?= activate_menu('admin'); ?>" href="<?= base_url('admin'); ?>">
          <i class="fas fa-gauge-high"></i> Dashboard
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link <?= activate_menu('admin', 'manajement_user'); ?>" href="<?= base_url('admin/manajement_user'); ?>">
          <i class="fas fa-users-gear"></i> Manajemen User
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link <?= activate_menu('barang'); ?>" href="<?= base_url('barang'); ?>">
          <i class="fas fa-cookie-bite"></i> Manajemen Kue
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link <?= activate_menu('pembelian'); ?>" href="<?= base_url('pembelian'); ?>">
          <i class="fas fa-receipt"></i> Manajemen Pesanan
        </a>
      </li>
      <li class="nav-item mt-4">
        <a class="nav-link text-warning" href="<?= base_url('home'); ?>" target="_blank">
          <i class="fas fa-external-link-alt me-2"></i> Lihat Toko
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-danger" href="<?= base_url('auth/logout'); ?>">
          <i class="fas fa-right-from-bracket me-2"></i> Logout
        </a>
      </li>
    </ul>

    <!-- Sidebar Footer -->
    <div class="position-absolute bottom-0 start-0 end-0 p-3 text-center opacity-75">
      <small>v1.0 • Tokoh Kue Rian</small>
    </div>
  </nav>

  <!-- Main Content -->
  <main class="main-content">