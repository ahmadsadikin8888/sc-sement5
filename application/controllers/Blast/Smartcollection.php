<?php
require APPPATH . '/controllers/ebs_indihome/Ebs_indihome_config.php';

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Smartcollection extends CI_Controller
{
    private $log_key, $log_temp, $title;
    function __construct()
    {
        parent::__construct();
        $this->load->model('Custom_model/M_schedule_model', 'm_schedule');
        $this->load->model('Custom_model/Data_lead_model', 'data_lead');
        $this->load->model('Custom_model/Engine_sms_model', 'engine_sms');
        $this->load->model('Custom_model/Engine_wa_model', 'engine_wa');
        $this->load->model('Custom_model/Engine_tvms_model', 'engine_tvms');
        $this->load->model('Custom_model/Engine_ovr_model', 'engine_ovr');
        $this->load->model('Custom_model/Engine_email_model', 'engine_email');
    }
    public function blast()
    {
        $start = microtime(true);
        $tanggal_nya = date('Y-m-d');
        ini_set('max_execution_time', 999999);
        ini_set('memory_limit', '2048M');
        $period_sch = date('Ym');

        $tgls = date('d');
        $tgl_now = date("Y-m-d");

        $date1 = strtotime(date("Y-m-d", strtotime($tgl_now)) . " -1 days");
        $date1 = strtoupper(date("d-M-y", $date1));

        $date2 = strtotime(date("Y-m-d", strtotime($tgl_now)) . " -2 days");
        $date2 = strtoupper(date("d-M-y", $date2));

        $date3 = strtotime(date("Y-m-d", strtotime($tgl_now)) . " -3 days");
        $date3 = strtoupper(date("d-M-y", $date3));


        // if ((int)$tgls == 26 || (int)$tgls == 27 || (int)$tgls == 28 || (int)$tgls == 29 || (int)$tgls == 30 || (int)$tgls == 31 || (int)$tgls == 1 || (int)$tgls == 2 || (int)$tgls == 3 || (int)$tgls == 4 || (int)$tgls == 5) {
        //     $limit = 150000;
        // } else {
        //     $limit = 500000;
        // }
        $data_channel = $this->data_lead->live_query("select channel,count(id) as jumlah_data FROM data_lead WHERE send_status=0")->result();
        if (count($data_channel) > 0) {
            foreach ($data_channel as $ch) {
                $data_schedule = array(
                    'model' => 'SC_' . $ch->channel,
                    'periode' => $period_sch,
                    'jumlah_data' => $ch->jumlah_data,
                    'exec_time' => '9999-12-01',
                    'status' => 0,
                    'upd' => 'OTOMATIS',
                    'lup' => date('Y-m-d H:i:s'),
                    'date_upload' => date('Y-m-d H:i:s')
                );
                $sid = $this->m_schedule->add($data_schedule);
                $data_blast = $this->data_lead->live_query("select * FROM data_lead WHERE send_status=0 AND channel='$ch->channel'")->result();
                $this->data_lead->live_query("UPDATE data_lead  SET send_status=1 WHERE send_status=0 AND channel='$ch->channel'")->result();
                $setting = false;
                if ((int)$tgls >= 5 && (int)$tgls <= 10) {
                    $setting = $this->data_lead->live_query("select * FROM setting_infotag ORDER BY id DESC LIMIT 1")->row();
                }
                if ((int)$tgls > 10) {
                    $setting = $this->data_lead->live_query("select * FROM setting_reminding ORDER BY id DESC LIMIT 1")->row();
                }
                if ($setting) {
                    if (count($data_blast) > 0) {
                        switch ($ch->channel) {
                            case "sms":
                                $this->sms_blast($data_blast, $sid, $period_sch, $ch, $setting);
                                break;
                            case "wa":
                                $this->wa_blast($data_blast, $sid, $period_sch, $ch, $setting);
                                break;
                        }
                    }
                }
            }
        }
    }

    public function sms_blast($data_blast, $sid, $period_sch, $ch, $setting)
    {
        foreach ($data_blast as $db) {
            $data_additional = json_decode($db->data_additional);
            $id_message = $ch->channel;
            $data_insert = array(
                'schedule_id' => $sid,
                'cca' => $data_additional->cca,
                'snd' => $db->snd,
                'notel' => $data_additional->no_gsm,
                'tagihan' => $data_additional->tagihan,
                'cprod' => $data_additional->cprod,
                'periode' => $period_sch,
                'tgl_insert' => date('Y-m-d H:i:s'),
                'id_message' => $setting->$id_message,
                'group_id' => $data_additional->group_id,
                'jenis' => $data_additional->jenis,
                'tgl_upload' => date('Y-m-d H:i:s'),
                'regional' => $data_additional->regional,
                'is_otomatis' => 1,
            );

            $this->engine_sms->add($data_insert);
        }
    }
    public function wa_blast($data_blast, $sid, $period_sch, $ch, $setting)
    {

        foreach ($data_blast as $db) {
            $data_additional = json_decode($db->data_additional);
            //$CAMPAIGN_NAME='bilrem_sb20_v2';
            $GROUP_WA = '3';
            $LINK_BAYAR = 'http://myih.ch/cara-bayar';
            $LINK = 'http://myih.ch/ebs/' . $db->snd;

            $data_insert = array(
                'schedule_id' => $sid,
                'CCA' => $data_additional->cca,
                'NCLI' => $data_additional->ncli,
                'SND' => $db->snd,
                'SND_GROUP' => $data_additional->snd_group,
                'GSM' => $data_additional->no_gsm,
                'NAMA' => str_replace("'", ' ', $data_additional->nama),
                'ALAMAT' => str_replace("'", ' ', $data_additional->alamat),
                'BA' => $data_additional->ba,
                'PRODUK' => $data_additional->produk,
                'CENTITE' => $data_additional->centite,
                'GROUP_ID' => $data_additional->group_id,
                'BUNDLING' => $data_additional->bundling,
                'REGIONAL' => $data_additional->regional,
                'TAGIHAN' => $data_additional->tagihan,
                'TOTAG' => $data_additional->tagihan,
                'STATUS' => $data_additional->status,
                'CAMPAIGN_NAME' => $data_additional->campaign_name,
                'PERIODE' => $data_additional->periode,
                'DUE_DATE' => $data_additional->due_date,
                'BUL_TAG' => $data_additional->bul_tag,
                'GROUP_WA' => $GROUP_WA,
                'JENIS_WA' => $data_additional->jenis_wa,
                'TODO' => $data_additional->todo,
                'LINK_BAYAR' => $LINK_BAYAR,
                'LINK' => $LINK,
            );
            $this->engine_sms->add($data_insert);
        }
    }
    public function tvms_blast($data_blast, $sid, $period_sch, $ch, $setting)
    {


        $tgls        = date('d');
        $tgl_now     = date("Y-m-d");
        $id_message = $ch->channel;

        foreach ($data_blast as $db) {
            $data_additional = json_decode($db->data_additional);
            //$CAMPAIGN_NAME='bilrem_sb20_v2';
            if ((int)$tgls == 1 || (int)$tgls == 2 || (int)$tgls == 3) {
                $periode_co = $data_additional->periode;
            } else {
                $periode_co = $period_sch;
            }

            $data_insert = array(
                'schedule_id' => $sid,
                'ncli' => $data_additional->ncli,
                'no_internet' => $data_additional->snd,
                'periode' => $periode_co,
                'notel' => $data_additional->notel,
                'nama' => $data_additional->nama,
                'tagihan' => $data_additional->tagihan,
                'tgl_insert' => date('Y-m-d H:i:s'),
                'template' => $setting->$id_message,
                'ba' => $data_additional->ba,
                'centite' => $data_additional->centite,
                'part' => $data_additional->part,
                'kategori' => 'Reminding',
                'is_otomatis' => 1,
                'is_submit' => 0,
                'cca' => $data_additional->cca,
                'group_id' => $data_additional->group_id,
                'regional' => $data_additional->regional,
            );
            $this->engine_tvms->add($data_insert);
        }
    }
    public function ovr_blast($data_blast, $sid, $period_sch, $ch, $setting)
    {
        $tgls        = date('d');
        $tgl_now     = date("Y-m-d");
        $id_message = $ch->channel;
        foreach ($data_blast as $db) {
            $data_additional = json_decode($db->data_additional);
            //$CAMPAIGN_NAME='bilrem_sb20_v2';
            if ((int)$tgls == 1 || (int)$tgls == 2 || (int)$tgls == 3) {
                $periode_co        = $data_additional->periode;
            } else {
                $periode_co     = $data_additional->periode;
            }

            $cprod            = $data_additional->cprod;
            $todo            = $data_additional->jenis;

            $cprod == 1 ? $produk = 'TELEPON' : $produk = 'Internet';

            if ($todo == 'F' && $produk == 'Internet') {
                $id_ovrs = '4';
            } else if ($todo == 'F' && $produk == 'TELEPON') {
                $id_ovrs = '5';
            } else if ($todo == 'E' && $produk == 'TELEPON') {
                $id_ovrs = '4';
            } else if ($todo == 'E' && $produk == 'Internet') {
                $id_ovrs = '5';
            } else if ($todo == 'U' && $produk == 'Internet' && $tgls >= 1 &&  $tgls <= 3) {
                $id_ovrs = '3';
            } else if ($todo == 'U' && $produk == 'TELEPON' && $tgls >= 1 &&  $tgls <= 3) {
                $id_ovrs = '2';
            } else if ($todo == 'U' && $produk == 'Internet' && $tgls >= 7 &&  $tgls <= 12) {
                $id_ovrs = '6';
            } else if ($todo == 'U' && $produk == 'TELEPON' && $tgls >= 7 &&  $tgls <= 12) {
                $id_ovrs = '6';
            } else if ($todo == 'U' && $produk == 'Internet' && $tgls >= 16 &&  $tgls <= 20) {
                $id_ovrs = '1';
            } else if ($todo == 'U' && $produk == 'Internet' && $tgls >= 21) {
                $id_ovrs = '3';
            } else if ($todo == 'U' && $produk == 'TELEPON' && $tgls >= 16 &&  $tgls <= 20) {
                $id_ovrs = '1';
            } else if ($todo == 'U' && $produk == 'TELEPON' && $tgls >= 21) {
                $id_ovrs = '2';
            } else if ($todo == 'C' && $produk == 'Internet' && $tgls >= 16 &&  $tgls <= 20) {
                $id_ovrs = '1';
            } else if ($todo == 'C' && $produk == 'Internet' && $tgls >= 21) {
                $id_ovrs = '3';
            } else if ($todo == 'C' && $produk == 'TELEPON' && $tgls >= 16 &&  $tgls <= 20) {
                $id_ovrs = '1';
            } else if ($todo == 'C' && $produk == 'TELEPON' && $tgls >= 21) {
                $id_ovrs = '2';
            } else {
                $id_ovrs = '0';
            }
            $data_insert = array(
                'schedule_id' => $sid,
                'id_ovrs' => $id_ovrs,
                'snd' => $data_additional->snd,
                'periode' => $periode_co,
                'notel' => $data_additional->notel,
                'produk' => $produk,
                'tagihan' => $data_additional->tagihan,
                'tgl_insert' => date('Y-m-d H:i:s'),
                'cprod' => $data_additional->$cprod,
                'todo' => $data_additional->todo,
                'cca' => $data_additional->cca,
                'group_id' => $data_additional->group_id,
                'regional' => 'regional',
                'is_otomatis' => 1,
            );
            if ($id_ovrs != '' && $data_additional->notel != '') {
                $this->engine_ovr->add($data_insert);
            }
        }
    }
    public function email_blast($data_blast, $sid, $period_sch, $ch, $setting)
    {
        $tgls        = date('d');
        $tgl_now     = date("Y-m-d");
        $id_message = $ch->channel;
        if ((int)$tgls >= 1 && (int)$tgls <= 7) {
            $jenis = 'E';
        } else if ((int)$tgls >= 8 && (int)$tgls <= 13) {
            $jenis = 'F';
        } else if ((int)$tgls >= 14) {
            $jenis = 'U';
        }
        foreach ($data_blast as $db) {
            $data_additional = json_decode($db->data_additional);
            $id_message = $ch->channel;
            $cca            = $data_additional->CCA;
            $snd            = $db->SND;
            $nama            = $data_additional->NAMA;
            $todo            = $data_additional->TODO;
            $email_customer    = $data_additional->EMAIL;
            $tagihan        = $data_additional->TAGIHAN;
            $duedate        = $data_additional->DUEDATE;
            $tgl_input        = $data_additional->TGL_INPUT;
            $cprod            = $data_additional->CPROD;
            $periode        = $data_additional->PERIODE;
            $id_template    = $data_additional->ID_TEMPLATE;
            $group_id        = $data_additional->GROUP_ID;
            $regional        = $data_additional->REGIONAL;

            $cprod == 1 ? $produk = 'TELEPON' : $produk = 'Internet';


            if ($id_template != '' && $email_customer != '') {
                $data_insert = array(
                    'schedule_id' => $sid,
                    'id_template' => $id_template,
                    'email_customer' => "REPLACE(REPLACE('$email_customer','\n',''),'\t','')",
                    'date_insert' => $tgl_input,
                    'periode' => $periode,
                    'duedate' => $duedate,
                    'date_upload' => $tgl_input,
                    'nama' => $nama,
                    'cca' => $cca,
                    'snd' => $db->snd,
                    'cprod' => $cprod,
                    'produk' => $produk,
                    'todo' => $todo,
                    'tagihan' => $tagihan,
                    'group_id' => $group_id,
                    'regional' => $regional,
                    'is_otomatis' => 1,
                );
            };

            $this->engine_email->add($data_insert);
        }
    }
};
