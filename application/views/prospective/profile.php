<?php $this->load->view("prospective/inc/header") ?>
<div id="main-content" class="profilepage_2 blog-page">
    <div class="container">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-6 col-md-8 col-sm-12">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="icon-home"></i></a></li>
                        <li class="breadcrumb-item active">My Profile</li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="row clearfix">

            <div class="col-lg-4 col-md-12">
                <div class="card profile-header">
                    <div class="body">
                        <div class="profile-image">
                            <?php if ($profile->image) : ?>
                            <img src="<?= base_url("sitefiles/applicants/images/" . $profile->image) ?>" class="rounded-circle" style="width:150px;object-fit:cover;height:150px;"/>
                            <?php else : ?>
                            <img src="<?= base_url("assets/images/user-blank.png") ?>" class="rounded-circle" />
                            <?php endif; ?>
                        </div>
                        <div>
                            <h4 class="m-b-5"><strong><?= $profile->lastname ?></strong> <?= $profile->firstname ?> <?= $profile->middlename ?></h4>
                            <?php if ($profile->matric_no) : ?>
                            <p><?= $profile->matric_no ?></p>
                            <?php else : ?>
                            <p><?= $profile->admission_no ?></p>
                            <?php endif; ?>
                            <p><?= $profile->phone ?></p>
                            <p><?= $this->session->userdata("email") ?></p>
                            <p><?= $profile->address ?></p>
                        </div>
                    </div>
                </div>

            </div>
            <div class="col-lg-8 col-md-12">


                <div class="card">
                    <div class="header">
                        <h2>Personal Information</h2>
                    </div>
                    <div class="body row">
                        <div class="col-md-6">
                            <small class="text-muted">Status: </small>
                            <p class="badge badge-info bg-info text-white">Fresher</p>
                            <hr>
                        </div>
                        <div class="col-md-6">
                            <small class="text-muted">Program: </small>
                            <p><?= get_program($program)->name ?></p>
                            <hr>
                        </div>
                        <div class="col-md-6">
                            <small class="text-muted">School: </small>
                            <p><?= get_school($school)->name ?></p>
                            <hr>
                        </div>
                        <div class="col-md-6">
                            <small class="text-muted">Department: </small>
                            <p><?= get_department($profile->department)->name ?></p>
                            <hr>
                        </div>
                        <div class="col-md-6">
                            <small class="text-muted">Local Government: </small>
                            <p><?= get_lga($profile->lga)->local_name ?></p>
                            <hr>
                        </div>
                        <div class="col-md-6">
                            <small class="text-muted">State: </small>
                            <p><?= get_state($profile->state)->name ?></p>
                            <hr>
                        </div>
                        <div class="col-md-6">
                            <small class="text-muted">Country: </small>
                            <p><?= $profile->country ?></p>
                            <hr>
                        </div>
                        <div class="col-md-6">
                            <small class="text-muted">Birth Date: </small>
                            <p class="m-b-0"><?= neatDate($profile->dateofbirth) ?></p>
                            <hr>
                        </div>
                        <div class="col-md-12">
                            <small class="text-muted">Clearance: </small>
                            <p> Paid Acceptance Fee: <span><?= ($profile->paid_acceptance_fee) ? "<i class='fa fa-check m-r-5'></i>" : "<i class='fa fa-remove m-r-5'></i>" ?></p>
                            <p> Paid School Fee: <span><?= ($profile->paid_school_fee) ? "<i class='fa fa-check m-r-5'></i>" : "<i class='fa fa-remove m-r-5'></i>" ?></p>
                            <p> Has Matric Number: <span><?= ($profile->matric_no) ? "<i class='fa fa-check m-r-5'></i>" : "<i class='fa fa-remove m-r-5'></i>" ?></p>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>
</div>

</div>
<?php $this->load->view("prospective/inc/footer") ?>
<script>
    $(function() {
        $('.knob').knob({
            draw: function() {
                // "tron" case
                if (this.$.data('skin') == 'tron') {

                    var a = this.angle(this.cv) // Angle
                        ,
                        sa = this.startAngle // Previous start angle
                        ,
                        sat = this.startAngle // Start angle
                        ,
                        ea // Previous end angle
                        , eat = sat + a // End angle
                        ,
                        r = true;

                    this.g.lineWidth = this.lineWidth;

                    this.o.cursor &&
                        (sat = eat - 0.3) &&
                        (eat = eat + 0.3);

                    if (this.o.displayPrevious) {
                        ea = this.startAngle + this.angle(this.value);
                        this.o.cursor &&
                            (sa = ea - 0.3) &&
                            (ea = ea + 0.3);
                        this.g.beginPath();
                        this.g.strokeStyle = this.previousColor;
                        this.g.arc(this.xy, this.xy, this.radius - this.lineWidth, sa, ea, false);
                        this.g.stroke();
                    }

                    this.g.beginPath();
                    this.g.strokeStyle = r ? this.o.fgColor : this.fgColor;
                    this.g.arc(this.xy, this.xy, this.radius - this.lineWidth, sat, eat, false);
                    this.g.stroke();

                    this.g.lineWidth = 2;
                    this.g.beginPath();
                    this.g.strokeStyle = this.o.fgColor;
                    this.g.arc(this.xy, this.xy, this.radius - this.lineWidth + 1 + this.lineWidth * 2 / 3, 0, 2 * Math.PI, false);
                    this.g.stroke();

                    return false;
                }
            }
        });
    });
</script>
</body>

<!-- Mirrored from www.wrraptheme.com/templates/lucid/hr/html/h-menu/page-profile2.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 25 Jul 2019 09:56:40 GMT -->

</html>