<!DOCTYPE html>
<html lang="en">
<!-- START: Head-->

<head>
	<meta charset="UTF-8">
	<title>Digital Channel - Campaign</title>
	<link rel="icon" type="image/png" href="<?php echo base_url('assets/images/logo.png') ?>">
	<meta name="viewport" content="width=device-width,initial-scale=1">

	<!-- START: Template CSS-->
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/new_theme/dist/vendors/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/new_theme/dist/vendors/jquery-ui/jquery-ui.min.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/new_theme/dist/vendors/jquery-ui/jquery-ui.theme.min.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/new_theme/dist/vendors/simple-line-icons/css/simple-line-icons.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/new_theme/dist/vendors/flags-icon/css/flag-icon.min.css">
	<!-- END Template CSS-->

	<!-- START: Page CSS-->
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/new_theme/dist/vendors/chartjs/Chart.min.css">
	<link href="<?php echo base_url(); ?>assets/new_theme/dist/vendors/lineprogressbar/jquery.lineProgressbar.min.css" rel="stylesheet">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/new_theme/dist/vendors/ionicons/css/ionicons.min.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/new_theme/dist/vendors/datatable/css/dataTables.bootstrap4.min.css" />
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/new_theme/dist/vendors/datatable/buttons/css/buttons.bootstrap4.min.css" />
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/new_theme/tambahan/editor_text/src/richtext.min.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/new_theme/tambahan/editor_text/font-awesome.min.css">

	<!-- END: Page CSS-->

	<!-- START: Page CSS-->
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/new_theme/dist/vendors/morris/morris.css">
	<!-- END: Page CSS-->
	<!-- START: Custom CSS-->
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/new_theme/dist/css/main.css">
	<script src="<?php echo base_url(); ?>assets/new_theme/dist/vendors/chartjs/Chart.min.js"></script>
	<!-- <script src="<?php echo base_url(); ?>assets/js/plugins/jquery-knob/jquery.knob.min.js" type="text/javascript"></script> -->
	<!-- END: Page CSS-->
	<script src="<?php echo base_url() ?>assets/js/highcharts.js"></script>
	<script src="<?php echo base_url() ?>assets/js/bundle.js"></script>

	<link href="<?php echo base_url(); ?>assets/progress_bar/css/static.min.css" rel="stylesheet" />
	<script src="<?php echo base_url(); ?>assets/progress_bar/js/jquery.progresstimer.js"></script>

	<script src="<?php echo base_url(); ?>assets/progress_bar/js/static.min.js"></script>
	<!-- END: Custom CSS-->
</head>
<!-- END Head-->

<!-- START: Body-->

