<?php $this->load->view("student/inc/header") ?>
<style>
    .cnav a {
        color: #437ac7;
    }
</style>
<div id="main-content">
    <div class="container">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-6 col-md-8 col-sm-12">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="icon-home"></i></a></li>
                        <li class="breadcrumb-item active">My Courses <?= getStudentLevel($level->current_level) ?></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="row clearfix body">
                <span class="col-md-12">
                    <small style="color:#f34;">
                        Before registering courses online, Confirm with your course adviser in the departmental
                        office on which courses you are to register for your current level
                    </small>
                </span>
                <div class="col-md-12 row text-center cnav" style="margin-top:40px;">
                    <div class="col-md-3 col-xs-6"><a href="<?= base_url("student/course/register") ?>"><i class="fa-3x fa fa-book "></i>
                            <h5>Register Courses</h5>
                        </a></div>
                    <div class="col-md-3 col-xs-6"><a href="<?= base_url("student/course/update") ?>"><i class="fa-3x fa fa-list"></i>
                            <h5>Update Course List</h5>
                        </a></div>
                    <div class="col-md-3 col-xs-6"><a href="<?= base_url("student/course/print/course-form") ?>"><i class="fa-3x fa fa-print"></i>
                            <h5>Print <?= getStudentLevel($level->current_level) ?> Course Form</h5>
                        </a></div>
                    <div class="col-md-3 col-xs-6"><a href="<?= base_url("student/course/print/exam-clearance") ?>"><i class="fa-3x fa fa-print"></i>
                            <h5>Print Exam Clearance</h5>
                        </a></div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $this->load->view("student/inc/footer") ?>