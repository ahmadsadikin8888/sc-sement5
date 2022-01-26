<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kpi extends CI_Controller
{

    private $log_key, $log_temp, $title;
    function __construct()
    {
        parent::__construct();
        $this->load->model('Custom_model/Dashboard_model');
    }

    public function index()

    {
        $data = array(
            'title_page_big'        => 'Dashboard',
            'title'                    => $this->title,
        );
        $data['controller'] = $this;

        if (isset($_POST["search"])) {
            $periode = $this->input->post('periode');
        } else {
            $periode = 202101;
        }

        $data['periode'] = $periode;
        $data['data_sms'] = $this->get_data_sms($periode);
        $data['data_email'] = $this->get_data_email($periode);
        $data['data_ovr'] = $this->get_data_ovr($periode);
        $data['data_tvms'] = $this->get_data_tvms($periode);
        $data['data_wa'] = $this->get_data_wa($periode);

        $this->load->view('Dashboard/kpi', $data);
    }
    public function get_data_sms($periode)
    {
        $dashboard = $this->Dashboard_model;
        $rest_order = $dashboard->get_kpi_sms($periode);
        $j_response = count($rest_order);
        $sum_tot = 0;
        $sum_min = 0;
        foreach ($rest_order as $key) {
            $total = $key->total;
            $t1 = $key->start;
            $t2 = $key->end;
            $hourdiff = round((strtotime($t2) - strtotime($t1)) / 60, 1);
            $sum_tot += $total;
            $sum_min += $hourdiff;
        }

        $av = round(($sum_tot / $sum_min) * 60);

        if ($av >= 101128) {
            $kpi = 8;
        } else {
            $kpi = round($av / (101128 / 8));
        }

        $cek_total = $dashboard->get_total($periode);

        foreach ($cek_total as $key) {
            $total = $key->total;
            $model = $key->model;
            if ($model == 'DUNING_SMS') {
                $tot = $total;
            }
        }

        $persen = round(($sum_tot / $tot) * 100);

        if ($persen >= 98) {
            $kpi2 = 8;
        } else {
            $kpi2 = round($persen / (98 / 8));
        }

        $data = array($av, $kpi, $sum_tot, $tot, $kpi2, $persen);

        echo $data[0] . '-' . $data[1] . '-' . $data[2] . '-' . $data[3] . '-' . $data[4] . '-' . $data[5];

        return $data;
    }

    public function get_data_email($periode)
    {

        $dashboard = $this->Dashboard_model;
        $rest_order = $dashboard->get_kpi_email($periode);
        $j_response = count($rest_order);
        $sum_tot = 0;
        $sum_min = 0;
        foreach ($rest_order as $key) {
            $total = $key->total;
            $t1 = $key->start;
            $t2 = $key->end;
            $hourdiff = round((strtotime($t2) - strtotime($t1)) / 60, 1);
            $sum_tot += $total;
            $sum_min += $hourdiff;
        }

        $av = round(($sum_tot / $sum_min) * 60);

        if ($av >= 24357) {
            $kpi = 8;
        } else {
            $kpi = round($av / (24357 / 8));
        }

        $cek_total = $dashboard->get_total($periode);

        foreach ($cek_total as $key) {
            $total = $key->total;
            $model = $key->model;
            if ($model == 'DUNING_EMAIL') {
                $tot = $total;
            }
        }

        $persen = round(($sum_tot / $tot) * 100);

        if ($persen >= 98) {
            $kpi2 = 8;
        } else {
            $kpi2 = round($persen / (98 / 8));
        }

        $data = array($av, $kpi, $sum_tot, $tot, $kpi2, $persen);

        echo $data[0] . '-' . $data[1] . '-' . $data[2] . '-' . $data[3] . '-' . $data[4] . '-' . $data[5];

        return $data;
    }

    public function get_data_ovr($periode)
    {

        $dashboard = $this->Dashboard_model;
        $rest_order = $dashboard->get_kpi_ovr($periode);
        $j_response = count($rest_order);
        $sum_tot = 0;
        $sum_min = 0;
        foreach ($rest_order as $key) {
            $total = $key->total;
            $t1 = $key->start;
            $t2 = $key->end;
            $hourdiff = round((strtotime($t2) - strtotime($t1)) / 60, 1);
            $sum_tot += $total;
            $sum_min += $hourdiff;
        }

        $av = round(($sum_tot / $sum_min) * 60);

        if ($av >= 11373) {
            $kpi = 8;
        } else {
            $kpi = round($av / (11373 / 8));
        }

        $data = array($av, $kpi);

        $cek_total = $dashboard->get_total($periode);

        foreach ($cek_total as $key) {
            $total = $key->total;
            $model = $key->model;
            if ($model == 'DUNING_OVR') {
                $tot = $total;
            }
        }

        $persen = round(($sum_tot / $tot) * 100);

        if ($persen >= 98) {
            $kpi2 = 8;
        } else {
            $kpi2 = round($persen / (98 / 8));
        }

        $data = array($av, $kpi, $sum_tot, $tot, $kpi2, $persen);

        echo $data[0] . '-' . $data[1] . '-' . $data[2] . '-' . $data[3] . '-' . $data[4] . '-' . $data[5];

        return $data;
    }

    public function get_data_tvms($periode)
    {

        $dashboard = $this->Dashboard_model;
        $rest_order = $dashboard->get_kpi_tvms($periode);
        $j_response = count($rest_order);
        $sum_tot = 0;
        $sum_min = 0;
        foreach ($rest_order as $key) {
            $total = $key->total;
            $t1 = $key->start;
            $t2 = $key->end;
            $hourdiff = round((strtotime($t2) - strtotime($t1)) / 60, 1);
            $sum_tot += $total;
            $sum_min += $hourdiff;
        }

        $av = round(($sum_tot / $sum_min) * 60);

        if ($av >= 343355) {
            $kpi = 8;
        } else {
            $kpi = round($av / (343355 / 8));
        }

        $data = array($av, $kpi);

        $cek_total = $dashboard->get_total($periode);

        foreach ($cek_total as $key) {
            $total = $key->total;
            $model = $key->model;
            if ($model == 'TVMS') {
                $tot = $total;
            }
        }

        $persen = round(($sum_tot / $tot) * 100);

        if ($persen >= 98) {
            $kpi2 = 8;
        } else {
            $kpi2 = round($persen / (98 / 8));
        }

        $data = array($av, $kpi, $sum_tot, $tot, $kpi2, $persen);

        echo $data[0] . '-' . $data[1] . '-' . $data[2] . '-' . $data[3] . '-' . $data[4] . '-' . $data[5];

        return $data;
    }

    public function get_data_wa()
    {
        $api_url = 'http://10.60.175.144/IDMS_VSPANER/api/kpi_wa.php';

        // Read JSON file
        $json_data = file_get_contents($api_url);

        // Decode JSON data into PHP array
        $response_data = json_decode($json_data);

        // All user data exists in 'data' object
        $user_data = $response_data->data;

        // Cut long data into small & select only first 10 records
        //$user_data = array_slice($user_data, 0, 9);

        // Print data if need to debug
        //print_r($user_data);

        // Traverse array and display user data
        $sum_tot = 0;
        $sum_min = 0;
        foreach ($user_data as $user) {
            $jam = $user->jam;
            $total = $user->total;
            if ($jam > 0) {
                $sum_tot += $total;
                $sum_min += $jam;
            }
        }
        $av = round(($sum_tot / $sum_min) * 60);

        if ($av >= 54000) {
            $kpi = 8;
        } else {
            $kpi = round($av / (54000 / 8));
        }

        $data = array($av, $kpi, $sum_tot);
        echo $data[0] . '-' . $data[1] . '-' . $data[2];
        return $data;
    }

    public function detail_kpi()
    {
        $data = array(
            'title_page_big'        => 'Report Channel',
            'title'                    => $this->title,
        );
        $data['controller'] = $this;
        if (isset($_GET['start']) && isset($_GET['end'])) {
            $start_filter = $_GET['start'];
            $end_filter = $_GET['end'];
        }

        $this->template->load('Dashboard/Detail_kpi', $data);
    }

    public function get_detail_schedule($ch = null, $start = null, $end = null)
    {
        $url = "http://10.60.175.144/IDMS_VSPANER/api/detail_kpi.php?channel=$ch&start=$start&end=$end";

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
        //$rest = json_encode($content,true);
        echo $content;
    }

    public function get_detail_engine($ch = null, $start = null, $end = null)
    {
        $url = "http://10.60.175.144/IDMS_VSPANER/api/detail_kpi_engine.php?channel=$ch&start=$start&end=$end";

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
        //$rest = json_encode($content,true);
        echo $content;
    }

    public function get_detail_pranpc($ch = null, $start = null, $end = null)
    {
        $url = "http://10.60.175.144/IDMS_VSPANER/api/detail_kpi_pranpc.php?channel=$ch&start=$start&end=$end";

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
        //$rest = json_encode($content,true);
        echo $content;
    }

    public function get_blast_sms($start = null, $end = null)
    {
        $url = "http://10.60.175.144/IDMS_VSPANER/api/kpi_sms.php?start=$start&end=$end";

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
        //$rest = json_encode($content,true);
        echo $content;
    }

    public function get_hasil_sms($start = null, $end = null)
    {
        $url = "http://10.60.175.144/IDMS_VSPANER/api/detail_kpi_hasil_sms.php?start=$start&end=$end";

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
        //$rest = json_encode($content,true);
        echo $content;
    }

    public function get_blast_email($start = null, $end = null)
    {
        $url = "http://10.60.175.144/IDMS_VSPANER/api/kpi_email.php?start=$start&end=$end";

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
        //$rest = json_encode($content,true);
        echo $content;
    }
}
