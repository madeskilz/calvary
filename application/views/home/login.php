<?php $this->load->view("home/inc/header") ?>
<style>
    .actions {
        padding-left: 10px;
        text-align: center;
    }

    .hlink {
        color: #004040;
        transition: 0.4s all;
    }

    .hlink:hover {
        color: #fff;
    }
</style>
<div id="wrapper">
    <div class="vertical-align-wrap">
        <div class="vertical-align-middle auth-main">
            <div class="auth-box">
                <div class="top" style="height:50px">
                </div>
                <div class="card">
                    <div class="header">
                        <p class="lead">Login to your account</p>
                    </div>
                    <div class="body">
                        <div class="col-md-12" id="msgBox">
                            <?php $this->load->view("err-inc/msg") ?>
                        </div>
                        <form class="form-auth-small" method="post">
                            <div class="form-group">
                                <label for="signin-email" class="control-label sr-only">Email or Matric Number</label>
                                <input type="text" name="email" class="form-control" id="signin-email" placeholder="Email or Matric No">
                            </div>
                            <div class="form-group">
                                <label for="signin-password" class="control-label sr-only">Password</label>
                                <input type="password" name="password" class="form-control" id="signin-password" placeholder="Password">
                            </div>
                            <div class="form-group clearfix">
                                <label class="fancy-checkbox element-left">
                                    <input type="checkbox">
                                    <span>Remember me</span>
                                </label>
                            </div>
                            <button type="submit" class="btn btn-primary btn-lg btn-block">LOGIN</button>
                            <div class="bottom">
                                <span class="helper-text m-b-10"><i class="fa fa-lock"></i> <a href="page-forgot-password.html">Forgot password?</a></span>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- <div class="actions">
                    <div class="row">
                        <div class="col-xs-6" style="margin-left:auto;">
                            <a class="hlink" href="<?= base_url("apply") ?>">
                                <i class="fas fa-user-plus fa-4x"></i>
                                <h5>Application</h5>
                            </a>
                        </div>
                        <div class="col-xs-6" style="margin-left:10px;margin-right:auto;">
                            <a class="hlink" href="http://calvarypoly.edu.ng"><i class="fas fa-globe fa-4x"></i>
                                <h5>Back to Website</h5>
                            </a>
                        </div>
                    </div>
                </div> -->
            </div>
        </div>
    </div>
</div>
<?php $this->load->view("home/inc/footer") ?>