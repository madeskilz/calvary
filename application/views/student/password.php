<?php $this->load->view("student/inc/header") ?>
<div id="main-content">
    <div class="container">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-6 col-md-8 col-sm-12">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="icon-home"></i></a></li>
                        <li class="breadcrumb-item active">Change Password</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="row clearfix body">
                <div class="col-md-12" id="msgBox">
                    <?php $this->load->view("err-inc/msg") ?>
                </div>
                <div class="col-md-3"></div>
                <form method="post" class=" col-md-6">
                    <div class="col-md-12 row">
                        <div class="form-group col-md-12">
                            <label>Current Password</label>
                            <input type="password" name="old_password" class="form-control" required />
                        </div>
                        <div class="form-group col-md-12">
                            <label>New Password</label>
                            <input type="password" name="new_password" class="form-control" id="password" required />
                        </div>
                        <div class="form-group col-md-12">
                            <label>Confirm New Password</label>
                            <input type="password" name="c_new_password" class="form-control" id="c_password" required />
                        </div>
                        <div class="form-group col-md-12">
                            <button class="btn btn-warning" id="btnChange">
                                <i class="fa fa-key fa-spin"></i>
                                Change Password
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</div>
</div>
<?php $this->load->view("student/inc/footer") ?>