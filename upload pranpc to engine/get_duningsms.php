<?php
$start=microtime(true);
error_reporting(E_ALL);
ini_set('display_errors', 1);
$tanggal_nya = date('Y-m-d');
ini_set('max_execution_time', 999999);
ini_set('memory_limit', '2048M');
$period_sch = date('Ym');

$tgls = date('d'); 
$tgl_now = date("Y-m-d");

$date1 = strtotime(date("Y-m-d", strtotime($tgl_now)) . " -1 days");
$date1 = strtoupper(date("d-M-y",$date1));

$date2 = strtotime(date("Y-m-d", strtotime($tgl_now)) . " -2 days");
$date2 = strtoupper(date("d-M-y",$date2));

$date3 = strtotime(date("Y-m-d", strtotime($tgl_now)) . " -3 days");
$date3 = strtoupper(date("d-M-y",$date3));

 
require_once('config2.php');

$sql_sch = "INSERT INTO idmsdb.m_schedule (model, periode, jumlah_data, exec_time, `status`, upd, lup, date_upload)
											VALUES( 'DUNING_SMS', 
											'$period_sch', 
											'0', 
											'9999-12-01', 
											'0', 
											'OTOMATIS', 
											sysdate(), 
											date(sysdate()))";
$sch_insert = mysql_query($sql_sch,$my_con3);
$sid = mysql_insert_id($my_con3);
echo $sid."sapi";

if ((int)$tgls==26 || (int)$tgls==27 || (int)$tgls==28 || (int)$tgls==29 || (int)$tgls==30 ||(int)$tgls==31 ||(int)$tgls==1 || (int)$tgls==2 || (int)$tgls==3 || (int)$tgls==4 || (int)$tgls==5)
{
	$limit = 150000;
}else{
	$limit = 500000;

}
	$sql1 = "SELECT * FROM ( 
    SELECT
    c.CCA AS CCA,
    c.SND AS SND,
    replace(c.NO_GSM,'''','') as NO_GSM,
    c.TAGIHAN,
    c.CPROD,
    c.PERIODE,
    c.TGL_INPUT,
    c.ID_MESSAGE,
    c.GROUP_ID,
    c.JENIS,
    CASE WHEN c.REGIONAL  is null then
     B.REGIONAL   
    else
     C.REGIONAL
    end as regional
    FROM
    PRANPC.DUNNING_SMS c  LEFT JOIN P_IDEAS_REGIONAL b ON c.cca=b.cca and c.snd=b.snd
    WHERE
    c.STATUS='0'
    ORDER BY
	c.priority desc,
    c.TGL_INPUT ASC,
    TAGIHAN DESC
                        ) v
                        WHERE rownum<=$limit";
//	echo $sql1;
	$number=0;
	$query=@oci_parse($conn, $sql1);
	oci_execute($query);
	while ($row = oci_fetch_array($query, OCI_BOTH)) {
			//echo "sapi";
			$cca			= $row['CCA'];
			$snd			= $row['SND'];
			$notel			= $row['NO_GSM'];
			$tagihan		= $row['TAGIHAN'];
			$cprod			= $row['CPROD'];
			$periode		= $row['PERIODE'];
			$tgl_input		= $row['TGL_INPUT'];
			$id_message		= $row['ID_MESSAGE'];
			$group_id		= $row['GROUP_ID'];
			$jenis_sms		= $row['JENIS'];
			$regional		= $row['REGIONAL'];
			
			$exist_number = exist_dt($snd,$notel);
			
			if($id_message !='' && $notel!=''){
				if($exist_number > 0)
				{ 
					update_oracle($conn,$snd,$cca);
				}	
				else{
					$query_insert  = "INSERT INTO idmsdb.dunning_sms (
					schedule_id, cca, snd, notel, tagihan, cprod, periode, tgl_insert, id_message, group_id,jenis, tgl_upload,regional, is_otomatis)
																	VALUES( 
																		'".mysql_escape_string($sid)."',
																		'".mysql_escape_string($cca)."',
																		'".mysql_escape_string($snd)."',
																		'".mysql_escape_string($notel)."',
																		'".mysql_escape_string($tagihan)."',
																		'".mysql_escape_string($cprod)."',
																		'".mysql_escape_string($periode)."',
																		'".mysql_escape_string($tgl_input)."',
																		'".mysql_escape_string($id_message)."',
																		'".mysql_escape_string($group_id)."',
																		'".mysql_escape_string($jenis_sms)."',
																		sysdate(),
																		'".mysql_escape_string($regional)."',
																		'1')";

					echo $query_insert;
					$res_insert = mysql_query($query_insert,$my_con3);
					
					if($res_insert){
						$number++;
						update_oracle($conn,$snd,$cca);
					}	
				}
			}
}
//echo $query_insert;
	if($number>0){ 
		$sql_dsch = "UPDATE idmsdb.m_schedule SET `jumlah_data`='$number', exec_time=sysdate() WHERE (`id`='$sid')"; 
		}else{
		$sql_dsch ="DELETE FROM idmsdb.m_schedule WHERE (`id`='$sid')";
		}
	
	$sch = mysql_query($sql_dsch,$my_con3);
 
		
function update_oracle($conn,$snd,$cca){
	$query="UPDATE PRANPC.DUNNING_SMS SET STATUS= 1
			WHERE snd = :snd AND cca = :cca";
	
	$upd=oci_parse($conn,$query);
	oci_bind_by_name($upd, ":snd", $snd);
	oci_bind_by_name($upd, ":cca", $cca);
	
	oci_execute($upd,OCI_DEFAULT) or die ( print_r(oci_error($upd)) );
	OCICommit($conn);
}

function exist_dt($vsnd,$vnotel){
	$mysql_server = "10.60.175.135";
	$mysql_user   = "useridms";
	$mysql_pass   = "idms#1234";
	$mysql_db     = "idmsdb";

	$res          = mysql_connect($mysql_server,$mysql_user,$mysql_pass);
	mysql_select_db($mysql_db);

	$cek_data="SELECT notel FROM dunning_sms WHERE DATE(tgl_upload)=DATE(NOW() - INTERVAL 1 DAY) AND snd='$vsnd' AND notel='$vnotel' and status='0' limit 1";
	$res_data = @mysql_query($cek_data);  
    $vrows = mysql_num_rows($res_data);  
    return $vrows ; 
}

$end=microtime(true);
$totaltime=$end-$start;
echo "benchmark : ".$totaltime." detik";
$nomor=1;

@mysql_close($my_con3) or die(mysql_error());
