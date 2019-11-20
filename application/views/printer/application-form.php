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


        @media print {
            a[href]:after {
                content: none !important;
            }
            .table{
                margin-top:-20px;
            }
            #imgSide{
                margin-top:-20px;
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
            <div class="col-md-12" id="imgSide">
                <h2 style="text-align:center;">
                    <a href="<?= base_url("login") ?>">
                        <img src="<?= base_url("inassets/images/logo_fav.png") ?>" style="width:80px;height:80px" />
                    </a>
                </h2>
                <h2 class="h2 text-center text-uppercase">Calvary Polytechnic</h2>
                <h5 class="h5" style="text-align:center;">Hospital Road, Owa-oyibo, Ika North East, Delta State, NG</h5>
                <h4 class="h4 text-center text-uppercase" style="font-weight:700;">Application Form</h4>
                <hr style="border:1px solid #004040;"/>
            </div>
            <table class="table" style="border:none;margin-left:50px">
                <tr>
                    <td style="width:25%;">
                        <h4 class="h5" style="font-weight:600;">Application ID: </h4>
                    </td>
                    <td style="width:25%;">
                        <h4 class="h5" style="font-weight:600;"><?= $details->admission_no ?></h4>
                    </td>
                    <td style="width:50%;" rowspan="7">
                        <?php if ($details->image) : ?>
                            <img src="<?= base_url("sitefiles/applicants/images/" . $details->image) ?>" style="width:200px;height:200px" />
                        <?php else : ?>
                            <img src="<?= base_url("assets/images/user-blank.png") ?>"  style="width:200px;height:200px" />
                        <?php endif; ?>
                    </td>
                </tr>
                <tr>
                    <td>
                        <h4 class="h5" style="font-weight:600;">Surname: </h4>
                    </td>
                    <td>
                        <h4 class="h5" style="font-weight:600;"><?= $details->lastname ?></h4>
                    </td>
                </tr>
                <tr>
                    <td>
                        <h4 class="h5" style="font-weight:600;">First Name: </h4>
                    </td>
                    <td>
                        <h4 class="h5" style="font-weight:600;"><?= $details->firstname ?></h4>
                    </td>
                </tr>
                <tr>
                    <td>
                        <h4 class="h5" style="font-weight:600;">Middle Name: </h4>
                    </td>
                    <td>
                        <h4 class="h5" style="font-weight:600;"><?= $details->middlename ?></h4>
                    </td>
                </tr>
                <tr>
                    <td>
                        <h4 class="h5" style="font-weight:600;">School: </h4>
                    </td>
                    <td>
                        <h4 class="h5" style="font-weight:600;"><?= get_school(get_department($details->department)->school_id)->name ?></h4>
                    </td>
                </tr>
                <tr>
                    <td>
                        <h4 class="h5" style="font-weight:600;">Program: </h4>
                    </td>
                    <td>
                        <h4 class="h5" style="font-weight:600;"><?= get_program(get_department($details->department)->program)->name ?></h4>
                    </td>
                </tr>
                <tr>
                    <td>
                        <h4 class="h5" style="font-weight:600;">Department: </h4>
                    </td>
                    <td>
                        <h4 class="h5" style="font-weight:600;"><?= get_department($details->department)->name ?></h4>
                    </td>
                </tr>
                <tr>
                    <td>
                        <h4 class="h5" style="font-weight:600;">Date Of birth: </h4>
                    </td>
                    <td>
                        <h4 class="h5" style="font-weight:600;"><?= neatDate($details->dateofbirth) ?></h4>
                    </td>
                </tr>
                <tr>
                    <td>
                        <h4 class="h5" style="font-weight:600;">Gender: </h4>
                    </td>
                    <td>
                        <h4 class="h5" style="font-weight:600;"><?= $details->gender ?></h4>
                    </td>
                </tr>
                <tr>
                    <td>
                        <h4 class="h5" style="font-weight:600;">Marital Status: </h4>
                    </td>
                    <td>
                        <h4 class="h5" style="font-weight:600;"><?= $details->marital_status ?></h4>
                    </td>
                </tr>
                <tr>
                    <td>
                        <h4 class="h5" style="font-weight:600;">Email: </h4>
                    </td>
                    <td>
                        <h4 class="h5" style="font-weight:600;"><?= $this->session->userdata("email") ?></h4>
                    </td>
                </tr>
                <tr>
                    <td>
                        <h4 class="h5" style="font-weight:600;">Phone Number: </h4>
                    </td>
                    <td>
                        <h4 class="h5" style="font-weight:600;"><?=$details->phone ?></h4>
                    </td>
                </tr>
                <tr>
                    <td>
                        <h4 class="h5" style="font-weight:600;">Local Government: </h4>
                    </td>
                    <td>
                        <h4 class="h5" style="font-weight:600;"> <?= get_lga($details->lga)->local_name ?></h4>
                    </td>
                </tr>
                <tr>
                    <td>
                        <h4 class="h5" style="font-weight:600;">State: </h4>
                    </td>
                    <td>
                        <h4 class="h5" style="font-weight:600;"> <?= get_state($details->state)->name ?></h4>
                    </td>
                </tr>
            </table>
        </div>
    </div>
</body>

</html>