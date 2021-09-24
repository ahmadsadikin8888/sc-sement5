<?php echo _css('datatables,icheck') ?>

<?php echo card_open('EBS Indihome', 'bg-teal', true) ?>
<div class='row'>
	SVC No :&nbsp; &nbsp; <input type="text" class="col-2 form-control"> &nbsp; <input type="submit" class="btn btn-primary" value="search">
</div>
<br>
<div class='box-body table-responsive' id='box-table'>
	<small>

	</small>
</div>
<div class="row border">
	<div class="col-8 border-right">
		<table class='responsive display nowrap' id="example" style="width: 100%;">
			<thead>
				<tr>
					<td style="cursor: default;">
						<div class="hdrcell">Email</div>
					</td>
					<td style="cursor: default;">
						<div class="hdrcell">opsi</div>
					</td>
					<td style="cursor: default;">
						<div class="hdrcell">Group ID</div>
					</td>
					<td>
						<div class="hdrcell">NCLI</div>
					</td>
					<td style="cursor: default;">
						<div class="hdrcell">No Internet</div>
					</td>
					<td style="cursor: default;">
						<div class="hdrcell">No Telepon</div>
					</td>
					<td>
						<div class="hdrcell">Nama</div>
					</td>
					<td style="cursor: default;">
						<div class="hdrcell">Alamat</div>
					</td>
					<td>
						<div class="hdrcell">BA</div>
					</td>
					<td>
						<div class="hdrcell">Centite</div>
					</td>
				</tr>
			</thead>
			<tbody>
				<tr class=" ev_dhx_skyblue rowselected">
					<td align="left" valign="middle">ahmadsadikin8888@gmail.com</td>
					<td align="left" valign="middle"><a href="#"><i class="fe fe-mail"></i> Send</a></td>
					<td align="left" valign="middle" title="9014010340927" class=" cellselected">9014010340927</td>
					<td align="left" valign="middle" title="51589599">51589599</td>
					<td align="left" valign="middle" title="131159124293">131159124293</td>
					<td align="left" valign="middle">02220669951</td>
					<td align="left" valign="middle" title="AHMAD SADIKIN">AHMAD SADIKIN</td>
					<td align="left" valign="middle">CIDAHU, NO. 5/1, DS TANIMULYA KAB BANDUNG 40552</td>
					<td align="left" valign="middle">R319</td>
					<td align="left" valign="middle">-87</td>
				</tr>

			</tbody>
		</table>
	</div>
	<div class="col-md">
		<table border='0' width="100%">
			<tr>
				<td colspan="3">
					<h4>Identitas Pelanggan</h4>
				</td>
			</tr>
			<tr>
				<td>Group ID</td>
				<td>:</td>
				<td><input readonly type="text" class="form-control"></td>
			</tr>
			<tr>
				<td>NCLI</td>
				<td>:</td>
				<td><input readonly type="text" class="form-control"></td>
			</tr>
			<tr>
				<td>Nama</td>
				<td>:</td>
				<td><input type="text" class="form-control"></td>
			</tr>
			<tr>
				<td>NPWP</td>
				<td>:</td>
				<td><input type="text" class="form-control"></td>
			</tr>
			<tr>
				<td>PIC</td>
				<td>:</td>
				<td><select class="form-control">
						<option value="" selected="selected">Please select...</option>
						<option value="DCS01">DCS01 - DCS Regional 1</option>
						<option value="DCS02">DCS02 - DCS Regional 2</option>
						<option value="DCS03">DCS03 - DCS Regional 3</option>
						<option value="DCS04">DCS04 - DCS Regional 4</option>
						<option value="DCS05">DCS05 - DCS Regional 5</option>
						<option value="DCS06">DCS06 - DCS Regional 6</option>
						<option value="DCS07">DCS07 - DCS Regional 7</option>
					</select></td>
			</tr>
			<tr>
				<td>No Internet</td>
				<td>:</td>
				<td><input readonly type="text" class="form-control"></td>
			</tr>
			<tr>
				<td>No Telepon</td>
				<td>:</td>
				<td><input readonly type="text" class="form-control"></td>
			</tr>
			<tr>
				<td>Paket Internet</td>
				<td>:</td>
				<td><input type="text" class="form-control"></td>
			</tr>
			<tr>
				<td>Paket IPTV</td>
				<td>:</td>
				<td><input type="text" class="form-control"></td>
			</tr>
			<tr>
				<td>Alamat</td>
				<td>:</td>
				<td><input type="text" class="form-control"></td>
			</tr>
			<tr>
				<td colspan="3">
					<h4>Email</h4>
				</td>
			</tr>
			<tr>
				<td>To</td>
				<td>:</td>
				<td><input type="text" class="form-control"></td>
			</tr>
			<tr>
				<td>CC</td>
				<td>:</td>
				<td><input type="text" class="form-control"></td>
			</tr>
			<tr>
				<td colspan="3">
					<h4>Multi Kontak</h4>
				</td>
			</tr>
			<tr>
				<td>Telepon</td>
				<td>:</td>
				<td><input type="text" class="form-control"></td>
			</tr>
			<tr>
				<td>No HP</td>
				<td>:</td>
				<td><input type="text" class="form-control"></td>
			</tr>
			<tr>
				<td>Fax</td>
				<td>:</td>
				<td><input type="text" class="form-control"></td>
			</tr>
			<tr>
				<td colspan="3">Pelapor</td>
			</tr>
			<tr>
				<td>Nama Pelapor</td>
				<td>:</td>
				<td><input type="text" class="form-control"></td>
			</tr>
			<tr>
				<td>Email Pelapor</td>
				<td>:</td>
				<td><input type="text" class="form-control"></td>
			</tr>
			<tr>
				<td>Telpon Pelapor</td>
				<td>:</td>
				<td><input type="text" class="form-control"></td>
			</tr>
			<tr>
				<td colspan="3">
					<h4>Informasi Lainnya</h4>
				</td>
			</tr>
			<tr>
				<td>Catatan</td>
				<td>:</td>
				<td><input type="text" class="form-control"></td>
			</tr>
		</table>
	</div>
</div>
<div class='col-md-12 col-xl-12'>

</div>



<?php echo card_close() ?>

<?php echo _js('datatables,icheck') ?>

<script>
	var page_version = "1.0.8";
	$(document).ready(function() {
		$('#example').DataTable({
			"order": [
				[1, "DESC"]
			],
			responsive: true
		});

	});
</script>