<body id="main-container" class="default horizontal-menu">

	<!-- START: Pre Loader-->
	<div class="se-pre-con">
		<div class="loader"></div>
	</div>
	<!-- END: Pre Loader-->

	<!-- START: Header-->
	<div id="header-fix" class="header fixed-top">
		<div class="site-width">
			<nav class="navbar navbar-expand-lg  p-0">
				<img src="<?php echo base_url("api/Public_Access/get_logo_template") ?>" class="header-brand-img h-<?php echo $this->_appinfo['template_logo_size'] ?>" alt="ybs logo">

			</nav>
		</div>
	</div>
	<!-- END: Header-->
	<!-- START: Main Menu-->
	<div class="sidebar">
		<div class="site-width">

			<!-- START: Menu-->
			<ul id="side-menu" class="sidebar-menu">
				<li class="active">
					<a href="<?php echo base_url() . "ebs_indihome/ebs_indihome" ?>"><i class="icon-chart mr-1"></i> EBS Indihome</a>
				</li>
			</ul>
			<!-- END: Menu-->

		</div>
	</div>
	<!-- END: Main Menu-->


	<!-- START: Main Content-->
	<main>
		<div class="container-fluid site-width">
			<div class="row row-eq-height">
				<div class="col-12 mt-3">
					<div class="card">
						<div class="card-content">
							<div class="card-body">
								<div class="d-flex">

									<div class="form">
										<div class="input-group mb-3">
											<input type="text" class="form-control pull-right" placeholder="SVC Number" value="<?php if (isset($_GET['svcnumber'])) echo $_GET['svcnumber'] ?>" name="svcnumber" id="svcnumber">
											<div class="input-group-append">
												<div class="btn btn-outline-secondary" id="src_svc">Check</div>
											</div>
										</div>

									</div>

								</div>

								<div class="py-3">
									<div class="row">
										<div class="col-12">
											<div id="tabledatanya">

											</div>
											<hr>
											<div id="formebs" class="mt-3">

											</div>

										</div>
									</div>
								</div>

							</div>
						</div>
					</div>
				</div>
				<!-- END: Card DATA-->
			</div>

		</div>
		<?php if (isset($_GET['date']) && isset($_GET['sumber'])) { ?>
			<div class="container-fluid site-width mt-5">
				<!-- START: Breadcrumbs-->
				<div class="row">
					<div class="col-12  align-self-center">
						<div class="card">

							<div id="list_area">
								<div class="loading-progress" style="width:100%;"></div>
							</div>
							<hr>


							<div id="list_areatabel">
								<!-- <div class="progress">
                                        <div class="loading-progress progress-bar progress-bar-striped progress-bar-animated w-100" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div> -->
							</div>

						</div>
					</div>
				</div>
			</div>
		<?php
		};
		?>
		</div>


		<!-- END: Breadcrumbs-->

		</div>



	</main>

	<!-- END: Content-->
	<!-- START: Footer-->
	<footer class="site-footer">
		2020 © Sy-ANIDA
	</footer>
	<!-- END: Footer-->



	<!-- START: Back to top-->
	<a href="#" class="scrollup text-center">
		<i class="icon-arrow-up"></i>
	</a>


	<!-- START: Template JS-->
	<script src="<?php echo base_url(); ?>assets/new_theme/dist/vendors/jquery/jquery-3.3.1.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/new_theme/dist/vendors/jquery-ui/jquery-ui.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/new_theme/dist/vendors/moment/moment.js"></script>
	<script src="<?php echo base_url(); ?>assets/new_theme/dist/vendors/bootstrap/js/bootstrap.bundle.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/new_theme/dist/vendors/slimscroll/jquery.slimscroll.min.js"></script>
	<!-- END: Template JS-->

	<!-- START: APP JS-->
	<script src="<?php echo base_url(); ?>assets/new_theme/dist/js/app.js"></script>
	<!-- END: APP JS-->



	<!-- START: Page Vendor JS-->
	<script src="<?php echo base_url(); ?>assets/new_theme/dist/vendors/apexcharts/apexcharts.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/new_theme/dist/vendors/lineprogressbar/jquery.lineProgressbar.js"></script>
	<script src="<?php echo base_url(); ?>assets/new_theme/dist/vendors/lineprogressbar/jquery.barfiller.js"></script>
	<!-- END: Page Vendor JS-->

	<!-- START: Page JS-->
	<!-- <script src="<?php echo base_url(); ?>assets/new_theme/dist/js/home.script.js"></script> -->
	<!-- END: Page JS-->

	<!---- START page datatable--->
	<!-- START: Page Vendor JS-->
	<script src="<?php echo base_url(); ?>assets/new_theme/dist/vendors/datatable/js/jquery.dataTables.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/new_theme/dist/vendors/datatable/js/dataTables.bootstrap4.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/new_theme/dist/vendors/datatable/jszip/jszip.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/new_theme/dist/vendors/datatable/pdfmake/pdfmake.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/new_theme/dist/vendors/datatable/pdfmake/vfs_fonts.js"></script>
	<script src="<?php echo base_url(); ?>assets/new_theme/dist/vendors/datatable/buttons/js/dataTables.buttons.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/new_theme/dist/vendors/datatable/buttons/js/buttons.bootstrap4.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/new_theme/dist/vendors/datatable/buttons/js/buttons.colVis.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/new_theme/dist/vendors/datatable/buttons/js/buttons.flash.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/new_theme/dist/vendors/datatable/buttons/js/buttons.html5.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/new_theme/dist/vendors/datatable/buttons/js/buttons.print.min.js"></script>
	<!-- END: Page Vendor JS-->

	<!-- START: Page Script JS-->
	<script src="<?php echo base_url(); ?>assets/new_theme/dist/js/datatable.script.js"></script>
	<!-- END: Page Script JS-->

	<!-- START: Page Vendor JS-->
	<script src="<?php echo base_url(); ?>assets/new_theme/dist/vendors/raphael/raphael.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/new_theme/dist/vendors/morris/morris.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/new_theme/dist/vendors/apexcharts/apexcharts.min.js"></script>
	<!-- END: Page Vendor JS-->
	<script src="<?php echo base_url(); ?>assets/new_theme/dist/vendors/chartjs/Chart.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/new_theme/dist/js/chartjs-plugin-datalabels.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/new_theme/tambahan/editor_text/src/jquery.richtext.js"></script>

	<!---- END page datatable--->

	<!-- END: Back to top-->

	<script type="text/javascript">
		function update_base_list_area() {
			var date = $("#date").val();
			var sumber = $("#sumber").val();
			$.ajax({
				url: "<?php echo base_url() . "dc_qc/dc_qc/get_data_list" ?>",
				data: {
					sumber: sumber,
					date: date
				},
				methode: "get",
				success: function(response) {
					$("#list_area").html(response);
					progress.progressTimer('complete');
				},
				error: function() {
					progress.progressTimer('error', {
						errorText: 'ERROR!',
						onFinish: function() {
							alert('There was an error processing your information!');
						}
					});
				}
			});
		}
		$(document).ready(function() {
			update_base_list_area();
			// update_base_num_hp_email_area();
			// update_base_num_area();
		});
	</script>


	<script>
		function update_base_list_area() {
			var svcnumber = $("#svcnumber").val();
			$.ajax({
				url: "<?php echo base_url() . "EBS_indihome/EBS_indihome/get_data_list" ?>",
				data: {
					svcnumber: svcnumber
				},
				methode: "get",
				success: function(response) {
					$("#tabledatanya").html(response);
				}
			});
		}

		$("#src_svc").click(function() {
			update_base_list_area();
			// alert("asdfasdf");
		});
	</script>

</body>
<!-- END: Body-->

</html>