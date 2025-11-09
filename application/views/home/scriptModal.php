<script>
$(document).ready(function() {

    // Tombol cari
    $('#btnCari').click(function() {
        var keyword = $('#keyword').val();

        $.ajax({
            url: "<?= site_url('search') ?>",
            method: 'POST',
            data: { keyword: keyword },
            success: function(data) {
                $('#product-list').html(data);
            }
        });
    });

    // Tekan ENTER untuk cari
    $('#keyword').on('keypress', function(e) {
        if (e.which === 13) {
            e.preventDefault();
            $('#btnCari').click();
        }
    });

    // Delegasi event ke document (penting!)
    $(document).on('click', '.btnShow', function() {
        const kode = $(this).data("kode");

        function rupiah(angka) {
            return 'Rp ' + Number(angka).toLocaleString('id-ID');
        }

        $.ajax({
            url: "<?= site_url('barang/getBarangById') ?>",
            data: { kode: kode },
            method: 'POST',
            dataType: 'json',
            success: function(data) {
                const nama_barang = data.nama_barang;
                const harga_barang = data.harga_barang;
                let jumlah = 1;
                const total_harga = harga_barang * jumlah;

                // Tampilkan modal produk
                $('#productModal img').attr('src', "<?= base_url('uploads/barang/') ?>" + data.gambar_barang);
                $('#productModal h3').text(nama_barang);
                $('#productModal h2').text(rupiah(harga_barang));
                $('#productModal .deskripsi').text(data.deskripsi);
                $('#total-harga').text(rupiah(total_harga));

                const nama_pembeli = "<?= $this->session->userdata('nama'); ?>";
                const alamat = "<?= $this->session->userdata('alamat'); ?>";

                const $quantityInput = $('#quantity');
                const $decreaseBtn = $('#decrease-qty');
                const $increaseBtn = $('#increase-qty');

                function updateTotal() {
                    jumlah = parseInt($quantityInput.val()) || 1;
                    $('#total-harga').text(rupiah(harga_barang * jumlah));
                }

                $decreaseBtn.off('click').on('click', function() {
                    let val = parseInt($quantityInput.val()) || 1;
                    if (val > 1) $quantityInput.val(val - 1).trigger('change');
                });

                $increaseBtn.off('click').on('click', function() {
                    let val = parseInt($quantityInput.val()) || 0;
                    $quantityInput.val(val + 1).trigger('change');
                });

                $quantityInput.off('change').on('change', function() {
                    updateTotal();
                });

                // Tombol Tambah ke Keranjang
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

                // Tombol Beli
                $('#btnBeli').off('click').on('click', function(e) {
                    e.preventDefault();
                    const total_harga_fix = harga_barang * jumlah;

                    $.ajax({
                        url: "<?= site_url('home/beli') ?>",
                        data: {
                            kode_barang: data.kode_barang,
                            jumlah_barang: jumlah,
                            nama_barang: nama_barang,
                            harga_barang: harga_barang,
                            total_harga: total_harga_fix
                        },
                        method: 'POST',
                        dataType: 'json',
                        success: function(response) {
                            Swal.fire({
                                icon: response.status === 'success' ? 'success' : 'error',
                                title: response.status === 'success' ? 'Berhasil!' : 'Gagal!',
                                text: response.message,
                                showConfirmButton: false,
                                timer: 1500
                            }).then(() => {
                                const nomor = "6281269766179";
                                const pesan =
                                    "Hallo saya ingin memesan:\n\n" +
                                    "Nama: " + nama_pembeli + "\n" +
                                    "Produk: " + nama_barang + "\n" +
                                    "Jumlah: " + jumlah + "\n" +
                                    "Total: " + rupiah(total_harga_fix) + "\n" +
                                    "Alamat: " + alamat + "\n\n" +
                                    "Terimakasih.\n";
                                const encodedPesan = encodeURIComponent(pesan);
                                window.open("https://wa.me/" + nomor + "?text=" + encodedPesan, '_blank');
                            });
                        }
                    });
                });
            }
        });
    });
});
</script>
