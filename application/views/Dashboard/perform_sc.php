<!DOCTYPE html>
<html lang="en">
<!-- START: Head-->

<head>
    <meta charset="UTF-8">
    <title><?php echo $this->_appinfo['template_title_bar'] ?></title>
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
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/new_theme/dist/vendors/chartist-js/chartist.min.css">
    <!-- END: Page CSS-->

    <!--dibutuhkan-->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/new_theme/dist/vendors/c3/c3.min.css">
    <link href="<?php echo base_url(); ?>assets/new_theme/dist/vendors/lineprogressbar/jquery.lineProgressbar.min.css" rel="stylesheet">
    <!--end dibutuhkan-->

    <!-- START: Page CSS-->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/new_theme/dist/vendors/morris/morris.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/new_theme/dist/vendors/weather-icons/css/pe-icon-set-weather.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/new_theme/dist/vendors/chartjs/Chart.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/new_theme/dist/vendors/starrr/starrr.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/new_theme/dist/vendors/fontawesome/css/all.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/new_theme/dist/vendors/ionicons/css/ionicons.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/new_theme/dist/vendors/jquery-jvectormap/jquery-jvectormap-2.0.3.css">
    <!-- END: Page CSS-->

    <!-- START: Custom CSS-->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/new_theme/dist/css/main.css">
    <!-- END: Custom CSS-->
</head>
<!-- END Head-->
<!-- START: Body-->

<!-- <body id="main-container" class="default compact-menu" style="margin-top:-60px; margin-left:-60px;"> -->

