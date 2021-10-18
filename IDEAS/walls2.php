<?php
require_once '../config.php';

	if(isset($_GET['department_id']) && $_GET['department_id']!=""){
		$where_clause = "AND DEPARTMENTID=$_GET[department_id]" ;
	}
	
	/*
	if($_GET['filt_ol']=='1'){
		$where_clause .= "AND agent_status IN ('On Call')";
	}
	if($_GET['filt_ready']=='1'){
		$where_clause .= "AND DEPARTMENTID=$_GET[department_id]";
	}
	if($_GET['filt_idle']=='1'){
		$where_clause .= "AND DEPARTMENTID=$_GET[department_id]";
	}
	if($_GET['filt_offline']=='1'){
		$where_clause .= "AND DEPARTMENTID=$_GET[department_id]";
	}
	*/
	
	$user	= "SELECT agent_status,COUNT(*) total 
				FROM USERS WHERE DIAL_MODE='PDS' $where_clause 
				GROUP BY agent_status
				";
				
	$user_offline = "0";
	$user_idle = "0";
	$user_ready = "0";
	$user_online = "0";
	
	//echo $user;
	$user	= mysql_query($user);
	while ($row=mysql_fetch_array($user)){
		@extract($row);
		$no++;
		
		if($agent_status =="Off Line"){
			$user_offline = $total;
		}else if($agent_status =="Idle"){
			$user_idle = $total;
		}else if($agent_status =="Ready"){
			$user_ready = $total;
		}else if($agent_status =="On Call"){
			$user_online = $total;
		}
		
	}
	
	$query="SELECT COUNT(DISTINCT trans_id) AS contacted FROM `LIST_CALL_LOG` WHERE status_call='CONTACTED'	$where_clause ";	
	$res=@mysql_query($query);
	$result=mysql_fetch_assoc($res);@extract($result);
	
	
	$list_user = "{\"user_offline\" : \"$user_offline\", \"user_idle\" : \"$user_idle\", \"user_ready\" : \"$user_ready\", \"user_online\" : \"$user_online\",  \"tot_call\" : \"$contacted\"}";
		
	
	//echo "[" . substr($list_user,1,strlen($list_user)) ."]";
	echo $list_user;
	
mysql_close;
?>