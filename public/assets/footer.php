<script src="assets/bootstrap/js/jquery.min.js"></script>
<script src="assets/bootstrap/js/bootstrap.min.js"></script>
<script src="assets/bootstrap/js/swiper.min.js"></script>
<script src="assets/bootstrap/js/jquery.dataTables.min.js"></script>
<script src="assets/bootstrap/js/dataTables.bootstrap4.min.js"></script>
<script src="assets/bootstrap/js/growl.min.js"></script>

<script src="assets/bootstrap/for_dataTable/buttons_dt.js"></script>
<script src="assets/bootstrap/for_dataTable/zip.js"></script>
<script src="assets/bootstrap/for_dataTable/pdfmake.js"></script>
<script src="assets/bootstrap/for_dataTable/pdf_fonts.js"></script>
<script src="assets/bootstrap/for_dataTable/buttons_html.js"></script>
<script src="assets/bootstrap/for_dataTable/print.js"></script>

<script>
    $(function () {
        $('[data-toggle="tooltip"]').tooltip();
    })
</script>

<script>
    $(function () {
        $("#setSeen").on("click", function () {

            var click = "";
            var id_number = $("#id_user_name").val();
            var is_seen = $.parseJSON($.ajax({
                url: "../seen.php",
                method: "POST",
                dataType: "json",
                data: {click:click, id_number:id_number},
                async: false
            }).responseText);

            if (is_seen == "Y"){
                $("#bell").removeClass("text-info");
                $("#bell").addClass("text-dark");
            }
        })
    })
</script>
<script>
    $(document).ready(function () {
        $("#assistantMessage").hide();
        $("#confirmpasswordassistant").on('keyup', function () {
            var password = $("#passwordassistant").val();
            var confirm =  $("#confirmpasswordassistant").val();
            console.log(password);
            console.log(confirm);
            if (password != confirm){
                $("#assistantMessage").show();
            }else{
                $("#assistantMessage").hide();
            }
        })
    });

    $(document).ready(function () {
        $("#Message").hide();
        $("#confirmpassword").on('keyup', function () {
            var password = $("#newpassword").val();
            var confirm =  $("#confirmpassword").val();
            console.log(password);
            console.log(confirm);
            if (password != confirm){
                $("#Message").show();
            }else{
                $("#Message").hide();
            }
        })
    })
</script>