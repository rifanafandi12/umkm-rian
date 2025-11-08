<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar - Tokoh Kue Rian</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        :root {
            --primary-color: #e91e63;
            --secondary-color: #ff9800;
            --accent-color: #ffeb3b;
            --light-color: #fff9c4;
        }
        
        body {
            background: linear-gradient(135deg, #f5f7fa 0%, #ffeef8 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        .register-container {
            background-color: white;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            max-width: 1000px;
            width: 100%;
        }
        
        .register-left {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            color: white;
            padding: 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            position: relative;
        }
        
        .register-left-content {
            position: relative;
            z-index: 1;
        }
        
        .register-right {
            padding: 40px;
        }
        
        .logo {
            font-size: 28px;
            font-weight: 700;
            margin-bottom: 10px;
            color: var(--primary-color);
            text-align: center;
        }
        
        .logo i {
            color: var(--secondary-color);
        }
        
        .welcome-text {
            font-size: 24px;
            font-weight: 600;
            margin-bottom: 30px;
            color: #333;
            text-align: center;
        }
        
        .form-control {
            border-radius: 10px;
            padding: 12px 15px;
            border: 1px solid #e0e0e0;
            transition: all 0.3s;
        }
        
        .form-control:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.2rem rgba(233, 30, 99, 0.25);
        }
        
        .btn-register {
            background: linear-gradient(to right, var(--primary-color), var(--secondary-color));
            border: none;
            color: white;
            padding: 12px;
            border-radius: 10px;
            font-weight: 600;
            width: 100%;
            margin-top: 10px;
            transition: all 0.3s;
        }
        
        .btn-register:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(233, 30, 99, 0.4);
        }
        
        .login-link {
            text-align: center;
            display: block;
            margin-top: 20px;
            color: #666;
        }
        
        .login-link a {
            color: var(--primary-color);
            text-decoration: none;
            font-weight: 600;
        }
        
        .cake-icon {
            font-size: 80px;
            margin-bottom: 20px;
            color: var(--light-color);
            text-align: center;
        }
        
        .feature-list {
            list-style: none;
            padding: 0;
        }
        
        .feature-list li {
            margin-bottom: 15px;
            display: flex;
            align-items: center;
        }
        
        .feature-list i {
            margin-right: 10px;
            color: var(--light-color);
            font-size: 18px;
        }
        
        .form-check-input:checked {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }
        
        .input-group-text {
            background-color: #f8f9fa;
            border: 1px solid #e0e0e0;
            border-right: none;
            min-width: 70px;
            justify-content: center;
            font-weight: 500;
        }
        
        .phone-input {
            border-left: none;
            padding-left: 5px;
        }
        
        .input-group {
            margin-bottom: 20px;
        }
        
        
        .password-container {
            position: relative;
        }
        
        @media (max-width: 768px) {
            .register-left {
                padding: 30px 20px;
            }
            
            .register-right {
                padding: 30px 20px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="register-container">
            <div class="row g-0">
                <div class="col-lg-6 register-left">
                    <div class="register-left-content">
                        <div class="text-center mb-4">
                            <i class="fas fa-birthday-cake cake-icon"></i>
                        </div>
                        <h2 class="text-center mb-4">Bergabung dengan Tokoh Kue Rian</h2>
                        <p class="text-center mb-4">Daftar sekarang dan nikmati berbagai keuntungan sebagai member kami.</p>
                        
                        <ul class="feature-list">
                            <li><i class="fas fa-check-circle"></i> Akses ke katalog kue eksklusif</li>
                            <li><i class="fas fa-check-circle"></i> Penawaran khusus dan diskon member</li>
                            <li><i class="fas fa-check-circle"></i> Pesanan lebih cepat dengan riwayat</li>
                            <li><i class="fas fa-check-circle"></i> Poin reward untuk setiap pembelian</li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-6 register-right">
                    <div class="logo">
                        <i class="fas fa-birthday-cake"></i> Tokoh Kue Rian
                    </div>
                    
                    <h3 class="welcome-text text-center">Buat Akun Baru</h3>
                    
                    <form id="register-form" method="post" action="<?= site_url('auth/go_register'); ?>">
                        <div class="mb-3">
                            <label for="full-name" class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
                            <input type="text" name="nama" class="form-control" id="full-name" placeholder="Masukkan nama lengkap" required>
                        </div>
                        
                        <div class="mb-3">
                            <label for="username" class="form-label">Username <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="username" id="username" placeholder="Pilih username unik" required>
                            <div class="form-text">Username akan digunakan untuk login</div>
                        </div>
                        
                        <div class="mb-3">
                            <label for="phone" class="form-label">Nomor Handphone <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text">+62</span>
                                <input type="number" class="form-control phone-input" name="no_hp" id="phone" placeholder="8123456789" required>
                            </div>
                            <div class="form-text">Contoh: 8123456789 (akan menjadi +628123456789)</div>
                        </div>
                        
                        
                        <div class="mb-3 password-container">
                            <label for="register-password" class="form-label">Kata Sandi <span class="text-danger">*</span></label>
                            <input type="password" class="form-control" id="register-password" name="password" placeholder="password" required>
                        </div>
                        
                        <div class="mb-3">
                            <label for="address" class="form-label">Alamat <span class="text-danger">*</span></label>
                            <textarea class="form-control" id="address" rows="3" name="alamat" placeholder="Masukkan alamat lengkap" required></textarea>
                        </div>
                        
                        <button type="submit" class="btn btn-register">Daftar Sekarang</button>
                        
                        <div class="login-link">
                            Sudah punya akun? <a href="<?= site_url('auth'); ?>">Masuk di sini</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <?php $this->load->view('alert'); ?>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    
  
</body>
</html>