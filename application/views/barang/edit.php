<style>
  .bakery-form-container {
    max-width: 700px;
    background: white;
    padding: 40px;
    border-radius: 20px;
    box-shadow: 0 10px 30px rgba(139, 69, 19, 0.1);
    border: 1px solid var(--cream-color);
  }
  .form-label {
    font-weight: 600;
    color: var(--primary-brown);
    margin-bottom: 8px;
  }
  .form-control, .form-select {
    border: 2px solid var(--cream-color);
    border-radius: 12px;
    padding: 12px 15px;
    transition: all 0.3s ease;
  }
  .form-control:focus, .form-select:focus {
    border-color: var(--secondary-brown);
    box-shadow: 0 0 0 0.2rem rgba(210, 105, 30, 0.25);
  }
  .current-image {
    max-width: 250px;
    max-height: 250px;
    border-radius: 15px;
    border: 3px solid var(--cream-color);
    box-shadow: 0 5px 15px rgba(139, 69, 19, 0.1);
  }
  .image-container {
    text-align: center;
    padding: 20px;
    background: var(--cream-color);
    border-radius: 15px;
    margin-bottom: 20px;
  }
  .required-star {
    color: #FF6B6B;
  }
</style>

<div class="container-fluid p-4">
  <div class="d-flex justify-content-between align-items-center mb-4">
    <div>
      <h2 class="fw-bold text-brown mb-2">
        <i class="fas fa-edit me-2"></i>Edit Kue
      </h2>
      <p class="text-muted mb-0">Edit informasi kue <?= htmlspecialchars($barang['nama_barang']) ?></p>
    </div>
    <a href="<?= base_url('barang') ?>" class="btn btn-bakery-outline">
      <i class="fas fa-arrow-left me-2"></i> Kembali ke Daftar
    </a>
  </div>

  <?php if (isset($error_message)): ?>
    <div class="alert alert-danger alert-dismissible fade show bakery-alert" role="alert">
      <div class="d-flex align-items-center">
        <i class="fas fa-exclamation-circle fa-lg me-3"></i>
        <div>
          <h6 class="mb-1">Error!</h6>
          <p class="mb-0"><?= $error_message ?></p>
        </div>
      </div>
      <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
  <?php endif; ?>

  <div class="bakery-form-container">
    <form action="<?= base_url('barang/update/' . $barang['kode_barang']) ?>" method="post" enctype="multipart/form-data">
      
      <!-- Kode Barang (Readonly) -->
      <div class="mb-4">
        <label class="form-label">Kode Kue</label>
        <input type="text" class="form-control bg-light" name="kode_barang" 
               value="<?= htmlspecialchars($barang['kode_barang']) ?>" 
               readonly>
        <div class="form-text">Kode kue tidak dapat diubah</div>
      </div>

      <!-- Nama Kue -->
      <div class="mb-4">
        <label class="form-label">
          Nama Kue <span class="required-star">*</span>
        </label>
        <input type="text" class="form-control" name="nama_barang" 
               value="<?= htmlspecialchars($barang['nama_barang']) ?>" 
               placeholder="Contoh: Red Velvet Cake">
        <?php if(isset($error['nama_barang'])): ?>
          <div class="text-accent mt-2">
            <i class="fas fa-exclamation-circle me-1"></i><?= $error['nama_barang'] ?>
          </div>
        <?php endif; ?>
      </div>

      <!-- Jenis Kue -->
      <div class="mb-4">
        <label class="form-label">
          Jenis Kue <span class="required-star">*</span>
        </label>
        <select class="form-select" name="jenis">
          <option value="">Pilih Jenis Kue</option>
          <option value="Kue Tart" <?= ($barang['jenis'] == 'Kue Tart') ? 'selected' : '' ?>>Kue Tart</option>
          <option value="Roti" <?= ($barang['jenis'] == 'Roti') ? 'selected' : '' ?>>Roti</option>
          <option value="Kue Kering" <?= ($barang['jenis'] == 'Kue Kering') ? 'selected' : '' ?>>Kue Kering</option>
          <option value="Pastry" <?= ($barang['jenis'] == 'Pastry') ? 'selected' : '' ?>>Pastry</option>
          <option value="Kue Tradisional" <?= ($barang['jenis'] == 'Kue Tradisional') ? 'selected' : '' ?>>Kue Tradisional</option>
          <option value="Cupcake" <?= ($barang['jenis'] == 'Cupcake') ? 'selected' : '' ?>>Cupcake</option>
          <option value="Donat" <?= ($barang['jenis'] == 'Donat') ? 'selected' : '' ?>>Donat</option>
          <option value="Lainnya" <?= ($barang['jenis'] == 'Lainnya') ? 'selected' : '' ?>>Lainnya</option>
        </select>
        <?php if(isset($error['jenis'])): ?>
          <div class="text-accent mt-2">
            <i class="fas fa-exclamation-circle me-1"></i><?= $error['jenis'] ?>
          </div>
        <?php endif; ?>
      </div>

      <!-- Harga Kue -->
      <div class="mb-4">
        <label class="form-label">
          Harga Kue (Rp) <span class="required-star">*</span>
        </label>
        <div class="input-group">
          <span class="input-group-text bg-cream border-end-0">Rp</span>
          <input type="number" class="form-control border-start-0" name="harga_barang" 
                 value="<?= htmlspecialchars($barang['harga_barang']) ?>" 
                 min="1000" 
                 placeholder="Contoh: 25000">
        </div>
        <?php if(isset($error['harga_barang'])): ?>
          <div class="text-accent mt-2">
            <i class="fas fa-exclamation-circle me-1"></i><?= $error['harga_barang'] ?>
          </div>
        <?php endif; ?>
        <div class="form-text">Harga per buah/potong</div>
      </div>

      <!-- Deskripsi Kue -->
      <div class="mb-4">
        <label class="form-label">Deskripsi Kue</label>
        <textarea class="form-control" name="deskripsi" rows="3" 
                  placeholder="Deskripsi singkat tentang kue (bahan, rasa, ukuran, dll)"><?= htmlspecialchars($barang['deskripsi'] ?? '') ?></textarea>
        <div class="form-text">Opsional: Jelaskan keunikan kue ini</div>
      </div>

      <!-- Gambar Kue -->
      <div class="mb-4">
        <label class="form-label">Gambar Kue</label>
        
        <?php if (!empty($barang['gambar_barang'])): ?>
          <!-- Current Image -->
          <div class="image-container">
            <label class="form-label text-success d-block mb-3">
              <i class="fas fa-image me-2"></i>Gambar Saat Ini:
            </label>
            <img src="<?= base_url('uploads/barang/' . $barang['gambar_barang']) ?>" 
                 class="current-image" 
                 alt="<?= htmlspecialchars($barang['nama_barang']) ?>">
            <div class="mt-3">
              <div class="form-check">
                <input class="form-check-input" type="checkbox" name="hapus_gambar" value="1" id="hapusGambar">
                <label class="form-check-label text-accent fw-bold" for="hapusGambar">
                  <i class="fas fa-trash me-1"></i>Hapus gambar ini
                </label>
              </div>
            </div>
          </div>
          <hr class="my-4">
          <label class="form-label">Ganti Gambar Baru (Opsional)</label>
        <?php endif; ?>

        <input class="form-control" type="file" name="gambar_barang" accept="image/*" id="gambarInput">
        <div class="form-text">
          <i class="fas fa-info-circle me-1"></i>
          Format: JPG, PNG, GIF (Maks. 2MB)
        </div>
      </div>

      <!-- Action Buttons -->
      <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-5 pt-3 border-top">
        <a href="<?= base_url('barang') ?>" class="btn btn-bakery-outline me-md-3">
          <i class="fas fa-times me-2"></i> Batal
        </a>
        <button type="submit" class="btn btn-bakery-success">
          <i class="fas fa-save me-2"></i> Update Kue
        </button>
      </div>
    </form>
  </div>
</div>