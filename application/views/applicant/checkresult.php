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
                        <li class="breadcrumb-item active">Check Exam Result</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="row clearfix body">
                <div class="col-md-12" id="errorDiv">
                    <?php $this->load->view("err-inc/msg") ?>
                </div>
                <div class="col-md-12">
                    <h5>
                        To check your result click this button
                        <button id="btnCheckResult" class="btn btn-outline-info">Check My Result</button>
                    </h5>
                </div>
                <div class="col-md-12" id="resultDiv">
                </div>
            </div>
        </div>
    </div>
</div>
<?php $this->load->view("applicant/inc/footer") ?>
<script>
    $("#btnCheckResult").on("click", () => {
        $.ajax({
            url: "<?= base_url() ?>" + 'ajax/myresult/',
            method: "GET",
            success: function(response) {
                if (response.status === 'error') {
                    errorMessage = "";
                    errorMessage += '<div class="alert text-center alert-danger">';
                    errorMessage += response.message;
                    errorMessage += '</div>';
                    errorMessage += '<div class="alert text-center alert-info">';
                    errorMessage += "Your admission status is ";
                    errorMessage += (response.admission_status === "admitted") ?
                        `<b>${response.admission_status.charAt(0).toUpperCase()}${response.admission_status.slice(1)}</b>` +
                        " <a href='<?= base_url('applicant/acceptadmission') ?>'>Click Here to accept admission and proceed to clearance</a>" :
                        `<b>${response.admission_status.charAt(0).toUpperCase()}${response.admission_status.slice(1)}</b>`;
                    errorMessage += '</div>';
                    $("#resultDiv").html(errorMessage);
                } else {
                    errorMessage = "";
                    errorMessage += '<div class="alert text-center alert-success">';
                    errorMessage += response.message;
                    errorMessage += '</div>';
                    errorMessage += '<div class="alert text-center alert-info">';
                    errorMessage += "Your admission status is ";
                    errorMessage += (response.admission_status === "admitted") ?
                        `<b>${response.admission_status.charAt(0).toUpperCase()}${response.admission_status.slice(1)}</b>` +
                        " <a href='<?= base_url('applicant/acceptadmission') ?>'>Click Here to accept admission and proceed to clearance</a>" :
                        `<b>${response.admission_status.charAt(0).toUpperCase()}${response.admission_status.slice(1)}</b>`;
                    errorMessage += '</div>';
                    $("#resultDiv").html(errorMessage);
                }
            },
            error: function(response) {
                errorMessage = "";
                errorMessage += '<div class="alert text-center alert-danger">';
                errorMessage += response.responseText;
                errorMessage += '</div>';
                $("#errorDiv").html(errorMessage);
            }
        });
    });
</script>