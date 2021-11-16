<?php
$start = microtime(true);
$tanggal_nya = date('Y-m-d');
ini_set('max_execution_time', 999999);
ini_set('memory_limit', '2048M');

$period_sch = date('Ym');

$tgls = date('d');
$tgl_now = date("Y-m-d");

$date1 = strtotime(date("Y-m-d", strtotime($tgl_now)) . " -1 days");
$date1 = strtoupper(date("d-M-y", $date1));

$date2 = strtotime(date("Y-m-d", strtotime($tgl_now)) . " -2 days");
$date2 = strtoupper(date("d-M-y", $date2));

$date3 = strtotime(date("Y-m-d", strtotime($tgl_now)) . " -3 days");
$date3 = strtoupper(date("d-M-y", $date3));

require_once('config2.php');
$sql_sch = "INSERT INTO idmsdb.m_schedule (model, periode, jumlah_data, exec_time, `status`, upd, lup, date_upload)
											VALUES( 'DUNING_OVR', 
											'$period_sch', 
											'0', 
											'9999-12-01', 
											'0', 
											'OTOMATIS', 
											sysdate(), 
											date(sysdate()))";
$sch_insert = mysql_query($sql_sch, $my_con3);
$sid = mysql_insert_id($my_con3);


//set cut off
if ((int)$tgls == 1 || (int)$tgls == 2 || (int)$tgls == 3) {
	$period_tag = "to_CHAR(ADD_MONTHS(SYSDATE,-1),'YYYYMM') as PERIODE,";
} else {
	$period_tag = "to_CHAR(SYSDATE,'YYYYMM') as PERIODE,";
}

$limit = 250000;
$sql1 = "SELECT * FROM ( 
							SELECT   c.CCA,
									$period_tag
									c.SND,
									c.ND1,
									c.CPROD,
									c.SALDO,
									c.JENIS,
									c.TGL_INPUT,
									c.STATUS,
									c.GROUP_ID,
									CASE WHEN c.REGIONAL IS NULL THEN B.REGIONAL ELSE C.REGIONAL END AS regional
							FROM pranpc.dunning_ovr c
									LEFT JOIN
										P_IDEAS_REGIONAL b
									ON c.cca = b.cca AND c.snd = b.snd
							WHERE   STATUS = 0
									) v
									WHERE rownum<=$limit";
echo $sql1;
$number = 0;

$query = @oci_parse($conn, $sql1);

@oci_execute($query) or die(print_r(oci_error($query)));

