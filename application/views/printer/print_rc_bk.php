<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <title><?= $title ?> :: Calvary Polytechnic</title>
    <link href="<?= base_url("inassets/vendor/bootstrap/css/bootstrap.min.css") ?>" rel="stylesheet">
    <link href="<?= base_url("inassets/css/all.min.css") ?>" rel="stylesheet">
    <link rel="shortcut icon" href="<?= base_url("inassets/images/logo_fav.png") ?>">
    <style>
        @media print {
            a[href]:after {
                content: none !important;
            }
        }
    </style>
</head>

<body style="padding:20px;">
    <div class="container" style="border:1px solid grey;padding:10px;">
        <div class="row">
            <div class="col-md-12">
                <button class="btn btn-info btn-sm" onclick="window.print()"><i class="fa fa-print"></i> Print</button>
            </div>
            <div class="col-md-12">
                <h2 style="text-align:center;">
                    <a href="<?= base_url("login") ?>">
                        <img src="<?= base_url("inassets/images/logo_fav.png") ?>" style="width:80px;height:80px" />
                    </a>
                </h2>
                <h2 class="h2 text-center text-uppercase">Calvary Polytechnic</h2>
                <h5 class="h5" style="text-align:center;">Hospital Road, Owa-oyibo, Ika North East, Delta State, NG</h5>
                <h4 class="h4 text-center text-uppercase" style="font-weight:700;">Payment Receipt</h4>
                <hr style="border:1px solid #004040;"/>
            </div>
            <div class="col-md-6 row" style="padding-left:50px">
                <h4 class="h4 col-md-6" style="font-weight:600;">Application ID: </h4>
                <h4 class="h4 col-md-6" style="font-weight:600;"><?= $details->admission_no ?></h4>
                <h4 class="h4 col-md-6" style="font-weight:600;">Surname: </h4>
                <h4 class="h4 col-md-6" style="font-weight:600;"><?= $details->lastname ?></h4>
                <h4 class="h4 col-md-6" style="font-weight:600;">First Name: </h4>
                <h4 class="h4 col-md-6" style="font-weight:600;"><?= $details->firstname ?></h4>
                <h4 class="h4 col-md-6" style="font-weight:600;">School: </h4>
                <h4 class="h4 col-md-6" style="font-weight:600;"><?= get_school(get_department($details->department)->school_id)->name ?></h4>
                <h4 class="h4 col-md-6" style="font-weight:600;">Department: </h4>
                <h4 class="h4 col-md-6" style="font-weight:600;"><?= get_department($details->department)->name ?></h4>
                <h4 class="h4 col-md-6" style="font-weight:600;">Middle Name: </h4>
                <h4 class="h4 col-md-6" style="font-weight:600;"><?= $details->middlename ?></h4>
                <h4 class="h4 col-md-6" style="font-weight:600;">Payment Type: </h4>
                <h4 class="h4 col-md-6" style="font-weight:600;"><?= get_payment_type($payment->type) ?></h4>
                <h4 class="h4 col-md-6" style="font-weight:600;">Amount: </h4>
                <h4 class="h4 col-md-6" style="font-weight:600;">&#8358; <?= $payment->amount ?></h4>
                <h4 class="h4 col-md-6" style="font-weight:600;">Charge: </h4>
                <h4 class="h4 col-md-6" style="font-weight:600;">&#8358; <?= $payment->charge ?></h4>
                <h4 class="h4 col-md-6" style="font-weight:600;">Total: </h4>
                <h4 class="h4 col-md-6" style="font-weight:600;">&#8358; <?= $payment->amount + $payment->charge ?></h4>
                <h4 class="h4 col-md-6" style="font-weight:600;">Payment Date: </h4>
                <h4 class="h4 col-md-6" style="font-weight:600;"><?= neatDate($payment->date_initiated) ?></h4>
                <h4 class="h4 col-md-6" style="font-weight:600;">Transaction ID: </h4>
                <h4 class="h4 col-md-6" style="font-weight:600;"> <?= $payment->reference ?></h4>
                <h4 class="h4 col-md-6" style="font-weight:600;">Payment Status: </h4>
                <h4 class="h4 col-md-6" style="font-weight:600;"> <?= $payment->payment_status ?></h4>
            </div>
            <div class="col-md-6 text-center">
                <img src="<?= base_url("sitefiles/qrcodes/$qr_image") ?>" style="width:180px;" />
            </div>
            <table class="table table-bordered">
                <tbody>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>