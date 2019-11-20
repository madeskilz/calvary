<?php $this->load->view("home/inc/header") ?>
<style>
    .input-box label {
        color: #a3a3a3 !important;
        font-weight: 400 !important;
    }

    .form-container {
        box-shadow: 2px 2px 8px 2px #a6a6a6;
        padding-bottom: 20px;
    }

    #image_err {
        color: #f34;
        font-size: 10px;
    }

    input:not([type="file"]) {
        height: 34px !important;
    }
</style>
<div style="height:100px;"></div>
<section class="">
    <div class="container">
        <div class="">
            <h4 class="text-center" style="margin-bottom:20px;">Application Form for <?= getNextSession() ?> Academic Session</h4>
            <?= form_open_multipart(base_url("apply"), 'class="form-horizontal row" ') ?>

            <div class="col-sm-12 col-md-3 form-container" style="padding:50px 20px 50px 20px;height:fit-content;">
                <div class="text-center">
                    <img src="<?= base_url("inassets/images/user_blank.png") ?>" id="passport" style="width:150px;" />
                </div>
                <div class="input-box text-center">
                    <input name="image" type="file" placeholder="Upload File" accept="image/*" onchange="loadname(this,'passport', 25000)" id="image" required>
                </div>
                <div class="input-box text-center" style="margin-top:5px">
                    <p id="image_err"></p>
                </div>
                <div style="color:#f34;font-size:12px;">
                    Note:-<br />
                    * Photo must not be more than 25kb.<br />
                    * Accepted photo format: jpg, jpeg, png, gif<br />
                    * It MUST NOT be more than 1 year old<br />
                    * It must be in sharp focus and clear<br />
                    * It must be taken against a PLAIN background<br />
                    * It must be only you in the image
                </div>
            </div>
            <div class="col-md-1"></div>
            <div class="col-sm-12 col-md-8 form-container">
                <div class="section-title" style="padding-top:10px;">
                    <p style="margin-bottom:-10px;">Fill this form to continue with application</p>
                    <small style="color:#f34;">Note: All fields are required</small>
                </div>
                <div class="col-md-12" id="msgBox">
                    <?php $this->load->view("err-inc/msg") ?>
                </div>
                <div class="row" style="margin-top:10px;">
                    <h4 class="col-md-12" style="font-weight:600;">Personal Information</h4>
                    <div class="input-box col-md-6">
                        <label>Title</label>
                        <div class="input-group">
                            <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-user"></i></span></div>
                            <select class="form-control" name="title" required>
                                <option value="">Select</option>
                                <option value="Mr.">Mr.</option>
                                <option value="Mrs.">Mrs.</option>
                                <option value="Ms.">Ms.</option>
                            </select>
                        </div>
                    </div>
                    <div class="input-box col-md-6">
                        <label>Surname</label>
                        <div class="input-group">
                            <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-user"></i></span></div>
                            <input type="text" class="form-control" placeholder="Surname" name="lastname" required>
                        </div>
                    </div>
                    <div class="input-box col-md-6">
                        <label>First Name</label>
                        <div class="input-group">
                            <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-user"></i></span></div>
                            <input type="text" class="form-control" placeholder="First Name" name="firstname" required>
                        </div>
                    </div>
                    <div class="input-box col-md-6">
                        <label>Middle Name</label>
                        <div class="input-group">
                            <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-user"></i></span></div>
                            <input type="text" class="form-control" placeholder="Middle Name" name="middlename" required>
                        </div>
                    </div>
                    <div class="input-box col-md-6">
                        <label>Phone Number</label>
                        <div class="input-group">
                            <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-phone"></i></span></div>
                            <input type="text" class="form-control" placeholder="Phone Number" name="phone" required>
                        </div>
                    </div>
                    <div class="input-box col-md-6">
                        <label>Date of Birth</label>
                        <div class="input-group">
                            <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-calendar"></i></span></div>
                            <input type="date" class="form-control" placeholder="Date of Birth" name="dateofbirth" required>
                        </div>
                    </div>
                    <div class="input-box col-md-6">
                        <label>Gender</label>
                        <div class="input-group">
                            <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-male"></i></span></div>
                            <select class="form-control" name="gender" required>
                                <option value="">Select</option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                            </select>
                        </div>
                    </div>
                    <div class="input-box col-md-6">
                        <label>Marital Status</label>
                        <div class="input-group">
                            <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-user-plus"></i></span></div>
                            <select class="form-control" name="marital_status" required>
                                <option value="">Select</option>
                                <option value="Single">Single</option>
                                <option value="Married">Married</option>
                                <option value="Widowed">Widowed</option>
                                <option value="Divorced">Divorced</option>
                            </select>
                        </div>
                    </div>
                    <div class="input-box col-md-6">
                        <label>Address</label>
                        <div class="input-group">
                            <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-map-marker"></i></span></div>
                            <textarea class="form-control" name="address" required rows="1"></textarea>
                        </div>
                    </div>
                    <div class="input-box col-md-6">
                        <label>Country of Birth</label>
                        <div class="input-group">
                            <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-globe"></i></span></div>
                            <select class="form-control" name="country" required>
                                <option value="">Select</option>
                                <option value="Nigeria">Nigeria</option>
                            </select>
                        </div>
                    </div>
                    <div class="input-box col-md-6">
                        <label>State of Origin</label>
                        <div class="input-group">
                            <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-map"></i></span></div>
                            <select class="form-control" name="state" id="state" required>
                                <option value="">Select</option>
                                <?php foreach ($states as $state) : ?>
                                    <option value="<?= $state->id ?>"><?= $state->name ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="input-box col-md-6">
                        <label>Local Government</label>
                        <div class="input-group">
                            <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-map"></i></span></div>
                            <select class="form-control" name="lga" id="lga" required>
                                <option value="">Select</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row" style="margin-top:10px;">
                    <h4 class="col-md-12" style="font-weight:600;">Jamb Information</h4>
                    <div class="input-box col-md-4">
                        <label>Exam Year</label>
                        <div class="input-group">
                            <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-calendar"></i></span></div>
                            <input class="form-control" type="month" placeholder="Exam Year" name="jamb_year" required>
                        </div>
                    </div>
                    <div class="input-box col-md-4">
                        <label>Registration Number</label>
                        <div class="input-group">
                            <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-user"></i></span></div>
                            <input class="form-control" type="text" placeholder="Registeration Number" name="jamb_reg_no" required>
                        </div>
                    </div>
                    <div class="input-box col-md-4">
                        <label>Score</label>
                        <div class="input-group">
                            <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-book"></i></span></div>
                            <input type="text" class="form-control" placeholder="Score" name="jamb_score" required>
                        </div>
                    </div>
                </div>
                <div class="row" style="margin-top:10px;">
                    <h4 class="col-md-12" style="font-weight:600;">Academic Information</h4>
                </div>
                <div class="row">
                    <div class="input-box col-md-4">
                        <label>Faculty / School</label>
                        <div class="input-group">
                            <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-graduation-cap"></i></span></div>
                            <select class="form-control" name="school" id="school" required>
                                <option value="">Select</option>
                                <?php foreach ($schools as $school) : ?>
                                    <option value="<?= $school->id ?>"><?= $school->name ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="input-box col-md-4">
                        <label>Certification Category</label>
                        <div class="input-group">
                            <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-building"></i></span></div>
                            <select class="form-control" required id="program" name="program">
                                <option value="">Select</option>
                                <?php foreach ($programs as $program) : ?>
                                    <option value="<?= $program->id ?>"><?= $program->name ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="input-box col-md-4">
                        <label>Program / Course / Department</label>
                        <div class="input-group">
                            <div class="input-group-prepend"><span class="input-group-text"><i class="fas fa-university"></i></span></div>
                            <select class="form-control" name="department" id="department" required>
                                <option value="">Select</option>
                            </select>
                        </div>
                        <small style="color:#f34;" id="dept_err">Select Program & School First</small>
                    </div>
                </div>
                <div class="row" style="margin-top:10px;">
                    <h4 class="col-md-12" style="font-weight:600;">Alternative Contact</h4>
                    <div class="input-box col-md-4">
                        <label>Relationship</label>
                        <div class="input-group">
                            <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-users"></i></span></div>
                            <select class="form-control" name="alt_contact_rel" required>
                                <option value="">Select</option>
                                <option value="Parent">Parent</option>
                                <option value="Guardian">Guardian</option>
                                <option value="Next of kin">Next of kin</option>
                            </select>
                        </div>
                    </div>
                    <div class="input-box col-md-4">
                        <label>Full Name</label>
                        <div class="input-group">
                            <div class="input-group-prepend"><span class="input-group-text"><i class="fas fa-user-tie"></i></span></div>
                            <input type="text" class="form-control" placeholder="Full Name" name="alt_contact_name" required>
                        </div>
                    </div>
                    <div class="input-box col-md-4">
                        <label>Phone Number</label>
                        <div class="input-group">
                            <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-mobile"></i></span></div>
                            <input type="text" class="form-control" placeholder="Phone Number" name="alt_contact_phone" required>
                        </div>
                    </div>
                </div>
                <div class="row" style="margin-top:10px;">
                    <h4 class="col-md-12" style="font-weight:600;">Account Information</h4>
                    <div class="input-box col-md-4">
                        <label>Email</label>
                        <div class="input-group">
                            <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-envelope"></i></span></div>
                            <input type="email" class="form-control" placeholder="Email" name="email" required>
                        </div>
                    </div>
                    <div class="input-box col-md-4">
                        <label>Password</label>
                        <div class="input-group">
                            <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-paste"></i></span></div>
                            <input type="password" class="form-control" placeholder="Password" name="password" id="password" required>
                        </div>
                    </div>
                    <div class="input-box col-md-4">
                        <label>Confirm Password</label>
                        <div class="input-group">
                            <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-paste"></i></span></div>
                            <input type="password" class="form-control" placeholder="Confirm Password" id="c_password" required>
                        </div>
                    </div>
                </div>
                <div class="submit-slide input-group" style="margin-top:10px;">
                    <button class="btn btn-info btn-lg float-right" id="btnApply">Apply</button>
                </div>
            </div>
            </form>
        </div>
    </div>
</section>
<?php $this->load->view("home/inc/footer") ?>