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
    <title>OBC</title>
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
    <!-- START: Page CSS-->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/new_theme/dist/vendors/sweetalert/sweetalert.css">
    <!-- END: Page CSS-->


    <!-- START: Custom CSS-->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/new_theme/dist/css/main.css">
    <script src="<?php echo base_url(); ?>assets/new_theme/dist/vendors/chartjs/Chart.min.js"></script>
    <!-- <script src="<?php echo base_url(); ?>assets/js/plugins/jquery-knob/jquery.knob.min.js" type="text/javascript"></script> -->
    <!-- END: Page CSS-->
    <script src="<?php echo base_url() ?>assets/js/highcharts.js"></script>
    <script src="<?php echo base_url() ?>assets/js/bundle.js"></script>


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
                    <a href="<?php echo base_url() . "Mizu/Mizu"; ?>"><i class="icon-phone mr-1"></i> Outbound Call</a>
                </li>
                <li>
                    <a href="<?php echo base_url() . "Ebs/Ebs" ?>"><i class="icon-envelope mr-1"></i> EBS Indihome</a>
                </li>
                <li>
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
        <div class="container-fluid ">
            <!-- START: Breadcrumbs-->
            <div class="row">


                <div class="col-12  align-self-center">
                    <div class="sub-header mt-3 py-3 align-self-center d-sm-flex w-100 rounded">
                        <div class="w-sm-100 mr-auto">
                            <h4 class="mb-0"></h4>
                            <!-- <i>*Last Update at <?php echo  date("d F Y h:i A", strtotime($last_update)); ?></i> -->
                        </div>
                    </div>
                </div>
            </div>
            <!-- END: Breadcrumbs-->
            <div class="row">
                <div class="col-9" id="on_call_block">
                    <div class="row">

                        <div class="col-8">
                            <form id="form_untuk_submit_<?php echo $datana->TRANS_ID; ?>" methode="post">
                                <div id="load_block">
                                    <div class="card">
                                        <div class="card-header">
                                            <h4 class="card-title">Interaction Data</h4>
                                        </div>
                                        <div class="card-content">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-12">

                                                        <div class="form-row">
                                                            <div class="col-6 mb-3">
                                                                <label for="username">Status bayar</label>
                                                                <select readonly name="FLAG_JANJI_BAYAR" id="FLAG_JANJI_BAYAR" class="form-control">
                                                                    <option value=""></option>
                                                                    <option value="JANJI MAU BAYAR">JANJI MAU BAYAR</option>
                                                                    <option value="BELUM BISA BAYAR">BELUM BISA BAYAR</option>
                                                                </select>

                                                            </div>
                                                            <div class="col-6 mb-3">
                                                                <label for="email">Tgl Janji Bayar</label>
                                                                <input type="date" readonly name="TGL_JANJI_BAYAR" id="TGL_JANJI_BAYAR" class="form-control">
                                                            </div>

                                                            <div class="col-12 mb-3">
                                                                <label for="username"><b>Alasan Belum Bayar</b></label>

                                                            </div>
                                                            <div class="col-6 mb-3">
                                                                <label for="email">kategori</label>
                                                                <select class="form-control" name="KATEGORI" id="KATEGORI" readonly>
                                                                    <option value=""></option>
                                                                    <option value="ADMINISTRATIF">ADMINISTRATIF</option>
                                                                    <option value="PAYMENT">PAYMENT</option>
                                                                    <option value="SERVICE ">SERVICE </option>
                                                                    <option value="TECHNICAL ">TECHNICAL </option>
                                                                </select>
                                                            </div>

                                                            <div class="col-6 mb-3">
                                                                <label for="username">Kendala</label>
                                                                <select class="form-control" readonly name="KENDALA" id="KENDALA">
                                                                    <option value=""></option>
                                                                    <option class='ADMINISTRATIF kategori_list' value="Batal Pasang Baru">Batal Pasang Baru</option>
                                                                    <option class='ADMINISTRATIF kategori_list' value="Klaim Data Pelanggan">Klaim Data Pelanggan</option>
                                                                    <option class='ADMINISTRATIF kategori_list' value="Minta Down/Up Grade Paket ">Minta Down/Up Grade Paket </option>
                                                                    <option class='ADMINISTRATIF kategori_list' value="Telepon Beda Pemilik">Telepon Beda Pemilik </option>
                                                                    <option class='ADMINISTRATIF kategori_list' value="Tidak Merasa Pasang baru">Tidak Merasa Pasang baru</option>
                                                                    <option class='ADMINISTRATIF kategori_list' value="Bundling Belum Aktif">Bundling Belum Aktif</option>
                                                                    <option class='ADMINISTRATIF kategori_list' value="Sudah Minta Cabut Tagihan Masih Ada">Sudah Minta Cabut Tagihan Masih Ada</option>
                                                                    <option class='ADMINISTRATIF kategori_list' value="PSB belum aktif">PSB belum aktif</option>
                                                                    <option class='ADMINISTRATIF kategori_list' value="EBS tidak sampai">EBS tidak sampai</option>
                                                                    <option class='ADMINISTRATIF kategori_list' value="Registrasi EBS">Registrasi EBS</option>
                                                                    <option class='ADMINISTRATIF kategori_list' value="UnReg EBS">UnReg EBS</option>
                                                                    <option class='ADMINISTRATIF kategori_list' value="Registrasi TSI">Registrasi TSI</option>
                                                                    <option class='ADMINISTRATIF kategori_list' value="UnReg TSI">UnReg TSI</option>
                                                                    <option class='PAYMENT kategori_list' value="Belum Ada Uang Untuk Bayar">Belum Ada Uang Untuk Bayar</option>
                                                                    <option class='PAYMENT kategori_list' value="Klaim Tagihan">Klaim Tagihan</option>
                                                                    <option class='PAYMENT kategori_list' value="Lupa Bayar">Lupa Bayar</option>
                                                                    <option class='PAYMENT kategori_list' value="Minta Dijemput Pembayaran">Minta Dijemput Pembayaran</option>
                                                                    <option class='PAYMENT kategori_list' value="Pembayaran Minta Diangsur">Pembayaran Minta Diangsur</option>
                                                                    <option class='PAYMENT kategori_list' value="Sering Keluar Kota">Sering Keluar Kota</option>
                                                                    <option class='PAYMENT kategori_list' value="Tagihan Tidak Sesuai Janji/Promo">Tagihan Tidak Sesuai Janji/Promo</option>
                                                                    <option class='PAYMENT kategori_list' value="Tempat Bayar Tidak ada/Jauh">Tempat Bayar Tidak ada/Jauh</option>
                                                                    <option class='PAYMENT kategori_list' value="Tidak Bisa Dibayar Di Loket/ATM">Tidak Bisa Dibayar Di Loket/ATM</option>
                                                                    <option class='PAYMENT kategori_list' value="Tidak Sempat Melakukan Pembayaran">Tidak Sempat Melakukan Pembayaran</option>
                                                                    <option class='PAYMENT kategori_list' value="Tidak Tahu Tagihan">Tidak Tahu Tagihan</option>
                                                                    <option class='PAYMENT kategori_list' value="Buka Isolir (BUKIS)">Buka Isolir (BUKIS)</option>
                                                                    <option class='PAYMENT kategori_list' value="Tagihan melonjak">Tagihan melonjak</option>
                                                                    <option class='PAYMENT kategori_list' value="Tagihan Tidak Muncul">Tagihan Tidak Muncul</option>
                                                                    <option class='PAYMENT kategori_list' value="Tagihan Gimmick Tidak Sesuai">Tagihan Gimmick Tidak Sesuai</option>
                                                                    <option class='PAYMENT kategori_list' value="Tidak bisa bayar tagihan jastel">Tidak bisa bayar tagihan jastel</option>
                                                                    <option class='SERVICE kategori_list' value="Game Online Putus-putus">Game Online Putus-putus</option>
                                                                    <option class='SERVICE kategori_list' value="IP Kena Blok">IP Kena Blok</option>
                                                                    <option class='SERVICE kategori_list' value="Intermitten/Putus-Putus">Intermitten/Putus-Putus</option>
                                                                    <option class='SERVICE kategori_list' value="Koneksi Bagus Download Lambat">Koneksi Bagus Download Lambat</option>
                                                                    <option class='SERVICE kategori_list' value="Lambat">Lambat</option>
                                                                    <option class='SERVICE kategori_list' value="Sharing PC Tidak Jalan">Sharing PC Tidak Jalan</option>
                                                                    <option class='SERVICE kategori_list' value="Tidak Bisa Browsing">Tidak Bisa Browsing</option>
                                                                    <option class='SERVICE kategori_list' value="Tidak Bisa Connect">Tidak Bisa Connect</option>
                                                                    <option class='SERVICE kategori_list' value="Tidak Bisa Email">Tidak Bisa Email</option>
                                                                    <option class='SERVICE kategori_list' value="Tidak Bisa Game Online">Tidak Bisa Game Online</option>
                                                                    <option class='SERVICE kategori_list' value="Tidak Bisa Ke Website Tertentu">Tidak Bisa Ke Website Tertentu</option>
                                                                    <option class='SERVICE kategori_list' value="Gangguan Fitur">Gangguan Fitur</option>
                                                                    <option class='SERVICE kategori_list' value="Ganggguan Hunting">Ganggguan Hunting</option>
                                                                    <option class='SERVICE kategori_list' value="Tidak Bisa Memanggil">Tidak Bisa Memanggil</option>
                                                                    <option class='SERVICE kategori_list' value="Tidak Bisa Dipanggil">Tidak Bisa Dipanggil</option>
                                                                    <option class='SERVICE kategori_list' value="Tidak Bisa Menghubungi/Dihubungi Nomor Tertentu">Tidak Bisa Menghubungi/Dihubungi Nomor Tertentu</option>
                                                                    <option class='SERVICE kategori_list' value="Tidak Bisa SLI">Tidak Bisa SLI</option>
                                                                    <option class='SERVICE kategori_list' value="Tidak Bisa SLJJ">Tidak Bisa SLJJ</option>
                                                                    <option class='SERVICE kategori_list' value="Tidak Bisa Faximile">Tidak Bisa Faximile</option>
                                                                    <option class='SERVICE kategori_list' value="Gangguan Layanan EDC">Gangguan Layanan EDC</option>
                                                                    <option class='SERVICE kategori_list' value="Gannguan layanan VPN Dial">Gannguan layanan VPN Dial</option>
                                                                    <option class='SERVICE kategori_list' value="Gangguan Japati">Gangguan Japati</option>
                                                                    <option class='TECHNICAL kategori_list' value="Instalasi Belum selesai">Instalasi Belum selesai</option>
                                                                    <option class='TECHNICAL kategori_list' value="Perangkat Pelanggan Belum Lengkap">Perangkat Pelanggan Belum Lengkap</option>
                                                                    <option class='TECHNICAL kategori_list' value="Petugas Belum Datang">Petugas Belum Datang</option>
                                                                    <option class='TECHNICAL kategori_list' value="Internet Belum Aktif">Internet Belum Aktif</option>
                                                                    <option class='TECHNICAL kategori_list' value="Cross Talk/Induksi">Cross Talk/Induksi</option>
                                                                    <option class='TECHNICAL kategori_list' value="PTSN Salah Sambung">PTSN Salah Sambung</option>
                                                                    <option class='TECHNICAL kategori_list' value="Suara Lemah, robot, dengung dan kemrosok">Suara Lemah, robot, dengung dan kemrosok</option>
                                                                    <option class='TECHNICAL kategori_list' value="Suara putus-putus beberapa menit">Suara putus-putus beberapa menit</option>
                                                                    <option class='TECHNICAL kategori_list' value="Suara lawan bicara tidak terdengar">Suara lawan bicara tidak terdengar</option>
                                                                    <option class='TECHNICAL kategori_list' value="Telepon mati/Tidak ada nada">Telepon mati/Tidak ada nada</option>
                                                                </select>

                                                            </div>
                                                            <div class="col-12 mb-3">
                                                                <label for="username">Keterangan</label>

                                                                <input type="text" readonly name="KETERANGAN" id="KETERANGAN" class="form-control">

                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card mt-3">
                                        <div class="card-header">
                                            <h4 class="card-title">Interaction Status Call</h4>
                                        </div>
                                        <div class="card-content">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-12">

                                                        <div class="form-row">
                                                            <div class="col-6 mb-3">
                                                                <label for="username">No.Kontak</label>

                                                                <input type="text" readonly id="NO_KONTAK" name="NO_KONTAK" value="<?php echo $datana->NO_KONTAK; ?>" class="form-control">

                                                            </div>
                                                            <div class="col-6 mb-3">
                                                                <label for="email">ND</label>
                                                                <input type="text" readonly id="nd_pelanggan" value="<?php echo $detail->ND; ?>" class="form-control">
                                                            </div>
                                                            <!-- <div class="col-6 mb-3">
                                        <label for="email">Type Kontak</label> -->
                                                            <input type="hidden" name="TIPE_KONTAK" id="TIPE_KONTAK" value="<?php echo $datana->TIPE_KONTAK; ?>" class="form-control">
                                                            <!-- </div> -->

                                                            <div class="col-6 mb-3">
                                                                <label for="username">Status Call</label>

                                                                <select id="STATUS_CALL_" readonly class="form-control" name="STATUS_CALL_">
                                                                    <option value="1" selected>CONTACTED</option>
                                                                    <option value="2">NOT CONTACTED</option>
                                                                </select>

                                                            </div>
                                                            <div class="col-6 mb-3">
                                                                <label for="email">Reason Status</label>
                                                                <select class="form-control" readonly name="REASON_CALL" id="REASON_CALL">
                                                                    <option value=""></option>
                                                                    <option value="SIBUK">SIBUK</option>
                                                                    <option value="SETUJU">SETUJU</option>
                                                                    <option value="SUDAH LUNAS">SUDAH LUNAS</option>
                                                                    <option value="CALL REJECTED">CALL REJECTED</option>
                                                                    <option value="SALAH SAMBUNG">SALAH SAMBUNG</option>
                                                                    <option value="SALAH E-MAIL">SALAH E-MAIL</option>
                                                                    <option value="TIDAK MAU DI CALL">TIDAK MAU DI CALL</option>
                                                                    <option value="TELEPON ISOLIR">TELEPON ISOLIR</option>
                                                                    <option value="INVALID PHONE NUMBER">INVALID PHONE NUMBER</option>
                                                                    <option value="TELEPON TULALIT">TELEPON TULALIT</option>
                                                                    <option value="RNA">RNA</option>
                                                                    <option value="NADA SIBUK">NADA SIBUK</option>
                                                                    <option value="MAILBOX-MEMO">MAILBOX-MEMO</option>
                                                                    <option value="FAX-MODEM">FAX-MODEM</option>
                                                                </select>
                                                            </div>

                                                            <div class="col-6 mb-3">
                                                                <label for="username">Status Detail</label>

                                                                <input type="text" readonly class="form-control">

                                                            </div>
                                                            <div class="col-6 mb-3">
                                                                <label for="username">Status Multikontak</label>

                                                                <input type="text" readonly class="form-control">

                                                            </div>
                                                            <div class="col-6 mb-3">
                                                                <label for="username">Nama Penerima</label>

                                                                <input type="text" readonly name="PENERIMA" id="PENERIMA" value="<?php echo $datana->NAMA_MASTER; ?>" class="form-control">
                                                                <input type="hidden" name="TRANS_ID" id="TRANS_ID" value="<?php echo $datana->TRANS_ID; ?>" class="form-control">

                                                            </div>
                                                            <div class="col-6 mb-3">
                                                                <label for="username">Hubungan</label>

                                                                <select class="form-control" readonly name="HUB_PENERIMA" id="HUB_PENERIMA">
                                                                    <option value=""></option>
                                                                    <option value="YANG BERSANGKUTAN">YANG BERSANGKUTAN</option>
                                                                    <option value="ADIK">ADIK</option>
                                                                    <option value="ANAK">ANAK</option>
                                                                    <option value="ISTRI">ISTRI</option>
                                                                    <option value="KAKAK">KAKAK</option>
                                                                    <option value="KARYAWAN ">KARYAWAN </option>
                                                                    <option value="KELUARGA">KELUARGA</option>
                                                                    <option value="ORANG LAIN ">ORANG LAIN </option>
                                                                    <option value="ORANGTUA">ORANGTUA</option>
                                                                    <option value="PEMBANTU RUMAH TANGGA">PEMBANTU RUMAH TANGGA</option>
                                                                    <option value="SUAMI">SUAMI</option>
                                                                    <option value="TETANGGA">TETANGGA</option>
                                                                </select>

                                                            </div>
                                                            <div class="col-6 mb-3">
                                                                <label for="username">Preperence Channel</label>

                                                                <select class="form-control" readonly name="PREFERENCE_CARING_METHOD" id="PREFERENCE_CARING_METHOD">
                                                                    <option value=""></option>
                                                                    <option value="Call">Call</option>
                                                                    <option value="Email">Email</option>
                                                                    <option value="SMS">SMS</option>
                                                                    <option value="Chat">Chat</option>
                                                                </select>

                                                            </div>
                                                            <div class="col-6 mb-3">
                                                                <label for="username">Preperence Channel GSM</label>

                                                                <input type="text" readonly class="form-control">

                                                            </div>
                                                            <div class="col-6 mb-3">
                                                                <label for="username">Preperence Channel Email</label>

                                                                <input type="text" readonly class="form-control">

                                                            </div>

                                                            <div class="col-6 mb-3">
                                                                <label for="username">Catatan</label>

                                                                <input type="text" readonly class="form-control">

                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card mt-3">
                                        <div class="card-header">
                                            <h4 class="card-title">Multi Kontak</h4>
                                        </div>
                                        <div class="card-content">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-12">

                                                        <div class="form-row">
                                                            <div class="col-6 mb-3">
                                                                <label for="username">Line</label>

                                                                <input type="text" readonly class="form-control">

                                                            </div>
                                                            <div class="col-6 mb-3">
                                                                <label for="username">Telegram</label>

                                                                <input type="text" readonly class="form-control">

                                                            </div>
                                                            <div class="col-6 mb-3">
                                                                <label for="username">Whatsapp</label>

                                                                <input type="text" readonly class="form-control">

                                                            </div>
                                                            <div class="col-6 mb-3">
                                                                <label for="username">Facebook</label>

                                                                <input type="text" readonly class="form-control">

                                                            </div>
                                                            <div class="col-6 mb-3">
                                                                <label for="username">Path</label>

                                                                <input type="text" readonly class="form-control">

                                                            </div>
                                                            <div class="col-6 mb-3">
                                                                <label for="username">Twitter</label>

                                                                <input type="text" readonly class="form-control">

                                                            </div>
                                                            <div class="col-6 mb-3">
                                                                <label for="username">Phone Mobile</label>

                                                                <input type="text" readonly class="form-control">

                                                            </div>
                                                            <div class="col-6 mb-3">
                                                                <label for="username">Phone Work</label>

                                                                <input type="text" readonly class="form-control">

                                                            </div>
                                                            <div class="col-6 mb-3">
                                                                <label for="username">Phone Home</label>

                                                                <input type="text" readonly class="form-control">

                                                            </div>
                                                            <div class="col-6 mb-3">
                                                                <label for="username">Fax</label>

                                                                <input type="text" readonly class="form-control">

                                                            </div>
                                                            <div class="col-6 mb-3">
                                                                <label for="username">Other Phone</label>

                                                                <input type="text" readonly class="form-control">

                                                            </div>
                                                            <div class="col-6 mb-3">
                                                                <label for="username">Fax</label>

                                                                <input type="text" readonly class="form-control">

                                                            </div>
                                                            <div class="col-6 mb-3">
                                                                <label for="username">Main Email</label>

                                                                <input type="text" readonly class="form-control">

                                                            </div>
                                                            <div class="col-6 mb-3">
                                                                <label for="username">Other Email 1</label>

                                                                <input type="text" readonly class="form-control">
                                                            </div>
                                                            <div class="col-6 mb-3">
                                                                <label for="username">Other Email 2</label>
                                                                <input type="text" readonly class="form-control">

                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="col-4">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Customer Info</h4>
                                </div>
                                <div class="card-content">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="form-row">
                                                    <div class="col-12 mb-3">
                                                        <label for="username">TransID</label>
                                                        <input type="text" readonly value="<?php echo $datana->TRANS_ID; ?>" class='form-control'>

                                                    </div>
                                                    <div class="col-12 mb-3">
                                                        <label for="username">CID</label>
                                                        <input type="text" readonly value="<?php echo $datana->CID; ?>" class='form-control'>

                                                    </div>
                                                    <div class="col-12 mb-3">
                                                        <label for="username">Tanggal Order</label>
                                                        <input type="text" readonly value="<?php echo $datana->TGL_ORDER; ?>" class="form-control">
                                                    </div>
                                                    <div class="col-12 mb-3">
                                                        <label for="username">Nama</label>
                                                        <input type="text" readonly value="<?php echo $datana->NAMA_MASTER; ?>" class="form-control">
                                                    </div>
                                                    <div class="col-12 mb-3">
                                                        <label for="username">Alamat</label>
                                                        <textarea readonly style="height:100px;" class="form-control"><?php echo $datana->ALAMAT_MASTER; ?></textarea>
                                                    </div>
                                                    <div class="col-12 mb-3">
                                                        <label for="username">Email</label>
                                                        <input type="text" readonly value="<?php echo $datana->EMAIL; ?>" class="form-control">
                                                    </div>
                                                    <div class="col-12 mb-3">
                                                        <label for="username">Total Tagihan</label>
                                                        <input type="text" readonly value="<?php echo $datana->TOT_BAYAR; ?>" class="form-control">
                                                    </div>
                                                    <div class="col-12 mb-3">
                                                        <label for="username">CS Area</label>
                                                        <input type="text" readonly value="<?php echo $datana->CSAREA; ?>" class="form-control">
                                                    </div>
                                                    <div class="col-12 mb-3">
                                                        <label for="username">Status Call</label>
                                                        <input type="text" readonly value="<?php echo $datana->STATUS_CALL; ?>" class="form-control">
                                                    </div>
                                                    <div class="col-12 mb-3">
                                                        <label for="username">Telp 1</label>
                                                        <input type="text" readonly value="<?php echo $datana->TELP1; ?>" class="form-control">
                                                    </div>
                                                    <div class="col-12 mb-3">
                                                        <label for="username">Telp 2</label>
                                                        <input type="text" readonly value="<?php echo $datana->TELP2; ?>" class="form-control">
                                                    </div>
                                                    <div class="col-12 mb-3">
                                                        <label for="username">Telp 3</label>
                                                        <input type="text" readonly value="<?php echo $datana->TELP3; ?>" class="form-control">
                                                    </div>
                                                    <div class="col-12 mb-3">
                                                        <label for="username">Telp 4</label>
                                                        <input type="text" readonly value="<?php echo $datana->TELP3; ?>" class="form-control">
                                                    </div>
                                                    <div class="col-12 mb-3">
                                                        <label for="username">Telp 5</label>
                                                        <input type="text" readonly value="<?php echo $datana->TELP3; ?>" class="form-control">
                                                    </div>
                                                    <div class="col-12 mb-3">
                                                        <label for="username">Best WD</label>
                                                        <input type="text" readonly value="<?php echo $datana->BEST_WD; ?>" class="form-control">
                                                    </div>
                                                    <div class="col-12 mb-3">
                                                        <label for="username">Best WE</label>
                                                        <input type="text" readonly value="<?php echo $datana->BEST_WE; ?>" class="form-control">
                                                    </div>
                                                    <div class="col-12 mb-3">
                                                        <label for="username">Is Profer</label>
                                                        <input type="text" readonly value="<?php echo $datana->IS_PROPER_NCLI; ?>" class="form-control">
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
                <div class="col-3">
                    <div class="alert alert-primary" id="box_kosong" style="display:none;" role="alert">
                        Data Dalam Proses Call.
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body d-md-flex text-center">
                                    <ul class="d-md-flex m-0 pl-0 list-unstyled">
                                        <li class="pill cl-personal py-1 px-2 mr-md-2 text-center my-1" id="status_highlight">
                                            <!-- Loading -->
                                        </li>
                                    </ul>
                                    <button class="btn btn-outline-danger font-w-600 my-auto text-nowrap ml-auto add-event" id='text_status' onclick="change_status();"><i class="icon-close"></i> OFFLINE</button>

                                    <input type="hidden" id='status_ready' value='<?php echo $status_ready; ?>'>
                                    <input type="hidden" id="statusmna" value="0">
                                    <input type="hidden" id="status_register">
                                    <input type="hidden" id="status_call_agent" value="Ready">
                                    <input type="hidden" id="dial_num" value="0">
                                    <input type="hidden" id="number_dial" value="0">
                                </div>
                            </div>
                        </div>
                        <div class="col-12" id="call_control" style="display:none;">
                            <div class="card mt-3">
                                <div class="card-header">
                                    <h4 class="card-title">Call Control</h4>
                                </div>
                                <div class="card-content">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-12">
                                                <form>

                                                    <div class="form-row" id="aux_control">
                                                        <div class="col-12 mb-3">
                                                            <select class="form-control" id="drp_aux" onchange="Aux()">
                                                                <option value="0">Ready</option>
                                                                <option value="1" id="drp_aux_1">1 Konsultasi</option>
                                                                <option value="2" id="drp_aux_2">2 Supporting</option>
                                                                <option value="3" id="drp_aux_3">3 CatHSTR</option>
                                                                <option value="4" id="drp_aux_4">4 Toilet</option>
                                                                <option value="5" id="drp_aux_5">5 Air Minum</option>
                                                                <option value="6" id="drp_aux_6">6 Sholat</option>
                                                                <option value="7" id="drp_aux_7">7 Lunch</option>
                                                                <option value="8" id="drp_aux_8">8 Briefing</option>
                                                                <option value="9" id="drp_aux_9">9 Update System</option>
                                                            </select>
                                                        </div>

                                                    </div>
                                                    <div class="col-12 mizu_custom_control">
                                                        <div id="divMizuvoipControl">
                                                            <div id="divMizuvoipControlBody" style="background-color: rgba(0, 0, 0, 0);">
                                                                <div class="row py-1">
                                                                    <div class="input-group w-100"><input type="text" class="form-control" placeholder="Destination number" id="destnumber" autocapitalize="off">

                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- <div class="form-row">
                                                        <div class="col-12 mb-3 ">
                                                            <div class="pill cl-personal py-1 px-2 mr-md-2 text-center my-1 text-bold">
                                                                <i class="ion ion-clock"></i> <span id="duration_status"></span>
                                                            </div>
                                                        </div>
                                                    </div> -->
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="card mt-3">
                                <div class="card-header">
                                    <h4 class="card-title">EBS</h4>
                                </div>
                                <div class="card-content">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="form-row">
                                                    <div class="col-12 mb-3">
                                                        <label for="username">Periode</label>
                                                        <input type="text" id="periode_ebs" value="<?php echo DATE('m-Y'); ?>" class="form-control" placeholder="Periode">
                                                    </div>
                                                    <div class="col-12 mb-3">
                                                        <label for="username">ND</label>
                                                        <input type="text" id="nd_ebs" readonly class="form-control" placeholder="ND">
                                                    </div>
                                                    <div class="col-12 mb-3">
                                                        <label for="username">EMAIL</label>
                                                        <input type="text" id="email_ebs" class="form-control" placeholder="EMAIL">
                                                    </div>
                                                    <div class="col-12 mb-3">
                                                        <label for="username">EMAIL CC</label>
                                                        <input type="text" id="email_cc_ebs" class="form-control" placeholder="EMAIL CC">
                                                    </div>
                                                    <div class="col-12 mb-3">
                                                        <label for="username">Group ID</label>
                                                        <input type="text" id="group_id_ebs" readonly class="form-control" placeholder="Group ID">
                                                    </div>
                                                    <div class="col-12 mb-3">
                                                        <select class="form-control" id="type_ebs">
                                                            <option value="1">EBS INDIHOME</option>
                                                            <option value="2">EBS NON INDIHOME</option>
                                                            <option value="3">EBS NON POTS</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-12 mb-3" id="button_get_data">
                                                        <button class="btn btn-primary btn-block" onclick="get_data_ebs();">Get Data EBS</button>
                                                    </div>
                                                    <div class="col-6 mb-3" id="button_preview_ebs" style="display:none;">
                                                        <a class="btn btn-primary btn-block" id="link_button_preview" href='<?php echo base_url() . "Ebs/Ebs/preview/" . $row_detail['group_id'] . '/' . DATE('Ym'); ?>' target="_blank">Preview</a>
                                                    </div>
                                                    <div class="col-6 mb-3" id="button_kirim_ebs" style="display:none;">
                                                        <button onclick='send_email();' class="btn btn-primary btn-block" id="button_send" type="button">Send Email</button>
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

    <!---- END page datatable--->


    <!----MIZU MODUL--->
    <!-- END: Custom CSS-->
    <script src="<?php echo base_url(); ?>assets/mizu/js/webphone_api.js?jscodeversion=510"></script>
    <script src="<?php echo base_url(); ?>assets/mizu/js/custom_webphone.js"></script>
    <script src="<?php echo base_url(); ?>assets/mizu/js/dynamicticket.js"></script>
    <!-- START: Page Vendor JS-->
    <script src="<?php echo base_url(); ?>assets/new_theme/dist/vendors/sweetalert/sweetalert.min.js"></script>
    <!-- END: Page Vendor JS-->

    <script type="text/javascript">
        var loopGetticket = 0;

        function submitData(formData) {

            $.ajax({
                url: '<?php echo base_url(); ?>Mizu/Mizu/submitData',
                data: formData,
                type: "POST",
                // async: false,
                dataType: 'json',
                success: function(response) {

                    swal({
                        title: "Data Berhasil Disimpan",
                        text: "",
                        type: "success",
                        showCancelButton: false,
                        cancelButtonClass: 'btn-danger',
                        confirmButtonClass: 'btn-success',
                        confirmButtonText: 'Close!'
                    });
                    if (aux_flag == false) {
                        getTicket()

                        $("#on_call_block").empty();
                    }
                }
            });
        }

        function getTicket() {
            // if (delayedCallNumber === null) {

            // delayedCallNumber = null;
            status_ready = $("#status_ready").val();
            if (status_ready == "1") {
                let formData = {
                    agent_status: ""
                };
                $.ajax({
                    url: "<?php echo base_url(); ?>Mizu/Mizu/get_ticket",
                    data: formData,
                    type: "POST",
                    dataType: "json",
                    success: function(data) {
                        //kalau campaign_id sama dengan previous, maka langsung call, kalau tidak sama atau prev nya null, maka harus login
                        if (data.status == 'ada') {
                            console.log('CALL' + data.calling_pty);
                            id_tiket = data.id;
                            $("#destnumber").val(data.calling_pty);
                            $("#box_kosong").hide();

                            displayData(id_tiket)
                        } else {
                            console.log('DATA KOSONG');
                            $("#box_kosong").show();

                            setTimeout(function() {
                                getTicket();
                            }, 1000);
                        }

                    },
                    error: function(data) {
                        console.log('ERR get_ticket');
                        console.log(data);
                    }
                });
                loopGetticket = 0;
            }

            // }

        }

        function displayData(id) {
            if (id) {

                let formData = {
                    id: id,
                };
                $.ajax({
                    type: 'POST',
                    url: '<?php echo base_url(); ?>Mizu/Mizu/get_formna',
                    data: formData,
                    dataType: 'html',
                    success: function(response) {

                        $("#on_call_block").html(response);

                    },
                    error: function(response) {
                        console.log('ERR Display Data');
                    }
                });
                $("#oncall_tab").click();

            }


        }

        function get_data_ebs() {
            var nd = $("#nd_pelanggan").val();
            var type_ebs = $("#type_ebs").val();
            if (nd) {

                let formData = {
                    nd: nd,
                    type_ebs: type_ebs,
                };
                var url = '<?php echo base_url(); ?>Ebs/Ebs/get_data_ajax';
                switch (type_ebs) {
                    case "1":
                        var url = '<?php echo base_url(); ?>Ebs/Ebs/get_data_ajax';
                        break;
                    case "2":
                        var url = '<?php echo base_url(); ?>Ebs_non_indihome/Ebs_non_indihome/get_data';
                        break;
                    case "3":
                        var url = '<?php echo base_url(); ?>Ebs_non_pots/Ebs_non_pots/get_data';
                        break;
                }
                $.ajax({
                    type: 'POST',
                    url: url,
                    data: formData,
                    dataType: 'json',
                    success: function(response) {

                        if (response.data.email) {
                            $("#email_ebs").val(response.data.email);
                            $("#nd_ebs").val(response.data.no_internet);
                            $("#group_id_ebs").val(response.data.group_id);

                            $("#link_button_preview").attr("href", "<?php echo base_url() . "Ebs/Ebs/preview/"; ?>" + response.data.group_id + "<?php echo  '/' . DATE('Ym'); ?>");
                            $("#button_preview_ebs").show();
                            $("#button_kirim_ebs").show();
                        }


                    },
                    error: function(response) {
                        console.log('ERR Display Data');
                    }
                });

            }


        }

        function send_email() {
            var str = $("#periode_ebs").val();
            var res = str.split("-");
            var periode = res[1] + res[0];
            var email = $("#email_ebs").val();
            var emailcc = $("#email_cc_ebs").val();
            var group_id = $("#group_id_ebs").val();
            var type_ebs = $("#type_ebs").val();
            var url = '<?php echo base_url(); ?>Ebs/Ebs/';
            switch (type_ebs) {
                case "1":
                    var url = '<?php echo base_url(); ?>Ebs/Ebs/';
                    break;
                case "2":
                    var url = '<?php echo base_url(); ?>Ebs_non_indihome/Ebs_non_indihome/';
                    break;
                case "3":
                    var url = '<?php echo base_url(); ?>Ebs_non_pots/Ebs_non_pots/';
                    break;
            }
            var url = url + 'send_email?group_id=' + group_id + '&periode=' + periode + '&email=' + email + '&emailcc=' + emailcc;
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

        function change_status() {
            var status_ready = $("#status_ready").val();
            if (status_ready == 1) {
                let logoutConfirmBool = confirm("Logout ?");
                if (logoutConfirmBool) {
                    // Stop();
                    updateAgentStatus('Offline', '');
                    $("#on_call_block").empty();
                    $("#call_control").hide();
                    $("#status_ready").val(0);
                    $("#text_status").html('<i class="icon-close" ></i> OFFLINE');
                    $("#text_status").attr('class', 'btn btn-outline-danger font-w-600 my-auto text-nowrap ml-auto add-event');
                    document.getElementById('box_kosong').style.display = 'none';
                }
            } else {
                getTicket();
                updateAgentStatus('Ready', '', 0);
                $("#drp_aux").val(0);
                $("#call_control").show();
                $("#status_ready").val(1);
                $("#text_status").html('<i class="icon-check" ></i> ONLINE');
                $("#text_status").attr('class', 'btn btn-outline-success font-w-600 my-auto text-nowrap ml-auto add-event');
                document.getElementById('box_kosong').style.display = 'block';
            }

        }
        $(document).ready(function() {
            var status_ready = $("#status_ready").val();

            if (status_ready == 1) {
                getTicket();
                console.log("Init Mizu");
                $("#call_control").show();
                $("#status_ready").val(1);
                $("#text_status").html('<i class="icon-check" ></i> ONLINE');
                $("#text_status").attr('class', 'btn btn-outline-success font-w-600 my-auto text-nowrap ml-auto add-event');
                updateAgentStatus('Ready', '');
            }
            <?php

            if (isset($data_aux)) {

            ?>
                console.log('<?php echo $data_aux->id; ?>');
                $("#call_control").show();
                $("#status_ready").val(0);
                $("#text_status").html('<i class="icon-close" ></i> AUX');
                $("#text_status").attr('class', 'btn btn-outline-success font-w-600 my-auto text-nowrap ml-auto add-event');
                aux_flag = true;

                // document.getElementById('mizu_control').style.display = 'none';

                $("#drp_aux").val('<?php echo $data_aux->id; ?>');
                // console.log('<?php echo $data_aux->id; ?>');
                loopFlag = true;

                updateAgentStatus('<?php echo $data_aux->aux_val; ?>', '', <?php echo $data_aux->id; ?>);
            <?php
            }
            ?>
        });
    </script>
</body>
<!-- END: Body-->

</html>