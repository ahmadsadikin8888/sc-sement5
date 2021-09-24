<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{



	public function index()

	{
		$curdate = date("Ym");
		$data['sms'] = $this->sms($curdate);
		$data['wa'] = $this->wa($curdate);
		$data['tvms'] = $this->tvms($curdate);
		$data['ovr'] = $this->ovr($curdate);
		$data['email'] = $this->email($curdate);
		$data['regional'] = $this->regional($curdate);
		$data['toto'] = $data['sms']['order'] + $data['wa']['order'] + $data['tvms']['order'] + $data['ovr']['order'] + $data['email']['order'];
		$data['totrp'] = $data['sms']['rp'] + $data['wa']['rp'] + $data['tvms']['rp'] + $data['ovr']['rp'] + $data['email']['rp'];
		$data['totd'] = $data['sms']['deliver'] + $data['wa']['deliver'] + $data['tvms']['deliver'] + $data['ovr']['deliver'] + $data['email']['deliver'];
		$data['totu'] = $data['sms']['undeliver'] + $data['wa']['undeliver'] + $data['tvms']['undeliver'] + $data['ovr']['undeliver'] + $data['email']['undeliver'];
		$data['tott'] = $data['sms']['tagihan'] + $data['wa']['tagihan'] + $data['tvms']['tagihan'] + $data['ovr']['tagihan'] + $data['email']['tagihan'];

		$this->load->view('Dashboard/index', $data);
	}
	public function regional($curdate)
	{
		$data = array();
		$qowa = $this->db->query("SELECT REGIONAL as rg, COUNT(*) as jml FROM p_dunning_wa WHERE PERIODE='$curdate' GROUP BY rg")->result();
		$qosms = $this->db->query("SELECT REGIONAL as rg, COUNT(*) as jml FROM dapros_sms WHERE PERIODE='$curdate' group by rg")->result();
		$qotvms = $this->db->query("SELECT regional as rg, COUNT(*) as jml FROM dapros_tvms WHERE periode='$curdate'  group by rg")->result();
		$qoovr = $this->db->query("SELECT REGIONAL as rg, COUNT(*) as jml FROM dapros_ovr WHERE PERIODE='$curdate' group by rg")->result();
		$qoemail = $this->db->query("SELECT regional as rg, COUNT(*) as jml FROM dapros_email WHERE periode='$curdate'  group by rg")->result();

		foreach ($qowa as $qowad) {
			$data['wa'][$qowad->rg] = $qowad->jml;
		}
		foreach ($qosms as $qosmsd) {
			$data['sms'][$qosmsd->rg] = $qowad->jml;
		}
		foreach ($qotvms as $qotvmsd) {
			$data['tvms'][$qotvmsd->rg] = $qotvmsd->jml;
		}
		foreach ($qoovr as $qoovrd) {
			$data['ovr'][$qoovrd->rg] = $qoovrd->jml;
		}
		foreach ($qoemail as $qoemaild) {
			$data['email'][$qoemaild->rg] = $qoemaild->jml;
		}
		$reg = array('JAKARTA', 'JAWA BARAT', 'JAWA TENGAH', 'JAWA TIMUR', 'KALIMANTAN', 'KTI', 'SUMATRA');
		

		return $data;
	}
	public function wa($curdate)
	{
		$qo = $this->db->query("SELECT COUNT(*) as odwa FROM p_dunning_wa WHERE PERIODE='$curdate'")->row()->odwa;
		$qt = $this->db->query("SELECT SUM(TAGIHAN) as tagihan FROM p_dunning_wa WHERE PERIODE='$curdate'")->row()->tagihan;
		$qd = $this->db->query("SELECT COUNT(*) as deliv FROM p_dunning_wa WHERE PERIODE='$curdate' AND DATE_DELIVER IS NOT NULL")->row()->deliv;
		$rp = $this->db->query("SELECT SUM(rp_bayar) as rp FROM p_dunning_wa WHERE PERIODE='$curdate'")->row()->rp;

		$data['order'] = $qo;
		$data['deliver'] = $qd;
		$data['tagihan'] = $qt;
		$data['rp'] = $rp;
		$data['undeliver'] = $data['order'] - $data['deliver'];
		$data['progress'] = ($data['deliver'] / $data['order']) * 100;
		return $data;
	}
	public function sms($curdate)
	{
		$qo = $this->db->query("SELECT COUNT(*) as odsms FROM dapros_sms WHERE PERIODE='$curdate'")->row()->odsms;
		$qt = $this->db->query("SELECT SUM(tagihan) as tagihan FROM dapros_sms WHERE PERIODE='$curdate'")->row()->tagihan;
		$qd = $this->db->query("SELECT COUNT(*) as deliver FROM dunning_sms WHERE periode='$curdate'")->row()->deliver;
		$qp = $this->db->query("SELECT COUNT(*) as payment FROM dunning_sms WHERE periode='$curdate' AND rp_bayar is not null")->row()->payment;
		$rp = $this->db->query("SELECT SUM(rp_bayar) as rp FROM dunning_sms WHERE periode='$curdate' AND rp_bayar is not null")->row()->rp;
		$data['order'] = $qo;
		$data['deliver'] = $qd;
		$data['payment'] = $qp;
		$data['rp'] = $rp;
		$data['tagihan'] = $qt;
		$data['undeliver'] = $data['order'] - $data['deliver'];
		$data['progress'] = ($data['deliver'] / $data['order']) * 100;
		return $data;
	}
	public function tvms($curdate)
	{
		$qo = $this->db->query("SELECT COUNT(*) as odtvms FROM dapros_tvms WHERE periode='$curdate'")->row()->odtvms;
		$qt = $this->db->query("SELECT SUM(tagihan) as tagihan FROM dapros_tvms WHERE periode='$curdate'")->row()->tagihan;
		$qd =  $this->db->query("SELECT COUNT(*) as deliver FROM tvms_broadcast WHERE periode='$curdate'")->row()->deliver;
		$qp =  $this->db->query("SELECT COUNT(*) as payment FROM tvms_broadcast WHERE periode='$curdate' and rp_bayar is not null")->row()->payment;
		$rp =  $this->db->query("SELECT SUM(rp_bayar) as rp FROM tvms_broadcast WHERE periode='$curdate' and rp_bayar is not null")->row()->rp;

		$data['order'] = $qo;
		$data['deliver'] = $qd;
		$data['payment'] = $qp;
		$data['tagihan'] = $qt;
		$data['rp'] = $rp;
		$data['undeliver'] = $data['order'] - $data['deliver'];
		$data['progress'] = ($data['deliver'] / $data['order']) * 100;
		return $data;
	}
	public function ovr($curdate)
	{
		$qo = $this->db->query("SELECT COUNT(*) as odovr FROM dapros_ovr WHERE PERIODE='$curdate'")->row()->odovr;
		$qt = $this->db->query("SELECT SUM(saldo) as tagihan FROM dapros_ovr WHERE PERIODE='$curdate'")->row()->tagihan;
		$qd = $this->db->query("SELECT COUNT(*) as deliver FROM dunning_ovr WHERE dialstatus='$curdate' AND dialstatus='ANSWER'")->row()->deliver;
		$qp = $this->db->query("SELECT COUNT(*) as payment FROM dunning_ovr WHERE dialstatus='$curdate' AND dialstatus='ANSWER' AND rp_bayar is not null")->row()->payment;
		$rp = $this->db->query("SELECT SUM(rp_bayar) as rp FROM dunning_ovr WHERE dialstatus='$curdate' AND dialstatus='ANSWER' AND rp_bayar is not null")->row()->rp;

		$data['order'] = $qo;
		$data['deliver'] = $qd;
		$data['payment'] = $qp;
		$data['tagihan'] = $qt;
		$data['rp'] = $rp;
		$data['undeliver'] = $data['order'] - $data['deliver'];
		$data['progress'] = ($data['deliver'] / $data['order']) * 100;
		return $data;
	}
	public function email($curdate)
	{
		$qo = $this->db->query("SELECT COUNT(*) as odemail FROM dapros_email WHERE periode='$curdate'")->row()->odemail;
		$qt = $this->db->query("SELECT SUM(tagihan) as tagihan FROM dapros_email WHERE periode='$curdate'")->row()->tagihan;
		$qd =  $this->db->query("SELECT COUNT(*) as deliver FROM dunning_email WHERE date(date_process)='$curdate' AND note='Message has been sent'")->row()->deliver;
		$qp =  $this->db->query("SELECT COUNT(*) as payment FROM dunning_email WHERE date(date_process)='$curdate' AND note='Message has been sent' AND rp_bayar IS NOT NULL")->row()->payment;
		$rp =  $this->db->query("SELECT SUM(rp_bayar) as rp FROM dunning_email WHERE date(date_process)='$curdate' AND note='Message has been sent' AND rp_bayar IS NOT NULL")->row()->rp;

		$data['order'] = $qo;
		$data['deliver'] = $qd;
		$data['deliver'] = $qp;
		$data['tagihan'] = $qt;
		$data['rp'] = $rp;
		$data['undeliver'] = $data['order'] - $data['deliver'];
		$data['progress'] = ($data['deliver'] / $data['order']) * 100;
		return $data;
	}
}
