<?php if ($this->session->flashdata('success')): ?>
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: '<?= $this->session->flashdata('success'); ?>',
            timer: 2000,
            showConfirmButton: false
        });
    </script>
<?php elseif ($this->session->flashdata('error')) : ?>
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Oops...!',
            text: '<?= $this->session->flashdata('error'); ?>',
            timer: 2000,
            showConfirmButton: false
        });
    </script>
<?php endif; ?>