<!-- load css selectize-->
<!-- tempatkan code ini pada top page view-->
<?php echo _css('datatables,icheck,selectize,multiselect') ?>


<div class='col-md-12 col-xl-12'>
	<div class="card">
		<div class="card-status bg-green"></div>
		<div class="card-header">
			<h3 class="card-title">FILTER
			</h3>
			<div class="card-options">
				<a href="#" class="card-options-collapse " data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>
				<a href="#" class="card-options-fullscreen " data-toggle="card-fullscreen"><i class="fe fe-maximize"></i></a>
			</div>
		</div>
		<div class="card-body">
			<div class='box-body' id='box-table'>

				<form id='form-a' methode="GET">
					<div class="row">
						<div class='col-md-6 col-xl-6'>
							<div class='form-group'>
								<label class='form-label'>Mulai Dari</label>
								<input type='date' class='form-control data-sending focus-color' id='id_reason' name='start' value='<?php if (isset($_GET['start'])) echo $_GET['start'] ?>'>
							</div>
						</div>
						<div class='col-md-6 col-xl-6'>
							<div class='form-group'>
								<label class='form-label'>Sampai </label>
								<input type='date' class='form-control data-sending focus-color' id='id_reason' name='end' value='<?php if (isset($_GET['end'])) echo $_GET['end'] ?>'>
							</div>
						</div>
						<div class='col-md-6 col-xl-6'>
							<div class='form-group'>
								<label class='form-label'>Campaign</label>
								<select class="form-control" name="campaign">
									<option value="">All Channel</option>
									<option>Infotag</option>
									<option>Reminding</option>
									<option>Courtesy</option>
									<option>Undunning</option>
								</select>
							</div>
						</div>
						<div class='col-md-6 col-xl-6'>
							<div class='form-group'>
								<label class='form-label'>Channel</label>
								<select class="form-control" name="channel">
									<option value="">All Channel</option>
									<option value="EMAIL">EMAIL</option>
									<option value="WA">WA</option>
									<option value="SMS">SMS</option>
									<option value="TVMS">TVMS</option>
									<option value="OVR">OVR</option>
									<option value="SMS">SMS</option>
									<option VALUE='OBC'>OBC</option>
								</select>
							</div>
						</div>
						<div class='col-md-6 col-xl-6'>
							<div class='form-group'>
								<label class='form-label'>Regional</label>
								<select class="form-control" name="regional">
									<option value="">All Regional</option>
									<option value='1'>Regional 1</option>
									<option value='2'>Regional 2</option>
									<option value='3'>Regional 3</option>
									<option value='4'>Regional 4</option>
									<option value='5'>Regional 5</option>
									<option value='6'>Regional 6</option>
									<option value='7'>Regional 7</option>

								</select>
							</div>
						</div>
						<div class='col-md-12 col-xl-12'>

							<div class='form-group'>
								<button id='btn-save' type='submit' class='btn btn-primary'><i class="fe fe-save"></i> Search</button>
							</div>

						</div>
					</div>
				</form>

			</div>
		</div>
	</div>
</div>
<?php

if (isset($_GET['start']) && isset($_GET['end'])) {


?>
	<div class='col-md-12 col-xl-12'>
		<div class="card">
			<div class="card-status bg-orange"></div>
			<div class="card-header">
				<h3 class="card-title">Report

				</h3>
				<div class="card-options">
					<a href="#" class="card-options-collapse " data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>
					<a href="#" class="card-options-fullscreen " data-toggle="card-fullscreen"><i class="fe fe-maximize"></i></a>
				</div>
			</div>
			<div class="card-body">
				<div class='box-body table-responsive' id='box-table'>
					<small>
						<table class='table' id="report_table_reg">
							<thead>
								<tr>
									<th nowrap>#</th>
									<th nowrap>CHANNEL</th>
									<th nowrap>REGIONAL</th>
									<th nowrap>STATUS</th>
									<th nowrap>TOTAL</th>
								</tr>
							</thead>
							<tbody>
								<?php
								$n = 0;
								if (count($call_history) > 0) {
									foreach ($call_history as $r) {
										$n++;

								?>
										<tr>
											<td nowrap><?php echo $n; ?></td>
											<td nowrap><?php echo $r->channel_value; ?></td>
											<td nowrap>Regional <?php echo $r->regional_value; ?></td>
											<td nowrap><?php echo $r->status_value; ?></td>
											<td nowrap><?php echo $r->total; ?></td>
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
		</div>
	</div>

<?php

}
?>
<!-- load library selectize -->
<!-- tempatkan code ini pada akhir code html sebelum masuk tag script-->
<?php echo _js('ybs,selectize,datatables,icheck,multiselect') ?>
<script type="text/javascript">
	$(document).ready(function() {

		$("#report_table_reg").DataTable({
			dom: 'Bfrtip',
			buttons: [
				'copy', 'csv', 'excel', 'pdf'
			]
		});
		$("#report_table_merchant").DataTable({
			dom: 'Bfrtip',
			buttons: [
				'copy', 'csv', 'excel', 'pdf'
			]
		});
	});
</script>