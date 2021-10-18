<?php
require_once '../config.php';
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">

<title>WALLBOARD REALTIME AGENT ACTIVITY</title>
</head>

<body style="margin:20px">
<script src="jquery.js"></script>
<script>
$(document).ready(function() { 
	 setInterval(function(){ 
	 //alert('pds');
	 
	 var id_department = $('#department').val();
	
	if ($('#filter_online').is(':checked')) { 
	  		filt_ol='1';
	}else{ 
	  		filt_ol='0';
	}
	
	if ($('#filter_ready').is(':checked')) { 
	  		filt_ready='1';
	}else{ 
	  		filt_ready='0';
	}
	
	if ($('#filter_idle').is(':checked')) { 
	  		filt_idle='1';
	}else{ 
	  		filt_idle='0';
	}
	
	if ($('#filter_offline').is(':checked')) { 
	  		filt_offline='1';
	}else{ 
	  		filt_offline='0';
	}
		
		
			$.ajax({ 
			url: "walls.php",
			data: "department_id="+id_department+"&filt_ol="+filt_ol+"&filt_ready="+filt_ready+"&filt_idle="+filt_idle+"&filt_offline="+filt_offline,
			dataType:'json',
			cache:false,
			success:function(hasil)
			{ 
				$('#agent_wall').empty();
				$.each(hasil,function(i,val){ 
					//$('#agent_wall').append('<div style="width:200px; margin:3px" class="btn '+val.alert+'"><img class="img-thumbnail" src="'+val.foto+'".jpg"/> <b><font size="4">'+val.username+'</font></b><br/><span style="margin-top:5px">'+val.dial_mode+' - '+val.extension+'</span><br/><small>'+val.icon+' '+val.agent_status+' Since '+val.last_exec+'</small><br/>'+val.login_user+'</div>');
					$('#agent_wall').append('<div style="width:180px; margin:3px" class="btn '+val.alert+'"><div><img src="'+val.foto+'" alt="foto" style="width:180px;height:170px" class="img-thumbnail"></div><b><font size="4">'+val.icon+' '+val.username+'</font></b><br/><span style="margin-top:5px">'+val.dial_mode+' - '+val.extension+'</span><br/><small>'+val.agent_status+' Since '+val.last_exec+'</small><br/>'+val.login_user+'</div>');
					
				});
			}
				
			});
			
			
			$.ajax({ 
			url: "walls2.php",
			data: "department_id="+id_department+"&filt_ol="+filt_ol+"&filt_ready="+filt_ready+"&filt_idle="+filt_idle+"&filt_offline="+filt_offline,
			dataType:'json',
			cache:false,
			success:function(hasil2)
			{ 
				$('#user_online').html(hasil2.user_online);
				$('#user_ready').html(hasil2.user_ready);
				$('#user_idle').html(hasil2.user_idle);
				$('#user_idle').html(hasil2.user_idle);
				$('#user_offline').html(hasil2.user_offline);
				$('#contacted').html(hasil2.tot_call);
				
			}
				
			});
	},2500);

});
	
</script>
<center>
<div><h2>WALLBOARD REALTIME AGENT ACTIVITY [ TELKOM IDEAS ]</h2></div>
</center>
	<div class="small">
		
		Department : 
		<div class="form-inline">
			<div class="input-group">
					<span class="input-group-addon">
						<span class='glyphicon glyphicon-globe'></span>
					</span>

			<select name='department' id='department' class="form-control input-sm">
				<option value=''>All</option>
				<?php
					$q_department = mysql_query("SELECT DEPARTMENTID,DEPARTMENTNAME FROM `DEPARTMENTS` WHERE DEPARTMENTID IN (5,6,7,8,9,10,12) ");
					while ($rows=mysql_fetch_assoc($q_department)){
						@extract($rows);
						echo "<option value='$DEPARTMENTID'>$DEPARTMENTNAME</option>";
					}
				?>
			</select>
			</div>
				<div class="input-group">
					&nbsp;&nbsp;&nbsp;&nbsp;
					&nbsp;&nbsp;&nbsp;&nbsp;
				</div>
				
				<div class="input-group">
					<h4><span class="glyphicon glyphicon-earphone"></span> &nbsp;<input type="checkbox" name="filter_online" id="filter_online" />&nbsp;&nbsp;&nbsp;&nbsp;
					<span class="glyphicon glyphicon-phone-alt"></span> &nbsp;<input type="checkbox" name="filter_ready" id="filter_ready" />&nbsp;&nbsp;&nbsp;&nbsp;
					<span class="glyphicon glyphicon-cutlery"></span> &nbsp;<input type="checkbox" name="filter_idle" id="filter_idle" />&nbsp;&nbsp;&nbsp;&nbsp;
					<span class="glyphicon glyphicon-off"></span> &nbsp;<input type="checkbox" name="filter_offline" id="filter_offline" />&nbsp;&nbsp;&nbsp;&nbsp;
					
					</h4>
				</div>
			
		</div>
	</div>

	<div><hr/></div>
	<table class="table table-bordered">
		<tr>
			<td class="success">
				<h4><span class="glyphicon glyphicon-earphone"></span> Online : <span id="user_online"></span></h4>
			</td>
			<td class="info">
				<h4><span class="glyphicon glyphicon-phone-alt"></span> Ready : <span id="user_ready"></span></h4>
			</td>
			<td class="warning">
				<h4><span class="glyphicon glyphicon-cutlery"></span> Idle : <span id="user_idle"></span></h4>
			</td>
			<td class="active">
				<h4><span class="glyphicon glyphicon-off"></span> Offline : <span id="user_offline"></span></h4>
			</td>
			<td class="danger">
				<h4><span class="glyphicon glyphicon-resize-small"></span> Call Connected : <span id="contacted"></span> (Today)</h4>
			</td>
		</tr>
		
	</table>
	
	<div id="agent_wall" style="width:100%">
	</div>
	
</body>
</html>