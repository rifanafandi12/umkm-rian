<div class="container py-5">
    <!-- Header dengan tema bakery -->
    <div class="text-center mb-5">
        <div class="bakery-icon mb-3">
            <i class="fas fa-shopping-basket fa-3x text-brown"></i>
        </div>
        <h2 class="fw-bold bakery-title">
            <i class="fas fa-cookie-bite me-2"></i>Keranjang Belanja Kue
        </h2>
        <p class="text-muted">Periksa pesanan manis Anda sebelum checkout</p>
    </div>

    <?php if (empty($cart)): ?>
        <!-- Empty Cart State -->
        <div class="empty-cart text-center py-5">
            <div class="empty-cart-icon mb-4">
                <i class="fas fa-birthday-cake fa-4x text-muted"></i>
            </div>
            <h4 class="text-brown mb-3">
                <i class="fas fa-smile-beam me-2"></i>Keranjang masih kosong!
            </h4>
            <p class="text-muted mb-4">Yuk, isi keranjang dengan kue-kue lezat!</p>
            <a href="<?= site_url('home'); ?>" class="btn btn-bakery-primary btn-lg">
                <i class="fas fa-store me-2"></i>Jelajahi Kue Kami
            </a>
        </div>
    <?php else: ?>

        <!-- Cart Items -->
        <div class="cart-items mb-4">
            <?php 
            $grand_total = 0;
            foreach ($cart as $item):
                $subtotal = $item->harga_barang * $item->quantity;
                $grand_total += $subtotal;
            ?>
                <div class="cart-item-card mb-3" data-kode="<?= $item->kode_barang; ?>" data-harga="<?= $item->harga_barang; ?>">
                    <div class="card bakery-card">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <!-- Product Image -->
                                <div class="col-md-2">
                                    <div class="cart-item-image">
                                        <img src="<?= base_url('uploads/barang/' . $item->gambar_barang); ?>" 
                                             alt="<?= $item->nama_barang; ?>" 
                                             class="img-fluid rounded bakery-image">
                                        <div class="item-badge">KUE</div>
                                    </div>
                                </div>
                                
                                <!-- Product Details -->
                                <div class="col-md-4">
                                    <h5 class="fw-bold text-brown mb-2"><?= $item->nama_barang; ?></h5>
                                    <p class="text-muted mb-1 small"><?= $item->deskripsi ?: 'Kue lezat dengan bahan premium'; ?></p>
                                    <span class="badge bg-cream text-brown">ID: <?= $item->kode_barang; ?></span>
                                </div>
                                
                                <!-- Price -->
                                <div class="col-md-2 text-center">
                                    <div class="price-section">
                                        <span class="price-label text-muted small">Harga Satuan</span>
                                        <div class="harga fw-bold text-accent"><?= rupiah($item->harga_barang, 0, ',', '.'); ?></div>
                                    </div>
                                </div>
                                
                                <!-- Quantity Control -->
                                <div class="col-md-2">
                                    <div class="quantity-control-section">
                                        <span class="quantity-label text-muted small d-block mb-2">Jumlah</span>
                                        <div class="bakery-quantity-control">
                                            <button class="btn btn-outline-bakery decrease-qty">
                                                <i class="fas fa-minus"></i>
                                            </button>
                                            <input type="number" class="form-control text-center quantity" 
                                                   value="<?= $item->quantity; ?>" min="1" max="99">
                                            <button class="btn btn-outline-bakery increase-qty">
                                                <i class="fas fa-plus"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- Subtotal & Actions -->
                                <div class="col-md-2 text-center">
                                    <div class="subtotal-section mb-3">
                                        <span class="subtotal-label text-muted small d-block">Subtotal</span>
                                        <div class="subtotal fw-bold text-accent fs-5"><?= rupiah($subtotal, 0, ',', '.'); ?></div>
                                    </div>
                                    <div class="action-section">
                                        <a href="<?= site_url('cart/remove/' . $item->id); ?>"
                                           class="btn btn-bakery-danger btn-sm"
                                           onclick="return confirm('Hapus <?= $item->nama_barang; ?> dari keranjang?')"
                                           title="Hapus dari keranjang">
                                            <i class="fas fa-trash me-1"></i>Hapus
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <!-- Cart Summary -->
        <div class="row justify-content-end">
            <div class="col-md-5">
                <div class="cart-summary-card">
                    <div class="card bakery-summary-card">
                        <div class="card-header bg-brown text-white">
                            <h5 class="mb-0">
                                <i class="fas fa-receipt me-2"></i>Ringkasan Pesanan
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="summary-item d-flex justify-content-between mb-3">
                                <span class="text-muted">Total Item:</span>
                                <span class="fw-bold" id="total-item"><?= count($cart); ?> item</span>
                            </div>
                            <div class="summary-item d-flex justify-content-between mb-3">
                                <span class="text-muted">Biaya Pengiriman:</span>
                                <span class="fw-bold text-success">Gratis</span>
                            </div>
                            <hr>
                            <div class="summary-total d-flex justify-content-between align-items-center mb-4">
                                <span class="fs-6 text-brown fw-bold">Total Pembayaran:</span>
                                <span class="fs-4 fw-bold text-accent" id="grand-total"><?= rupiah($grand_total, 0, ',', '.'); ?></span>
                            </div>
                            <div class="action-buttons d-grid gap-2">
                                <a href="<?= base_url('home'); ?>" class="btn btn-bakery-outline">
                                    <i class="fas fa-arrow-left me-2"></i>Lanjut Belanja
                                </a>
                                <a href="<?= base_url('checkout'); ?>" class="btn btn-bakery-success btn-lg">
                                    <i class="fas fa-credit-card me-2"></i>Checkout Sekarang
                                </a>
                            </div>
                            <div class="text-center mt-3">
                                <small class="text-muted">
                                    <i class="fas fa-shield-alt me-1"></i>Transaksi 100% Aman & Terjamin
                                </small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    <?php endif; ?>
