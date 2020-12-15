<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Jekyll v4.1.1">
    <title><?= $title ?></title>


    <!-- Bootstrap core CSS -->
    <link href="<?= base_url('assets/libs/bootstrap/css/') ?>bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">


    <!-- font awesome -->
    <link href="<?= base_url('assets/libs/fontawesome/css/all.min.css') ?>" rel="stylesheet">

    <!-- Favicons -->
    <link rel="apple-touch-icon" href="/docs/4.5/assets/img/favicons/apple-touch-icon.png" sizes="180x180">
    <link rel="icon" href="/docs/4.5/assets/img/favicons/favicon-32x32.png" sizes="32x32" type="image/png">
    <link rel="icon" href="/docs/4.5/assets/img/favicons/favicon-16x16.png" sizes="16x16" type="image/png">
    <link rel="manifest" href="/docs/4.5/assets/img/favicons/manifest.json">
    <link rel="mask-icon" href="/docs/4.5/assets/img/favicons/safari-pinned-tab.svg" color="#563d7c">
    <link rel="icon" href="/docs/4.5/assets/img/favicons/favicon.ico">
    <meta name="msapplication-config" content="/docs/4.5/assets/img/favicons/browserconfig.xml">
    <meta name="theme-color" content="#563d7c">


    <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }

        .fa-cog {
            color: cadetblue;
        }
    </style>
    <!-- Custom styles for this template -->
    <link href="<?= base_url('assets/css/dashboard.css') ?>" rel="stylesheet">
</head>

<?php

$data = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();



?>

<body>
    <nav class="navbar navbar-dark sticky-top bg-light flex-md-nowrap p-0">
        <a class="navbar-brand col-md-3 col-lg-2 mr-0 px-3" href="#">
            <img class="img-thumbnail" style="width: 30px;" src="<?= base_url('assets/images/profil/') . $data['image']   ?>" alt="">
            <?= ucwords($this->session->userdata('name')) ?>
        </a>
        <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-toggle="collapse" data-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <ul class="navbar-nav px-3">
            <li class="nav-item text-nowrap">
                <a class="nav-link" href="#" data-toggle="modal" data-target="#exampleModal">
                    <i class="fas fa-cog fa-2x"></i>
                </a>
            </li>
        </ul>
    </nav>
    <div class="container-fluid">
        <div class="row">
            <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
                <div class="sidebar-sticky pt-3">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a href="<?= base_url('admin/dashboard')  ?>" class="nav-link <?php if ($this->uri->segment(2) == 'dashboard') {
                                                                                                echo "active";
                                                                                            } ?> " href="#">
                                <span data-feather="home"></span>
                                Dashboard <span class="sr-only">(current)</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php if ($this->uri->segment(2) == 'orders') {
                                                    echo "active";
                                                } ?> " href="<?= base_url('admin/orders') ?>">
                                <span data-feather="shopping-cart"></span>
                                Orders
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php if ($this->uri->segment(2) == 'pengembalian') {
                                                    echo "active";
                                                } ?> " href="<?= base_url('admin/pengembalian')  ?>">
                                <span data-feather="database"></span>
                                Pengembalian
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php if ($this->uri->segment(2) == 'product') {
                                                    echo "active";
                                                } ?>  " href="<?= base_url('admin/product') ?>">
                                <span data-feather="file"></span>
                                Products
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php if ($this->uri->segment(2) == 'customers') {
                                                    echo "active";
                                                } ?>  " href="<?= base_url('admin/customers') ?>">
                                <span data-feather="users"></span>
                                Customers
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php if ($this->uri->segment(2) == 'reports') {
                                                    echo "active";
                                                } ?>" href="<?= base_url('admin/reports') ?>">
                                <span data-feather="bar-chart-2"></span>
                                Reports
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php if ($this->uri->segment(2) == 'category') {
                                                    echo "active";
                                                } ?>  " href="<?= base_url('admin/category')  ?>">
                                <span data-feather="layers"></span>
                                Category
                            </a>
                        </li>
                    </ul>
                    <hr>
                </div>
            </nav>