<?php echo _css('datatables,icheck') ?>

<?php echo card_open('EBS Non Pots', 'bg-teal', true) ?>
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
					<td>
						<div class="hdrcell">EMAIL</div>
					</td>
					<td>
						<div class="hdrcell">Opsi</div>
					</td>
					<td>
						<div class="hdrcell">ACCOUNT NUM</div>
					</td>
					<td style="cursor: default;">
						<div class="hdrcell">CUSTOMER NAME</div>
					</td>
					<td style="cursor: default;">
						<div class="hdrcell">ADDRESS</div>
					</td>
					<td>
						<div class="hdrcell">CUSTOMER REF</div>
					</td>
					<td>
						<div class="hdrcell">PERIOD</div>
					</td>
					<td>
						<div class="hdrcell">BILLING MONTH</div>
					</td>
					<td>
						<div class="hdrcell">DUE DATE</div>
					</td>
					<td>
						<div class="hdrcell">PKP</div>
					</td>
					<td>
						<div class="hdrcell">CIDNAS</div>
					</td>
					<td>
						<div class="hdrcell">TOTAL</div>
					</td>
				</tr>
			</thead>
			<tbody>
				<tr class=" ev_dhx_skyblue">
					<td align="left" valign="middle">-</td>
					<td align="left" valign="middle" title="0"><a href=""><i class="fe fe-mail"></i>Send</a></td>
					<td align="left" valign="middle">-</td>
					<td align="left" valign="middle" title="-">-</td>
					<td align="left" valign="middle" title="No data to display">No data to display</td>
					<td align="left" valign="middle">-</td>
					<td align="left" valign="middle">-</td>
					<td align="left" valign="middle">-</td>
					<td align="left" valign="middle">&nbsp;</td>
					<td align="left" valign="middle">&nbsp;</td>
					<td align="left" valign="middle">&nbsp;</td>
					<td align="left" valign="middle">&nbsp;</td>
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
				<td>Account Number</td>
				<td>:</td>
				<td><input readonly type="text" class="form-control"></td>
			</tr>
			<tr>
				<td>Customer Ref</td>
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
				<td>CIDNAS</td>
				<td>:</td>
				<td><input readonly type="text" class="form-control"></td>
			</tr>
			<tr>
				<td>Alamat</td>
				<td>:</td>
				<td><textarea class="form-control"></textarea></td>
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