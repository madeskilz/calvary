<?php $this->load->view("prospective/inc/header") ?>
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
                        <li class="breadcrumb-item"><a href="<?= base_url("prospective") ?>"><i class="icon-home"></i></a></li>
                        <li class="breadcrumb-item active">Clearance Procedure</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="row clearfix body">
                <div class="col-md-12">
                    <?php $this->load->view("err-inc/msg") ?>
                </div>
                <?php if ($profile->paid_school_fee) { ?>
                    <div class="col-md-12">
                        <h4><a href="<?=base_url("prospective/completed")?>">Click here to Proceed to Course Registration</a></h4>
                    </div>
                <?php } else { ?>
                    <div class="col-md-12">
                        <h4 style="color:#f34;">To move to the next step you need to pay your school fee.</h4>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>
<?php $this->load->view("prospective/inc/footer") ?>