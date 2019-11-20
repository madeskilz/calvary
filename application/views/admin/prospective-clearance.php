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
                        <li class="breadcrumb-item active">Applicants Clearance</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="row clearfix body">
                <div class="col-md-12">
                    <?php $this->load->view("err-inc/msg") ?>
                </div>
                <?php if (count($prospectives) > 0) : ?>
                    <div class="col-md-12 table-responsive" style="margin-top:20px;">
                        <h4>Prospective Students</h4>
                        <table class="appTable table">
                            <thead>
                                <tr>
                                    <th>S/N</th>
                                    <th>Full Name</th>
                                    <th>Application No</th>
                                    <th>Program</th>
                                    <th>School</th>
                                    <th>Department</th>
                                    <th>Clearance Code</th>
                                    <th>Matric Number</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $cc = 1;
                                    foreach ($prospectives as $ap) : ?>
                                    <tr>
                                        <td><?= $cc ?></td>
                                        <td><?= "$ap->lastname $ap->firstname $ap->middlename" ?></td>
                                        <td><?= $ap->admission_no ?></td>
                                        <td><?= get_program(get_department($ap->department)->program)->name ?></td>
                                        <td><?= get_school(get_department($ap->department)->school_id)->name ?></td>
                                        <td><?= get_department($ap->department)->name ?></td>
                                        <td><?= get_clearance($ap->user_id) ?></td>
                                        <td><?= get_matric($ap->user_id) ?></td>
                                        <td>
                                            <?php if ("not cleared" == get_clearance($ap->user_id)) { ?>
                                                <a data-sch="<?= get_school(get_department($ap->department)->school_id)->name ?>" data-prog="<?= get_program(get_department($ap->department)->program)->name ?>" data-dept="<?= get_department($ap->department)->name ?>" data-app_no="<?= $ap->admission_no ?>" data-user_name="<?= "$ap->lastname $ap->firstname $ap->middlename" ?>" href="javascript:;" data-user_id="<?= $ap->user_id ?>" class="clear_student">
                                                    Clear Applicant
                                                </a>
                                            <?php } else { ?>
                                                <span class="badge badge-info">Student Cleared</span>
                                            <?php } ?>
                                        </td>
                                    </tr>
                                <?php $cc++;
                                    endforeach; ?>
                            </tbody>
                        </table>
                    </div>
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
                    <h5 class="modal-title" id="title">Student Clearance</h5>
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
                        <h6>Program: <span id="prog"></span></h6>
                    </div>
                    <div class="form-group">
                        <h6>School: <span id="sch"></span></h6>
                    </div>
                    <div class="form-group">
                        <h6>Department: <span id="dept"></span></h6>
                    </div>
                    <div class="form-group">
                        <label>Matric No</label>
                        <input type="text" class="form-control" name="matric_no" id="matric_no" value="" />
                        <input type="hidden" name="user_id" id="user_id" value="" />
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
    $(".clear_student").on("click", function(e) {
        let user_id = $(this).data("user_id");
        let user_name = $(this).data("user_name");
        let app_no = $(this).data("app_no");
        let dept = $(this).data("dept");
        let sch = $(this).data("sch");
        let prog = $(this).data("prog");
        $('#updateModal').find("#user_name").text(user_name).end()
            .find("#app_no").text(app_no).end()
            .find("#user_id").val(user_id).end()
            .find("#prog").text(prog).end()
            .find("#sch").text(sch).end()
            .find("#dept").text(dept).end()
            .modal('show');
    });
</script>