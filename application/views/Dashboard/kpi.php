<!-- load css selectize-->
<!-- tempatkan code ini pada top page view-->
<?php echo _css('datatables,icheck,selectize,multiselect') ?>

<head>
    <meta charset="UTF-8">
    <title>Pick Admin</title>
    <link rel="shortcut icon" href="<?php echo base_url();?>assets/new_theme/dist/images/favicon.ico" />
    <meta name="viewport" content="width=device-width,initial-scale=1">

    <!-- START: Template CSS-->
    <link rel="stylesheet" href="<?php echo base_url();?>assets/new_theme/dist/vendors/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/new_theme/dist/vendors/jquery-ui/jquery-ui.min.css">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/new_theme/dist/vendors/jquery-ui/jquery-ui.theme.min.css">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/new_theme/dist/vendors/simple-line-icons/css/simple-line-icons.css">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/new_theme/dist/vendors/flags-icon/css/flag-icon.min.css">
    <!-- END Template CSS-->

    <!-- START: Page CSS-->
    <link rel="stylesheet" href="<?php echo base_url();?>assets/new_theme/dist/vendors/chartjs/Chart.min.css">
    <!-- END: Page CSS-->

    <!-- START: Page CSS-->
    <link rel="stylesheet" href="<?php echo base_url();?>assets/new_theme/dist/vendors/morris/morris.css">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/new_theme/dist/vendors/weather-icons/css/pe-icon-set-weather.min.css">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/new_theme/dist/vendors/chartjs/Chart.min.css">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/new_theme/dist/vendors/starrr/starrr.css">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/new_theme/dist/vendors/fontawesome/css/all.min.css">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/new_theme/dist/vendors/ionicons/css/ionicons.min.css">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/new_theme/dist/vendors/jquery-jvectormap/jquery-jvectormap-2.0.3.css">
    <!-- END: Page CSS-->

    <!-- START: Custom CSS-->
    <link rel="stylesheet" href="<?php echo base_url();?>assets/new_theme/dist/css/main.css">
    <!-- END: Custom CSS-->
    <style>
        .size-1 {
            width: 80%;
        }

        .h-split {
            display: block;
            float: left;
            width: 1%;
            min-height: 100px;
        }
    </style>
</head>
<!-- END Head-->
<!-- START: Body-->

<body id="main-container" class="default compact-menu" style="margin-top:-60px; margin-left:-60px;">
    <!-- START: Main Content-->
