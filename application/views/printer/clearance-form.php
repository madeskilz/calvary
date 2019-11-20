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

        th {
            font-size: 12px;
        }

        label {
            font-weight: normal;
        }

        @media print {
            a[href]:after {
                content: none !important;
            }

            #imgSide {
                margin-top: -20px;
            }

            .spread {
                display: inline-flex;
                width: 100%;
            }

            .spread .col-md-6 {
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
                <h4 class="h4 text-center text-uppercase" style="font-weight:700;">Clearance Form</h4>
                <hr style="border:1px solid #004040;"/>
            </div>
            <div class="col-md-12">
                <h5 class="col-md-12 text-center bg-warning text-uppercase" style="padding:5px;">General Information</h5>
                <div class="row spread">
                    <div class="col-md-6">
                        <p><b>Surname:</b> <?= $details->lastname ?></p>
                        <p><b>First Name:</b> <?= $details->firstname ?></p>
                        <p><b>Middle Name:</b> <?= $details->middlename ?></p>
                        <p><b>Date of Birth:</b> <?= $details->dateofbirth ?></p>
                    </div>
                    <div class="col-md-6">
                        <p><b>Gender:</b> <?= $details->gender ?></p>
                        <p><b>Contact Address:</b> <?= $details->address ?></p>
                        <p><b>State of Origin:</b> <?= get_state($details->state)->name ?></p>
                        <p><b>LGA:</b> <?= get_lga($details->lga)->local_name ?></p>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <h5 class="col-md-12 text-center bg-warning text-uppercase" style="padding:5px;">Clearance Information</h5>
                <div class="row spread">
                    <div class="col-md-6">
                        <p><b>Applicant ID:</b> <?= $details->admission_no ?></p>
                        <p><b>School:</b> <?= get_school(get_department($details->department)->school_id)->name ?></p>
                        <p><b>Department:</b> <?= get_department($details->department)->name ?></p>
                    </div>
                    <div class="col-md-6">
                        <p><b>Programme:</b> <?= get_program(get_department($details->department)->program)->name ?></p>
                        <p><b>Application Date:</b> <?= neatDate($details->datecreated) ?></p>
                        <p><b>Academic Session:</b> <?= getNextSession() ?></p>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <h5 class="col-md-12 text-center bg-warning text-uppercase" style="padding:5px;">Qualification Information</h5>
                <div class="col-md-12 table-responsive">
                    <table class="table table-striped">
                        <tr>
                            <th>S/N</th>
                            <th>EXAM NUMBER</th>
                            <th>SUBJECT</th>
                            <th>GRADE</th>
                            <th>EXAM YEAR</th>
                            <th>EXAM TYPE</th>
                        </tr>
                        <?php $x = 1;
                        foreach ($olevel as $sub) :
                            $exam_results = get_exam_result($sub->id);
                            foreach ($exam_results as $res) : ?>
                                <tr>
                                    <td><?= $x ?></td>
                                    <td><?= $sub->exam_no ?></td>
                                    <td><?= get_subject($res->subject) ?></td>
                                    <td><?= $res->grade ?></td>
                                    <td><?= $sub->exam_year ?></td>
                                    <td><?= get_exam_type($sub->exam_type) ?></td>
                                </tr>
                        <?php $x++;
                            endforeach;
                        endforeach; ?>
                    </table>
                </div>
            </div>
            <div class="col-md-12">
                <h5 class="col-md-12 text-center bg-warning text-uppercase" style="padding:5px;">Declaration</h5>
                <div class="col-md-12">
                    <p class="text-justify">I, <b class="text-uppercase"><?= $details->lastname . " " . $details->firstname . " " . $details->middlename  ?></b>, hereby declared that the information provided on this form is true and accurate. </p>
                    <p class="text-justify">
                        I agree that Calvary Polytechnic, Owa-Oyibo reserves the right to take appropriate
                        measures including termination of admission if the information here is discovered to be false.
                    </p>
                    <p class="text-justify">
                        Student Signature __________________________ Date:_______________________________
                    </p>
                </div>
            </div>
            <div class="col-md-12">
                <h5 class="col-md-12 text-center bg-warning text-uppercase" style="padding:5px;">Admission Office Use Only</h5>
                <div class="col-md-12">
                    <table class="table table-responsive">
                        <tr>
                            <th style="width:50%;">Documents Submitted</th>
                            <th style="width:50%;">Official Remarks</th>
                        </tr>
                        <tr>
                            <td>
                                <p><label> <input type="checkbox" /> Acceptance Fee Receipt</label></p>
                                <p><label> <input type="checkbox" /> Admission Slip</label></p>
                                <p><label> <input type="checkbox" /> Admission Letter</label></p>
                                <p><label> <input type="checkbox" /> Acceptance Letter</label></p>
                                <p><label> <input type="checkbox" /> Certificate of Origin</label></p>
                                <p><label> <input type="checkbox" /> Birth Certificate</label></p>
                                <p><label> <input type="checkbox" /> O' Level Results</label></p>
                                <p><label> <input type="checkbox" /> Letter of Reference</label></p>
                                <p>
                                    <h5 class="col-md-12 text-center bg-warning" style="padding:5px;">Where Applicable</h5>
                                </p>
                                <p><label> <input type="checkbox" /> ND Result</label></p>
                                <p><label> <input type="checkbox" /> Transfer Document</label></p>
                                <p><label> <input type="checkbox" /> A' Level Results</label></p>
                            </td>
                            <td>
                                <p>Clearance Code: ___________________________________________________</p>
                                <p>Department Admitted: _____________________________________________</p>
                                <p>Comments and Other Information: ________________________________<br>
                                    ____________________________________________________________________<br>
                                    ____________________________________________________________________<br>
                                    ____________________________________________________________________<br>
                                    ____________________________________________________________________<br>
                                    ____________________________________________________________________<br>
                                    ____________________________________________________________________<br>
                                    ____________________________________________________________________<br>
                                    ____________________________________________________________________<br>
                                    ____________________________________________________________________<br>
                                    ____________________________________________________________________ </p>
                                <p>Admission Officer:_________________________________________________</p>
                                <p>Signature:______________________________ Date:_____________________</p>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>

</html>