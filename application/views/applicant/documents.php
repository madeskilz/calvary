<?php $this->load->view("applicant/inc/header") ?>
<style>
    .sit_name {
        display: none;
    }
</style>
<div id="main-content">
    <div class="container">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-6 col-md-8 col-sm-12">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?= base_url("applicant") ?>"><i class="icon-home"></i></a></li>
                        <li class="breadcrumb-item active">Print Documents</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="row clearfix body">
                <div class="col-md-12">
                    <?php $this->load->view("err-inc/msg") ?>
                </div>
                <?php if ($details->paid_application_fee && $details->uploaded_result && $details->uploaded_lga_cert && $details->uploaded_jamb_printout && $details->uploaded_birth_cert && $details->confirm_details) : ?>
                    <div class="col-md-6">
                        <h5>To print payment receipt you should <a href="<?= base_url("applicant/payment") ?>">go to the payment page</a></h5>
                        <h5>
                            Application Form
                            <a target="_blank" href="<?= base_url("printer/applicationForm/" . simple_crypt($details->user_id)) ?>" class="btn btn-outline-info" title="Print">
                                <i class="fa fa-print"></i> Print Application Form
                            </a>
                        </h5>
                    </div>
                    <div class="col-md-6">
                        <h4>Examination Information</h4>
                        <ul>
                            <li>Venue: Hospital Road, Owa-oyibo, Ika North East, Delta State, NG</li>
                            <li>Date: To Be Anounced </li>
                            <li>Time: 08:00am</li>
                            <li>No phones allowed</li>
                            <li>Come along with the original copy of
                                <ol>
                                    <li>Application Fee Payment Receipt</li>
                                    <li>Application Form</li>
                                    <li>Birth Certificate</li>
                                    <li>LGA Certificate</li>
                                    <li>JAMB Printout</li>
                                </ol>
                            </li>
                        </ul>
                    </div>
                <?php else : ?>
                    <h1 style="color:#f34" class="col-md-12">Ensure you fufilled all requirements before proceeding</h1>
                    <h3 style="color:#<?= ($details->confirm_details) ? "326f37" : "f34" ?>;" class="col-md-12">Confirmed Details: <span><?= ($details->confirm_details) ? "<i class='fa fa-check m-r-5'></i>" : "<i class='fa fa-remove m-r-5'></i>" ?></span></h3>
                    <h3 style="color:#<?= ($details->uploaded_result) ? "326f37" : "f34" ?>;" class="col-md-12">Uploaded O'Level Result: <span><?= ($details->uploaded_result) ? "<i class='fa fa-check m-r-5'></i>" : "<i class='fa fa-remove m-r-5'></i>" ?></span></h3>
                    <h3 style="color:#<?= ($details->uploaded_birth_cert && $details->uploaded_lga_cert && $details->uploaded_jamb_printout) ? "326f37" : "f34" ?>;" class="col-md-12">Uploaded Documents: <span><?= ($details->uploaded_birth_cert && $details->uploaded_lga_cert && $details->uploaded_jamb_printout) ? "<i class='fa fa-check m-r-5'></i>" : "<i class='fa fa-remove m-r-5'></i>" ?></span></h3>
                    <h3 style="color:#<?= ($details->paid_application_fee) ? "326f37" : "f34" ?>;" class="col-md-12">Paid Application Fee: <span><?= ($details->paid_application_fee) ? "<i class='fa fa-check m-r-5'></i>" : "<i class='fa fa-remove m-r-5'></i>" ?></span></h3>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<?php $this->load->view("applicant/inc/footer") ?>