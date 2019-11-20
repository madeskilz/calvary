<?php $this->load->view("admin/inc/header") ?>
<style>
    .sit_name {
        display: none;
    }

    div#DataTables_Table_0_wrapper>.row:first-child>.col-sm-12:last-child,
    div#DataTables_Table_0_wrapper>.row:last-child>.col-sm-12:last-child ul.pagination {
        text-align: right !important;
        float: right;
    }

    .form-group span {
        color: #5f85ad;
    }
</style>
<div id="main-content">
    <div class="container">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-6 col-md-8 col-sm-12">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?= base_url("applicant") ?>"><i class="icon-home"></i></a></li>
                        <li class="breadcrumb-item active">Applicants Admission Processing</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="row clearfix body">
                <div class="col-md-12">
                    <?php $this->load->view("err-inc/msg") ?>
                </div>
                <?php if (count($applicants) > 0) : ?>
                    <div class="col-md-12 table-responsive" style="margin-top:20px;">
                        <h4>Applicants</h4>
                        <table class="appTable table">
                            <thead>
                                <tr>
                                    <th>S/N</th>
                                    <th>Full Name</th>
                                    <th>Application No</th>
                                    <th>Exam Score</th>
                                    <th>Admission Status</th>
                                    <th>Action | <a href="<?= base_url("admin/applicant_exam/batch") ?>" class="btn btn-info">Batch Update</a></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $cc = 1;
                                    foreach ($applicants as $ap) : ?>
                                    <tr>
                                        <td><?= $cc ?></td>
                                        <td><?= "$ap->lastname $ap->firstname $ap->middlename" ?></td>
                                        <td><?= $ap->admission_no ?></td>
                                        <td><?= getAppExamScore($ap->user_id) ?></td>
                                        <td>
                                            <?php if ($ap->admission_status === "processing") : ?>
                                                <span class="badge badge-warning"><?= $ap->admission_status ?></span>
                                            <?php elseif ($ap->admission_status === "admitted") : ?>
                                                <span class="badge badge-success"><?= $ap->admission_status ?></span>
                                            <?php else : ?>
                                                <span class="badge badge-danger"><?= $ap->admission_status ?></span>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <a data-app_no="<?= $ap->admission_no ?>" data-user_name="<?= "$ap->lastname $ap->firstname $ap->middlename" ?>" href="javascript:;" data-status="<?= $ap->admission_status ?>" data-user_id="<?= $ap->user_id ?>" data-score="<?= getAppExamScore($ap->user_id) ?>" class="update_score">
                                                Update Score and Admission Status
                                            </a>
                                        </td>
                                    </tr>
                                <?php $cc++;
                                    endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                <?php else : ?>
                    <h5>No Apllication for processing</h5>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="updateModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="post">
                <div class="modal-header">
                    <h5 class="modal-title" id="title">Update Applicant Score and Status</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <h6>Name: <span id="user_name"></span></h6>
                    </div>
                    <div class="form-group">
                        <h6>Application Number: <span id="app_no"></span></h6>
                    </div>
                    <div class="form-group">
                        <label>Exam Score</label>
                        <input type="text" class="form-control" name="exam_score" id="exam_score" value="" />
                        <input type="hidden" name="user_id" id="user_id" value="" />
                    </div>
                    <div class="form-group">
                        <label>Admission Status</label>
                        <select class="form-control" name="admission_status" id="admission_status">
                            <option value="processing">Processing</option>
                            <option value="admitted">Admitted</option>
                            <option value="not-admitted">Not Admitted</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php $this->load->view("admin/inc/footer") ?>
<script>
    $(".appTable").DataTable();
    toastr.options.closeButton = true;
    toastr.options.positionClass = 'toast-top-right';
    $(".update_score").on("click", function(e) {
        let user_id = $(this).data("user_id");
        let user_name = $(this).data("user_name");
        let app_no = $(this).data("app_no");
        let score = $(this).data("score");
        let status = $(this).data("status");
        $('#updateModal').find("#user_name").text(user_name).end()
            .find("#app_no").text(app_no).end()
            .find("#user_id").val(user_id).end()
            .find("#exam_score").val(score).end()
            .find("#admission_status").val(status).end()
            .modal('show');
    });
</script>