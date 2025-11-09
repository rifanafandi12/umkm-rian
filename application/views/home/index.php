     <!-- Hero Section -->
     <section class="hero-section">
         <div class="container">
             <h1>Selamat Datang di Waroeng Kue Ucup</h1>
             <p>Rasa Autentik, Kenangan Manis dalam Setiap Gigitan</p>
             <a href="#products" class="btn btn-primary btn-lg">
                 <i class="fas fa-utensils me-2"></i>Jelajahi Kue Kami
             </a>
         </div>
     </section>

     <!-- Products Section -->
     <section id="products" class="container">
         <h2 class="section-title">Kue & Roti Terbaru</h2>

         <div class="row" id="product-list">
             <?php foreach ($barangs as $brg): ?>
                 <div class="col-lg-3 col-md-4 col-sm-6">
                     <div class="card" id="cardBarang">
                         <div class="position-relative">
                             <img class="img-fluid rounded-top" src="<?= base_url('uploads/barang/') . $brg['gambar_barang']; ?>" alt="gambar<?= $brg['nama_barang']; ?>">
                             <span class="badge-category"><?= $brg['jenis']; ?></span>
                         </div>
                         <div class="card-body">
                             <h5 class="card-title"><?= $brg['nama_barang']; ?></h5>
                             <p class="card-text"><?= $brg['deskripsi']; ?></p>
                             <div class="d-flex justify-content-between align-items-center">
                                 <span class="price"><?= rupiah($brg['harga_barang']); ?></span>
                                 <button class="btn btn-primary btn-sm btnShow"
                                     data-kode="<?= $brg['kode_barang']; ?>"
                                     data-bs-toggle="modal"
                                     data-bs-target="#productModal">
                                     <i class="fas fa-shopping-cart me-1"></i> Pesan
                                 </button>
                             </div>
                         </div>
                     </div>
                 </div>
             <?php endforeach; ?>
         </div>
     </section>
     <!-- Product Detail Modal -->
     <div class="modal fade product-detail-modal" id="productModal" tabindex="-1" aria-hidden="true">
         <div class="modal-dialog modal-lg">
             <div class="modal-content">
                 <div class="modal-header">
                     <h5 class="modal-title">Detail Kue</h5>
                     <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                 </div>
                 <div class="modal-body">
                     <div class="row">
                         <div class="col-md-6">
                             <img src="https://images.unsplash.com/photo-1578985545062-69928b1d9587?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=60" class="img-fluid rounded" alt="Kue Spesial">
                         </div>
                         <div class="col-md-6">
                             <h3>Red Velvet Cake Premium</h3>
                             <div class="rating mb-3">
                                 <i class="fas fa-star text-warning"></i>
                                 <i class="fas fa-star text-warning"></i>
                                 <i class="fas fa-star text-warning"></i>
                                 <i class="fas fa-star text-warning"></i>
                                 <i class="fas fa-star-half-alt text-warning"></i>
                                 <span class="ms-2">4.5 (128 ulasan)</span>
                             </div>
                             <h2 class="price mb-3">Rp 189.000</h2>
                             <p class="deskripsi">Kue red velvet lembut dengan cream cheese frosting yang creamy. Dibuat dengan bahan premium dan tanpa pengawet.</p>

                             <div class="quantity-control">
                                 <div class="row ">
                                     <div class="col-lg-2">
                                         <button class="btn btn-outline-secondary" id="decrease-qty">-</button>
                                     </div>
                                     <div class="col-lg-6">
                                         <input type="number" class="form-control text-center" id="quantity" value="1" min="1">
                                     </div>
                                     <div class="col-lg-2">
                                         <button class="btn btn-outline-secondary" id="increase-qty">+</button>

                                     </div>
                                 </div>
                             </div>

                             <div class="d-grid gap-2 d-md-flex justify-content-md-start mt-4">
                                 <button class="btn btn-primary me-md-2" id="btnKeranjang">
                                     <i class="fas fa-shopping-cart me-2"></i> Tambah ke Keranjang
                                 </button>
                                 <button class="btn btn-outline-primary" id="btnBeli">
                                     Pesan Sekarang
                                 </button>
                             </div>
                         </div>
                     </div>
                 </div>
             </div>
         </div>
     </div>

     <?php $this->load->view('home/scriptModal'); ?>