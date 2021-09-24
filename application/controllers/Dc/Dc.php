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
    $this->load->model('Custom_model/Dim_customer_model', 'Dim_customer');
  }
  public function index()
  {
    $idlogin = $this->session->userdata('idlogin');
    $logindata = $this->log_login->get_by_id($idlogin);
    $data['userdata'] = $this->Sys_user_table_model->get_row(array("id" => $logindata->id_user));
    $view = 'Dc/dashboard';
    $this->load->view($view, $data);
  }
  function dalalead()
  {
    $idlogin = $this->session->userdata('idlogin');
    $logindata = $this->log_login->get_by_id($idlogin);
    $data['userdata'] = $this->Sys_user_table_model->get_row(array("id" => $logindata->id_user));
    $view = 'Dc/datalead';
    $filter = array();

    $data['data_lead'] = $this->data_lead->live_query("SELECT count(*) as numna FROM dim_customer ")->row()->numna;
    $data['data_wa'] = $this->data_lead->live_query("SELECT count(*) as numna FROM dim_customer WHERE  opsi_channel = 1")->row()->numna;
    $data['data_sms'] = $this->data_lead->live_query("SELECT count(*) as numna FROM dim_customer WHERE opsi_channel = 2")->row()->numna;
    $data['data_email'] = $this->data_lead->live_query("SELECT count(*) as numna FROM dim_customer WHERE opsi_channel = 3")->row()->numna;
    $data['data_obc'] = $this->data_lead->live_query("SELECT count(*) as numna FROM dim_customer WHERE opsi_channel = 4")->row()->numna;
    $data['data_ovr'] = $this->data_lead->live_query("SELECT count(*) as numna FROM dim_customer WHERE opsi_channel = 5")->row()->numna;
    $data['data_tvms'] = $this->data_lead->live_query("SELECT count(*) as numna FROM dim_customer WHERE opsi_channel = 6")->row()->numna;
    $data['data_mapping'] = $this->data_lead->live_query("SELECT count(*) as numna FROM dim_customer WHERE opsi_channel IS NULL")->row()->numna;
    $this->load->view($view, $data);
  }
  function mapping_profiling()
  {
    $dapros = $this->data_lead->live_query("SELECT * FROM dim_customer  WHERE opsi_channel IS NULL")->result();
    if (count($dapros) > 0) {
      foreach ($dapros as $row) {
        $data147 = $this->data_lead->live_query("select *,DATE(lup) as TANGGAL FROM trans_profiling WHERE no_speedy='" . $row->snd . "' AND veri_call=13")->result();
        if (count($data147) > 0) {
          $update_dapros['interaction_profiling'] = 1;
          foreach ($data147 as $r147) {
            $channel = $this->data_lead->live_query(array("channel_profiling" => $r147->opsi_channel))->row();
            $data_customer = array(
              'no_gsm' => $r147->handphone,
              'email' => $r147->email,
              'opsi_channel' => $channel->channel_key
            );

            $this->Dim_customer->edit(array("snd" => $r147->no_speedy), $data_customer);

            $date_key = $this->Dim_date->get_row(array("DATE(date_value)" => $r147->TANGGAL));
            $data_insert = array(
              'cat_key' => 1,
              'customer_key' => $row->customer_key,
              'channel_key' => 4,
              'status_key' => 25,
              'layanan_key' => 6,
              'regional_key' => $r147->regional,
              'witel_key' => '',
              'agent_key' => '',
              'date_key' => $date_key->date_key,
              'time_key' => '',
              'category_produk_key' => '',
              'produk_key' => '',
              'interaction_value' => ''
            );
            $cek = $this->Fact_interaction->get_count($data_insert);
            if ($cek == 0) {
              $this->Fact_interaction->add($data_insert);
            }
          }
        } else {
          $channel_1 = $this->failover->get_row(array("urutan" => 1))->id;
          $data_customer = array(
            'opsi_channel' => $channel_1
          );

          $this->Dim_customer->edit(array("snd" => $row->snd), $data_customer);
        }
      }
    }
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
    $data['ebs_template'] = $this->data_lead->live_query("select * FROM ebs_template WHERE status='Aktif'")->result();
    $data['sms_template'] = $this->data_lead->live_query("select * FROM sms_template WHERE status='Aktif'")->result();
    $data['wa_template'] = $this->data_lead->live_query("select * FROM wa_template WHERE status=3")->result();

    $view = 'Dc/campaign_add';
    $data['return'] = false;
    if (isset($_POST['title'])) {
      $data_insert = array(
        "status" => $_POST['status'],
        "title" => $_POST['title'],
        "date_online" => $_POST['date_online'],
        "sms_template" => $_POST['sms_template'],
        "wa_template" => $_POST['wa_template'],
        "ebs_template" => $_POST['ebs_template']
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
      $data['ebs_template'] = $this->data_lead->live_query("select * FROM ebs_template WHERE status='Aktif'")->result();
      $data['sms_template'] = $this->data_lead->live_query("select * FROM sms_template WHERE status='Aktif'")->result();
      $data['wa_template'] = $this->data_lead->live_query("select * FROM wa_template WHERE status=3")->result();

      $view = 'Dc/campaign_update';
      $data['return'] = false;
      if (isset($_POST['title'])) {
        $data_insert = array(
          "status" => $_POST['status'],
          "title" => $_POST['title'],
          "date_online" => $_POST['date_online'],
          "sms_template" => $_POST['sms_template'],
          "wa_template" => $_POST['wa_template'],
          "ebs_template" => $_POST['ebs_template']
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
      $channel = $this->data_lead->live_query("SELECT * FROM dim_channel")->result();
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
      if (count($channel) > 0) {
        foreach ($channel as $ch) {
          $update_channel = array(
            "opsi_channel" => $ch->channel_key
          );
          $filter_channel = array(
            "channel" => $ch->channel_value
          );
          $update_channel = $this->data_lead->edit($filter_channel, $update_channel);
          
        }
      }

      $jumlah_data = $this->data_lead->get_count($update_field);
      $this->campaign->update($_GET['campaign'], array('data_lead' => $jumlah_data, 'data_lead_code' => 'DC-' . $_GET['campaign']));
    }

    redirect(site_url() . 'Dc/Dc/campaign?success_create_lead=1&info=Data Lead Untuk Blast Management ' . $campaign->title . ' Berhasil Dibuat.!');
  }
}
