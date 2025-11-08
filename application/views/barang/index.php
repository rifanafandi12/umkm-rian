<style>
  .bakery-card {
    border-radius: 20px;
    box-shadow: 0 8px 25px rgba(139, 69, 19, 0.1);
    border: none;
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
  .kue-image {
    width: 60px;
    height: 60px;
    object-fit: cover;
    border-radius: 12px;
    border: 3px solid var(--cream-color);
    box-shadow: 0 3px 10px rgba(139, 69, 19, 0.1);
  }
  .jenis-badge {
    background: linear-gradient(135deg, var(--secondary-brown), var(--accent-color));
    border: none;
    border-radius: 10px;
    padding: 6px 12px;
    font-size: 0.75rem;
    font-weight: 600;
    color: white;
  }
</style>

<div class="container-fluid p-4">
  <!-- Header Section -->
  <div class="d-flex justify-content-between align-items-center mb-4">
    <div>
      <h2 class="fw-bold text-brown mb-2">
        <i class="fas fa-cookie-bite me-2"></i>Manajemen Kue
      </h2>
      <p class="text-muted mb-0">Kelola menu kue Waroeng Kue Ucup</p>
    </div>
    <div class="d-flex align-items-center">
      <span class="badge bakery-badge me-3">
        <i class="fas fa-cookie me-1"></i>Total: <?= count($barangs) ?> Kue
      </span>
      <a href="<?= base_url('barang/tambah') ?>" class="btn btn-bakery-success">
        <i class="fas fa-plus me-2"></i> Tambah Kue
      </a>
    </div>
  </div>

  <!-- Kue Table Card -->
  <div class="card bakery-card">
    <div class="card-header bg-white">
      <div class="d-flex justify-content-between align-items-center">
        <h5 class="card-title mb-0 text-brown fw-bold">
          <i class="fas fa-list-check me-2"></i>Daftar Menu Kue
        </h5>
        <div class="text-muted">
          <small><i class="fas fa-info-circle me-1"></i>Terakhir diperbarui: <?= date('d/m/Y H:i') ?></small>
        </div>
      </div>
    </div>
    <div class="card-body">
      <?php if (empty($barangs)): ?>
        <!-- Empty State -->
        <div class="text-center py-5">
          <div class="empty-icon mb-4">
            <i class="fas fa-cookie-bite fa-4x text-muted"></i>
          </div>
          <h5 class="text-brown mb-3">Belum ada kue terdaftar</h5>
          <p class="text-muted mb-4">Mulai tambahkan menu kue pertama Anda</p>
          <a href="<?= base_url('barang/tambah') ?>" class="btn btn-bakery-success btn-lg">
            <i class="fas fa-plus me-2"></i> Tambah Kue Pertama
          </a>
        </div>
      <?php else: ?>
        <div class="table-responsive">
          <table class="table table-hover">
            <thead>
              <tr>
                <th width="10%" class="text-center">Kode</th>
                <th width="25%">Kue</th>
                <th width="15%">Gambar</th>
                <th width="15%">Jenis</th>
                <th width="15%">Harga</th>
                <th width="20%" class="text-center">Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($barangs as $b): ?>
              <tr class="kue-row">
                <td class="text-center">
                  <span class="badge bg-brown text-white"><?= $b['kode_barang'] ?></span>
                </td>
                <td>
                  <div class="kue-info">
                    <strong class="text-brown d-block"><?= htmlspecialchars($b['nama_barang']) ?></strong>
                    <?php if (!empty($b['deskripsi'])): ?>
                      <small class="text-muted"><?= substr($b['deskripsi'], 0, 50) ?>...</small>
                    <?php endif; ?>
                  </div>
                </td>
                <td>
                  <?php if (!empty($b['gambar_barang'])): ?>
                    <img src="<?= base_url('uploads/barang/' . $b['gambar_barang']) ?>" 
                         class="kue-image" 
                         alt="<?= htmlspecialchars($b['nama_barang']) ?>"
                         title="<?= htmlspecialchars($b['nama_barang']) ?>">
                  <?php else: ?>
                    <div class="kue-image bg-cream d-flex align-items-center justify-content-center">
                      <i class="fas fa-cookie-bite text-brown"></i>
                    </div>
                  <?php endif; ?>
                </td>
                <td>
                  <span class="jenis-badge"><?= htmlspecialchars($b['jenis']) ?></span>
                </td>
                <td>
                  <div class="price-info">
                    <strong class="text-accent d-block">Rp <?= number_format($b['harga_barang'], 0, ',', '.') ?></strong>
                    <small class="text-muted">per pcs</small>
                  </div>
                </td>
                <td class="text-center">
                  <div class="btn-group" role="group">
                    <a href="<?= base_url('barang/edit/' . $b['kode_barang']); ?>" 
                       class="btn btn-bakery-outline btn-sm" 
                       title="Edit Kue">
                      <i class="fas fa-edit"></i>
                    </a>
                    <button onclick="hapusKue('<?= $b['kode_barang'] ?>', '<?= htmlspecialchars($b['nama_barang']) ?>')" 
                            class="btn btn-bakery-danger btn-sm" 
                            title="Hapus Kue">
                      <i class="fas fa-trash-can"></i>
                    </button>
                  </div>
                </td>
              </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>

        <!-- Table Summary -->
        <div class="row mt-4 pt-3 border-top">
          <div class="col-md-6">
            <small class="text-muted">
              <i class="fas fa-database me-1"></i>
              Menampilkan <?= count($barangs) ?> jenis kue
            </small>
          </div>
          <div class="col-md-6 text-end">
            <small class="text-muted">
              <i class="fas fa-calculator me-1"></i>
              Total nilai: Rp <?= number_format(array_sum(array_column($barangs, 'harga_barang')), 0, ',', '.') ?>
            </small>
          </div>
        </div>
      <?php endif; ?>
    </div>
  </div>
</div>

<!-- Modal Konfirmasi Hapus -->
<div class="modal fade" id="confirmDeleteModal" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content bakery-modal">
      <div class="modal-header">
        <h5 class="modal-title text-brown fw-bold">
          <i class="fas fa-triangle-exclamation text-warning me-2"></i>Hapus Kue?
        </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body text-center py-4">
        <div class="warning-icon mb-3">
          <i class="fas fa-cookie-bite fa-3x text-accent"></i>
        </div>
        <h6 class="text-brown mb-3">Konfirmasi Penghapusan</h6>
        <p class="mb-3">
          Anda akan menghapus kue: <br>
          <strong class="text-accent" id="kueNameToDelete"></strong>
        </p>
        <div class="alert alert-warning bg-cream border-warning">
          <small>
            <i class="fas fa-info-circle me-1"></i>
            Data kue yang dihapus tidak dapat dikembalikan. 
            Riwayat pesanan yang terkait akan tetap ada.
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
  .btn-bakery-success {
    background: linear-gradient(135deg, #27AE60, #2ECC71);
    border: none;
    color: white;
    border-radius: 15px;
    font-weight: 600;
    padding: 12px 20px;
    transition: all 0.3s ease;
  }
  
  .btn-bakery-success:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(39, 174, 96, 0.3);
  }
  
  .btn-bakery-outline {
    border: 2px solid var(--secondary-brown);
    color: var(--secondary-brown);
    background: transparent;
    border-radius: 10px;
    padding: 8px 12px;
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
    padding: 8px 12px;
    transition: all 0.3s ease;
  }
  
  .btn-bakery-danger:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(255, 107, 107, 0.3);
  }
  
  .kue-row {
    transition: all 0.3s ease;
  }
  
  .kue-row:hover {
    background: var(--cream-color);
    transform: scale(1.01);
  }
  
  .bg-brown {
    background: linear-gradient(135deg, var(--primary-brown), var(--secondary-brown)) !important;
  }
  
  .price-info {
    text-align: center;
  }
  
  .empty-icon {
    opacity: 0.6;
  }
  
  .btn-group .btn {
    margin: 0 2px;
  }
  
  @media (max-width: 768px) {
    .table-responsive {
      border-radius: 15px;
      border: 1px solid var(--cream-color);
    }
    
    .kue-row td {
      padding: 12px 8px;
    }
    
    .btn-group .btn {
      padding: 6px 10px;
      font-size: 0.8rem;
    }
    
    .kue-image {
      width: 50px;
      height: 50px;
    }
  }
</style>

<script>
function hapusKue(kodeBarang, namaKue) {
  // Set data di modal
  document.getElementById('kueNameToDelete').textContent = namaKue;
  document.getElementById('confirmDeleteBtn').href = '<?= base_url('barang/hapus/') ?>' + kodeBarang;
  
  // Tampilkan modal
  const modal = new bootstrap.Modal(document.getElementById('confirmDeleteModal'));
  modal.show();
}

// Add animation to table rows
document.addEventListener('DOMContentLoaded', function() {
  const tableRows = document.querySelectorAll('.kue-row');
  tableRows.forEach((row, index) => {
    row.style.opacity = '0';
    row.style.transform = 'translateX(-20px)';
    
    setTimeout(() => {
      row.style.transition = 'all 0.5s ease';
      row.style.opacity = '1';
      row.style.transform = 'translateX(0)';
    }, index * 100);
  });
});
</script>

