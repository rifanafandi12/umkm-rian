<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Toko Kue Manis</title>
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
        
        .login-container {
            background-color: white;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            max-width: 1000px;
            width: 100%;
        }
        
        .login-left {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            color: white;
            padding: 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            position: relative;
        }
        
        .login-left::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-image: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="%23ffffff" fill-opacity="0.1" d="M0,96L48,112C96,128,192,160,288,186.7C384,213,480,235,576,213.3C672,192,768,128,864,128C960,128,1056,192,1152,192C1248,192,1344,128,1392,96L1440,64L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path></svg>');
            background-size: cover;
            background-position: center;
        }
        
        .login-left-content {
            position: relative;
            z-index: 1;
        }
        
        .login-right {
            padding: 40px;
        }
        
        .logo {
            font-size: 28px;
            font-weight: 700;
            margin-bottom: 10px;
            color: var(--primary-color);
        }
        
        .logo i {
            color: var(--secondary-color);
        }
        
        .welcome-text {
            font-size: 24px;
            font-weight: 600;
            margin-bottom: 30px;
            color: #333;
        }
        
        .form-control {
            border-radius: 10px;
            padding: 12px 15px;
            border: 1px solid #e0e0e0;
            margin-bottom: 20px;
            transition: all 0.3s;
        }
        
        .form-control:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.2rem rgba(233, 30, 99, 0.25);
        }
        
        .btn-login {
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
        
        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(233, 30, 99, 0.4);
        }
        
        .forgot-password {
            text-align: right;
            display: block;
            margin-top: 10px;
            color: #666;
            text-decoration: none;
        }
        
        .forgot-password:hover {
            color: var(--primary-color);
        }
        
        .divider {
            display: flex;
            align-items: center;
            margin: 20px 0;
        }
        
        .divider::before, .divider::after {
            content: "";
            flex: 1;
            border-bottom: 1px solid #e0e0e0;
        }
        
        .divider span {
            padding: 0 10px;
            color: #666;
            font-size: 14px;
        }
        
        .social-login {
            display: flex;
            justify-content: center;
            gap: 15px;
            margin-bottom: 20px;
        }
        
        .social-btn {
            width: 45px;
            height: 45px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 1px solid #e0e0e0;
            background: white;
            color: #666;
            transition: all 0.3s;
        }
        
        .social-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 10px rgba(0, 0, 0, 0.1);
        }
        
        .signup-link {
            text-align: center;
            margin-top: 20px;
            color: #666;
        }
        
        .signup-link a {
            color: var(--primary-color);
            text-decoration: none;
            font-weight: 600;
        }
        
        .cake-icon {
            font-size: 80px;
            margin-bottom: 20px;
            color: var(--light-color);
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
        
        @media (max-width: 768px) {
            .login-left {
                padding: 30px 20px;
            }
            
            .login-right {
                padding: 30px 20px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="login-container">
            <div class="row g-0">
                <div class="col-lg-6 login-left">
                    <div class="login-left-content">
                        <div class="text-center mb-4">
                            <i class="fas fa-birthday-cake cake-icon"></i>
                        </div>
                        <h2 class="text-center mb-4">Selamat Datang di Toko Kue Manis</h2>
                        <p class="text-center mb-4">Tempat terbaik untuk menemukan kue lezat dan spesial untuk setiap momen berharga Anda.</p>
                        
                        <ul class="feature-list">
                            <li><i class="fas fa-check-circle"></i> Kue berkualitas premium</li>
                            <li><i class="fas fa-check-circle"></i> Bahan-bahan terbaik</li>
                            <li><i class="fas fa-check-circle"></i> Desain kue custom</li>
                            <li><i class="fas fa-check-circle"></i> Pengiriman tepat waktu</li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-6 login-right">
                    <div class="logo text-center">
                        <i class="fas fa-birthday-cake"></i> Toko Kue Manis
                    </div>
                    <h3 class="welcome-text text-center">Masuk ke Akun Anda</h3>
                    
                    <form id="loginForm" method="post" action="<?= site_url('auth/go_login'); ?>">
                        <div class="mb-3">
                            <label for="username" class="form-label">Username</label>
                            <input type="username" class="form-control" name="username" id="username" placeholder="usernamecontoh" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Kata Sandi</label>
                            <input type="password" class="form-control" name="password" id="password" placeholder="Masukkan kata sandi" required>
                        </div>
                        
                        <button type="submit" class="btn btn-login">Masuk</button>
                        
                    </form>
                    
                    <div class="signup-link">
                        Belum punya akun? <a href="<?= site_url('auth/register'); ?>">Daftar di sini</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php $this->load->view('alert'); ?>


    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    
</body>
</html>