<?php $this->load->view("prospective/inc/header") ?>
<style>
    @media screen and (min-width:768px) {
        .myImg {
            position: absolute;
            right: 0;
            top: 70px;
        }
    }
</style>
<div id="main-content">
    <div class="container">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-6 col-md-8 col-sm-12">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?= base_url("prospective") ?>"><i class="icon-home"></i></a></li>
                        <li class="breadcrumb-item active">Clearance Procedure</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="row clearfix body">
                <div class="col-md-12">
                    <?php $this->load->view("err-inc/msg") ?>
                </div>
                <div class="col-md-12">
                    <h5 style="font-weight:600;">Clearance Procedure</h4>
                        <p>All newly admitted students should take note of these procedures for successful clearance and
                            proper registration into the school.</p>
                        <p>The admitted candidates are to go to admissions office with the following documents.
                            Check your result and ensure that your ADMISSION STATUS is <b>ADMITTED</b>
                            <p>
                                <p>Click on Make Payment to make payment for your <b>acceptance fee</b>.</p>
                                <p>Proceed to the admission office with your credential/document (NB: come with original for verificatuion):
                                    <ul>
                                        <li>Two (2) photocopies of the following, WAEC / NECO / NABTEB O'Level results
                                        </li>
                                        <li>Two (2) copies of UTME Score(JAMB Print Out) – <b>For ND Applicants</b>
                                        </li>
                                        <li>Two (2) copies of A’ Level/NCE/ND/HND Results – <b>For HND Applicants</b>
                                        </li>
                                        <li>Two (2) copies of Transfer documents – <b>For Transfer Applicants</b>
                                        </li>
                                        <li>Two (2) copies of Application Fee Payment Receipt printed online for online application
                                        </li>
                                        <li>Two (2) copies of Application Form printed online
                                        </li>
                                        <li>Two (2) copies of Certificate of Local Government Origin
                                        </li>
                                        <li>Five (5) recent passport photographs
                                        </li>
                                        <li>Two (2) copies of Payment Receipt printed online for admission acceptance fee (Ensure you
                                            are admitted before making this non-refundable payment)
                                        </li>
                                        <li>Two (2) copies of Clearance Form printed online
                                        </li>
                                        <li>A letter from parents or reputable person in the society attesting to candidate's behaviour
                                            and who can be held responsible if the student misbehave.
                                        </li>
                                        <li>A letter of undertaking to be of good behaviour.
                                        </li>
                                        <li>Obtain Clearance Code from the ICT Centre (Ensure that you print and go with your
                                            Clearance Form to ICT Centre)
                                        </li>
                                        <li>Login to the web portal (PROSPECTIVE STUDENTS) to pay your school fee and use your Clearance Code to 
                                            obtain your matriculation number and admission letter.</li>
                                    </ul>
                                </p>
                                <p style="font-weight:500">Note: You are advice to go with all the original of your credential/document for citation.</p>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $this->load->view("prospective/inc/footer") ?>