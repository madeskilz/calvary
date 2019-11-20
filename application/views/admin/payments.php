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
                        <li class="breadcrumb-item active">Payment</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="row clearfix body">
                <div class="col-md-12">
                    <?php $this->load->view("err-inc/msg") ?>
                </div>
                <?php if (count($payments) > 0) : ?>
                    <div class="col-md-12 table-responsive" style="margin-top:20px;">
                        <h4>Payment History</h4>
                        <table class="paymentsTable table">
                            <thead>
                                <tr>
                                    <th>S/N</th>
                                    <th>Payment</th>
                                    <th>Student Name</th>
                                    <th>Reference</th>
                                    <th>Amount</th>
                                    <th>Approved Amount</th>
                                    <th>Date Initiated</th>
                                    <th>Txn Time</th>
                                    <th>Status</th>
                                    <th>Response Code</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $cc = 1;
                                    foreach ($payments as $payment) : ?>
                                    <tr>
                                        <td><?= $cc ?></td>
                                        <td><?= get_payment_type($payment->type) ?></td>
                                        <td><?= get_student_name($payment->user_id) ?></td>
                                        <td><?= $payment->reference ?></td>
                                        <td><?= $payment->total ?></td>
                                        <td><?= $payment->amount_paid ?></td>
                                        <td><?= neatDate($payment->date_initiated) ?></td>
                                        <td><?= neatTime($payment->date_initiated) ?></td>
                                        <td>
                                            <?php if ($payment->status === "pending") : ?>
                                                <span class="badge badge-warning"><?= $payment->payment_status ?></span>
                                            <?php elseif ($payment->status === "approved") : ?>
                                                <span class="badge badge-success"><?= $payment->payment_status ?></span>
                                            <?php else : ?>
                                                <span class="badge badge-danger"><?= $payment->payment_status ?></span>
                                            <?php endif; ?>
                                        </td>
                                        <td><?= $payment->response_code ?></td>
                                        <td>
                                            <?php if ($payment->status === "pending") { ?>
                                                <a href="<?= base_url("payment/verifyPayment/$payment->reference") ?>">Re-Query Status</a>
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
<?php $this->load->view("admin/inc/footer") ?>