while ($row = oci_fetch_array($query, OCI_BOTH)) {
	//echo $todo;
	$cca			= $row['CCA'];
	$snd			= $row['SND'];
	$notel			= $row['ND1'];
	$cprod			= $row['CPROD'];
	$saldo			= $row['SALDO'];
	$todo			= $row['JENIS'];
	$regional		= $row['REGIONAL'];

	if ((int)$tgls == 1 || (int)$tgls == 2 || (int)$tgls == 3) {
		$periode_co		= $row['PERIODE'];
	} else {
		$periode_co     = $row['PERIODE'];
	}

	$tgl_input		= $row['TGL_INPUT'];
	$group_id		= $row['GROUP_ID'];

	$cprod == 1 ? $produk = 'TELEPON' : $produk = 'Internet';

	if ($todo == 'F' && $produk == 'Internet') {
		$id_ovrs = '4';
	} else if ($todo == 'F' && $produk == 'TELEPON') {
		$id_ovrs = '5';
	} else if ($todo == 'E' && $produk == 'TELEPON') {
		$id_ovrs = '4';
	} else if ($todo == 'E' && $produk == 'Internet') {
		$id_ovrs = '5';
	} else if ($todo == 'U' && $produk == 'Internet' && $tgls >= 1 &&  $tgls <= 3) {
		$id_ovrs = '3';
	} else if ($todo == 'U' && $produk == 'TELEPON' && $tgls >= 1 &&  $tgls <= 3) {
		$id_ovrs = '2';
	} else if ($todo == 'U' && $produk == 'Internet' && $tgls >= 7 &&  $tgls <= 12) {
		$id_ovrs = '6';
	} else if ($todo == 'U' && $produk == 'TELEPON' && $tgls >= 7 &&  $tgls <= 12) {
		$id_ovrs = '6';
	} else if ($todo == 'U' && $produk == 'Internet' && $tgls >= 16 &&  $tgls <= 20) {
		$id_ovrs = '1';
	} else if ($todo == 'U' && $produk == 'Internet' && $tgls >= 21) {
		$id_ovrs = '3';
	} else if ($todo == 'U' && $produk == 'TELEPON' && $tgls >= 16 &&  $tgls <= 20) {
		$id_ovrs = '1';
	} else if ($todo == 'U' && $produk == 'TELEPON' && $tgls >= 21) {
		$id_ovrs = '2';
	} else if ($todo == 'C' && $produk == 'Internet' && $tgls >= 16 &&  $tgls <= 20) {
		$id_ovrs = '1';
	} else if ($todo == 'C' && $produk == 'Internet' && $tgls >= 21) {
		$id_ovrs = '3';
	} else if ($todo == 'C' && $produk == 'TELEPON' && $tgls >= 16 &&  $tgls <= 20) {
		$id_ovrs = '1';
	} else if ($todo == 'C' && $produk == 'TELEPON' && $tgls >= 21) {
		$id_ovrs = '2';
	} else {
		$id_ovrs = '0';
	}

	echo "id_ovrs : " . $id_ovrs . "notel :" . $notel . "
	";
	if ($id_ovrs != '' && $notel != '') {
		$query_insert  = "INSERT INTO idmsdb.dunning_ovr (id_ovrs,  schedule_id, snd,  periode, 
																notel, produk, tagihan, tgl_insert, 
																cprod,todo,cca,group_id,regional,is_otomatis )
																VALUES( 
																	'" . mysql_escape_string($id_ovrs) . "',  
																	'" . mysql_escape_string($sid) . "',
																	'" . mysql_escape_string($snd) . "',
																	'" . mysql_escape_string($periode_co) . "',
																	'" . mysql_escape_string($notel) . "',
																	'" . mysql_escape_string($produk) . "',
																	'" . mysql_escape_string($saldo) . "', 
																	date(sysdate()), 
																	'" . mysql_escape_string($cprod) . "',
																	'" . mysql_escape_string($todo) . "',
																	'" . mysql_escape_string($cca) . "',
																	'" . mysql_escape_string($group_id) . "',
																	'" . mysql_escape_string($regional) . "',
																	'1')";

		//echo $query_insert;
		$res_insert = mysql_query($query_insert, $my_con3);
		$n = mysql_affected_rows($my_con3);
		$did = mysql_insert_id($my_con3);
		echo $n . "
				";
		echo $did . "
				";
		if ($res_insert) {
			$number++;
			echo $number;
			update_oracle($conn, $cca, $snd);
		}
	}
}

if ($number > 0) {

	$sql_dsch = "UPDATE idmsdb.m_schedule SET `jumlah_data`='$number', exec_time=sysdate() WHERE (`id`='$sid')";
} else {
	$sql_dsch = "DELETE FROM idmsdb.m_schedule WHERE (`id`='$sid')";
}

$sch = mysql_query($sql_dsch, $my_con3);

function update_oracle($conn, $cca, $snd)
{
	$query = "UPDATE pranpc.dunning_ovr SET STATUS= 1
			WHERE snd = :snd AND cca = :cca";

	$upd = oci_parse($conn, $query);
	oci_bind_by_name($upd, ":cca", $cca);
	oci_bind_by_name($upd, ":snd", $snd);

	oci_execute($upd, OCI_DEFAULT) or die(print_r(oci_error($upd)));
	OCICommit($conn);
}

$end = microtime(true);
$totaltime = $end - $start;
echo "benchmark : " . $totaltime . " detik";
$nomor = 1;

@mysql_close($my_con3) or die(mysql_error());
