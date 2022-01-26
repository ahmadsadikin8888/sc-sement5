<?php
defined('BASEPATH') or exit('No direct script access allowed');

class SmartCollection extends CI_Controller
{

	private $log_key, $log_temp, $title;
	public function __construct()
	{
		parent::__construct();
		//Do your magic here
		$this->load->model('Dashboard/SmartCollectionModel');
		$this->load->model('Custom_model/Fact_interaction_model', 'fact_interaction');
		$this->load->model('Custom_model/Data_lead_model', 'data_lead');
		// $this->load->model('Custom_model/Ideasdb_model', 'ideasdb');
	}


	public function index()
	{
		$curdate = date('Y-m-d', strtotime("2021-03-01"));
		$getDateData = $this->SmartCollectionModel->get_date_data($curdate);
		$data = array(
			'title_page_big'		=> 'Dashboard Monitoring Smart Collection',
			'title'					=> $this->title,
			'total_order_by_channel' => $this->SmartCollectionModel->get_total_order_by_channel_and_status_today($getDateData[0]['date_value']),
			'total_order_by_regional' => $this->SmartCollectionModel->get_total_order_by_regional_and_status_today($getDateData[0]['date_value']),
			'summary_order' => $this->SmartCollectionModel->get_summary_order_today($getDateData[0]['date_value']),
			'summary_unique_customer' => $this->SmartCollectionModel->get_summary_unique_customer_today($getDateData[0]['date_value']),
			'summary_success_by_channel' => $this->SmartCollectionModel->get_summary_success_by_channel_today($getDateData[0]['date_value']),
			'summary_order_by_unique_customer' => $this->SmartCollectionModel->get_summary_order_by_unique_customer_today($getDateData[0]['date_value']),
		);
		$data['controller'] = $this;
		$data['pencairan_h1'] = $this->SmartCollectionModel->get_total_pencairan_filter_by_date(date_format(date_sub(date_create($getDateData[0]['date_value']), date_interval_create_from_date_string('1 days')), "Y-m-d"), $getDateData[0]['date_value']);
		$data['pencairan_seminggu'] = $this->SmartCollectionModel->get_total_pencairan_filter_by_date(date_format(date_sub(date_create($getDateData[0]['date_value']), date_interval_create_from_date_string('7 days')), "Y-m-d"), $getDateData[0]['date_value']);
		$data['pencairan_sebulan'] = $this->SmartCollectionModel->get_total_pencairan_filter_by_date(date('Y-m-01', strtotime($getDateData[0]['date_value'])), date('Y-m-t', strtotime($getDateData[0]['date_value'])));

		$data['perstatus'] = $this->data_lead->live_query("
		SELECT send_status,count(id) as order_data FROM data_lead GROUP BY send_status
		")->result();
		$data['order_status'] = array();
		if (count($data['perstatus']) > 0) {
			foreach ($data['perstatus'] as $rc) {
				if ($rc->send_status == "") {
					$data['order_status']['order'] = $rc->order_data;
				} else {
					$data['order_status'][$rc->send_status] = $rc->order_data;
				}
				$data['order_status']['all'] = $rc->order_data + $data['order_status']['all'];
			}
		}
		$data['perchannel'] = $this->data_lead->live_query("
		SELECT channel,count(id) as order_data FROM data_lead GROUP BY channel
		")->result();
		$data['order_channel'] = array();
		$data['perchannel_summary'] = $this->data_lead->live_query("
		SELECT channel,send_status,count(id) as order_data FROM data_lead GROUP BY channel,send_status
		")->result();
		if (count($data['perchannel_summary']) > 0) {
			foreach ($data['perchannel_summary'] as $rc) {
				if ($rc->send_status == "") {
					$data['order_channel'][$rc->channel]['order'] = $rc->order_data;
				} else {
					$data['order_channel'][$rc->channel][$rc->send_status] = $rc->order_data;
				}
			}
		}

		$data['order_regional'] = array();
		$data['regional_summary'] = $this->data_lead->live_query("
		SELECT regional,send_status,count(id) as order_data FROM data_lead GROUP BY regional,send_status
		")->result();
		if (count($data['regional_summary']) > 0) {
			foreach ($data['regional_summary'] as $rc) {

				if ($rc->send_status == "") {
					$data['order_regional']["treg_" . $rc->regional]['order'] = $rc->order_data;
				} else {
					$data['order_regional']["treg_" . $rc->regional][$rc->send_status] = $rc->order_data;
				}
			}
		}

		$data['status_lancar'] = $this->data_lead->live_query('
		SELECT IF( DAY(blast_date) < 20, "Lancar", "Tidak Lancar" )
		AS label
	   , COUNT(*) AS count_status
	   , SUM(tagihan) AS sum_tagihan FROM data_lead GROUP BY label
		')->result();
		$data['data_lancar'] = array();
		if (count($data['status_lancar']) > 0) {
			foreach ($data['status_lancar'] as $rc) {
				$data['data_lancar'][$rc->label]['count_status'] = $rc->count_status;
				$data['data_lancar'][$rc->label]['sum_tagihan'] = $rc->sum_tagihan;
			}
		}

		$this->load->view('Dashboard/SmartCollection', $data);
	}
	function wallboard_obc()
	{
		$this->load->view('Dashboard/wallboard_obc');
	}
	function get_datawallboard()
	{
		$now=date('Y-m-d');
		$data = $this->data_lead->live_query("SELECT ast.agent_status,a.nama,a.picture,mp.username,TIMEDIFF(SYSDATE(),ast.last_update) AS last_exec,sysdate() as skrg FROM sys_user a LEFT JOIN agent_status as ast ON ast.userid = a.id LEFT JOIN maping_eyebeam as mp ON mp.user_id = a.id WHERE ast.agent_status <> '' AND DATE(last_update) = '$now'")->result_array();

		foreach ($data as $row) {
			@extract($row);
			$no++;
			if ($agent_status == "") {
				$alert = "default";
			} else if ($agent_status == "Ready") {

				$x_time = strtotime($skrg) - strtotime($LUP);
				// if ($x_time > 300) {
				// 	if ($x_time > 600) {
				// 		$alert = "danger";
				// 	} else {
				// 		$alert = "warning";
				// 	}
				// } else {
				$alert = "success";
				// }
			} else {
				$alert = "danger";
			}
			// $alert = "warning";
			// if (file_exists("http://10.60.175.132/ideas_new_pds_ok/wall_agent/foto/$USERNAME.jpg")) {
			$foto = base_url() . "YbsService/get_foto_agent/" . $picture;
			// } else {
			// 	$foto = "http://10.60.175.132/ideas_new_pds_ok/wall_agent/foto/default.jpg";
			// }



			// $NAME = explode(" ", $NAME);
			// if (strlen($NAME[0]) < 3) {
			$nama_ = $nama . " " . $username;
			// } else {
			// 	$nama = $NAME[0];
			// }

			$list_user .= ",{\"username\" : \"$nama_\", \"login_user\" : \"$username - $LOGINID\", \"dial_mode\" : \"$DIAL_MODE\", \"agent_status\" : \"$agent_status\", \"extension\" : \"$LOGINID\",  \"tot_call\" : \"$tot_call\", \"last_exec\" : \"$last_exec\", \"foto\" : \"$foto\", \"alert\" : \"$alert\"}";
		}

		echo "[" . substr($list_user, 1, strlen($list_user)) . "]";
	}
	function get_totalwallboard()
	{
		$now=date('Y-m-d');
		$data = $this->data_lead->live_query("SELECT agent_status,count(*) as total FROM agent_status WHERE DATE(last_update) = '$now' GROUP BY agent_status ")->result_array();


		$user_offline = "0";
		$user_idle = "0";
		$user_ready = "0";
		$user_online = "0";
		$user_aux = "0";

		//echo $user;
		foreach ($data as $row) {
			@extract($row);
			$no++;

			if ($agent_status == "") {
				$user_offline = $total;
			} else if ($agent_status == "Idle") {
				$user_idle = $total;
			} else if ($agent_status == "Ready") {
				$user_ready = $total;
			} else if ($agent_status == "Offline") {
				$user_offline = $total;
			} else {
				$user_aux = $total;
			}
			$user_online = $user_online + $total;
		}
		$result = $this->data_lead->live_query("SELECT COUNT(*) AS contacted FROM trans WHERE STATUS_CALL=1")->row_array();

		@extract($result);


		$list_user = "{\"user_offline\" : \"$user_offline\",\"user_aux\" : \"$user_aux\", \"user_idle\" : \"$user_idle\", \"user_ready\" : \"$user_ready\", \"user_online\" : \"$user_online\",  \"tot_call\" : \"$contacted\"}";
		echo $list_user;
	}
	function summary_template()
	{
		$this->load->view('Dashboard/index-dashboard');
	}
	public function perfomance()
	{
		if (isset($_POST['template'])) {
			$sel_template = $this->input->post('template');
			$sel_date = $this->input->post('datena');
		} else {
			$sel_template = 'daily';
			$sel_date = date('Y-m-d');
		}

		$data = array(
			'title_page_big'		=> 'Dashboard Performance Smart Collection',
			'title'					=> $this->title,
			'sel_date'				=> $sel_date,
			'sel_template'			=> $sel_template,
		);
		$data['controller'] = $this;
		// load query dan tampung ke data
		$getDateData = $this->SmartCollectionModel->get_date_data($sel_date);
		$l_date = date('Y-m-d', strtotime($getDateData[0]['date_value']));
		switch ($sel_template) {
			case 'monthly':
				$f_date = date('Y-m-01', strtotime($getDateData[0]['date_value']));
				// $l_date = date('Y-m-t', strtotime($getDateData[0]['date_value']));
				break;
			case 'weekly':
				$f_date = date_format(date_sub(date_create($l_date), date_interval_create_from_date_string("7 days")), 'Y-m-d');
				// $l_date = date('Y-m-d', strtotime($getDateData[0]['date_value']));
				break;
			case 'daily':
				$f_date = date('Y-m-d', strtotime($getDateData[0]['date_value']));
				// $l_date = date('Y-m-d', strtotime($getDateData[0]['date_value']));
				break;
			default:
				$f_date = date('Y-m-d', strtotime($getDateData[0]['date_value']));
				// $l_date = date('Y-m-d', strtotime($getDateData[0]['date_value']));
				break;
		}

		$data['summary_order_by_date'] = $this->SmartCollectionModel->get_summary_order_by_date($f_date, $l_date);
		$data['summary_unique_customer_by_date'] = $this->SmartCollectionModel->get_summary_unique_customer_by_date($f_date, $l_date);
		$data['summary_payment_by_regional'] = $this->SmartCollectionModel->get_summary_payment_by_regional($f_date, $l_date);
		// Perilakuan Khusus untuk Summary Order by Date Chart
		if ($sel_template == 'daily') {
			$f_date = date_format(date_sub(date_create($l_date), date_interval_create_from_date_string("1 months")), 'Y-m-d');
		}
		$data['summary_order_by_date_chart'] = $this->SmartCollectionModel->get_summary_order_by_date_chart($f_date, $l_date);

		$this->load->view('Dashboard/SmartCollection_Perfomance', $data);
	}
}

/* End of file smartCollection.php */
/* Location: ./application/controllers/smartCollection.php */