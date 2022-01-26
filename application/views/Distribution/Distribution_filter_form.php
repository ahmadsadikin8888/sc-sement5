<?php echo _css('selectize,datepicker,datatables') ?>
<?php
if (isset($_GET['success'])) {
?>
    <div class="col-lg-12 col-xs-12 blink_me_veri">
        <div class="small-box bg-green">
            <div class="inner">
                <h3 id="verified"><?php echo number_format($_GET['dibagi']); ?></h3>
                <p>Jumlah Data Yang Dibagikan</p>
            </div>
            <div class="icon-counter">
                <i class="fa fa-check-square-o"></i>
            </div>
        </div>
    </div>
<?php
}
?>
<?php echo card_open('Form', 'bg-green', true) ?>


<form method="POST" action="<?php echo $link_filter; ?>">
    <div class='row'>

        <div class='col-md-6 col-xl-6'>
            <div class='form-group'>
                <label class='form-label'>SEGMENT</label>
                <select id="segmentid" name="segmentid" class="form-control">
                    <option value="" selected="selected">All</option>
                    <option value="1">DCS</option>
                    <option value="2">DES</option>
                    <option value="3">DBS</option>
                    <option value="4">DCS_TOP20</option>
                    <option value="5">Indihome</option>
                    <option value="6">DGS</option>
                </select>
            </div>
        </div>
        <div class='col-md-6 col-xl-6'>
            <div class='form-group'>
                <label class='form-label'>BA</label>
                <select id="area" name="area" class="form-control">
                    <option value="" selected="selected">All</option>
                    <option value="R210">JABAR UTARA (KARAWANG)</option>
                    <option value="R211">JABAR UTARA (KARAWANG)</option>
                    <option value="R301">JABAR SELATAN (SUKABUMI)</option>
                    <option value="R302">JABAR SELATAN (SUKABUMI)</option>
                    <option value="R303">JABAR SELATAN (SUKABUMI)</option>
                    <option value="R304">JABAR SELATAN (SUKABUMI)</option>
                    <option value="R305">JABAR TENGAH (BANDUNG)</option>
                    <option value="R306">JABAR TENGAH (BANDUNG)</option>
                    <option value="R307">JABAR TENGAH (BANDUNG)</option>
                    <option value="R308">JABAR TENGAH (BANDUNG)</option>
                    <option value="R309">JABAR TENGAH (BANDUNG)</option>
                    <option value="R310">JABAR TIMSEL (TASIKMALAYA)</option>
                    <option value="R311">JABAR TIMSEL (TASIKMALAYA)</option>
                    <option value="R312">JABAR TIMSEL (TASIKMALAYA)</option>
                    <option value="R313">JABAR TIMSEL (TASIKMALAYA)</option>
                    <option value="R314">JABAR TIMSEL (TASIKMALAYA)</option>
                    <option value="R315">JABAR TIMUR (CIREBON)</option>
                    <option value="R316">JABAR TIMUR (CIREBON)</option>
                    <option value="R317">JABAR TIMUR (CIREBON)</option>
                    <option value="R318">JABAR TIMUR (CIREBON)</option>
                    <option value="R319">JABAR BARAT(BANDUNG BARAT)</option>

                </select>
            </div>
        </div>
        <div class='col-md-6 col-xl-6'>
            <div class='form-group'>
                <label class='form-label'>Tipe Call</label>
                <select id="tipe_call" name="tipe_call" class="form-control">
                    <option value="" selected="selected">All</option>
                    <option value="OTOMATIS">OTOMATIS</option>
                    <option value="DOWNLOAD">DOWNLOAD</option>
                    <option value="UPLOAD">UPLOAD</option>
                    <option value="RE-SCHEDULE">RE-SCHEDULE</option>
                    <option value="REUPLOAD">REUPLOAD</option>
                </select>
            </div>
        </div>
        <div class='col-md-6 col-xl-6'>
            <div class='form-group'>
                <label class='form-label'>To Do</label>
                <select id="to_do" name="to_do" class="form-control">
                    <option value="" selected="selected">All</option>
                    <option value="C">Billing Perdana</option>
                    <option value="E">Caring Collection N+1</option>
                    <option value="F">Caring Collection N+2</option>
                    <option value="U">Caring Collection N</option>

                </select>
            </div>
        </div>
        <div class='col-md-6 col-xl-6'>
            <div class='form-group'>
                <label class='form-label'>Nominal Tagihan</label>
                <select id="nominal" name="nominal" class="form-control">
                    <option value="" selected="selected">All</option>
                    <option value="1">&lt; 150K</option>
                    <option value="2">&gt; 150K - &lt; 500K</option>
                    <option value="3">&gt; 500k - 1 jt</option>
                    <option value="4">&gt; 1 jt</option>

                </select>
            </div>
        </div>
        <div class='col-md-12 col-xl-12'>
            <div class='form-group'>
                <button type='submit' class='btn btn-primary' name="action" value="filter"><i class="fe fe-search"></i> Change Filter</button>
            </div>
        </div>
        <div class='col-md-6 col-xl-6'>
            <div class='form-group'>
                <label class='form-label'>Jumlah Data</label>
                <input type="number" id="jumlah_data" max='<?php echo count($listna);?>' name="jumlah_data" class="form-control">
            </div>
        </div>
        <div class='col-md-12 col-xl-12'>

            <div class='form-group'>
                <button type='submit' class='btn btn-success' name="action" value="distribution"><i class="fe fe-save"></i> Distribution to PDS</button>
            </div>
        </div>
        <div class="col-lg-4 col-xs-4 ">
            <div class="small-box bg-primary">
                <div class="inner">
                    <h3 id="verified"><?php echo number_format(count($listna)); ?></h3>
                    <p>Waitlist</p>
                </div>
                <div class="icon-counter">
                    <i class="fa fa-plus-square-o"></i>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-xs-4 ">
            <div class="small-box bg-green">
                <div class="inner">
                    <h3 id="verified"><?php echo number_format($status_call['NEW POP UP']); ?></h3>
                    <p>NEW POP UP</p>
                </div>
                <div class="icon-counter">
                    <i class="fa fa-check-square-o"></i>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-xs-4 ">
            <div class="small-box bg-red">
                <div class="inner">
                    <h3 id="verified"><?php echo number_format($status_call[2]); ?></h3>
                    <p>Not Contacted</p>
                </div>
                <div class="icon-counter">
                    <i class="fa fa-times-circle-o"></i>
                </div>
            </div>
        </div>

    </div>
