<?php if (!$details->paid_application_fee) : ?>
    <script src="https://js.paystack.co/v1/inline.js"></script>
    <script>
        $(".paymentsTable").DataTable();
        toastr.options.closeButton = true;
        toastr.options.positionClass = 'toast-top-right';
        $('#payOnline').on('click', function(e) {
            e.preventDefault();
            let _this = $(this);
            _this.prop('disabled', true);
            $.ajax({
                url: base_url + 'ajax/pay_application_fee/',
                method: "POST",
                data: {},
                success: function(response) {
                    if (response.status === 'success') {
                        let data = {
                            'amount': response.amount,
                            'ref': response.message,
                            'key': response.key
                        };
                        console.log(data);
                        payWithPaystack(data);
                    } else {
                        toastr['success'](response.message);
                        console.log(response.message);
                        _this.prop('disabled', false);
                    }
                },
                error: function(response) {
                    console.log(response.responseText);
                }
            });

        });

        function payWithPaystack(data) {
            var handler = PaystackPop.setup({
                key: data.key,
                email: "<?= $this->session->userdata("email") ?>",
                amount: data.amount,
                currency: "NGN",
                ref: '' + data.ref,
                metadata: {
                    custom_fields: [{
                        display_name: "",
                        variable_name: "user",
                        value: "<?= explode("@", $this->session->userdata("email"))[0] ?>"
                    }]
                },
                callback: function(response) {
                    verifyPaystack(response.reference, data.ref);
                },
                onClose: function() {
                    toastr['info']("You closed the window, and for this reason we could'nt validate your payment");
                }
            });
            handler.openIframe();
        }

        function verifyPaystack(pref, ref) {
            $.ajax({
                url: base_url + 'ajax/verifyPaystack/',
                method: "POST",
                cache: false,
                data: {
                    'reference': pref,
                    'ref': ref
                },
                success: function(response) {
                    if (response.status === 'success') {
                        toastr['success'](response.message);
                        console.log(response.message);
                    } else {
                        toastr['error'](response.message);
                        console.log(response.message);
                    }
                    window.location.reload();
                },
                error: function(response) {
                    console.log(response.responseText);
                }
            });
        }
    </script>
<?php endif; ?>