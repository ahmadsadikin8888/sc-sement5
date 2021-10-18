<!DOCTYPE html>
<html lang="en">
<!-- START: Head-->

<head>
    <?php
    if (isset($_GET['start'])) {
    } else {
    ?>
        <!-- <meta http-equiv="refresh" content="300"> -->
    <?php
    }
    function nice_number($n)
    {
        // first strip any formatting;
        $n = (0 + str_replace(",", "", $n));

        // is this a number?
        if (!is_numeric($n)) return false;

        // now filter it;
        if ($n > 1000000000000) return round(($n / 1000000000000), 2) . ' T';
        elseif ($n > 1000000000) return round(($n / 1000000000), 2) . ' B';
        elseif ($n > 1000000) return round(($n / 1000000), 2) . ' M';
        elseif ($n > 1000) return $n;

        return number_format($n);
    }

    ?>

    <meta charset="UTF-8">
    <title>Digital Channel - Data Lead</title>
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
                <li>
                    <a href="<?php echo base_url(); ?>"><i class="icon-home mr-1"></i> Home</a>
                </li>
                <li class="active">
                    <a href="<?php echo base_url() . "Dc/Dc/dalalead" ?>"><i class="icon-chart mr-1"></i> Dashboard</a>
                </li>
                <li>
                    <a href="<?php echo base_url() . "Dc/Dc/campaign" ?>"><i class="icon-chart mr-1"></i> Blast Management</a>
                </li>
                <li>
                    <a href="<?php echo base_url() . "Dc/Dc/report" ?>"><i class="icon-chart mr-1"></i> Log</a>
                </li>
            </ul>

        </div>
    </div>
    <!-- END: Main Menu-->


    <!-- START: Main Content-->
    <main>
        <div class="container-fluid site-width">
            <!-- START: Breadcrumbs-->
            <div class="row">
                <div class="col-12  align-self-center">
                    <div class="sub-header mt-3 py-3 align-self-center d-sm-flex w-100 rounded">
                        <div class="w-sm-100 mr-auto">
                            <!-- <h4 class="mb-0">Dashboard</h4>
                            <i>*Last Update at <?php echo  date("d F Y h:i A", strtotime($last_update)); ?></i> -->
                        </div>


                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12  align-self-center">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h6 class="card-title">Dashboard Monitoring</h6>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-3">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="subheader">Whatsapp</div>
                                            <div class="h4 mb-3 text-center"><?php echo number_format($channel['WA_INFOTAG']['order'] - $channel['WA_INFOTAG']['sisa']); ?>/<i style="font-size:10px;">Order <?php echo number_format($channel['WA_INFOTAG']['order']); ?></i></div>
                                        </div>

                                        <div class="progress progress-sm">
                                            <?php
                                            $percent_wa = (($channel['WA_INFOTAG']['order'] - $channel['WA_INFOTAG']['sisa']) / $channel['WA_INFOTAG']['order']) * 100;
                                            ?>
                                            <div class="progress-bar bg-blue" style="width: <?php echo $percent_wa; ?>%" role="progressbar" aria-valuenow="<?php echo $percent_wa; ?>" aria-valuemin="0" aria-valuemax="100">
                                                <span class="visually-hidden"><?php echo number_format($percent_wa, 2); ?>% Complete</span>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                                <div class="col-3">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="subheader">Email</div>
                                            <div class="h4 mb-3 text-center"><?php echo number_format($channel['DUNING_EMAIL']['order'] - $channel['DUNING_EMAIL']['sisa']); ?>/<i style="font-size:10px;">Order <?php echo number_format($channel['DUNING_EMAIL']['order']); ?></i></div>
                                        </div>
                                        <div class="progress progress-sm">
                                            <?php
                                            $percent_email = (($channel['DUNING_EMAIL']['order'] - $channel['DUNING_EMAIL']['sisa']) / $channel['DUNING_EMAIL']['order']) * 100;
                                            ?>
                                            <div class="progress-bar bg-blue" style="width: <?php echo $percent_email; ?>%" role="progressbar" aria-valuenow="<?php echo $percent_email; ?>" aria-valuemin="0" aria-valuemax="100">
                                                <span class="visually-hidden"><?php echo number_format($percent_email, 2); ?>% Complete</span>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="col-3">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="subheader">SMS</div>
                                            <div class="h4 mb-3 text-center"><?php echo number_format($channel['DUNING_SMS']['order'] - $channel['DUNING_SMS']['sisa']); ?>/<i style="font-size:10px;">Order <?php echo number_format($channel['DUNING_SMS']['order']); ?></i></div>
                                        </div>
                                        <div class="progress progress-sm">
                                            <?php
                                            $percent_sms = (($channel['DUNING_SMS']['order'] - $channel['DUNING_SMS']['sisa']) / $channel['DUNING_SMS']['order']) * 100;
                                            ?>
                                            <div class="progress-bar bg-blue" style="width: <?php echo $percent_sms; ?>%" role="progressbar" aria-valuenow="<?php echo $percent_sms; ?>" aria-valuemin="0" aria-valuemax="100">
                                                <span class="visually-hidden"><?php echo number_format($percent_sms, 2); ?>% Complete</span>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="col-3">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="subheader">Total Order</div>
                                            <div class="h4 mb-3 text-center"><?php echo number_format($progress_sms); ?></div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="row  mt-3">
                                <div class="col-3">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="subheader">OVR</div>
                                            <div class="h4 mb-3 text-center"><?php echo number_format($channel['DUNING_OVR']['order'] - $channel['DUNING_OVR']['sisa']); ?>/<i style="font-size:10px;">Order <?php echo number_format($channel['DUNING_OVR']['order']); ?></i></div>
                                        </div>
                                        <div class="progress progress-sm">
                                            <?php
                                            $percent_ovr = (($channel['DUNING_OVR']['order'] - $channel['DUNING_OVR']['sisa']) / $channel['DUNING_OVR']['order']) * 100;
                                            ?>
                                            <div class="progress-bar bg-blue" style="width: <?php echo $percent_ovr; ?>%" role="progressbar" aria-valuenow="<?php echo $percent_ovr; ?>" aria-valuemin="0" aria-valuemax="100">
                                                <span class="visually-hidden"><?php echo number_format($percent_ovr, 2); ?>% Complete</span>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="col-3">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="subheader">TVMS</div>
                                            <div class="h4 mb-3 text-center"><?php echo number_format($channel['TVMS']['order'] - $channel['TVMS']['sisa']); ?>/<i style="font-size:10px;">Order <?php echo number_format($channel['TVMS']['order']); ?></i></div>
                                        </div>
                                        <div class="progress progress-sm">
                                            <?php
                                            $percent_tvms = (($channel['TVMS']['order'] - $channel['TVMS']['sisa']) / $channel['TVMS']['order']) * 100;
                                            ?>
                                            <div class="progress-bar bg-blue" style="width: <?php echo $percent_tvms; ?>%" role="progressbar" aria-valuenow="<?php echo $percent_tvms; ?>" aria-valuemin="0" aria-valuemax="100">
                                                <span class="visually-hidden"><?php echo number_format($percent_tvms, 2); ?>% Complete</span>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="col-3">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="subheader">OBC</div>
                                            <div class="h4 mb-3 text-center">-</div>
                                        </div>
                                        <!-- <div class="progress progress-sm">
                                            <div class="progress-bar bg-blue" style="width: <?php echo $percent_sms; ?>%" role="progressbar" aria-valuenow="<?php echo $percent_sms; ?>" aria-valuemin="0" aria-valuemax="100">
                                                <span class="visually-hidden"><?php echo number_format($percent_sms, 2); ?>% Complete</span>
                                            </div>
                                        </div> -->
                                    </div>

                                </div>
                                <div class="col-3">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="subheader">Sisa Order</div>
                                            <div class="h4 mb-3 text-center"><?php echo number_format($progress_sms); ?></div>
                                        </div>
                                    </div>

                                </div>

                            </div>

                            <div class="mt-3">
                                <div class="col-12 col-lg-12  mt-3">
                                    <table id="byagent" class="table dataTable table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <td nowrap style='text-align:center;'>Days</td>
                                                <?php
                                                $m_channel = array("WA_INFOTAG" => "Whatsapp", "DUNING_EMAIL" => "Email", "DUNING_SMS" => "SMS", "DUNING_OVR" => "OVR", "TVMS" => "TVMS", "OBC" => "OBC");
                                                foreach ($m_channel as $ch => $vl) {
                                                    echo "<td nowrap style='text-align:center;'>" . $vl . "</td>";
                                                }
                                                echo "<td nowrap style='text-align:center;'>Total</td>";
                                                ?>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $n = 0;
                                            $total_sumber = array();
                                            $total_reg_all = 0;
                                            for ($day = 1; $day <= 31; $day++) {

                                                echo "<tr>";
                                                echo "<td>" . $day . "</td>";
                                                foreach ($m_channel as $ch => $vl) {
                                                    echo "<td style='text-align:center;'>" . number_format($channel[$ch][$day]['order']) . "</td>";
                                                }
                                                echo "<td style='text-align:center;'><b>" . number_format($channel[$day]) . "</b></td>";
                                                echo "</tr>";
                                            }
                                            ?>
                                        </tbody>
                                    </table>
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

    <!---- END page datatable--->

    <!-- END: Back to top-->

</body>
<!-- END: Body-->

</html>