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
		$this->load->model('Custom_model/Ideasdb_model', 'ideasdb');
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

		$this->load->view('Dashboard/SmartCollection', $data);
	}
	function wallboard_obc()
	{
		$this->load->view('Dashboard/wallboard_obc');
	}
	function get_datawallboard()
	{
		$data = $this->ideasdb->live_query("SELECT a.USERNAME,a.NAME,a.DIAL_MODE,a.agent_status,a.LOGINID,a.LUP,TIMEDIFF(SYSDATE(),a.LUP) AS last_exec,sysdate() as skrg,a.DEPARTMENTID 
				FROM USERS a WHERE a.USERLEVEL='AGENT' AND a.STATUS='AKTIF' AND a.LOGINID!=''  AND a.DIAL_MODE='PDS' AND a.LOGINID IS NOT NULL ORDER BY a.NAME")->result_array();

		foreach ($data as $row) {
			@extract($row);
			$no++;
			if ($agent_status == "Off Line") {
				$alert = "default";
			} else if ($agent_status == "Idle") {
				$alert = "danger";
			} else if ($agent_status == "Ready") {

				$x_time = strtotime($skrg) - strtotime($LUP);
				if ($x_time > 300) {


					if ($x_time > 600) {
						$alert = "danger";
					} else {
						$alert = "warning";
					}
				} else {
					$alert = "success";
				}
			} else if ($agent_status == "Processing") {
				$alert = "success";
			} else if ($agent_status == "On Call") {
				$tTIme = strtotime($skrg) - strtotime($LUP);
				if ($tTIme > 300) {
					$alert = "danger";
				} else {
					$alert = "success";
				}
			}
			// $alert = "warning";
			// if (file_exists("http://10.60.175.132/ideas_new_pds_ok/wall_agent/foto/$USERNAME.jpg")) {
			$foto = "http://10.60.175.132/ideas_new_pds_ok/wall_agent/foto/$USERNAME.jpg";
			// } else {
			// 	$foto = "http://10.60.175.132/ideas_new_pds_ok/wall_agent/foto/default.jpg";
			// }



			$NAME = explode(" ", $NAME);
			if (strlen($NAME[0]) < 3) {
				$nama = $NAME[0] . " " . $NAME[1];
			} else {
				$nama = $NAME[0];
			}

			$list_user .= ",{\"username\" : \"$nama\", \"login_user\" : \"$USERNAME - $LOGINID\", \"dial_mode\" : \"$DIAL_MODE\", \"agent_status\" : \"$agent_status\", \"extension\" : \"$LOGINID\",  \"tot_call\" : \"$tot_call\", \"last_exec\" : \"$last_exec\", \"foto\" : \"$foto\", \"alert\" : \"$alert\"}";
		}

		echo "[" . substr($list_user, 1, strlen($list_user)) . "]";
	}
	function get_totalwallboard()
	{
		$data = $this->ideasdb->live_query("SELECT agent_status,COUNT(*) total 
		FROM USERS WHERE DIAL_MODE='PDS' 
		GROUP BY agent_status")->result_array();

		$user_offline = "0";
		$user_idle = "0";
		$user_ready = "0";
		$user_online = "0";

		//echo $user;
		foreach ($data as $row) {
			@extract($row);
			$no++;

			if ($agent_status == "Off Line") {
				$user_offline = $total;
			} else if ($agent_status == "Idle") {
				$user_idle = $total;
			} else if ($agent_status == "Ready") {
				$user_ready = $total;
			} else if ($agent_status == "On Call") {
				$user_online = $total;
			}
		}
		$result = $this->ideasdb->live_query("SELECT COUNT(DISTINCT trans_id) AS contacted FROM `LIST_CALL_LOG` WHERE status_call='CONTACTED'")->row_array();

		@extract($result);


		$list_user = "{\"user_offline\" : \"$user_offline\", \"user_idle\" : \"$user_idle\", \"user_ready\" : \"$user_ready\", \"user_online\" : \"$user_online\",  \"tot_call\" : \"$contacted\"}";
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