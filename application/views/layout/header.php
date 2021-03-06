<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Jekyll v4.1.1">
    <title><?= $title;  ?>| Rent CI</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/4.5/examples/navbar-fixed/">

    <!-- Bootstrap core CSS -->
    <link href="<?= base_url('/assets/libs/bootstrap/css/'); ?>bootstrap.min.css" rel="stylesheet">

    <!-- font awesome -->
    <link rel="stylesheet" href="<?= base_url('/assets/libs/fontawesome/'); ?>css/all.min.css">

    <!-- Favicons -->
    <link rel="apple-touch-icon" href="/docs/4.5/assets/img/favicons/apple-touch-icon.png" sizes="180x180">
    <link rel="icon" href="/docs/4.5/assets/img/favicons/favicon-32x32.png" sizes="32x32" type="image/png">
    <link rel="icon" href="/docs/4.5/assets/img/favicons/favicon-16x16.png" sizes="16x16" type="image/png">
    <link rel="manifest" href="/docs/4.5/assets/img/favicons/manifest.json">
    <link rel="mask-icon" href="/docs/4.5/assets/img/favicons/safari-pinned-tab.svg" color="#563d7c">
    <link rel="icon" href="<?= base_url('assets/images/icon/logo.png') ?>">
    <meta name="msapplication-config" content="/docs/4.5/assets/img/favicons/browserconfig.xml">
    <meta name="theme-color" content="#563d7c">


    <style>
        html {
            padding-bottom: 80px;
        }

        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
        }

        .active-navigation {
            color: blue !important;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }

        /* Show it is fixed to the top */
        body {
            min-height: 75rem;
            padding-top: 4.5rem;
        }
    </style>
    <!-- Custom styles for this template -->
    <link href="navbar-top-fixed.css" rel="stylesheet">
</head>

<body>
    <nav class="navbar navbar-expand-md navbar-light fixed-top bg-light">
        <div class="container">
            <a class="navbar-brand" href="<?= base_url() ?>">
                <img class="d-block mx-auto" style="width: 35px;" src="<?= base_url('assets/images/icon/logo.png') ?>" alt="">
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a class="nav-link  <?php if ($this->uri->segment(1) == '') {
                                                echo "active";
                                            } ?>" href="<?= base_url() ?>">Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link
                        <?php if ($this->uri->segment(1) == 'product') {
                            echo "active";
                        } ?>
                        " href="<?= base_url('product') ?>">Produk</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link  <?php if ($this->uri->segment(1) == 's_k') {
                                                echo "active";
                                            } ?>" href="<?= base_url('s_k') ?>">Syarat & Ketentuan</a>
                    </li>
                </ul>
                <ul class="navbar-nav">

                    <?php if (!$this->session->userdata('email')) :  ?>
                        <li class="nav-item">
                            <a href="<?= base_url('auth') ?>" class="nav-link">Login</a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url('auth/registration') ?>" class="nav-link">Register</a>
                        </li>
                    <?php else : ?>
                        <li class="nav-item">
                            <a href="<?= base_url('member/cart') ?>" class="nav-link text-info"><i class="fas fa-shopping-cart"></i> Rent(<?= getCart() ?>)</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a href="" class="nav-link dropdown-toggle" id="dropdown-2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?= ucwords($this->session->userdata('name'))  ?></a>
                            <div class="dropdown-menu" aria-labelledby="dropdown-2">
                                <a href="<?= base_url('member/profile') ?>" class="dropdown-item <?php if ($this->uri->segment(2) == 'profile') {
                                                                                                        echo "active";
                                                                                                    } ?>">Profile</a>
                                <a href="<?= base_url('member/my_orders') ?>" class="dropdown-item <?php if ($this->uri->segment(2) == 'my_orders') {
                                                                                                        echo "active";
                                                                                                    } ?>">Daftar Sewa</a>
                                <a href="<?= base_url('member/profile/change_password') ?>" class="dropdown-item">Ubah Password</a>
                                <a href="<?= base_url('auth/logout') ?>" class="dropdown-item">Logout</a>
                            </div>
                        </li>
                    <?php endif ?>

                </ul>
            </div>
        </div>
    </nav>