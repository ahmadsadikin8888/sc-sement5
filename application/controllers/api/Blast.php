<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Blast extends CI_Controller
{

    public function __construct()
    {
        // Construct the parent class
        parent::__construct();
        $this->load->model('Custom_model/Dapros_model', 'Dapros');
        $this->load->model('Custom_model/Fact_interaction_model', 'Fact_interaction');
        $this->load->model('Custom_model/Dim_status_model', 'Dim_status');
        $this->load->model('Custom_model/Dim_customer_model', 'Dim_customer');
        $this->load->model('Custom_model/Dim_date_model', 'Dim_date');
        $this->load->model('Custom_model/Dim_time_model', 'Dim_time');
        $this->load->model('Custom_model/Dim_periode_model', 'Dim_periode');
        // $this->load->database();
    }

    public function send_get()
    {
        $dapros = $this->Dapros->get_results(array("status_send" => '0'), array("*"), array("limit" => 1, "offset" => 0));
        //$hasil = $this->db->get()->result();
        //$rows = $this->db->affected_rows();
        $return = 'Dapros 0';
        if ($dapros['num'] > 0) {
            foreach ($dapros['results'] as $row) {
                $customer = $this->Dim_customer->get_row(array("customer_key" => $row->customer_key));
                $return = 'Gagal';
                if ($customer->customer_key) {
                    switch ($row->channel_key) {
                        case 1:
                            if ($row->gsm) {
                                $return = $this->blast_wa($row->id, $row->gsm, $customer->nama, 'bit.ly/crtelkom');
                            }
                            break;
                        case 3:
                            if ($row->email) {
                                $return = $this->blast_email($row->id, $row->email, 'bit.ly/crtelkom');
                            }
                            break;
                    }
                    $data_update = array("status_send" => $return);
                    $param_update = array("id" => $row->id);
                    $update_status = $this->Dapros->edit($param_update, $data_update);
                    if ($update_status) {
                        $get_status = $this->Dim_status->get_row(array("status_value" => $return));

                        $data_input = array(
                            'cat_key' => 2,
                            'customer_key' => $row->customer_key,
                            'channel_key' => $row->channel_key,
                            'status_key' => $get_status->status_key,
                            'layanan_key' => '1',
                            'regional_key' => $customer->regional_key,
                            'date_key' => $this->Dim_date->get_row(array('date_value' => date("Y-m-d")))->date_key,
                            // 'time_key' => $this->Dim_time->get_row(array('time_value' => date("H:i")))->time_key,
                            'biling_value' => $row->biling,
                            'periode_key' => $this->Dim_periode->get_row(array('periode_value' => $row->periode))->periode_key,
                        );
                        $this->Fact_interaction->add($data_input);
                        $return = $row->customer_key . ' : Interaction Success!'.$row->id;
                    }
                }
            }
        }
        $response = json_encode($return);
        echo $response;
    }
    function blast_email($id = false, $email = false, $message)
    {
        $return = 'Gagal';
        if ($id) {
            $curl = curl_init();
            $url = "http://10.194.194.251/digital_media_profiling/index.php/api/send/email";
            $arr = [
                "email" => 'ahmadsadikin8888@gmail.com',
                // "email" => $email,
                "subject" => "billco",
                "message" => $message
            ];
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
            $arr = [
                // "number" => $number,
                "number" => '081221609591',
                "template" => "billco_7",
                "param1" => $nama,
                "param2" => $link
            ];
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
}
