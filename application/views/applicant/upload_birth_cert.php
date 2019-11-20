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
                        <li class="breadcrumb-item"><a href="<?= base_url("applicant/upload") ?>">Upload</a></li>
                        <li class="breadcrumb-item active">Birth Certificate</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="row clearfix body">
                <div class="col-md-12">
                    <?php $this->load->view("err-inc/msg") ?>
                </div>
                <?= form_open_multipart(base_url("applicant/upload_birth_cert"), 'class="form-horizontal col-md-12 row" ') ?>
                <div class="col-md-12 row">
                    <div class="col-md-6 row">
                        <div class="form-group col-md-12">
                            <label>Select Scanned Birth Certificate Image File</label><br />
                            <input name="image" type="file" placeholder="Upload File" accept="image/*" onchange="loadname(this,'certificate', 1024000)" id="image" required><br />
                            <small style="color:#f34;" id="image_err">max size: 1Mb; format: .png, .jpg, .jpeg, .gif</small>
                        </div>
                        <div class="form-group col-md-12">
                            <button class="btn btn-primary">Upload Birth Certificate</button>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <img src="" id="certificate" style="width:100%" />
                    </div>
                </div>
                <?= form_close() ?>
            </div>
        </div>
    </div>
</div>
<?php $this->load->view("applicant/inc/footer") ?>