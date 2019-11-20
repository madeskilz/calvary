<?php $this->load->view("student/inc/header") ?>
<style>
    .ic_ch {
        padding: 10px;
        text-align: center;
    }

    .ic_ch a {
        color: #206363;
    }

    .db_ic {
        font-size: 44px;
    }
</style>
<div id="main-content">
    <div class="container">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-6 col-md-8 col-sm-12">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="icon-home"></i></a></li>
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="row clearfix body">
                <div class="col-md-12" id="msgBox">
                    <?php $this->load->view("err-inc/msg") ?>
                </div>
                <div class="col-md-12 row">
                    <div class="col-md-4 col-xs-6 ic_ch">
                        <a href="<?= base_url("student/course") ?>">
                            <i class="icon-notebook db_ic"></i>
                            <h5>Course Registration</h5>
                        </a>
                    </div>
                    <div class="col-md-4 col-xs-6 ic_ch">
                        <a href="<?= base_url("student/payment") ?>">
                            <i class="icon-credit-card db_ic"></i>
                            <h5>Payments</h5>
                        </a>
                    </div>
                    <div class="col-md-4 col-xs-6 ic_ch">
                        <a href="<?= base_url("student/profile") ?>">
                            <i class="icon-user db_ic"></i>
                            <h5>My Profile</h5>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $this->load->view("student/inc/footer") ?>