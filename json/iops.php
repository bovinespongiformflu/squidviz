<?php

header("Content-Type: application/json");

$file = shell_exec('ceph -s -f json');
$input_json = json_decode($file, false, 100);

$iopsr = $input_json->pgmap->read_op_per_sec;
$iopsw = $input_json->pgmap->write_op_per_sec;
$iops = $iopsr+$iopsw;
$bytesr = $input_json->pgmap->read_bytes_sec;
$bytesw = $input_json->pgmap->write_bytes_sec;

$response = array('bytes_rd' => $bytesr, 'bytes_wr' => $bytesw, 'ops' => $iops);

$output = json_encode($response);

print $output;
?>
