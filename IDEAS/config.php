<?php

//session_save_path("session");


	date_default_timezone_set('Asia/Jakarta');
	//$mysql_server="172.3.21.95";
	//$mysql_user = "dian";
	//$mysql_pass = "d1an";
	//$mysql_db = "hris-nasional";
	session_start();
	//$mysql_host="localhost";
	//$mysql_user="root";
	//$mysql_pasw="";
	
	ini_set('max_execution_time', 60000000);
	ini_set("memory_limit","512M");

	
	
	$mysql_server="10.60.175.133";
	$mysql_user = "userideas";
	$mysql_pass = "ideas#1234";
	$mysql_db = "ideasdb";
	
	$res=mysql_connect($mysql_server,$mysql_user,$mysql_pass);
	mysql_select_db($mysql_db);
	//$urlHost="http://10.2.15.25/";
	//$urlHost="http://172.7.4.13/";
	//$urlApi="http://172.7.4.13/";
	
	$urlHost="http://10.2.15.25/";
	$urlApi="http://10.2.15.25/";
	/*
	$urlHost="http://10.194.98.11/";
	$urlApi="http://10.194.98.11/";
	*/

	$urlDashboard="http://10.60.175.132/dashboard_ideas/";	
	
	//$rows="15";
	$rows="100";
	
	//params
	$date = date("Y-m-d H:i:s");
	$date_label = "%d-%m-%Y";
	//$lup_by="admin";
	
	//message
	$add="Add data successfully";
	$edit="Edit data successfully";
	$delete="Delete data successfully";
	
	
	function date_data($date_text){

		list($day, $month, $year) = split('[/.-]', $date_text);

		$my_date=$year."-".$month."-".$day;

		return  $my_date;
	}
	
	function date_text($date_text){

		list($year, $month, $day) = split('[/.-]', $date_text);

		$my_date=$day."-".$month."-".$year;

		return  $my_date;
	}
	
	function date_oci($date_text){

		$arr=explode("/",$date_text);

		$my_date=$arr[0]."-".$arr[1]."-".$arr[2];

		return  $my_date;
	}
	
	function date_grid($date_text){

		list($day, $month, $year) = split('[/.-]', $date_text);

		$my_date=$day."/".$month."/".$year;

		return  $my_date;
	}
	
	function date_excel($date_text){

		list($day, $month, $year) = split('[/]', $date_text);

		$my_date=$year."-".$month."-".$day;

		return  $my_date;
	}
	
	function date_blank($date_text){

		$my_date = $date_text;
		if($my_date=="0000-00-00"){
			$my_date = "";
		}else{
			$my_date = $date_text;
		}

		return  $my_date;
	}
	
	function isNumeric($n){
		if( preg_match( '/^\d+$/', $n ) ) 
		{ 
			return "1";
		}
		else
		{
			return "0";
		}
	}
	
	function isFloat($n){
    	return ( $n == strval(floatval($n)) )? 1 : 0;
	}
	
	
	function date_local($date){
    	return date("d-m-Y H:i:s", strtotime($date));
	}

	function date_local2($date){
    	return date("d-m-Y", strtotime($date));
	}
	
	
	function date_db($date){
    	return date("Y-m-d H:i:s", strtotime($date));
	}
	
	
	function date_db_minutes($date){
    	return date("Y-m-d H:i", strtotime($date));
	}
	
	function date_stream($date){
    	return date("c", strtotime($date));
	}
	
	
	function date_tgl_bayar($str){
    	
		$thn = substr($str, 0, 4);
		$bln = substr($str, 4, 2);
		
		$tgl = substr($str, 6, 2);
		
		$jam = substr($str, 8, 2);
		$min = substr($str, 10, 2);
		$sec = substr($str, 12, 2);
		
		//return $tgl ."-".$bln."-".$thn." ".$jam.":".$min.":".$sec;
		return $thn ."-".$bln."-".$tgl." ".$jam.":".$min.":".$sec;
	}
	
	

	
?>