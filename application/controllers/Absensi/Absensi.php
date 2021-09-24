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
class Absensi extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();
    // $this->load->model('Custom_model/Cache_data_model', 'cache_data');
    $this->load->model('Absensi/Absensi_model', 't_absensi');
    $this->load->model('Custom_model/Tahun_model', 'tahun');
    //  $this->load->model('Custom_model/Trans_profiling_verifikasi_infomedia_model', 'trans_profiling_verifikasi');
    $this->load->model('Custom_model/Trans_profiling_daily_model', 'trans_profiling_daily');
    $this->load->model('Custom_model/Sys_user_table_model', 'Sys_user_table_model');
    $this->load->model('sys/Sys_user_log_model', 'log_login');
    //$this->load->library('curl');
  }

  public function Absensi()
  {



    //curlstart
    //$today = date('d/m/y');
    //$today = '01/03/2020';  


    $start = date('d/m/y', strtotime($_GET['start']));


    $post = array(
      'dtstart' => $start,
      'status' => 0
    );

    $postout = array(
      'dtstart' => $start,
      'status' => 1
    );


    //$a = 1;
    $n = 0;
    $today = date('Y-m-d');
    if (isset($_GET['start'])) {
      $start = $_GET['start'];
      //    $end = $_GET['end'];
    } else {
      $start = date('Y-m-d');
      //   $start = date('Y-m-d');
    }


    $this->absensi_dashboard();
  }

  public function Absensi_dashboard()
  {

    $view = 'front-end/landing-page/dashboard_v2/Absensi';
    $data['title_page_big']     =   '';
    $idlogin = $this->session->userdata('idlogin');
    $logindata = $this->log_login->get_by_id($idlogin);
    $data['userdata'] = $this->Sys_user_table_model->get_row(array("id" => $logindata->id_user));


    // $data['tllia'] = $this->Sys_user_table_model->get_row(array("agentid" => "TLLIA"));
    //  $data['tlita'] = $this->Sys_user_table_model->get_row(array("agentid" => "AR180293"));
    //  $data['tlateu'] = $this->Sys_user_table_model->get_row(array("agentid" => "TLATEU"));

    if (isset($_GET['start'])) {
      $start = $_GET['start'];
      //$end = $_GET['end'];
    } else {
      $start = date('Y-m-d');
      //  $end = date('Y-m-d');
    }
    $data['hitung'] = $this->t_absensi->live_query("SELECT sys_user.nama, sys_user.kategori, sys_user.opt_level, t_absensi.waktu_in, t_absensi.stts
    FROM sys_user
    LEFT JOIN t_absensi
    ON sys_user.nik_absensi = t_absensi.nik
    where  sys_user.opt_level=8 
    AND t_absensi.methode = 1
    AND (date(t_absensi.waktu_in) = '$start' OR date(t_absensi.waktu_in) IS NULL)
    AND STR_TO_DATE(time(t_absensi.waktu_in), '%H:%i:%s') < '08:00:00'
    AND (t_absensi.stts = 'in' OR t_absensi.stts IS NULL)
    GROUP BY sys_user.nama");
    $data['hasilquery'] = $data['hitung']->num_rows();
    $data['hitung2'] = $this->t_absensi->live_query("SELECT sys_user.nama, sys_user.kategori, sys_user.opt_level, t_absensi.waktu_in, t_absensi.stts
    FROM sys_user
    LEFT JOIN t_absensi
    ON sys_user.nik_absensi = t_absensi.nik
    where  sys_user.opt_level=8 
    AND t_absensi.methode = 1
    AND (date(t_absensi.waktu_in) = '$start' OR date(t_absensi.waktu_in) IS NULL)
    AND (STR_TO_DATE(time(t_absensi.waktu_in), '%H:%i:%s') > '08:00:00')
    AND (t_absensi.stts = 'in' OR t_absensi.stts IS NULL)
    GROUP BY sys_user.nama     
    ");
    $data['hasilquery2'] = $data['hitung2']->num_rows();
    $data['datauserreg'] = $this->t_absensi->live_query("SELECT
    sys_user.opt_level,
    sys_user.nik_absensi,
    t_absensi.stts,
    t_absensi.waktu_in,
    sys_user.nama,
    t_absensi.nama
    FROM
    sys_user
    LEFT JOIN t_absensi ON t_absensi.nik = sys_user.nik_absensi
    WHERE sys_user.opt_level = 8
    AND sys_user.tl != '-'
    AND t_absensi.methode = 1
    ");



    $queryregabsen = $this->t_absensi->live_query("SELECT * FROM sys_user where opt_level=8 ");
    $data['regabsen'] = $queryregabsen->num_rows();
    

    if (isset($_GET['start'])) {
      $data['start'] = $_GET['start'];
      //  $data['end'] = $_GET['end'];
    } else {
      $data['start'] = date('Y-m-d');
      //  $data['end'] = date('Y-m-d');
    }
    $data['jml_agent'] = $this->Sys_user_table_model->get_count(array("opt_level" => 8));
    $this->template->load($view, $data);
  }
}
