<?php
require APPPATH . '/controllers/Distribution/Distribution_config.php';

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Distribution extends CI_Controller
{
	private $log_key, $log_temp, $title;
	function __construct()
	{
		parent::__construct();
		$this->load->model('Custom_model/Trans_model', 'trans');
		$this->load->model('Custom_model/Trans_detail_model', 'trans_detail');
		$this->load->model('Custom_model/mastercall_model', 'mastercall');
		$this->load->model('Custom_model/mastercall_detail_model', 'mastercall_detail');
		$this->load->model('sys/Sys_user_log_model', 'log_login');
		$this->load->model('Custom_model/Sys_user_table_model', 'Sys_user_table_model');
		$this->log_key = 'log_Distributon';
		$this->title = new Distribution_config();
	}


	public function index()
	{
		$idlogin = $this->session->userdata('idlogin');
		$logindata = $this->log_login->get_by_id($idlogin);
		$user = $this->Sys_user_table_model->get_row(array("id" => $logindata->id_user));
		$data = array(
			'title_page_big'		=> 'FILTER DAPROS',
			'title'					=> $this->title,
			'link_refresh_table'	=> site_url() . 'Distribution/Distribution/refresh_table/' . $this->_token,
			'link_create'			=> site_url() . 'Distribution/Distribution/create',
			'link_update'			=> site_url() . 'Distribution/Distribution/update',
			'link_delete'			=> site_url() . 'Distribution/Distribution/delete_multiple',
			'link_filter'				=> site_url() . 'Distribution/Distribution',
			'link_duplicate'				=> site_url() . 'Distribution/Distribution/check_duplicate',
			'link_close'				=> site_url() . 'Distribution/Distribution',
			'link_back'				=> site_url() . 'Distribution/Distribution',
		);
		$filter = array();
		$post = $this->input->post();
		$bln = date("m");
		$thn = date("Y");
		$filter['STATUS_ORDER'] = 0;
		$filter['BLN'] = $bln;
		$filter['THN'] = $thn;

		$data['jumlah_data'] = $this->mastercall->get_count($filter);
		$data['filter'] = $post;
		$status_call = $this->mastercall->live_query("SELECT STATUS_CALL,count(*) as jumlah FROM trans WHERE BLN=$bln AND THN=$thn GROUP BY STATUS_CALL ")->result();
		$data['status_call'][0] = 0;
		$data['status_call']['NEW POP UP'] = 0;
		$data['status_call'][1] = 0;
		$data['status_call'][2] = 0;
		if (count($status_call) > 0) {
			foreach ($status_call as $sc) {
				$data['status_call'][$sc->STATUS_CALL] = $sc->jumlah;
			}
		}
		$data['status_call']['NEW POP UP'] = $this->mastercall->live_query("SELECT count(*) as jumlah FROM trans WHERE BLN=$bln AND THN=$thn AND DETAIL_STATUS='NEW POP UP'")->row()->jumlah;
		

		if ($post['action'] == 'distribution') {

			$this->proses_data($post);
		} else {

			$area_id = $_POST["area"];
			$dept_id = $user->dept_id;
			$user_area = $user->area;
			$tipe_call = $_POST["tipe_call"];
			$todo_id = $_POST["todo_id"];
			$segmentid = $_POST["segmentid"];



			$where_clause = "";
			if ($area_id != "" and $dept_id <= 14) {
				$where_clause = $where_clause . " AND a.BA ='$area_id'";
			} else {

				if ($user_area != "" and $dept_id <= "14") {
					$where_clause = $where_clause . " AND a.BA IN('$user_area')";
				} else {
					$where_clause = $where_clause . " AND a.BA like 'T%'";
				}
			}

			if ($tipe_call != "") {
				$where_clause = $where_clause . " AND a.TIPE_CALL ='$tipe_call'";
			} else {
				$where_clause = $where_clause . " AND a.TIPE_CALL !='RE-SCHEDULE'";
			}

			if ($todo_id != "") {
				$where_clause = $where_clause . " AND b.TODO_ID ='$todo_id'";
			}

			if ($dept_id < "14" && $segmentid != '') {
				$where_clause = $where_clause . " AND a.SEGMENTID='$segmentid'";
			}


			if ($dept_id == "13") {
				$where_clause = $where_clause . " AND a.SEGMENTID='5'";
			}
			$query = "SELECT a.TRANS_ID, 
				a.CID, 
				a.NAMA_MASTER, 
				a.ALAMAT_MASTER, 
				a.TELP1, 
				a.TELP2, 
				a.TELP3, 
				a.EMAIL, 
				a.TOT_BAYAR1, 
				a.CSID, 
				a.CSAREA, 
				a.BA, 
				a.TGL_ORDER, 
				a.STATUS_ORDER, 
				a.UPD_DISTRIBUTED, 
				a.UPD_AGENT, 
				a.LUP, 
				a.TIPE_CALL, 
				a.UPD_UPLOAD, 
				a.LUP_UPLOAD, 
				a.TOT_BAYAR, 
				a.UPD_DOWNLOAD, 
				a.LUP_DOWNLOAD, 
				a.CCAT, 
				a.SEGMENTID, 
				a.DEPARTMENTID, 
				a.BLN, 
				a.THN, 
				a.LUP_DISTRIBUTED, 
				a.UPD_BY, 
				a.FLAG_DOWNLOAD, 
				a.NO_ORDER, 
				a.TGL_UPLOAD,
				a.BEST_WD,
				a.BEST_WE,
				a.IS_PROPER_NCLI,
				a.PRIORITY_CARING,
				a.USAGE_MO,
				a.USAGE_AVG,
				a.KET_USAGE,
				a.KAT_HVC,
				b.ND
		FROM mastercall a, mastercall_detail b 
		WHERE a.TRANS_ID=b.TRANS_ID AND
			  a.STATUS_ORDER=0 AND 
			  a.BLN='$bln' AND 
			  a.THN='$thn' $where_clause
		 ORDER BY a.PRIORITY_CARING ASC, a.TIPE_CALL DESC,a.JML_OBC ASC,a.TOT_BAYAR DESC ";
			$data['listna'] = $this->mastercall->live_query($query)->result_array();
		}
		$this->template->load('Distribution/Distribution_filter_form', $data);
	}

	function proses_data($post)
	{
		$idlogin = $this->session->userdata('idlogin');
		$logindata = $this->log_login->get_by_id($idlogin);
		$user = $this->Sys_user_table_model->get_row(array("id" => $logindata->id_user));
		if ($post) {

			$bln = date("m");
			$thn = date("Y");
			$area_id = $_POST["area"];
			$dept_id = $user->dept_id;
			$user_area = $user->area;
			$agent_id = $user->nmuser;
			$lup_by = $user->nmuser;
			$departmentid = $dept_id;
			$tipe_call = $_POST["tipe_call"];
			$todo_id = $_POST["todo_id"];
			$segmentid = $_POST["segmentid"];
			$jumlah_data = $_POST["jumlah_data"];



			$where_clause = "";
			if ($area_id != "" and $dept_id <= "14") {
				$where_clause = $where_clause . " AND a.BA ='$area_id'";
			} else {

				if ($user_area != "" and $dept_id <= "14") {
					$where_clause = $where_clause . " AND a.BA IN('$user_area')";
				} else {
					$where_clause = $where_clause . " AND a.BA like 'T%'";
				}
			}

			if ($tipe_call != "") {
				$where_clause = $where_clause . " AND a.TIPE_CALL ='$tipe_call'";
			} else {
				$where_clause = $where_clause . " AND a.TIPE_CALL !='RE-SCHEDULE'";
			}

			if ($todo_id != "") {
				$where_clause = $where_clause . " AND b.TODO_ID ='$todo_id'";
			}

			if ($dept_id < "14" && $segmentid != '') {
				$where_clause = $where_clause . " AND a.SEGMENTID='$segmentid'";
			}


			if ($dept_id == "13") {
				$where_clause = $where_clause . " AND a.SEGMENTID='5'";
			}
			$query = "SELECT a.TRANS_ID, 
			a.CID, 
			a.NAMA_MASTER, 
			a.ALAMAT_MASTER, 
			a.TELP1, 
			a.TELP2, 
			a.TELP3, 
			a.EMAIL, 
			a.TOT_BAYAR1, 
			a.CSID, 
			a.CSAREA, 
			a.BA, 
			a.TGL_ORDER, 
			a.STATUS_ORDER, 
			a.UPD_DISTRIBUTED, 
			a.UPD_AGENT, 
			a.LUP, 
			a.TIPE_CALL, 
			a.UPD_UPLOAD, 
			a.LUP_UPLOAD, 
			a.TOT_BAYAR, 
			a.UPD_DOWNLOAD, 
			a.LUP_DOWNLOAD, 
			a.CCAT, 
			a.SEGMENTID, 
			a.DEPARTMENTID, 
			a.BLN, 
			a.THN, 
			a.LUP_DISTRIBUTED, 
			a.UPD_BY, 
			a.FLAG_DOWNLOAD, 
			a.NO_ORDER, 
			a.TGL_UPLOAD,
			a.BEST_WD,
			a.BEST_WE,
			a.IS_PROPER_NCLI,
			a.PRIORITY_CARING,
			a.USAGE_MO,
			a.USAGE_AVG,
			a.KET_USAGE,
			a.KAT_HVC,
			b.ND
	FROM mastercall a, mastercall_detail b 
	WHERE a.TRANS_ID=b.TRANS_ID AND
		  a.STATUS_ORDER=0 AND 
		  a.BLN='$bln' AND 
		  a.THN='$thn' $where_clause
	 ORDER BY a.PRIORITY_CARING ASC, a.TIPE_CALL DESC,a.JML_OBC ASC,a.TOT_BAYAR DESC LIMIT $jumlah_data ";
			$data = $this->mastercall->live_query($query)->result_array();

			if (count($data) > 0) {

				foreach ($data as $row_Recordset) {
					$trans_id = $row_Recordset['TRANS_ID'];
					$cid = $row_Recordset['CID'];
					$nama_master = $row_Recordset['NAMA_MASTER'];
					$alamat_master = $row_Recordset['ALAMAT_MASTER'];
					$telp1 = $row_Recordset['TELP1'];
					$telp2 = $row_Recordset['TELP2'];
					$telp3 = $row_Recordset['TELP3'];
					$csid = $row_Recordset['CSID'];
					$ccat = $row_Recordset['CCAT'];
					$segmentid = $row_Recordset['SEGMENTID'];
					$tgl_upload = $row_Recordset['TGL_UPLOAD'];

					$csarea = $row_Recordset['CSAREA'];
					$ba = $row_Recordset['BA'];
					$tot_bayar = $row_Recordset['TOT_BAYAR'];
					//$departmentid=$row_Recordset['DEPARTMENTID'];
					$tipe_call = $row_Recordset['TIPE_CALL'];
					//$departmentidx=$row_Recordset['DEPARTMENTID'];
					$best_wd = $row_Recordset['BEST_WD'];
					$best_we = $row_Recordset['BEST_WE'];
					$is_proper_ncli = $row_Recordset['IS_PROPER_NCLI'];

					$priority_caring = $row_Recordset['PRIORITY_CARING'];
					$email = $row_Recordset['EMAIL'];
					$nd = $row_Recordset['ND'];
					$usage_mo = $row_Recordset['USAGE_MO'];
					$usage_avg = $row_Recordset['USAGE_AVG'];
					$ket_usage = $row_Recordset['KET_USAGE'];
					$kat_hvc = $row_Recordset['KAT_HVC'];

					$bln = date("m");
					$thn = date("Y");

					$new_pop_up = "NEW POP UP";
					if ($trans_id != "") {
						$sql = 	"INSERT INTO trans(TRANS_ID,CID, NAMA_MASTER,ALAMAT_MASTER,TELP1,NO_KONTAK,TELP2,TELP3,
				CSID,CSAREA,BA,TOT_BAYAR,UPD_AGENT,UPD_DISTRIBUTED,
				STATUS_ORDER,STATUS_CALL,REASON_CALL,DETAIL_STATUS,DEPARTMENTID,
				TIPE_CALL,TGL_ORDER,BLN,THN,UPD_BY,LUP,LUP_DISTRIBUTED,CCAT,SEGMENTID,TGL_UPLOAD,
				BEST_WD,BEST_WE,IS_PROPER_NCLI,PRIORITY_CARING,EMAIL,USAGE_MO,USAGE_AVG,KET_USAGE,KAT_HVC) 
					values
					('$trans_id','$cid', \"$nama_master\",\"$alamat_master\",\"$telp1\",\"$telp1\",\"$telp2\",\"$telp3\",
					\"$csid\",\"$csarea\",\"$ba\",\"$tot_bayar\",\"$agent_id\",\"$lup_by\",
					'1','$new_pop_up','$new_pop_up','$new_pop_up','$departmentid',
					'$tipe_call',NOW(),'$bln','$thn','$lup_by',NOW(),NOW(),'$ccat','$segmentid','$tgl_upload',
					'$best_wd','$best_we','$is_proper_ncli','$priority_caring','$email','$usage_mo','$usage_avg','$ket_usage','$kat_hvc')";
						$msc = $this->mastercall->live_query($sql);
						$sql2 = "UPDATE mastercall SET UPD_AGENT='$agent_id',
				UPD_DISTRIBUTED='$lup_by',
				LUP_DISTRIBUTED=NOW(),
				STATUS_ORDER=1 ,LUP =NOW()
				WHERE TRANS_ID='$trans_id'";
						$ud = $this->mastercall->live_query($sql2);
						$this->order_mastercall_detail_add($trans_id, $agent_id);
					}
				}
			}
			redirect(site_url() . 'Distribution/Distribution?success=1&dibagi=' . $_POST['jumlah_data']);
		}
	}
	function order_mastercall_detail_add($trans_id, $agent_id)
	{

		$upd_by = $_SESSION['user_info']["user_login"];
		$user_area = $_SESSION['user_info']["user_area"];
		global $conn;

		$query_Recordset = "select * from mastercall_detail 
							where TRANS_ID=" . $trans_id;


		$Recordset = $this->mastercall->live_query($query_Recordset)->result_array();



		foreach($Recordset as $row_Recordset){
			$cprod = $row_Recordset["CPROD"];
			if ($cprod == '11') {
				$lprod = 'INTERNET';
			} else {
				$lprod = 'TELEPON';
			}

			$items[] = array(
				"trans_id" => $row_Recordset["TRANS_ID"],
				"cid" => $row_Recordset["CID"],
				"cprod" => $row_Recordset["CPROD"],
				"lprod" => $lprod,
				"nama" => $row_Recordset["NAMA"],
				"alamat" => $row_Recordset["ALAMAT"],

				"service_id" => $row_Recordset["SERVICE_ID"],
				"csarea" => $row_Recordset["CSAREA"],
				"todo_id" => $row_Recordset["TODO_ID"],
				"todo" => $row_Recordset["TODO"],
				"rp_facture" => $row_Recordset["RP_FACTURE"],
				"rp_bayar" => $row_Recordset["RP_BAYAR"],
				"tunggakan" => $row_Recordset["TUNGGAKAN"],
				"tgl_bayar_str" => $row_Recordset["TGL_BAYAR_STR"],
				"lokasi_bayar" => $row_Recordset["LOKASI_BAYAR"],
				"catatan" => $row_Recordset["CATATAN"],
				"upd_by" => $row_Recordset["UPD_BY"],
				"lup" => $row_Recordset["LUP"],
				"tgl_janji_bayar" => $row_Recordset["TGL_JANJI_BAYAR"],
				"reason_id" => $row_Recordset["REASON_ID"],
				"nd" => $row_Recordset["ND"],
				"nd_reference" => $row_Recordset["ND_REFERENCE"],
				"departmentid" => $row_Recordset["DEPARTMENTID"],
				"ba" => $row_Recordset["BA"],
				"tgl_bayar" => $row_Recordset["TGL_BAYAR"],
				"tgl_upload" => $row_Recordset["TGL_UPLOAD"],
				"best_wd" => $row_Recordset["BEST_WD"],
				"best_we" => $row_Recordset["BEST_WE"],
				"is_proper_nd" => $row_Recordset["IS_PROPER_ND"],
				"lazy_score" => $row_Recordset["LAZY_SCORE"],
				"lazy_category" => $row_Recordset["LAZY_CATEGORY"],
				"rev_category" => $row_Recordset["REV_CATEGORY"],
				"priority_caring" => $row_Recordset["PRIORITY_CARING"],
				"tgl_ggn" => $row_Recordset["TGL_GGN"],
				"desc_ggn" => $row_Recordset["DESC_GGN"]

			);

			$items_blank[] = array(
				"trans_id" => "0",
				"cid" => "0",
				"nama" => "0",
				"alamat" => "0",
				"telp1" => "-",
				"telp2" => "-",
				"telp3" => "-",
				"csarea" => "-",
				"reason_call" => "-",
				"date_promise" => "-",
				"tgl_order" => "-"

			);
		}
		

		
		if (count($items) > 0) {
			//oci_data_seek($Recordset, 0);
			//$row_Recordset = oci_fetch_assoc($Recordset);
			for ($i = 0; $i < count($items); $i++) {
				$nomer = $i + 1;
				//echo json_encode($items);

				//trans_id,nomer,cid,cprod,lprod,nama,alamat,service_id,csarea,todo_id,todo,rp_facture,rp_bayar,tunggakan,tgl_bayar,lokasi_bayar,catatan,upd_by,lup,tgl_janji_bayar,reason_id,nd,nd_reference

				//echo $items[$i]["trans_id"];
				$trans_id = $items[$i]["trans_id"];
				$cid = $items[$i]["cid"];
				$cprod = $items[$i]["cprod"];
				$lprod = $items[$i]["lprod"];
				$nama = $items[$i]["nama"];
				$alamat = $items[$i]["alamat"];
				$service_id = $items[$i]["service_id"];
				$csarea = $items[$i]["csarea"];
				$todo_id = $items[$i]["todo_id"];
				$todo = $items[$i]["todo"];
				$rp_facture = $items[$i]["rp_facture"];
				$rp_bayar = $items[$i]["rp_bayar"];
				$tunggakan = $items[$i]["tunggakan"];

				$lokasi_bayar = $items[$i]["lokasi_bayar"];

				$catatan = $items[$i]["catatan"];
				$upd_by = $items[$i]["upd_by"];
				$lup = $items[$i]["lup"];

				$tgl_janji_bayar = $items[$i]["tgl_janji_bayar"];
				$reason_id = $items[$i]["reason_id"];
				$nd = $items[$i]["nd"];
				$nd_reference = $items[$i]["nd_reference"];

				//$departmentid=$items[$i]["departmentid"];
				$ba = $items[$i]["ba"];
				$tgl_bayar = $items[$i]["tgl_bayar"];
				$tgl_upload = $items[$i]["tgl_upload"];

				$best_wd = $items[$i]["best_wd"];
				$best_we = $items[$i]["best_we"];
				$is_proper_nd = $items[$i]["is_proper_nd"];
				$lazy_score = $items[$i]["lazy_score"];
				$lazy_category = $items[$i]["lazy_category"];
				$rev_category = $items[$i]["rev_category"];
				$priority_caring = $items[$i]["priority_caring"];
				$tgl_ggn = $items[$i]["tgl_ggn"];
				$desc_ggn = $items[$i]["desc_ggn"];

				$bln = date("m");
				$thn = date("Y");

				$sql = "INSERT IGNORE INTO trans_detail(
				trans_id,nomer,cid,cprod,lprod,
				nama,alamat,service_id,csarea,todo_id,
				todo,rp_facture,rp_bayar,tunggakan,lokasi_bayar,
				upd_by,lup,nd,nd_reference,departmentid,ba,tgl_bayar,upd_agent,bln,thn,tgl_upload,
				best_wd, best_we, is_proper_nd, lazy_score, lazy_category, rev_category, priority_caring,tgl_ggn,desc_ggn)
				 VALUES
				 ($trans_id,$nomer, '$cid','$cprod','$lprod',
				 \"$nama\",\"$alamat\",'$service_id',\"$csarea\",'$todo_id',
				 '$todo','$rp_facture','$rp_bayar','$tunggakan',\"$lokasi_bayar\",
				'$upd_by',NOW(), '$nd','$nd_reference', '$dept_id','$ba','$tgl_bayar','$agent_id',$bln,$thn,'$tgl_upload',
				'$best_wd', '$best_we', '$is_proper_nd', '$lazy_score', 
				'$lazy_category', '$rev_category','$priority_caring','$tgl_ggn','$desc_ggn')";

				$res = $this->mastercall->live_query($sql);
			}
		} else {
			//$aRoster = array("data"=>$items_blank);
			//echo json_encode($aRoster);
			//echo "No data to display";
		}
	}
	function check_duplicate()
	{
		$data = array(
			'title_page_big'		=> 'DUPLICATE DAPROS',
			'title'					=> $this->title,
			'link_refresh_table'	=> site_url() . 'Distribution/Distribution/refresh_table/' . $this->_token,
			'link_create'			=> site_url() . 'Distribution/Distribution/create',
			'link_update'			=> site_url() . 'Distribution/Distribution/update_duplicate',
			'link_delete'			=> site_url() . 'Distribution/Distribution/delete_multiple',
			'link_filter'				=> site_url() . 'Distribution/Distribution/check_duplicate',
			'link_close'				=> site_url() . 'Distribution/Distribution',
			'link_back'				=> site_url() . 'Distribution/Distribution/check_duplicate',
		);
		$post = $this->input->post();

		if (!$post) {
			$filter = array();
			$filter[" (ISNULL(update_by) OR update_by = 'baru' OR update_by = 'BARU' OR update_by = '') "] = null;
			$filter[" (ISNULL(duplicate_ncli) OR duplicate_ncli = 0 OR duplicate_ncli = '') "] = null;
			$filter['status'] = 0;
			// $filter['status2'] = 0;
			// $filter['status3'] = 0;

			// $data['data']['num'] = $this->distribution->get_count($filter,array(),'ncli,IF(no_pstn ="" OR ISNULL(no_pstn), no_speedy, no_pstn) ',array('ncli,no_pstn,no_speedy,count(*) as jumlah_ncli'),array("jumlah_ncli >"=>1));


			$this->template->load('Distribution/Distribution_check_duplicate_form', $data);
		} else {
			$filter = array();
			$filter[" (ISNULL(update_by) OR update_by = 'baru' OR update_by = 'BARU' OR update_by = '') "] = null;
			$filter[" (ISNULL(duplicate_ncli) OR duplicate_ncli = 0 OR duplicate_ncli = '') "] = null;
			$filter['status'] = 0;
			// $filter['status2'] = 0;
			// $filter['status3'] = 0;
			$limit = $post['limit'];
			if ($post['sumber'] != "semua") {
				$filter['sumber'] = $post['sumber'];
				$data['sumber'] = $post['sumber'];
			}
			if ($post['limit'] <= 0) {
				$limit = 10;
			}
			$data['limit'] = $post['limit'];
			$data['data'] = $this->distribution->get_results($filter, array('ncli,no_pstn,no_speedy,count(*) as jumlah_ncli'), array("limit" => $limit, "offset" => 0), array("ncli" => "DESC"), 'ncli,IF(no_pstn ="" OR ISNULL(no_pstn), no_speedy, no_pstn) ', array("jumlah_ncli >" => 1));


			$this->template->load('Distribution/Distribution_duplicate_form', $data);
		}
	}
	function update_duplicate()
	{
		$post = $this->input->post();

		if ($post) {
			$total = 0;

			if ($post['limit']) {
				$filter = array();
				$filter["(ISNULL(update_by) OR update_by = 'baru' OR update_by = 'BARU' OR update_by = '')"] = null;
				$filter["(ISNULL(duplicate_ncli) OR duplicate_ncli = 0 OR duplicate_ncli = '')"] = null;
				$filter['status'] = 0;
				$filter['status2'] = 0;
				$filter['status3'] = 0;
				$limit = $post['limit'];
				if ($post['sumber'] != "semua") {
					$filter['sumber'] = $post['sumber'];
				}
				$dapros = $this->distribution->get_results($filter, array('ncli,no_pstn,no_speedy,count(*) as jumlah_ncli'), array("limit" => $limit, "offset" => 0), array("ncli" => "DESC"), 'ncli,IF(no_pstn ="" OR ISNULL(no_pstn), no_speedy, no_pstn) ', array("jumlah_ncli >" => 1));

				if ($dapros['num'] > 0) {

					foreach ($dapros['results'] as $val) {

						if ($val->no_pstn == "") {
							$where = array(
								'ncli' => $val->ncli,
								"(no_pstn = '' OR no_pstn = null)" => NULL,
								'no_speedy' => $val->no_speedy,
							);
						} else {
							$where = array(
								'ncli' => $val->ncli,
								'no_pstn' => $val->no_pstn,
							);
						}
						$where["(ISNULL(update_by) OR update_by = 'baru' OR update_by = 'BARU' OR update_by = '')"] = null;
						$where["(ISNULL(duplicate_ncli) OR duplicate_ncli = 0 OR duplicate_ncli = '')"] = null;
						$where['status'] = 0;
						$where['status2'] = 0;
						$where['status3'] = 0;
						$update = $this->distribution->edit($where, array("duplicate_ncli" => 1), ($val->jumlah_ncli - 1), array("no_tgl" => "DESC"));
						if ($update) {
							$total = $total + ($val->jumlah_ncli - 1);
						}
					}
				}
			}
			// echo $total;
			redirect(site_url() . 'Distribution/Distribution/check_duplicate?success=1&diupdate=' . $total);
		} else {
			redirect(site_url() . 'Distribution/Distribution/check_duplicate');
		}
	}
	public function data_bayar()
	{
		$data = array(
			'title_page_big'		=> 'UPLOAD DATA PROSPEK',
			'title'					=> $this->title,
			'link_create_multiple'			=> site_url() . 'Distribution/Distribution/create_multiple',
			'link_download_template_dapros'	=> site_url() . 'Distribution/Distribution/download_template_user/' . $this->_token,
			'link_upload_template'			=> site_url() . 'Distribution/Distribution/upload_template_user/' . $this->_token,
		);

		$this->template->load('Distribution/upload_bayar', $data);
	}
	public function upload_template_user($token)
	{

		$tm = time();
		$config['upload_path']          = './temp_upload/';
		$config['allowed_types']        = '*';
		$config['max_size']             = 60000000;
		$config['file_name']			= 'template_dapros.xls';
		$config['overwrite']			= TRUE;


		$this->load->library('upload', $config);

		$o = array();
		if (!$this->upload->do_upload('inputfile')) {

			$em = $this->upload->display_errors();
			$em = str_replace('You did not select a file to upload.', 'Tidak ada file yang di pilih', $em);

			$o['success'] 	= 'false';
			$o['message']	= $em;
			$o['elementid'] = '#inputfile';
			$o['sec_val']	=  $this->security->get_csrf_token_name() . "=" . $this->security->get_csrf_hash() . "&";
			$o = json_encode($o);
			echo $o;
			return;
		} else {
			$path_file = $config['upload_path'] . $config['file_name'];
			$this->load->library("YBSExcelReader");
			$dataError = array();
			try {
				$excel  = new YBSExcelReader();
				$excel->set_file($path_file, "UPLOAD");
			} catch (Exception $e) {
				$msgError = $e->getMessage();
				$msgError = str_replace("Your requested sheet index: -1 is out of bounds. The actual number of sheets is 0.", "Error : Sheet tidak di temukan", $msgError);
				$dataError[] = "<small>" . $msgError . "</small><br>";
			}
			if (count($dataError) > 0) {
				unlink($path_file);
				$o['success']		= 'false';
				$o['message'] 		= $dataError;
				$o['original_name']	= $this->upload->data('client_name');
				$o['sec_val']		=  $this->security->get_csrf_token_name() . "=" . $this->security->get_csrf_hash() . "&";
				$o = json_encode($o);
				echo $o;
				return;
			} else {
				$sumber = $_POST['sumber'];
				$o['success']		= 'true';
				$o['message'] 		= "<small> File Ready in Process,,click save</small><br><a onclick=\"save('" . site_url() . "Distribution/Distribution/create_user_by_template/" . $this->_token . "/" . $sumber . "')\" href=\"javascript:void(0)\" class=\"btn btn-success\">Save<a/>";
				$o['original_name']	= $this->upload->data('client_name');
				$o['sec_val']		=  $this->security->get_csrf_token_name() . "=" . $this->security->get_csrf_hash() . "&";
				$o = json_encode($o);
				echo $o;
				return;
			}
		}
	}
	public function create_user_by_template($token)
	{
		$idlogin = $this->session->userdata('idlogin');
		$logindata = $this->log_login->get_by_id($idlogin);
		$user = $this->Sys_user_table_model->get_row(array("id" => $logindata->id_user));
		if ($this->_token == $token) {
			$path_file = './temp_upload/template_dapros.xls';

			$this->load->library("YBSExcelReader");
			$excel  = new YBSExcelReader();
			$excel->set_file($path_file, "UPLOAD");
			$rangena = array(
				"A",
				"B",
			);

			$kolom_default['TRANS_ID'] = 'A';
			$kolom_default['CID'] = 'B';


			$dataFinal = $excel->read(1, 10000, $rangena);

			$val = array();
			$val_exist = array();
			$val_final = array();
			$x = 0;
			$data['datana'] = array();
			$data['status'] = array();
			foreach ($dataFinal as $key) {
				if ($x > 0) {


					$trans_id = (string)$key['A'];
					$cid = (string)$key['B'];
					$upd_by = $user->nmuser;

					$status_proses = $this->upload_data_bayar($trans_id, $cid, $upd_by);
					$data['datana'][$x]['status'] = $status_proses;
					$data['datana'][$x]['transid'] = $trans_id;
					$data['datana'][$x]['cid'] = $cid;
					$data['status'][$status_proses][$x] = 1;
				}

				$x++;
			}


			$this->load->view('Distribution/hasil_upload', $data);
		} else {
			redirect("Auth");
		}
	}
	function upload_data_bayar($trans_id, $cid, $upd_by)
	{

		$hasil_proses = "Gagal proses";

		$sql1         = "UPDATE mastercall SET STATUS_ORDER='1', UPD_AGENT='SYSTEM', LUP=SYSDATE(), LUP_DISTRIBUTED=SYSDATE()
    WHERE TRANS_ID='$trans_id' AND CID='$cid' AND STATUS_ORDER='0' AND UPD_AGENT='NONE'";
		$query1       = $this->mastercall->live_query($sql1);


		$sql2         = "UPDATE trans SET STATUS_CALL='NOT CONTACTED', REASON_CALL='SUDAH LUNAS SEMUA', KETERANGAN='UPDATE DATA BAYAR BY UPLOAD',
    LUP=SYSDATE(),DETAIL_STATUS='', TGL_CALL=SYSDATE()
    WHERE TRANS_ID='$trans_id' AND CID='$cid' AND STATUS_CALL='NEW POP UP' AND REASON_CALL='NEW POP UP'";
		$query2       = $this->mastercall->live_query($sql2);

		$sql3         = "UPDATE list_call_log SET status_call='CONTACTED', status_proses='1', status_dial='1', lup=SYSDATE(), note='update data bayar'
    WHERE trans_id='$trans_id'";
		$query3       = $this->mastercall->live_query($sql3);


		$sql4         = "INSERT INTO log_upload_data_bayar(upd,trans_id,cid) VALUES('$upd_by','$trans_id','$cid')";
		$query4       = $this->mastercall->live_query($sql4);


		$sql5         = "INSERT INTO history_call(TRANS_ID,CID,TGL_CALL,STATUS_CALL,REASON_CALL,KETERANGAN,UPD,LUP)
    VALUES('$trans_id','$cid',SYSDATE(),'NOT CONTACTED','SUDAH LUNAS SEMUA','UPDATE DATA BAYAR BY UPLOAD','$upd_by',SYSDATE())";
		$query5       = $this->mastercall->live_query($sql5);



		if ($query1) {
			$hasil_proses = "Sukses";
		} else {
			$hasil_proses = "Gagal proses";
		}

		return $hasil_proses;
	}
};

/* END */
/* Mohon untuk tidak mengubah informasi ini : */
/* Generated by YBS CRUD Generator 2020-02-08 07:42:27 */
/* contact : YAP BRIDGING SYSTEM 		*/
/*			 bridging.system@gmail.com  */
/* 			 MAKASSAR CITY, INDONESIAN 	*/
