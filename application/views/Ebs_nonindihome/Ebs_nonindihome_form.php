
<?php echo _css('selectize,datepicker')?>

<?php echo card_open('Form','bg-green',true)?>	
	
	<form id='form-a'>
	<input hidden class='data-sending' id='id' value='<?php if(isset($id))echo $id?>'>
	
					<div class='col-md-12 col-xl-12'>
					<div class='form-group'>
							<label class='form-label'><?php echo $title->helpdesk_forcall_PETUGAS ?></label>
							<input type='text' class='form-control data-sending focus-color'  id='PETUGAS' name='PETUGAS' placeholder='<?php echo $title->general->desc_required ?>' value='<?php if(isset($data)) echo $data->PETUGAS ?>' >
					</div>
					</div>
			
			
					<div class='col-md-12 col-xl-12'>
					<div class='form-group'>
							<label class='form-label'><?php echo $title->helpdesk_forcall_ADDON ?></label>
							<input type='text' class='form-control data-sending focus-color'  id='ADDON' name='ADDON' placeholder='<?php echo $title->general->desc_required ?>' value='<?php if(isset($data)) echo $data->ADDON ?>' >
					</div>
					</div>
			
			
					<div class='col-md-12 col-xl-12'>
					<div class='form-group'>
							<label class='form-label'><?php echo $title->helpdesk_forcall_STATUS_SC ?></label>
							<input type='text' class='form-control data-sending focus-color'  id='STATUS_SC' name='STATUS_SC' placeholder='<?php echo $title->general->desc_required ?>' value='<?php if(isset($data)) echo $data->STATUS_SC ?>' >
					</div>
					</div>
			
			
					<div class='col-md-12 col-xl-12'>
					<div class='form-group'>
							<label class='form-label'><?php echo $title->helpdesk_forcall_NDEM ?></label>
							<input type='text' class='form-control data-sending focus-color'  id='NDEM' name='NDEM' placeholder='<?php echo $title->general->desc_required ?>' value='<?php if(isset($data)) echo $data->NDEM ?>' >
					</div>
					</div>
			
			
					<div class='col-md-12 col-xl-12'>
					<div class='form-group'>
							<label class='form-label'><?php echo $title->helpdesk_forcall_COPER ?></label>
							<input type='text' class='form-control data-sending focus-color'  id='COPER' name='COPER' placeholder='<?php echo $title->general->desc_required ?>' value='<?php if(isset($data)) echo $data->COPER ?>' >
					</div>
					</div>
			
			
					<div class='col-md-12 col-xl-12'>
					<div class='form-group'>
							<label class='form-label'><?php echo $title->helpdesk_forcall_CAGENT ?></label>
							<input type='text' class='form-control data-sending focus-color'  id='CAGENT' name='CAGENT' placeholder='<?php echo $title->general->desc_required ?>' value='<?php if(isset($data)) echo $data->CAGENT ?>' >
					</div>
					</div>
			
			
					<div class='col-md-12 col-xl-12'>
					<div class='form-group'>
							<label class='form-label'><?php echo $title->helpdesk_forcall_KAWASAN ?></label>
							<input type='text' class='form-control data-sending focus-color'  id='KAWASAN' name='KAWASAN' placeholder='<?php echo $title->general->desc_required ?>' value='<?php if(isset($data)) echo $data->KAWASAN ?>' >
					</div>
					</div>
			
			
					<div class='col-md-12 col-xl-12'>
					<div class='form-group'>
							<label class='form-label'><?php echo $title->helpdesk_forcall_WITEL ?></label>
							<input type='text' class='form-control data-sending focus-color'  id='WITEL' name='WITEL' placeholder='<?php echo $title->general->desc_required ?>' value='<?php if(isset($data)) echo $data->WITEL ?>' >
					</div>
					</div>
			
			
					<div class='col-md-12 col-xl-12'>
					<div class='form-group'>
							<label class='form-label'><?php echo $title->helpdesk_forcall_C_WITEL ?></label>
							<input type='text' class='form-control data-sending focus-color'  id='C_WITEL' name='C_WITEL' placeholder='<?php echo $title->general->desc_required ?>' value='<?php if(isset($data)) echo $data->C_WITEL ?>' >
					</div>
					</div>
			
			
					<div class='col-md-12 col-xl-12'>
					<div class='form-group'>
							<label class='form-label'><?php echo $title->helpdesk_forcall_C_DATEL_NEW ?></label>
							<input type='text' class='form-control data-sending focus-color'  id='C_DATEL_NEW' name='C_DATEL_NEW' placeholder='<?php echo $title->general->desc_required ?>' value='<?php if(isset($data)) echo $data->C_DATEL_NEW ?>' >
					</div>
					</div>
			
			
					<div class='col-md-12 col-xl-12'>
					<div class='form-group'>
							<label class='form-label'><?php echo $title->helpdesk_forcall_STO ?></label>
							<input type='text' class='form-control data-sending focus-color'  id='STO' name='STO' placeholder='<?php echo $title->general->desc_required ?>' value='<?php if(isset($data)) echo $data->STO ?>' >
					</div>
					</div>
			
			
					<div class='col-md-12 col-xl-12'>
					<div class='form-group'>
							<label class='form-label'><?php echo $title->helpdesk_forcall_CHANEL ?></label>
							<input type='text' class='form-control data-sending focus-color'  id='CHANEL' name='CHANEL' placeholder='<?php echo $title->general->desc_required ?>' value='<?php if(isset($data)) echo $data->CHANEL ?>' >
					</div>
					</div>
			
			
					<div class='col-md-12 col-xl-12'>
					<div class='form-group'>
							<label class='form-label'><?php echo $title->helpdesk_forcall_ALPRO ?></label>
							<input type='text' class='form-control data-sending focus-color'  id='ALPRO' name='ALPRO' placeholder='<?php echo $title->general->desc_required ?>' value='<?php if(isset($data)) echo $data->ALPRO ?>' >
					</div>
					</div>
			
			
					<div class='col-md-12 col-xl-12'>
					<div class='form-group'>
							<label class='form-label'><?php echo $title->helpdesk_forcall_TGL_VA ?></label>
							<input type='text' class='form-control data-sending focus-color'  id='TGL_VA' name='TGL_VA' placeholder='<?php echo $title->general->desc_required ?>' value='<?php if(isset($data)) echo $data->TGL_VA ?>' >
					</div>
					</div>
			
			
					<div class='col-md-12 col-xl-12'>
					<div class='form-group'>
							<label class='form-label'><?php echo $title->helpdesk_forcall_umur ?></label>
							<input type='text' class='form-control data-sending focus-color'  id='umur' name='umur' placeholder='<?php echo $title->general->desc_required ?>' value='<?php if(isset($data)) echo $data->umur ?>' >
					</div>
					</div>
			
			
					<div class='col-md-12 col-xl-12'>
					<div class='form-group'>
							<label class='form-label'><?php echo $title->helpdesk_forcall_cek ?></label>
							<input type='text' class='form-control data-sending focus-color'  id='cek' name='cek' placeholder='<?php echo $title->general->desc_required ?>' value='<?php if(isset($data)) echo $data->cek ?>' >
					</div>
					</div>
			
			
					<div class='col-md-12 col-xl-12'>
					<div class='form-group'>
							<label class='form-label'><?php echo $title->helpdesk_forcall_CGEST ?></label>
							<input type='text' class='form-control data-sending focus-color'  id='CGEST' name='CGEST' placeholder='<?php echo $title->general->desc_required ?>' value='<?php if(isset($data)) echo $data->CGEST ?>' >
					</div>
					</div>
			
			
					<div class='col-md-12 col-xl-12'>
					<div class='form-group'>
							<label class='form-label'><?php echo $title->helpdesk_forcall_CSEG ?></label>
							<input type='text' class='form-control data-sending focus-color'  id='CSEG' name='CSEG' placeholder='<?php echo $title->general->desc_required ?>' value='<?php if(isset($data)) echo $data->CSEG ?>' >
					</div>
					</div>
			
			
					<div class='col-md-12 col-xl-12'>
					<div class='form-group'>
							<label class='form-label'><?php echo $title->helpdesk_forcall_CCAT ?></label>
							<input type='text' class='form-control data-sending focus-color'  id='CCAT' name='CCAT' placeholder='<?php echo $title->general->desc_required ?>' value='<?php if(isset($data)) echo $data->CCAT ?>' >
					</div>
					</div>
			
			
					<div class='col-md-12 col-xl-12'>
					<div class='form-group'>
							<label class='form-label'><?php echo $title->helpdesk_forcall_LINECATS_FAMILY_LNAME ?></label>
							<input type='text' class='form-control data-sending focus-color'  id='LINECATS_FAMILY_LNAME' name='LINECATS_FAMILY_LNAME' placeholder='<?php echo $title->general->desc_required ?>' value='<?php if(isset($data)) echo $data->LINECATS_FAMILY_LNAME ?>' >
					</div>
					</div>
			
			
					<div class='col-md-12 col-xl-12'>
					<div class='form-group'>
							<label class='form-label'><?php echo $title->helpdesk_forcall_TEMATIK ?></label>
							<input type='text' class='form-control data-sending focus-color'  id='TEMATIK' name='TEMATIK' placeholder='<?php echo $title->general->desc_required ?>' value='<?php if(isset($data)) echo $data->TEMATIK ?>' >
					</div>
					</div>
			
			
					<div class='col-md-12 col-xl-12'>
					<div class='form-group'>
							<label class='form-label'><?php echo $title->helpdesk_forcall_ITEM ?></label>
							<input type='text' class='form-control data-sending focus-color'  id='ITEM' name='ITEM' placeholder='<?php echo $title->general->desc_required ?>' value='<?php if(isset($data)) echo $data->ITEM ?>' >
					</div>
					</div>
			
			
					<div class='col-md-12 col-xl-12'>
					<div class='form-group'>
							<label class='form-label'><?php echo $title->helpdesk_forcall_CPACK ?></label>
							<input type='text' class='form-control data-sending focus-color'  id='CPACK' name='CPACK' placeholder='<?php echo $title->general->desc_required ?>' value='<?php if(isset($data)) echo $data->CPACK ?>' >
					</div>
					</div>
			
			
					<div class='col-md-12 col-xl-12'>
					<div class='form-group'>
							<label class='form-label'><?php echo $title->helpdesk_forcall_PSB ?></label>
							<input type='text' class='form-control data-sending focus-color'  id='PSB' name='PSB' placeholder='<?php echo $title->general->desc_required ?>' value='<?php if(isset($data)) echo $data->PSB ?>' >
					</div>
					</div>
			
			
					<div class='col-md-12 col-xl-12'>
					<div class='form-group'>
							<label class='form-label'><?php echo $title->helpdesk_forcall_CBT ?></label>
							<input type='text' class='form-control data-sending focus-color'  id='CBT' name='CBT' placeholder='<?php echo $title->general->desc_required ?>' value='<?php if(isset($data)) echo $data->CBT ?>' >
					</div>
					</div>
			
			
					<div class='col-md-12 col-xl-12'>
					<div class='form-group'>
							<label class='form-label'><?php echo $title->helpdesk_forcall_MIG ?></label>
							<input type='text' class='form-control data-sending focus-color'  id='MIG' name='MIG' placeholder='<?php echo $title->general->desc_required ?>' value='<?php if(isset($data)) echo $data->MIG ?>' >
					</div>
					</div>
			
			
					<div class='col-md-12 col-xl-12'>
					<div class='form-group'>
							<label class='form-label'><?php echo $title->helpdesk_forcall_PRICE_PSB ?></label>
							<input type='text' class='form-control data-sending focus-color'  id='PRICE_PSB' name='PRICE_PSB' placeholder='<?php echo $title->general->desc_required ?>' value='<?php if(isset($data)) echo $data->PRICE_PSB ?>' >
					</div>
					</div>
			
			
					<div class='col-md-12 col-xl-12'>
					<div class='form-group'>
							<label class='form-label'><?php echo $title->helpdesk_forcall_PRICE_CBT ?></label>
							<input type='text' class='form-control data-sending focus-color'  id='PRICE_CBT' name='PRICE_CBT' placeholder='<?php echo $title->general->desc_required ?>' value='<?php if(isset($data)) echo $data->PRICE_CBT ?>' >
					</div>
					</div>
			
			
					<div class='col-md-12 col-xl-12'>
					<div class='form-group'>
							<label class='form-label'><?php echo $title->helpdesk_forcall_PRICE_MIG ?></label>
							<input type='text' class='form-control data-sending focus-color'  id='PRICE_MIG' name='PRICE_MIG' placeholder='<?php echo $title->general->desc_required ?>' value='<?php if(isset($data)) echo $data->PRICE_MIG ?>' >
					</div>
					</div>
			
			
					<div class='col-md-12 col-xl-12'>
					<div class='form-group'>
							<label class='form-label'><?php echo $title->helpdesk_forcall_FLAG_BUNDLING ?></label>
							<input type='text' class='form-control data-sending focus-color'  id='FLAG_BUNDLING' name='FLAG_BUNDLING' placeholder='<?php echo $title->general->desc_required ?>' value='<?php if(isset($data)) echo $data->FLAG_BUNDLING ?>' >
					</div>
					</div>
			
			
					<div class='col-md-12 col-xl-12'>
					<div class='form-group'>
							<label class='form-label'><?php echo $title->helpdesk_forcall_BUNDLING_2P3P ?></label>
							<input type='text' class='form-control data-sending focus-color'  id='BUNDLING_2P3P' name='BUNDLING_2P3P' placeholder='<?php echo $title->general->desc_required ?>' value='<?php if(isset($data)) echo $data->BUNDLING_2P3P ?>' >
					</div>
					</div>
			
			
					<div class='col-md-12 col-xl-12'>
					<div class='form-group'>
							<label class='form-label'><?php echo $title->helpdesk_forcall_BUNDLING_STB ?></label>
							<input type='text' class='form-control data-sending focus-color'  id='BUNDLING_STB' name='BUNDLING_STB' placeholder='<?php echo $title->general->desc_required ?>' value='<?php if(isset($data)) echo $data->BUNDLING_STB ?>' >
					</div>
					</div>
			
			
					<div class='col-md-12 col-xl-12'>
					<div class='form-group'>
							<label class='form-label'><?php echo $title->helpdesk_forcall_BUNDLING_WIFIEXT ?></label>
							<input type='text' class='form-control data-sending focus-color'  id='BUNDLING_WIFIEXT' name='BUNDLING_WIFIEXT' placeholder='<?php echo $title->general->desc_required ?>' value='<?php if(isset($data)) echo $data->BUNDLING_WIFIEXT ?>' >
					</div>
					</div>
			
			
					<div class='col-md-12 col-xl-12'>
					<div class='form-group'>
							<label class='form-label'><?php echo $title->helpdesk_forcall_EXTERNAL_ORDER_ID ?></label>
							<input type='text' class='form-control data-sending focus-color'  id='EXTERNAL_ORDER_ID' name='EXTERNAL_ORDER_ID' placeholder='<?php echo $title->general->desc_required ?>' value='<?php if(isset($data)) echo $data->EXTERNAL_ORDER_ID ?>' >
					</div>
					</div>
			
			
					<div class='col-md-12 col-xl-12'>
					<div class='form-group'>
							<label class='form-label'><?php echo $title->helpdesk_forcall_BUNDLING_INDIBOX ?></label>
							<input type='text' class='form-control data-sending focus-color'  id='BUNDLING_INDIBOX' name='BUNDLING_INDIBOX' placeholder='<?php echo $title->general->desc_required ?>' value='<?php if(isset($data)) echo $data->BUNDLING_INDIBOX ?>' >
					</div>
					</div>
			
			
					<div class='col-md-12 col-xl-12'>
					<div class='form-group'>
							<label class='form-label'><?php echo $title->helpdesk_forcall_ND_SPEEDY ?></label>
							<input type='text' class='form-control data-sending focus-color'  id='ND_SPEEDY' name='ND_SPEEDY' placeholder='<?php echo $title->general->desc_required ?>' value='<?php if(isset($data)) echo $data->ND_SPEEDY ?>' >
					</div>
					</div>
			
			
					<div class='col-md-12 col-xl-12'>
					<div class='form-group'>
							<label class='form-label'><?php echo $title->helpdesk_forcall_KCONTACT ?></label>
							<input type='text' class='form-control data-sending focus-color'  id='KCONTACT' name='KCONTACT' placeholder='<?php echo $title->general->desc_required ?>' value='<?php if(isset($data)) echo $data->KCONTACT ?>' >
					</div>
					</div>
			
			
					<div class='col-md-12 col-xl-12'>
					<div class='form-group'>
							<label class='form-label'><?php echo $title->helpdesk_forcall_XS6 ?></label>
							<input type='text' class='form-control data-sending focus-color'  id='XS6' name='XS6' placeholder='<?php echo $title->general->desc_required ?>' value='<?php if(isset($data)) echo $data->XS6 ?>' >
					</div>
					</div>
			
			
					<div class='col-md-12 col-xl-12'>
					<div class='form-group'>
							<label class='form-label'><?php echo $title->helpdesk_forcall_HASIL ?></label>
							<input type='text' class='form-control data-sending focus-color'  id='HASIL' name='HASIL' placeholder='<?php echo $title->general->desc_required ?>' value='<?php if(isset($data)) echo $data->HASIL ?>' >
					</div>
					</div>
			
			
					<div class='col-md-12 col-xl-12'>
					<div class='form-group'>
							<label class='form-label'><?php echo $title->helpdesk_forcall_KETERANGAN ?></label>
							<input type='text' class='form-control data-sending focus-color'  id='KETERANGAN' name='KETERANGAN' placeholder='<?php echo $title->general->desc_required ?>' value='<?php if(isset($data)) echo $data->KETERANGAN ?>' >
					</div>
					</div>
			
							 
	
	<div class='col-md-12 col-xl-12'>

	   <div class='form-group'>
		<button id='btn-apply' type='button' class='btn btn-primary'><i class='fe fe-check'></i> <?php echo $title->general->button_apply ?></button>	
		<button disabled='' id='btn-save' type='button' class='btn btn-primary'><i class="fe fe-save"></i> <?php echo $title->general->button_save ?></button>	
		<button disabled='' id='btn-cancel' type='button' class='btn btn-primary'> <?php echo $title->general->button_cancel ?></button>
		<a href='<?php echo $link_back ?>' id='btn-close' class='btn btn-primary'> <?php echo $title->general->button_close ?></a>
	   </div>
			 
	</div>
	</form>


