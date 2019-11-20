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
    $("#school,#program").on("change", () => {
        $("#dept_err").show();
        let curVal = $("#school").val();
        let pVal = $("#program").val();
        if (pVal == "" || curVal == "") {
            $('#department').find('option').remove();
            var o = new Option("Select", "");
            $(o).html("Select");
            $("#department").append(o);
            return false;
        }
        $.ajax({
            url: "<?= base_url() ?>" + 'ajax/get_dept',
            method: 'POST',
            data: {
                'sid': curVal,
                'pid': pVal
            },
            success: response => {
                $('#department').find('option').remove();
                var o = new Option("Select", "");
                $(o).html("Select");
                $("#department").append(o);
                response.forEach(dept => {
                    var o = new Option(dept.name, dept.id);
                    $(o).html(dept.name);
                    $("#department").append(o);
                })
                $("#dept_err").hide();
            },
            error: (e) => {
                alert(e)
            }
        })
    })
    $("#state").on("change", () => {
        let curVal = $("#state").val();
        if (curVal == "") {
            $('#lga').find('option').remove();
            var o = new Option("Select", "");
            $(o).html("Select");
            $("#lga").append(o);
            return false;
        }
        $.ajax({
            url: "<?= base_url() ?>" + 'ajax/get_lga',
            method: 'POST',
            data: {
                'sid': curVal
            },
            success: response => {
                $('#lga').find('option').remove();
                var o = new Option("Select", "");
                $(o).html("Select");
                $("#lga").append(o);
                response.forEach(loc => {
                    var o = new Option(loc.local_name, loc.local_id);
                    $(o).html(loc.local_name);
                    $("#lga").append(o);
                })
            },
            error: (e) => {
                alert(e)
            }
        })
    })
    $('#btnApply').on("click", function() {
        let password = $("#password").val();
        let confirmPassword = $("#c_password").val();
        if (password !== confirmPassword) {
            let err = "<div class='alert alert-danger'>";
            err += "Error: Confirm password doesn't match";
            err += "</div>";
            $("#msgBox").html(err);
            return false;
        }
        return true;
    });
</script>