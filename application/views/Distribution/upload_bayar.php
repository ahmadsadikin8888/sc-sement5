<?php
// echo "INFORMATION DAPROS";
?>
<?php echo _css('datatables') ?>
<div class="col-sm-12 col-lg-12">


    <div class="alert alert-icon alert-success" role="alert">
        <i class="fe fe-check mr-2" aria-hidden="true"></i><small>Step 1. Pastikan Template disesuai(hanya kolom <b>TRANS_ID</b> dan <b>CID</b>)</small><br>
        <i class="fe fe-check mr-2" aria-hidden="true"></i><small>Step 2. Pastikan Sheet pada file Excel bernama "UPLOAD"</small><br>
        <i class="fe fe-check mr-2" aria-hidden="true"></i><small>Step 3. File Excel Dirubah dulu menjadi format excel 1997-2003 (Xls)</small><br>
        <i class="fe fe-check mr-2" aria-hidden="true"></i><small>Step 4. Konfirm dan Save</small>
    </div>

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Upload File Template</h3>
        </div>
        <div class="card-body">
            <div class="dimmer" id="box-upload">

                <div class="loader align-bottom text-center" style="width:200px">mohon tunggu..</div>
                <div class="dimmer-content">
                    <form id="form-a">
                        <div class="custom-file ">
                            <input type="file" class="custom-file-input " id="inputfile" name="inputfile">
                            <label class="custom-file-label form-control" id="label-input-file">Choose file</label>
                        </div>
                    </form>


                    <br>
                    <div class="alert alert-icon alert-success" role="alert" id="information-success">
                        <i class="fe fe-check mr-2" aria-hidden="true"></i><small>Information :</small><br>
                    </div>

                    <div class="alert alert-icon alert-danger" role="alert" id="information-failed">
                        <i class="fe fe-alert-triangle mr-2" aria-hidden="true"></i><small>Report :</small><br>
                    </div>

                </div>


            </div>
        </div>
    </div>
    <div id='hasil_upload'>

    </div>

</div>
<?php echo _js('datatables') ?>


<script>
    $(document).ready(function() {
        $('#inputfile').change(function() {
            $("#box-upload").addClass("active");
            upload_template();

        });
        $("#information-success").hide();
        $("#information-failed").hide();


    });

    function upload_template() {


        var form_el = $('#form-a')[0];

        var form_data = new FormData(form_el);
        form_data.append("<?php echo $this->security->get_csrf_token_name() ?>", get_sec_val());

        $.ajax({
            type: 'POST',
            enctype: 'multipart/form-data',
            url: "<?php echo $link_upload_template ?>",
            data: form_data,

            processData: false,
            contentType: false,
            cache: false,

            success: function(data) {
                var a = JSON.parse(data);
                sec_val = a.sec_val;
                var b = sec_val.split("=");
                var c = b[1].replace("&", "");
                $("#sec").val(c);

                if (a.success !== "false") {
                    $("#box-upload").removeClass("active");

                    $("#information-failed").hide();

                    $("#information-success").show();
                    $("#information-success").empty();
                    $("#information-success").append("<i class=\"fe fe-check mr-2\" aria-hidden=\"true\"></i><small>Information :</small><br>");
                    $("#information-success").append(a.message);

                    $('.custom-file-label').text(a.original_name);

                    $('#inputfile').val("");
                } else {
                    show_error_message(a.message);
                    play_sound_failed();
                    $("#box-upload").removeClass("active");

                    $("#information-success").hide();

                    $("#information-failed").show();
                    $("#information-failed").empty();
                    $("#information-failed").append("<i class=\"fe fe-alert-triangle mr-2\" aria-hidden=\"true\"></i><small>Report :</small><br>");
                    $("#information-failed").append(a.message);

                    $('.custom-file-label').text('Choose file');
                    $('#inputfile').val("");



                }



            },
            error: function(XMLHttpRequest, textStatus, errorThrown) {

            },

        });

    }
</script>
<script>
    function save(link) {
        $("#box-upload").addClass("active");
        var a = new ybsRequest();
        a.process(link);
        a.onAfterSuccess = function(data) {
            $("#hasil_upload").html(data);
            $("#box-upload").removeClass("active");
            $("#information-failed").hide();

            // $("#information-success").show();
            $("#information-success").hide();

            $("#information-success").empty();
            // $("#information-success").append("<i class=\"fe fe-check mr-2\" aria-hidden=\"true\"></i><small>Information :</small><br>");
            // $("#information-success").append(data.message);

        };
        a.onAfterFailed = function(data) {
            $("#box-upload").removeClass("active");
            $("#information-success").hide();

            $("#information-failed").show();
            $("#information-failed").empty();
            $("#information-failed").append("<i class=\"fe fe-alert-triangle mr-2\" aria-hidden=\"true\"></i><small>Report :</small><br>");
            $("#information-failed").append(data.message);
        }
    }
</script>