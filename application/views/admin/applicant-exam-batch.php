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
</style>
<div id="main-content">
    <div class="container">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-6 col-md-8 col-sm-12">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?= base_url("applicant") ?>"><i class="icon-home"></i></a></li>
                        <li class="breadcrumb-item active">Applicants Exam Batch Updates</li>
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
                        <form method="post">
                            <table class="appTable table">
                                <thead>
                                    <tr>
                                        <th>S/N</th>
                                        <th>Full Name</th>
                                        <th>Application No</th>
                                        <th>Exam Score</th>
                                        <th>Admission Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $cc = 1;
                                        foreach ($applicants as $ap) : ?>
                                        <tr>
                                            <td><?= $cc ?></td>
                                            <td><?= "$ap->lastname $ap->firstname $ap->middlename" ?></td>
                                            <td><?= $ap->admission_no ?></td>
                                            <td><input type="text" class="form-control" name="exam_score[]" value="<?= getAppExamScore($ap->user_id) ?>" /></td>
                                            <td>
                                                <input type="hidden" name="user_id[]" value="<?= $ap->user_id ?>" />
                                                <select class="form-control" name="admission_status[]">
                                                    <option value="processing" <?= ($ap->admission_status == "processing") ? "selected" : "" ?>>Processing</option>
                                                    <option value="admitted" <?= ($ap->admission_status == "admitted") ? "selected" : "" ?>>Admitted</option>
                                                    <option value="not-admitted" <?= ($ap->admission_status == "not-admitted") ? "selected" : "" ?>>Not Admitted</option>
                                                </select>
                                            </td>
                                        </tr>
                                    <?php $cc++;
                                        endforeach; ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="5" class="text-right">
                                            <button class="btn btn-info">Batch Update</button>
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>
                        </form>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<?php $this->load->view("admin/inc/footer") ?>