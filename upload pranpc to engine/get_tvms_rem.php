<?php
$start = microtime(true);
$tanggal_nya = date('Y-m-d');
ini_set('max_execution_time', 999999);
ini_set('memory_limit', '2048M');

$period_sch  = date('Ym');

$tgls        = date('d');
$tgl_now     = date("Y-m-d");

//set cut off
if ((int)$tgls == 1 || (int)$tgls == 2 || (int)$tgls == 3) {
    $periode_tag = "to_CHAR(ADD_MONTHS(SYSDATE,-1),'YYYYMM') as PERIODE,";
} else {
    $period_tag = "";
}


$date1 = strtotime(date("Y-m-d", strtotime($tgl_now)) . " -1 days");
$date1 = strtoupper(date("d-M-y", $date1));

$date2 = strtotime(date("Y-m-d", strtotime($tgl_now)) . " -2 days");
$date2 = strtoupper(date("d-M-y", $date2));

$date3 = strtotime(date("Y-m-d", strtotime($tgl_now)) . " -3 days");
$date3 = strtoupper(date("d-M-y", $date3));

require_once('config2.php');

$limit = 700000;

$sql_sch = "INSERT INTO idmsdb.m_schedule (model, periode, exec_time, upd, lup, date_upload)
VALUES( 'TVMS',
'$period_sch',

CONCAT(date(sysdate()),' 08:00:00'),
'OTOMATIS',
sysdate(),
date(sysdate()))";
$sch_insert = mysql_query($sql_sch, $my_con3);
$id_schedule = mysql_insert_id($my_con3);

$sql1  = "SELECT * FROM (
SELECT
p.NCLI,
$periode_tag
p.NO_INTERNET,
p.NO_TLP as NOTEL,
p.BA,
p.CENTITE,
p.NAMA,
p.BILL_N as TAGIHAN,
p.GROUP_ID,
P.CCA,
p.REGIONAL
FROM
PRANPC.POTENSI_RT p
WHERE
p.STATUS='S' AND (p.REMINDING IS null OR p.REMINDING ='0')
) v
WHERE rownum<=$limit";

echo $sql1;

$number = 0;

$query  = @oci_parse($conn, $sql1);

@oci_execute($query) or die(print_r(oci_error($query)));
$part = 1;
while ($row = oci_fetch_array($query, OCI_BOTH)) {
    if ($part > 10) {
        $part = 1;
    }
    //echo $todo;
    $ncli        = $row['NCLI'];
    $no_internet = $row['NO_INTERNET'];
    $ba          = $row['BA'];
    $centite     = $row['CENTITE'];

    if ((int)$tgls == 1 || (int)$tgls == 2 || (int)$tgls == 3) {
        $periode_co = $row['PERIODE'];
    } else {
        $periode_co = $period_sch;
    }
    $notel          = $row['NOTEL'];
    $tagihan        = $row['TAGIHAN'];
    $nama           = $row['NAMA'];
    $group_id       = $row['GROUP_ID'];
    $cca            = $row['CCA'];
    $regional        = $row['REGIONAL'];


    //echo $nama.' - '.$periode;

    if ($no_internet != '' && $id_schedule != '') {
        $query_insert = "INSERT INTO idmsdb.tvms_broadcast (
        id_schedule,
        ncli,
        no_internet,
        periode,
        notel,
        nama,
        tagihan,
        tgl_insert,
        template,
        ba,
        centite,
        part,
        kategori,
        is_otomatis,
        is_submit,cca,group_id,regional
        )
        VALUES
        (
        '" . mysql_escape_string($id_schedule) . "',
        '" . mysql_escape_string($ncli) . "',
        '" . mysql_escape_string($no_internet) . "',
        '" . mysql_escape_string($periode_co) . "',
        '" . mysql_escape_string($notel) . "',
        '" . mysql_escape_string($nama) . "',
        '" . mysql_escape_string($tagihan) . "',
        DATE(SYSDATE()),
        '2',
        '" . mysql_escape_string($ba) . "',
        '" . mysql_escape_string($centite) . "',
        '" . $part . "',
        'Reminding',
        '1',0,'" . mysql_escape_string($cca) . "',
        '" . mysql_escape_string($group_id) . "',
		'" . mysql_escape_string($regional) . "'
        )";

        echo $query_insert;
        $res_insert   = mysql_query($query_insert, $my_con3);

        if ($res_insert) {
            $number++;
            $part++;
            update_oracle($conn, $no_internet);
        }
    }
}

if ($number > 0) {

    $sql_sch    = "UPDATE idmsdb.m_schedule SET jumlah_data='$number' WHERE (`id`='$id_schedule')";
    //echo $sql_sch;
    $sch_insert = mysql_query($sql_sch, $my_con3);
} else {
    $sql_sch    = "delete from idmsdb.m_schedule WHERE (`id`='$id_schedule')";
    //echo $sql_sch;
    $sch_insert = mysql_query($sql_sch, $my_con3);
}

function update_oracle($conn, $no_internet)
{
    $query = "UPDATE PRANPC.POTENSI_RT SET REMINDING=1
    WHERE NO_INTERNET = :no_internet";

    $upd   = oci_parse($conn, $query);
    oci_bind_by_name($upd, ":no_internet", $no_internet);

    oci_execute($upd, OCI_DEFAULT);
    OCICommit($conn);
}

$end = microtime(true);
$totaltime = $end - $start;
echo "benchmark : " . $totaltime . " detik";
$nomor = 1;

@mysql_close($my_con3) or die(mysql_error());
