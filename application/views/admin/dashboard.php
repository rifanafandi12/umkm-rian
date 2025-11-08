<style>
  .dashboard-card {
    border-radius: 20px;
    border: none;
    box-shadow: 0 8px 25px rgba(139, 69, 19, 0.1);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    overflow: hidden;
  }
  .dashboard-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 4px;
    background: linear-gradient(90deg, var(--secondary-brown), var(--accent-color));
  }
  .dashboard-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 15px 35px rgba(139, 69, 19, 0.15);
  }
  
  .stat-card {
    color: white;
    padding: 30px;
    border-radius: 20px;
    position: relative;
    overflow: hidden;
  }
  .stat-card::before {
    content: '';
    position: absolute;
    top: -50%;
    right: -50%;
    width: 100%;
    height: 200%;
    background: rgba(255, 255, 255, 0.1);
    transform: rotate(45deg);
  }
  .stat-icon {
    font-size: 2.8rem;
    opacity: 0.9;
    text-shadow: 2px 2px 4px rgba(0,0,0,0.2);
  }
  .stat-number {
    font-size: 2.2rem;
    font-weight: 800;
    margin: 15px 0;
    text-shadow: 2px 2px 4px rgba(0,0,0,0.2);
  }
  .stat-title {
    font-size: 0.95rem;
    opacity: 0.95;
    font-weight: 500;
  }
  
  .recent-item {
    border-left: 4px solid var(--secondary-brown);
    padding-left: 20px;
    margin-bottom: 20px;
    transition: all 0.3s ease;
    border-radius: 0 10px 10px 0;
  }
  .recent-item:hover {
    background: var(--cream-color);
    margin-left: -10px;
    margin-right: -10px;
    padding-left: 30px;
    padding-right: 10px;
  }
  
  .chart-container {
    background: white;
    border-radius: 20px;
    padding: 25px;
    box-shadow: 0 8px 25px rgba(139, 69, 19, 0.1);
    border: 1px solid var(--cream-color);
  }
  
  .welcome-banner {
    background: linear-gradient(135deg, var(--primary-brown) 0%, var(--secondary-brown) 100%);
    color: white;
    padding: 40px;
    border-radius: 20px;
    margin-bottom: 30px;
    position: relative;
    overflow: hidden;
  }
  .welcome-banner::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" fill="rgba(255,255,255,0.1)"><path d="M30,30 Q50,10 70,30 T100,50"/></svg>');
  }
  
  .quick-action {
    background: white;
    border-radius: 15px;
    padding: 25px;
    text-align: center;
    box-shadow: 0 5px 20px rgba(139, 69, 19, 0.08);
    transition: all 0.3s ease;
    border: 2px solid transparent;
    position: relative;
    overflow: hidden;
  }
  .quick-action::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 4px;
    background: linear-gradient(90deg, var(--secondary-brown), var(--accent-color));
  }
  .quick-action:hover {
    border-color: var(--secondary-brown);
    transform: translateY(-5px) scale(1.02);
    box-shadow: 0 10px 30px rgba(139, 69, 19, 0.15);
  }
  .action-icon {
    font-size: 2.5rem;
    color: var(--secondary-brown);
    margin-bottom: 15px;
    transition: transform 0.3s ease;
  }
  .quick-action:hover .action-icon {
    transform: scale(1.1);
  }
  
  .card-header {
    background: linear-gradient(135deg, var(--primary-brown), var(--secondary-brown)) !important;
    border: none !important;
    padding: 20px !important;
  }
  
  .text-brown { color: var(--primary-brown); }
  .text-accent { color: var(--accent-color); }
</style>

