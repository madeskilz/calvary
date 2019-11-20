<!doctype html>
<html lang="en">

<head>
    <title><?= (isset($title)) ? $title : "Application Portal" ?> :: Calvary Polytechnic </title>
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
    <div id="wrapper">
        <nav class="navbar navbar-fixed-top">
            <div class="container">
                <div class="navbar-brand">
                    <a href="<?= base_url() ?>" class="row">
                        <img src="<?= base_url("inassets/images/new_logo.png") ?>" alt="Calvary" class="logo" style="width:auto;height:30px;">
                    </a>
                </div>
                <div class="navbar-right">
                    <div id="navbar-menu">
                        <ul class="nav navbar-nav">
                            <li><a class="icon-menu d-none d-sm-none d-md-block d-lg-block"><span style="font-size:14px;">welcome, <?= $this->session->userdata("email") ?></span></a></li>
                            <li><a href="<?= base_url("logout") ?>" class="icon-menu d-sm-block d-md-block d-lg-block"><span style="font-size:20px;">Logout</span><i class="icon-login"></i></a></li>
                        </ul>
                    </div>
                </div>
                <div class="navbar-btn">
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar" aria-expanded="false">
                        <i class="lnr lnr-menu icon-notebook"></i>
                    </button>
                </div>
            </div>
        </nav>
        <div class="main_menu">
            <nav class="navbar navbar-expand-lg">
                <div class="container">
                    <div class="navbar-collapse align-items-center collapse" id="navbar">
                        <ul class="navbar-nav">
                            <li style="margin:auto" class="nav-item <?= ($active == "dashboard") ? "active" : "" ?>">
                                <a href="<?= base_url("admin") ?>" class="nav-link"><i class="icon-speedometer"></i> <span> Dashboard</span></a>
                            </li>
                            <li style="margin:auto" class="dropdown nav-item <?= ($active == "applicant") ? "active" : "" ?>">
                                <a href="" class="nav-link dropdown-toggle" data-toggle="dropdown"><i class="icon-users"></i> <span>Applicants</span></a>
                                <ul class="dropdown-menu animated headShake">
                                    <li><a href="<?= base_url("admin/all_applicant") ?>">All Applicants</a></li>
                                    <li><a href="<?= base_url("admin/applicant_exam") ?>">Admission Processing</a></li>
                                </ul>
                            </li>
                            <li style="margin:auto" class="dropdown nav-item <?= ($active == "prospective") ? "active" : "" ?>">
                                <a href="" class="nav-link dropdown-toggle" data-toggle="dropdown"><i class="icon-note"></i> <span>Prospective</span></a>
                                <ul class="dropdown-menu animated headShake">
                                    <li><a href="<?= base_url("admin/prospective_clearance") ?>">Clearance</a></li>
                                </ul>
                            </li>
                            <li style="margin:auto" class="nav-item <?= ($active == "payment") ? "active" : "" ?>">
                                <a href="<?= base_url("admin/payments") ?>" class="nav-link"><i class="icon-credit-card"></i> <span>Payments</span></a>
                            </li>
                            <li style="margin:auto" class="dropdown nav-item <?= ($active == "session") ? "active" : "" ?>">
                                <a href="" class="nav-link dropdown-toggle" data-toggle="dropdown"><i class="icon-settings"></i> <span>Settings</span></a>
                                <ul class="dropdown-menu animated headShake">
                                    <li><a href="<?= base_url("admin/session") ?>">Session</a></li>
                                </ul>
                            </li>
                            <li style="margin:auto" class="nav-item <?= ($active == "password") ? "active" : "" ?>">
                                <a href="<?= base_url("admin/password") ?>" class="nav-link"><i class="icon-lock"></i> <span>Change Password</span></a>
                            </li>
                        </ul>
                    </div>

                </div>
            </nav>
        </div>