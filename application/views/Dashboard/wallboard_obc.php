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
    <div id="header-fix" class="header fixed-top ">

        <nav class="navbar navbar-expand-lg  p-0">
            <img src="<?php echo base_url("api/Public_Access/get_logo_template") ?>" class="header-brand-img h-<?php echo $this->_appinfo['template_logo_size'] ?>" alt="ybs logo">

        </nav>
    </div>
    <!-- END: Header-->
    <!-- START: Main Menu-->

    <!-- START: Main Content-->
    <main>
        <!-- <div class="container-fluid site-width"> -->
        <div class='ml-4'>
            <!-- START: Breadcrumbs-->

            <!-- END: Breadcrumbs-->

            <!-- START: Card Data-->
            <form method="GET" enctype="multipart/form-data" action="<?php echo base_url() ?>Dashboard/Performance">
                <div class="row">
                    <div class="col-6">
                        <div class="form">

                            <div class="form-group row mt-3 ">
                                <select name="department" id="department" class="form form-control  col-3 ml-2">
                                    <option value="">All</option>
                                    <option value="5">CARING SUMATRA</option>
                                    <option value="6">CARING JAKARTA</option>
                                    <option value="7">CARING JAWA BARAT</option>
                                    <option value="8">CARING JAWA TENGAH</option>
                                    <option value="9">CARING JAWA TIMUR</option>
                                    <option value="10">CARING KALIMANTAN</option>
                                    <option value="12">CARING KTI</option>
                                </select>
                                <select class="form form-control  col-3 ml-2" name="status" id="status">
                                    <option>All Status</option>
                                    <option value='filt_ol'>Online</option>
                                    <option value='filt_ready'>Ready</option>
                                    <option value='filt_idle'>Idle</option>
                                    <option value='filt_offline'>Offline</option>
                                </select>
                            </div>

                        </div>
                    </div>


                </div>
                <div class="row">
                    <div class="col-12 col-sm-6 col-xl-2 mt-3">
                        <div class="card">
                            <div class="card-body text-success border-bottom border-success border-w-5">
                                <h2 class="text-center" id="user_online">0</h2>
                                <h6 class="text-center">Online</h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-xl-2 mt-3">
                        <div class="card">
                            <div class="card-body text-info border-bottom border-info border-w-5">
                                <h2 class="text-center" id="user_ready">0</h2>
                                <h6 class="text-center">Ready</h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-xl-2 mt-3">
                        <div class="card">
                            <div class="card-body text-danger border-bottom border-danger border-w-5">
                                <h2 class="text-center" id="user_idle">0</h2>
                                <h6 class="text-center">Idle</h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-xl-2 mt-3">
                        <div class="card">
                            <div class="card-body text-default border-bottom border-default border-w-5">
                                <h2 class="text-center" id="user_aux">0</h2>
                                <h6 class="text-center">Aux</h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-xl-2 mt-3">
                        <div class="card">
                            <div class="card-body text-default border-bottom border-default border-w-5">
                                <h2 class="text-center" id="user_offline">0</h2>
                                <h6 class="text-center">Offline</h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-xl-2 mt-3">
                        <div class="card">
                            <div class="card-body text-info border-bottom border-info border-w-5">
                                <h2 class="text-center" id="contacted">0</h2>
                                <h6 class="text-center">Call Connected</h6>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="row">
                    <div class="col-12  mt-3">
                        <div class="card">
                            <div class="card-body" id="agent_wall">
                            </div>
                        </div>
                    </div>
                </div>

            </form>





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
    <script type="text/javascript">
        var id_department = $('#department').val();
        var filt_ol = $('#filt_ol').val();
        var filt_ready='';
        var filt_idle='';
        var filt_offline='';
        $.ajax({
            url: "<?php echo base_url('Dashboard/SmartCollection'); ?>/get_datawallboard",
            data: "department_id=" + id_department + "&filt_ol=" + filt_ol + "&filt_ready=" + filt_ready + "&filt_idle=" + filt_idle + "&filt_offline=" + filt_offline,
            dataType: 'json',
            cache: false,
            success: function(hasil) {
                $('#agent_wall').empty();
                $.each(hasil, function(i, val) {
                    //$('#agent_wall').append('<div style="width:200px; margin:3px" class="btn '+val.alert+'"><img class="img-thumbnail" src="'+val.foto+'".jpg"/> <b><font size="4">'+val.username+'</font></b><br/><span style="margin-top:5px">'+val.dial_mode+' - '+val.extension+'</span><br/><small>'+val.icon+' '+val.agent_status+' Since '+val.last_exec+'</small><br/>'+val.login_user+'</div>');
                    $('#agent_wall').append('<div style="width: 16%;" class="font-icon-list border  mx-1 mb-2 bg-' + val.alert + '"><div class="preview"><div class="card "><div class="card-content"><div class="card-image business-card"><div class="background-image-maker" style="background-image: url(' + val.foto + ');"></div><div class="holder-image"><img src="' + val.foto + '" alt="" style="min-height:200px;max-height:200px;" class="img-fluid"></div><div class="rating-block "><div class="starrr"></div></div></div><div class="card-body"><div class="like">' + val.last_exec + '</div><h6 class="">' + val.agent_status + ' <small>(PDS-' + val.login_user + ')</small></h6></div></div></div></div></div>');
                });
            }

        });
        $.ajax({
            url: "<?php echo base_url('Dashboard/SmartCollection'); ?>/get_totalwallboard",
            data: "department_id=" + id_department + "&filt_ol=" + filt_ol + "&filt_ready=" + filt_ready + "&filt_idle=" + filt_idle + "&filt_offline=" + filt_offline,
            dataType: 'json',
            cache: false,
            success: function(hasil2) {
                $('#user_online').html(hasil2.user_online);
                $('#user_ready').html(hasil2.user_ready);
                $('#user_idle').html(hasil2.user_idle);
                $('#user_idle').html(hasil2.user_idle);
                $('#user_offline').html(hasil2.user_offline);
                $('#user_aux').html(hasil2.user_aux);
                $('#contacted').html(hasil2.tot_call);

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

<!-- END: Back to top-->


</body>
<!-- END: Body-->

</html>