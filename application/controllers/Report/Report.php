<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Report extends CI_Controller
{
	private $log_key, $log_temp, $title;
	function __construct()
	{
		parent::__construct();
		$this->load->model('Custom_model/Sys_user_table_model', 'sys_user');
		$this->load->model('Custom_model/History_call_model', 'history_call');
		$this->load->model('Custom_model/Trans_model', 'trans');
	}




	////render by ajax
	public function index()
	{
		$data = array(
			'title_page_big'		=> 'Report Call',
			'title'					=> $this->title,
		);
		$data['controller'] = $this;
		if (isset($_GET['start']) && isset($_GET['end'])) {
			$start_filter = $_GET['start'];
			$end_filter = $_GET['end'];
		}

		$this->template->load('Report/general', $data);
	}
	public function dashboard()
	{
		$data = array(
			'title_page_big'		=> 'Report Call',
			'title'					=> $this->title,
		);
		$data['controller'] = $this;
		if (isset($_GET['start']) && isset($_GET['end'])) {
			$start_filter = $_GET['start'];
			$end_filter = $_GET['end'];
		}

		$this->load->view('Report/sc_dashboard', $data);
	}
	public function report_call()
	{
		$data = array(
			'title_page_big'		=> 'Report Blast',
			'title'					=> $this->title,
		);
		$data['controller'] = $this;
		if (isset($_GET['start']) && isset($_GET['end'])) {
			$start_filter = $_GET['start'];
			$end_filter = $_GET['end'];
			$data['call_history'] = $this->history_call->live_query("
				SELECT b.`channel_value`, c.`status_value`, d.`layanan_value`, e.`regional_value`, f.`witel_value`, g.`site_value`
				FROM 
				fact_interaction a, dim_channel b, dim_status c, dim_layanan d, dim_regional e, dim_witel f, dim_site g, dim_date h
				where
				a.`channel_key` = b.`channel_key`
				and a.`status_key` = c.`status_key`
				and a.`layanan_key` = d.`layanan_key`
				and a.`regional_key` = e.`regional_key`
				and a.`witel_key` = f.`witel_key`
				and a.`site_key` = g.`site_key`
				and a.`date_key` = h.`date_key`
			")->result();
		}

		$this->template->load('Report/general', $data);
	}
	public function report_channel()
	{
		$data = array(
			'title_page_big'		=> 'Report Channel',
			'title'					=> $this->title,
		);
		$data['controller'] = $this;
		if (isset($_GET['start']) && isset($_GET['end'])) {
			$start_filter = $_GET['start'];
			$end_filter = $_GET['end'];
			$where_channel="";
			$where_reg="";
			if(isset($_GET['channel']) && $_GET['channel'] != ""){
				$ch=$_GET['channel'];
				$where_channel=" AND b.channel_value = '$ch'";
			}
			if(isset($_GET['regional']) && $_GET['regional'] != ""){
				$ch=$_GET['regional'];
				$where_reg=" AND e.regional_value = '$ch'";
			}
			$data['call_history'] = $this->history_call->live_query("
				SELECT b.`channel_value`, c.`status_value`, e.`regional_value`, COUNT(1) AS total
				FROM 
				fact_interaction a, dim_channel b, dim_status c, dim_regional e
				WHERE
				a.`channel_key` = b.`channel_key`
				AND a.`status_key` = c.`status_key`
				AND a.`regional_key` = e.`regional_key`
				$where_channel
				$where_reg
				GROUP BY b.`channel_value`, c.`status_value`, e.`regional_value`
			")->result();
		}

		$this->template->load('Report/channel', $data);
	}
};
