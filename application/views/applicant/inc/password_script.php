<script>
    $('#btnChange').on("click", function() {
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