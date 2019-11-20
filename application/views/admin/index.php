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
            </div>
        </div>
    </div>
</div>
<?php $this->load->view("admin/inc/footer") ?>