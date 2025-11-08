<style>
  .bakery-card {
    border-radius: 20px;
    box-shadow: 0 8px 25px rgba(139, 69, 19, 0.1);
    border: none;
    margin-bottom: 25px;
    overflow: hidden;
    background: white;
  }
  .bakery-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 4px;
    background: linear-gradient(90deg, #D2691E, #FF6B6B);
  }
  .transaction-header {
    background: linear-gradient(135deg, #8B4513 0%, #D2691E 100%);
    color: white;
    padding: 25px;
    position: relative;
    overflow: hidden;
  }
  .transaction-header::before {
    content: '';
    position: absolute;
    top: -50%;
    right: -50%;
    width: 100%;
    height: 200%;
    background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" fill="rgba(255,255,255,0.1)"><path d="M30,30 Q50,10 70,30 T100,50"/></svg>');
  }
  .item-image {
    width: 60px;
    height: 60px;
    object-fit: cover;
    border-radius: 12px;
    border: 3px solid #FFF8F0;
    box-shadow: 0 3px 10px rgba(139, 69, 19, 0.1);
  }
  .total-amount {
    font-size: 1.3rem;
    font-weight: 700;
    color: #FF6B6B;
    text-shadow: 1px 1px 2px rgba(0,0,0,0.1);
  }
  .bakery-badge {
    background: linear-gradient(135deg, #FF6B6B, #FF8E8E);
    border: none;
    border-radius: 15px;
    padding: 8px 15px;
    font-weight: 600;
  }
  .empty-state {
    background: linear-gradient(135deg, #FFF8F0, #FFFFFF);
    border-radius: 20px;
    padding: 60px 40px;
    border: 2px dashed #D2691E;
  }
  .text-brown { color: #8B4513; }
  .text-accent { color: #FF6B6B; }
  .bg-cream { background-color: #FFF8F0; }
</style>

<div class="container-fluid p-4">
  <!-- Header Section -->
  <div class="text-center mb-5">
    <div class="bakery-icon mb-3">
      <i class="fas fa-receipt fa-3x text-brown"></i>
    </div>
    <h2 class="fw-bold bakery-title mb-2">
      <i class="fas fa-history me-2"></i>Riwayat Pesanan Kue
    </h2>
    <p class="text-muted">Lihat semua pesanan manis yang pernah Anda beli</p>
  </div>

  <!-- Stats Overview -->
  <div class="row mb-4 justify-content-center">
    <div class="col-md-4">
      <div class="card bakery-card text-center">
        <div class="card-body">
          <i class="fas fa-shopping-basket fa-2x text-brown mb-3"></i>
          <h4 class="fw-bold text-accent"><?= count($grouped_pembelians) ?></h4>
          <p class="text-muted mb-0">Total Transaksi</p>
        </div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="card bakery-card text-center">
        <div class="card-body">
          <i class="fas fa-cookie-bite fa-2x text-brown mb-3"></i>
          <h4 class="fw-bold text-accent">
            <?php
            $total_items = 0;
            if (!empty($grouped_pembelians)) {
              foreach ($grouped_pembelians as $group) {
                $total_items += count($group['items']);
              }
            }
            echo $total_items;
            ?>
          </h4>
          <p class="text-muted mb-0">Total Kue Dibeli</p>
        </div>
      </div>
    </div>
   
  </div>

  <?php if (empty($grouped_pembelians)): ?>
    <!-- Empty State -->
    <div class="empty-state text-center">
      <div class="empty-icon mb-4">
        <i class="fas fa-birthday-cake fa-4x text-muted"></i>
      </div>
      <h4 class="text-brown mb-3">
        <i class="fas fa-cookie me-2"></i>Belum ada riwayat pesanan
      </h4>
      <p class="text-muted mb-4">Yuk, pesan kue lezat pertama Anda!</p>
      <a href="<?= base_url('home') ?>" class="btn btn-bakery-primary btn-lg">
        <i class="fas fa-utensils me-2"></i>Pesan Kue Sekarang
      </a>
    </div>
  <?php else: ?>
    <!-- Transaction List -->
    <div class="transaction-list">
      <?php foreach ($grouped_pembelians as $key => $group): ?>
      <div class="card bakery-card">
        <!-- Transaction Header -->
        <div class="transaction-header">
          <div class="d-flex justify-content-between align-items-center position-relative">
            <div class="transaction-info">
              <div class="d-flex align-items-center mb-2">
                <i class="fas fa-calendar-alt fa-lg me-3"></i>
                <div>
                  <h5 class="mb-1 fw-bold"><?= date('d F Y', strtotime($group['tanggal'])) ?></h5>
                  <p class="mb-0 opacity-75">
                    <i class="fas fa-clock me-1"></i>
                    <?= date('H:i', strtotime($group['tanggal'])) ?> WIB
                  </p>
                </div>
              </div>
              <span class="badge bg-cream text-brown">
                <i class="fas fa-hashtag me-1"></i>TRX-<?= substr(md5($key), 0, 8) ?>
              </span>
            </div>
            <div class="transaction-summary text-end">
              <div class="total-amount mb-2">
                Rp <?= number_format($group['total_transaksi'], 0, ',', '.') ?>
              </div>
              <span class="badge bakery-badge">
                <i class="fas fa-check-circle me-1"></i>Pesanan Selesai
              </span>
            </div>
          </div>
        </div>

        <!-- Transaction Items -->
        <div class="card-body">
          <?php foreach ($group['items'] as $item): ?>
          <div class="transaction-item d-flex justify-content-between align-items-center mb-3 pb-3 border-bottom">
            <div class="d-flex align-items-center">
              <div class="position-relative">
                <?php if (!empty($item['gambar_barang'])): ?>
                  <img src="<?= base_url('uploads/barang/' . $item['gambar_barang']) ?>" 
                       class="item-image me-3" 
                       alt="<?= htmlspecialchars($item['nama_barang']) ?>">
                <?php else: ?>
                  <div class="item-image bg-cream d-flex align-items-center justify-content-center me-3">
                    <i class="fas fa-birthday-cake text-brown"></i>
                  </div>
                <?php endif; ?>
                <span class="position-absolute top-0 start-100 translate-middle badge bg-accent">
                  <?= $item['jumlah_barang'] ?>
                </span>
              </div>
              <div>
                <h6 class="mb-1 fw-bold text-brown"><?= htmlspecialchars($item['nama_barang']) ?></h6>
                <small class="text-muted">
                  <i class="fas fa-tag me-1"></i>Kode: <?= $item['kode_pembelian'] ?>
                </small>
              </div>
            </div>
            <div class="text-end">
              <div class="fw-bold text-accent fs-5">
                Rp <?= number_format($item['total_harga'], 0, ',', '.') ?>
              </div>
              <small class="text-muted">
                <?= $item['jumlah_barang'] ?> pcs × Rp <?= number_format($item['harga_barang'], 0, ',', '.') ?>
              </small>
            </div>
          </div>
          <?php endforeach; ?>

          <!-- Transaction Footer -->
          <div class="d-flex justify-content-between align-items-center mt-4 pt-3 border-top">
            <div class="transaction-meta">
              <small class="text-muted">
                <i class="fas fa-cube me-1"></i>
                Total <?= count($group['items']) ?> jenis kue
              </small>
            </div>
            <div class="transaction-actions">
              <a href="<?= base_url('pembelian/detail/' . $group['items'][0]['kode_pembelian']) ?>" 
                 class="btn btn-bakery-outline btn-sm me-2">
                <i class="fas fa-eye me-1"></i> Detail Pesanan
              </a>
              <a href="<?= base_url('home') ?>" 
                 class="btn btn-bakery-primary btn-sm">
                <i class="fas fa-redo me-1"></i> Pesan Lagi
              </a>
            </div>
          </div>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
  <?php endif; ?>
</div>

<!-- Additional Styles -->
<style>
  .bakery-title {
    background: linear-gradient(135deg, #8B4513, #FF6B6B);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
  }

  .btn-bakery-primary {
    background: linear-gradient(135deg, #D2691E, #FF6B6B);
    border: none;
    color: white;
    padding: 12px 25px;
    border-radius: 15px;
    font-weight: 600;
    transition: all 0.3s;
  }

  .btn-bakery-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(255, 107, 107, 0.3);
  }

  .btn-bakery-outline {
    border: 2px solid #D2691E;
    color: #D2691E;
    background: transparent;
    border-radius: 10px;
    font-weight: 500;
    transition: all 0.3s;
  }

  .btn-bakery-outline:hover {
    background: #D2691E;
    color: white;
  }

  .transaction-item {
    transition: all 0.3s;
  }

  .transaction-item:hover {
    background: #FFF8F0;
    margin-left: -10px;
    margin-right: -10px;
    padding-left: 10px;
    padding-right: 10px;
    border-radius: 10px;
  }

  .bg-accent {
    background: linear-gradient(135deg, #FF6B6B, #FF8E8E) !important;
  }

  .empty-icon {
    opacity: 0.7;
  }

  .transaction-info h5 {
    text-shadow: 1px 1px 2px rgba(0,0,0,0.2);
  }

  @media (max-width: 768px) {
    .transaction-header .d-flex {
      flex-direction: column;
      text-align: center;
      gap: 15px;
    }
    
    .transaction-actions {
      display: flex;
      flex-direction: column;
      gap: 10px;
      width: 100%;
    }
    
    .transaction-actions .btn {
      width: 100%;
    }
    
    .transaction-item {
      flex-direction: column;
      align-items: start !important;
      gap: 15px;
    }
    
    .transaction-item .text-end {
      text-align: left !important;
      width: 100%;
    }
  }
</style>

<script>
  $(document).ready(function() {
    // Add smooth animations
    $('.bakery-card').each(function(index) {
      $(this).delay(100 * index).animate({
        opacity: 1,
        marginTop: 0
      }, 500);
    });

    // Hover effects for transaction items
    $('.transaction-item').hover(
      function() {
        $(this).addClass('shadow-sm');
      },
      function() {
        $(this).removeClass('shadow-sm');
      }
    );

    // Print receipt functionality
    $('.btn-print').on('click', function() {
      const card = $(this).closest('.bakery-card');
      card.addClass('printing');
      window.print();
      setTimeout(() => {
        card.removeClass('printing');
      }, 1000);
    });
  });
</script>