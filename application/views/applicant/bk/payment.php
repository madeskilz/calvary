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
                <?php if (!$details->paid_application_fee) : ?>
                <div class="col-md-12">
                    <p>
                        This is a payment of a nonrefundable fee of &#8358; <?=number_format((int)$type->total, 2,".",",")?> only made on line with verve or master Card (ATM card).
                    </p>
                </div>
                <div class="col-md-6">
                    <table class="table">
                        <tbody>
                            <?php foreach ($payment_type as $type) { ?>
                            <tr>
                                <th>
                                    Payment Details:
                                </th>
                                <td style="text-transform:uppercase;">
                                    <?=$type->name?>
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    Amount: 
                                </th>
                                <td>
                                    &#8358; <?=number_format((int)$type->amount, 2,".",",")?>
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    Processing Fee:
                                </th>
                                <td>
                                    &#8358; <?=number_format((int)$type->process_charge, 2,".",",")?>
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    Total:
                                </th>
                                <td>
                                    &#8358; <?=number_format((int)$type->total, 2,".",",")?>
                                </td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
                <div class="col-md-6 row">
                    <div class="col-md-6">
                        <img src="<?= base_url("inassets/images/images.png") ?>" class="img-responsive" />
                    </div>
                    <div class="text-center col-md-6">
                        <img src="<?= base_url("inassets/images/mam.png") ?>" class="img-responsive" /><br />
                        <button class="btn btn-success btn-lg" id="payOnline">Pay Online</button>
                        <button class="btn btn-info btn-lg d-none">Pay in Bank</button>
                    </div>
                </div>
                <?php endif; ?>
                <?php if (count($payments) > 0) : ?>
                <div class="col-md-12" style="margin-top:20px;">
                    <h4>Payment History</h4>
                    <table class="paymentsTable table">
                        <thead>
                            <tr>
                                <th>S/N</th>
                                <th>Payment</th>
                                <th>Amount</th>
                                <th>Date Initiated</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $cc = 1;
                                foreach ($payments as $payment) : ?>
                            <tr>
                                <td><?= $cc ?></td>
                                <td><?= get_payment_type($payment->type) ?></td>
                                <td><?= $payment->amount + $payment->charge ?></td>
                                <td><?= neatDate($payment->date_initiated) ?></td>
                                <td>
                                    <?php if ($payment->status === "pending") : ?>
                                    <?php if ($payment->method === "online") : ?>
                                    <?= $payment->payment_status ?> <a href="<?= base_url("payment/verifyOnlinePayment/$payment->id") ?>">Verify</a>
                                    <?php else : ?>
                                    <?= $payment->payment_status ?> <a href="<?= base_url("payment/verifyBankPayment/$payment->id") ?>">Verify</a>
                                    <?php endif; ?>
                                    <?php elseif ($payment->status === "approved") : ?>
                                    <?= $payment->payment_status ?>
                                    <a target="_blank" href="<?= base_url("printer/printReceipt/$payment->reference") ?>" class="btn btn-outline-info" title="Print">
                                        <i class="fa fa-print"></i> Print Receipt
                                    </a>
                                    <?php else : ?>
                                    <?= $payment->payment_status ?>
                                    <?php endif; ?>
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
<?php $this->load->view("applicant/inc/footer") ?>