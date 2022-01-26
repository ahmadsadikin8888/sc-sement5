<?php

defined('BASEPATH') or exit('No direct script access allowed');

// This can be removed if you use __autoload() in config.php OR use Modular Extensions
/** @noinspection PhpIncludeInspection */
require APPPATH . '/libraries/REST_Controller.php';

// use namespace
use Restserver\Libraries\REST_Controller;

/**
 * This is an example of a few basic user interaction methods you could use
 * all done with a hardcoded array
 *
 * @package         CodeIgniter
 * @subpackage      Rest Server
 * @category        Controller
 * @author          Phil Sturgeon, Chris Kacerguis
 * @license         MIT
 * @link            https://github.com/chriskacerguis/codeigniter-restserver
 */
class Cdr extends REST_Controller
{

    function __construct()
    {
        // Construct the parent class
        parent::__construct();
        $this->load->model('Cdr/Cdr_model', 'cdr_model');
        // Configure limits on our controller methods
        // Ensure you have created the 'limits' table and enabled 'limits' within application/config/rest.php
        // $this->methods['users_get']['limit'] = 500; // 500 requests per hour per user/key
        // $this->methods['users_post']['limit'] = 100; // 100 requests per hour per user/key
        // $this->methods['users_delete']['limit'] = 50; // 50 requests per hour per user/key
    }

    public function readCdr_get()
    {
        $response = $this->cdr_model->read_cdr();
        if ($response) {
            $this->response($response, REST_Controller::HTTP_OK);
        } else {
            $this->response([
                'status' => FALSE,
                'message' => 'No response were found'
            ], REST_Controller::HTTP_NOT_FOUND);
        }
    }

    public function createCdr_post()
    {
        // $this->some_model->update_user( ... );
        // $message = [
        //     'id' => 100, // Automatically generated by the model
        //     'name' => $this->post('name'),
        //     'email' => $this->post('email'),
        //     'message' => 'Added a resource'
        // ];
        $call_id = $_POST['call_id'];
        $starttime = $_POST['starttime'];
        $transtime = $_POST['transtime'];
        $endtime = $_POST['endtime'];
        $queue = $_POST['queue'];
        $exten = $_POST['exten'];
        $outbound_cid = $_POST['outbound_cid'];
        $dst = $_POST['dst'];
        $duration = $_POST['duration'];
        $billsec = $_POST['billsec'];
        $a_status = $_POST['exten'];
        $b_status = $_POST['b_status'];
        $pbx_domain = $_POST['pbx_domain'];
        $recordingfile = $_POST['recordingfile'];
        // $image = '';
        $response = $this->cdr_model->create_cdr($call_id, $starttime, $transtime, $endtime, $queue, $exten, $outbound_cid, $dst, $duration, $billsec, $a_status, $b_status, $pbx_domain, $recordingfile);
        // var_dump($response);
        //var_dump($this->cdr_model->read_cdr());
        $this->response($response, REST_Controller::HTTP_CREATED);
        // $this->send_status($_POST['exten'], "pause", "aux");
        // $this->set_response($message, REST_Controller::HTTP_CREATED); // CREATED (201) being the HTTP response code
    }
    function send_status($ext, $status = "pause", $reason = "aux")
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://infrix-pds1.infomedia.co.id/infra/api/pause.php',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_SSL_VERIFYHOST => false,
            CURLOPT_POSTFIELDS => '{
              "method" : "' . $status . '",
              "exten" : "' . $ext . '",
              "queue" : "303",
              "tenant" : "fbcc03",
              "reason" : "' . $reason . '"
            }',
            CURLOPT_HTTPHEADER => array(
                'Authorization: Basic ZmJjYzAzOjFuZjBtZWRpQA==',
                'Content-Type: application/json'
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        $response = json_decode($response);
        // echo var_dump($response);
    }

    public function updateCdr_post()
    {
        // $this->some_model->update_user( ... );
        // $message = [
        //     'id' => 100, // Automatically generated by the model
        //     'name' => $this->post('name'),
        //     'email' => $this->post('email'),
        //     'message' => 'Added a resource'
        // ];
        $call_id = $_POST['call_id'];
        $starttime = $_POST['starttime'];
        $transtime = $_POST['transtime'];
        $endtime = $_POST['endtime'];
        $queue = $_POST['queue'];
        $exten = $_POST['exten'];
        $outbound_cid = $_POST['outbound_cid'];
        $dst = $_POST['dst'];
        $duration = $_POST['duration'];
        $billsec = $_POST['billsec'];
        $a_status = $_POST['exten'];
        $b_status = $_POST['b_status'];
        $pbx_domain = $_POST['pbx_domain'];
        $recordingfile = $_POST['recordingfile'];
        // $image = '';
        $response = $this->cdr_model->update_cdr($call_id, $starttime, $transtime, $endtime, $queue, $exten, $outbound_cid, $dst, $duration, $billsec, $a_status, $b_status, $pbx_domain, $recordingfile);
        // var_dump($response);
        //var_dump($this->cdr_model->read_cdr());
        $this->response($response, REST_Controller::HTTP_CREATED);
        // $this->set_response($message, REST_Controller::HTTP_CREATED); // CREATED (201) being the HTTP response code
    }

    public function deleteCdr_post()
    {
        //$id = (int) $this->get('id');

        $call_id = $_POST['call_id'];
        $response = $this->cdr_model->delete_cdr($call_id);

        if ($response['error']) {
            $this->response($response, REST_Controller::HTTP_BAD_REQUEST); // BAD_REQUEST (400) being the HTTP response code
        } else {
            $message = [
                'id' => $call_id,
                'message' => 'Deleted the resource'
            ];

            $this->response($message, REST_Controller::HTTP_OK); // NO_CONTENT (204) being the HTTP response code     
        }
    }
}