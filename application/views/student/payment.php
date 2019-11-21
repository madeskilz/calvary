<?php $this->load->view("student/inc/header") ?>
<div id="main-content">
    <div class="container">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-6 col-md-8 col-sm-12">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?= base_url("applicant") ?>"><i class="icon-home"></i></a></li>
                        <li class="breadcrumb-item active">Pay School Fees</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="row clearfix body">
                <div class="col-md-12" id="errorDiv">
                    <?php $this->load->view("err-inc/msg") ?>
                </div>
                <?php if ((($level->position == 1) && !$profile->paid_school_fee_1) || (($level->position == 2) && !$profile->paid_school_fee_2)) { ?>
                    <div class="col-md-12">
                        <p>
                            Payments can be made on line using verve or master Card (ATM card).
                        </p>
                    </div>
                <?php }
                $i = 1;
                foreach ($payment_type as $type) { ?>
                    <?php if ((($level->position == 1) && !$profile->paid_school_fee_1 && $type->level == $level->id)
                            || (($level->position == 2) && !$profile->paid_school_fee_2 && $type->level == $level->id)
                        ) { ?>
                        <div class="col-md-6" style="margin-bottom:50px;">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th>
                                            Payment Details:
                                        </th>
                                        <td style="text-transform:uppercase;">
                                            <?= $type->name ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            Amount:
                                        </th>
                                        <td>
                                            <?= naira($type->amount) ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            Processing Fee:
                                        </th>
                                        <td>
                                            <?= naira($type->process_charge) ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            Total:
                                        </th>
                                        <td>
                                            <?= naira($type->total) ?>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-md-6 row">
                            <div class="col-md-6">
                                <img src="<?= base_url("inassets/images/images.png") ?>" class="img-responsive" />
                            </div>
                            <div class="text-center col-md-6">
                                <form method="post" id="paymentForm<?= $type->id ?>" action="<?= INTERSWITCH_LIVE_ACTION_URL ?>">
                                    <img src="<?= base_url("inassets/images/mam.png") ?>" class="img-responsive" /><br />
                                    <input name="product_id" id="product_id<?= $type->id ?>" type="hidden" />
                                    <input name="pay_item_id" id="pay_item_id<?= $type->id ?>" type="hidden" />
                                    <input name="amount" id="amount<?= $type->id ?>" type="hidden" />
                                    <input name="currency" id="currency<?= $type->id ?>" type="hidden" value="566" />
                                    <input name="site_redirect_url" id="site_redirect_url<?= $type->id ?>" type="hidden" />
                                    <input name="txn_ref" id="txn_ref<?= $type->id ?>" type="hidden" />
                                    <input name="cust_id" id="cust_id<?= $type->id ?>" type="hidden" />
                                    <input name="cust_name" id="cust_name<?= $type->id ?>" type="hidden" />
                                    <input name="hash" id="hash<?= $type->id ?>" type="hidden" />
                                    <input name="payment_params" id="payment_params<?= $type->id ?>" type="hidden" value="college_split" />
                                    <input name="xml_data" id="xml_data<?= $type->id ?>" type="hidden" value='' />
                                    <button class="btn btnPayOnline btn-success btn-lg" data-pid="<?= $type->id ?>">Pay <?= $type->name ?> Online</button>
                                </form>
                            </div>
                        </div>
                <?php };
                } ?>
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
                                                <span class="badge badge-warning"><?= $payment->payment_status ?></span> <a href="<?= base_url("payment/verifyPayment/$payment->reference") ?>">Verify</a>
                                            <?php elseif ($payment->status === "approved") : ?>
                                                <span class="badge badge-success"><?= $payment->payment_status ?></span>
                                                <a target="_blank" href="<?= base_url("printer/printReceipt/$payment->reference") ?>" class="btn btn-outline-info" title="Print">
                                                    <i class="fa fa-print"></i> Print Receipt
                                                </a>
                                            <?php else : ?>
                                                <span class="badge badge-danger"><?= $payment->payment_status ?></span>
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
<?php $this->load->view("student/inc/footer") ?>