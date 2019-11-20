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
                <h4 class="h4 text-center text-uppercase" style="font-weight:700;">Office of the Registrar</h4>
                <hr style="border:1px solid #004040;"/>
            </div>
            <div class="col-md-12 row addressing">
                <div class="col-md-6">
                    <h5>The Registrar</h5>
                    <p><b>Our Reference:</b> <?= $details->admission_no ?></p>
                    <p><b>Student Name:</b> <?= "$details->lastname, $details->lastname $details->middlename" ?></p>
                </div>
            </div>
            <div class="col-md-12" style="margin-top:20px">
                <h4 class="text-center" style="text-decoration:underline;">OFFER OF PROVISIONAL ADMISSION</h4>
                <p class="text-justify">
                    I am pleased to inform you that you have been offered Provisional Admission to Calvary Polytechnic, Owa-Oyibo to study
                    <?= get_department($details->department)->name ?>, <?= get_school(get_department($details->department)->school_id)->name ?> starting from the <?= getNextSession() ?> Academic Session.
                </p>
                <p class="text-justify">
                    This offer is conditional upon the confirmation of your qualification(s) as listed by you in the application form.
                </p>
                <p class="text-justify">
                    During registration, you will be required to produce the original copies of your certificates or any other acceptable evidence of
                    the qualification which this is based.
                </p>
                <p class="text-justify">
                    If at any time after admission, it is discovered that you do not possess the requisite qualification at the time you got this
                    admission, you will be required to withdraw from the institution.
                </p>
                <p class="text-justify">
                    You should complete the Acceptance Form in triplicate copies and indicate whether you accept or reject the offer. Two copies
                    of the form should be forwarded to the Registrar's Office, while the third copy should be retained by you and tendered on
                    demand.
                </p>
                <p class="text-justify">
                    Before commencement of registration, you will be required to undergo medical examination which should be done in the
                    Institution's clinic. You are required to pay the necessary school fees after the clearance within two (2) weeks from the
                    beginning of the academic session.
                </p>
                <p class="text-justify">
                    Other instructions about facilities available in the Institution would be obtained from the Registrar's Office.
                </p>
                <p class="text-justify">
                    Accept our hearty congratulations
                </p>
                <p class="text-justify"><img src="<?=base_url()."sitefiles/registrar/reg_sig.png"?>" style="width:120px;"/></p>
                <p class="text-justify">Wande Akindiose</p>
                <p class="text-justify">The Registrar</p>
            </div>
        </div>
    </div>
</body>

</html>