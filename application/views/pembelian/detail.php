<style>
  .bakery-detail-card {
    border-radius: 20px;
    box-shadow: 0 10px 30px rgba(139, 69, 19, 0.15);
    border: none;
    overflow: hidden;
    margin-bottom: 30px;
  }
  .bakery-detail-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 4px;
    background: linear-gradient(90deg, #D2691E, #FF6B6B);
  }
  .detail-header {
    background: linear-gradient(135deg, #8B4513 0%, #D2691E 100%);
    color: white;
    padding: 30px;
    position: relative;
    overflow: hidden;
  }
  .detail-header::before {
    content: '';
    position: absolute;
    top: -50%;
    right: -50%;
    width: 100%;
    height: 200%;
    background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" fill="rgba(255,255,255,0.1)"><path d="M30,30 Q50,10 70,30 T100,50"/></svg>');
  }
  .item-image {
    width: 100px;
    height: 100px;
    object-fit: cover;
    border-radius: 15px;
    border: 4px solid #FFF8F0;
    box-shadow: 0 5px 15px rgba(139, 69, 19, 0.2);
  }
  .text-brown { color: #8B4513; }
  .text-accent { color: #FF6B6B; }
  .bg-cream { background-color: #FFF8F0; }
  .bakery-badge {
    background: linear-gradient(135deg, #FF6B6B, #FF8E8E);
    border: none;
    border-radius: 15px;
    padding: 8px 15px;
    font-weight: 600;
  }
</style>

<div class="container-fluid p-4">
  <div class="row justify-content-center">
    <div class="col-lg-10">
      <!-- Main Card -->
      <div class="card bakery-detail-card">
        <!-- Header -->
        <div class="detail-header text-center position-relative">
          <div class="header-icon mb-3">
            <i class="fas fa-receipt fa-3x text-white"></i>
          </div>
          <h2 class="fw-bold mb-2">
            <i class="fas fa-file-invoice me-2"></i>Detail Pesanan Kue
          </h2>
          <p class="mb-0 opacity-75">
            <i class="fas fa-hashtag me-1"></i>Kode: <?= $pembelian['kode_pembelian'] ?>
          </p>
        </div>
        
        <!-- Body -->
        <div class="card-body p-4">
          <!-- Transaction Overview -->
          <div class="row mb-5">
            <div class="col-md-6 mb-4">
              <div class="info-section">
                <h4 class="fw-bold text-brown mb-3">
                  <i class="fas fa-info-circle me-2"></i>Informasi Transaksi
                </h4>
                <div class="info-card bg-cream p-4 rounded-3">
                  <div class="info-item d-flex justify-content-between align-items-center mb-3 pb-3 border-bottom">
                    <span class="fw-semibold text-brown">
                      <i class="fas fa-calendar-day me-2"></i>Tanggal
                    </span>
                    <span class="fw-bold"><?= date('d F Y', strtotime($pembelian['tgl_pembelian'])) ?></span>
                  </div>
                  <div class="info-item d-flex justify-content-between align-items-center mb-3 pb-3 border-bottom">
                    <span class="fw-semibold text-brown">
                      <i class="fas fa-clock me-2"></i>Waktu
                    </span>
                    <span class="fw-bold"><?= date('H:i', strtotime($pembelian['tgl_pembelian'])) ?> WIB</span>
                  </div>
                  <div class="info-item d-flex justify-content-between align-items-center mb-3 pb-3 border-bottom">
                    <span class="fw-semibold text-brown">
                      <i class="fas fa-hashtag me-2"></i>Kode Pesanan
                    </span>
                    <code class="fw-bold"><?= $pembelian['kode_pembelian'] ?></code>
                  </div>
                  <div class="info-item d-flex justify-content-between align-items-center">
                    <span class="fw-semibold text-brown">
                      <i class="fas fa-check-circle me-2"></i>Status
                    </span>
                    <span class="badge bakery-badge">
                      <i class="fas fa-check me-1"></i>Pesanan Selesai
                    </span>
                  </div>
                </div>
              </div>
            </div>
            
            <div class="col-md-6 mb-4">
              <div class="info-section">
                <h4 class="fw-bold text-brown mb-3">
                  <i class="fas fa-user me-2"></i>Informasi Pembeli
                </h4>
                <div class="info-card bg-cream p-4 rounded-3">
                  <div class="info-item d-flex justify-content-between align-items-center mb-3 pb-3 border-bottom">
                    <span class="fw-semibold text-brown">
                      <i class="fas fa-user-tag me-2"></i>Nama
                    </span>
                    <span class="fw-bold"><?= htmlspecialchars($pembelian['nama_user']) ?></span>
                  </div>
                  <?php if (!empty($pembelian['email'])): ?>
                  <div class="info-item d-flex justify-content-between align-items-center mb-3 pb-3 border-bottom">
                    <span class="fw-semibold text-brown">
                      <i class="fas fa-envelope me-2"></i>Email
                    </span>
                    <span class="fw-bold"><?= htmlspecialchars($pembelian['email']) ?></span>
                  </div>
                  <?php endif; ?>
                  <?php if (!empty($pembelian['no_telepon'])): ?>
                  <div class="info-item d-flex justify-content-between align-items-center">
                    <span class="fw-semibold text-brown">
                      <i class="fas fa-phone me-2"></i>Telepon
                    </span>
                    <span class="fw-bold"><?= htmlspecialchars($pembelian['no_telepon']) ?></span>
                  </div>
                  <?php endif; ?>
                </div>
              </div>
            </div>
          </div>

          <!-- Order Details -->
          <div class="order-details">
            <h4 class="fw-bold text-brown mb-4">
              <i class="fas fa-cookie-bite me-2"></i>Detail Kue yang Dipesan
            </h4>
            
            <div class="order-item-card">
              <div class="card bakery-card">
                <div class="card-body p-4">
                  <div class="row align-items-center">
                    <!-- Product Image -->
                    <div class="col-md-3 text-center">
                      <div class="position-relative">
                        <?php if (!empty($pembelian['gambar_barang'])): ?>
                          <img src="<?= base_url('uploads/barang/' . $pembelian['gambar_barang']) ?>" 
                               class="item-image" 
                               alt="<?= htmlspecialchars($pembelian['nama_barang']) ?>">
                        <?php else: ?>
                          <div class="item-image bg-cream d-flex align-items-center justify-content-center mx-auto">
                            <i class="fas fa-birthday-cake fa-2x text-brown"></i>
                          </div>
                        <?php endif; ?>
                        <span class="position-absolute top-0 start-100 translate-middle badge bakery-badge">
                          <?= $pembelian['jumlah_barang'] ?>
                        </span>
                      </div>
                    </div>
                    
                    <!-- Product Info -->
                    <div class="col-md-5">
                      <h5 class="fw-bold text-brown mb-2"><?= htmlspecialchars($pembelian['nama_barang']) ?></h5>
                      <?php if (!empty($pembelian['jenis'])): ?>
                        <p class="text-muted mb-2">
                          <i class="fas fa-tag me-2"></i>Jenis: <?= $pembelian['jenis'] ?>
                        </p>
                      <?php endif; ?>
                      <?php if (!empty($pembelian['deskripsi'])): ?>
                        <p class="text-muted mb-0 small">
                          <i class="fas fa-align-left me-2"></i><?= $pembelian['deskripsi'] ?>
                        </p>
                      <?php endif; ?>
                    </div>
                    
                    <!-- Price Info -->
                    <div class="col-md-4">
                      <div class="price-info text-center">
                        <div class="price-item mb-3">
                          <span class="text-muted d-block">Harga Satuan</span>
                          <span class="fw-bold text-brown fs-5">
                            Rp <?= number_format($pembelian['harga_barang'], 0, ',', '.') ?>
                          </span>
                        </div>
                        <div class="price-item">
                          <span class="text-muted d-block">Subtotal</span>
                          <span class="fw-bold text-accent fs-4">
                            Rp <?= number_format($pembelian['total_harga'], 0, ',', '.') ?>
                          </span>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- Order Summary -->
          <div class="order-summary mt-5">
            <div class="row justify-content-end">
              <div class="col-md-6">
                <div class="summary-card">
                  <div class="card bakery-summary-card">
                    <div class="card-header bg-brown text-white">
                      <h5 class="mb-0">
                        <i class="fas fa-receipt me-2"></i>Ringkasan Pembayaran
                      </h5>
                    </div>
                    <div class="card-body">
                      <div class="summary-item d-flex justify-content-between mb-3">
                        <span class="text-muted">Subtotal Kue:</span>
                        <span class="fw-bold">Rp <?= number_format($pembelian['total_harga'], 0, ',', '.') ?></span>
                      </div>
                      <div class="summary-item d-flex justify-content-between mb-3">
                        <span class="text-muted">Biaya Pengiriman:</span>
                        <span class="fw-bold text-success">Gratis</span>
                      </div>
                      <hr>
                      <div class="summary-total d-flex justify-content-between align-items-center">
                        <span class="fs-5 fw-bold text-brown">Total Pembayaran:</span>
                        <span class="fs-3 fw-bold text-accent">
                          Rp <?= number_format($pembelian['total_harga'], 0, ',', '.') ?>
                        </span>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- Action Buttons -->
          <div class="action-buttons mt-5 pt-4 border-top">
            <div class="d-flex justify-content-between align-items-center">
              <a href="<?= $this->session->userdata('role') == 'admin' ? base_url('pembelian') : base_url('pembelian/riwayatPembelian') ?>" 
                 class="btn btn-bakery-outline">
                <i class="fas fa-arrow-left me-2"></i>Kembali ke Riwayat
              </a>
              
              <div class="action-group">
                <a href="<?= base_url('home') ?>" class="btn btn-bakery-secondary me-2">
                  <i class="fas fa-utensils me-2"></i>Pesan Lagi
                </a>
                
                <?php if ($this->session->userdata('role') == 'admin'): ?>
                  <button onclick="hapusPembelian('<?= $pembelian['kode_pembelian'] ?>')" 
                          class="btn btn-bakery-danger">
                    <i class="fas fa-trash me-2"></i>Hapus Transaksi
                  </button>
                <?php endif; ?>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Additional Styles -->
<style>
  .bakery-title {
    background: linear-gradient(135deg, #8B4513, #FF6B6B);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
  }

  .btn-bakery-outline {
    border: 2px solid #D2691E;
    color: #D2691E;
    background: transparent;
    border-radius: 15px;
    font-weight: 600;
    padding: 12px 25px;
    transition: all 0.3s;
  }

  .btn-bakery-outline:hover {
    background: #D2691E;
    color: white;
    transform: translateY(-2px);
  }

  .btn-bakery-secondary {
    background: linear-gradient(135deg, #A0522D, #CD853F);
    border: none;
    color: white;
    border-radius: 15px;
    font-weight: 600;
    padding: 12px 25px;
    transition: all 0.3s;
  }

  .btn-bakery-secondary:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(160, 82, 45, 0.3);
  }

  .btn-bakery-danger {
    background: linear-gradient(135deg, #FF6B6B, #FF8E8E);
    border: none;
    color: white;
    border-radius: 15px;
    font-weight: 600;
    padding: 12px 25px;
    transition: all 0.3s;
  }

  .btn-bakery-danger:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(255, 107, 107, 0.3);
  }

  .bakery-card {
    border: none;
    border-radius: 15px;
    box-shadow: 0 5px 20px rgba(139, 69, 19, 0.1);
    transition: all 0.3s;
  }

  .bakery-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 25px rgba(139, 69, 19, 0.15);
  }

  .bakery-summary-card {
    border: none;
    border-radius: 15px;
    box-shadow: 0 5px 20px rgba(139, 69, 19, 0.1);
    overflow: hidden;
  }

  .info-card {
    border: 2px solid #FFF8F0;
  }

  .header-icon {
    opacity: 0.9;
  }

  @media (max-width: 768px) {
    .action-buttons .d-flex {
      flex-direction: column;
      gap: 15px;
    }
    
    .action-group {
      display: flex;
      flex-direction: column;
      gap: 10px;
      width: 100%;
    }
    
    .action-group .btn {
      width: 100%;
    }
    
    .order-item-card .row > div {
      margin-bottom: 20px;
      text-align: center;
    }
    
    .price-info {
      border-top: 2px dashed #FFF8F0;
      padding-top: 20px;
    }
  }
</style>

<?php if ($this->session->userdata('role') == 'admin'): ?>
<script>
function hapusPembelian(kodePembelian) {
  Swal.fire({
    title: 'Hapus Transaksi?',
    text: "Transaksi yang dihapus tidak dapat dikembalikan!",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#FF6B6B',
    cancelButtonColor: '#8B4513',
    confirmButtonText: 'Ya, Hapus!',
    cancelButtonText: 'Batal',
    background: '#FFF8F0',
    color: '#8B4513'
  }).then((result) => {
    if (result.isConfirmed) {
      window.location.href = '<?= base_url('pembelian/hapus/') ?>' + kodePembelian;
    }
  });
}
</script>
<?php endif; ?>

<script>
  $(document).ready(function() {
    // Add animation to cards
    $('.bakery-detail-card').hide().fadeIn(800);
    
    // Add hover effects
    $('.info-card, .order-item-card').hover(
      function() {
        $(this).addClass('shadow');
      },
      function() {
        $(this).removeClass('shadow');
      }
    );
  });
</script>