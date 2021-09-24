<div class='box-body table-responsive' id='box-table'>
	<small>
		<table class='timecard' id="datalist" style="width: 100%;">
			<thead>
				<tr>
					<th>No</th>
					<th>MCI ID</th>
					<th>SV No</th>
					<th>Price</th>
					<th>Name Invoice</th>
					<th>Email</th>
					<th>Scheme</th>
					<th>Address</th>
					<th>Email CC</th>
					<th>Virtual Account</th>
					<th>Is Valid</th>
				</tr>
			</thead>
			<tbody>
				<td align="left" valign="middle" title="0">8</td>
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

			</tbody>
		</table>
	</small>
</div>
<script type="text/javascript">
	$('#datalist').DataTable({
		dom: 'Bfrtip',
		buttons: [
			'copy', 'csv', 'excel', 'pdf', 'print'
		],
		responsive: true
	});
	$(document).ready(function() {
		var table = $('#datalist').DataTable();

		$('#datalist tbody').on('click', 'tr', function() {
			var datanya = table.row(this).data();
			// alert('You clicked on ' + data[0] + '\'s row');
			update_form(datanya);
		});
	});


	function update_form(datanya) {
		$.ajax({
			url: "<?php echo base_url() . "EBS_indihome/EBS_indihome/get_form" ?>",
			data: {
				datanya: datanya
			},
			methode: "get",
			success: function(response) {
				$("#formebs").html(response);
			}
		});
	}
</script>