<script>
    $(".paymentsTable").DataTable();
    toastr.options.closeButton = true;
    toastr.options.positionClass = 'toast-top-right';
</script>
<?php if (!$profile->paid_school_fee_2 || !$profile->paid_school_fee_2) : ?>
    <script>
        $('.btnPayOnline').on('click', function(e) {
            let _this = $(this);
            let pid = _this.data("pid");
            _this.prop('disabled', true);
            $.ajax({
                url: base_url + 'ajax/interswitchWebpay/',
                method: "POST",
                data: {
                    'pid': pid,
                    'type':"students"
                },
                success: function(response) {
                    if (response.status === 'success') {
                        $("#product_id" + pid).val(response.product_id);
                        $("#pay_item_id" + pid).val(response.pay_item_id);
                        $("#amount" + pid).val(response.amount);
                        $("#site_redirect_url" + pid).val(response.site_redirect_url);
                        $("#txn_ref" + pid).val(response.txn_ref);
                        $("#cust_id" + pid).val(response.cust_id);
                        $("#cust_name" + pid).val(response.cust_name);
                        $("#hash" + pid).val(response.hash);
                        $("#xml_data" + pid).val(response.xml_data);
                        $("#paymentForm" + pid).submit();
                        return true;
                    } else {
                        toastr['success'](response.message);
                        console.log(response.message);
                        return false;
                        _this.prop('disabled', false);
                    }
                },
                error: function(response) {
                    console.log(response.responseText);
                    _this.prop('disabled', false);
                }
            });
            return false;
        });
    </script>
<?php endif; ?>