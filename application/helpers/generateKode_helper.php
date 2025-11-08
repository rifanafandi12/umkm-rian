    <?php
    defined('BASEPATH') or exit('No direct script access allowed');

    /**
     * Generate kode pembelian random
     * Format default: PREFIX + YYYYMMDD + - + 6 random alphanumeric
     * Contoh hasil: PO-20251101-AB12XZ
     *
     * @param string $prefix
     * @param int $random_length
     * @return string
     */
    if (!function_exists('generate_kode_pembelian')) {
        function generate_kode_pembelian($prefix = 'PO', $random_length = 6)
        {
            $tanggal = date('Ymd');
            $random = strtoupper(substr(md5(uniqid(mt_rand(), true)), 0, $random_length));
            return $prefix . '-' . $tanggal . '-' . $random;
        }
    }

    if (!function_exists('generate_kode_barang')) {
        function generate_kode_barang($prefix = 'BRG', $random_length = 5)
        {
            $tanggal = date('Ymd');
            $random = strtoupper(substr(md5(uniqid(mt_rand(), true)), 0, $random_length));
            return $prefix . '-' . $tanggal . '-' . $random;
        }
    }
