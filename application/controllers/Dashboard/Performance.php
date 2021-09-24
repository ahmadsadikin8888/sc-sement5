<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Performance extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
	}
	public function index()

	{
		if (isset($_GET['date'])) {
			$curdate = $_GET['date'];
		} else {
			$curdate = date("Y-m-d");
		}
		if (isset($_GET['periode'])) {
			if ($_GET['periode'] == 'Month') {
				$myDateTime = DateTime::createFromFormat('Y-m-d', $curdate);
				$curdate = $myDateTime->format('Ym');
				// $curdate = date_format($curdate, 'Ym');
				$jenis = "Month";
			} else {
				$curdate = explode('-', $curdate);
				$curdate = $curdate[0];
				$jenis = "Year";
			}
		} else {
			// $curdate = date_format($curdate, 'Ym');
			$curdate = date("Ym");
			$jenis = "Month";
		}
		$data = array();
		$data['sms'] = $this->sms($curdate, $jenis);
		$data['wa'] = $this->wa($curdate, $jenis);
		$data['tvms'] = $this->tvms($curdate, $jenis);
		$data['ovr'] = $this->ovr($curdate, $jenis);
		$data['email'] = $this->email($curdate, $jenis);
		$data['regional'] = $this->regional($curdate, $jenis);
		$data['toto'] = $data['sms']['order'] + $data['wa']['order'] + $data['tvms']['order'] + $data['ovr']['order'] + $data['email']['order'];
		$data['totrp'] = $data['sms']['rp'] + $data['wa']['rp'] + $data['tvms']['rp'] + $data['ovr']['rp'] + $data['email']['rp'];
		$data['totd'] = $data['sms']['deliver'] + $data['wa']['deliver'] + $data['tvms']['deliver'] + $data['ovr']['deliver'] + $data['email']['deliver'];
		$data['totu'] = $data['sms']['undeliver'] + $data['wa']['undeliver'] + $data['tvms']['undeliver'] + $data['ovr']['undeliver'] + $data['email']['undeliver'];
		$this->load->view('Dashboard/dashboard_summary', $data);
		// echo json_encode($data['chart']['label']);
	}
	public function regional($curdate, $jenis)
	{
		$data = array();
		if ($jenis == 'Month') {
			$qowa = $this->db->query("SELECT REGIONAL as rg, COUNT(*) as jml FROM p_dunning_wa WHERE PERIODE='$curdate' GROUP BY rg")->result();
			$qosms = $this->db->query("SELECT REGIONAL as rg, COUNT(*) as jml FROM dapros_sms WHERE PERIODE='$curdate' group by rg")->result();
			$qotvms = $this->db->query("SELECT regional as rg, COUNT(*) as jml FROM dapros_tvms WHERE periode='$curdate'  group by rg")->result();
			$qoovr = $this->db->query("SELECT REGIONAL as rg, COUNT(*) as jml FROM dapros_ovr WHERE PERIODE='$curdate' group by rg")->result();
			$qoemail = $this->db->query("SELECT regional as rg, COUNT(*) as jml FROM dapros_email WHERE periode='$curdate'  group by rg")->result();

			$dwa = $this->db->query("SELECT REGIONAL as rg, COUNT(*) as jml FROM p_dunning_wa WHERE PERIODE='$curdate' AND (STATUS='delivered' or STATUS='sent' OR STATUS='read') group by rg")->result();
			$dsms = $this->db->query("SELECT REGIONAL as rg, COUNT(*) as jml FROM dunning_sms WHERE PERIODE='$curdate' AND reason='SUCCESS' group by rg")->result();
			$dtvms = $this->db->query("SELECT regional as rg, COUNT(*) as jml FROM tvms_broadcast WHERE periode='$curdate' AND result='SUCCESS' group by rg")->result();
			$dovr = $this->db->query("SELECT regional as rg, COUNT(*) as jml FROM dunning_ovr WHERE periode='$curdate' AND dialstatus='ANSWER' group by rg")->result();
			$demail = $this->db->query("SELECT regional as rg, COUNT(*) as jml FROM dunning_email WHERE periode='$curdate' AND email_status='1' group by rg")->result();
		} else {
			$qowa = $this->db->query("SELECT REGIONAL as rg, COUNT(*) as jml FROM p_dunning_wa WHERE LEFT(PERIODE, 4)='$curdate' GROUP BY rg")->result();
			$qosms = $this->db->query("SELECT REGIONAL as rg, COUNT(*) as jml FROM dapros_sms WHERE LEFT(PERIODE, 4)='$curdate' group by rg")->result();
			$qotvms = $this->db->query("SELECT regional as rg, COUNT(*) as jml FROM dapros_tvms WHERE LEFT(periode, 4)='$curdate'  group by rg")->result();
			$qoovr = $this->db->query("SELECT REGIONAL as rg, COUNT(*) as jml FROM dapros_ovr WHERE LEFT(PERIODE, 4)='$curdate' group by rg")->result();
			$qoemail = $this->db->query("SELECT regional as rg, COUNT(*) as jml FROM dapros_email WHERE LEFT(periode, 4)='$curdate'  group by rg")->result();

			$dwa = $this->db->query("SELECT REGIONAL as rg, COUNT(*) as jml FROM p_dunning_wa WHERE LEFT(PERIODE, 4)='$curdate' AND (STATUS='delivered' or STATUS='sent' OR STATUS='read') group by rg")->result();
			$dsms = $this->db->query("SELECT REGIONAL as rg, COUNT(*) as jml FROM dunning_sms WHERE LEFT(periode, 4)='$curdate' AND reason='SUCCESS' group by rg")->result();
			$dtvms = $this->db->query("SELECT regional as rg, COUNT(*) as jml FROM tvms_broadcast WHERE LEFT(periode, 4)='$curdate' AND result='SUCCESS' group by rg")->result();
			$dovr = $this->db->query("SELECT regional as rg, COUNT(*) as jml FROM dunning_ovr WHERE LEFT(periode, 4)='$curdate' AND dialstatus='ANSWER' group by rg")->result();
			$demail = $this->db->query("SELECT regional as rg, COUNT(*) as jml FROM dunning_email WHERE LEFT(periode, 4)='$curdate' AND email_status='1' group by rg")->result();
		}
		$reg = array('JAKARTA', 'JAWA BARAT', 'JAWA TENGAH', 'JAWA TIMUR', 'KALIMANTAN', 'KTI', 'SUMATRA');

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

		foreach ($dwa as $dwad) {
			$data['wad'][$dwad->rg] = $dwad->jml;
		}
		foreach ($dsms as $dsmsd) {
			$data['smsd'][$dsmsd->rg] = $dsmsd->jml;
		}
		foreach ($dtvms as $dtvmsd) {
			$data['tvmsd'][$dtvmsd->rg] = $dtvmsd->jml;
		}
		foreach ($dovr as $dovrd) {
			$data['ovrd'][$dovrd->rg] = $dovrd->jml;
		}
		foreach ($demail as $demaild) {
			$data['wad'][$demaild->rg] = $demaild->jml;
		}
		// $ouput = array_merge($sms, $sms);
		// var_dump($data);
		return $data;
	}
	public function performance()

	{
		if (isset($_GET['date'])) {
			$curdate = $_GET['date'];
		} else {
			$curdate = date("Y-m-d");
		}
		if (isset($_GET['periode'])) {
			if ($_GET['periode'] == 'Month') {
				$myDateTime = DateTime::createFromFormat('Y-m-d', $curdate);
				$curdate = $myDateTime->format('Ym');
				// $curdate = date_format($curdate, 'Ym');
				$jenis = "Month";
			} else {
				$curdate = explode('-', $curdate);
				$curdate = $curdate[0];
				$jenis = "Year";
			}
		} else {
			// $curdate = date_format($curdate, 'Ym');
			$curdate = date("Ym");
			$jenis = "Month";
		}
		$data = array();
		$data['sms'] = $this->sms($curdate, $jenis);
		$data['wa'] = $this->wa($curdate, $jenis);
		$data['tvms'] = $this->tvms($curdate, $jenis);
		$data['ovr'] = $this->ovr($curdate, $jenis);
		$data['email'] = $this->email($curdate, $jenis);
		$data['sumod'] = $this->sumod($curdate, $jenis);
		$data['toto'] = $data['sms']['order'] + $data['wa']['order'] + $data['tvms']['order'] + $data['ovr']['order'] + $data['email']['order'];
		$data['totp'] = $data['sms']['payment'] + $data['wa']['payment'] + $data['tvms']['payment'] + $data['ovr']['payment'] + $data['email']['payment'];
		$data['totrp'] = $data['sms']['rp'] + $data['wa']['rp'] + $data['tvms']['rp'] + $data['ovr']['rp'] + $data['email']['rp'];
		$data['totd'] = $data['sms']['deliver'] + $data['wa']['deliver'] + $data['tvms']['deliver'] + $data['ovr']['deliver'] + $data['email']['deliver'];
		$data['totu'] = $data['sms']['undeliver'] + $data['wa']['undeliver'] + $data['tvms']['undeliver'] + $data['ovr']['undeliver'] + $data['email']['undeliver'];
		$data['chart'] = $this->chartapex($curdate, $jenis);
		$this->load->view('Dashboard/perform_sc', $data);
		// echo json_encode($data['chart']['label']);
	}
	public function sumod($curdate, $jenis)
	{
		if ($jenis == "Month") {
			$datestart = substr($curdate, 0, 4);
		} else {
			$datestart = $curdate;
		}
		$data['sumod'] = $this->db->query("SELECT PERIODE, count(*) as jml FROM p_dunning_wa WHERE LEFT(PERIODE, 4)= '$datestart' GROUP BY PERIODE")->result();
		return $data;
	}
	public function chartapex($curdate, $jenis)
	{
		if ($jenis == "Month") {
			$year = substr($curdate, 0, 4);
		} else {
			$year = $curdate;
		}
		$bulan = array('01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12');
		$no = 0;
		foreach ($bulan as $bln) {
			$label['label'][$no] = $year . $bln;
			$label['order'][$no] = $this->getorder($year . $bln);
			$label['deliver'][$no] = $this->getdeliver($year . $bln);
			$label['undeliver'][$no] = $label['order'][$year . $bln] - $label['deliver'][$year . $bln];
			$no++;
		}
		return $label;
	}

	public function getorder($periode)
	{
		$wao = $this->db->query("SELECT COUNT(*) as jml FROM p_dunning_wa WHERE PERIODE='$periode'")->row()->jml;
		$smso = $this->db->query("SELECT COUNT(*) as jml FROM dapros_sms WHERE PERIODE='$periode'")->row()->jml;
		$tvmso = $this->db->query("SELECT COUNT(*) as jml FROM dapros_tvms WHERE periode='$periode'")->row()->jml;
		$ovro = $this->db->query("SELECT COUNT(*) as jml FROM dapros_ovr WHERE PERIODE='$periode'")->row()->jml;
		$emailo = $this->db->query("SELECT COUNT(*) as jml FROM dapros_email WHERE periode='$periode'")->row()->jml;
		$data = $wao + $smso + $tvmso + $ovro + $emailo;
		if (!$data) {
			$data = 0;
		} else {
			$data = $data;
		}
		return $data;
	}
	public function getdeliver($periode)
	{

		$wad = $this->db->query("SELECT COUNT(*) as jml FROM p_dunning_wa WHERE PERIODE='$periode' AND (STATUS='delivered' OR STATUS='read')")->row()->jml;
		$smsd = $this->db->query("SELECT COUNT(*) as deliver FROM dunning_sms WHERE tgl_kirim='$periode'")->row()->deliver;
		$tvmsd = $this->db->query("SELECT COUNT(*) as deliver FROM tvms_broadcast WHERE date(tgl_kirim)='$periode'")->row()->deliver;
		$ovrd = $this->db->query("SELECT COUNT(*) as deliver FROM dunning_ovr WHERE dialstatus='$periode' AND dialstatus='ANSWER'")->row()->deliver;
		$emaild = $this->db->query("SELECT COUNT(*) as deliver FROM dunning_email WHERE date(date_process)='$periode' AND note='Message has been sent'")->row()->deliver;
		$data = $wad + $smsd + $tvmsd + $ovrd + $emaild;
		if (!$data) {
			$data = 0;
		} else {
			$data = $data;
		}
		return $data;
	}
	public function wa($curdate, $jenis)
	{
		if ($jenis == 'Month') {
			$qo = $this->db->query("SELECT COUNT(*) as odwa FROM p_dunning_wa WHERE PERIODE='$curdate'")->row()->odwa;
			$qd = $this->db->query("SELECT COUNT(*) as deliv FROM p_dunning_wa WHERE DATE_START='$curdate' AND DATE_DELIVER='$curdate' IS NOT NULL")->row()->deliv;
			$rp = $this->db->query("SELECT SUM(rp_bayar) as rp FROM p_dunning_wa WHERE DATE_START='$curdate'")->row()->rp;
			// $qu = $this->db->query("SELECT COUNT(*) as undeliv FROM p_dunning_wa WHERE DATE_START='$curdate' AND DATE_DELIVER='$curdate' IS NULL")->row()->undeliv;
		} else {
			$qo = $this->db->query("SELECT COUNT(*) as odwa FROM p_dunning_wa WHERE LEFT(PERIODE, 4)='$curdate'")->row()->odwa;
			$qd = $this->db->query("SELECT COUNT(*) as deliv FROM p_dunning_wa WHERE LEFT(DATE_START, 4)='$curdate' AND DATE_DELIVER='$curdate' IS NOT NULL")->row()->deliv;
			$rp = $this->db->query("SELECT SUM(rp_bayar) as rp FROM p_dunning_wa WHERE LEFT(DATE_START, 4)='$curdate'")->row()->rp;
			// $qu = $this->db->query("SELECT COUNT(*) as undeliv FROM p_dunning_wa WHERE LEFT(DATE_START, 4)='$curdate' AND DATE_DELIVER='$curdate' IS NULL")->row()->undeliv;
		}

		$data['order'] = $qo;
		$data['deliver'] = $qd;
		$data['rp'] = $rp;
		$data['undeliver'] = $data['order'] - $data['deliver'];
		$data['progress'] = ($data['deliver'] / $data['order']) * 100;
		return $data;
	}
	public function sms($curdate, $jenis)
	{
		if ($jenis == 'Month') {
			$qo = $this->db->query("SELECT COUNT(*) as odsms FROM dapros_sms WHERE PERIODE='$curdate'")->row()->odsms;
			$qd = $this->db->query("SELECT COUNT(*) as deliver FROM dunning_sms WHERE periode='$curdate'")->row()->deliver;
			$qp = $this->db->query("SELECT COUNT(*) as payment FROM dunning_sms WHERE periode='$curdate' AND rp_bayar is not null")->row()->payment;
			$rp = $this->db->query("SELECT SUM(rp_bayar) as rp FROM dunning_sms WHERE periode='$curdate' AND rp_bayar is not null")->row()->rp;
		} else {
			$qo = $this->db->query("SELECT COUNT(*) as odsms FROM dapros_sms WHERE LEFT(PERIODE, 4)='$curdate'")->row()->odsms;
			$qd = $this->db->query("SELECT COUNT(*) as deliver FROM dunning_sms WHERE LEFT(periode, 4)='$curdate'")->row()->deliver;
			$qp = $this->db->query("SELECT COUNT(*) as payment FROM dunning_sms WHERE LEFT(periode, 4)='$curdate' AND rp_bayar is not null")->row()->payment;
			$rp = $this->db->query("SELECT SUM(rp_bayar) as rp FROM dunning_sms WHERE LEFT(periode, 4)='$curdate' AND rp_bayar is not null")->row()->rp;
		}
		$data['order'] = $qo;
		$data['deliver'] = $qd;
		$data['payment'] = $qp;
		$data['rp'] = $rp;
		$data['undeliver'] = $data['order'] - $data['deliver'];
		$data['progress'] = ($data['deliver'] / $data['order']) * 100;
		return $data;
	}
	public function tvms($curdate, $jenis)
	{
		if ($jenis == 'Month') {
			$qo = $this->db->query("SELECT COUNT(*) as odtvms FROM dapros_tvms WHERE periode='$curdate'")->row()->odtvms;
			$qd =  $this->db->query("SELECT COUNT(*) as deliver FROM tvms_broadcast WHERE periode='$curdate'")->row()->deliver;
			$qp =  $this->db->query("SELECT COUNT(*) as payment FROM tvms_broadcast WHERE periode='$curdate' and rp_bayar is not null")->row()->payment;
			$rp =  $this->db->query("SELECT SUM(rp_bayar) as rp FROM tvms_broadcast WHERE periode='$curdate' and rp_bayar is not null")->row()->rp;
		} else {
			$qo = $this->db->query("SELECT COUNT(*) as odtvms FROM dapros_tvms WHERE LEFT(periode, 4)='$curdate'")->row()->odtvms;
			$qp =  $this->db->query("SELECT COUNT(*) as deliver FROM tvms_broadcast WHERE LEFT(periode, 4)='$curdate'")->row()->deliver;
			$qp =  $this->db->query("SELECT COUNT(*) as deliver FROM tvms_broadcast WHERE LEFT(periode, 4)='$curdate' and rp_bayar is not null ")->row()->deliver;
			$rp =  $this->db->query("SELECT SUM(rp_bayar) as rp FROM tvms_broadcast WHERE LEFT(periode, 4)='$curdate' and rp_bayar is not null")->row()->rp;
		}
		$data['order'] = $qo;
		$data['deliver'] = $qd;
		$data['payment'] = $qp;
		$data['rp'] = $rp;
		$data['undeliver'] = $data['order'] - $data['deliver'];
		$data['progress'] = ($data['deliver'] / $data['order']) * 100;
		return $data;
	}
	public function ovr($curdate, $jenis)
	{
		if ($jenis == 'Month') {
			$qo = $this->db->query("SELECT COUNT(*) as odovr FROM dapros_ovr WHERE PERIODE='$curdate'")->row()->odovr;
			$qd = $this->db->query("SELECT COUNT(*) as deliver FROM dunning_ovr WHERE dialstatus='$curdate' AND dialstatus='ANSWER'")->row()->deliver;
			$qp = $this->db->query("SELECT COUNT(*) as payment FROM dunning_ovr WHERE dialstatus='$curdate' AND dialstatus='ANSWER' AND rp_bayar is not null")->row()->payment;
			$rp = $this->db->query("SELECT SUM(rp_bayar) as rp FROM dunning_ovr WHERE dialstatus='$curdate' AND dialstatus='ANSWER' AND rp_bayar is not null")->row()->rp;
		} else {
			$qo = $this->db->query("SELECT COUNT(*) as odovr FROM dapros_ovr WHERE LEFT(PERIODE, 4)='$curdate'")->row()->odovr;
			$qd = $this->db->query("SELECT COUNT(*) as deliver FROM dunning_ovr WHERE LEFT(dialstatus, 4)='$curdate' AND dialstatus='ANSWER'")->row()->deliver;
			$qp = $this->db->query("SELECT COUNT(*) as payment FROM dunning_ovr WHERE LEFT(dialstatus, 4)='$curdate' AND dialstatus='ANSWER' AND rp_bayar is not null")->row()->payment;
			$rp = $this->db->query("SELECT SUM(rp_bayar) as rp FROM dunning_ovr WHERE LEFT(dialstatus, 4)='$curdate' AND dialstatus='ANSWER' AND rp_bayar is not null")->row()->rp;
		}
		$data['order'] = $qo;
		$data['deliver'] = $qd;
		$data['payment'] = $qp;
		$data['rp'] = $rp;
		$data['undeliver'] = $data['order'] - $data['deliver'];
		$data['progress'] = ($data['deliver'] / $data['order']) * 100;
		return $data;
	}
	public function email($curdate, $jenis)
	{
		if ($jenis == 'Month') {
			$qo = $this->db->query("SELECT COUNT(*) as odemail FROM dapros_email WHERE periode='$curdate'")->row()->odemail;
			$qd =  $this->db->query("SELECT COUNT(*) as deliver FROM dunning_email WHERE date(date_process)='$curdate' AND note='Message has been sent'")->row()->deliver;
			$qp =  $this->db->query("SELECT COUNT(*) as payment FROM dunning_email WHERE date(date_process)='$curdate' AND note='Message has been sent' AND rp_bayar IS NOT NULL")->row()->payment;
			$rp =  $this->db->query("SELECT SUM(rp_bayar) as rp FROM dunning_email WHERE date(date_process)='$curdate' AND note='Message has been sent' AND rp_bayar IS NOT NULL")->row()->rp;
		} else {
			$qo = $this->db->query("SELECT COUNT(*) as odemail FROM dapros_email WHERE LEFT(periode, 4)='$curdate'")->row()->odemail;
			$qd =  $this->db->query("SELECT COUNT(*) as deliver FROM dunning_email WHERE LEFT(date_process, 4)='$curdate' AND note='Message has been sent'")->row()->deliver;
			$qp =  $this->db->query("SELECT COUNT(*) as payment FROM dunning_email WHERE LEFT(date_process, 4)='$curdate' AND note='Message has been sent' AND rp_bayar IS NOT NULL")->row()->payment;
			$rp =  $this->db->query("SELECT SUM(rp_bayar) as rp FROM dunning_email WHERE LEFT(date_process, 4)='$curdate' AND note='Message has been sent' AND rp_bayar IS NOT NULL")->row()->rp;
		}
		$data['order'] = $qo;
		$data['deliver'] = $qd;
		$data['deliver'] = $qp;
		$data['rp'] = $rp;
		$data['undeliver'] = $data['order'] - $data['deliver'];
		$data['progress'] = ($data['deliver'] / $data['order']) * 100;
		return $data;
	}
}