</div>

<style>
    /* Bakery Theme Styles for Cart */
    .text-brown { color: #8B4513; }
    .text-accent { color: #FF6B6B; }
    .bg-brown { background: linear-gradient(135deg, #8B4513, #A0522D) !important; }
    .bg-cream { background-color: #FFF8F0 !important; }

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
        padding: 12px 30px;
        border-radius: 25px;
        font-weight: 600;
        transition: all 0.3s;
    }

    .btn-bakery-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(255, 107, 107, 0.3);
    }

    .btn-bakery-success {
        background: linear-gradient(135deg, #27AE60, #2ECC71);
        border: none;
        color: white;
        border-radius: 15px;
        font-weight: 600;
        padding: 15px;
    }

    .btn-bakery-outline {
        border: 2px solid #D2691E;
        color: #D2691E;
        background: transparent;
        border-radius: 15px;
        font-weight: 600;
        transition: all 0.3s;
    }

    .btn-bakery-outline:hover {
        background: #D2691E;
        color: white;
    }

    .btn-bakery-danger {
        background: linear-gradient(135deg, #FF6B6B, #FF8E8E);
        border: none;
        color: white;
        border-radius: 10px;
        font-weight: 500;
    }

    .btn-outline-bakery {
        border: 2px solid #D2691E;
        color: #D2691E;
        background: white;
        width: 40px;
        height: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .btn-outline-bakery:hover {
        background: #D2691E;
        color: white;
    }

    .bakery-card {
        border: none;
        border-radius: 20px;
        box-shadow: 0 5px 20px rgba(139, 69, 19, 0.1);
        transition: all 0.3s;
        overflow: hidden;
    }

    .bakery-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 30px rgba(139, 69, 19, 0.15);
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

    .bakery-image {
        height: 100px;
        width: 100px;
        object-fit: cover;
        border: 3px solid #FFF8F0;
        box-shadow: 0 3px 10px rgba(139, 69, 19, 0.1);
    }

    .cart-item-image {
        position: relative;
    }

    .item-badge {
        position: absolute;
        top: -5px;
        right: -5px;
        background: linear-gradient(135deg, #FF6B6B, #FF8E8E);
        color: white;
        padding: 2px 8px;
        border-radius: 10px;
        font-size: 0.7rem;
        font-weight: 600;
    }

    .bakery-quantity-control {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 5px;
    }

    .bakery-quantity-control .form-control {
        width: 60px;
        text-align: center;
        border: 2px solid #D2691E;
        border-radius: 10px;
        font-weight: 600;
        color: #8B4513;
    }

    .bakery-summary-card {
        border: none;
        border-radius: 20px;
        box-shadow: 0 10px 30px rgba(139, 69, 19, 0.15);
        overflow: hidden;
    }

    .empty-cart {
        background: linear-gradient(135deg, #FFF8F0, #FFFFFF);
        border-radius: 20px;
        padding: 60px 40px;
        border: 2px dashed #D2691E;
    }

    .empty-cart-icon {
        opacity: 0.7;
    }

    .price-section, .subtotal-section {
        padding: 10px;
        background: #FFF8F0;
        border-radius: 10px;
    }

    @media (max-width: 768px) {
        .cart-item-card .row > div {
            margin-bottom: 15px;
        }
        .bakery-image {
            height: 80px;
            width: 80px;
        }
    }
</style>

<script>
    $(document).ready(function() {

        // Ubah angka ke format rupiah (tanpa simbol)
        function formatRupiah(angka) {
            return angka.toLocaleString('id-ID');
        }

        // Update subtotal & grand total
        function updateTotals() {
            let grandTotal = 0;
            let totalItems = 0;

            $('.cart-item-card').each(function() {
                const harga = parseInt($(this).data('harga'));
                const qty = parseInt($(this).find('.quantity').val());
                const subtotal = harga * qty;

                $(this).find('.subtotal').text('Rp ' + formatRupiah(subtotal));
                grandTotal += subtotal;
                totalItems += qty;
            });

            $('#grand-total').text('Rp ' + formatRupiah(grandTotal));
            $('#total-item').text(totalItems + ' item');
        }

        // Tombol tambah jumlah
        $(document).on('click', '.increase-qty', function() {
            const itemCard = $(this).closest('.cart-item-card');
            const qtyInput = itemCard.find('.quantity');
            const newQty = parseInt(qtyInput.val()) + 1;
            if (newQty > 99) return;
            qtyInput.val(newQty);

            updateTotals();
            updateServer(itemCard.data('kode'), newQty);
        });

        // Tombol kurang jumlah
        $(document).on('click', '.decrease-qty', function() {
            const itemCard = $(this).closest('.cart-item-card');
            const qtyInput = itemCard.find('.quantity');
            let newQty = parseInt(qtyInput.val()) - 1;
            if (newQty < 1) newQty = 1;
            qtyInput.val(newQty);

            updateTotals();
            updateServer(itemCard.data('kode'), newQty);
        });

        // Input manual
        $(document).on('change', '.quantity', function() {
            const itemCard = $(this).closest('.cart-item-card');
            let newQty = parseInt($(this).val());
            if (newQty < 1) newQty = 1;
            if (newQty > 99) newQty = 99;
            $(this).val(newQty);
            
            updateTotals();
            updateServer(itemCard.data('kode'), newQty);
        });

        // Kirim perubahan ke server
        function updateServer(kode_barang, qty) {
            $.ajax({
                url: "<?= site_url('cart/update_quantity') ?>",
                type: "POST",
                data: {
                    kode_barang: kode_barang,
                    quantity: qty
                },
                dataType: "json",
                success: function(response) {
                    if (response.success) {
                        // Optional: Show success message
                        console.log('Quantity updated successfully');
                    }
                }
            });
        }

        // Initialize totals on page load
        updateTotals();

    });
</script>