</form>


<?php echo card_close() ?>
<?php echo card_open('', 'bg-green', true) ?>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class='box-body table-responsive' id='box-table'>
                    <small>
                        <table class='timecard' id="report_table_reg" style="width: 100%;">
                            <thead>

                                <tr>
                                    <th>No.</th>
                                    <th nowrap>Trans ID</th>
                                    <th nowrap>CID</th>
                                    <th nowrap>Nama</th>
                                    <th nowrap>Alamat</th>
                                    <th nowrap>BA</th>
                                    <th nowrap>Tipe</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 0;
                                if (count($listna) > 0) {
                                    foreach ($listna as $ag) {
                                        $no++;
                                ?>
                                        <tr>
                                            <td><?php echo $no; ?></td>
                                            <td><?php echo $ag['TRANS_ID']; ?></td>
                                            <td><?php echo $ag['CID']; ?></td>
                                            <td><?php echo $ag['NAMA_MASTER']; ?></td>
                                            <td><?php echo $ag['ALAMAT_MASTER']; ?></td>
                                            <td><?php echo $ag['BA']; ?></td>
                                            <td><?php echo $ag['TIPE_CALL']; ?></td>
                                        </tr>
                                <?php
                                    }
                                }
                                ?>


                            </tbody>
                        </table>
                    </small>
                </div>
            </div>
            <script>
                $(document).ready(function() {
                    $('#report_table_reg').DataTable();
                });
            </script>
        </div>
    </div>
</div>
<?php echo card_close() ?>
<?php echo _js('selectize,datepicker,datatables') ?>

<script>
    var page_version = "1.0.8"
</script>

<script>
    var custom_select = $('.custom-select').selectize({});
    var custom_select_link = $('.custom-select-link');

    $(document).ready(function() {
        <?php
        /*
	|--------------------------------------------------------------
	| CARA MEMBUAT COMBOBOX LINK
	|--------------------------------------------------------------
	| COMBOBOX LINK adalah proses membuat sebuah combobox menjadi 
	| referensi combobox lainnya dalam menampilkan data.
	| misal :
	|  combobox grup menjadi referensi combobox subgrup.
	|  perubahan/pemilihan data combobox grup menyebabkan 
	|  perubahan data combobox subgrup. 
	|--------------------------------------------------------------
	| cara :
	|  - isi "field_link" pada combobox target 
	| 	 'field_link'	=>'nama_field_join_database'.
	|  - gunakan class "custom-select-link" pada kedua combobox ,
	|	 referensi dan target.
	|  - tambahkan script :
	|     linkToSelectize('id_cmb_referensi','id_cmb_target');
	|--------------------------------------------------------------
	| note :
	|   - struktur database harus menggunakan field id sebagai primary key
	|   - combobox harus di buat dengan php code
	|	-  "create_cmb_database" untuk row < 1000
	|	-  dan linkToSelectize untuk row < 1000
	|
	|	-  "create_cmb_database_bigdata" untuk row > 1000
	|	-  dan linkToSelectize_Big untuk row > 1000
	|   - 
	|   - class harus menggunakan "custom-select-link"
	|
	*/
        ?>
    })


    $('.data-sending').keydown(function(e) {
        remove_message();
        switch (e.which) {
            case 13:
                apply();
                return false;
        }
    });
</script>

<script>
    $('.input-simple-date').datepicker({
        autoclose: true,
        format: 'dd.mm.yyyy',
    })

    $('#btn-apply').click(function() {
        apply();
        play_sound_apply();
    });

    $('#btn-close').click(function() {
        play_sound_apply();
    });

    $('#btn-cancel').click(function() {
        cancel();
        play_sound_apply();
    });

    $('#btn-save').click(function() {
        simpan();
    })

    function apply() {
        $.each(custom_select, function(key, val) {
            val.selectize.disable();
        });

        <?php
        // NOTE : FOR DISABLE CUSTOM-SELECT-LINK 
        ?>
        // $.each(custom_select_link,function(key,val){
        // 		val.selectize.disable();
        // });

        $('.form-control').attr('disabled', true);
        $('#btn-apply').attr('disabled', true);
        $('#btn-cancel').attr('disabled', false);
        $('#btn-save').attr('disabled', false);
        $('#btn-save').focus();
    }

    function cancel() {
        $.each(custom_select, function(key, val) {
            val.selectize.enable();
        });
        <?php
        // NOTE : FOR ENABLE CUSTOM-SELECT-LINK  
        ?>
        // $.each(custom_select_link,function(key,val){
        // 		val.selectize.enable();
        // });

        $('.form-control').attr('disabled', false);
        $('#btn-cancel').attr('disabled', true);
        $('#btn-save').attr('disabled', true);
        $('#btn-apply').attr('disabled', false);

    }
</script>