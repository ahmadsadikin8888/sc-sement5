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
    <title>EBS Non Indihome - Detail</title>
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

    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/new_theme/tambahan/editor_text/src/richtext.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/new_theme/tambahan/editor_text/font-awesome.min.css">

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
                <li>
                    <a href="<?php echo base_url() . "Mizu/Mizu"; ?>"><i class="icon-phone mr-1"></i> Outbound Call</a>
                </li>
                <li>
                    <a href="<?php echo base_url() . "Ebs/Ebs" ?>"><i class="icon-envelope mr-1"></i> EBS Indihome</a>
                </li>
                <li class="active">
                    <a href="<?php echo base_url() . "Ebs_non_indihome/Ebs_non_indihome" ?>"><i class="icon-envelope mr-1"></i> EBS Non Indihome</a>
                </li>
                <li>
                    <a href="<?php echo base_url() . "Ebs_non_pots/Ebs_non_pots" ?>"><i class="icon-envelope mr-1"></i> EBS Non Pots</a>
                </li>


            </ul>
            <!-- END: Menu-->

        </div>
    </div>
    <!-- END: Main Menu-->


    <!-- START: Main Content-->
    <main>
        <div class="container-fluid site-width">

            <!-- END: Breadcrumbs-->
            <form id="form-a" action="#" method="post">
                <div class="row">
                    <div class="col-6">
                        <div class="sub-header mt-3 py-3 align-self-center d-sm-flex w-100 rounded">
                            <div class="w-sm-100 mr-auto">
                                <h4 class="mb-0">Indentitas Pelanggan</h4>

                            </div>
                        </div>
                        <div class="form">
                            <div class="form-group">
                                <label for="title">Scheme</label>
                                <select name='pic' class="form-control">
                                    <option value='0'>Please Select</option>
                                    <option value='DCS01'>Single</option>
                                    <option value='DCS02'>Grouping</option>
                                    <option value='DCS03'>Official Receift Grouping</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="title">Nomor MDI</label>
                                <input type="text" readonly name="mdiid" value="<?php echo $row_detail['mdiid']; ?>" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="title">Nama</label>
                                <input type="text" name="nama" value="<?php echo $row_detail['nameinvoice']; ?>" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="title">NPWP</label>
                                <input type="text" name="title" value="<?php echo $row_detail['npwp']; ?>" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="title">PIC</label>
                                <select name='pic' class="form-control">
                                    <option value='0'>Please Select</option>
                                    <option value='DCS01'>DCS01 - DCS Regional 1</option>
                                    <option value='DCS02'>DCS02 - DCS Regional 2</option>
                                    <option value='DCS03'>DCS03 - DCS Regional 3</option>
                                    <option value='DCS04'>DCS04 - DCS Regional 4</option>
                                    <option value='DCS05'>DCS05 - DCS Regional 5</option>
                                    <option value='DCS06'>DCS06 - DCS Regional 6</option>
                                    <option value='DCS07'>DCS07 - DCS Regional 7</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="title">Pelanggan</label>
                                <select name='pic' class="form-control">
                                    <option value='0'>Please Select</option>
                                    <option value='DCS01'>Resedential</option>
                                    <option value='DCS02'>Bisnis</option>
                                    <option value='DCS03'>Dinas</option>
                                    <option value='DCS04'>BUMN/Pemerintahan</option>
                                    <option value='DCS05'>Wartel</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="title">No Ktp</label>
                                <input type="text" name="title" value="<?php echo $row_detail['no_ktp']; ?>" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="title">Jenis Usaha</label>
                                <select name='pic' class="form-control">
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
                            </div>
                            <div class="form-group">
                                <label for="title">Tempat Lahir</label>
                                <input type="text" name="title" value="<?php echo $row_detail['tmp_lahir']; ?>" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="title">Tanggal Lahir</label>
                                <input type="text" name="title" value="<?php echo $row_detail['tgl_lahir']; ?>" class="form-control">
                            </div>
                        </div>
                        <div class="sub-header mt-3 py-3 align-self-center d-sm-flex w-100 rounded">
                            <div class="w-sm-100 mr-auto">
                                <h4 class="mb-0">Alamat Pelanggan</h4>

                            </div>
                        </div>
                        <div class="form">
                            <div class="form-group">
                                <label for="title">Jalan</label>
                                <input type="text" name="title" value="<?php echo $row_detail['street']; ?>" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="title">Nomor</label>
                                <input type="text" name="title" value="<?php echo $row_detail['housenum']; ?>" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="title">Gedung</label>
                                <input type="text" name="title" value="<?php echo $row_detail['building']; ?>" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="title">Lantai</label>
                                <input type="text" name="title" value="<?php echo $row_detail['lantai']; ?>" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="title">Kelurahan</label>
                                <input type="text" name="title" value="<?php echo $row_detail['village']; ?>" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="title">Kecamatan</label>
                                <input type="text" name="title" value="<?php echo $row_detail['subdistrict']; ?>" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="title">Kota</label>
                                <input type="text" name="title" value="<?php echo $row_detail['city']; ?>" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="title">Kode Pos</label>
                                <input type="text" name="title" value="<?php echo $row_detail['postalcode']; ?>" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="sub-header mt-3 py-3 align-self-center d-sm-flex w-100 rounded">
                            <div class="w-sm-100 mr-auto">
                                <h4 class="mb-0">Email</h4>

                            </div>
                        </div>
                        <div class="form">
                            <div class="form-group">
                                <label for="title">Periode Invoice</label>
                                <input type="text" name="periode" id="periode" onchange="change_periode();" value="<?php echo DATE('m-Y'); ?>" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="title">To</label>
                                <input type="text" name="email" id="email" value="<?php echo $row_detail['email']; ?>" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="title">CC</label>
                                <textarea class="form-control" id="emailcc"><?php echo $row_detail['cc']; ?></textarea>
                            </div>
                        </div>
                        <div class="form">

                            <div class="form-group">
                                <a class="btn btn-primary" id="button_preview" href='<?php echo base_url() . "Ebs_non_indihome/Ebs_non_indihome/preview/" . $row_detail['mdiid'] . '/' . DATE('Ym'); ?>' target="_blank">Preview</a>
                                <button onclick='send_email();' class="btn btn-primary" id="button_send" type="button">Send Email</button>
                                <button class="btn btn-primary" type="submit">Update Data</button>
                            </div>
                        </div>
                        <div class="sub-header mt-3 py-3 align-self-center d-sm-flex w-100 rounded">
                            <div class="w-sm-100 mr-auto">
                                <h4 class="mb-0">Multi Kontak</h4>

                            </div>
                        </div>
                        <div class="form">
                            <div class="form-group">
                                <label for="title">Telepon</label>
                                <input type="text" name="email" value="<?php echo $row_detail['telp']; ?>" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="title">Flexi</label>
                                <input type="text" name="email" value="<?php echo $row_detail['flexi']; ?>" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="title">Fax</label>
                                <input type="text" name="email" value="<?php echo $row_detail['fax']; ?>" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="title">OLO</label>
                                <input type="text" name="email" value="<?php echo $row_detail['olo']; ?>" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="title">Website</label>
                                <input type="text" name="email" value="<?php echo $row_detail['website']; ?>" class="form-control">
                            </div>
                        </div>
                        <div class="sub-header mt-3 py-3 align-self-center d-sm-flex w-100 rounded">
                            <div class="w-sm-100 mr-auto">
                                <h4 class="mb-0">Pelapor</h4>

                            </div>
                        </div>
                        <div class="form">
                            <div class="form-group">
                                <label for="title">Nama Pelapor</label>
                                <input type="text" name="email" value="" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="title">Email Pelapor</label>
                                <input type="text" name="email" value="" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="title">Telpon Pelapor</label>
                                <input type="text" name="email" value="" class="form-control">
                            </div>
                        </div>
                        <div class="sub-header mt-3 py-3 align-self-center d-sm-flex w-100 rounded">
                            <div class="w-sm-100 mr-auto">
                                <h4 class="mb-0">Informasi Pembayaran</h4>

                            </div>
                        </div>
                        <div class="form">
                            <div class="form-group">
                                <label for="title">Nama Bank</label>
                                <input type="text" name="email" value="" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="title">Nomor Rekening</label>
                                <input type="text" name="email" value="" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="title">Pemilik Rekening</label>
                                <input type="text" name="email" value="" class="form-control">
                            </div>
                        </div>
                        <div class="sub-header mt-3 py-3 align-self-center d-sm-flex w-100 rounded">
                            <div class="w-sm-100 mr-auto">
                                <h4 class="mb-0">Informasi Lainnya</h4>

                            </div>
                        </div>
                        <div class="form">

                            <div class="form-group">
                                <label for="title">Catatan</label>
                                <textarea class="form-control"><?php echo $row_detail['cc']; ?></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="col-md">

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


    <!-- END: Back to top-->
    <script type="text/javascript">
        function change_periode() {
            var str = $("#periode").val();
            var res = str.split("-");
            var url = '<?php echo base_url() . "Ebs/Ebs/preview/" . $row_detail['group_id'] . '/' ?>' + res[1] + res[0];
            $("#button_preview").attr("href", url);
        }

        function send_email() {
            var str = $("#periode").val();
            var res = str.split("-");
            var periode = res[1] + res[0];
            var email = $("#email").val();
            var emailcc = $("#emailcc").val();
            var url = '<?php echo base_url() . "Ebs/Ebs/send_email?group_id=" . $row_detail['group_id']; ?>&periode=' + periode + '&email=' + email + '&emailcc=' + emailcc;
            alert('Message has been sent');
            $("#button_send").text('Re-send Email');
            $.ajax({
                url: url,
                dataType: 'json',
                type: 'get',
                success: function(response) {

                }
            });
        }
    </script>
</body>
<!-- END: Body-->

</html>