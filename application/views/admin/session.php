<?php $this->load->view("admin/inc/header") ?>
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
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="icon-home"></i></a></li>
                        <li class="breadcrumb-item active">Dashboard</li>
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
                    <h4 class="title">Current Session: <?= $c_session->session ?> <span data-session="<?= $c_session->session ?>" data-status="<?= $c_session->status ?>" data-sid="<?= $c_session->id ?>" class="btn pull-right btn-outline-info upSess">Edit</span></h4>
                    <hr />
                    <h4 class="title">Next Session: <?= $n_session->session ?> <span data-session="<?= $n_session->session ?>" data-status="<?= $n_session->status ?>" data-sid="<?= $n_session->id ?>" class="btn pull-right btn-outline-info upSess">Edit</span></h4>
                    <?php foreach ($settings as $setting) { ?>
                        <hr />
                        <h4 class="title">
                            <?= $setting->item_name ?> :<?= ($setting->item_setting) ? "Yes" : "No" ?>
                            <span data-item_id="<?= $setting->id ?>" class="btn pull-right btn-outline-<?= ($setting->item_setting) ? "danger switch off" : "info switch on" ?>">
                                <?= ($setting->item_setting) ? "Turn Off" : "Turn On" ?>
                            </span>
                        </h4>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="updateModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="post">
                <div class="modal-header">
                    <h5 class="modal-title" id="title">Update Session</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label id="name">Session</label>
                        <input type="text" class="form-control" name="session" id="session" value="" />
                        <input type="hidden" name="id" id="id" value="" />
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
    String.prototype.capitalize = function() {
        return this.charAt(0).toUpperCase() + this.slice(1);
    }
    $(".upSess").on("click", function() {
        let sid = $(this).data("sid");
        let status = $(this).data("status");
        let session = $(this).data("session");
        $('#updateModal').find("#title").text(`Update ${status.capitalize()} Session`).end()
            .find("#name").text(`${status.capitalize()} Session`).end()
            .find("#id").val(sid).end()
            .find("#session").val(session).end()
            .modal('show');
    });
    $(".switch").on("click", function() {
        let act = ($(this).hasClass("on")) ? "on" : "off";
        let item_id = $(this).data("item_id");
        let des = confirm(`Are you sure you want to turn ${act}?`);
        if (!des) {
            return false;
        }
        $.ajax({
            url: "<?= base_url("admin/toggle_settings") ?>",
            method: "post",
            data: {
                "act": act,
                "item_id": item_id
            },
            success: function(response) {
                if (response.status === 'success') {
                    window.location.reload();
                    return true;
                } else {
                    toastr['error']("Error changing settings");
                    console.log(response.message);
                    return false;
                }
            },
            error: function(response) {
                console.log(response.responseText);
            }
        });
    });
</script>