<?php if ($this->session->flashdata('success_msg')): ?>
    <div class="alert text-center alert-success">
        <?php echo $this->session->flashdata('success_msg');
        unset($_SESSION['success_msg']); ?>
    </div>
<?php endif; ?>
<?php if ($this->session->flashdata('error_msg')): ?>
    <div class="alert text-center alert-danger">
        <?php echo $this->session->flashdata('error_msg');
        unset($_SESSION['error_msg']); ?>
    </div>
<?php endif; ?>
<?php if ($this->session->flashdata('msg')): ?>
    <div class="alert text-center alert-info">
        <?php echo $this->session->flashdata('msg');
        unset($_SESSION['msg']); ?>
    </div>
<?php endif; ?>