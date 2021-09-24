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
                                            <select class="form-control" name="KATEGORI" id="KATEGORI">
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
                                                <option value="Batal Pasang Baru">Batal Pasang Baru</option>
                                                <option value="Klaim Data Pelanggan">Klaim Data Pelanggan</option>
                                                <option value="Minta Down/Up Grade Paket ">Minta Down/Up Grade Paket </option>
                                                <option value="Telepon Beda Pemilik">Telepon Beda Pemilik </option>
                                                <option value="Tidak Merasa Pasang baru">Tidak Merasa Pasang baru</option>
                                                <option value="Bundling Belum Aktif">Bundling Belum Aktif</option>
                                                <option value="Sudah Minta Cabut Tagihan Masih Ada">Sudah Minta Cabut Tagihan Masih Ada</option>
                                                <option value="PSB belum aktif">PSB belum aktif</option>
                                                <option value="EBS tidak sampai">EBS tidak sampai</option>
                                                <option value="Registrasi EBS">Registrasi EBS</option>
                                                <option value="UnReg EBS">UnReg EBS</option>
                                                <option value="Registrasi TSI">Registrasi TSI</option>
                                                <option value="UnReg TSI">UnReg TSI</option>
                                                <option value="Belum Ada Uang Untuk Bayar">Belum Ada Uang Untuk Bayar</option>
                                                <option value="Klaim Tagihan">Klaim Tagihan</option>
                                                <option value="Lupa Bayar">Lupa Bayar</option>
                                                <option value="Minta Dijemput Pembayaran">Minta Dijemput Pembayaran</option>
                                                <option value="Pembayaran Minta Diangsur">Pembayaran Minta Diangsur</option>
                                                <option value="Sering Keluar Kota">Sering Keluar Kota</option>
                                                <option value="Tagihan Tidak Sesuai Janji/Promo">Tagihan Tidak Sesuai Janji/Promo</option>
                                                <option value="Tempat Bayar Tidak ada/Jauh">Tempat Bayar Tidak ada/Jauh</option>
                                                <option value="Tidak Bisa Dibayar Di Loket/ATM">Tidak Bisa Dibayar Di Loket/ATM</option>
                                                <option value="Tidak Sempat Melakukan Pembayaran">Tidak Sempat Melakukan Pembayaran</option>
                                                <option value="Tidak Tahu Tagihan">Tidak Tahu Tagihan</option>
                                                <option value="Buka Isolir (BUKIS)">Buka Isolir (BUKIS)</option>
                                                <option value="Tagihan melonjak">Tagihan melonjak</option>
                                                <option value="Tagihan Tidak Muncul">Tagihan Tidak Muncul</option>
                                                <option value="Tagihan Gimmick Tidak Sesuai">Tagihan Gimmick Tidak Sesuai</option>
                                                <option value="Tidak bisa bayar tagihan jastel">Tidak bisa bayar tagihan jastel</option>
                                                <option value="Game Online Putus-putus">Game Online Putus-putus</option>
                                                <option value="IP Kena Blok">IP Kena Blok</option>
                                                <option value="Intermitten/Putus-Putus">Intermitten/Putus-Putus</option>
                                                <option value="Koneksi Bagus Download Lambat">Koneksi Bagus Download Lambat</option>
                                                <option value="Lambat">Lambat</option>
                                                <option value="Sharing PC Tidak Jalan">Sharing PC Tidak Jalan</option>
                                                <option value="Tidak Bisa Browsing">Tidak Bisa Browsing</option>
                                                <option value="Tidak Bisa Connect">Tidak Bisa Connect</option>
                                                <option value="Tidak Bisa Email">Tidak Bisa Email</option>
                                                <option value="Tidak Bisa Game Online">Tidak Bisa Game Online</option>
                                                <option value="Tidak Bisa Ke Website Tertentu">Tidak Bisa Ke Website Tertentu</option>
                                                <option value="Gangguan Fitur">Gangguan Fitur</option>
                                                <option value="Ganggguan Hunting">Ganggguan Hunting</option>
                                                <option value="Tidak Bisa Memanggil">Tidak Bisa Memanggil</option>
                                                <option value="Tidak Bisa Dipanggil">Tidak Bisa Dipanggil</option>
                                                <option value="Tidak Bisa Menghubungi/Dihubungi Nomor Tertentu">Tidak Bisa Menghubungi/Dihubungi Nomor Tertentu</option>
                                                <option value="Tidak Bisa SLI">Tidak Bisa SLI</option>
                                                <option value="Tidak Bisa SLJJ">Tidak Bisa SLJJ</option>
                                                <option value="Tidak Bisa Faximile">Tidak Bisa Faximile</option>
                                                <option value="Gangguan Layanan EDC">Gangguan Layanan EDC</option>
                                                <option value="Gannguan layanan VPN Dial">Gannguan layanan VPN Dial</option>
                                                <option value="Gangguan Japati">Gangguan Japati</option>
                                                <option value="Instalasi Belum selesai">Instalasi Belum selesai</option>
                                                <option value="Perangkat Pelanggan Belum Lengkap">Perangkat Pelanggan Belum Lengkap</option>
                                                <option value="Petugas Belum Datang">Petugas Belum Datang</option>
                                                <option value="Internet Belum Aktif">Internet Belum Aktif</option>
                                                <option value="Cross Talk/Induksi">Cross Talk/Induksi</option>
                                                <option value="PTSN Salah Sambung">PTSN Salah Sambung</option>
                                                <option value="Suara Lemah, robot, dengung dan kemrosok">Suara Lemah, robot, dengung dan kemrosok</option>
                                                <option value="Suara putus-putus beberapa menit">Suara putus-putus beberapa menit</option>
                                                <option value="Suara lawan bicara tidak terdengar">Suara lawan bicara tidak terdengar</option>
                                                <option value="Telepon mati/Tidak ada nada">Telepon mati/Tidak ada nada</option>
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
                                        <div class="col-6 mb-3">
                                            <label for="email">Type Kontak</label>
                                            <input type="text" name="TIPE_KONTAK" id="TIPE_KONTAK" value="<?php echo $datana->TIPE_KONTAK; ?>" class="form-control">
                                        </div>

                                        <div class="col-6 mb-3">
                                            <label for="username">Status Call</label>

                                            <select id="STATUS_CALL_" class="form-control" name="STATUS_CALL_">
                                                <option value=""></option>
                                                <option value="1">CONTACTED</option>
                                                <option value="2">NOT CONTACTED</option>
                                            </select>

                                        </div>
                                        <div class="col-6 mb-3">
                                            <label for="email">Reason Status</label>
                                            <select class="form-control" name="REASON_CALL" id="REASON_CALL">
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

                                            <input type="text" class="form-control">

                                        </div>
                                        <div class="col-6 mb-3">
                                            <label for="username">Status Multikontak</label>

                                            <input type="text" class="form-control">

                                        </div>
                                        <div class="col-6 mb-3">
                                            <label for="username">Nama Penerima</label>

                                            <input type="text" name="PENERIMA" id="PENERIMA" value="<?php echo $datana->NAMA_MASTER; ?>" class="form-control">
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
                                        <div class="col-6 mb-3">
                                            <label for="username">TS19</label>
                                            <select class="form-control" name="TSI9" id="TSI9">
                                                <option value=""></option>
                                                <option value="YA">YA</option>
                                                <option value="TIDAK">TIDAK</option>
                                            </select>
                                        </div>
                                        <div class="col-6 mb-3">
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

                                        </div>
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
                                    <label for="username">Tanggal Order</label>
                                    <input type="text" readonly value="<?php echo $datana->TGL_ORDER; ?>" class="form-control">
                                </div>
                                <div class="col-12 mb-3">
                                    <label for="username">Nama</label>
                                    <input type="text" readonly value="<?php echo $datana->NAMA_MASTER; ?>" class="form-control">
                                </div>
                                <div class="col-12 mb-3">
                                    <label for="username">Alamat</label>
                                    <input type="text" readonly value="<?php echo $datana->ALAMAT_MASTER; ?>" class="form-control">
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