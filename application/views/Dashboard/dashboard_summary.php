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
                    <a href="<?php echo base_url() . "Dashboard/Performance" ?>"><i class="icon-chart mr-1"></i> Dashboard Summary</a>
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
            <!-- START: Breadcrumbs-->

            <!-- END: Breadcrumbs-->

            <!-- START: Card Data-->
            <form method="GET" enctype="multipart/form-data" action="<?php echo base_url() ?>Dashboard/Performance">
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
            <div class="row mt-5">
                <div class="col-12 col-lg-3">
                    <div class="card">
                        <div class="card-header  justify-content-between align-items-center">
                            <h6 class="card-title">Summary Order </h6>
                        </div>
                        <div class="card-content">
                            <div class="card-body">
                                <div class="height-200">
                                    <canvas id="chartjs-other-pie"></canvas>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-12 col-lg-5 mt-3">
                    <div class="card">
                        <div class="card-header  justify-content-between align-items-center">
                            <h6 class="card-title">Summary Order by Channels </h6>
                        </div>
                        <div class="card-body table-responsive p-0">

                            <table class="table font-w-600 mb-0">
                                <thead>
                                    <tr>
                                        <th>Channel</th>
                                        <th>Progress</th>
                                        <th>Deliver</th>
                                        <th>Un Deliver</th>
                                        <th>Total Order</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="zoom">
                                        <td>Email</td>
                                        <td><?php echo number_format($email['progress'], 2) ?> %</td>
                                        <td class="text-success"><?php echo number_format($email['deliver']) ?></td>
                                        <td class="text-danger"><?php echo number_format($email['undeliver']) ?></td>
                                        <td><?php echo number_format($email['order']) ?></td>
                                    </tr>
                                    <tr class="zoom">
                                        <td>SMS</td>
                                        <td><?php echo number_format($sms['progress'], 2) ?> %</td>
                                        <td class="text-success"><?php echo number_format($sms['deliver']) ?></td>
                                        <td class="text-danger"><?php echo number_format($sms['undeliver']) ?></td>
                                        <td><?php echo $sms['order'] ?></td>
                                    </tr>
                                    <tr class="zoom">
                                        <td>Whatsapp</td>
                                        <td><?php echo number_format($wa['progress'], 2) ?> %</td>
                                        <td class="text-success"><?php echo number_format($wa['deliver']) ?></td>
                                        <td class="text-danger"><?php echo number_format($wa['undeliver']) ?></td>
                                        <td><?php echo number_format($wa['order']) ?></td>
                                    </tr>
                                    <tr class="zoom">
                                        <td>OVR</td>
                                        <td><?php echo number_format($ovr['progress'], 2) ?> %</td>
                                        <td class="text-success"><?php echo number_format($ovr['deliver']) ?></td>
                                        <td class="text-danger"><?php echo number_format($ovr['undeliver']) ?></td>
                                        <td><?php echo number_format($ovr['order']) ?></td>
                                    </tr>
                                    <tr class="zoom">
                                        <td>TVMS</td>
                                        <td><?php echo number_format($tvms['progress'], 2) ?> %</td>
                                        <td class="text-success"><?php echo number_format($tvms['deliver']) ?></td>
                                        <td class="text-danger"><?php echo number_format($tvms['undeliver']) ?></td>
                                        <td><?php echo number_format($tvms['order']) ?></td>
                                    </tr>
                                    <tr class="zoom">
                                        <td>Total</td>
                                        <td><?php echo number_format((($tvms['deliver'] + $ovr['deliver'] + $email['deliver'] + $sms['deliver'] + $wa['deliver']) / ($tvms['order'] + $ovr['order'] + $email['order'] + $sms['order'] + $wa['order'])) * 100, 2) ?> %</td>
                                        <td class="text-success"><?php echo number_format($tvms['deliver'] + $ovr['deliver'] + $email['deliver'] + $sms['deliver'] + $wa['deliver']) ?></td>
                                        <td class="text-danger"><?php echo number_format($tvms['undeliver'] + $ovr['undeliver'] + $email['undeliver'] + $sms['undeliver'] + $wa['undeliver']) ?></td>
                                        <td><?php echo number_format($tvms['order'] + $ovr['order'] + $email['order'] + $sms['order'] + $wa['order']) ?></td>
                                    </tr>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-4  mt-3">
                    <div class="card">
                        <div class="card-header  justify-content-between align-items-center">
                            <h6 class="card-title">Summary Success by Channel </h6>
                        </div>
                        <div class="card-content">
                            <div class="card-body">
                                <div>
                                    <div id="apex_bar_chart"></div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-lg-3  mt-3">
                    <div class="card">
                        <div class="card-header  justify-content-between align-items-center">
                            <h6 class="card-title">Summary Unique Customer </h6>
                        </div>
                        <div class="card-content">
                            <div class="card-body">
                                <div class="height-200">
                                    <canvas id="chartjs-other-pie2"></canvas>
                                </div>
                                <table width="100%">
                                    <?php
                                    if (count($summary_unique_customer) > 0) {
                                        for ($i = 0; $i < count($summary_unique_customer); $i++) {
                                            echo '<tr>
	                                		<td>' . $summary_unique_customer[$i]['label'] . '</td>
	                                		<td>:</td>
	                                		<td>Rp.' . $summary_unique_customer[$i]['sum_bayar'] . ',-</td>
	                                		</tr>';
                                        }
                                    } else {
                                        echo '<tr>
                                		<td colspan="3">Tidak ada Data.</td>
                                		</tr>';
                                    }
                                    ?>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-12 col-lg-5 mt-3">
                    <div class="card">
                        <div class="card-header  justify-content-between align-items-center">
                            <h6 class="card-title">Summary Order by Regional </h6>
                        </div>
                        <div class="card-body table-responsive p-0">

                            <table class="table font-w-600 mb-0">
                                <thead>
                                    <tr>
                                        <th>Regional</th>
                                        <th>Progress</th>
                                        <th>Deliver</th>
                                        <th>Un Deliver</th>
                                        <th>Total Order</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $data = array('JAKARTA', 'JAWA BARAT', 'JAWA TENGAH', 'JAWA TIMUR', 'KALIMANTAN', 'KTI', 'SUMATRA');
                                    foreach ($data as $datareg) {
                                        $totorder = $regional['sms'][$datareg] + $regional['wa'][$datareg] + $regional['email'][$datareg] + $regional['ovr'][$datareg] + $regional['tvms'][$datareg];
                                        $totdeliv = $regional['smsd'][$datareg] + $regional['wad'][$datareg] + $regional['emaild'][$datareg] + $regional['ovrd'][$datareg] + $regional['tvmsd'][$datareg];
                                        $persen = $totdeliv / $totorder * 100;
                                        echo "<tr>";
                                        echo "<td>" . $datareg . "</td>";
                                        echo "<td>" . number_format($persen, 2) . " %</td>";
                                        echo "<td>" . number_format($totdeliv) . "</td>";
                                        echo "<td>" . number_format($totorder - $totdeliv) . "</td>";
                                        echo "<td>" . number_format($totorder) . "</td>";
                                        echo "</tr>";
                                    }
                                    ?>


                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-4  mt-3">
                    <div class="card">
                        <!-- <div class="card-header  justify-content-between align-items-center">
                            <h6 class="card-title">Total Order </h6>
                        </div> -->
                        <div class="card-content">
                            <div class="card-body p-0">
                                <ul class="list-group list-unstyled">
                                    <?php
                                    // $total_success = array_sum(array_map(function ($item) {
                                    //     return $item['count_order'];
                                    // }, $summary_order_by_unique_customer));
                                    // $color_class = ['#1ee0ac', '#ffc107', '#17a2b8'];
                                    // $color_class1 = ['success', 'warning', 'info'];
                                    // if (count($summary_order_by_unique_customer) > 0) {
                                    //     for ($i = 0; $i < count($summary_order_by_unique_customer); $i++) {
                                    //         echo '<li class="p-4 border-bottom">
                                    // 		<div class="w-100">
                                    // 		<a href="#">Total Success ' . $summary_order_by_unique_customer[$i]['label_2'] . '</a>
                                    // 		<div class="barfiller h-7 rounded" data-color="' . $color_class[$i] . '">
                                    // 		<div class="tipWrap">
                                    // 		<span class="tip rounded ' . $color_class1[$i] . '">
                                    // 		<span class="tip-arrow"></span>
                                    // 		</span>
                                    // 		</div>
                                    // 		<span class="fill" data-percentage="' . round(($summary_order_by_unique_customer[$i]['count_order'] / $total_success) * 100) . '"></span>
                                    // 		</div>
                                    // 		</div>
                                    // 		</li>';
                                    //     }
                                    // } else {
                                    //     echo '<span class="text-center"> Tidak ada Data. </span>';
                                    // }
                                    ?>
                                    <li class="p-4 border-bottom">
                                        <div class="w-100">
                                            <a href="#">Total Success</a>
                                            <div class="barfiller h-7 rounded" data-color="#1ee0ac">
                                                <div class="tipWrap">
                                                    <span class="tip rounded success">
                                                        <span class="tip-arrow"></span>
                                                    </span>
                                                </div>
                                                <?php
                                                $pertotd = round($totd / $toto * 100);
                                                ?>
                                                <span class="fill" data-percentage="<?php echo $pertotd; ?>"></span>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="p-4 border-bottom">
                                        <div class="w-100">
                                            <a href="#">Total Unsuccess</a>
                                            <div class="barfiller h-7" data-color="#ffc107">
                                                <div class="tipWrap">
                                                    <span class="tip rounded warning">
                                                        <span class="tip-arrow"></span>
                                                    </span>
                                                </div>
                                                <?php
                                                $pertotu = round($totu / $toto * 100);
                                                ?>
                                                <span class="fill" data-percentage="<?php echo $pertotu; ?>"></span>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="p-4 border-bottom">
                                        <div class="w-100">
                                            <a href="#">Sisa Order</a>
                                            <div class="barfiller h-7" data-color="#17a2b8">
                                                <div class="tipWrap">
                                                    <span class="tip rounded info">
                                                        <span class="tip-arrow"></span>
                                                    </span>
                                                </div>
                                                <?php
                                                $pertotu = round($toto / $toto * 100);
                                                ?>
                                                <span class="fill" data-percentage="56"></span>
                                            </div>
                                        </div>
                                    </li>


                                </ul>
                            </div>
                            <div class="card-footer text-muted">
                                Total Order Success: <span><?php echo $total_success; ?></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-lg-4  mt-3">
                    <div class="card">
                        <div class="card-header  justify-content-between align-items-center">
                            <h6 class="card-title">Pencairan H-1</h6>
                        </div>
                        <div class="card-content">
                            <table class="table font-w-600 mb-0">
                                <thead>
                                    <tr>
                                        <th>Unique Customer</th>
                                        <th>Total Tagihan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <th>-</th>
                                    <th>Rp. 0,-</th>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-4 col-lg-4 mt-3">
                    <div class="card">
                        <div class="card-header  justify-content-between align-items-center">
                            <h6 class="card-title">Pencairan Minggu ini</h6>
                        </div>
                        <div class="card-content">
                            <table class="table font-w-600 mb-0">
                                <thead>
                                    <tr>
                                        <th>Unique Customer</th>
                                        <th>Total Tagihan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <th>-</th>
                                    <th>Rp. 0</th>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-4 col-lg-4 mt-3">
                    <div class="card">
                        <div class="card-header  justify-content-between align-items-center">
                            <h6 class="card-title">Pencairan Bulan ini</h6>
                        </div>
                        <div class="card-content">
                            <table class="table font-w-600 mb-0">
                                <thead>
                                    <tr>
                                        <th>Unique Customer</th>
                                        <th>Total Tagihan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <th>-</th>
                                    <th>Rp. <?php echo $totrp;?></th>
                                </tbody>
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

        var config = {
            type: 'doughnut',
            data: {
                datasets: [{
                    data: [<?php echo $totd . "," . $totu ?>],
                    backgroundColor: [
                        '#1e3d73',
                        '#17a2b8',
                        '#ffc107'
                    ],
                    label: 'Dataset 1'
                }],
                labels: [
                    'Deliver',
                    'Undeliver'
                ]

            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                legend: {
                    display: true,
                    position: 'bottom',
                    labels: {
                        fontColor: bodycolor
                    }
                },
                animation: {
                    animateScale: true,
                    animateRotate: true
                },
            }
        };

        <?php
        $dataset = array_column($summary_unique_customer, 'count_status');
        $datalabel = array_column($summary_unique_customer, 'label');
        ?>
        var config2 = {
            type: 'doughnut',
            data: {
                datasets: [{
                    data: [3, 28, 67]
                    <?php //echo json_encode($dataset); 
                    ?>,
                    backgroundColor: [
                        '#1e3d73',
                        '#17a2b8',
                        '#ffc107'
                    ],
                    label: 'Dataset 1'
                }],
                labels: [
                    'Progress',
                    'Success',
                    'Unsuccess'
                ]
                <?php //echo json_encode($datalabel); 
                ?>
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                legend: {
                    display: true,
                    position: 'bottom',
                    labels: {
                        fontColor: bodycolor
                    }
                },
                animation: {
                    animateScale: true,
                    animateRotate: true
                },
            }
        };
        var chartjs_other_pie = document.getElementById("chartjs-other-pie");
        if (chartjs_other_pie) {
            var ctx = document.getElementById('chartjs-other-pie').getContext('2d');
            window.myDoughnut = new Chart(ctx, config);
        }
        var chartjs_other_pie2 = document.getElementById("chartjs-other-pie2");
        if (chartjs_other_pie) {
            var ctx = document.getElementById('chartjs-other-pie2').getContext('2d');
            window.myDoughnut = new Chart(ctx, config2);
        }

        <?php
        $dataset = array_column($summary_success_by_channel, 'channel_count');
        $datalabel = array_column($summary_success_by_channel, 'label');
        ?>
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
                        data: [<?php echo $email['deliver'] . "," . $sms['deliver'] . "," . $wa['deliver'] . "," . $ovr['deliver'] . "," . $tvms['deliver'] . "]" ?>
                        }],
                    xaxis: {
                        categories: ['Email', 'SMS', 'WA', 'OVR', 'TVMS']


                    }
                }

                var chart = new ApexCharts(
                    document.querySelector("#apex_bar_chart"),
                    options
                );
                chart.render();
            }
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

<!-- END: Back to top-->


</body>
<!-- END: Body-->

</html>