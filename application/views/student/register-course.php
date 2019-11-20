<?php $this->load->view("student/inc/header") ?>
<div id="main-content">
    <div class="container">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-6 col-md-8 col-sm-12">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="icon-home"></i></a></li>
                        <li class="breadcrumb-item active"><a href="<?= base_url("student/course") ?>">My Course</a></li>
                        <li class="breadcrumb-item active"> <?= getStudentLevel($level->current_level) ?> Course Registration</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="row clearfix body">
                <?php if (isset($courses)) { ?>
                    <div class="col-md-12"></div>
                <?php } else { ?>
                    <div class="col-md-12">No Course Available For Registration. <span>Are you sure you have paid your school fees?</span></div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>
<?php $this->load->view("student/inc/footer") ?>