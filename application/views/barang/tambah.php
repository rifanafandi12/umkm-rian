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
  .required-star {
    color: #FF6B6B;
  }
  .form-text {
    color: #8D6E63 !important;
  }
</style>

<div class="container-fluid p-4">
  <!-- Header Section -->
  <div class="d-flex justify-content-between align-items-center mb-4">
    <div>
      <h2 class="fw-bold text-brown mb-2">
        <i class="fas fa-cookie-bite me-2"></i>Tambah Kue Baru
      </h2>
      <p class="text-muted mb-0">Tambahkan menu kue baru ke Waroeng Kue Ucup</p>
    </div>
    <a href="<?= base_url('barang') ?>" class="btn btn-bakery-outline">
      <i class="fas fa-arrow-left me-2"></i> Kembali ke Daftar
    </a>
  </div>

  <!-- Notifications -->
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

  <!-- Form Container -->
  <div class="bakery-form-container">
    <form action="<?= base_url('barang/tambah') ?>" method="post" enctype="multipart/form-data">
      
      <!-- Nama Kue -->
      <div class="mb-4">
        <label class="form-label">
          Nama Kue <span class="required-star">*</span>
        </label>
        <input type="text" class="form-control" name="nama_barang" 
               value="<?= set_value('nama_barang') ?>" 
               placeholder="Contoh: Red Velvet Cake, Croissant, Donat Glaze">
        <?= form_error('nama_barang', '<div class="text-accent mt-2"><i class="fas fa-exclamation-circle me-1"></i>', '</div>') ?>
      </div>

      <!-- Jenis Kue -->
      <div class="mb-4">
        <label class="form-label">
          Jenis Kue <span class="required-star">*</span>
        </label>
        <select class="form-select" name="jenis">
          <option value="">Pilih Jenis Kue</option>
          <option value="Kue Tart" <?= set_select('jenis', 'Kue Tart') ?>>Kue Tart</option>
          <option value="Roti" <?= set_select('jenis', 'Roti') ?>>Roti</option>
          <option value="Kue Kering" <?= set_select('jenis', 'Kue Kering') ?>>Kue Kering</option>
          <option value="Pastry" <?= set_select('jenis', 'Pastry') ?>>Pastry</option>
          <option value="Kue Tradisional" <?= set_select('jenis', 'Kue Tradisional') ?>>Kue Tradisional</option>
          <option value="Cupcake" <?= set_select('jenis', 'Cupcake') ?>>Cupcake</option>
          <option value="Donat" <?= set_select('jenis', 'Donat') ?>>Donat</option>
          <option value="Lainnya" <?= set_select('jenis', 'Lainnya') ?>>Lainnya</option>
        </select>
        <?= form_error('jenis', '<div class="text-accent mt-2"><i class="fas fa-exclamation-circle me-1"></i>', '</div>') ?>
      </div>

      <!-- Harga Kue -->
      <div class="mb-4">
        <label class="form-label">
          Harga Kue (Rp) <span class="required-star">*</span>
        </label>
        <div class="input-group">
          <span class="input-group-text bg-cream border-end-0">Rp</span>
          <input type="number" class="form-control border-start-0" name="harga_barang" 
                 value="<?= set_value('harga_barang') ?>" 
                 min="1000" 
                 placeholder="Contoh: 25000">
        </div>
        <?= form_error('harga_barang', '<div class="text-accent mt-2"><i class="fas fa-exclamation-circle me-1"></i>', '</div>') ?>
        <div class="form-text">Harga per buah/potong</div>
      </div>

      <!-- Deskripsi Kue -->
      <div class="mb-4">
        <label class="form-label">Deskripsi Kue</label>
        <textarea class="form-control" name="deskripsi" rows="3" 
                  placeholder="Deskripsi singkat tentang kue (bahan, rasa, ukuran, dll)"><?= set_value('deskripsi') ?></textarea>
        <div class="form-text">Opsional: Jelaskan keunikan kue ini</div>
      </div>

      <!-- Gambar Kue -->
      <div class="mb-4">
        <label class="form-label">Gambar Kue</label>
        <div class="file-upload-area">
          <input class="form-control" type="file" name="gambar_barang" accept="image/*" id="gambarInput">
          <div class="form-text">
            <i class="fas fa-info-circle me-1"></i>
            Format: JPG, PNG, GIF (Maks. 2MB). Gambar akan ditampilkan di katalog.
          </div>
          <div id="imagePreview" class="mt-3 text-center" style="display: none;">
            <img id="previewImage" class="img-thumbnail" style="max-height: 200px;">
          </div>
        </div>
      </div>

      <!-- Action Buttons -->
      <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-5 pt-3 border-top">
        <a href="<?= base_url('barang') ?>" class="btn btn-bakery-outline me-md-3">
          <i class="fas fa-times me-2"></i> Batal
        </a>
        <button type="submit" class="btn btn-bakery-success">
          <i class="fas fa-cookie-bite me-2"></i> Simpan Kue
        </button>
      </div>
    </form>
  </div>
</div>

<!-- Image Preview Script -->
<script>
document.addEventListener('DOMContentLoaded', function() {
  const gambarInput = document.getElementById('gambarInput');
  const imagePreview = document.getElementById('imagePreview');
  const previewImage = document.getElementById('previewImage');
  
  gambarInput.addEventListener('change', function() {
    const file = this.files[0];
    if (file) {
      const reader = new FileReader();
      
      reader.addEventListener('load', function() {
        previewImage.setAttribute('src', this.result);
        imagePreview.style.display = 'block';
      });
      
      reader.readAsDataURL(file);
    } else {
      imagePreview.style.display = 'none';
    }
  });
});
</script>