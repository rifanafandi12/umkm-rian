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
  .badge-role {
    font-size: 0.75rem;
    padding: 6px 12px;
    border-radius: 12px;
    font-weight: 600;
  }
  .user-avatar {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    background: linear-gradient(135deg, var(--secondary-brown), var(--accent-color));
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-weight: 600;
    font-size: 0.9rem;
  }
</style>

<div class="container-fluid p-4">
  <!-- Header Section -->
  <div class="d-flex justify-content-between align-items-center mb-4">
    <div>
      <h2 class="fw-bold text-brown mb-2">
        <i class="fas fa-users-cog me-2"></i>Manajemen Pelanggan
      </h2>
      <p class="text-muted mb-0">Kelola data pelanggan Waroeng Kue Ucup</p>
    </div>
    <div class="d-flex align-items-center">
      <span class="badge bakery-badge me-3">
        <i class="fas fa-users me-1"></i>Total: <?= count($users) ?> Pelanggan
      </span>
    </div>
  </div>

  <!-- Notifikasi -->
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

  <!-- User Table Card -->
  <div class="card bakery-card">
    <div class="card-header bg-white">
      <div class="d-flex justify-content-between align-items-center">
        <h5 class="card-title mb-0 text-brown fw-bold">
          <i class="fas fa-list-check me-2"></i>Daftar Pelanggan
        </h5>
        <div class="text-muted">
          <small><i class="fas fa-info-circle me-1"></i>Terakhir diperbarui: <?= date('d/m/Y H:i') ?></small>
        </div>
      </div>
    </div>
    <div class="card-body">
      <?php if (empty($users)): ?>
        <!-- Empty State -->
        <div class="text-center py-5">
          <div class="empty-icon mb-4">
            <i class="fas fa-users-slash fa-4x text-muted"></i>
          </div>
          <h5 class="text-brown mb-3">Belum ada pelanggan terdaftar</h5>
          <p class="text-muted mb-4">Pelanggan yang mendaftar akan muncul di sini</p>
          <div class="bg-cream rounded-3 p-4 d-inline-block">
            <i class="fas fa-lightbulb text-warning me-2"></i>
            <small class="text-muted">Bagikan link toko untuk mendapatkan pelanggan pertama!</small>
          </div>
        </div>
      <?php else: ?>
        <div class="table-responsive">
          <table class="table table-hover">
            <thead>
              <tr>
                <th width="5%" class="text-center">#</th>
                <th width="15%">User</th>
                <th width="20%">Informasi</th>
                <th width="15%">Kontak</th>
                <th width="10%">Status</th>
                <th width="15%" class="text-center">Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($users as $index => $user): ?>
              <tr class="user-row">
                <td class="text-center">
                  <span class="text-muted fw-bold"><?= $index + 1 ?></span>
                </td>
                <td>
                  <div class="d-flex align-items-center">
                    <div class="user-avatar me-3">
                      <?= strtoupper(substr($user['username'], 0, 2)) ?>
                    </div>
                    <div>
                      <strong class="text-brown d-block"><?= htmlspecialchars($user['username']) ?></strong>
                      <small class="text-muted">ID: <?= $user['id_user'] ?></small>
                    </div>
                  </div>
                </td>
                <td>
                  <div class="user-info">
                    <strong class="d-block text-dark"><?= htmlspecialchars($user['nama'] ?? '-') ?></strong>
                    <small class="text-muted">
                      <i class="fas fa-calendar me-1"></i>
                      Bergabung: <?= date('d/m/Y', strtotime($user['created_at'] ?? 'now')) ?>
                    </small>
                  </div>
                </td>
                <td>
                  <?php if (!empty($user['no_hp'])): ?>
                    <div class="d-flex align-items-center">
                      <i class="fas fa-phone text-success me-2"></i>
                      <span><?= htmlspecialchars($user['no_hp']) ?></span>
                    </div>
                  <?php else: ?>
                    <span class="text-muted">
                      <i class="fas fa-phone-slash me-2"></i>Tidak ada
                    </span>
                  <?php endif; ?>
                </td>
                <td>
                  <span class="badge badge-role <?= $user['role'] == 'admin' ? 'bg-danger' : 'bg-success' ?>">
                    <i class="fas fa-<?= $user['role'] == 'admin' ? 'crown' : 'user' ?> me-1"></i>
                    <?= strtoupper($user['role']) ?>
                  </span>
                </td>
                <td class="text-center">
                  <button onclick="hapusUser(<?= $user['id_user'] ?>, '<?= htmlspecialchars($user['username']) ?>')" 
                          class="btn btn-bakery-danger btn-sm" 
                          title="Hapus User">
                    <i class="fas fa-trash-can me-1"></i> Hapus
                  </button>
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
              Menampilkan <?= count($users) ?> pelanggan
            </small>
          </div>
          <div class="col-md-6 text-end">
            <small class="text-muted">
              <i class="fas fa-clock me-1"></i>
              Diperbarui: <?= date('H:i:s') ?>
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
          <i class="fas fa-triangle-exclamation text-warning me-2"></i>Konfirmasi Hapus
        </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body text-center py-4">
        <div class="warning-icon mb-3">
          <i class="fas fa-trash-can fa-3x text-accent"></i>
        </div>
        <h6 class="text-brown mb-3">Hapus Pelanggan?</h6>
        <p class="mb-3">
          Anda akan menghapus pelanggan: <br>
          <strong class="text-accent" id="usernameToDelete"></strong>
        </p>
        <div class="alert alert-warning bg-cream border-warning">
          <small>
            <i class="fas fa-info-circle me-1"></i>
            Data yang dihapus tidak dapat dikembalikan. Riwayat pesanan juga akan terpengaruh.
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
  
  .user-row {
    transition: all 0.3s ease;
  }
  
  .user-row:hover {
    background: var(--cream-color);
    transform: scale(1.01);
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
    .table-responsive {
      border-radius: 15px;
      border: 1px solid var(--cream-color);
    }
    
    .user-row td {
      padding: 12px 8px;
    }
    
    .btn-bakery-danger {
      padding: 6px 12px;
      font-size: 0.8rem;
    }
  }
