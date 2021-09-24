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
                <li class="active">
                    <a href="<?php echo base_url() . "Dashboard/Dashboard" ?>"><i class="icon-chart mr-1"></i> Dashboard Summary</a>
                </li>
                <li>
                    <a href="<?php echo base_url() . "Dashboard/Performance/performance" ?>"><i class="icon-chart mr-1"></i> Dashboard Performance</a>
                </li>

            </ul>
            <!-- END: Menu-->

        </div>
    </div>
    <!-- START: Main Content-->
    <main>
        <div class="container-fluid site-width">

            <div class='row'>
                <div class="col-12 col-lg-12  mt-3">
                    <div class="row">
                        <div class="col-12 col-lg-6">
                            <div class="row">
                                <div class="col-12 col-sm-6 mt-3">
                                    <div class="card bg-primary">
                                        <div class="card-body">
                                            <div class='d-flex px-0 px-lg-2 py-2 align-self-center'>
                                                <i class="icon-basket icons card-liner-icon mt-2 text-white"></i>
                                                <div class='card-liner-content'>
                                                    <h2 class="card-liner-title text-white"><?php echo number_format($toto); ?></h2>
                                                    <h6 class="card-liner-subtitle text-white">Orders</h6>
                                                </div>
                                            </div>
                                            <div id="apex_primary_chart"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6 mt-3">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class='d-flex px-0 px-lg-2 py-2 align-self-center'>
                                                <i class="icon-user icons card-liner-icon mt-2"></i>
                                                <div class='card-liner-content'>
                                                    <h2 class="card-liner-title"><?php echo number_format($totd); ?></h2>
                                                    <h6 class="card-liner-subtitle">Sent</h6>
                                                </div>
                                            </div>
                                            <span class="bg-primary card-liner-absolute-icon text-white card-liner-small-tip"><?php echo number_format($totd / $toto * 100, 2); ?> %</span>
                                            <div id="apex_today_visitors"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6  mt-3">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class='d-flex px-0 px-lg-2 py-2 align-self-center'>
                                                <i class="icon-bag icons card-liner-icon mt-2"></i>
                                                <div class='card-liner-content'>
                                                    <h2 class="card-liner-title"><?php echo number_format($tott); ?></h2>
                                                    <h6 class="card-liner-subtitle">Tagihan</h6>
                                                </div>
                                            </div>
                                            <div id="apex_today_sale"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6 mt-3">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class='d-flex px-0 px-lg-2 py-2 align-self-center'>
                                                <span class="card-liner-icon mt-1">$</span>
                                                <div class='card-liner-content'>
                                                    <h2 class="card-liner-title"><?php echo number_format($totrp); ?></h2>
                                                    <h6 class="card-liner-subtitle">Payment</h6>
                                                </div>
                                            </div>
                                            <div id="apex_today_profit"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-lg-6 mt-3">
                            <div class="card">
                                <div class="card-content">
                                    <div class="card-body">

                                        <div id="apex_bar_chart" class="height-500"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-6 col-lg-4 mt-3">
                            <div class="card">
                                <div class="card-content">
                                    <div class="card-body">
                                        <div class="d-flex">
                                            <div class="media-body align-self-center ">
                                                <span class="mb-0 h5 font-w-600">WhatsApps</span><br>
                                                <p class="mb-0 font-w-500 tx-s-12">Blast use channel WhatsApps</p>
                                            </div>
                                            <div class="ml-auto border-0 outline-badge-success circle-50"><span class="h5 mb-0"><i class="icon-bubble icons"></i></span></div>
                                        </div>
                                        <div class="d-flex mt-4">
                                            <div class="border-0 outline-badge-info w-50 p-3 rounded text-center"><span class="h5 mb-0"><?php echo number_format($wa['order']); ?></span><br />
                                                Orders
                                            </div>
                                            <div class="border-0 outline-badge-success w-50 p-3 rounded ml-2 text-center"><span class="h5 mb-0"><?php echo number_format($wa['order']); ?></span><br />
                                                Sent
                                            </div>
                                        </div>

                                        <div class="d-flex mt-3">
                                            <div class="border-0 outline-badge-dark w-50 p-3 rounded text-center"><span class="h5 mb-0"><?php echo number_format($wa['tagihan']); ?></span><br />
                                                Tagihan
                                            </div>
                                            <div class="border-0 outline-badge-danger w-50 p-3 rounded ml-2 text-center"><span class="h5 mb-0"><?php echo number_format($wa['rp']); ?></span><br />
                                                Payment
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-6 col-lg-4 mt-3">
                            <div class="card">
                                <div class="card-content">
                                    <div class="card-body">
                                        <div class="d-flex">
                                            <div class="media-body align-self-center ">
                                                <span class="mb-0 h5 font-w-600">SMS</span><br>
                                                <p class="mb-0 font-w-500 tx-s-12">Blast use channel SMS</p>
                                            </div>
                                            <div class="ml-auto border-0 outline-badge-success circle-50"><span class="h5 mb-0"><i class="icon-bubble icons"></i></span></div>
                                        </div>
                                        <div class="d-flex mt-4">
                                            <div class="border-0 outline-badge-info w-50 p-3 rounded text-center"><span class="h5 mb-0"><?php echo number_format($sms['order']); ?></span><br />
                                                Orders
                                            </div>
                                            <div class="border-0 outline-badge-success w-50 p-3 rounded ml-2 text-center"><span class="h5 mb-0"><?php echo number_format($sms['deliver']); ?></span><br />
                                                Sent
                                            </div>
                                        </div>

                                        <div class="d-flex mt-3">
                                            <div class="border-0 outline-badge-dark w-50 p-3 rounded text-center"><span class="h5 mb-0"><?php echo number_format($sms['tagihan']); ?></span><br />
                                                Tagihan
                                            </div>
                                            <div class="border-0 outline-badge-danger w-50 p-3 rounded ml-2 text-center"><span class="h5 mb-0"><?php echo number_format($sms['rp']); ?></span><br />
                                                Payment
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-6 col-lg-4 mt-3">
                            <div class="card">
                                <div class="card-content">
                                    <div class="card-body">
                                        <div class="d-flex">
                                            <div class="media-body align-self-center ">
                                                <span class="mb-0 h5 font-w-600">Email</span><br>
                                                <p class="mb-0 font-w-500 tx-s-12">Blast use channel Email</p>
                                            </div>
                                            <div class="ml-auto border-0 outline-badge-success circle-50"><span class="h5 mb-0"><i class="icon-bubble icons"></i></span></div>
                                        </div>
                                        <div class="d-flex mt-4">
                                            <div class="border-0 outline-badge-info w-50 p-3 rounded text-center"><span class="h5 mb-0"><?php echo number_format($email['order']); ?></span><br />
                                                Orders
                                            </div>
                                            <div class="border-0 outline-badge-success w-50 p-3 rounded ml-2 text-center"><span class="h5 mb-0"><?php echo number_format($email['order']); ?></span><br />
                                                Sent
                                            </div>
                                        </div>

                                        <div class="d-flex mt-3">
                                            <div class="border-0 outline-badge-dark w-50 p-3 rounded text-center"><span class="h5 mb-0"><?php echo number_format($email['tagihan']); ?></span><br />
                                                Tagihan
                                            </div>
                                            <div class="border-0 outline-badge-danger w-50 p-3 rounded ml-2 text-center"><span class="h5 mb-0"><?php echo number_format($email['rp']); ?></span><br />
                                                Payment
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-6 col-lg-4 mt-3">
                            <div class="card">
                                <div class="card-content">
                                    <div class="card-body">
                                        <div class="d-flex">
                                            <div class="media-body align-self-center ">
                                                <span class="mb-0 h5 font-w-600">OVR</span><br>
                                                <p class="mb-0 font-w-500 tx-s-12">Blast use channel OVR</p>
                                            </div>
                                            <div class="ml-auto border-0 outline-badge-success circle-50"><span class="h5 mb-0"><i class="icon-bubble icons"></i></span></div>
                                        </div>
                                        <div class="d-flex mt-4">
                                            <div class="border-0 outline-badge-info w-50 p-3 rounded text-center"><span class="h5 mb-0"><?php echo number_format($ovr['order']); ?></span><br />
                                                Orders
                                            </div>
                                            <div class="border-0 outline-badge-success w-50 p-3 rounded ml-2 text-center"><span class="h5 mb-0"><?php echo number_format($ovr['deliver']); ?></span><br />
                                                Sent
                                            </div>
                                        </div>

                                        <div class="d-flex mt-3">
                                            <div class="border-0 outline-badge-dark w-50 p-3 rounded text-center"><span class="h5 mb-0"><?php echo number_format($ovr['tagihan']); ?></span><br />
                                                Tagihan
                                            </div>
                                            <div class="border-0 outline-badge-danger w-50 p-3 rounded ml-2 text-center"><span class="h5 mb-0"><?php echo number_format($ovr['rp']); ?></span><br />
                                                Payment
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-6 col-lg-4 mt-3">
                            <div class="card">
                                <div class="card-content">
                                    <div class="card-body">
                                        <div class="d-flex">
                                            <div class="media-body align-self-center ">
                                                <span class="mb-0 h5 font-w-600">TVMS</span><br>
                                                <p class="mb-0 font-w-500 tx-s-12">Blast use channel TVMS</p>
                                            </div>
                                            <div class="ml-auto border-0 outline-badge-success circle-50"><span class="h5 mb-0"><i class="icon-bubble icons"></i></span></div>
                                        </div>
                                        <div class="d-flex mt-4">
                                            <div class="border-0 outline-badge-info w-50 p-3 rounded text-center"><span class="h5 mb-0">78,600</span><br />
                                                Orders
                                            </div>
                                            <div class="border-0 outline-badge-success w-50 p-3 rounded ml-2 text-center"><span class="h5 mb-0">1,24,600</span><br />
                                                Sent
                                            </div>
                                        </div>

                                        <div class="d-flex mt-3">
                                            <div class="border-0 outline-badge-dark w-50 p-3 rounded text-center"><span class="h5 mb-0">4,600</span><br />
                                                Tagihan
                                            </div>
                                            <div class="border-0 outline-badge-danger w-50 p-3 rounded ml-2 text-center"><span class="h5 mb-0">2,600</span><br />
                                                Payment
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-6 col-lg-4 mt-3">
                            <div class="card">
                                <div class="card-content">
                                    <div class="card-body">
                                        <div class="d-flex">
                                            <div class="media-body align-self-center ">
                                                <span class="mb-0 h5 font-w-600">OBC</span><br>
                                                <p class="mb-0 font-w-500 tx-s-12">Blast use channel OBC</p>
                                            </div>
                                            <div class="ml-auto border-0 outline-badge-success circle-50"><span class="h5 mb-0"><i class="icon-bubble icons"></i></span></div>
                                        </div>
                                        <div class="d-flex mt-4">
                                            <div class="border-0 outline-badge-info w-50 p-3 rounded text-center"><span class="h5 mb-0">78,600</span><br />
                                                Orders
                                            </div>
                                            <div class="border-0 outline-badge-success w-50 p-3 rounded ml-2 text-center"><span class="h5 mb-0">1,24,600</span><br />
                                                Sent
                                            </div>
                                        </div>

                                        <div class="d-flex mt-3">
                                            <div class="border-0 outline-badge-dark w-50 p-3 rounded text-center"><span class="h5 mb-0">4,600</span><br />
                                                Tagihan
                                            </div>
                                            <div class="border-0 outline-badge-danger w-50 p-3 rounded ml-2 text-center"><span class="h5 mb-0">2,600</span><br />
                                                Payment
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

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
    <!-- START: Page JS-->
    <!-- <script src="<?php echo base_url(); ?>assets/new_theme/dist/js/home.script.js"></script> -->
    <!-- END: Page JS-->
    <!-- <script src="dist/js/home.script.js"></script> -->
    <!-- END: Page JS-->
    <?php
    $reg = array('JAKARTA', 'JAWA BARAT', 'JAWA TENGAH', 'JAWA TIMUR', 'KALIMANTAN', 'KTI', 'SUMATRA');

    foreach ($reg as $regz) {
        $voreg[$regz] = $regional['wa'][$regz] + $regional['sms'][$regz] + $regional['tvms'][$regz] + $regional['ovr'][$regz] + $regional['email'][$regz];
    }
    // echo var_dump($voreg);
    ?>
    <script>
        $(document).ready(function() {

            var primarycolor = getComputedStyle(document.body).getPropertyValue('--primarycolor');
            var bordercolor = getComputedStyle(document.body).getPropertyValue('--bordercolor');
            var bodycolor = getComputedStyle(document.body).getPropertyValue('--bodycolor');
            var theme = 'light';
            if ($("#apex_bar_chart").length > 0) {
                options = {
                    theme: {
                        mode: theme
                    },
                    grid: {

                        yaxis: {
                            lines: {
                                show: false
                            }
                        }
                    },
                    chart: {
                        height: 318,
                        type: 'bar',
                    },
                    plotOptions: {
                        bar: {
                            horizontal: true,
                            columnWidth: '10',
                        }
                    },
                    dataLabels: {
                        enabled: false
                    },
                    colors: ['#1e3d73'],
                    series: [{

                        data: [<?php echo $voreg['JAKARTA'] . ',' . $voreg['JAWA BARAT'] . ',' . $voreg['JAWA TENGAH'] . ',' . $voreg['JAWA TIMUR'] . ',' . $voreg['KALIMANTAN'] . ',' . $voreg['KTI'] . ',' . $voreg['SUMATRA'] ?>]
                    }],
                    xaxis: {
                        categories: ['JAKARTA', 'JAWA BARAT', 'JAWA TENGAH', 'JAWA TIMUR', 'KALIMANTAN', 'KTI', 'SUMATRA']

                    }
                }

                var chart = new ApexCharts(
                    document.querySelector("#apex_bar_chart"),
                    options
                );
                chart.render();
            }

            if ($("#apex_primary_chart").length > 0) {
                options = {
                    chart: {
                        type: 'line',
                        height: 80,
                        sparkline: {
                            enabled: true
                        },
                        dropShadow: {
                            enabled: true,
                            top: 1,
                            left: 1,
                            blur: 2,
                            color: '#000',
                            opacity: 0.7,
                        }
                    },
                    series: [{
                        data: [41, 9, 36, 12, 44, 25, 59, 41, 66, 25]
                    }],
                    stroke: {
                        curve: 'smooth',
                        width: 2,
                    },
                    markers: {
                        size: 0
                    },
                    grid: {
                        padding: {
                            top: 0,
                            bottom: 0,
                            left: 0
                        }
                    },
                    colors: ['#1e3d73'],
                    tooltip: {
                        x: {
                            show: false
                        },
                        y: {
                            title: {
                                formatter: function formatter(val) {
                                    return '';
                                }
                            }
                        }
                    },
                    responsive: [{
                            breakpoint: 1351,
                            options: {
                                chart: {
                                    height: 95,
                                },
                                grid: {
                                    padding: {
                                        top: 35,
                                        bottom: 0,
                                        left: 0
                                    }
                                },
                            },
                        },
                        {
                            breakpoint: 1200,
                            options: {
                                chart: {
                                    height: 80,
                                },
                                grid: {
                                    padding: {
                                        top: 35,
                                        bottom: 0,
                                        left: 40
                                    }
                                },
                            },
                        },
                        {
                            breakpoint: 576,
                            options: {
                                chart: {
                                    height: 95,
                                },
                                grid: {
                                    padding: {
                                        top: 45,
                                        bottom: 0,
                                        left: 0
                                    }
                                },
                            },
                        }

                    ]
                }


                var chart = new ApexCharts(
                    document.querySelector("#apex_primary_chart"),
                    options
                );
                chart.render();
            }
            if ($("#apex_today_sale").length > 0) {
                options = {
                    chart: {
                        type: 'line',
                        height: 80,
                        sparkline: {
                            enabled: true
                        },
                        dropShadow: {
                            enabled: true,
                            top: 1,
                            left: 1,
                            blur: 2,
                            color: '#17a2b8',
                            opacity: 0.7,
                        }
                    },
                    series: [{
                        data: [7, 9, 36, 12, 44, 25, 59, 41, 12, 25]
                    }],
                    stroke: {
                        curve: 'smooth',
                        width: 2,
                    },
                    markers: {
                        size: 0
                    },
                    grid: {
                        padding: {
                            top: 0,
                            bottom: 0,
                            left: 0
                        }
                    },
                    colors: ['#17a2b8'],
                    tooltip: {
                        x: {
                            show: false
                        },
                        y: {
                            title: {
                                formatter: function formatter(val) {
                                    return '';
                                }
                            }
                        }
                    },
                    responsive: [{
                            breakpoint: 1351,
                            options: {
                                chart: {
                                    height: 95,
                                },
                                grid: {
                                    padding: {
                                        top: 35,
                                        bottom: 0,
                                        left: 0
                                    }
                                },
                            },
                        },
                        {
                            breakpoint: 1200,
                            options: {
                                chart: {
                                    height: 80,
                                },
                                grid: {
                                    padding: {
                                        top: 35,
                                        bottom: 0,
                                        left: 40
                                    }
                                },
                            },
                        },
                        {
                            breakpoint: 576,
                            options: {
                                chart: {
                                    height: 95,
                                },
                                grid: {
                                    padding: {
                                        top: 45,
                                        bottom: 0,
                                        left: 0
                                    }
                                },
                            },
                        }

                    ]
                }


                var chart = new ApexCharts(
                    document.querySelector("#apex_today_sale"),
                    options
                );
                chart.render();
            }
            if ($("#apex_today_profit").length > 0) {
                options = {
                    chart: {
                        type: 'line',
                        height: 80,
                        sparkline: {
                            enabled: true
                        },
                        dropShadow: {
                            enabled: true,
                            top: 1,
                            left: 1,
                            blur: 2,
                            color: '#ffc107',
                            opacity: 0.7,
                        }
                    },
                    series: [{
                        data: [21, 9, 36, 12, 44, 25, 59, 41, 66, 25]
                    }],
                    stroke: {
                        curve: 'smooth',
                        width: 2,
                    },
                    markers: {
                        size: 0
                    },
                    grid: {
                        padding: {
                            top: 0,
                            bottom: 0,
                            left: 0
                        }
                    },
                    colors: ['#ffc107'],
                    tooltip: {
                        x: {
                            show: false
                        },
                        y: {
                            title: {
                                formatter: function formatter(val) {
                                    return '';
                                }
                            }
                        }
                    },
                    responsive: [{
                            breakpoint: 1351,
                            options: {
                                chart: {
                                    height: 95,
                                },
                                grid: {
                                    padding: {
                                        top: 35,
                                        bottom: 0,
                                        left: 0
                                    }
                                },
                            },
                        },
                        {
                            breakpoint: 1200,
                            options: {
                                chart: {
                                    height: 80,
                                },
                                grid: {
                                    padding: {
                                        top: 35,
                                        bottom: 0,
                                        left: 40
                                    }
                                },
                            },
                        },
                        {
                            breakpoint: 576,
                            options: {
                                chart: {
                                    height: 95,
                                },
                                grid: {
                                    padding: {
                                        top: 45,
                                        bottom: 0,
                                        left: 0
                                    }
                                },
                            },
                        }

                    ]
                }


                var chart = new ApexCharts(
                    document.querySelector("#apex_today_profit"),
                    options
                );
                chart.render();
            }
            if ($("#apex_today_visitors").length > 0) {
                options = {
                    chart: {
                        type: 'line',
                        height: 80,
                        sparkline: {
                            enabled: true
                        },
                        dropShadow: {
                            enabled: true,
                            top: 1,
                            left: 1,
                            blur: 2,
                            color: '#28a745',
                            opacity: 0.7,
                        }
                    },
                    series: [{
                        data: [41, 9, 36, 12, 44, 25, 59, 41, 66, 25]
                    }],
                    stroke: {
                        curve: 'smooth',
                        width: 2,
                    },
                    markers: {
                        size: 0
                    },
                    grid: {
                        padding: {
                            top: 0,
                            bottom: 0,
                            left: 0
                        }
                    },
                    colors: ['#28a745'],
                    tooltip: {
                        x: {
                            show: false
                        },
                        y: {
                            title: {
                                formatter: function formatter(val) {
                                    return '';
                                }
                            }
                        }
                    },
                    responsive: [{
                            breakpoint: 1351,
                            options: {
                                chart: {
                                    height: 95,
                                },
                                grid: {
                                    padding: {
                                        top: 35,
                                        bottom: 0,
                                        left: 0
                                    }
                                },
                            },
                        },
                        {
                            breakpoint: 1200,
                            options: {
                                chart: {
                                    height: 80,
                                },
                                grid: {
                                    padding: {
                                        top: 35,
                                        bottom: 0,
                                        left: 40
                                    }
                                },
                            },
                        },
                        {
                            breakpoint: 576,
                            options: {
                                chart: {
                                    height: 95,
                                },
                                grid: {
                                    padding: {
                                        top: 45,
                                        bottom: 0,
                                        left: 0
                                    }
                                },
                            },
                        }

                    ]
                }


                var chart = new ApexCharts(
                    document.querySelector("#apex_today_visitors"),
                    options
                );
                chart.render();
            }
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




</body>
<!-- END: Body-->

</html>