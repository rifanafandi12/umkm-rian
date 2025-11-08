<script>
    $(document).ready(function() {

        $('#btnCari').click(function() {
            var keyword = $('#keyword').val();

            $.ajax({
                url: "<?= site_url('search') ?>",
                method: 'post',
                data: {
                    keyword: keyword
                },
                success: function(data) {
                    $('#product-list').html(data);
                }
            })
        });
        // tekan ENTER di input pencarian
        $('#keyword').on('keypress', function(e) {
            if (e.which === 13) { // 13 = kode tombol Enter
                e.preventDefault(); // mencegah form submit default
                $('#btnCari').click(); // jalankan fungsi tombol cari
            }
        });
    })
</script>
<script>
    $(document).ready(function() {
        $('.btnShow').click(function() {
            const kode = $(this).data("kode");

            function rupiah(angka) {
                return 'Rp ' + Number(angka).toLocaleString('id-ID');
            }

            const $quantityInput = $('#quantity');
            const $decreaseBtn = $('#decrease-qty');
            const $increaseBtn = $('#increase-qty');

            let harga_barang = 0; // diset setelah AJAX
            let jumlah = parseInt($quantityInput.val()) || 1;

            // Fungsi untuk update total harga
            function updateTotal() {
                jumlah = parseInt($quantityInput.val()) || 1;
                const total_harga = harga_barang * jumlah;
                $('#total-harga').text(rupiah(total_harga)); // pastikan ada elemen ini di HTML
            }

            // Tombol minus
            $decreaseBtn.off('click').on('click', function() {
                let currentValue = parseInt($quantityInput.val()) || 1;
                if (currentValue > 1) {
                    $quantityInput.val(currentValue - 1).trigger('change');
                }
            });

            // Tombol plus
            $increaseBtn.off('click').on('click', function() {
                let currentValue = parseInt($quantityInput.val()) || 0;
                $quantityInput.val(currentValue + 1).trigger('change');
            });

            // Update total setiap kali jumlah berubah
            $quantityInput.off('change').on('change', function() {
                updateTotal();
            });

            // Ambil data barang lewat AJAX
            $.ajax({
                url: "<?= site_url('barang/getBarangById') ?>",
                data: {
                    kode: kode
                },
                method: 'POST',
                dataType: 'json',
                success: function(data) {
                    const nama_barang = data.nama_barang;
                    harga_barang = data.harga_barang; // simpan harga ke variabel global
                    const total_harga = harga_barang * jumlah;

                    $('#productModal img').attr('src', "<?= base_url('uploads/barang/') ?>" + data.gambar_barang);
                    $('#productModal h3').text(nama_barang);
                    $('#productModal h2').text(rupiah(harga_barang));
                    $('#productModal .deskripsi').text(data.deskripsi);
                    $('#total-harga').text(rupiah(total_harga)); // tampilkan total pertama kali

                    const nama_pembeli = "<?= $this->session->userdata('nama'); ?>";
                    const alamat = "<?= $this->session->userdata('alamat'); ?>";

                    $('#btnKeranjang').off('click').on('click', function(e) {
                        e.preventDefault();
                        $.ajax({
                            url: "<?= site_url('cart/add') ?>",
                            data: {
                                kode_barang: data.kode_barang,
                                quantity: jumlah
                            },
                            method: 'POST',
                            dataType: 'json',
                            success: function(response) {
                                window.location.href = "<?= base_url('home') ?>";
                            }
                        });
                    });

                    $('#btnBeli').off('click').on('click', function(e) {
                        e.preventDefault();

                        const total_harga_fix = harga_barang * jumlah;
                        const nomor = "681269766179";

                        const pesan =
                            "Hallo saya ingin memesan:\n\n" +
                            "Nama: " + nama_pembeli + "\n" +
                            "Produk: " + nama_barang + "\n" +
                            "Jumlah: " + jumlah + "\n" +
                            "Total: " + rupiah(total_harga_fix) + "\n" +
                            "Alamat: " + alamat + "\n\n" +
                            "Terimakasih.\n";

                        const encodedPesan = encodeURIComponent(pesan);
                        const url = "https://wa.me/" + nomor + "?text=" + encodedPesan;
                        window.open(url, '_blank');
                    });
                }
            });
        });
    });
</script>