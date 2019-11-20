<script>
    $(".paymentsTable").DataTable();
    toastr.options.closeButton = true;
    toastr.options.positionClass = 'toast-top-right';
</script>
<?php if (!$details->paid_application_fee) : ?>
    <script>
        $('#btnPayOnline').on('click', function(e) {
            // e.preventDefault();
            let _this = $(this);
            let pid = _this.data("pid");
            _this.prop('disabled', true);
            $.ajax({
                url: base_url + 'ajax/interswitchWebpay/',
                method: "POST",
                data: {
                    'pid': pid
                },
                success: function(response) {
                    if (response.status === 'success') {
                        $("#product_id").val(response.product_id);
                        $("#pay_item_id").val(response.pay_item_id);
                        $("#amount").val(response.amount);
                        $("#site_redirect_url").val(response.site_redirect_url);
                        $("#txn_ref").val(response.txn_ref);
                        $("#cust_id").val(response.cust_id);
                        $("#cust_name").val(response.cust_name);
                        $("#hash").val(response.hash);
                        $("#xml_data").val(response.xml_data);
                        $("#paymentForm").submit();
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