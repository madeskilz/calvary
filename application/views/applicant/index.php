<?php $this->load->view("applicant/inc/header") ?>
<style>
    @media screen and (min-width:768px) {
        .myImg {
            position: absolute;
            right: 0;
            top: 70px;
        }
    }
</style>
<div id="main-content">
    <div class="container">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-6 col-md-8 col-sm-12">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="icon-home"></i></a></li>
                        <li class="breadcrumb-item active">Application Form</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="row clearfix body">
                <div class="col-md-12">
                    <?php $this->load->view("err-inc/msg") ?>
                </div>
                <div class="col-md-12">
                    <?php if ($details->confirm_details != 1) : ?>
                        <h5 style="color:#f34;">
                            Please ensure all details are correct before proceeding
                            to the next stage, because once you leave here you wont be able to edit again.
                        </h5>
                    <?php endif; ?>
                </div>
                <div class="col-md-12">
                    <h4 class="text-primary">Personal Information</h4>
                </div>
                <div class="col-md-4 myImg">
                    <?php if ($details->image) : ?>
                        <img src="<?= base_url("sitefiles/applicants/images/" . $details->image) ?>" style="width:120px;height:auto" />
                    <?php else : ?>
                        <img src="<?= base_url("assets/images/user-blank.png") ?>" />
                    <?php endif; ?>
                </div>
                <div class="col-md-8 row">
                    <h6 class="col-md-6">Jamb Exam Year: <?= neatDate($details->jamb_year) ?></h6>
                    <h6 class="col-md-6">Jamb Registration: <?= $details->jamb_reg_no ?></h6>
                    <h6 class="col-md-12" style="margin-top:15px;">Jamb Score: <?= $details->jamb_score ?></h6>
                    <h6 class="col-md-6" style="margin-top:15px;">Title: <?= $details->title ?></h6>
                    <h6 class="col-md-6" style="margin-top:15px;display:none;">Exam No: <?= $details->admission_no ?></h6>
                    <h6 class="col-md-12" style="margin-top:15px;">Surname: <?= $details->lastname ?></h6>
                    <h6 class="col-md-6" style="margin-top:15px;">First Name: <?= $details->firstname ?></h6>
                    <h6 class="col-md-6" style="margin-top:15px;">Middle Name: <?= $details->middlename ?></h6>
                </div>
                <div class="col-md-12 row">
                    <h6 class="col-md-4" style="margin-top:15px;">Gender: <?= $details->gender ?></h6>
                    <h6 class="col-md-4" style="margin-top:15px;">Date of Birth: <?= neatDate($details->dateofbirth) ?></h6>
                    <h6 class="col-md-4" style="margin-top:15px;">Marital Status: <?= $details->marital_status ?></h6>
                    <h6 class="col-md-4" style="margin-top:15px;">Phone: <?= $details->phone ?></h6>
                    <h6 class="col-md-4" style="margin-top:15px;">Address: <?= $details->address ?></h6>
                    <h6 class="col-md-4" style="margin-top:15px;">Email: <?= $this->session->userdata("email") ?></h6>
                    <h6 class="col-md-4" style="margin-top:15px;">Country: <?= $details->country ?></h6>
                    <h6 class="col-md-4" style="margin-top:15px;">State: <?= get_state($details->state)->name ?></h6>
                    <h6 class="col-md-4" style="margin-top:15px;">Local Government: <?= get_lga($details->lga)->local_name ?></h6>
                </div>
                <div class="col-md-12" style="margin-top:25px;">
                    <h4 class="text-primary">Altenative Contact Information</h4>
                </div>
                <div class="col-md-12 row">
                    <h6 class="col-md-4" style="margin-top:15px;">Relationship: <?= $details->alt_contact_rel ?></h6>
                    <h6 class="col-md-4" style="margin-top:15px;">Full Name: <?= $details->alt_contact_name ?></h6>
                    <h6 class="col-md-4" style="margin-top:15px;">Contact Number: <?= $details->alt_contact_phone ?></h6>
                </div>
                <?php if ($details->confirm_details != 1) : ?>
                    <span class="col-md-12 text-right" style="color:#f34;margin-top:35px;">Note that by continuing to upload O'Level Result you agree that all details contained in the application form is valid and as such can no longer be changed.</span>
                <?php endif; ?>
                <div class="btn-group-lg text-white col-md-12 text-right" style="margin-top:25px;">
                    <?php if ($details->confirm_details != 1) : ?>
                        <a class="btn btn-warning text-white" href="<?= base_url("applicant/edit") ?>"><i class="icon-control-rewind"></i> Edit Details</a>
                    <?php endif; ?>
                    <?php if ($details->uploaded_result != 1) : ?>
                        <a class="btn btn-primary" href="<?= base_url("applicant/result") ?>"><i class="icon-control-forward"></i> Upload O'Level Results</a>
                    <?php endif; ?>
                </div>
                <?php if ($details->uploaded_result == 1) : ?>
                    <h4 class="col-md-12 text-primary">O'Level Result(s)</h4>
                    <h4 class="col-md-12">Exam Sitting: <?= $details->exam_sitting ?></h4>
                    <?php $xx = 1;
                    foreach ($exams as $exam) :
                        $exam_results = get_exam_result($exam->id);
                        ?>
                        <div class="<?= ($details->exam_sitting == 1) ? "col-md-12" : "col-md-6" ?>">
                            <div class="col-md-12" style="margin-top:25px;">
                                <?php if ($details->exam_sitting == 2) : ?>
                                    <h4 class="text-success"><?= ($xx == 1) ? "First" : "Second" ?> Sitting</h4>
                                <?php endif; ?>
                                <div class="row" style="margin-top:15px;">
                                    <h5 class="col-md-4">Exam Type: <?= get_exam_type($exam->exam_type) ?></h5>
                                    <h5 class="col-md-4">Exam Number: <?= $exam->exam_no ?></h5>
                                    <h5 class="col-md-4">Exam Year: <?= neatDate($exam->exam_year) ?></h5>
                                </div>
                            </div>
                            <div class="table-responsive col-md-12" style="margin-top:15px;">
                                <table class="table m-b-0 table-bordered">
                                    <thead class="thead-light">
                                        <tr>
                                            <th>#</th>
                                            <th>Subject</th>
                                            <th>Grade</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $r = 1;
                                        foreach ($exam_results as $res) :  ?>
                                            <tr>
                                                <td><?= $r . "." ?></td>
                                                <td><?= get_subject($res->subject) ?></td>
                                                <td><?= $res->grade ?></td>
                                            </tr>
                                            <?php $r++;
                                        endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <?php $xx++;
                    endforeach;
                endif; ?>
            </div>
        </div>
    </div>
</div>
<?php $this->load->view("applicant/inc/footer") ?>