</style>

<script>
function hapusUser(idUser, username) {
  // Set data di modal
  document.getElementById('usernameToDelete').textContent = username;
  document.getElementById('confirmDeleteBtn').href = '<?= base_url('admin/hapus_user/') ?>' + idUser;
  
  // Tampilkan modal
  const modal = new bootstrap.Modal(document.getElementById('confirmDeleteModal'));
  modal.show();
}

// Auto-hide alerts setelah 5 detik
document.addEventListener('DOMContentLoaded', function() {
  const alerts = document.querySelectorAll('.alert');
  alerts.forEach(function(alert) {
    setTimeout(function() {
      const bsAlert = new bootstrap.Alert(alert);
      bsAlert.close();
    }, 5000);
  });

  // Add animation to table rows
  const tableRows = document.querySelectorAll('.user-row');
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

// Search functionality (optional enhancement)
function searchUsers() {
  const input = document.getElementById('searchInput');
  const filter = input.value.toLowerCase();
  const table = document.querySelector('.table');
  const rows = table.getElementsByTagName('tbody')[0].getElementsByTagName('tr');
  
  for (let i = 0; i < rows.length; i++) {
    const cells = rows[i].getElementsByTagName('td');
    let found = false;
    
    for (let j = 0; j < cells.length; j++) {
      const cell = cells[j];
      if (cell) {
        if (cell.textContent.toLowerCase().indexOf(filter) > -1) {
          found = true;
          break;
        }
      }
    }
    
    if (found) {
      rows[i].style.display = '';
    } else {
      rows[i].style.display = 'none';
    }
  }
}
</script>