<div class="container-fluid p-4">
  <!-- Welcome Banner -->
  <div class="welcome-banner">
    <div class="row align-items-center position-relative">
      <div class="col-md-8">
        <h2 class="fw-bold mb-3"><i class="fas fa-crown me-3"></i>Dashboard Admin</h2>
        <p class="mb-2 fs-5">Selamat datang di Sistem Manajemen Waroeng Kue Ucup</p>
        <small class="opacity-85">
          <i class="fas fa-user me-2"></i><?= $this->session->userdata('nama') ?? 'Admin' ?> • 
          Terakhir login: <?= date('d F Y H:i') ?>
        </small>
      </div>
      <div class="col-md-4 text-end">
        <div class="bg-white text-brown rounded-3 p-3 d-inline-block shadow">
          <i class="fas fa-calendar-check me-2 text-accent"></i>
          <strong class="fs-5"><?= date('l, d F Y') ?></strong>
        </div>
      </div>
    </div>
  </div>

  <!-- Quick Actions -->
  <div class="row mb-5">
    <div class="col-12">
      <h4 class="mb-4 text-brown fw-bold">
        <i class="fas fa-bolt me-2 text-accent"></i>Quick Actions
      </h4>
    </div>
    <div class="col-xl-3 col-md-6 mb-4">
      <a href="<?= base_url('barang/tambah') ?>" class="text-decoration-none">
        <div class="quick-action">
          <div class="action-icon">
            <i class="fas fa-cookie-bite"></i>
          </div>
          <h6 class="fw-bold text-brown">Tambah Kue</h6>
          <small class="text-muted">Tambah produk kue baru</small>
        </div>
      </a>
    </div>
    <div class="col-xl-3 col-md-6 mb-4">
      <a href="<?= base_url('barang') ?>" class="text-decoration-none">
        <div class="quick-action">
          <div class="action-icon">
            <i class="fas fa-cookie"></i>
          </div>
          <h6 class="fw-bold text-brown">Kelola Kue</h6>
          <small class="text-muted">Lihat semua produk kue</small>
        </div>
      </a>
    </div>
    <div class="col-xl-3 col-md-6 mb-4">
      <a href="<?= base_url('pembelian') ?>" class="text-decoration-none">
        <div class="quick-action">
          <div class="action-icon">
            <i class="fas fa-receipt"></i>
          </div>
          <h6 class="fw-bold text-brown">Pesanan</h6>
          <small class="text-muted">Lihat semua pesanan</small>
        </div>
      </a>
    </div>
    <div class="col-xl-3 col-md-6 mb-4">
      <a href="<?= base_url('admin/manajement_user') ?>" class="text-decoration-none">
        <div class="quick-action">
          <div class="action-icon">
            <i class="fas fa-users"></i>
          </div>
          <h6 class="fw-bold text-brown">Kelola User</h6>
          <small class="text-muted">Manajemen pengguna</small>
        </div>
      </a>
    </div>
  </div>

  <!-- Statistics Cards -->
  <div class="row mb-5">
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="stat-card" style="background: linear-gradient(135deg, #8B4513 0%, #A0522D 100%);">
        <div class="d-flex justify-content-between align-items-center position-relative">
          <div>
            <div class="stat-number"><?= $stats['total_users'] ?></div>
            <div class="stat-title">TOTAL PELANGGAN</div>
          </div>
          <div class="stat-icon">
            <i class="fas fa-users"></i>
          </div>
        </div>
      </div>
    </div>
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="stat-card" style="background: linear-gradient(135deg, #D2691E 0%, #CD853F 100%);">
        <div class="d-flex justify-content-between align-items-center position-relative">
          <div>
            <div class="stat-number"><?= $stats['total_barang'] ?></div>
            <div class="stat-title">TOTAL KUE</div>
          </div>
          <div class="stat-icon">
            <i class="fas fa-cookie-bite"></i>
          </div>
        </div>
      </div>
    </div>
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="stat-card" style="background: linear-gradient(135deg, #FF6B6B 0%, #FF8E8E 100%);">
        <div class="d-flex justify-content-between align-items-center position-relative">
          <div>
            <div class="stat-number"><?= $stats['total_pembelian'] ?></div>
            <div class="stat-title">TOTAL PESANAN</div>
          </div>
          <div class="stat-icon">
            <i class="fas fa-shopping-bag"></i>
          </div>
        </div>
      </div>
    </div>
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="stat-card" style="background: linear-gradient(135deg, #27AE60 0%, #2ECC71 100%);">
        <div class="d-flex justify-content-between align-items-center position-relative">
          <div>
            <div class="stat-number">Rp <?= number_format($stats['total_pendapatan'], 0, ',', '.') ?></div>
            <div class="stat-title">TOTAL PENDAPATAN</div>
          </div>
          <div class="stat-icon">
            <i class="fas fa-money-bill-wave"></i>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Charts and Recent Activity -->
  <div class="row">
    <!-- Chart Section -->
    <div class="col-xl-8 col-lg-7 mb-4">
      <div class="chart-container">
        <h5 class="fw-bold text-brown mb-4">
          <i class="fas fa-chart-line me-2 text-accent"></i>Statistik Penjualan 6 Bulan Terakhir
        </h5>
        <canvas id="salesChart" height="250"></canvas>
      </div>
    </div>

    <!-- Recent Users -->
    <div class="col-xl-4 col-lg-5 mb-4">
      <div class="dashboard-card">
        <div class="card-header text-white">
          <h6 class="mb-0 fw-bold"><i class="fas fa-user-plus me-2"></i>Pelanggan Terbaru</h6>
        </div>
        <div class="card-body">
          <?php if (empty($users_terbaru)): ?>
            <div class="text-center py-4">
              <i class="fas fa-users-slash fa-2x text-muted mb-3"></i>
              <p class="text-muted">Belum ada pelanggan terdaftar</p>
            </div>
          <?php else: ?>
            <?php foreach ($users_terbaru as $user): ?>
              <div class="recent-item">
                <div class="d-flex justify-content-between align-items-center">
                  <div>
                    <strong class="text-brown"><?= htmlspecialchars($user['nama'] ?? $user['username']) ?></strong>
                    <br>
                    <small class="text-muted">
                      <i class="fas fa-at me-1"></i>@<?= $user['username'] ?>
                    </small>
                  </div>
                  <span class="badge bakery-badge">Baru</span>
                </div>
              </div>
            <?php endforeach; ?>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </div>

  <!-- Recent Items -->
  <div class="row">
    <!-- Recent Barang -->
    <div class="col-xl-6 col-lg-6 mb-4">
      <div class="dashboard-card">
        <div class="card-header text-white">
          <h6 class="mb-0 fw-bold"><i class="fas fa-cookie me-2"></i>Kue Terbaru</h6>
        </div>
        <div class="card-body">
          <?php if (empty($barang_terbaru)): ?>
            <div class="text-center py-4">
              <i class="fas fa-cookie-bite fa-2x text-muted mb-3"></i>
              <p class="text-muted">Belum ada kue terdaftar</p>
            </div>
          <?php else: ?>
            <?php foreach ($barang_terbaru as $barang): ?>
              <div class="recent-item">
                <div class="d-flex justify-content-between align-items-center">
                  <div>
                    <strong class="text-brown"><?= htmlspecialchars($barang['nama_barang']) ?></strong>
                    <br>
                    <small class="text-muted">
                      <i class="fas fa-tag me-1"></i><?= $barang['jenis'] ?> • 
                      <i class="fas fa-money-bill me-1"></i>Rp <?= number_format($barang['harga_barang'], 0, ',', '.') ?>
                    </small>
                  </div>
                  <span class="badge bg-brown"><?= $barang['kode_barang'] ?></span>
                </div>
              </div>
            <?php endforeach; ?>
          <?php endif; ?>
        </div>
      </div>
    </div>

    <!-- Recent Pembelian -->
    <div class="col-xl-6 col-lg-6 mb-4">
      <div class="dashboard-card">
        <div class="card-header text-white">
          <h6 class="mb-0 fw-bold"><i class="fas fa-receipt me-2"></i>Pesanan Terbaru</h6>
        </div>
        <div class="card-body">
          <?php if (empty($pembelian_terbaru)): ?>
            <div class="text-center py-4">
              <i class="fas fa-shopping-bag fa-2x text-muted mb-3"></i>
              <p class="text-muted">Belum ada pesanan</p>
            </div>
          <?php else: ?>
            <?php foreach ($pembelian_terbaru as $pembelian): ?>
              <div class="recent-item">
                <div class="d-flex justify-content-between align-items-center">
                  <div>
                    <strong class="text-brown"><?= htmlspecialchars($pembelian['nama_barang']) ?></strong>
                    <br>
                    <small class="text-muted">
                      <i class="fas fa-user me-1"></i><?= $pembelian['nama'] ?> • 
                      <i class="fas fa-calendar me-1"></i><?= date('d/m/Y', strtotime($pembelian['tgl_pembelian'])) ?>
                    </small>
                  </div>
                  <span class="badge bg-accent">Rp <?= number_format($pembelian['total_harga'], 0, ',', '.') ?></span>
                </div>
              </div>
            <?php endforeach; ?>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Additional Styles -->
