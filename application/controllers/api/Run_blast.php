<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Run_blast extends CI_Controller
{

    public function __construct()
    {
        // Construct the parent class
        parent::__construct();
        $this->load->model('Custom_model/Pelanggan_model', 'pelanggan');
        $this->load->model('Custom_model/Payment_model', 'payment');
        $this->load->model('Custom_model/Profiling_model', 'profiling');
        $this->load->model('Custom_model/Blast_model', 'blast');
        // $this->load->database();
    }
    public function blast_infotag()
    {
        $whitelist_hp = array(
            '081221609591',
            // '081384311543',
            // '08112207004',
            // '082226333733'
        );

        $whitelist_email = array(
            'ahmadsadikin8888@gmail.com',
            '9nd.priatna@gmail.com',
            'benny.ipb45@gmail.com'
        );

        $periode = date('n-Y');
        $pelanggan = $this->pelanggan->get_results();
        $n = 0;

        if ($pelanggan['num'] > 0) {
            foreach ($pelanggan['results'] as $p) {
                $cek = $this->blast->get_count(array("id_pelanggan" => $p->id, "periode" => $periode));
                $status = 'Gagal';
                if ($cek == 0) {
                    switch ($p->channel) {
                        case 3:
                            if ($p->email) {
                                if (in_array($p->email, $whitelist_email)) {
                                    $status = $this->blast_email($p->id, $p->email, "Infotag");
                                }
                            }
                            break;
                        case 4:
                            if ($p->no_hp) {
                                if (in_array($p->no_hp, $whitelist_hp)) {
                                    $status = $this->blast_wa($p->id, $p->no_hp, $p->nama, "Infotag");
                                }
                            }
                            break;
                        case 5:
                            if ($p->no_hp) {
                                if (in_array($p->no_hp, $whitelist_hp)) {
                                    $status = $this->blast_sms($p->id, $p->no_hp, $p->nama, "Infotag");
                                }
                            }
                            break;
                    }
                    $data_blast = array(
                        "id_pelanggan" => $p->id,
                        "channel" => $p->id,
                        "status" => $status,
                        "datetime" => date("Y-m-d h:i:s"),
                        "campaign" => 1,
                        "billing" => $p->billing,
                        "periode" => $periode,
                    );
                    $this->blast->add($data_blast);
                    $n++;
                }
            }
        }
        echo $n;
    }
    function blast_email($id = false, $email = false, $message = "", $image = "")
    {
        // $uri_image=base_url().'images/campaign_image/'.$image;
        // $uri_image = base_url() . 'images/campaign_image/' . $image;
        // $message = '<img src="' . $uri_image . '" alt="" >' . $message;
        $message = $message;
        $return = 'Gagal';
        if ($id) {
            $curl = curl_init();
            $url = "http://10.194.194.251/digital_media_profiling/index.php/api/send/email";
            $arr = array(
                // "email" => 'ahmadsadikin8888@gmail.com',
                "email" => $email,
                "subject" => "Digital Sales",
                "message" => $message
            );
            $data = http_build_query($arr);

            curl_setopt_array($curl, array(
                CURLOPT_URL => $url,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "POST",
                CURLOPT_POSTFIELDS => $data,
                CURLOPT_HTTPHEADER => array(
                    "Content-Type: application/x-www-form-urlencoded"
                ),
            ));

            $response = curl_exec($curl);
            $response = json_decode($response);

            if (isset($response->sts)) {
                $return = $response->message;
            }
        }
        return $return;
    }
    function blast_wa($id = false, $number = false, $nama, $link)
    {
        $return = 'Gagal';
        if ($id) {
            $curl = curl_init();
            $url = "http://10.194.194.251/digital_media_profiling/index.php/api/send/whatsapp";
            $arr = array(
                "number" => $this->hp($number),
                // "number" => '081221609591',
                "template" => "billco_7",
                "param1" => $nama,
                "param2" => $link
            );
            $data = http_build_query($arr);

            curl_setopt_array($curl, array(
                CURLOPT_URL => $url,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "POST",
                CURLOPT_POSTFIELDS => $data,
                CURLOPT_HTTPHEADER => array(
                    "Content-Type: application/x-www-form-urlencoded"
                ),
            ));

            $response = curl_exec($curl);
            $response = json_decode($response);

            if (isset($response->sts)) {
                $return = $response->sts_msg;
                echo $response->sts_msg;
            }
        }
        return $return;
    }
    // public function blast_sms($id = false, $number = false, $nama, $link)
    public function blast_sms($id = false, $number = false, $nama = "", $link = "Mari Berlangganan Minipack")
    {
        $msisdn = $this->hp($number);
        $characters = array("0", "1", "2", "3", "4", "5", "6", "7", "8", "9");
        $keys = array();
        $random_num = "";
        while (count($keys) < 4) {
            $x = mt_rand(0, count($characters) - 1);
            if (!in_array($x, $keys)) {
                $keys[] = $x;
            }
        }
        foreach ($keys as $key) {
            $random_num .= $characters[$key];
        }
        $msg_id = $msisdn . date('YmdHis');
        $hash = sha1('INFOMEDIA#sms_telkom#' . $msg_id . '#INDIHOME#NUSANTARA');
        // $hash=sha1('INFOMEDIA#'.$msg_id.'#NUSANTARA');
        // $msg="Kode verifikasi data Anda adalah ".$random_num." silakan infokan kepada petugas  kami yang sedang menghubungi Bpk/Ibu. Tks";
        $msg = "$link";

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://10.194.176.72/SMS.Telkom/SMS147_OTP/sendSMS",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => "username=sms_telkom&password=infomedia&sender=INDIHOME&request_by=tlkm&recipient=" . $msisdn . "&msg_id=" . $msg_id . "&hash=" . $hash . "&message=" . $msg,
            CURLOPT_HTTPHEADER => array(
                "cache-control: no-cache",
                "content-type: application/x-www-form-urlencoded",
                "postman-token: 7be6d429-43ee-cd2c-61dc-3d36c10f72dc"
            ),
        ));

        $response = curl_exec($curl);
        $response = json_decode($response);

        $err = curl_error($curl);

        curl_close($curl);



        if ($response->success == true) {
            $datana = $response->data->result;
            return $datana;
            // echo $datana->result;
        }
    }
    function hp($nohp)
    {
        // kadang ada penulisan no hp 0811 239 345
        $nohp = str_replace(" ", "", $nohp);
        // kadang ada penulisan no hp (0274) 778787
        $nohp = str_replace("(", "", $nohp);
        // kadang ada penulisan no hp (0274) 778787
        $nohp = str_replace(")", "", $nohp);
        // kadang ada penulisan no hp 0811.239.345
        $nohp = str_replace(".", "", $nohp);

        // cek apakah no hp mengandung karakter + dan 0-9
        if (!preg_match('/[^+0-9]/', trim($nohp))) {
            // cek apakah no hp karakter 1-3 adalah +62
            if (substr(trim($nohp), 0, 3) == '+62') {
                $hp = trim($nohp);
            }
            // cek apakah no hp karakter 1 adalah 0
            elseif (substr(trim($nohp), 0, 1) == '0') {
                $hp = '62' . substr(trim($nohp), 1);
            }
        }
        return $hp;
    }
}
