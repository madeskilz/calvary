<script>
    $(document).ready(() => {
        let cVal = $("#state").val();
        if (cVal == "") {
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
                'sid': cVal
            },
            success: response => {
                $('#lga').find('option').remove();
                var o = new Option("Select", "");
                $(o).html("Select");
                $("#lga").append(o);
                response.forEach(loc => {
                    var o = new Option(loc.local_name, loc.local_id);
                    $(o).html(loc.local_name);
                    if (loc.local_id === "<?= $details->lga ?>") {
                        $(o).attr("selected", "true");
                    }
                    $("#lga").append(o);
                })
            },
            error: (e) => {
                alert(e)
            }
        });
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
                    if (dept.id === "<?= $details->department ?>") {
                        $(o).attr("selected", "true");
                    }
                    $("#department").append(o);
                })
                $("#dept_err").hide();
            },
            error: (e) => {
                alert(e)
            }
        });
    });
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
    $('#btnUpdate').on("click", function() {
        return true;
    });
</script>