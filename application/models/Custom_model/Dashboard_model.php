<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Dashboard_model extends CI_Model
{
	public $id;
	function __construct()
	{
		parent::__construct();
	}

	public function get_kpi_sms($periode)
	{
		$pranpcdb = $this->load->database('idms', TRUE);
		$sql   = "
			SELECT MIN(tgl_kirim) as start, MAX(tgl_kirim) as end, COUNT(1) AS total FROM `dunning_sms`
            WHERE
			periode = $periode
            GROUP BY schedule_id
	";
		$query = $pranpcdb->query($sql);
		return $query->result();
	}

	public function get_kpi_email($periode)
	{
		$pranpcdb = $this->load->database('idms', TRUE);
		$sql   = "
			SELECT MIN(date_process) AS start, MAX(date_process) AS end, COUNT(1) AS total FROM `dunning_email`
			WHERE
			periode = $periode
			GROUP BY schedule_id
		";
		$query = $pranpcdb->query($sql);
		return $query->result();
	}

	public function get_kpi_ovr($periode)
	{
		$pranpcdb = $this->load->database('idms', TRUE);
		$sql   = "
			SELECT MIN(calldate) as start, MAX(calldate) as end, COUNT(1) AS total FROM `dunning_ovr`
			WHERE
			periode = $periode
			GROUP BY schedule_id
		";
		$query = $pranpcdb->query($sql);
		return $query->result();
	}

	public function get_kpi_tvms($periode)
	{
		$pranpcdb = $this->load->database('idms', TRUE);
		$sql   = "
			SELECT MIN(tgl_kirim) as start, MAX(tgl_kirim) as end, COUNT(1) AS total FROM `tvms_broadcast`
			WHERE
			periode = $periode
			GROUP BY id_schedule
		";
		$query = $pranpcdb->query($sql);
		return $query->result();
	}

	public function get_total($periode)
	{
		$pranpcdb = $this->load->database('idms', TRUE);
		$sql   = "
		select model,sum(jumlah_data) as total from `m_schedule`
		where
		periode = $periode
		GROUP BY model
		";
		$query = $pranpcdb->query($sql);
		return $query->result();
	}
};

/* END */
/* Mohon untuk tidak mengubah informasi ini : */
/* Generated by YBS CRUD Generator 2020-01-30 09:24:57 */
/* contact : YAP BRIDGING SYSTEM 		*/
/*			 bridging.system@gmail.com  */
/* 			 MAKASSAR CITY, INDONESIAN 	*/
