<?php
session_start();
$vactive_host="10.194.99.11";
function get_url($url,$postdata){

	$ch = curl_init();
	//curl_setopt($ch,CURLOPT_URL,"https://10.194.99.11/test_curl.php");
	curl_setopt($ch,CURLOPT_URL,$url);

	curl_setopt($ch,CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($ch,CURLOPT_SSL_VERIFYHOST, false);
	curl_setopt($ch,CURLOPT_POST,true);
	curl_setopt($ch,CURLOPT_POSTFIELDS,$postdata);
	curl_setopt($ch,CURLOPT_RETURNTRANSFER, true);
		
	$curl_exec = curl_exec($ch);
	curl_close($ch);
	
	//print_r($curl_exec);
	
}

require_once '../config.php';

	if(isset($_GET['department_id']) && $_GET['department_id']!=""){
		$where_clause = "AND a.DEPARTMENTID=$_GET[department_id]" ;
	}
	
	if($_GET['filt_ol']=='1'){
		$stt_agent .= ",'On Call'";
	}
	if($_GET['filt_ready']=='1'){
		$stt_agent .= ",'Ready'";
	}
	if($_GET['filt_idle']=='1'){
		$stt_agent .= ",'Idle'";
	}
	if($_GET['filt_offline']=='1'){
		$stt_agent .= ",'Off Line'";
	}
	
	if ($_GET['filt_ol']=='1' || $_GET['filt_ready']=='1' || $_GET['filt_idle']=='1' || $_GET['filt_offline']=='1' )
	{
		$stt_agent = substr($stt_agent,1,strlen($stt_agent));
		$where_clause .= " AND a.agent_status IN ($stt_agent) ";
		
	}
	
	
	$user	= "SELECT a.USERNAME,a.NAME,a.DIAL_MODE,a.agent_status,a.LOGINID,a.LUP,TIMEDIFF(SYSDATE(),a.LUP) AS last_exec,sysdate() as skrg,a.DEPARTMENTID 
				FROM USERS a WHERE a.USERLEVEL='AGENT' AND a.STATUS='AKTIF' $where_clause AND a.LOGINID!=''  AND a.DIAL_MODE='PDS' AND a.LOGINID IS NOT NULL ORDER BY a.NAME";
	//echo $user;
	$user	= mysql_query($user);
	while ($row=mysql_fetch_array($user)){
		@extract($row);
		$no++;
		/*
		$tCall = "SELECT count(*) as tot_call FROM TRANS WHERE DATE(LUP) = DATE(SYSDATE()) AND STATUS_CALL!='NEW POP UP' AND UPD_AGENT='$USERNAME'";
		$tCall = mysql_query($tCall);
		$tCall = mysql_fetch_array($tCall);@extract($tCall);
		*/
		if($agent_status =="Off Line"){
			$alert="btn-default";
			$icon="<span class='glyphicon glyphicon-off'></span>";
		}else if($agent_status =="Idle"){
			$alert="btn-warning";
			$icon="<span class='glyphicon glyphicon-cutlery'></span>";
		}else if($agent_status =="Ready"){
		
			$x_time = strtotime($skrg) - strtotime($LUP);
			if ($x_time > 300){
				
				 
				if ($x_time > 600){
					$alert="btn-dark";
				}else{
					$alert="btn-info";
				}
				
			}else{
				$alert="btn-primary";
			}
		
			$icon="<span class='glyphicon glyphicon-phone-alt'></span> ";
		}else if($agent_status =="Processing"){
			$alert="btn-info";
			$icon="<span class='glyphicon glyphicon-bell'></span>";
		}else if($agent_status =="On Call"){
			$tTIme = strtotime($skrg) - strtotime($LUP);
			if ($tTIme > 300){
				$alert="btn-danger";
			}else{
				$alert="btn-success";
			}
			$icon="<span class='glyphicon glyphicon-earphone'></span>";
		}
		
		if(file_exists("foto/$USERNAME.jpg")){
			$foto = "foto/$USERNAME.jpg";
		}else{
			$foto = "foto/default.jpg";
		}
		
		
		
		
		/*
		$tTIme = strtotime($skrg) - strtotime($LUP);
		if ($tTIme > 300){
			$alert="btn-danger";
		}
		
			
*/		
		$NAME=explode(" ",$NAME);
		if (strlen($NAME[0]) < 3){
			$nama = $NAME[0] ." ". $NAME[1];
		}else{
			$nama = $NAME[0];
		}
		
		$list_user .= ",{\"username\" : \"$nama\", \"login_user\" : \"$USERNAME - $LOGINID\", \"dial_mode\" : \"$DIAL_MODE\", \"agent_status\" : \"$agent_status\", \"extension\" : \"$LOGINID\",  \"tot_call\" : \"$tot_call\", \"last_exec\" : \"$last_exec\", \"foto\" : \"$foto\", \"icon\" : \"$icon\", \"alert\" : \"$alert\"}";
		
	}
	
	echo "[" . substr($list_user,1,strlen($list_user)) ."]";
	
mysql_close;
?>