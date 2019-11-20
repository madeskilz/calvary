<!doctype html>
<html lang="en">

<head>
    <title><?= (isset($title)) ? $title : "Prospective Student" ?> :: Calvary Polytechnic </title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <link rel="icon" href="<?= base_url("inassets/images/logo_fav.png") ?>" type="image/x-icon">
    <!-- VENDOR CSS -->
    <link rel="stylesheet" href="<?= base_url("inassets/vendor/bootstrap/css/bootstrap.min.css") ?>">
    <link rel="stylesheet" href="<?= base_url("inassets/css/all.min.css") ?>">
    <link rel="stylesheet" href="<?= base_url("inassets/vendor/chartist/css/chartist.min.css") ?>">
    <link rel="stylesheet" href="<?= base_url("inassets/vendor/chartist-plugin-tooltip/chartist-plugin-tooltip.css") ?>">
    <link rel="stylesheet" href="<?= base_url("inassets/vendor/toastr/toastr.min.css") ?>">

    <!-- MAIN CSS -->
    <link rel="stylesheet" href="<?= base_url("inassets/css/main.css") ?>">
    <link rel="stylesheet" href="<?= base_url("inassets/css/color_skins.css") ?>">
    <style>
        @media screen and (width:1024px) {
            .poly_name {
                display: none !important;
            }
        }
    </style>
</head>

<body class="theme-orange">

    <!-- Page Loader -->
    <div class="page-loader-wrapper">
        <div class="loader">
            <div class="m-t-30"><img src="<?= base_url("inassets/images/logo_fav.png") ?>" width="48" height="48" alt="Calvary Poly"></div>
            <p>Please wait...</p>
        </div>
    </div>

    <header style="position:fixed;width:100%;z-index:1992;">
        <nav class="navbar navbar-light bg-light navbar-expand-lg" style="background-color:#fff !important;">
            <a class="navbar-brand" href="<?= base_url() ?>">
                <img src="<?= base_url("inassets/images/new_logo.png") ?>" alt="Calvary Polytechnic" style="width:auto;height:45px;">
            </a>
            <button class="navbar-toggler" data-toggle="collapse" data-target="#menuItems">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div id="menuItems" class="collapse navbar-collapse">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item <?=($active === "home")?"active":""?>">
                        <a class="nav-link" href="<?= base_url() ?>">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="http://calvarypoly.edu.ng">Back to Website</a>
                    </li>
                    <li class="nav-item <?=($active === "apply")?"active":""?>">
                        <a class="nav-link" href="<?= base_url("apply") ?>">Application</a>
                    </li>
                </ul>
            </div>
        </nav>
    </header>