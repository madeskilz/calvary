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
                <hr style="border:1px solid #004040;"/>
            </div>
            <div class="col-md-12 row addressing">
                <div class="col-md-6">
                    <h5>The Registrar</h5>
                    <h5>Calvary Polytechnic, Owa-Oyibo</h5>
                    <h5>Delta State, NG</h5>
                    <p style="margin-top:50px;">Dear Sir / Madam,</p>
                </div>
                <div class="col-md-6 text-right">
                    <h5><?= $details->lastname . " " . $details->firstname . " " . $details->middlename  ?></h5>
                    <h5><?= $details->admission_no ?></h5>
                    <h5><?= $details->address ?></h5>
                    <h5><?= neatDate(date("Ymd")) ?></h5>
                </div>
            </div>
            <div class="col-md-12">
                <h4 class="text-center" style="text-decoration:underline;">ADMISSION ACCEPTANCE LETTER FOR THE <?= getNextSession() ?> ACADEMIC SESSION</h4>
                <p class="text-justify">
                    Sequel to your letter of provisional offer of admission to study <?= get_department($details->department)->name ?>, <?= get_school(get_department($details->department)->school_id)->name ?>, I
                    hereby accept the provisional offer of admission into the polytechnic.
                </p>
                <h4>STUDENT'S DECLARATION</h4>
                <p class="text-justify">
                    I have read and understood the details contained in the offer of provisional admission to The Calvary Polytechnic, Owa-Oyibo.
                </p>
                <p class="text-justify">
                    The particulars given in this form are correct to the best of my knowledge and belief. If admitted to the Polytechnic, I shall
                    regard myself to be bound by the Oath of Allegiance form, ordinance, code of conduct, status and regulations of the
                    Polytechnic as far as they affect me.
                </p>
                <p style="margin-top:20px">Yours Faithfully,</p>
                <p>Name of Applicant</p>
                <p><?= $details->lastname . " " . $details->firstname . " " . $details->middlename  ?></p>
                <p>Signature & Date:</p>
                <p style="margin-top:20px">____________________</p>
                <h4>SPONSOR'S DECLARATION</h4>
                <p>
                    I solemnly declare that I, ____________________________________ will be responsible for the fees, as stipulated and required during
                    the course of study of my son/daughter/ward, in the Polytechnic.
                </p>
            </div>
        </div>
    </div>
</body>

</html>