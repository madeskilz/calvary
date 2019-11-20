</div>

<!-- Javascript -->
<script>
    let base_url = "<?= base_url(); ?>";
</script>
<script src="<?= base_url("inassets/bundles/libscripts.bundle.js") ?>"></script>
<script src="<?= base_url("inassets/bundles/vendorscripts.bundle.js") ?>"></script>

<script src="<?= base_url("inassets/vendor/toastr/toastr.js") ?>"></script>
<script src="<?= base_url("inassets/bundles/chartist.bundle.js") ?>"></script>
<script src="<?= base_url("inassets/bundles/knob.bundle.js") ?>"></script> <!-- Jquery Knob-->

<script src="<?= base_url("inassets/bundles/mainscripts.bundle.js") ?>"></script>
<script src="<?= base_url("inassets/bundles/datatablescripts.bundle.js") ?>"></script>
<?php if ($active === "payment") : ?>
    <?php $this->load->view("admin/inc/payment_script"); ?>
<?php endif; ?>
<?php if ($active === "result") : ?>
    <script>
        $("#sittings").on("change", () => {
            let sit = $("#sittings").val();
            if (sit == 1) {
                $("#sit2").hide();
                $(".sit_name").hide();
                $("#sit1").removeClass("col-md-6");
                $("#sit1").addClass("col-md-12");
            } else {
                $("#sit2").show();
                $(".sit_name").show();
                $("#sit1").removeClass("col-md-12");
                $("#sit1").addClass("col-md-6");
            }
        });
    </script>
<?php endif; ?>
<script>
    function loadname(img, previewName, incFileSize) {
        $("#image_err").text("");
        var isIE = (navigator.appName == "Microsoft Internet Explorer");
        var path = img.value;
        var ext = path.substring(path.lastIndexOf('.') + 1).toLowerCase();

        if (ext == "gif" || ext == "jpeg" || ext == "jpg" || ext == "png" || ext == "webp") {
            var f = img.files[0];
            var filesize = f.size;
            if (filesize > incFileSize) {
                $("#image_err").text("Image size too large");
                img.value = "";
                return false;
            }
            if (isIE) {
                $('#' + previewName).attr('src', path);
            } else {
                if (img.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        $('#' + previewName).attr('src', e.target.result);
                    }
                    reader.readAsDataURL(img.files[0]);
                }
            }

        } else {
            $("#image_err").text("Error Wrong Image Type");
            img.value = "";
        }
    }
</script>
</body>

</html>