<body id="main-container" class="default horizontal-menu">

    <!-- START: Pre Loader-->
    <!-- <div class="se-pre-con">
        <div class="loader"></div>
    </div> -->
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
                <li>
                    <a href="<?php echo base_url() . "Dashboard/Performance" ?>"><i class="icon-chart mr-1"></i> Dashboard Summary</a>
                </li>
                <li class="active">
                    <a href="<?php echo base_url() . "Dashboard/Performance/performance" ?>"><i class="icon-chart mr-1"></i> Dashboard Performance</a>
                </li>
             
            </ul>
            <!-- END: Menu-->

        </div>
    </div>
    <!-- START: Main Content-->
    <main>
        <div class="container-fluid site-width">
            <!-- START: Breadcrumbs-->

            <!-- END: Breadcrumbs-->

            <!-- START: Card Data-->
            <form method="GET" enctype="multipart/form-data" action="<?php echo base_url() ?>Dashboard/Performance/Performance">
                <div class="row">
                    <div class="col-6">
                        <div class="form">

                            <div class="form-group row mt-3 ">
                                <select class="form form-control  col-3 ml-2" name="periode">

                                    <option <?php if ($_GET['periode'] == 'Month') {
                                                echo 'selected';
                                            } ?>>Month</option>
                                    <option <?php if ($_GET['periode'] == 'Year') {
                                                echo 'selected';
                                            } ?>>Year</option>
                                </select>
                                <label class="mt-2 ml-3">Date</label> <input type="date" name="date" class="form-control col-4 ml-2" value="<?php if (isset($_GET['date'])) {
                                                                                                                                                echo $_GET['date'];
                                                                                                                                            } else {
                                                                                                                                                echo date("Y-m-d");
                                                                                                                                            } ?>">
                                <button type="submit" class="btn btn-primary ml-2"><i class="fa fa-search"></i> Process</button>
                            </div>

                        </div>

                    </div>


                </div>

            </form>
            <div class="row" style="margin-top:-15px;">
                <div class="col-12 col-lg-4 mt-3">
                    <div class="card">
                        <div class="card-header  justify-content-between align-items-center">
                            <h7 class="card-title">Summary Order (Month: <?php echo date('m-Y', strtotime($_GET['date'])); ?>)</h7>
                        </div>
                        <div class="card-content">
                            <div class="card-body p-0">
                                <!-- Start Summary Order -->
                                <div class="col-12 col-md mt-2">
                                    <div class="p-0">
                                        <div class="p-1 align-self-center">
                                            <h2><?php echo number_format($totd);
                                                $pertotd = $totd / $toto * 100;
                                                $pertotu = $totu / $toto * 100;
                                                $pertots = ($toto - ($totd + $totu)) / $toto * 100;
                                                ?></h2>
                                            <h6 class="card-liner-subtitle">Deliver</h6>
                                        </div>
                                        <div class="barfiller" data-color="#17a2b8">
                                            <div class="tipWrap" style="display: inline;">
                                                <span class="tip rounded info" style="left: 335.85px; transition: left 1s ease-in-out 0s;"><?php echo round($pertotd); ?>%</span>
                                            </div>
                                            <span class="fill" data-percentage="<?php echo round($pertotd); ?>" style="background: rgb(23, 162, 184); width: 361.25px; transition: width 1s ease-in-out 0s;"></span>
                                        </div>

                                    </div>
                                </div>
                                <div class="col-12 col-md mt-2">
                                    <div class="p-0">
                                        <div class="p-1 align-self-center">
                                            <h2><?php echo number_format($totu); ?></h2>
                                            <h6 class="card-liner-subtitle">Undeliver</h6>
                                        </div>
                                        <div class="barfiller" data-color="#17a2b8">
                                            <div class="tipWrap" style="display: inline;">
                                                <span class="tip rounded info" style="left: 335.85px; transition: left 1s ease-in-out 0s;"><?php echo round($pertotu); ?></span>
                                            </div>
                                            <span class="fill" data-percentage="<?php echo round($pertotu); ?>" style="background: rgb(23, 162, 184); width: 361.25px; transition: width 1s ease-in-out 0s;"></span>
                                        </div>

                                    </div>
                                </div>
                                <div class="col-12 col-md mt-2">
                                    <div class="p-0">
                                        <div class="p-1 align-self-center">
                                            <h2><?php echo number_format($toto - ($totd + $totu)); ?></h2>
                                            <h6 class="card-liner-subtitle">Sisa Order</h6>
                                        </div>
                                        <div class="barfiller" data-color="#17a2b8">
                                            <div class="tipWrap" style="display: inline;">
                                                <span class="tip rounded info" style="left: 335.85px; transition: left 1s ease-in-out 0s;"><?php echo round($pertots); ?>%</span>
                                            </div>
                                            <span class="fill" data-percentage="<?php echo number_format($pertots, 2); ?>" style="background: rgb(23, 162, 184); width: 361.25px; transition: width 1s ease-in-out 0s;"></span>
                                        </div>

                                    </div>
                                </div>
                                <div class="col-12 col-md mt-2">
                                    <div class="card bg-primary text-white">
                                        <div class="card-body" style="position: relative;">
                                            <div class="d-flex px-0 px-lg-2 py-2 align-self-center">
                                                <i class="icon-user icons card-liner-icon mt-2"></i>
                                                <div class="card-liner-content">
                                                    <h2 class="card-liner-title">-</h2>
                                                    <h6 class="card-liner-subtitle">Unique Customer</h6>
                                                </div>
                                            </div>
                                            <span class="bg-primary card-liner-absolute-icon text-white card-liner-small-tip">+4.8%</span>

                                            <div class="resize-triggers">
                                                <div class="expand-trigger">
                                                    <div style="width: 287px; height: 175px;"></div>
                                                </div>
                                                <div class="contract-trigger"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-md mt-5">
                                    <div class="p-0">
                                        <div class="p-1 align-self-center">
                                            <h2><?php echo number_format($totp); ?></h2>
                                            <h6 class="card-liner-subtitle">Cust Payment</h6>
                                        </div>
                                        <div class="barfiller" data-color="#17a2b8">
                                            <div class="tipWrap" style="display: inline;">
                                                <span class="tip rounded info" style="left: 335.85px; transition: left 1s ease-in-out 0s;"><?php echo number_format($totp / $toto, 2) ?> %</span>
                                            </div>
                                            <span class="fill" data-percentage="<?php echo number_format($totp / $toto * 100, 2) ?>" style="background: rgb(23, 162, 184); width: 361.25px; transition: width 1s ease-in-out 0s;"></span>
                                        </div>

                                    </div>
                                </div>
                                <div class="col-12 col-md mt-2">
                                    <div class="p-0">
                                        <div class="p-1 align-self-center">
                                            <h2><?php echo number_format($toto - $totp, 2) ?></h2>
                                            <h6 class="card-liner-subtitle">Cust No Payment</h6>
                                        </div>
                                        <div class="barfiller" data-color="#17a2b8">
                                            <div class="tipWrap" style="display: inline;">
                                                <span class="tip rounded info" style="left: 335.85px; transition: left 1s ease-in-out 0s;"><?php echo number_format(($toto - $totp) / $toto * 100, 2); ?> %</span>
                                            </div>
                                            <span class="fill" data-percentage="<?php echo number_format(($toto - $totp) / $toto * 100, 2); ?>" style="background: rgb(23, 162, 184); width: 361.25px; transition: width 1s ease-in-out 0s;"></span>
                                        </div>

                                    </div>
                                </div>
                                <div class="col-12 col-md mt-2">
                                    <div class="card bg-primary text-white">
                                        <div class="card-body" style="position: relative;">
                                            <div class="d-flex px-0 px-lg-2 py-2 align-self-center">
                                                <i class="icon-user icons card-liner-icon mt-2"></i>
                                                <div class="card-liner-content">
                                                    <h2 class="card-liner-title">Rp. <?php echo number_format($totrp) ?></h2>
                                                    <h6 class="card-liner-subtitle">Total Payment</h6>
                                                </div>
                                            </div>
                                            <span class="bg-primary card-liner-absolute-icon text-white card-liner-small-tip">+4.8%</span>

                                            <div class="resize-triggers">
                                                <div class="expand-trigger">
                                                    <div style="width: 287px; height: 175px;"></div>
                                                </div>
                                                <div class="contract-trigger"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md mt-3">
                    <div class="col">
                        <div class="card">
                            <div class="card-header  justify-content-between align-items-center">
                                <h7 class="card-title">Summary Order by Month</h7>
                            </div>
                            <div class="card-content">
                                <div id="apex_analytic_chart" class="height-300"></div>
                            </div>
                        </div>
                        <div class="card">

                            <table class="table table-hover table-dark">
                                <tr>
                                    <th>#</th>
                                    <th>JAKARTA</th>
                                    <th>JAWA BARAT</th>
                                    <th>JAWA TENGAH</th>
                                    <th>JAWA TIMUR</th>
                                    <th>KALIMANTAN</th>
                                    <th>KTI</th>
                                    <th>SUMATRA</th>
                                </tr>
                                <tr>
                                    <td>Collected (Rp)</td>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>-</td>
                                </tr>
                                <tr>
                                    <td>Collected (Customer)</td>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>-</td>
                                </tr>
                                <tr>
                                    <td>Total Order</td>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>-</td>
                                </tr>
                                <tr>
                                    <td>Total Success</td>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>-</td>
                                </tr>
                            </table>

                        </div>
                    </div>
                </div>
                
            </div>
            

        </div>
        <!-- END: Card DATA-->
        </div>
    </main>
    <!-- END: Content-->
    <!-- START: Footer-->
    <footer class="site-footer">
        <?php echo $this->_appinfo['template_footer_right'] ?>
    </footer>
    <!-- END: Footer-->


    <!-- START: Back to top-->
    <a href="#" class="scrollup text-center">
        <i class="icon-arrow-up"></i>
    </a>
    <!-- END: Back to top-->


    <!-- START: Template JS-->
    <script src="<?php echo base_url(); ?>assets/new_theme/dist/vendors/jquery/jquery-3.3.1.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/new_theme/dist/vendors/jquery-ui/jquery-ui.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/new_theme/dist/vendors/moment/moment.js"></script>
    <script src="<?php echo base_url(); ?>assets/new_theme/dist/vendors/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/new_theme/dist/vendors/slimscroll/jquery.slimscroll.min.js"></script>
    <!-- END: Template JS-->

    <!-- START: APP JS-->
    <!-- <script src="<?php echo base_url(); ?>assets/new_theme/dist/js/app.js"></script> -->
    <!-- END: APP JS-->

    <!-- START: Page Vendor JS-->
    <script src="<?php echo base_url(); ?>assets/new_theme/dist/vendors/raphael/raphael.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/new_theme/dist/vendors/morris/morris.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/new_theme/dist/vendors/chartjs/Chart.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/new_theme/dist/vendors/starrr/starrr.js"></script>
    <script src="<?php echo base_url(); ?>assets/new_theme/dist/vendors/jquery-flot/jquery.canvaswrapper.js"></script>
    <script src="<?php echo base_url(); ?>assets/new_theme/dist/vendors/jquery-flot/jquery.colorhelpers.js"></script>
    <script src="<?php echo base_url(); ?>assets/new_theme/dist/vendors/jquery-flot/jquery.flot.js"></script>
    <script src="<?php echo base_url(); ?>assets/new_theme/dist/vendors/jquery-flot/jquery.flot.saturated.js"></script>
    <script src="<?php echo base_url(); ?>assets/new_theme/dist/vendors/jquery-flot/jquery.flot.browser.js"></script>
    <script src="<?php echo base_url(); ?>assets/new_theme/dist/vendors/jquery-flot/jquery.flot.drawSeries.js"></script>
    <script src="<?php echo base_url(); ?>assets/new_theme/dist/vendors/jquery-flot/jquery.flot.uiConstants.js"></script>
    <script src="<?php echo base_url(); ?>assets/new_theme/dist/vendors/jquery-flot/jquery.flot.legend.js"></script>
    <script src="<?php echo base_url(); ?>assets/new_theme/dist/vendors/jquery-flot/jquery.flot.pie.js"></script>
    <script src="<?php echo base_url(); ?>assets/new_theme/dist/vendors/chartjs/Chart.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/new_theme/dist/vendors/jquery-jvectormap/jquery-jvectormap-2.0.3.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/new_theme/dist/vendors/jquery-jvectormap/jquery-jvectormap-world-mill.js"></script>
    <script src="<?php echo base_url(); ?>assets/new_theme/dist/vendors/jquery-jvectormap/jquery-jvectormap-de-merc.js"></script>
    <script src="<?php echo base_url(); ?>assets/new_theme/dist/vendors/jquery-jvectormap/jquery-jvectormap-us-aea.js"></script>
    <script src="<?php echo base_url(); ?>assets/new_theme/dist/vendors/apexcharts/apexcharts.min.js"></script>
    <!-- END: Page Vendor JS-->

    <!--dibutuhkan-->
    <script src="<?php echo base_url(); ?>assets/new_theme/dist/vendors/c3/d3.v5.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/new_theme/dist/vendors/c3/c3.min.js"></script>


    <script src="<?php echo base_url(); ?>assets/new_theme/dist/vendors/lineprogressbar/jquery.lineProgressbar.js"></script>
    <script src="<?php echo base_url(); ?>assets/new_theme/dist/vendors/lineprogressbar/jquery.barfiller.js"></script>

    <script src="<?php echo base_url(); ?>assets/new_theme/dist/vendors/jquery-knob/jquery.knob.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/new_theme/dist/js/knob.script.js"></script>
    <!-- START: Page JS-->

    <!-- <script src="dist/js/home.script.js"></script> -->
    <!-- END: Page JS-->
    <script>
        $(document).ready(function() {

            var primarycolor = getComputedStyle(document.body).getPropertyValue('--primarycolor');
            var bordercolor = getComputedStyle(document.body).getPropertyValue('--bordercolor');
            var bodycolor = getComputedStyle(document.body).getPropertyValue('--bodycolor');
            var theme = 'light';
            if ($('body').hasClass('dark')) {
                theme = 'dark';
            }
            if ($('body').hasClass('dark-alt')) {
                theme = 'dark';
            }

            if ($('.barfiller').length > 0) {
                $(".barfiller").each(function() {
                    $(this).barfiller({
                        barColor: $(this).data('color')
                    });
                });
            }
            if ($("#apex_analytic_chart").length > 0) {
                options = {
                    theme: {
                        mode: theme
                    },
                    chart: {
                        height: 350,
                        type: 'bar',
                    },
                    responsive: [{
                        breakpoint: 767,
                        options: {
                            chart: {
                                height: 220
                            }
                        }
                    }],
                    plotOptions: {
                        bar: {
                            horizontal: false,
                            columnWidth: '55%',
                            endingShape: 'rounded'
                        },
                    },
                    dataLabels: {
                        enabled: false
                    },
                    stroke: {
                        show: true,
                        width: 2,
                        colors: ['transparent']
                    },
                    colors: ['#1e3d73', '#17a2b8', '#1ee0ac'],
                    series: [{
                        name: 'Order',
                        data: <?php echo json_encode($chart['order']) ?>
                    }, {
                        name: 'Deliver',
                        data: <?php echo json_encode($chart['deliver']) ?>
                    }, {
                        name: 'Undeliver',
                        data: <?php echo json_encode($chart['undeliver']) ?>
                    }],
                    xaxis: {
                        categories: <?php echo json_encode($chart['label']) ?>,
                    },
                    yaxis: {
                        title: {
                            text: '(Jumlah)'
                        }
                    },
                    fill: {
                        opacity: 1

                    },
                    tooltip: {
                        y: {
                            formatter: function(val) {
                                return val + " Data"
                            }
                        }
                    }
                }

                var chart = new ApexCharts(
                    document.querySelector("#apex_analytic_chart"),
                    options
                );
                chart.render();
            }


            // Isi value
            $('#template').val('<?php echo $sel_template; ?>');
        });
    </script>
</body>
<!-- END: Body-->

</html>
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
<script src="<?php echo base_url(); ?>assets/new_theme/dist/vendors/echarts/echarts.min.js"></script>
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
<script src="<?php echo base_url(); ?>assets/new_theme/dist/vendors/chartist-js/chartist.min.js"></script>

<!-- END: Back to top-->


</body>
<!-- END: Body-->

</html>