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
class Mizu extends CI_Controller
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
    $this->load->model('Custom_model/Dapros_model', 'dapros');
    $this->load->model('Custom_model/Trans_model', 'trans');
    $this->load->model('Custom_model/Trans_detail_model', 'trans_detail');
  }
  public function index()
  {
    $idlogin = $this->session->userdata('idlogin');
    $logindata = $this->log_login->get_by_id($idlogin);
    $data['userdata'] = $this->Sys_user_table_model->get_row(array("id" => $logindata->id_user));
    $view = 'Mizu/dialpage_syanida';
    $data['status_agent'] = $this->dapros->live_query("select * FROM agent_status WHERE userid='$logindata->id_user'")->row();

    $status_agent = $data['status_agent'];
    $data_aux = $this->dapros->live_query("SELECT * FROM aux WHERE aux_val='$status_agent->agent_status'")->row();
    if ($data_aux) {
      $data['data_aux'] = $this->dapros->live_query("SELECT * FROM aux WHERE id='$data_aux->id'")->row();
    }

    $this->load->view($view, $data);
  }
  public function get_phonenumber()
  {
    $data = $this->failover->live_query("SELECT * FROM dapros_obc WHERE status=0 LIMIT 1")->row();
    if ($data) {
      echo $data->number_hp;
      $this->failover->live_query("UPDATE dapros_obc SET status=1 WHERE id='" . $data->id . "'");
    } else {
      echo 0;
    }
  }
  public function get_ticket()
  {
    $data = $this->failover->live_query("SELECT * FROM trans WHERE DETAIL_STATUS='NEW POP UP' LIMIT 1")->row();
    $response['no_hp'] = "";
    $response['status'] = "kosong";
    if ($data) {
      $response['no_hp'] = '61' . $data->NO_KONTAK;
      // $response['no_hp'] = '61081221609591';
      $response['status'] = "ada";
      $this->failover->live_query("UPDATE trans SET DETAIL_STATUS='0' WHERE TRANS_ID='" . $data->TRANS_ID . "'");
      $response['calling_pty'] = $response['no_hp'];
      // $response['calling_pty'] = '61081221609591';
    }
    $response['pbx_campaign_id'] = rand();
    $response['limit'] = 1;
    $response['categorie_id'] = 1;
    $response['id'] = $data->TRANS_ID;
    $response['unique_key'] = rand();

    echo json_encode($response);
  }
  public function getext()
  {
    $idlogin = $this->session->userdata('idlogin');
    $logindata = $this->log_login->get_by_id($idlogin);
    $data['userdata'] = $this->Sys_user_table_model->get_row(array("id" => $logindata->id_user));
    $user_id = $logindata->id_user;
    $q = "select * FROM maping_eyebeam WHERE user_id = $user_id";
    $datana = $this->dapros->live_query($q)->row();
    $res = array();
    $response = array(
      "serveraddress" => $datana->server,
      "username" => $datana->username,
      "password" => $datana->password,
      "id" => $datana->id,
    );
    if ($response) {
      echo json_encode($response);
    }
  }
  public function updstat() //TODO setup update RNA dll
  {
    $post = $this->input->post();
    $idlogin = $this->session->userdata('idlogin');
    $logindata = $this->log_login->get_by_id($idlogin);
    $user_id = $logindata->id_user;
    $agent_status = $post['agent_status'];
    $status_duration = $post['status_duration'];
    $connected_number = $post['connected_number'];
    $aux_id = $post['aux_id'];
    $date = DATE('Y-m-d');
    $date_time = DATE('Y-m-d H:i:s');
    $status_ready = 0;
    $status_aux = 0;
    $aux = 0;
    if ($agent_status == "Ready" || $agent_status == "Call Disconnected") {
      $status_ready = 1;
    }
    if ($aux_id != 0) {
      $status_aux = 1;
      $aux = $aux_id;
    }
    $cek = $this->dapros->live_query("select count(*) as numna FROM realtime_status WHERE userid = '$user_id' AND agent_status='$agent_status' AND DATE(last_update) = '$date' ")->row()->numna;
    $cek_agent = $this->dapros->live_query("select count(*) as numna FROM agent_status WHERE userid = '$user_id' ")->row()->numna;
    if ($cek == 0) {
      $this->dapros->live_query("INSERT INTO realtime_status (userid,agent_status,status_duration,connected_number,last_update)VALUES('$user_id','$agent_status',$status_duration,'$connected_number','$date')");
    } else {
      $rowna = $this->dapros->live_query("select status_duration FROM realtime_status WHERE userid = '$user_id' AND agent_status='$agent_status' AND DATE(last_update) = '$date' ")->row()->status_duration;
      $status_duration_cek = intval($rowna) + intval($status_duration);
      $this->dapros->live_query("UPDATE realtime_status SET agent_status = '$agent_status',status_duration= $status_duration_cek,connected_number='$connected_number' WHERE userid='$user_id' AND agent_status='$agent_status' AND DATE(last_update) = '$date'");
    }
    if ($cek_agent == 0) {
      $this->dapros->live_query("INSERT INTO agent_status (userid,agent_status,status_duration,last_update,status_ready,status_aux,aux)VALUES('$user_id','$agent_status',$status_duration,'$date',$status_ready,$status_aux,'$aux')");
    } else {
      $this->dapros->live_query("UPDATE agent_status SET agent_status = '$agent_status',status_duration= $status_duration,last_update='$date_time',status_ready=$status_ready,status_aux=$status_aux,aux='$aux' WHERE userid='$user_id'");
    }
    echo 1;
  }
  public function aux() //TODO setup update RNA dll
  {
    $post = $this->input->post();
    $aux_val = $post['aux_val'];
    $campaign_id = $post['campaign_id'];
    $key_val = $post['key_val'];
    $idlogin = $this->session->userdata('idlogin');
    $logindata = $this->log_login->get_by_id($idlogin);
    $user_id = $logindata->id_user;

    $this->dapros->live_query("INSERT INTO aux_status (aux_val,campaign_id,key_val)VALUES('$aux_val','$campaign_id','$key_val')");
  }
  public function get_formna()
  {
    $post = $this->input->post();
    $id = $post['id'];
    $data['datana'] = $this->dapros->live_query("SELECT * FROM trans WHERE TRANS_ID='$id' ")->row();
    $data['detail'] = $this->dapros->live_query("SELECT * FROM trans_detail WHERE TRANS_ID='$id' ")->row();
    $view = "Mizu/form";

    return $this->load->view($view, $data);
  }
  public function submitData()
  {
    $idlogin = $this->session->userdata('idlogin');
    $logindata = $this->log_login->get_by_id($idlogin);
    $userdata = $this->Sys_user_table_model->get_row(array("id" => $logindata->id_user));
    $post = $this->input->post();
    $where = array(
      "TRANS_ID" => $post['TRANS_ID']
    );
    $data_trans = array(
      "NO_KONTAK" => $post['NO_KONTAK'],
      "TIPE_KONTAK" => $post['TIPE_KONTAK'],
      "STATUS_CALL" => $post['STATUS_CALL_'],
      "REASON_CALL" => $post['REASON_CALL'],
      "PENERIMA" => $post['PENERIMA'],
      "HUB_PENERIMA" => $post['HUB_PENERIMA'],
      "PREFERENCE_CARING_METHOD" => $post['PREFERENCE_CARING_METHOD'],
      "REASON_TSI9" => $post['REASON_TSI9'],
      "TSI9" => $post['TSI9'],
      "UPD_BY" => $userdata->agentid,
      "IS_SUBMIT" => 1,
      "UPD_DISTRIBUTED" => "MIZU",
      "LUP" => date('Y-m-d H:i:s'),
    );
    $data_trans_detail = array(
      "UPD_BY" => $userdata->agentid,
      "LUP" => date('Y-m-d H:i:s'),
    );
    $data_update = $this->trans->edit($where, $data_trans);
    $this->trans_detail->edit($where, $data_trans_detail);
    $response = array(
      "TRANS_ID" => $post['TRANS_ID']
    );
    echo json_encode($response);
  }
}