<main>
        <div class="container-fluid site-width">
            <!-- START: Breadcrumbs-->
            <div class="row">
                <div class="col-12  align-self-center">
                    <div class="sub-header mt-3 py-3 align-self-center d-sm-flex w-100 rounded">
                        <div class="w-sm-100 mr-auto">
                            <h4 class="mb-0">Dashboard KPI</h4>
                        </div>

                        <ol class="breadcrumb bg-transparent align-self-center m-0 p-0">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Dashboard KPI</li>
                        </ol>
                    </div>
                </div>
                <div class="col-12">

                    <form method="POST" action="<?php echo base_url();?>Report/Report/dashboard">
                        <div class="form-row">
                            <div class="form-group col-md-2">
                                <select class="form-control" name="periode" id="periode">
                                    <option value="202101"<?php if($periode=="202101") echo 'selected="selected"'; ?>>202101</option>
                                    <option value="202102"<?php if($periode=="202102") echo 'selected="selected"'; ?>>202102</option>
                                    <option value="202103"<?php if($periode=="202103") echo 'selected="selected"'; ?>>202103</option>
                                    <option value="202104"<?php if($periode=="202104") echo 'selected="selected"'; ?>>202104</option>
                                    <option value="202105"<?php if($periode=="202105") echo 'selected="selected"'; ?>>202105</option>
                                    <option value="202106"<?php if($periode=="202106") echo 'selected="selected"'; ?>>202106</option>
                                    <option value="202107"<?php if($periode=="202107") echo 'selected="selected"'; ?>>202107</option>
                                </select>
                            </div>
                            <!--<div class="form-group col-md-2">
                                <input class="form-control" type="date" name="datena" id="date">
                            </div>-->
                            <div class="form-group col-md-2">
                                <button type="submit" id="search" class="btn btn-primary" name="search">Search</button>
                            </div>
                        </div>

                    </form>
                    <br>

                </div>

            </div>
            <!-- END: Breadcrumbs-->

            <!-- START: Card Data-->
            <div class="row" style="margin-top:-15px;">
                <div class="col-12 col-lg-12  mt-3">
                    <div class="card">
                        <div class="card-header  justify-content-between align-items-center">
                            <h6 class="card-title">KPI : Ketersediaan System & Komitmen Implementasi Proses Digital</h6>
                        </div>
                      <div class="card-content">
                        <table width="100%">
                                <tr>
                                    <td>
                                        <div class="card m-5">
                                            <div class="card-header  justify-content-between align-items-center">
                                                <h6 class="card-title text-center">SMS</h6>
                                            </div>
                                            <div class="card-content">
                                                <table width="100%">
                                                    <tr align="right">
                                                        <td><?php echo $data_sms[1]; ?>%</td>
                                                    </tr>
                                                    <tr align="center">
                                                        <td>
                                                            <div id="jg1" class="gauge size-1" ></div>
                                                        </td>
                                                    </tr>
                                                   
                                                    <tr>
                                                        <td>
                                                            <div class="card-body">
                                                                <table width="100%">
                                                                    <tr>
                                                                        <td width="90%">
                                                                            <div class="progress">
                                                                                <div class="progress-bar progress-bar-striped progress-bar-animated w-100"
                                                                                    role="progressbar"
                                                                                    aria-valuenow="100" aria-valuemin="0"
                                                                                    aria-valuemax="100">
                                                                                    <?php echo $data_sms[2]; ?> / <?php echo $data_sms[3]; ?>(<?php echo $data_sms[5]; ?>%)</div>
                                                                        </td>
                                                                        <td width="10%" align="right">
                                                                            <?php echo $data_sms[4]; ?>%
                                                                        </td>
                                                                    </tr>
                                                                </table>
                                                          </div>

                                                  </div>
                                    </td>
                                </tr>
                            </table>

                                </div>
                                   
                            </td>
                    <td>
                        <div class="card m-3">
                            <div class="card-header  justify-content-between align-items-center">
                                <h6 class="card-title text-center">Email</h6>
                            </div>
                            <div class="card-content">
                                <table width="100%">
                                    <tr align="right">
                                        <td><?php echo $data_email[1]; ?>%</td>
                                    </tr>
                                    <tr align="center">
                                        <td>
                                            <div id="jg2" class="gauge size-1"></div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="card-body">
                                                <table width="100%">
                                                    <tr>
                                                        <td width="90%">
                                                            <div class="progress">
                                                                <div class="progress-bar progress-bar-striped progress-bar-animated w-100"
                                                                    role="progressbar" aria-valuenow="75"
                                                                    aria-valuemin="0" aria-valuemax="100">
                                                                    <?php echo $data_email[2]; ?> / <?php echo $data_email[3]; ?>(<?php echo $data_email[5]; ?>%)</div>
                                                        </td>
                                                        <td width="10%" align="right">
                                                        <?php echo $data_email[4]; ?>%
                                                        </td>
                                                    </tr>
                                                </table>
                                            </div>
                                        </td>
                                    </tr>
                                </table>

                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="card m-3">
                            <div class="card-header  justify-content-between align-items-center">
                                <h6 class="card-title text-center">OVR</h6>
                            </div>
                            <div class="card-content">
                                <table width="100%">
                                    <tr align="right">
                                        <td><?php echo $data_ovr[1]; ?>%</td>
                                    </tr>
                                    <tr align="center">
                                        <td>
                                            <div id="jg3" class="gauge size-1"></div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="card-body">
                                                <table width="100%">
                                                    <tr>
                                                        <td width="90%">
                                                            <div class="progress">
                                                                <div class="progress-bar progress-bar-striped progress-bar-animated w-100"
                                                                    role="progressbar" aria-valuenow="75"
                                                                    aria-valuemin="0" aria-valuemax="100">
                                                                    <?php echo $data_ovr[2]; ?> / <?php echo $data_ovr[3]; ?>(<?php echo $data_ovr[5]; ?>%)</div>
                                                        </td>
                                                        <td width="10%" align="right">
                                                        <?php echo $data_ovr[4]; ?>%
                                                        </td>
                                                    </tr>
                                                </table>
                                            </div>
                                        </td>
                                    </tr>
                                </table>

                            </div>
                        </div>
                    </td>
                    </tr>
                    </table>
                    <table width="100%">
                                <tr>
                                    <td>
                                        <div class="card m-5">
                                            <div class="card-header  justify-content-between align-items-center">
                                                <h6 class="card-title text-center">TVMS</h6>
                                            </div>
                                            <div class="card-content">
                                                <table width="100%">
                                                    <tr align="right">
                                                        <td><?php echo $data_tvms[1]; ?>%</td>
                                                    </tr>
                                                    <tr align="center">
                                                        <td>
                                                            <div id="jg4" class="gauge size-1" ></div>
                                                        </td>
                                                    </tr>
                                                   
                                                    <tr>
                                                        <td>
                                                            <div class="card-body">
                                                                <table width="100%">
                                                                    <tr>
                                                                        <td width="90%">
                                                                            <div class="progress">
                                                                                <div class="progress-bar progress-bar-striped progress-bar-animated w-100"
                                                                                    role="progressbar"
                                                                                    aria-valuenow="75" aria-valuemin="0"
                                                                                    aria-valuemax="100">
                                                                                    <?php echo $data_tvms[2]; ?> / <?php echo $data_tvms[3]; ?>(<?php echo $data_tvms[5]; ?>%)</div>
                                                                        </td>
                                                                        <td width="10%" align="right">
                                                                            <?php echo $data_tvms[4]; ?>%
                                                                        </td>
                                                                    </tr>
                                                                </table>
                                                          </div>

                                                  </div>
                                    </td>
                                </tr>
                            </table>

                                </div>
                                   
                            </td>
                    <td>
                        <div class="card m-3">
                            <div class="card-header  justify-content-between align-items-center">
                                <h6 class="card-title text-center">WA</h6>
                            </div>
                            <div class="card-content">
                                <table width="100%">
                                    <tr align="right">
                                        <td><?php echo $data_wa[1]; ?>%</td>
                                    </tr>
                                    <tr align="center">
                                        <td>
                                            <div id="jg5" class="gauge size-1"></div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="card-body">
                                                <table width="100%">
                                                    <tr>
                                                        <td width="90%">
                                                            <div class="progress">
                                                                <div class="progress-bar progress-bar-striped progress-bar-animated w-100"
                                                                    role="progressbar" aria-valuenow="75"
                                                                    aria-valuemin="0" aria-valuemax="100">
                                                                    <?php echo $data_wa[2]; ?> / <?php echo $data_wa[2]; ?>(100%)</div>
                                                        </td>
                                                        <td width="10%" align="right">
                                                        8%
                                                        </td>
                                                    </tr>
                                                </table>
                                            </div>
                                        </td>
                                    </tr>
                                </table>

                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="card m-3">
                            <div class="card-header  justify-content-between align-items-center">
                                <h6 class="card-title text-center">MTTR</h6>
                            </div>
                            <div class="card-content">
                                <table width="100%">
                                    <tr align="right">
                                        <td>5%</td>
                                    </tr>
                                    <tr align="center">
                                        <td>
                                            <div id="jg6" class="gauge size-1"></div>
                                        </td>
                                    </tr>
                                    <tr align="center">
                                                <td>
                                                    <h1>0 / Hour</h1>
                                                </td>
                                        </tr>
                                </table>

                            </div>
                        </div>
                    </td>
                    </tr>
                    </table>
                      </div>
            </div>
        </div>
        <div class="col-5 col-lg-5  mt-2">
            <div class="card">
                <div class="card-header  justify-content-between align-items-center">
                    <h6 class="card-title">KPI : Durasi Kendala Sistem</h6>
                </div>
                <div class="card-content">
                    <table width="100%">
                        <tr>
                            <td>
                                <div class="card m-3">
                                    <div class="card-header  justify-content-between align-items-center">
                                        <h6 class="card-title text-center">Downtime Counter (MoM)</h6>
                                    </div>
                                    <div class="card-content">
                                        <table width="100%">
                                            <tr align="right">
                                                <td>5%</td>
                                            </tr>

                                            <tr align="center">
                                                <td>
                                                    <h3>0D:0H:0M:0S</h3>
                                                </td>
                                            </tr>
                                            <!--<tr>
                                                <td>
                                                    <div class="card-body">
                                                        <div class="progress">
                                                            <div class="progress-bar progress-bar-striped progress-bar-animated w-75"
                                                                role="progressbar" aria-valuenow="75" aria-valuemin="0"
                                                                aria-valuemax="100">
                                                                95% Used Time</div>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>-->
                                        </table>

                                    </div>
                                </div>
                            </td>
                        </tr>
                    </table>

                </div>
            </div>
        </div>
        <div class="col-5 col-lg-5  mt-2">
            <div class="card">
                <div class="card-header  justify-content-between align-items-center">
                    <h6 class="card-title">KPI : Durasi Ketersediaan Menu Laporan</h6>

                </div>
                <div class="card-content">
                    <table width="100%">
                        <tr>
                            <td>
                                <div class="card m-3">
                                    <div class="card-header  justify-content-between align-items-center">
                                        <h6 class="card-title text-center">Accuracy Report</h6>
                                    </div>
                                    <div class="card-content">
                                        <table width="100%">
                                            <tr align="right">
                                                <td>
                                                    <?php
                                                        $total1 = $data_sms[2]+$data_email[2]+$data_ovr[2]+$data_tvms[2]+$data_wa[2];
                                                        $total2 = $data_sms[3]+$data_email[3]+$data_ovr[3]+$data_tvms[3]+$data_wa[2];
                                                        $av = round(($total1/$total2)*100);
                                                        $kpi_lap = round($av/(98/5));
                                                        echo $kpi_lap;
                                                    ?>%
                                                </td>
                                            </tr>
                                            <tr align="center">
                                                <td>
                                                    <h2>
                                                        <?php 
                                                            $total1 = $data_sms[2]+$data_email[2]+$data_ovr[2]+$data_tvms[2]+$data_wa[2];
                                                            echo $total1;
                                                        ?>Processed
                                                    </h2>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="card-body">
                                                        <div class="progress">
                                                            <div class="progress-bar progress-bar-striped progress-bar-animated w-100"
                                                                role="progressbar" aria-valuenow="75" aria-valuemin="0"
                                                                aria-valuemax="100">
                                                                Accuracy: 
                                                                <?php 
                                                                    $total2 = $data_sms[3]+$data_email[3]+$data_ovr[3]+$data_tvms[3]+$data_wa[2];
                                                                    $av = round(($total1/$total2)*100);
                                                                    echo $av;
                                                                ?>
                                                                %</div>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>

                                        </table>

                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="card m-3">
                                    <div class="card-header  justify-content-between align-items-center">
                                        <h6 class="card-title text-center">Transfer Data</h6>
                                    </div>
                                    <div class="card-content">
                                        <table width="100%">
                                            <tr align="right">
                                                <td>5%</td>
                                            </tr>

                                            <tr align="center">
                                                <td>
                                                    <h2>
                                                        <?php
                                                            echo $total1;
                                                        ?>
                                                    - Transfered</h2>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="card-body">
                                                        <div class="progress">
                                                            <div class="progress-bar progress-bar-striped progress-bar-animated w-100"
                                                                role="progressbar" aria-valuenow="75" aria-valuemin="0"
                                                                aria-valuemax="100">
                                                                100% Transfered Process</div>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        </table>

                                    </div>
                                </div>
                            </td>
                        </tr>
                    </table>

                </div>
            </div>
        </div>
        <div class="col-2 col-lg-2 mt-2">
            <div class="card">
                <div class="card-header   bg-primary justify-content-between align-items-center">
                    <h6 class="card-title text-center text-white">Total Score</h6>
                </div>
                <div class="card-content text-center">
                    <h1>
                        <?php 
                            $all = $data_sms[1]+$data_email[1]+$data_ovr[1]+$data_wa[1]+$data_tvms[1]+
                            $data_sms[4]+$data_email[4]+$data_ovr[4]+8+$data_tvms[4]+
                            5+5+$kpi_lap+5
                            ;
                            echo $all; 
                        ?>
                    </h1>
                </div>
            </div>
        </div>

        </div>

        </div>
        <!-- END: Card DATA-->
    </main>
    <!-- END: Content-->
    <!-- START: Footer-->
    <footer class="site-footer">
        2020 &copy; PICK
    </footer>
    <!-- END: Footer-->


    <!-- START: Back to top-->
    <a href="#" class="scrollup text-center">
        <i class="icon-arrow-up"></i>
    </a>
    <!-- END: Back to top-->


    <!-- START: Template JS-->
    <script src="<?php echo base_url();?>assets/new_theme/dist/vendors/jquery/jquery-3.3.1.min.js"></script>
    <script src="<?php echo base_url();?>assets/new_theme/dist/vendors/jquery-ui/jquery-ui.min.js"></script>
    <script src="<?php echo base_url();?>assets/new_theme/dist/vendors/moment/moment.js"></script>
    <script src="<?php echo base_url();?>assets/new_theme/dist/vendors/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="<?php echo base_url();?>assets/new_theme/dist/vendors/slimscroll/jquery.slimscroll.min.js"></script>
    <!-- END: Template JS-->

    <!-- START: APP JS-->
    <script src="<?php echo base_url();?>assets/new_theme/dist/js/app.js"></script>
    <!-- END: APP JS-->

    <!-- START: Page Vendor JS-->
    <script src="<?php echo base_url();?>assets/new_theme/dist/vendors/raphael/raphael.min.js"></script>
    <script src="<?php echo base_url();?>assets/new_theme/dist/vendors/morris/morris.min.js"></script>
    <script src="<?php echo base_url();?>assets/new_theme/dist/vendors/chartjs/Chart.min.js"></script>
    <script src="<?php echo base_url();?>assets/new_theme/dist/vendors/starrr/starrr.js"></script>
    <script src="<?php echo base_url();?>assets/new_theme/dist/vendors/jquery-flot/jquery.canvaswrapper.js"></script>
    <script src="<?php echo base_url();?>assets/new_theme/dist/vendors/jquery-flot/jquery.colorhelpers.js"></script>
    <script src="<?php echo base_url();?>assets/new_theme/dist/vendors/jquery-flot/jquery.flot.js"></script>
    <script src="<?php echo base_url();?>assets/new_theme/dist/vendors/jquery-flot/jquery.flot.saturated.js"></script>
    <script src="<?php echo base_url();?>assets/new_theme/dist/vendors/jquery-flot/jquery.flot.browser.js"></script>
    <script src="<?php echo base_url();?>assets/new_theme/dist/vendors/jquery-flot/jquery.flot.drawSeries.js"></script>
    <script src="<?php echo base_url();?>assets/new_theme/dist/vendors/jquery-flot/jquery.flot.uiConstants.js"></script>
    <script src="<?php echo base_url();?>assets/new_theme/dist/vendors/jquery-flot/jquery.flot.legend.js"></script>
    <script src="<?php echo base_url();?>assets/new_theme/dist/vendors/jquery-flot/jquery.flot.pie.js"></script>
    <script src="<?php echo base_url();?>assets/new_theme/dist/vendors/chartjs/Chart.min.js"></script>
    <script src="<?php echo base_url();?>assets/new_theme/dist/vendors/jquery-jvectormap/jquery-jvectormap-2.0.3.min.js"></script>
    <script src="<?php echo base_url();?>assets/new_theme/dist/vendors/jquery-jvectormap/jquery-jvectormap-world-mill.js"></script>
    <script src="<?php echo base_url();?>assets/new_theme/dist/vendors/jquery-jvectormap/jquery-jvectormap-de-merc.js"></script>
    <script src="<?php echo base_url();?>assets/new_theme/dist/vendors/jquery-jvectormap/jquery-jvectormap-us-aea.js"></script>
    <script src="<?php echo base_url();?>assets/new_theme/dist/vendors/apexcharts/apexcharts.min.js"></script>
    <!-- END: Page Vendor JS-->

    <!-- START: Page JS-->
    <script src="<?php echo base_url();?>assets/new_theme/dist/js/home.script.js"></script>

    <script src="<?php echo base_url();?>assets/new_theme/dist/raphael.min.js"></script>
    <script src="<?php echo base_url();?>assets/new_theme/dist/justgage.min.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function (event) {

            var out = "50000";   
            console.log(out);

            var jg1, jg2, jg3, jg4, jg5, jg6;

            var defs1 = {
                label: "Per Hour",
                value: 50000,
                min: 0,
                max: 101128,
                decimals: 0,
                levelColors: ["#E7211B","#E7E71B","#1BE731"],
                gaugeWidthScale: 0.6,
                pointer: true,
                pointerOptions: {
                        toplength: 10,
                    bottomlength: 10,
                    bottomwidth: 2
                },
                counter: true,
                relativeGaugeSize: true
            }

			console.log("Hello world!");

            var defs2 = {
                label: "Per Hour",
                value: 50000,
                min: 0,
                max: 24357,
                decimals: 0,
                levelColors: ["#E7211B","#E7E71B","#1BE731"],
                gaugeWidthScale: 0.6,
                pointer: true,
                pointerOptions: {
                    toplength: 10,
                    bottomlength: 10,
                    bottomwidth: 2
                },
                counter: true,
                relativeGaugeSize: true
            }

            var defs3 = {
                label: "Per Hour",
                value: 50000,
                min: 0,
                max: 11373,
                decimals: 0,
                levelColors: ["#E7211B","#E7E71B","#1BE731"],
                gaugeWidthScale: 0.6,
                pointer: true,
                pointerOptions: {
                    toplength: 10,
                    bottomlength: 10,
                    bottomwidth: 2
                },
                counter: true,
                relativeGaugeSize: true
            }

            var defs4 = {
                label: "Per Hour",
                value: 50000,
                min: 0,
                max: 343355,
                decimals: 0,
                levelColors: ["#E7211B","#E7E71B","#1BE731"],
                gaugeWidthScale: 0.6,
                pointer: true,
                pointerOptions: {
                    toplength: 10,
                    bottomlength: 10,
                    bottomwidth: 2
                },
                counter: true,
                relativeGaugeSize: true
            }

            var defs5 = {
                label: "Per Hour",
                value:50000,
                min: 0,
                max: 54000,
                decimals: 0,
                levelColors: ["#E7211B","#E7E71B","#1BE731"],
                gaugeWidthScale: 0.6,
                pointer: true,
                pointerOptions: {
                    toplength: 10,
                    bottomlength: 10,
                    bottomwidth: 2
                },
                counter: true,
                relativeGaugeSize: true
            }

            var defs6 = {
                label: "Minute",
                value: 10,
                min: 0,
                max: 10,
                decimals: 0,
                levelColors: ["#E7211B","#E7E71B","#1BE731"],
                gaugeWidthScale: 0.6,
                pointer: true,
                pointerOptions: {
                    toplength: 10,
                    bottomlength: 10,
                    bottomwidth: 2
                },
                counter: true,
                relativeGaugeSize: true
            }


            jg1 = new JustGage({
                id: "jg1",
                defaults: defs1
            });

            jg2 = new JustGage({
                id: "jg2",
                defaults: defs2
            });

            jg3 = new JustGage({
                id: "jg3",
                defaults: defs3
            });

            jg4 = new JustGage({
                id: "jg4",
                defaults: defs4
            });

            jg5 = new JustGage({
                id: "jg5",
                defaults: defs5
            });

            jg6 = new JustGage({
                id: "jg6",
                defaults: defs6
            });
        });
    </script>
    <!-- END: Page JS-->
</body>
<!-- END: Body-->