<style>
  .bakery-badge {
    background: linear-gradient(135deg, #FF6B6B, #FF8E8E);
    border: none;
    border-radius: 12px;
    padding: 6px 12px;
    font-weight: 600;
  }
  .bg-brown {
    background: linear-gradient(135deg, #8B4513, #A0522D) !important;
  }
  .bg-accent {
    background: linear-gradient(135deg, #FF6B6B, #FF8E8E) !important;
  }
</style>

<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
  // Sales Chart
  const ctx = document.getElementById('salesChart').getContext('2d');
  const salesChart = new Chart(ctx, {
    type: 'line',
    data: {
      labels: <?= json_encode($chart_data['labels']) ?>,
      datasets: [{
        label: 'Penjualan',
        data: <?= json_encode($chart_data['data']) ?>,
        borderColor: '#D2691E',
        backgroundColor: 'rgba(210, 105, 30, 0.1)',
        borderWidth: 3,
        fill: true,
        tension: 0.4,
        pointBackgroundColor: '#FF6B6B',
        pointBorderColor: '#FFFFFF',
        pointBorderWidth: 2,
        pointRadius: 6,
        pointHoverRadius: 8
      }]
    },
    options: {
      responsive: true,
      plugins: {
        legend: {
          display: false
        },
        tooltip: {
          mode: 'index',
          intersect: false,
          backgroundColor: 'rgba(139, 69, 19, 0.9)',
          titleColor: '#FFFFFF',
          bodyColor: '#FFFFFF'
        }
      },
      scales: {
        y: {
          beginAtZero: true,
          grid: {
            drawBorder: false,
            color: 'rgba(139, 69, 19, 0.1)'
          },
          ticks: {
            color: '#8B4513'
          }
        },
        x: {
          grid: {
            display: false
          },
          ticks: {
            color: '#8B4513'
          }
        }
      }
    }
  });
});
</script>

<script>
  // Sidebar toggle functionality
  document.addEventListener('DOMContentLoaded', function() {
    const sidebar = document.getElementById('sidebar');
    const toggleBtn = document.getElementById('sidebarToggle');

    if (toggleBtn) {
      toggleBtn.addEventListener('click', function() {
        sidebar.classList.toggle('show');
      });
    }

    // Close sidebar when clicking outside on mobile
    document.addEventListener('click', function(e) {
      if (window.innerWidth < 768) {
        const isClickInsideSidebar = sidebar.contains(e.target) || toggleBtn.contains(e.target);
        if (!isClickInsideSidebar && sidebar.classList.contains('show')) {
          sidebar.classList.remove('show');
        }
      }
    });

    // Add animation to cards on load
    const cards = document.querySelectorAll('.dashboard-card, .quick-action');
    cards.forEach((card, index) => {
      card.style.opacity = '0';
      card.style.transform = 'translateY(20px)';
      
      setTimeout(() => {
        card.style.transition = 'all 0.5s ease';
        card.style.opacity = '1';
        card.style.transform = 'translateY(0)';
      }, index * 100);
    });
  });
</script>