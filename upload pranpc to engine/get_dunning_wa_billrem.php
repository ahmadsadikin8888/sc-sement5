<?php

require_once('config2.php');
$start=microtime(true);
$tanggal_nya = date('Y-m-d');
ini_set('max_execution_time', 999999);
ini_set('memory_limit', '2048M');

$tanggal = date('d');

$st_get = "
    select *
    from
    pranpc.dunning_wa
    where
    status = 0
";

echo $st_get;
//exit;

$exec_st_get = oci_parse($conn, $st_get);
oci_execute($exec_st_get,OCI_DEFAULT);

if ($tanggal <= 20) {
    $CAMPAIGN_NAME='bilrem_sb20_v5';
}else {
    $CAMPAIGN_NAME='bilrem_ss20_v5';
}

echo $CAMPAIGN_NAME;

while (($row = oci_fetch_array($exec_st_get, OCI_BOTH))) {
    $CCA=$row['CCA'];
    $NCLI=$row['NCLI'];
    $SND=$row['SND'];
    $SND_GROUP=$row['SND_GROUP'];
    $GSM=$row['GSM'];
    $NAMA=str_replace("'", ' ', $row['NAMA']);
    $ALAMAT=str_replace("'", ' ', $row['ALAMAT']);
    $BA=$row['BA'];
    $GROUP_ID=$row['GROUP_ID'];
    $BUNDLING=$row['BUNDLING'];
    $REGIONAL=$row['REGIONAL'];
    $TOTAG=$row['TOTAG'];
    $STATUS=$row['STATUS'];
    //$CAMPAIGN_NAME='bilrem_sb20_v2';
    $PERIODE=$row['PERIODE'];
    $DUE_DATE=$row['DUE_DATE'];
    $BUL_TAG=$row['BUL_TAG'];
    $GROUP_WA='3';
    $JENIS_WA=$row['JENIS_WA'];
    $TODO=$row['TODO'];
    $LINK_BAYAR='http://myih.ch/cara-bayar';
    $LINK='http://myih.ch/ebs/'.$SND;

    $st_pic = "
    Insert into IDEAS.DUNNING_WA
    (CCA, NCLI, SND, SND_GROUP, GSM, NAMA, ALAMAT, BA, PRODUK, CENTITE, GROUP_ID, BUNDLING, REGIONAL,TAGIHAN ,TOTAG, STATUS, CAMPAIGN_NAME, PERIODE, DUE_DATE, BUL_TAG, GROUP_WA, JENIS_WA, TODO, LINK_BAYAR, LINK)
    Values
    ('$CCA', '$NCLI', '$SND', '$SND_GROUP', '$GSM', '$NAMA', '$ALAMAT', '$BA', '$PRODUK', '$CENTITE', '$GROUP_ID', '$BUNDLING', '$REGIONAL','$TOTAG' ,'$TOTAG', '$STATUS', '$CAMPAIGN_NAME', '$PERIODE', '$DUE_DATE','$BUL_TAG', '$GROUP_WA', '$JENIS_WA', '$TODO', '$LINK_BAYAR','$LINK')
    ";


    $exec_st_pic = oci_parse($conn, $st_pic);
    oci_execute($exec_st_pic,OCI_DEFAULT);

    update_oracle($conn,$SND,$CCA);

    OCICommit($conn);

    echo $st_pic;

}

function update_oracle($conn,$SND,$CCA){
	$query="UPDATE pranpc.dunning_wa SET STATUS= '1'
			WHERE snd = :snd and cca = :cca ";
    
    $upd=oci_parse($conn,$query);
	oci_bind_by_name($upd, ":snd", $SND);
    oci_bind_by_name($upd, ":cca", $CCA);
    
	oci_execute($upd,OCI_DEFAULT) or die ( print_r(oci_error($upd)) );
	OCICommit($conn);
}

OCICommit($conn);

// Close connection
oci_free_statement($query);
oci_close($conn);


$end=microtime(true);
$totaltime=$end-$start;
echo "benchmark : ".$totaltime." detik";

?>
