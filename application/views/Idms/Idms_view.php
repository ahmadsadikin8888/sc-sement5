<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Welcome to CodeIgniter</title>

	<style type="text/css">

	::selection { background-color: #E13300; color: white; }
	::-moz-selection { background-color: #E13300; color: white; }

	body {
		background-color: #fff;
		margin: 40px;
		font: 13px/20px normal Helvetica, Arial, sans-serif;
		color: #4F5155;
	}

	a {
		color: #003399;
		background-color: transparent;
		font-weight: normal;
	}

	h1 {
		color: #444;
		background-color: transparent;
		border-bottom: 1px solid #D0D0D0;
		font-size: 19px;
		font-weight: normal;
		margin: 0 0 14px 0;
		padding: 14px 15px 10px 15px;
	}

	code {
		font-family: Consolas, Monaco, Courier New, Courier, monospace;
		font-size: 12px;
		background-color: #f9f9f9;
		border: 1px solid #D0D0D0;
		color: #002166;
		display: block;
		margin: 14px 0 14px 0;
		padding: 12px 10px 12px 10px;
	}

	#body {
		margin: 0 15px 0 15px;
	}

	p.footer {
		text-align: right;
		font-size: 11px;
		border-top: 1px solid #D0D0D0;
		line-height: 32px;
		padding: 0 10px 0 10px;
		margin: 20px 0 0 0;
	}

	#container {
		margin: 10px;
		border: 1px solid #D0D0D0;
		box-shadow: 0 0 8px #D0D0D0;
	}
	</style>
</head>
<body>

<div id="container">
	<h1>Total Order WA</h1>

	<div id="body">
	<?php
		echo "<pre>";
		print_r($totalOrderWa);
		echo "</pre>";
	?>
	</div>

	<h1>Total Proses WA</h1>

<div id="body">
<?php
	echo "<pre>";
	print_r($totalProsesWa);
	echo "</pre>";
?>
</div>
<h1>Total Tagihan WA</h1>

	<div id="body">
	<?php
		echo "<pre>";
		print_r($totalTagihanWa);
		echo "</pre>";
	?>
	</div>

<h1>Total Order SMS</h1>

	<div id="body">
	<?php
		echo "<pre>";
		print_r($totalOrderSms);
		echo "</pre>";
	?>
	</div>

	<h1>Total Proses SMS</h1>

<div id="body">
<?php
	echo "<pre>";
	print_r($totalProsesSms);
	echo "</pre>";
?>
</div>
<h1>Total Tagihan SMS</h1>

	<div id="body">
	<?php
		echo "<pre>";
		print_r($totalTagihanSms);
		echo "</pre>";
	?>
	</div>

<h1>Total Payment SMS</h1>

	<div id="body">
	<?php
		echo "<pre>";
		print_r($totalPaymentSms);
		echo "</pre>";
	?>
	</div>

<h1>Total Order Email</h1>

	<div id="body">
	<?php
		echo "<pre>";
		print_r($totalOrderEmail);
		echo "</pre>";
	?>
	</div>

	<h1>Total Proses Email</h1>

<div id="body">
<?php
	echo "<pre>";
	print_r($totalProsesEmail);
	echo "</pre>";
?>
</div>
<h1>Total Tagihan Email</h1>

	<div id="body">
	<?php
		echo "<pre>";
		print_r($totalTagihanEmail);
		echo "</pre>";
	?>
	</div>

<h1>Total Payment Email</h1>

	<div id="body">
	<?php
		echo "<pre>";
		print_r($totalPaymentEmail);
		echo "</pre>";
	?>
	</div>


<h1>Total Order Ovr</h1>

<div id="body">
<?php
	echo "<pre>";
	print_r($totalOrderOvr);
	echo "</pre>";
?>
</div>

<h1>Total Proses Ovr</h1>

<div id="body">
<?php
echo "<pre>";
print_r($totalProsesOvr);
echo "</pre>";
?>
</div>
<h1>Total Tagihan Ovr</h1>

<div id="body">
<?php
	echo "<pre>";
	print_r($totalTagihanOvr);
	echo "</pre>";
?>
</div>

<h1>Total Payment Ovr</h1>

<div id="body">
<?php
	echo "<pre>";
	print_r($totalPaymentOvr);
	echo "</pre>";
?>
</div>

<h1>Total Order Tvms</h1>

<div id="body">
<?php
	echo "<pre>";
	print_r($totalOrderTvms);
	echo "</pre>";
?>
</div>

<h1>Total Proses Tvms</h1>

<div id="body">
<?php
echo "<pre>";
print_r($totalProsesTvms);
echo "</pre>";
?>
</div>
<h1>Total Tagihan Tvms</h1>

<div id="body">
<?php
	echo "<pre>";
	print_r($totalTagihanTvms);
	echo "</pre>";
?>
</div>

<h1>Total Payment Tvms</h1>

<div id="body">
<?php
	echo "<pre>";
	print_r($totalPaymentTvms);
	echo "</pre>";
?>
</div>

<h1>Total Order Obc</h1>

<div id="body">
<?php
	echo "<pre>";
	print_r($totalOrderObc);
	echo "</pre>";
?>
</div>

<h1>Total Proses Obc</h1>

<div id="body">
<?php
echo "<pre>";
print_r($totalProsesObc);
echo "</pre>";
?>
</div>
<h1>Total Tagihan Obc</h1>

<div id="body">
<?php
	echo "<pre>";
	print_r($totalTagihanObc);
	echo "</pre>";
?>
</div>

<h1>Total Payment Obc</h1>

<div id="body">
<?php
	echo "<pre>";
	print_r($totalPaymentObc);
	echo "</pre>";
?>
</div>

</div>

</body>
</html>