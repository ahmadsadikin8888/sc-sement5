<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Form_General
 *
 * @author Dhiya
 */
class Dc extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();
    $this->load->model('sys/Sys_user_log_model', 'log_login');
    $this->load->model('Custom_model/Sys_user_table_model', 'Sys_user_table_model');
    // $this->load->model('Custom_model/Dapros_infomedia_model', 'distribution');
    $this->load->model('Custom_model/Data_lead_model', 'data_lead');
    $this->load->model('Custom_model/Failover_model', 'failover');
    $this->load->model('Custom_model/Campaign_model', 'campaign');
  }
  public function index()
  {
    $idlogin = $this->session->userdata('idlogin');
    $logindata = $this->log_login->get_by_id($idlogin);
    $data['userdata'] = $this->Sys_user_table_model->get_row(array("id" => $logindata->id_user));
    $view = 'Dc/dashboard';
    $this->load->view($view, $data);
  }
  public function server_lead(){
    
  }
  public function fo()
  {
    $idlogin = $this->session->userdata('idlogin');
    $logindata = $this->log_login->get_by_id($idlogin);
    $data['userdata'] = $this->Sys_user_table_model->get_row(array("id" => $logindata->id_user));
    $data['failover'] = $this->failover->get_results();
    $view = 'Dc/fo';

    $this->load->view($view, $data);
  }
  public function fo_update($id = false)
  {
    if ($id) {
      $idlogin = $this->session->userdata('idlogin');
      $logindata = $this->log_login->get_by_id($idlogin);
      $data['userdata'] = $this->Sys_user_table_model->get_row(array("id" => $logindata->id_user));

      $view = 'Dc/fo_update';
      $data['return'] = false;
      if (isset($_POST['urutan'])) {
        $data_insert = array(
          "urutan" => $_POST['urutan'],
          "next" => $_POST['next']
        );
        $input = $this->failover->update($id, $data_insert);
        if ($input) {
          $data['return'] = "Failover Berhasil di Update.";
        }
      }
      $data['failover'] = $this->failover->get_row(array("id" => $id));
      $this->load->view($view, $data);
    }
  }

  public function engine()
  {
    $idlogin = $this->session->userdata('idlogin');
    $logindata = $this->log_login->get_by_id($idlogin);
    $data['userdata'] = $this->Sys_user_table_model->get_row(array("id" => $logindata->id_user));
    $view = 'Dc/engine';

    if (isset($_POST['engine'])) {
      switch ($_POST['engine']) {
        case "email":
          $data['return_blast'] = $this->blast_email($_POST['receiver']);
          break;
        case "sms":
          $data['return_blast'] = $this->blast_sms($_POST['receiver']);
          if (!$data['return_blast']) {
            $data['return_blast'] = 'Sms Gagal Terkirim.';
          }
          break;
        case "wa":
          $data['return_blast'] = $this->blast_wa($_POST['receiver']);
          break;
      }
    } else {
      $data['return_blast'] = false;
    }
    $this->load->view($view, $data);
  }
  function dalalead()
  {
    $idlogin = $this->session->userdata('idlogin');
    $logindata = $this->log_login->get_by_id($idlogin);
    $data['userdata'] = $this->Sys_user_table_model->get_row(array("id" => $logindata->id_user));
    $view = 'Dc/datalead';


    $filter = array();
    $channel_table = array(
      "sms" => array("table" => "dunning_smstag", "where" => array()),
      "wa" => array("table" => "dunning_wa", "where" => array()),
      "email" => array("table" => "dunning_email", "where" => array()),
      "ovr" => array("table" => "dunning_ovr", "where" => array()),
      "tvms" => array("table" => "potensi_rt", "where" => array()),
      "obc" => array("table" => "ideas_api_header", "where" => array()),
    );
    $sms = $this->data_lead->live_query("SELECT SUBSTRING(TGL_INPUT,-2) as dayna,count(*) as numna FROM dunning_smstag GROUP BY SUBSTRING(TGL_INPUT,-2)")->result();
    if (count($sms) > 0) {
      foreach ($sms as $dt) {
        $str = ltrim($dt->dayna, '0');
        $data['detail']['sms'][$str] = $dt->numna;
        $data['sms']['total'] = $data['sms']['total'] + $dt->numna;
        $data['days'][$str] = $data['days'][$str] + $dt->numna;
      }
    }
    $wa = $this->data_lead->live_query("SELECT DAY(DATE_START) as dayna,count(*) as numna FROM dunning_wa GROUP BY DAY(DATE_START)")->result();
    if (count($wa) > 0) {
      foreach ($wa as $dt) {
        $str = ltrim($dt->dayna, '0');
        $data['detail']['wa'][$str] = $dt->numna;
        $data['wa']['total'] = $data['wa']['total'] + $dt->numna;
        $data['days'][$str] = $data['days'][$str] + $dt->numna;
      }
    }
    $obc = $this->data_lead->live_query("SELECT DAY(TIME_EXECUTION) as dayna,count(*) as numna FROM ideas_api_header GROUP BY DAY(TIME_EXECUTION)")->result();
    if (count($obc) > 0) {
      foreach ($obc as $dt) {
        $str = ltrim($dt->dayna, '0');
        $data['detail']['obc'][$str] = $dt->numna;
        $data['obc']['total'] = $data['obc']['total'] + $dt->numna;
        $data['days'][$str] = $data['days'][$str] + $dt->numna;
      }
    }
    $data['data_lead'] = $data['sms']['total'] + $data['wa']['total'] + $data['obc']['total'];
    $this->load->view($view, $data);
  }
  function dalalead_sc()
  {
    $idlogin = $this->session->userdata('idlogin');
    $logindata = $this->log_login->get_by_id($idlogin);
    $data['userdata'] = $this->Sys_user_table_model->get_row(array("id" => $logindata->id_user));
    $view = 'Dc/datalead';


    $filter = array();
    $filter["(ISNULL(update_by) OR update_by = 'baru' OR update_by = 'BARU' OR update_by = '' )"] = null;
    $filter['status'] = 0;
    // $filter['status2'] = 0;
    // $filter['status3'] = 0;

    $data['all'] = $this->data_lead->get_count($filter);

    $filter_wa = $filter;
    $filter_wa["channel"] = 'WA';
    $data['wa'] = $this->data_lead->get_count($filter_wa);

    $filter_email = $filter;
    $filter_email["channel"] = 'EMAIL';
    $data['email'] = $this->data_lead->get_count($filter_email);

    $filter_sms = $filter;
    $filter_sms["channel"] = 'SMS';
    $data['sms'] = $this->data_lead->get_count($filter_sms);

    $filter_other = $filter;
    $filter_other["channel NOT IN ('WA','EMAIL','SMS')"] = NULL;
    $data['other'] = $this->data_lead->get_count($filter_other);


    $query_regional = "
      SELECT channel,day,count(*) as numna
      FROM data_lead
       WHERE
      (ISNULL(update_by) OR update_by = 'baru' OR update_by = 'BARU' OR update_by = '' )
      AND 
      (ISNULL(duplicate_ncli) OR duplicate_ncli = 0 OR duplicate_ncli = '' )
      AND status = 0 
      GROUP BY channel,day
    ";
    $data_regional = $this->data_lead->live_query($query_regional)->result();
    $data['data_regional'] = array();
    $data['rating_sumber'] = array();
    if (count($data_regional) > 0) {
      foreach ($data_regional as $row) {
        $data['data_regional']['detail'][$row->day][$row->channel] = $data['data_regional']['detail'][$row->day][$row->channel] + $row->numna;
        $data['data_regional'][$row->day] = $data['data_regional'][$row->day] + $row->numna;
        if ($row->channel != "WA" || $row->channel != "EMAIL" || $row->channel != "SMS") {
          $data['data_regional'][$row->channel] = $data['data_regional'][$row->channel] + $row->numna;
        } else {
          $data['data_regional']['others'] = $data['data_regional']['others'] + $row->numna;
        }

        $data['data_regional']['total'] = $row->numna + $data['data_regional']['total'];
      }
    }
    $this->load->view($view, $data);
  }
  public function campaign()
  {
    $idlogin = $this->session->userdata('idlogin');
    $logindata = $this->log_login->get_by_id($idlogin);
    $data['userdata'] = $this->Sys_user_table_model->get_row(array("id" => $logindata->id_user));
    $data['campaign'] = $this->campaign->get_results();
    $view = 'Dc/campaign';

    $this->load->view($view, $data);
  }
  public function campaign_add()
  {
    $idlogin = $this->session->userdata('idlogin');
    $logindata = $this->log_login->get_by_id($idlogin);
    $data['userdata'] = $this->Sys_user_table_model->get_row(array("id" => $logindata->id_user));

    $view = 'Dc/campaign_add';
    $data['return'] = false;
    if (isset($_POST['title'])) {
      $data_insert = array(
        "status" => $_POST['status'],
        "title" => $_POST['title'],
        "date_online" => $_POST['date_online'],
        "template_sms" => $_POST['template_sms'],
        "tempalte_wa" => $_POST['tempalte_wa'],
        "template_email" => $_POST['template_email']
      );
      $input = $this->campaign->add($data_insert);
      if ($input) {
        $data['return'] = "Blast Management Berhasil di Tambahkan.";
      }
    }

    $this->load->view($view, $data);
  }
  public function campaign_update($id = false)
  {
    if ($id) {
      $idlogin = $this->session->userdata('idlogin');
      $logindata = $this->log_login->get_by_id($idlogin);
      $data['userdata'] = $this->Sys_user_table_model->get_row(array("id" => $logindata->id_user));

      $view = 'Dc/campaign_update';
      $data['return'] = false;
      if (isset($_POST['title'])) {
        $data_insert = array(
          "status" => $_POST['status'],
          "title" => $_POST['title'],
          "date_online" => $_POST['date_online'],
          "template_sms" => $_POST['template_sms'],
          "tempalte_wa" => $_POST['tempalte_wa'],
          "template_email" => $_POST['template_email']
        );
        $input = $this->campaign->update($id, $data_insert);
        if ($input) {
          $data['return'] = "Blast Management Berhasil di Update.";
        }
      }
      $data['campaign'] = $this->campaign->get_row(array("id" => $id));
      $this->load->view($view, $data);
    }
  }
  public function campaign_start($id = false, $status = 'Draf')
  {
    if ($id) {
      $idlogin = $this->session->userdata('idlogin');
      $logindata = $this->log_login->get_by_id($idlogin);
      $data['userdata'] = $this->Sys_user_table_model->get_row(array("id" => $logindata->id_user));

      $data['landing_page'] = $this->landing_page->get_results();
      $view = 'Dc/campaign_update';
      $data['return'] = false;

      $data_insert = array(
        "status" => $status,
        "date_online" => date('Y-m-d')
      );
      $input = $this->campaign->update($id, $data_insert);
      if ($input) {
        $data['return'] = "Blast Management Berhasil di Update.";
      }
      $campaign = $this->campaign->get_row(array("id" => $id));
      redirect(site_url() . 'Dc/Dc/campaign?success_create_lead=1&info=Blast Management ' . $campaign->title . ' Berhasil ' . $status . '.!');
    }
  }
  public function campaign_datalead($id)
  {
    $idlogin = $this->session->userdata('idlogin');
    $logindata = $this->log_login->get_by_id($idlogin);
    $data['userdata'] = $this->Sys_user_table_model->get_row(array("id" => $logindata->id_user));


    $view = 'Dc/campaign_lead';
    $data['return'] = false;
    $data['create_lead'] = false;
    if (isset($_POST['sumber'])) {
      $filter = array();
      $filter["(ISNULL(update_by) OR update_by = 'baru' OR update_by = 'BARU' OR update_by = '' )"] = null;
      // $filter["(ISNULL(duplicate_ncli) OR duplicate_ncli = 0 OR duplicate_ncli = '' )"] = null;
      $filter['status'] = 0;
      // $filter['status2'] = 0;
      // $filter['status3'] = 0;
      if ($_POST['sumber'] != 'All') {
        $filter['sumber'] = $_POST['sumber'];
      }

      $data['all'] = $this->data_lead->get_count($filter);

      $filter_wa = $filter;
      $filter_wa["channel"] = 'WA';
      $data['wa'] = $this->data_lead->get_count($filter_wa);

      $filter_email = $filter;
      $filter_email["channel"] = 'EMAIL';
      $data['email'] = $this->data_lead->get_count($filter_email);

      $filter_sms = $filter;
      $filter_sms["channel"] = 'SMS';
      $data['sms'] = $this->data_lead->get_count($filter_sms);

      $filter_other = $filter;
      $filter_other["channel NOT IN ('WA','EMAIL','SMS')"] = NULL;
      $data['other'] = $this->data_lead->get_count($filter_other);


      $data['create_lead'] = "?sumber=" . $_POST['sumber'] . "&campaign=" . $id;
    }
    $data['campaign'] = $this->campaign->get_row(array("campaign.id" => $id));
    $data['data_sumber'] = $this->data_lead->live_query("SELECT sumber,count(*) as numna FROM data_lead WHERE (ISNULL(update_by) OR update_by = 'baru' OR update_by = 'BARU' OR update_by = '' ) AND status = 0 GROUP BY sumber")->result();

    // $data['data_sumber'] = $this->sumber->live_query("SELECT sumber FROM sumber GROUP BY sumber_parent")->result();
    $this->load->view($view, $data);
  }
  public function campaign_dashboard($id)
  {
    $idlogin = $this->session->userdata('idlogin');
    $logindata = $this->log_login->get_by_id($idlogin);
    $data['userdata'] = $this->Sys_user_table_model->get_row(array("id" => $logindata->id_user));
    $data['campaign'] = $this->campaign->get_row(array("id" => $id));

    $data['raw'] = $this->data_lead->get_results(array("update_by" => 'DC-' . $id));
    $data['order'] = $this->data_lead->get_count(array("update_by" => 'DC-' . $id));
    $data['progress_order'] = $this->data_lead->get_count(array("update_by" => 'DC-' . $id, "status NOT IN (0,60,70,80)" => NULL));
    $data['percent_order'] = ($data['progress_order'] / $data['order']) * 100;
    $data['wa'] = $this->data_lead->get_count(array("update_by" => 'DC-' . $id, "status IN (60,61,62,63) " => NULl));
    $data['progress_wa'] = $this->data_lead->get_count(array("update_by" => 'DC-' . $id, "status IN (61,62,63)" => NULL));
    $data['percent_wa'] = ($data['progress_wa'] / $data['wa']) * 100;
    $data['sms'] = $this->data_lead->get_count(array("update_by" => 'DC-' . $id, "status IN (70,71,72,73)" => NULl));
    $data['progress_sms'] = $this->data_lead->get_count(array("update_by" => 'DC-' . $id, "status IN (71,72,73)" => NULL));
    $data['percent_sms'] = ($data['progress_sms'] / $data['sms']) * 100;
    $data['email'] = $this->data_lead->get_count(array("update_by" => 'DC-' . $id, "status IN (80,81,82,83)" => NULL));
    $data['progress_email'] = $this->data_lead->get_count(array("update_by" => 'DC-' . $id, "status IN (81,82,83)" => NULL));
    $data['percent_email'] = ($data['progress_email'] / $data['email']) * 100;
    $view = 'Dc/campaign_dashboard';
    $this->load->view($view, $data);
  }
  public function proses_campaign_lead()
  {
    if (isset($_GET['sumber'])) {
      $campaign = $this->campaign->get_row(array('id' => $_GET['campaign']));
      $filter = array();
      $filter["(ISNULL(update_by) OR update_by = 'baru' OR update_by = 'BARU' OR update_by = '' )"] = null;
      $filter["(ISNULL(duplicate_ncli) OR duplicate_ncli = 0 OR duplicate_ncli = '' )"] = null;
      $filter['status'] = 0;
      if ($_GET['sumber'] != 'All') {
        $filter['sumber'] = $_GET['sumber'];
      }
      $update_field = array(
        'update_by' => 'DC-' . $_GET['campaign']
      );
      $data['hp_email'] = $this->data_lead->edit($filter, $update_field);
      $jumlah_data = $this->data_lead->get_count($update_field);
      $this->campaign->update($_GET['campaign'], array('data_lead' => $jumlah_data, 'data_lead_code' => 'DC-' . $_GET['campaign']));
    }

    redirect(site_url() . 'Dc/Dc/campaign?success_create_lead=1&info=Data Lead Untuk Blast Management ' . $campaign->title . ' Berhasil Dibuat.!');
  }
  //userdefined function for checking internet
  function check_internet($domain)
  {
    $file = @fsockopen($domain, 80); //@fsockopen is used to connect to a socket
    if ($file) {
      echo "You are connected to the internet.";
    } else {
      echo "You seem to be offline. Please check your internet connection.";
    }
  }
  function blast_email($email = false)
  {
    // $uri_image=base_url().'images/campaign_image/'.$image;
    $message = 'Email Digital Channel';
    $return = 'Gagal';
    $curl = curl_init();
    $url = "http://10.194.194.251/digital_media_profiling/index.php/api/send/email";
    $arr = array(
      // "email" => 'ahmadsadikin8888@gmail.com',
      "email" => $email,
      "subject" => "Digital Channel",
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

    return $return;
  }
  function blast_wa($number = false)
  {
    $number = $this->hp($number);
    $return = 'Gagal';
    $curl = curl_init();
    $url = "https://webhook.infomedia.co.id/whatsapp/sendHSM";
    $data = '{
      "account_id": "628118800147",
      "to": "' . $number . '",
      "element_name": "147_caps_contact",
      "data": [
          {
              "1": "Test WA Digital Channel"
          }
      ]
  }';

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
        'Content-Type: application/json',
        'Partner_Token: d9dd329ce2d1d4047275c1251aa6c1eb18adcc9c43395af6ae776dddbd21a0b493fb728d61107438c0ea052b45507195'
      ),
    ));

    $response = curl_exec($curl);
    $response = json_decode($response);

    if (isset($response->sts)) {
      $return = $response->sts_msg;
      echo $response->sts_msg;
    }
    return $return;
  }
  // public function blast_sms($id = false, $number = false, $nama, $link)
  public function blast_sms($number = false)
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
    $msg = "Mau tetap update nonton film-film unggulan sekaligus dapat kecepatan internet yang makin cepat? Bisa! Berlangganan Minipack Channel TV dan Upgrade Speed dengan kecepatan 20 Mbps bisa Sobat dapatkan hanya dengan Rp45.000 per bulan! 
    Tunggu apa lagi? Yuk, Klik : https://bit.ly/3xjPiZV";

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
