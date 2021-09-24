<?php
require APPPATH . '/controllers/ebs_indihome/Ebs_indihome_config.php';

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Engine extends CI_Controller
{
	private $log_key, $log_temp, $title;
	function __construct()
	{
		parent::__construct();
		$this->load->model('blast/data_blast');
	}

	public function index()
	{
	}

	public function blast_sms()
	{
		date_default_timezone_set('Asia/Jakarta');
		$tgl   = date('Y-m-d H:i:s');
		$tgl2  = date('YmdHis');
		$token = $this->cek_token();
		$data  = $this->data_blast->get_data_sms();
		$nomor = '081319604983';
		//echo $data;
		$data = json_decode($data, true);
		foreach ($data as $keys) {
			$cca       = $keys['CCA'];
			$snd       = $keys['SND'];
			$notel     = $keys['NO_GSM'];
			$tagihan   = $keys['TAGIHAN'];
			$periode   = $keys['PERIODE'];
			$tgl_input = $keys['TGL_INPUT'];
			$pesan     = $keys['pesan'];
			$mdn       = $this->hp($nomor);
			$tagihan   = number_format($tagihan, 0, ",", ".");
			$messageText = str_replace('$bulan', $periode, $pesan);
			$messageText2 = str_replace('$jml_tagihan', $tagihan, $messageText);
			$messageText3 = str_replace('$nomor', $snd, $messageText2);

			$hasil = $this->data_blast->save_hasil($cca, $snd, $notel, $tagihan, $periode);
			echo $hasil;
			exit;

			$input = array(
				"content"  => $messageText3,
				"phone"    => $mdn,
				"schedule" => $tgl,
				"uid"      => $snd . $tgl2
			);

			$json_data = array($input);
			$jsons = json_encode(array("message" => $json_data));

			$url = 'https://smsturbo.infomedia.co.id:8106/HERMES.1/Message/restSaveSend';

			$headers = array(
				"Content-Type:application/json",
				"Authorization: Bearer " . $token
			);

			$curl = curl_init($url);
			curl_setopt($curl, CURLOPT_POST, true);
			curl_setopt($curl, CURLOPT_POSTFIELDS, $jsons);
			curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
			curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
			//$response = curl_exec($curl);


			if (!$response) {
				die('Error: "' . curl_error($curl) . '" - Code: ' . curl_errno($curl));
			} else {
				echo $response;
			}

			$sid = json_decode($response, true);

			if ($sid['data']['message'] == '1') {
				foreach ($sid['data']['list'] as $key) {
					$sid = $key['id'];
					$result = 'SUCCESS';
				}
			} else {
				$sid = '0';
				$result = 'FAILED';
			}
		}
	}

	public function blast_email()
	{
		$data  = $this->data_blast->get_data_email();
		echo $data;

		$url = "http://10.60.175.132/dev_bill/app/send_duningemail_dev.php";

		$input = array(
			"id"       => "85757526",
			"kepada"   => 'agusafrilusputra@gmail.com',
			"template" => '50'
		);

		$curl = curl_init($url);
		curl_setopt($curl, CURLOPT_POST, true);
		curl_setopt($curl, CURLOPT_POSTFIELDS, $input);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
		curl_setopt($curl, CURLOPT_HTTPHEADER, array(
			"Content-Type: application/x-www-form-urlencoded"
		));
		$response = curl_exec($curl);

		if (!$response) {
			die('Error: "' . curl_error($curl) . '" - Code: ' . curl_errno($curl));
		} else {
			echo $response;
		}
	}

	public function broadcast_worder_2()
	{
		$sender = '2';
		$this->broadcast_worder($sender);
	}

	public function broadcast_worder_3()
	{
		$sender = '3';
		$this->broadcast_worder($sender);
	}

	public function broadcast_worder($sender)
	{
		$this->benchmark->mark('code_start');
		$start_order = array();
		$response = $this->data_blast->get_campaign_id($sender);
		$j_response = count($response);
		if ($j_response >= 1) {
			$pcampaign_id = $response[0]->campaign_id;
		} else {
			$pcampaign_id = '';
		}
		if ($pcampaign_id != '') {
			$campaign_id = $pcampaign_id;
		} else {
			$response = $this->data_blast->get_id($sender);
			$campaign_id = $response['campaign_id'];
		}

		$cek_order = $this->data_blast->count_order($sender);
		$jml_order = $cek_order[0]->jml;

		if ($jml_order > 0) {
			$param_prd =  $this->data_blast->polling_order($sender);
		}

		//hitung order campaign_id
		$cek_campaign_id = $this->data_blast->count_campaign_id($sender);
		$jml_campaign_id = $cek_campaign_id[0]->jml;

		$part = ceil($jml_campaign_id / 2500);
		$i = 1;
		while ($i <= $part) {
			$this->get_broadcast($campaign_id, $sender);
			sleep(1);
			$i++;
		}
		// start_order
		$start_order['campaign_id'] = array();
		$start_order['campaign_id'] = $campaign_id;
		$_start_respone =  $this->data_blast->startorder($start_order);
		$msg = $_start_respone['msg'];
		$this->benchmark->mark('code_end');
		echo 'Result : ' . $campaign_id . ',' . $this->benchmark->elapsed_time('code_start', 'code_end');
	}

	public function get_broadcast($campaign_id, $sender)
	{
		$rest_order = $this->data_blast->get_order($sender);
		$data = array();
		var_dump($rest_order);
		$params = array();
		$input = array();
		$index = 0;
		foreach ($rest_order as $key) {
			$param = explode(',', $key->PARAM);
			$j_param = (count($param) - 1);
			for ($i = 0; $i <= $j_param; $i++) {
				$param_obj[$i + 1] = $key->{$param[$i]};
			}
			$params[$index] = $param_obj;
			array_push($input, array(
				'campaign_id' => $campaign_id,
				'session_id' => $key->SESSION_ID,
				'number' => $key->GSM,
				'indihome_number' => $key->SND,
				'regional' => $key->REGIONAL,
				'template_name' => $key->CAMPAIGN_NAME,
				'dept_id' => $key->GROUP_WA,
				'params' => $params[$index]
			));
			array_push($data, array('session_id' => $key->SESSION_ID, 'campaign_id' => $campaign_id));
		}

		$input = json_encode($input);
		echo $input;
		exit;

		$response_input = $this->data_blast->inputorder($input);
		if ($response_input['sts'] == '1') {
			$this->data_blast->update_campaign_id($data);
		} else {
			$this->data_blast->inputorder($input);
			$this->data_blast->update_campaign_id($data);
		}
	}

	public function cek_token()
	{
		$token    = $this->data_blast->get_token();
		//echo $token;
		//exit;
		$token    = json_decode($token, true);
		foreach ($token as $key) {
			$token = $key['token'];
		}
		//echo $token;
		//exit;
		if (empty($token)) {
			$data = array(
				"username" => "fbcc-idms",
				"password" => "wBbqP4aNNf"
			);
			$jsons = json_encode($data, true);

			$url = 'https://smsturbo.infomedia.co.id:8106/HERMES.1/Service/TokenRequest';

			$curl = curl_init($url);
			curl_setopt($curl, CURLOPT_POST, true);
			curl_setopt($curl, CURLOPT_POSTFIELDS, $jsons);
			curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
			curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
			$response = curl_exec($curl);
			if (!$response) {
				die('Error: "' . curl_error($curl) . '" - Code: ' . curl_errno($curl));
			} else {
				echo $response;
			}
			curl_close($curl);
			$token = json_decode($response, true);
			foreach ($token as $key) {
				$token = $key['token'];
			}
			$this->Broad_sms->save_token($token);
		} else {
			$token;
		}

		//echo $token;
		return $token;
	}

	function hp($nohp)
	{
		// kadang ada penulisan no hp 0811 239 345
		$nohp = str_replace(" ", "", $nohp);
		// kadang ada penulisan no hp (0274) 778787
		$nohp = str_replace("(", "", $nohp);
		// kadang ada penulisan no hp (0274) 778787
		$nohp = str_replace(")", "", $nohp);
		// kadang ada penulisan no hp 0811.239.345
		$nohp = str_replace(".", "", $nohp);

		// cek apakah no hp mengandung karakter + dan 0 - 9
		if (!preg_match('/[^+0-9]/', trim($nohp))) {
			// cek apakah no hp karakter 1 - 3 adalah + 62
			if (substr(trim($nohp), 0, 3) == '+62') {
				$hp = trim($nohp);
			}
			// cek apakah no hp karakter 1 adalah 0
			elseif (substr(trim($nohp), 0, 1) == '0') {
				$hp = '+62' . substr(trim($nohp), 1);
			}
		}
		return substr_replace($hp, '', 0, 1);
	}
};

/* END */
/* Mohon untuk tidak mengubah informasi ini : */
/* Generated by YBS CRUD Generator 2020-11-09 06:32:14 */
/* contact : YAP BRIDGING SYSTEM 		*/
/*			 bridging.system@gmail.com  */
/* 			 MAKASSAR CITY, INDONESIAN 	*/
