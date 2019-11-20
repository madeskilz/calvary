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
                        <li class="breadcrumb-item"><a href="<?=base_url("applicant")?>"><i class="icon-home"></i></a></li>
                        <li class="breadcrumb-item active">Upload Documents</li>
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
                    <h3 style="color:#<?= ($details->uploaded_birth_cert) ? "326f37" : "f34" ?>;" class="col-md-12">
                        Uploaded Birth Certificate:
                        <span>
                            <?= ($details->uploaded_birth_cert) ? "<i class='fa fa-check m-r-5'></i>" : "<i class='fa fa-remove m-r-5'></i>"?>
                        </span>
                        <?php if (!$details->uploaded_birth_cert) : ?>
                            <a style="font-size:18px;" href="<?= base_url("applicant/upload_birth_cert") ?>">Upload Your Birth Certificate Now</a>
                        <?php endif; ?>
                    </h3>
                    <h3 style="color:#<?= ($details->uploaded_lga_cert) ? "326f37" : "f34" ?>;" class="col-md-12">
                        Uploaded Local Goverment Certificate:
                        <span>
                            <?= ($details->uploaded_lga_cert) ? "<i class='fa fa-check m-r-5'></i>" : "<i class='fa fa-remove m-r-5'></i>"?>
                        </span>
                        <?php if (!$details->uploaded_lga_cert) : ?>
                            <a style="font-size:18px;" href="<?= base_url("applicant/upload_lga_cert") ?>">Upload Your L.G.A Certificate Now</a>
                        <?php endif; ?>
                    </h3>
                    <h3 style="color:#<?= ($details->uploaded_jamb_printout) ? "326f37" : "f34" ?>;" class="col-md-12">
                        Uploaded JAMB Printout:
                        <span>
                            <?= ($details->uploaded_jamb_printout) ? "<i class='fa fa-check m-r-5'></i>" : "<i class='fa fa-remove m-r-5'></i>"?>
                        </span>
                        <?php if (!$details->uploaded_jamb_printout) : ?>
                            <a style="font-size:18px;" href="<?= base_url("applicant/upload_jamb_printout") ?>">Upload Your Jamb Printout Now</a>
                        <?php endif; ?>
                    </h3>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $this->load->view("applicant/inc/footer") ?>