<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Payment extends CI_Controller
{

    // function __construct()
    // {
    // 	parent::__construct();
    // 	$this->load->model('Channel/Channel_model', 'channel_model');
    // }

    public function index()
    {




        $this->load->view('Payment/payment_view', $data);
    }

    public function insert()
    {
        $dbLead = $this->load->database('default', TRUE);
        $data_lead = $dbLead->get('data_lead')->result_array();
        if (count($data_lead) > 0) {
            foreach ($data_lead as $dl) {
                $snd = $dl['no_speedy'];
                $ncli = $dl['ncli'];
                $no_pstn = $dl['no_pstn'];
                $nama = $dl['nama_pelanggan'];
                $payment = $this->get_payment($snd);
                if ($payment > 0) {
                    foreach ($payment as $payment) {
                        $date = date('Y-m-d', strtotime($payment->PAYMENT_DATE));
                        $tahun = date('Y', strtotime($payment->PAYMENT_DATE));
                        $bulan = date('m', strtotime($payment->PAYMENT_DATE));
                        $tanggal = date('d', strtotime($payment->PAYMENT_DATE));

                        $data = array(
                            'no_internet' => $snd,
                            'ncli' => $ncli,
                            'no_pstn' => $no_pstn,
                            'nama' => $nama,
                            'periode' => $payment->ZZNPER,
                            'date' => $date,
                            'tahun' => $tahun,
                            'bulan' => $bulan,
                            'hari' => $tanggal,
                            'billing' => intval($payment->NAMOUNT)
                        );

                        $get = $dbLead->get_where('payment', array('periode' => $payment->ZZNPER, 'no_internet' => $snd))->result_array();

                        if (count($get) == 0) {
                            $dbLead->insert('payment', $data);
                        }
                    }
                }
            }
        }
    }
    public function get_tokenpayment()
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://apigwsit.telkom.co.id:7777/invoke/pub.apigateway.oauth2/getAccessToken",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => '{
                "grant_type": "client_credentials",
                "client_id": "d6520459-9e03-4dfb-814b-d8740b2a48cc",
                "client_secret":"2a7411ff-0c4e-49ec-9858-b45e8c09912b"
            }',
            CURLOPT_HTTPHEADER => array(
                "cache-control: no-cache",
                'Content-Type: application/json',
                "postman-token: 7be6d429-43ee-cd2c-61dc-3d36c10f72dc"
            ),
        ));

        $response = curl_exec($curl);
        $response = json_decode($response);
        return $response->access_token;
    }
    public function get_payment($nd)
    {
        $curl = curl_init();
        $token = $this->get_tokenpayment();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://apigwsit.telkom.co.id:7777/gateway/telkom-trems-tagihan/1.0/infoTagihan",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => '{
                "ND": "' . $nd . '"
            }',
            CURLOPT_HTTPHEADER => array(
                "cache-control: no-cache",
                'Content-Type: application/json',
                "postman-token: 7be6d429-43ee-cd2c-61dc-3d36c10f72dc",
                "Authorization: Bearer $token"
            ),
        ));

        $response = curl_exec($curl);
        $response = json_decode($response);
        if ($response->SUMMARY_BILLING) {
            return $response->SUMMARY_BILLING;
        } else {
            return 'cURL Error';
        }
    }
}
