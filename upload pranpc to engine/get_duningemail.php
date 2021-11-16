<?php
$start=microtime(true);
$tanggal_nya = date('Y-m-d');
//$psched = date('Ym');
ini_set('max_execution_time', 999999);
ini_set('memory_limit', '2048M');
//echo "sapi";
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
											VALUES( 'DUNING_EMAIL', 
											'$period_sch', 
											'0', 
											'9999-12-01', 
											'0', 
											'OTOMATIS', 
											sysdate(), 
											date(sysdate()))";
$sch_insert = mysql_query($sql_sch,$my_con3);
$sid = mysql_insert_id($my_con3);
//echo "sapi".$sid;

if( (int)$tgls>=1 && (int)$tgls<=7){
	$jenis = 'E';
}else if( (int)$tgls>=8 && (int)$tgls<=13){
	$jenis = 'F';
}else if( (int)$tgls>=14 ){
	$jenis = 'U';
}

//$limit = 150000;

	$sql1 = "
	SELECT   X.*
	  FROM   (  SELECT   c.CCA AS CCA,
						 c.SND AS SND,
						 c.NAMA,
						 c.JENIS AS TODO,
						 c.EMAIL,
						 c.TAGIHAN,
						 c.CPROD,
						 c.TGL_INPUT,
						 c.PERIODE,
						 c.DUEDATE,
						 c.ID_TEMPLATE,
						 c.GROUP_ID,
						 CASE
							WHEN c.REGIONAL IS NULL THEN B.REGIONAL
							ELSE C.REGIONAL
						 END
							AS regional
				  FROM      PRANPC.DUNNING_EMAIL c
						 LEFT JOIN
							P_IDEAS_REGIONAL b
						 ON c.cca = b.cca AND c.snd = b.snd
				 WHERE   c.STATUS = '0'
			  ORDER BY   c.TGL_INPUT ASC, c.TAGIHAN DESC) X";

	//echo $sql1; c.JENIS = '$jenis' and 
	$number=0;
	$query=oci_parse($conn, $sql1);

	oci_execute($query) or die (print_r(oci_error($query)));
	while ($row = oci_fetch_array($query, OCI_BOTH)) {
			echo "sapii";
			$cca			= $row['CCA'];
			$snd			= $row['SND'];
			$nama			= $row['NAMA'];
			$todo			= $row['TODO'];
			$email_customer	= $row['EMAIL'];
			$tagihan		= $row['TAGIHAN'];
			$duedate		= $row['DUEDATE'];
			$tgl_input		= $row['TGL_INPUT'];
			$cprod			= $row['CPROD'];
			$periode		= $row['PERIODE'];
			$id_template	= $row['ID_TEMPLATE'];
			$group_id		= $row['GROUP_ID'];
			$regional		= $row['REGIONAL'];
			
			$cprod==1?$produk='TELEPON':$produk='Internet'; 

			if($id_template !='' && $email_customer!=''){
				$email_customer =mysql_escape_string($email_customer);
				$query_insert  = "INSERT INTO idmsdb.dunning_email (id_template,  email_customer,  date_insert,  periode,duedate, date_upload,  nama, cca, snd, schedule_id, cprod, produk, todo, tagihan, group_id, regional,is_otomatis)
				VALUES( 
				'".mysql_escape_string($id_template)."',   
				REPLACE(REPLACE('$email_customer','\n',''),'\t',''),  
				'".mysql_escape_string($tgl_input)."',
				'".mysql_escape_string($periode)."',
				'".mysql_escape_string($duedate)."',
				sysdate(),
				'".mysql_escape_string($nama)."',
				'".mysql_escape_string($cca)."',
				'".mysql_escape_string($snd)."',
				'".mysql_escape_string($sid)."', 
				'".mysql_escape_string($cprod)."',
				'".mysql_escape_string($produk)."',
				'".mysql_escape_string($todo)."', 
				'".mysql_escape_string($tagihan)."', 
				'".mysql_escape_string($group_id)."', 
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
	if($number>0){									
		$sql_dsch = "UPDATE idmsdb.m_schedule SET `jumlah_data`='$number', exec_time=sysdate() WHERE (`id`='$sid')";
		//echo $sql_sch;	
		}else{
		 $sql_dsch ="DELETE FROM idmsdb.m_schedule WHERE (`id`='$sid')";
		}
	 $sch = mysql_query($sql_dsch,$my_con3);
	 
function update_oracle($conn,$snd,$cca){
	$query="UPDATE pranpc.DUNNING_EMAIL SET STATUS= '1'
			WHERE snd = :snd AND cca = :cca";
	$upd=oci_parse($conn,$query);
	oci_bind_by_name($upd, ":snd", $snd);
	oci_bind_by_name($upd, ":cca", $cca);
	
	 oci_execute($upd,OCI_DEFAULT) or die ( print_r(oci_error($upd)) );
	OCICommit($conn);
}

function get_regional($conn,$snd,$cca){
	$query="select REGIONAL from P_IDEAS_REGIONAL2 
			WHERE snd = :snd AND cca = :cca";

	$upd=oci_parse($conn,$query);
	oci_bind_by_name($upd, ":snd", $snd);
	oci_bind_by_name($upd, ":cca", $cca);
	
	oci_execute($upd,OCI_DEFAULT) or die ( print_r(oci_error($upd)) );
	OCICommit($conn);
}


$end=microtime(true);
$totaltime=$end-$start;
echo "benchmark : ".$totaltime." detik";
$nomor=1;

@mysql_close($my_con3) or die(mysql_error());
?>