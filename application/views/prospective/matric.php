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
                        <li class="breadcrumb-item"><a href="<?= base_url("prospective") ?>"><i class="icon-home"></i></a></li>
                        <li class="breadcrumb-item active">Get Matric Number</li>
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
                    <?php if ($profile->matric_no) : ?>
                        <h5 class="titlte">Your Matric Number is <?= "$profile->matric_no" ?></h5>
                    <?php else : ?>
                        <div class="col-md-12 row">
                            <div class="col-md-3"></div>
                            <form class="col-md-6" method="post">
                                <div class="form-group">
                                    <label>Clearance Code</label><br />
                                    <small style="color:#f34;">Please provide the clearance code given to you from the clearance office (Note: code is case sensitive)</small>
                                    <input class="form-control" name="code" type="text" required />
                                </div>
                                <div class="form-group text-right">
                                    <button class="btn btn-primary"> Get Matric Number </button>
                                </div>
                            </form>
                        </div>
                    <?php endif;
                    else : ?>
                    <h1 style="color:#f34" class="col-md-12">Ensure you fufilled all requirements before proceeding</h1>
                    <h3 style="color:#<?= ($profile->paid_acceptance_fee) ? "326f37" : "f34" ?>;" class="col-md-12">Paid Acceptance Fee: <span><?= ($profile->paid_acceptance_fee) ? "<i class='fa fa-check m-r-5'></i>" : "<i class='fa fa-remove m-r-5'></i>" ?></span></h3>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<?php $this->load->view("prospective/inc/footer") ?>