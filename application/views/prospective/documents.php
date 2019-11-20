<?php $this->load->view("prospective/inc/header") ?>
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
                        <li class="breadcrumb-item"><a href="<?=base_url("prospective")?>"><i class="icon-home"></i></a></li>
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
                <?php if ($profile->paid_acceptance_fee) : ?>
                    <div class="col-md-6">
                        <h5>To print payment receipt you should <a href="<?= base_url("prospective/payment") ?>">go to the payment page</a></h5>
                        <h5>
                            Admission Slip
                            <a target="_blank" href="<?= base_url("printer/admissionSlip/".simple_crypt($profile->user_id)) ?>" class="btn btn-outline-info" title="Print">
                                <i class="fa fa-print"></i> Print Admission Slip
                            </a>
                        </h5>
                        <h5>
                            Admission Letter
                            <a target="_blank" href="<?= base_url("printer/admissionLetter/".simple_crypt($profile->user_id)) ?>" class="btn btn-outline-info" title="Print">
                                <i class="fa fa-print"></i> Print Admission Letter
                            </a>
                        </h5>
                        <h5>
                            Acceptance Letter
                            <a target="_blank" href="<?= base_url("printer/acceptLetter/".simple_crypt($profile->user_id)) ?>" class="btn btn-outline-info" title="Print">
                                <i class="fa fa-print"></i> Print Acceptance Letter
                            </a>
                        </h5>
                        <h5>
                            Clearance Form
                            <a target="_blank" href="<?= base_url("printer/clearanceForm/".simple_crypt($profile->user_id)) ?>" class="btn btn-outline-info" title="Print">
                                <i class="fa fa-print"></i> Print Clearance Form
                            </a>
                        </h5>
                    </div>
                    <div class="col-md-6">
                        <h4>Clearance Venue</h4>
                        <ul>
                            <li>Venue: ICT Center Calvary Polytechnic</li>
                            <li>Date: To Be Anounced </li>
                            <li>Time: 08:00am</li>
                        </ul>
                    </div>
                <?php else : ?>
                    <h1 style="color:#f34" class="col-md-12">Ensure you fufilled all requirements before proceeding</h1>
                    <h3 style="color:#<?= ($profile->paid_acceptance_fee) ? "326f37" : "f34" ?>;" class="col-md-12">Paid Acceptance Fee: <span><?= ($profile->paid_acceptance_fee) ? "<i class='fa fa-check m-r-5'></i>" : "<i class='fa fa-remove m-r-5'></i>" ?></span></h3>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<?php $this->load->view("prospective/inc/footer") ?>