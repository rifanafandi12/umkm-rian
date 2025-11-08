<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bakery Delight - Tokoh Kue Rian</title>
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        :root {
            --primary-color: #8B4513;
            --secondary-color: #D2691E;
            --accent-color: #FF6B6B;
            --light-color: #FFF8F0;
            --cream-color: #FFF5E1;
            --brown-color: #5D4037;
        }

        body {
            font-family: 'Poppins', 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: var(--light-color);
            color: #5D4037;
            background-image: url('data:image/svg+xml,<svg width="100" height="100" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg"><circle cx="50" cy="50" r="2" fill="%23f0e6d2" opacity="0.3"/></svg>');
        }

        .navbar {
            background: linear-gradient(135deg, var(--primary-color), var(--brown-color));
            box-shadow: 0 4px 20px rgba(139, 69, 19, 0.2);
            padding: 15px 0;
        }

        .navbar-brand {
            font-weight: 700;
            color: white !important;
            font-size: 1.5rem;
        }

        .nav-link {
            color: rgba(255, 255, 255, 0.9) !important;
            font-weight: 500;
            transition: all 0.3s;
            margin: 0 10px;
            border-radius: 25px;
            padding: 8px 20px !important;
        }

        .nav-link:hover, .nav-link.active {
            color: white !important;
            background-color: rgba(255, 255, 255, 0.2);
            transform: translateY(-2px);
        }

        .hero-section {
            background: linear-gradient(rgba(139, 69, 19, 0.7), rgba(210, 105, 30, 0.7)), url('https://images.unsplash.com/photo-1509440159596-0249088772ff?ixlib=rb-4.0.3&auto=format&fit=crop&w=1350&q=80');
            background-size: cover;
            background-position: center;
            color: white;
            padding: 120px 0;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .hero-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg width="100" height="100" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg"><path d="M30,30 Q50,10 70,30 T100,50" fill="none" stroke="white" stroke-width="2" opacity="0.1"/></svg>');
        }

        .hero-section h1 {
            font-weight: 700;
            margin-bottom: 20px;
            font-size: 3.5rem;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
        }

        .hero-section p {
            font-size: 1.3rem;
            margin-bottom: 30px;
            text-shadow: 1px 1px 2px rgba(0,0,0,0.3);
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--secondary-color), var(--accent-color));
            border: none;
            padding: 12px 30px;
            font-weight: 600;
            border-radius: 25px;
            transition: all 0.3s;
            box-shadow: 0 4px 15px rgba(255, 107, 107, 0.3);
        }

        .btn-primary:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 20px rgba(255, 107, 107, 0.4);
            background: linear-gradient(135deg, var(--accent-color), var(--secondary-color));
        }

        .section-title {
            text-align: center;
            margin: 80px 0 50px;
            position: relative;
            color: var(--brown-color);
            font-weight: 700;
        }

        .section-title:after {
            content: '';
            display: block;
            width: 100px;
            height: 4px;
            background: linear-gradient(90deg, var(--secondary-color), var(--accent-color));
            margin: 20px auto;
            border-radius: 2px;
        }

        .card {
            border: none;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(139, 69, 19, 0.1);
            transition: all 0.4s;
            margin-bottom: 30px;
            overflow: hidden;
            background: white;
            position: relative;
        }

        .card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, var(--secondary-color), var(--accent-color));
        }

        .card:hover {
            transform: translateY(-15px) scale(1.02);
            box-shadow: 0 20px 40px rgba(139, 69, 19, 0.2);
        }

        .card-img-top {
            height: 220px;
            object-fit: cover;
            transition: transform 0.5s;
        }

        .card:hover .card-img-top {
            transform: scale(1.1);
        }

        .card-body {
            padding: 25px;
        }

        .card-title {
            font-weight: 600;
            margin-bottom: 12px;
            color: var(--brown-color);
            font-size: 1.1rem;
        }

        .card-text {
            color: #8D6E63;
            margin-bottom: 15px;
            font-size: 0.9rem;
            line-height: 1.5;
        }

        .price {
            font-weight: 700;
            color: var(--accent-color);
            font-size: 1.3rem;
        }

        .badge-category {
            position: absolute;
            top: 15px;
            right: 15px;
            background: linear-gradient(135deg, var(--accent-color), #FF8E8E);
            color: white;
            padding: 6px 12px;
            border-radius: 15px;
            font-size: 0.75rem;
            font-weight: 600;
            box-shadow: 0 2px 8px rgba(255, 107, 107, 0.3);
        }

        .footer {
            background: linear-gradient(135deg, var(--primary-color), var(--brown-color));
            color: white;
            padding: 60px 0 20px;
            margin-top: 80px;
            position: relative;
        }

        .footer::before {
            content: '';
            position: absolute;
            top: -10px;
            left: 0;
            right: 0;
            height: 20px;
            background: url('data:image/svg+xml,<svg viewBox="0 0 100 10" xmlns="http://www.w3.org/2000/svg"><path d="M0,0 Q25,10 50,0 T100,0 L100,10 L0,10 Z" fill="%238B4513"/></svg>');
        }

        .footer h5 {
            margin-bottom: 20px;
            font-weight: 600;
            color: var(--cream-color);
        }

        .footer ul {
            padding-left: 0;
            list-style: none;
        }

        .footer ul li {
            margin-bottom: 12px;
        }

        .footer ul li a {
            color: rgba(255, 248, 240, 0.8);
            text-decoration: none;
            transition: color 0.3s;
        }

        .footer ul li a:hover {
            color: var(--cream-color);
            padding-left: 5px;
        }

        .copyright {
            border-top: 1px solid rgba(255, 248, 240, 0.2);
            padding-top: 25px;
            margin-top: 40px;
            text-align: center;
            color: rgba(255, 248, 240, 0.7);
        }

        .cart-badge {
            position: absolute;
            top: -8px;
            right: -8px;
            background: var(--accent-color);
            color: white;
            border-radius: 50%;
            width: 22px;
            height: 22px;
            font-size: 0.75rem;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            box-shadow: 0 2px 5px rgba(255, 107, 107, 0.3);
        }

        .product-detail-modal .modal-content {
            border-radius: 20px;
            overflow: hidden;
            border: none;
            box-shadow: 0 25px 50px rgba(139, 69, 19, 0.3);
        }

        .product-detail-modal .modal-header {
            border-bottom: none;
            padding: 25px 25px 0;
            background: linear-gradient(135deg, var(--cream-color), white);
        }

        .product-detail-modal .modal-body {
            padding: 25px;
        }

        .quantity-control {
            display: flex;
            align-items: center;
            margin: 25px 0;
            justify-content: center;
        }

        .quantity-control button {
            width: 45px;
            height: 45px;
            border: 2px solid var(--secondary-color);
            background-color: white;
            color: var(--secondary-color);
            font-size: 1.3rem;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            transition: all 0.3s;
        }

        .quantity-control button:hover {
            background-color: var(--secondary-color);
            color: white;
        }

        .quantity-control input {
            width: 70px;
            height: 45px;
            text-align: center;
            border: 2px solid var(--secondary-color);
            margin: 0 15px;
            border-radius: 10px;
            font-weight: 600;
            color: var(--brown-color);
        }

        .search-box .form-control {
            border-radius: 25px;
            border: 2px solid var(--secondary-color);
            padding: 10px 20px;
        }

        .search-box .input-group-text {
            border-radius: 0 25px 25px 0;
            background: var(--secondary-color);
            border: 2px solid var(--secondary-color);
            color: white;
            cursor: pointer;
        }

        .nav-icon {
            color: white;
            font-size: 1.3rem;
            transition: all 0.3s;
        }

        .nav-icon:hover {
            color: var(--cream-color);
            transform: scale(1.1);
        }

        .special-offer {
            background: linear-gradient(135deg, #FFEAA7, #FFD43B);
            padding: 3px 10px;
            border-radius: 15px;
            font-size: 0.8rem;
            font-weight: 600;
            color: var(--brown-color);
            margin-left: 10px;
        }

        @media (max-width: 768px) {
            .hero-section {
                padding: 80px 0;
            }

            .hero-section h1 {
                font-size: 2.5rem;
            }
            
            .nav-link {
                margin: 5px 0;
                text-align: center;
            }
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark sticky-top">
        <div class="container">
            <a class="navbar-brand" href="<?= base_url('home'); ?>">
                <i class="fas fa-birthday-cake me-2"></i>Tokoh Kue Rian
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="<?= base_url('home'); ?>">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('home'); ?>#products">Kue & Roti</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('home'); ?>#kontak">Kontak</a>
                    </li>
                   
                </ul>
                <div class="d-flex">
                    <?php if ($this->uri->segment(1) == 'home') : ?>
                        <div class="search-box me-3">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Cari kue favorit..." id="keyword">
                                <button type="button" class="input-group-text" id="btnCari">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </div>
                    <?php endif ?>
                    <div class="nav-item dropdown">
                        <a class="nav-link position-relative" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown">
                            <i class="fas fa-shopping-basket nav-icon"></i>
                            <span class="cart-badge"><?= $count_cart; ?></span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="<?= base_url('cart'); ?>"><i class="fas fa-shopping-basket me-2"></i>Keranjang Belanja</a></li>
                            <li><a class="dropdown-item" href="<?= base_url('riwayat_pembelian'); ?>"><i class="fas fa-history me-2"></i>Riwayat Belanja</a></li>
                        </ul>
                    </div>
                    <?php if (!empty($this->session->userdata('logged_in'))) : ?>
                        <div class="nav-item dropdown ms-3">
                            <a class="nav-link" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown">
                                <i class="fas fa-user-circle nav-icon"></i>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item" href="<?= site_url('auth/logout'); ?>"><i class="fas fa-sign-out-alt me-2"></i>Keluar</a></li>
                            </ul>
                        </div>
                    <?php endif ?>
                </div>
            </div>
        </div>
    </nav>

   