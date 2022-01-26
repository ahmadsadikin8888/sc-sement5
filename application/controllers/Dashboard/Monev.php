<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Monev extends CI_Controller
{

    private $log_key, $log_temp, $title;
    function __construct()
    {
        parent::__construct();
        $this->load->model('Custom_model/Dapros_model', 'Dapros');
        $this->load->model('Custom_model/Sys_user_table_model', 'Sys_user_table_model');
        $this->load->model('Custom_model/Sys_user_log_in_out_table_model', 'Sys_log');
        $this->load->model('sys/Sys_user_log_model', 'log_login');
        $this->load->model('Absensi/Absensi_model', 't_absensi');
        $this->load->model('Custom_model/Sys_user_table_model', 'sys_user');
        $this->load->model('Custom_model/Cdr_model', 'cdr');
        $this->load->model('Custom_model/Trans_model', 'trans');
        $this->load->model('Custom_model/Sys_user_log_login_model', 'sys_user_log_login');
        $this->load->model('Custom_model/Sys_user_log_in_out_table_model', 'Sys_log');
    }

    public function index()

    {
        $data['controller'] = $this;

        $data['daily'] = $this->agent_peformance();
        $data['absensi'] = $this->agent_status();
        $data['aux'] = $this->agent_aux();

        $data['wfh_num'] = count($data['absensi']['kehadiran']['WFH']);
        $data['wfh_data'] = $data['absensi']['kehadiran']['WFH'];
        $data['wfo_num'] = count($data['absensi']['kehadiran']['WFO']);
        $data['wfo_data'] = $data['absensi']['kehadiran']['WFO'];
        $data['duty_num'] = $data['wfh_num'] + $data['wfo_num'];
        $data['offline_num'] = count($data['absensi']['kehadiran']['OFFLINE']);
        $data['offline_data'] = $data['absensi']['kehadiran']['OFFLINE'];
        $data['logout_num'] = count(array_unique($data['absensi']['status']['LOGOUT']));
        $data['logout_data'] = array_unique($data['absensi']['status']['LOGOUT']);
        $data['aux_num'] = $data['aux']['num'];
        $data['aux_total'] = $data['aux']['total'];
        $data['aux_total_status'] = $data['aux']['total_status'];
        $data['aux_sub_total'] = $data['aux']['sub_total'];
        $data['aux_data'] = $data['aux']['data'];
        $data['aux_detail'] = $data['aux']['detail'];
        $data['aux_all_status'] = $data['aux']['all_status'];

        // $idle_data = array_diff($data['daily']['peformance']['idle'], $data['logout_data']);
        $data['idle_data'] = $data['daily']['peformance']['idle'];
        $afk = array();
        //  array_merge($data['logout_data'], $data['aux_data'], $data['idle_data']);
        if ($data['logout_num'] > 0) {
            $data['idle_data'] = array_diff($data['idle_data'], $data['logout_data']);
            $afk = $data['logout_data'];
        }
        if ($data['aux_num'] > 0) {
            $data['idle_data'] = array_diff($data['idle_data'], $data['aux_data']);
            $afk = array_merge($afk, $data['aux_data']);
        }
        if (count($data['idle_data']) > 0) {
            $afk = array_merge($afk, $data['idle_data']);
        }
        // $data['idle_detail'] = $data['idle_data']['peformance'];
        // $data['idle_data'] = $data['daily']['peformance']['idle'];
        $data['idle_num'] = count($data['idle_data']);


        $afk_unix = array_unique($afk);
        $data['aval_num'] = $data['duty_num'] - count($afk_unix);
        $data['agent_status'] = $data['daily']['peformance'];
        $data['agent'] = $this->Sys_user_table_model->get_results(array("opt_level" => 8));
        $data['tl'] = $this->Sys_user_table_model->get_results(array("opt_level" => 9));
        $data['list_tl'] = array();
        if ($data['tl']['num'] > 0) {
            foreach ($data['tl']['results'] as $data_tl) {
                $data['list_tl'][$data_tl->nmuser] = $data_tl->nama;
            }
        }
        if (($data['duty_num'] - count($afk_unix)) < 0) {
            $avln = 0;
            $data['aval_num'] = 0;
        }
        $now = date('Y-m-d');


        ////END RECORDING///

        $data['cache'] = array(
            'duty_num' => $data['cache_monev_realtime']['duty_num'] - $data['duty_num'],
            'wfh_num' => $data['cache_monev_realtime']['wfh_num'] - $data['wfh_num'],
            'wfo_num' => $data['cache_monev_realtime']['wfo_num'] - $data['wfo_num'],
            'offline_num' => $data['cache_monev_realtime']['offline_num'] - $data['offline_num'],
            'logout_num' => $data['cache_monev_realtime']['logout_num'] - $data['logout_num'],
            'aux_num' => $data['cache_monev_realtime']['aux_num'] - $data['aux_num'],
            'aval_num' => $avln,
            'idle_num' => $data['cache_monev_realtime']['idle_num'] - $data['idle_num'],
            'aht' => $data['cache_monev_realtime']['aht'] - $data['aht']
        );

        ///oncall//

        $this->template->load('Dashboard/monev', $data);
    }
    function agent_peformance()
    {

        $agent = $this->Sys_user_table_model->get_results(array("opt_level" => 8));
        $total = array();
        $return = array();
        if ($agent['num'] > 0) {
            foreach ($agent['results'] as $ag) {
                $agna = $this->t_absensi->live_query("SELECT * FROM maping_eyebeam WHERE user_id='$ag->id' ")->row();
                $return[$ag->agentid] = array();
                $return['peformance'][$ag->agentid]['call'] = 0;
                $filter = array(
                    "UPD_BY" => $ag->agentid,
                    "DATE(lup)" => date('Y-m-d')
                );
                $return['peformance'][$ag->agentid]['call'] = $this->trans->live_query("SELECT count(*) as jumlah,sum(duration) as jumlah_duration FROM cdr WHERE exten = '$agna->username' ");
                $row_data = $this->trans->get_row($filter, array("lup,TIMESTAMPDIFF(
                    SECOND,
                    lup,
                    CURRENT_TIMESTAMP
                ) AS idle"), array("lup" => "DESC"));

                if ($row_data) {
                    $return['peformance'][$ag->agentid]['last_update'] = $row_data->lup;

                    // echo $diff;
                    $last_aux_status = $this->Sys_log->live_query("Select logout_time FROM sys_user_log_in_out where logout_time IS NOT NULL AND agentid='" . $ag->agentid . "' ORDER BY id DESC");

                    $row_last_aux_status = $last_aux_status->row()->logout_time;
                    if (strtotime($row_last_aux_status) > strtotime($row_data->lup)) {
                        $diff = strtotime(date("Y-m-d H:i:s")) - strtotime($row_last_aux_status);
                        if ($diff > 300) {
                            $return['peformance']['idle'][] = $ag->agentid;
                        }
                        $idle_timena = $diff;
                    } else {
                        if ($row_data->idle > 300) {
                            $return['peformance']['idle'][] = $ag->agentid;
                        }
                        $idle_timena = $row_data->idle;
                    }

                    $return['peformance'][$ag->agentid]['idle'] = $idle_timena;
                }
                $data_in = $this->t_absensi->get_row(array("date(waktu_in)" => date('Y-m-d'), "stts" => 'in', "nik" => $ag->nik_absensi), array("*,time(waktu_in) as waktu_masuk"), array("waktu_in" => "ASC"));
                $return['peformance'][$ag->agentid]['in'] = $data_in->waktu_masuk;
                $return['peformance'][$ag->agentid]['out'] = $this->t_absensi->get_row(array("date(waktu_in)" => date('Y-m-d'), "stts" => 'out', "nik" => $ag->nik_absensi), array("*,,time(waktu_in) as waktu_masuk"), array("waktu_in" => "DESC"))->waktu_masuk;

                $return['peformance'][$ag->agentid]['data'] = $ag;
            }
        }
        return $return;
    }

    function agent_status()
    {
        $agent = $this->Sys_user_table_model->get_results(array("opt_level" => 8));
        $total = array();
        $return = array();
        if ($agent['num'] > 0) {
            foreach ($agent['results'] as $ag) {
                $absen_kantor = $this->t_absensi->get_count(array("nik" => $ag->nik_absensi, "stts" => "in", "methode" => 0, "DATE(waktu_in)" => date('Y-m-d')));
                $absen_aplikasi = $this->t_absensi->get_count(array("nik" => $ag->nik_absensi, "stts" => "in", "methode" => 1, "DATE(waktu_in)" => date('Y-m-d')));
                $out_kantor = $this->t_absensi->get_count(array("nik" => $ag->nik_absensi, "stts" => "out", "methode" => 0, "DATE(waktu_in)" => date('Y-m-d '), "TIME(waktu_in) >" => '09:00:00'));
                $out_aplikasi = $this->t_absensi->get_count(array("nik" => $ag->nik_absensi, "stts" => "out", "methode" => 1, "DATE(waktu_in)" => date('Y-m-d'), "TIME(waktu_in) >" => '09:00:00'));
                if ($absen_kantor > 0) {
                    $return['kehadiran']['WFO'][] = $ag->agentid;
                    if ($out_kantor > 0) {
                        $return['status']['LOGOUT'][] = $ag->agentid;
                    }
                }
                if ($absen_kantor == 0 && $absen_aplikasi > 0) {
                    $return['kehadiran']['WFH'][] = $ag->agentid;
                }
                if ($out_aplikasi > 0 || $out_kantor > 0) {
                    $return['status']['LOGOUT'][] = $ag->agentid;
                }
                if ($absen_kantor == 0 && $absen_aplikasi == 0) {
                    $return['kehadiran']['OFFLINE'][] = $ag->agentid;
                }
            }
        }
        return $return;
    }
    function agent_aux()
    {
        $return = array();
        $aux = $this->Sys_log->live_query("Select sys_user_log_in_out.agentid,sys_user_log_in_out.ket,sys_user.nama,TIMESTAMPDIFF(SECOND,sys_user_log_in_out.login_time,CURRENT_TIMESTAMP) AS aux,sys_user_log_in_out.login_time from sys_user_log_in_out JOIN sys_user ON sys_user.id = sys_user_log_in_out.id_user where DATE(sys_user_log_in_out.login_time) = '" . date('Y-m-d') . "'  AND sys_user_log_in_out.ket != '' AND ISNULL(sys_user_log_in_out.logout_time) AND sys_user.kategori='REG' AND sys_user.tl != '-' AND sys_user.opt_level = 8 GROUP BY sys_user_log_in_out.agentid ORDER BY sys_user_log_in_out.id DESC ");
        $status_aux = array("Break", "Pray", "Toilet", "Handsup");
        foreach ($status_aux as $k => $v) {
            $return['total'][$v] = 0;
            $aux_status = $this->Sys_log->live_query("Select sys_user_log_in_out.agentid,sys_user.nama,sum(TIMESTAMPDIFF(SECOND,sys_user_log_in_out.login_time,sys_user_log_in_out.logout_time)) AS aux from sys_user_log_in_out JOIN sys_user ON sys_user.id = sys_user_log_in_out.id_user where DATE(sys_user_log_in_out.login_time) = '" . date('Y-m-d') . "' AND sys_user_log_in_out.ket = '" . $v . "' AND sys_user_log_in_out.logout_time IS NOT NULL AND sys_user.kategori='REG' AND sys_user.tl != '-' AND sys_user.opt_level = 8 GROUP BY sys_user_log_in_out.agentid");
            $aux_detail = $this->Sys_log->live_query("Select sys_user_log_in_out.agentid,sys_user.nama,sum(TIMESTAMPDIFF(SECOND,sys_user_log_in_out.login_time,sys_user_log_in_out.logout_time)) AS aux from sys_user_log_in_out JOIN sys_user ON sys_user.id = sys_user_log_in_out.id_user where sys_user_log_in_out.login_time >= TIMESTAMP('" . date('Y-m-d') . "','08:00:00') AND sys_user_log_in_out.login_time <= TIMESTAMP('" . date('Y-m-d') . "','17:00:00') AND sys_user_log_in_out.ket = '" . $v . "' AND sys_user_log_in_out.logout_time IS NOT NULL AND sys_user.kategori='REG' AND sys_user.tl != '-' AND sys_user.opt_level = 8 GROUP BY sys_user_log_in_out.agentid");
            if ($aux_status->num_rows() > 0) {
                foreach ($aux_status->result_array() as $axd) {
                    $return['all_status'][$axd['agentid']][$v] = $axd['aux'];
                    if ($axd['aux'] > 0) {
                        $return['total_status'][$v] = $return['total_status'][$v] + 1;
                    }
                    $return['total'][$v] = $return['total'][$v] + $axd['aux'];
                }
            }
            if ($aux_detail->num_rows() > 0) {
                foreach ($aux_detail->result_array() as $axd) {
                    $return['all_status'][$axd['agentid']][$v . "_"] = $axd['aux'];
                }
            }
        }
        $return['num'] = $aux->num_rows();
        if ($aux->num_rows() > 0) {
            foreach ($aux->result_array() as $ax) {
                $return['data'][] = $ax['agentid'];
                $return['detail'][$ax['agentid']] = $ax;
                $status_aux = array("Break", "Pray", "Toilet", "Handsup");
                foreach ($status_aux as $k => $v) {
                    if ($v == $ax['ket']) {
                        $return['sub_total'][$v] = $return['sub_total'][$v] + 1;
                    }
                }
            }
        }
        return $return;
    }
}
