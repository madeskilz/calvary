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
<?php if ($active === "apply") : ?>
    <?php $this->load->view("home/inc/application_script") ?>
<?php endif; ?>
<script src="<?= base_url("inassets/bundles/mainscripts.bundle.js") ?>"></script>
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
                $("#image_err").text("Error: Image size too large");
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
            $("#image_err").text("Error: Wrong Image Type");
            img.value = "";
            return false;
        }
    }
</script>
</body>

</html>