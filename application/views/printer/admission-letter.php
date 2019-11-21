<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <title><?= $title ?> :: Calvary Polytechnic</title>
    <link href="<?= base_url("inassets/vendor/bootstrap/css/bootstrap.min.css") ?>" rel="stylesheet">
    <link href="<?= base_url("inassets/css/all.min.css") ?>" rel="stylesheet">
    <link rel="shortcut icon" href="<?= base_url("inassets/images/logo_fav.png") ?>">
    <style>
        .table>tbody>tr>td {
            padding: 8px;
            line-height: 1.42857143;
            vertical-align: top;
            border-top: none !important;
        }

        .addressing h5 {
            font-weight: normal !important;
        }

        @media print {
            a[href]:after {
                content: none !important;
            }

            .table {
                margin-top: -20px;
            }

            #imgSide {
                margin-top: -20px;
            }

            .addressing {
                display: inline-flex;
                width: 100%;
            }

            .addressing .col-md-6 {
                width: 50%;
            }
        }

        ol p {
            font-weight: normal;
        }
    </style>
</head>
<?php
$program = get_program(get_department($details->department)->program);
$no_years = $program->no_years;
?>

<body style="padding:20px;">
    <div class="container" style="border:1px solid grey;padding:10px;">
        <div class="row">
            <div class="col-md-12">
                <button class="btn btn-info btn-sm" onclick="window.print()"><i class="fa fa-print"></i> Print</button>
            </div>
            <div class="col-md-12" id="imgSide">
                <h2 style="text-align:center;">
                    <a href="<?= base_url("login") ?>">
                        <img src="<?= base_url("inassets/images/logo_fav.png") ?>" style="width:80px;height:80px" />
                    </a>
                </h2>
                <h2 class="h2 text-center text-uppercase">Calvary Polytechnic, Owa-Oyibu</h2>
                <h5 class="h5" style="text-align:center;">Hospital Road, Owa-oyibo, Ika North East, Delta State, NG</h5>
                <h4 class="h4 text-center text-uppercase" style="font-weight:700;">Office of the Registrar</h4>
                <hr style="border:1px solid #004040;" />
            </div>
            <div class="col-md-12 row addressing">
                <div class="col-md-6">
                    <h5>Dear <?= "$details->lastname," ?></h5>
                </div>
                <div class="col-md-6 text-right">
                    <p><b>Our Reference:</b> <?= $details->admission_no ?></p>
                    <p><b>Date:</b> <?= date("M d, Y.") ?></p>
                </div>
            </div>
            <div class="col-md-12" style="margin-top:20px">
                <h4 class="text-center" style="text-decoration:underline;">LETTER OF PROVISIONAL ADMISSION</h4>
                <p class="text-justify">
                    Further to your participation in our admission screening exercise for the <?= getNextSession() ?> academic session, I am pleased to
                    inform you of the offer of provisional admission to our <b><?= $no_years . "-year" ?><?= ($no_years > 1) ? "s" : "" ?> <?= $program->name . "($program->short)" ?></b>
                    programme in <b>
                        <?= get_department($details->department)->name ?>, School of <?= get_school(get_department($details->department)->school_id)->name ?>.</b>
                    <p class="text-justify">
                        In order to realize this offer, you are expected to fulfill the enrollment requirements:
                        <ol type="i" style="padding-inline-start: 15px;font-weight:bold;">
                            <li>
                                <b>Acceptance of offer:</b>
                                <p>
                                    This offer will be regarded as accepted by making a payment of &#8358; <?= number_format(10000, 2, ".", ",") ?>. 
                                    You are to collect a copy of the Students Handbook from the Admission Office after showing the reciept of payment. 
                                </p>
                            </li>
                            <li>
                                <b>Full Payment of School Fees:</b>
                                <p>
                                    Full payment of your school fee is a necessity for completing your registration. The full fee for your program
                                </p>
                            </li>
                        </ol>
                    </p>
                    <p class="text-justify"><img src="<?= base_url() . "sitefiles/registrar/reg_sig.png" ?>" style="width:120px;" /></p>
                    <p class="text-justify">Wande Akindiose</p>
                    <p class="text-justify">The Registrar</p>
            </div>
        </div>
    </div>
</body>

</html>