<?php echo card_close()?>

<?php echo _js('selectize,datepicker')?>

<script>var page_version="1.0.8"</script>

<script> 
var custom_select = $('.custom-select').selectize({}); 	
var custom_select_link = $('.custom-select-link');

$(document).ready(function(){
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

	
$('.data-sending').keydown(function(e){
	remove_message();
	switch(e.which){
		case 13 :
		apply();
		return false;
	}
});

</script>

<script>
$('.input-simple-date').datepicker({ 
		autoclose: true ,
		format:'dd.mm.yyyy',
 })

$('#btn-apply').click(function(){
		apply();
		play_sound_apply();
});

$('#btn-close').click(function(){
	play_sound_apply();
});

$('#btn-cancel').click(function(){
	cancel();
	play_sound_apply();
});

$('#btn-save').click(function(){
	simpan();
})

function apply(){
	$.each(custom_select,function(key,val){
		val.selectize.disable();
	});
	
	<?php 
	// NOTE : FOR DISABLE CUSTOM-SELECT-LINK 
	?>
	// $.each(custom_select_link,function(key,val){
	// 		val.selectize.disable();
	// });
	
	$('.form-control').attr('disabled',true);
	$('#btn-apply').attr('disabled',true);
	$('#btn-cancel').attr('disabled',false);
	$('#btn-save').attr('disabled',false);
	$('#btn-save').focus();
}
function cancel(){
	$.each(custom_select,function(key,val){
		val.selectize.enable();
	});
	<?php 
	// NOTE : FOR ENABLE CUSTOM-SELECT-LINK  
	?>
	// $.each(custom_select_link,function(key,val){
	// 		val.selectize.enable();
	// });
	
	$('.form-control').attr('disabled',false);
	$('#btn-cancel').attr('disabled',true);
	$('#btn-save').attr('disabled',true);
	$('#btn-apply').attr('disabled',false);
	
}


function simpan(){
	<?php
	/* mengambil data yang akan di kirim dari form-a */
	/* dalam bentuk array json tanpa penutup.. */
	/* memungkinkan penambahan data dengan cara push */
	/* ex. data.push */
	?>
	var data = get_dataSending('form-a');
	
	<?php
	/* complite json format */
	/* ybs_dataSending(array); */
	?>
	send_data = ybs_dataSending(data);

	var a = new ybsRequest();
	a.process('<?php echo $link_save?>',send_data,'POST');
	a.onAfterSuccess = function(){
			cancel();
	}
	a.onBeforeFailed = function(){
			cancel();
	}
}


</script>

