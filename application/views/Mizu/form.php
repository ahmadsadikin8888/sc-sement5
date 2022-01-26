<script type="text/javascript">
    function kendala() {
        var val_kategori = $("#KATEGORI").val();
        $(".kategori_list").hide();
        $("." + val_kategori).show();

    }

    function status_call() {
        var val_kategori = $("#STATUS_CALL_").val();
        $(".reason_sc").hide();
        $(".status_call_" + val_kategori).show();
    }
</script>
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
                                            <select name="FLAG_JANJI_BAYAR" id="FLAG_JANJI_BAYAR" class="form-control">
                                                <option value=""></option>
                                                <option value="JANJI MAU BAYAR">JANJI MAU BAYAR</option>
                                                <option value="BELUM BISA BAYAR">BELUM BISA BAYAR</option>
                                            </select>

                                        </div>
                                        <div class="col-6 mb-3">
                                            <label for="email">Tgl Janji Bayar</label>
                                            <input type="date" name="TGL_JANJI_BAYAR" id="TGL_JANJI_BAYAR" class="form-control">
                                        </div>

                                        <div class="col-12 mb-3">
                                            <label for="username"><b>Alasan Belum Bayar</b></label>

                                        </div>
                                        <div class="col-6 mb-3">
                                            <label for="email">kategori</label>
                                            <select class="form-control" name="KATEGORI" id="KATEGORI" onchange="kendala();">
                                                <option value=""></option>
                                                <option value="ADMINISTRATIF">ADMINISTRATIF</option>
                                                <option value="PAYMENT">PAYMENT</option>
                                                <option value="SERVICE ">SERVICE </option>
                                                <option value="TECHNICAL ">TECHNICAL </option>
                                            </select>
                                        </div>

                                        <div class="col-6 mb-3">
                                            <label for="username">Kendala</label>
                                            <select class="form-control" name="KENDALA" id="KENDALA">
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

                                            <input type="text" name="KETERANGAN" id="KETERANGAN" class="form-control">

                                        </div>
                                        <div class="col-12">

                                            <button type="button" id="button_untuk_submit_<?php echo $datana->TRANS_ID; ?>" class="btn btn-primary btn-block">Submit</button>

                                        </div>
                                        <!-- <div class="col-4">
                                            <button type="button" class="btn btn-danger btn-block" onclick='back_home();'>Back</button>
                                        </div> -->
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

                                            <input type="text" id="NO_KONTAK" name="NO_KONTAK" value="<?php echo $datana->NO_KONTAK; ?>" class="form-control">

                                        </div>
                                        <div class="col-6 mb-3">
                                            <label for="email">ND</label>
                                            <input type="text" id="nd_pelanggan" value="<?php echo $detail->ND; ?>" class="form-control">
                                        </div>
                                        <!-- <div class="col-6 mb-3">
                                            <label for="email">Type Kontak</label> -->
                                        <input type="hidden" name="TIPE_KONTAK" id="TIPE_KONTAK" value="<?php echo $datana->TIPE_KONTAK; ?>" class="form-control">
                                        <!-- </div> -->

                                        <div class="col-6 mb-3">
                                            <label for="username">Status Call</label>

                                            <select id="STATUS_CALL_" class="form-control" name="STATUS_CALL_" onchange="status_call();">
                                                <option value="1" selected>CONTACTED</option>
                                                <option value="2">NOT CONTACTED</option>
                                            </select>

                                        </div>
                                        <div class="col-6 mb-3">
                                            <label for="email">Reason Status</label>
                                            <select class="form-control" name="REASON_CALL" id="REASON_CALL">
                                                <option value=""></option>
                                                <option class="status_call_1 reason_sc" value="SIBUK">SIBUK</option>
                                                <option class="status_call_1 reason_sc" value="SETUJU">SETUJU</option>
                                                <option class="status_call_1 reason_sc" value="SUDAH LUNAS">SUDAH LUNAS</option>
                                                <option class="status_call_1 reason_sc" value="CALL REJECTED">CALL REJECTED</option>
                                                <option class="status_call_1 reason_sc" value="SALAH SAMBUNG">SALAH SAMBUNG</option>
                                                <option class="status_call_1 reason_sc" value="SALAH E-MAIL">SALAH E-MAIL</option>
                                                <option class="status_call_1 reason_sc" value="TIDAK MAU DI CALL">TIDAK MAU DI CALL</option>
                                                <option class="status_call_1 reason_sc" value="CAPS">CAPS</option>
                                                <option class="status_call_2 reason_sc" value="MAILBOX-MEMO">MAILBOX-MEMO</option>
                                                <option class="status_call_2 reason_sc" value="FAX-MODEM">FAX-MODEM</option>
                                                <option class="status_call_2 reason_sc" value="NADA SIBUK">NADA SIBUK</option>
                                                <option class="status_call_2 reason_sc" value="NO LINE IS FREE">NO LINE IS FREE</option>

                                            </select>
                                        </div>

                                        <div class="col-6 mb-3">
                                            <label for="username">Status Detail</label>

                                            <input type="text" class="form-control">

                                        </div>
                                        <div class="col-6 mb-3">
                                            <label for="username">Status Multikontak</label>

                                            <input type="text" class="form-control">

                                        </div>
                                        <div class="col-6 mb-3">
                                            <label for="username">Nama Penerima</label>

                                            <input type="text" name="PENERIMA" id="PENERIMA" value="" class="form-control">
                                            <input type="hidden" name="TRANS_ID" id="TRANS_ID" value="<?php echo $datana->TRANS_ID; ?>" class="form-control">

                                        </div>
                                        <div class="col-6 mb-3">
                                            <label for="username">Hubungan</label>

                                            <select class="form-control" name="HUB_PENERIMA" id="HUB_PENERIMA">
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

                                            <select class="form-control" name="PREFERENCE_CARING_METHOD" id="PREFERENCE_CARING_METHOD">
                                                <option value=""></option>
                                                <option value="Call">Call</option>
                                                <option value="Email">Email</option>
                                                <option value="SMS">SMS</option>
                                                <option value="Chat">Chat</option>
                                            </select>

                                        </div>
                                        <div class="col-6 mb-3">
                                            <label for="username">Preperence Channel GSM</label>

                                            <input type="text" class="form-control">

                                        </div>
                                        <div class="col-6 mb-3">
                                            <label for="username">Preperence Channel Email</label>

                                            <input type="text" class="form-control">

                                        </div>
                                        <!-- <div class="col-6 mb-3">
                                            <label for="username">TS19</label>
                                            <select class="form-control" name="TSI9" id="TSI9">
                                                <option value=""></option>
                                                <option value="YA">YA</option>
                                                <option value="TIDAK">TIDAK</option>
                                            </select>
                                        </div> -->
                                        <!-- <div class="col-6 mb-3">
                                            <label for="username">Reason TS19</label>

                                            <select class="form-control" name="REASON_TSI9" id="REASON_TSI9">
                                                <option value=""></option>
                                                <option value="AGREE">AGREE</option>
                                                <option value="BEDA PEMBAYAR">BEDA PEMBAYAR</option>
                                                <option value="SAAT BAYAR, JUMLAH TERLALU BESAR">SAAT BAYAR, JUMLAH TERLALU BESAR</option>
                                                <option value="SAAT PASANG TIDAK DI INFOKAN HARUS SINGLE BILL">SAAT PASANG TIDAK DI INFOKAN HARUS SINGLE BILL</option>
                                                <option value="HANYA MERASA PASANG INTERNET SAJA">HANYA MERASA PASANG INTERNET SAJA</option>
                                                <option value="BUKAN PENGAMBIL KEPUTUSAN ">BUKAN PENGAMBIL KEPUTUSAN </option>
                                            </select>

                                        </div> -->
                                        <div class="col-6 mb-3">
                                            <label for="username">Catatan</label>

                                            <input type="text" class="form-control">

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

                                            <input type="text" class="form-control">

                                        </div>
                                        <div class="col-6 mb-3">
                                            <label for="username">Telegram</label>

                                            <input type="text" class="form-control">

                                        </div>
                                        <div class="col-6 mb-3">
                                            <label for="username">Whatsapp</label>

                                            <input type="text" class="form-control">

                                        </div>
                                        <div class="col-6 mb-3">
                                            <label for="username">Facebook</label>

                                            <input type="text" class="form-control">

                                        </div>
                                        <div class="col-6 mb-3">
                                            <label for="username">Path</label>

                                            <input type="text" class="form-control">

                                        </div>
                                        <div class="col-6 mb-3">
                                            <label for="username">Twitter</label>

                                            <input type="text" class="form-control">

                                        </div>
                                        <div class="col-6 mb-3">
                                            <label for="username">Phone Mobile</label>

                                            <input type="text" class="form-control">

                                        </div>
                                        <div class="col-6 mb-3">
                                            <label for="username">Phone Work</label>

                                            <input type="text" class="form-control">

                                        </div>
                                        <div class="col-6 mb-3">
                                            <label for="username">Phone Home</label>

                                            <input type="text" class="form-control">

                                        </div>
                                        <div class="col-6 mb-3">
                                            <label for="username">Fax</label>

                                            <input type="text" class="form-control">

                                        </div>
                                        <div class="col-6 mb-3">
                                            <label for="username">Other Phone</label>

                                            <input type="text" class="form-control">

                                        </div>
                                        <div class="col-6 mb-3">
                                            <label for="username">Fax</label>

                                            <input type="text" class="form-control">

                                        </div>
                                        <div class="col-6 mb-3">
                                            <label for="username">Main Email</label>

                                            <input type="text" class="form-control">

                                        </div>
                                        <div class="col-6 mb-3">
                                            <label for="username">Other Email 1</label>

                                            <input type="text" class="form-control">
                                        </div>
                                        <div class="col-6 mb-3">
                                            <label for="username">Other Email 2</label>
                                            <input type="text" class="form-control">

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
                                <!-- <div class="col-12 mb-3">
                                    <label for="username">Action Plan</label>
                                    <input type="text" readonly value="<?php echo $datana->IS_PROPER_NCLI; ?>" class="form-control">
                                </div> -->

                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



<script type="text/javascript">
    $(document).ready(function() {
        document.getElementById("button_untuk_submit_<?php echo $datana->TRANS_ID; ?>").addEventListener("click", function(e) {
            e.preventDefault(); // before the code
            var datana = $('#form_untuk_submit_<?php echo $datana->TRANS_ID; ?>').serialize();
            // updateStatus(4, assignedData[pointIndex].unique_key, assignedData[pointIndex].categorie_id)
            submitData(datana);
            return false;
        });

    });
</script>