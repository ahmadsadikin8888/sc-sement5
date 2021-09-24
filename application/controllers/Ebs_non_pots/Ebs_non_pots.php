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
class Ebs_non_pots extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();
    $this->load->model('sys/Sys_user_log_model', 'log_login');
    $this->load->model('Custom_model/Sys_user_table_model', 'Sys_user_table_model');
  }
  public function index()
  {
    $idlogin = $this->session->userdata('idlogin');
    $logindata = $this->log_login->get_by_id($idlogin);
    $data['userdata'] = $this->Sys_user_table_model->get_row(array("id" => $logindata->id_user));
    $view = 'Ebs_non_pots/dashboard';
    $post = $this->input->get();
    if ($post['no_internet']) {
      $data['row_data'] = $this->get_data($post['no_internet']);
      $data['row_data'] = $data['row_data']['data'];
    }

    $this->load->view($view, $data);
  }
  public function detail($no_inet)
  {
    $idlogin = $this->session->userdata('idlogin');
    $logindata = $this->log_login->get_by_id($idlogin);
    $data['userdata'] = $this->Sys_user_table_model->get_row(array("id" => $logindata->id_user));
    $view = 'Ebs_non_pots/detail';

    $data['row_data'] = $this->get_data($no_inet);
    $data['row_data'] = $data['row_data']['data'];

    $data['row_detail'] = $this->get_detail($data['row_data']['group_id'], $data['row_data']['ncli']);
    $data['row_detail'] = $data['row_detail']['result'][0];

    $this->load->view($view, $data);
  }
  public function get_data($no = null)
  {
    //$no = '131184160013';
    $url = "http://10.60.175.132/ideas_new/app/data/grid/ebs_indihome_new.php?action=search&telp=$no";
    $curlHandle = curl_init();
    // init curl
    curl_setopt($curlHandle, CURLOPT_URL, $url); // set the url to fetch
    curl_setopt($curlHandle, CURLOPT_HEADER, 0);
    curl_setopt($curlHandle, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($curlHandle, CURLOPT_TIMEOUT, 30);
    curl_setopt($curlHandle, CURLOPT_POST, 0);
    $content = curl_exec($curlHandle);
    curl_close($curlHandle);
    //return $content;
    $rest = json_decode($content, true);
    return $rest;
  }
  public function get_detail($group_id, $ncli)
  {
    //$no = '131184160013';
    $url = "http://10.60.175.132/ideas_new/app/data/json/detail_ebs_info_indihome.php?group_id=$group_id&ncli=$ncli";
    $curlHandle = curl_init();
    // init curl
    curl_setopt($curlHandle, CURLOPT_URL, $url); // set the url to fetch
    curl_setopt($curlHandle, CURLOPT_HEADER, 0);
    curl_setopt($curlHandle, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($curlHandle, CURLOPT_TIMEOUT, 30);
    curl_setopt($curlHandle, CURLOPT_POST, 0);
    $content = curl_exec($curlHandle);
    curl_close($curlHandle);
    //return $content;
    $rest = json_decode($content, true);
    return $rest;
  }
  public function preview($group_id, $periode)
  {
    //$no = '131184160013';
    $url = "http://10.60.175.132/dev_bill/app/prev_indihome.php?group_id=$group_id&nper=$periode";
    $curlHandle = curl_init();
    // init curl
    curl_setopt($curlHandle, CURLOPT_URL, $url); // set the url to fetch
    curl_setopt($curlHandle, CURLOPT_HEADER, 0);
    curl_setopt($curlHandle, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($curlHandle, CURLOPT_TIMEOUT, 30);
    curl_setopt($curlHandle, CURLOPT_POST, 0);
    $content = curl_exec($curlHandle);
    curl_close($curlHandle);
    //return $content;
    $rest = json_decode($content, true);

    if ($rest['response'] == 'success') {
      redirect('http://10.60.175.132/dev_bill/preview/indihome_' . $group_id . $periode . '.pdf', 'refresh');
    }
  }
  public function send_email()
  {
    $post = $this->input->get();
    $group_id = $post['group_id'];
    $nper = $post['periode'];
    $email = $post['email'];
    $emailcc = $post['emailcc'];
    $url = "http://10.60.175.132/dev_bill/app/manual_indihome.php?group_id=$group_id&nper=$nper&email=$email&emailcc=$emailcc&upd=rial";
    $curlHandle = curl_init();
    // init curl
    curl_setopt($curlHandle, CURLOPT_URL, $url); // set the url to fetch
    curl_setopt($curlHandle, CURLOPT_HEADER, 0);
    curl_setopt($curlHandle, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($curlHandle, CURLOPT_TIMEOUT, 30);
    curl_setopt($curlHandle, CURLOPT_POST, 0);
    $content = curl_exec($curlHandle);
    curl_close($curlHandle);
    //return $content;
    $rest = json_decode($content, true);
    // echo "Message has been sent";
    echo $rest['response'];
  }
}
