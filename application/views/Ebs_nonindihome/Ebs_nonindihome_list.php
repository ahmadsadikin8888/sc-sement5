<?php echo _css('datatables,icheck') ?>

<?php echo card_open('EBS Non Indihome', 'bg-teal', true) ?>
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
						<div class="hdrcell">MDI ID</div>
					</td>
					<td style="cursor: default;">
						<div class="hdrcell">Opsi</div>
					</td>
					<td style="cursor: default;">
						<div class="hdrcell">SVC No</div>
					</td>
					<td style="cursor: default;">
						<div class="hdrcell">PIC ID</div>
					</td>
					<td style="cursor: default;">
						<div class="hdrcell">Name Invoice</div>
					</td>
					<td style="cursor: default;">
						<div class="hdrcell">Email</div>
					</td>
					<td>
						<div class="hdrcell">Status</div>
					</td>
					<td>
						<div class="hdrcell">Type</div>
					</td>
					<td style="cursor: default;">
						<div class="hdrcell">E-Faktur Status</div>
					</td>
					<td style="cursor: default;">
						<div class="hdrcell">Scheme</div>
					</td>
					<td style="cursor: default;">
						<div class="hdrcell">Address</div>
					</td>
					<td style="cursor: default;">
						<div class="hdrcell">Email CC</div>
					</td>
					<td style="cursor: default;">
						<div class="hdrcell">Virtual Account</div>
					</td>
					<td style="cursor: default;">
						<div class="hdrcell">Contract No.</div>
					</td>
					<td>
						<div class="hdrcell">Is Valid</div>
					</td>
				</tr>
			</thead>
			<tbody>
				<tr class=" ev_dhx_skyblue rowselected">
					<td align="left" valign="middle" title="0">0</td>
					<td align="left" valign="middle" title="0"><a href=""><i class="fe fe-mail"></i>Send</a></td>
					<td align="left" valign="middle" title="131159124293" class=" cellselected">131159124293</td>
					<td align="left" valign="middle" title="0">0</td>
					<td align="left" valign="middle" title="AHMAD SADIKIN">AHMAD SADIKIN</td>
					<td align="left" valign="middle" title="-">-</td>
					<td align="left" valign="middle">0</td>
					<td align="left" valign="middle">0</td>
					<td align="left" valign="middle">&nbsp;</td>
					<td align="left" valign="middle" title="0">0</td>
					<td align="left" valign="middle" title="CIDAHU, NO. 5/1, DS TANIMULYA KAB BANDUNG 40552    ">CIDAHU, NO. 5/1, DS TANIMULYA KAB BANDUNG 40552 </td>
					<td align="left" valign="middle" title="0">0</td>
					<td align="left" valign="middle" title="88851589599500100001">88851589599500100001</td>
					<td align="left" valign="middle" title="&nbsp;">&nbsp;</td>
					<td align="left" valign="middle" title="&nbsp;">&nbsp;</td>
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
				<td>Scheme</td>
				<td>:</td>
				<td><select id="ebs_info_skema" class="select form-control">
						<option value="" selected="selected">Please select...</option>
						<option value="1">Single</option>
						<option value="2">Grouping</option>
						<option value="3">Official Receipt Grouping</option>
					</select></td>
			</tr>
			<tr>
				<td>Nomor MDI</td>
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
				<td>Pelanggan</td>
				<td>:</td>
				<td><select id="ebs_info_pelanggan" class="form-control">
						<option value="" selected="selected">Please select...</option>
						<option value="1">Resedential</option>
						<option value="2">Bisnis</option>
						<option value="3">Dinas</option>
						<option value="4">BUMN/Pemerintahan</option>
						<option value="5">Wartel</option>
					</select></td>
			</tr>
			<tr>
				<td>No. KTP</td>
				<td>:</td>
				<td><input type="text" class="form-control"></td>
			</tr>
			<tr>
				<td>Jenis Usaha</td>
				<td>:</td>
				<td>
					<select id="ebs_info_jenis_usaha" class="form-control">
						<option value="" selected="selected">Please select...</option>
						<option value="1">PERTANIAN</option>
						<option value="10">KONTRUKSI</option>
						<option value="11">PERDAGANGAN BESAR</option>
						<option value="12">PERDAGANGAN KECIL</option>
						<option value="13">PENYEDIAAN AKOMODASI</option>
						<option value="14">PENYEDIAAN MAKAN MINUM</option>
						<option value="15">TRANSPORTASI</option>
						<option value="16">PERGUDANGAN</option>
						<option value="17">TELEKOMUNIKASI</option>
						<option value="18">KEUANGAN</option>
						<option value="19">REAL ESTATE</option>
						<option value="2">PERBURUAN</option>
						<option value="20">PEMERINTAHAN</option>
						<option value="21">INFORMASI DAN TEKNOLOGI</option>
						<option value="22">PENDIDIKAN</option>
						<option value="23">KESEHATAN</option>
						<option value="24">SOSIAL</option>
						<option value="25">HUBUNGAN INTERNASIONAL</option>
						<option value="26">JENIS USAHA LAINNYA</option>
						<option value="3">KEHUTANAN</option>
						<option value="4">PERIKANAN</option>
						<option value="5">INDUSTRI PENGOLAHAN</option>
						<option value="6">PERTAMBANGAN</option>
						<option value="7">LISTRIK</option>
						<option value="8">GAS</option>
						<option value="9">AIR</option>
					</select>
				</td>
			</tr>
			<tr>
				<td>Tempat Lahir</td>
				<td>:</td>
				<td><input type="text" class="form-control"></td>
			</tr>
			<tr>
				<td>Tanggal Lahir</td>
				<td>:</td>
				<td><input type="date" class="form-control"></td>
			</tr>

			<tr>
				<td colspan="3">
					<h4>Alamat Pelanggan</h4>
				</td>
			</tr>
			<tr>
				<td>Jalan</td>
				<td>:</td>
				<td><input type="text" class="form-control"></td>
			</tr>
			<tr>
				<td>Nomor</td>
				<td>:</td>
				<td><input type="text" class="form-control"></td>
			</tr>
			<tr>
				<td>Gedung</td>
				<td>:</td>
				<td><input type="text" class="form-control"></td>
			</tr>
			<tr>
				<td>Lantai</td>
				<td>:</td>
				<td><input type="text" class="form-control"></td>
			</tr>
			<tr>
				<td>Keluarahan</td>
				<td>:</td>
				<td><input type="text" class="form-control"></td>
			</tr>
			<tr>
				<td>Kecamatan</td>
				<td>:</td>
				<td><input type="text" class="form-control"></td>
			</tr>
			<tr>
				<td>Kota</td>
				<td>:</td>
				<td><input type="text" class="form-control"></td>
			</tr>
			<tr>
				<td>Kode Pos</td>
				<td>:</td>
				<td><input type="text" class="form-control"></td>
			</tr>
			<tr>
				<td colspan="3">Email</td>
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
					<h4>Informasi Pembayaran</h4>
				</td>
			</tr>
			<tr>
				<td>Nama Bank</td>
				<td>:</td>
				<td><input type="text" class="form-control"></td>
			</tr>
			<tr>
				<td>Nomor Rekening</td>
				<td>:</td>
				<td><input type="text" class="form-control"></td>
			</tr>
			<tr>
				<td>Pemilik Rekening</td>
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