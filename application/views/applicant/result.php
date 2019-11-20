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
                        <li class="breadcrumb-item"><a href="<?=base_url("applicant")?>"><i class="icon-home"></i></a></li>
                        <li class="breadcrumb-item active">O'Level Result</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="card">
            <form method="post">
                <div class="row clearfix body">
                    <div class="col-md-12">
                        <?php $this->load->view("err-inc/msg") ?>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Exam Sitting(s)</label>
                            <select class="form-control" id="sittings" name="exam_sitting" required>
                                <option value="1">One</option>
                                <option value="2">Two</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-12 table-responsive" id="sit1">
                        <h5 class="sit_name">First Sitting</h5>
                        <div class="form-group">
                            <label>Exam Type</label>
                            <select class="form-control" name="exam_type" required>
                                <option value="">Select</option>
                                <?php foreach ($exam_types as $exam_type) : ?>
                                    <option value="<?= $exam_type->id ?>"><?= $exam_type->name ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Exam Number</label>
                            <input type="text" name="exam_no" class="form-control" required />
                        </div>
                        <div class="form-group">
                            <label>Exam Year</label>
                            <input type="month" name="exam_year" class="form-control xYear" required />
                        </div>
                        <table class="table m-b-0 table-bordered">
                            <thead class="thead-light">
                                <tr>
                                    <th>#</th>
                                    <th>Subject</th>
                                    <th>Grade</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php for ($i = 1; $i < 10; $i++) : ?>
                                    <tr>
                                        <td><?= $i . "." ?></td>
                                        <td>
                                            <select class="form-control" name="subject[]" <?= ($i == 9) ? "" : "required" ?>>
                                                <option value="">Select</option>
                                                <?php foreach ($subjects as $subject) : ?>
                                                    <option value="<?= $subject->id ?>"><?= $subject->name ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </td>
                                        <td>
                                            <select class="form-control" name="grade[]" <?= ($i == 9) ? "" : "required" ?>>
                                                <option value="">Select</option>
                                                <option value="A1">A1</option>
                                                <option value="B2">B2</option>
                                                <option value="B3">B3</option>
                                                <option value="C4">C4</option>
                                                <option value="C5">C5</option>
                                                <option value="C6">C6</option>
                                                <option value="D7">D7</option>
                                                <option value="E8">E8</option>
                                                <option value="F9">F9</option>
                                            </select>
                                        </td>
                                    </tr>
                                <?php endfor; ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-6 table-responsive" style="display:none;" id="sit2">
                        <h5 class="sit_name">Second Sitting</h5>
                        <div class="form-group">
                            <label>Exam Type</label>
                            <select class="form-control" name="exam_type2" id="exam_type2">
                                <option value="">Select</option>
                                <?php foreach ($exam_types as $exam_type) : ?>
                                    <option value="<?= $exam_type->id ?>"><?= $exam_type->name ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Exam Number</label>
                            <input type="text" name="exam_no2" id="exam_no2" class="form-control" />
                        </div>
                        <div class="form-group">
                            <label>Exam Year</label>
                            <input type="month" name="exam_year2" id="exam_year2" class="form-control xYear" />
                        </div>
                        <table class="table m-b-0 table-bordered">
                            <thead class="thead-light">
                                <tr>
                                    <th>#</th>
                                    <th>Subject</th>
                                    <th>Grade</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php for ($i = 1; $i < 10; $i++) : ?>
                                    <tr>
                                        <td><?= $i . "." ?></td>
                                        <td>
                                            <select class="form-control" name="subject2[]" id="subject2-<?=$i?>">
                                                <option value="">Select</option>
                                                <?php foreach ($subjects as $subject) : ?>
                                                    <option value="<?= $subject->id ?>"><?= $subject->name ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </td>
                                        <td>
                                            <select class="form-control" name="grade2[]" id="grade2-<?=$i?>">
                                                <option value="">Select</option>
                                                <option value="A1">A1</option>
                                                <option value="B2">B2</option>
                                                <option value="B3">B3</option>
                                                <option value="C4">C4</option>
                                                <option value="C5">C5</option>
                                                <option value="C6">C6</option>
                                                <option value="D7">D7</option>
                                                <option value="E8">E8</option>
                                                <option value="F9">F9</option>
                                            </select>
                                        </td>
                                    </tr>
                                <?php endfor; ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-12 text-right" style="margin-top:35px;">
                        <span style="color:#f34;">Confirm all results are correct before proceeding because they can't be changed.</span><br />
                        <button class="btn btn-primary">Continue to save O'Level Result</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<?php $this->load->view("applicant/inc/footer") ?>