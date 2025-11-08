<style>
  .bakery-card {
    border-radius: 20px;
    box-shadow: 0 8px 25px rgba(139, 69, 19, 0.1);
    border: none;
    margin-bottom: 25px;
    overflow: hidden;
  }
  .bakery-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 4px;
    background: linear-gradient(90deg, var(--secondary-brown), var(--accent-color));
  }
  .transaction-header {
    background: linear-gradient(135deg, var(--primary-brown) 0%, var(--secondary-brown) 100%);
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
  .badge-status {
    font-size: 0.8rem;
    padding: 8px 15px;
    border-radius: 20px;
    font-weight: 600;
  }
  .item-image {
    width: 70px;
    height: 70px;
    object-fit: cover;
    border-radius: 12px;
    border: 3px solid var(--cream-color);
    box-shadow: 0 3px 10px rgba(139, 69, 19, 0.1);
  }
  .total-amount {
    font-size: 1.3rem;
    font-weight: 700;
    color: #FF6B6B;
    text-shadow: 1px 1px 2px rgba(0,0,0,0.1);
  }
  .table th {
    border-top: none;
    font-weight: 600;
    background: linear-gradient(135deg, var(--cream-color), #FFFDF8);
    color: var(--primary-brown);
    padding: 15px 12px;
    border-bottom: 2px solid var(--secondary-brown);
  }
  .table td {
    padding: 15px 12px;
    vertical-align: middle;
    border-color: rgba(139, 69, 19, 0.1);
  }
</style>

<div class="container-fluid p-4">
  <!-- Header Section -->
  <div class="d-flex justify-content-between align-items-center mb-4">
    <div>
      <h2 class="fw-bold text-brown mb-2">
        <i class="fas fa-receipt me-2"></i>Manajemen Pesanan
      </h2>
      <p class="text-muted mb-0">Kelola semua pesanan kue dari pelanggan</p>
    </div>
    <div class="d-flex align-items-center">
      <span class="badge bakery-badge me-3">
        <i class="fas fa-shopping-bag me-1"></i>Total: <?= count($grouped_pembelians) ?> Pesanan
      </span>
    </div>
  </div>

  <!-- Notifications -->
  <?php if ($this->session->flashdata('success')): ?>
    <div class="alert alert-success alert-dismissible fade show bakery-alert" role="alert">
      <div class="d-flex align-items-center">
        <i class="fas fa-check-circle fa-lg me-3"></i>
        <div>
          <h6 class="mb-1">Berhasil!</h6>
          <p class="mb-0"><?= $this->session->flashdata('success') ?></p>
        </div>
      </div>
      <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
  <?php endif; ?>

  <?php if ($this->session->flashdata('error')): ?>
    <div class="alert alert-danger alert-dismissible fade show bakery-alert" role="alert">
      <div class="d-flex align-items-center">
        <i class="fas fa-exclamation-circle fa-lg me-3"></i>
        <div>
          <h6 class="mb-1">Error!</h6>
          <p class="mb-0"><?= $this->session->flashdata('error') ?></p>
        </div>
      </div>
      <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
  <?php endif; ?>

  <?php if (empty($grouped_pembelians)): ?>
    <!-- Empty State -->
    <div class="text-center py-5">
      <div class="empty-icon mb-4">
        <i class="fas fa-shopping-bag fa-4x text-muted"></i>
      </div>
      <h4 class="text-brown mb-3">Belum ada pesanan</h4>
      <p class="text-muted mb-4">Pesanan dari pelanggan akan muncul di sini</p>
      <div class="bg-cream rounded-3 p-4 d-inline-block">
        <i class="fas fa-lightbulb text-warning me-2"></i>
        <small class="text-muted">Bagikan toko Anda untuk mendapatkan pesanan pertama!</small>
      </div>
    </div>
  <?php else: ?>
    <!-- Transactions List -->
    <div class="transactions-list">
      <?php foreach ($grouped_pembelians as $key => $group): ?>
      <div class="card bakery-card" data-transaction-id="<?= $group['items'][0]['kode_pembelian'] ?>">
        <!-- Transaction Header -->
        <div class="transaction-header">
          <div class="d-flex justify-content-between align-items-center position-relative">
            <div class="transaction-info">
              <div class="d-flex align-items-center mb-2">
                <i class="fas fa-calendar-alt fa-lg me-3"></i>
                <div>
                  <h5 class="mb-1 fw-bold"><?= date('d F Y', strtotime($group['tanggal'])) ?></h5>
                  <p class="mb-0 opacity-75">
                    <i class="fas fa-user me-1"></i>
                    <?= htmlspecialchars($group['user']) ?>
                  </p>
                </div>
              </div>
              <span class="badge bg-cream text-brown">
                <i class="fas fa-hashtag me-1"></i>Pesanan #<?= substr(md5($key), 0, 8) ?>
              </span>
            </div>
            <div class="transaction-summary text-end">
              <div class="total-amount mb-2">
                Rp <?= number_format($group['total_transaksi'], 0, ',', '.') ?>
              </div>
              <span class="badge-status bg-success">
                <i class="fas fa-check-circle me-1"></i>Pesanan Selesai
              </span>
            </div>
          </div>
        </div>

        <!-- Transaction Items -->
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-hover mb-0">
              <thead>
                <tr>
                  <th width="5%" class="text-center">#</th>
                  <th width="15%">Gambar</th>
                  <th width="25%">Kue</th>
                  <th width="15%">Kode Pesanan</th>
                  <th width="10%" class="text-center">Jumlah</th>
                  <th width="15%" class="text-end">Harga</th>
                  <th width="15%" class="text-end">Subtotal</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($group['items'] as $index => $item): ?>
                <tr class="item-row">
                  <td class="text-center">
                    <span class="text-muted fw-bold"><?= $index + 1 ?></span>
                  </td>
                  <td>
                    <?php if (!empty($item['gambar_barang'])): ?>
                      <img src="<?= base_url('uploads/barang/' . $item['gambar_barang']) ?>" 
                           class="item-image" 
                           alt="<?= htmlspecialchars($item['nama_barang']) ?>"
                           title="<?= htmlspecialchars($item['nama_barang']) ?>">
                    <?php else: ?>
                      <div class="item-image bg-cream d-flex align-items-center justify-content-center">
                        <i class="fas fa-cookie-bite text-brown"></i>
                      </div>
                    <?php endif; ?>
                  </td>
                  <td>
                    <strong class="text-brown d-block"><?= htmlspecialchars($item['nama_barang']) ?></strong>
                    <?php if (!empty($item['jenis'])): ?>
                      <small class="text-muted"><?= $item['jenis'] ?></small>
                    <?php endif; ?>
                  </td>
                  <td>
                    <code class="text-muted"><?= $item['kode_pembelian'] ?></code>
                  </td>
                  <td class="text-center">
                    <span class="badge bg-brown text-white"><?= $item['jumlah_barang'] ?> pcs</span>
                  </td>
                  <td class="text-end">
                    <span class="text-muted">Rp <?= number_format($item['harga_barang'], 0, ',', '.') ?></span>
                  </td>
                  <td class="text-end">
                    <strong class="text-accent">Rp <?= number_format($item['total_harga'], 0, ',', '.') ?></strong>
                  </td>
                </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
          </div>

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
              <button class="btn btn-bakery-danger btn-sm btn-delete" 
                      data-kode="<?= $group['items'][0]['kode_pembelian'] ?>" 
                      data-tanggal="<?= date('d F Y', strtotime($group['tanggal'])) ?>" 
                      data-user="<?= htmlspecialchars($group['user']) ?>">
                <i class="fas fa-trash-can me-1"></i> Hapus
              </button>
            </div>
          </div>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
  <?php endif; ?>
</div>

<!-- Modal Konfirmasi Hapus -->
<div class="modal fade" id="confirmDeleteModal" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content bakery-modal">
      <div class="modal-header">
        <h5 class="modal-title text-brown fw-bold">
          <i class="fas fa-triangle-exclamation text-warning me-2"></i>Hapus Pesanan?
        </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body text-center py-4">
        <div class="warning-icon mb-3">
          <i class="fas fa-receipt fa-3x text-accent"></i>
        </div>
        <h6 class="text-brown mb-3">Konfirmasi Penghapusan</h6>
        <p class="mb-3">
          Anda akan menghapus pesanan:<br>
          <strong class="text-accent" id="transactionUser"></strong><br>
          <small class="text-muted" id="transactionDate"></small>
        </p>
        <div class="alert alert-warning bg-cream border-warning">
          <small>
            <i class="fas fa-info-circle me-1"></i>
            Data pesanan yang dihapus tidak dapat dikembalikan. 
            Tindakan ini akan menghapus semua item dalam pesanan ini.
          </small>
        </div>
      </div>
      <div class="modal-footer justify-content-center">
        <button type="button" class="btn btn-bakery-outline" data-bs-dismiss="modal">
          <i class="fas fa-times me-1"></i> Batal
        </button>
        <a href="#" id="confirmDeleteBtn" class="btn btn-bakery-danger">
          <i class="fas fa-trash-can me-1"></i> Ya, Hapus
        </a>
      </div>
    </div>
  </div>
</div>

<!-- Additional Styles -->
<style>
  .bakery-alert {
    border-radius: 15px;
    border: none;
    box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    border-left: 4px solid;
  }
  
  .alert-success {
    border-left-color: #27AE60;
    background: linear-gradient(135deg, #f8fff9, #ffffff);
  }
  
  .alert-danger {
    border-left-color: #FF6B6B;
    background: linear-gradient(135deg, #fff8f8, #ffffff);
  }
  
  .bakery-badge {
    background: linear-gradient(135deg, var(--secondary-brown), var(--accent-color));
    border: none;
    border-radius: 15px;
    padding: 10px 15px;
    font-weight: 600;
    color: white;
  }
  
  .btn-bakery-outline {
    border: 2px solid var(--secondary-brown);
    color: var(--secondary-brown);
    background: transparent;
    border-radius: 10px;
    font-weight: 500;
    padding: 8px 16px;
    transition: all 0.3s ease;
  }
  
  .btn-bakery-outline:hover {
    background: var(--secondary-brown);
    color: white;
  }
  
  .btn-bakery-danger {
    background: linear-gradient(135deg, #FF6B6B, #FF8E8E);
    border: none;
    color: white;
    border-radius: 10px;
    font-weight: 500;
    padding: 8px 16px;
    transition: all 0.3s ease;
  }
  
  .btn-bakery-danger:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(255, 107, 107, 0.3);
  }
  
  .item-row {
    transition: all 0.3s ease;
  }
  
  .item-row:hover {
    background: var(--cream-color);
  }
  
  .bg-brown {
    background: linear-gradient(135deg, var(--primary-brown), var(--secondary-brown)) !important;
  }
  
  .bakery-modal {
    border-radius: 20px;
    border: none;
    box-shadow: 0 20px 50px rgba(139, 69, 19, 0.2);
  }
  
  .bakery-modal .modal-header {
    background: var(--cream-color);
    border-bottom: 2px solid var(--secondary-brown);
  }
  
  .warning-icon {
    opacity: 0.8;
  }
  
  .empty-icon {
    opacity: 0.6;
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
    
    .table-responsive {
      border-radius: 15px;
      border: 1px solid var(--cream-color);
    }
    
    .item-image {
      width: 50px;
      height: 50px;
    }
  }
</style>

<script>
$(document).ready(function() {
  // Handle delete button click dengan jQuery
  $('.btn-delete').on('click', function() {
    const kodePembelian = $(this).data('kode');
    const tanggal = $(this).data('tanggal');
    const user = $(this).data('user');
    
    // Set data di modal
    $('#transactionUser').text(user);
    $('#transactionDate').text(tanggal);
    $('#confirmDeleteBtn').attr('href', '<?= base_url('pembelian/hapus/') ?>' + kodePembelian);
    
    // Tampilkan modal
    $('#confirmDeleteModal').modal('show');
  });

  // Auto-hide alerts setelah 5 detik
  $('.alert').each(function() {
    const $alert = $(this);
    setTimeout(function() {
      $alert.alert('close');
    }, 5000);
  });

  // Add animation to transaction cards dengan jQuery
  $('.bakery-card').each(function(index) {
    const $card = $(this);
    $card.css({
      'opacity': '0',
      'transform': 'translateY(20px)'
    });
    
    setTimeout(function() {
      $card.css({
        'transition': 'all 0.5s ease',
        'opacity': '1',
        'transform': 'translateY(0)'
      });
    }, index * 100);
  });

  // Hover effects untuk item rows
  $('.item-row').hover(
    function() {
      $(this).css('background', 'var(--cream-color)');
    },
    function() {
      $(this).css('background', '');
    }
  );

  // Hover effects untuk buttons
  $('.btn-bakery-outline, .btn-bakery-danger').hover(
    function() {
      $(this).css('transform', 'translateY(-2px)');
    },
    function() {
      $(this).css('transform', 'translateY(0)');
    }
  );

  // Search functionality (opsional)
  $('#searchInput').on('keyup', function() {
    const value = $(this).val().toLowerCase();
    $('.bakery-card').filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
    });
  });

  // Refresh data setiap 30 detik (opsional)
  function refreshData() {
    $.ajax({
      url: '<?= base_url('pembelian/get_latest') ?>',
      type: 'GET',
      success: function(response) {
        if (response.new_orders > 0) {
          // Show notification for new orders
          showNewOrderNotification(response.new_orders);
        }
      }
    });
  }

  // Uncomment jika ingin auto-refresh
  // setInterval(refreshData, 30000);

  function showNewOrderNotification(count) {
    const notification = $(
      '<div class="alert alert-info alert-dismissible fade show bakery-alert" role="alert">' +
        '<div class="d-flex align-items-center">' +
          '<i class="fas fa-bell fa-lg me-3"></i>' +
          '<div>' +
            '<h6 class="mb-1">Pesanan Baru!</h6>' +
            '<p class="mb-0">Ada ' + count + ' pesanan baru</p>' +
          '</div>' +
        '</div>' +
        '<button type="button" class="btn-close" data-bs-dismiss="alert"></button>' +
      '</div>'
    );
    
    $('.container-fluid').prepend(notification);
    
    // Auto remove after 5 seconds
    setTimeout(function() {
      notification.alert('close');
    }, 5000);
  }

  // Loading state untuk buttons
  $('.btn-bakery-danger').on('click', function() {
    const $btn = $(this);
    const originalText = $btn.html();
    
    $btn.html('<i class="fas fa-spinner fa-spin me-1"></i>Menghapus...');
    $btn.prop('disabled', true);
    
    // Reset after 3 seconds (fallback)
    setTimeout(function() {
      $btn.html(originalText);
      $btn.prop('disabled', false);
    }, 3000);
  });
});
</script>