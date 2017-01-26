<?php

header("Content-Type: application/json");

$file = shell_exec('ceph status --format=json');
$input_json = json_decode($file);
$pgmap = preg_match('/v(\w*):.*/', $input_json->pgmap, $matches);

$response = array('pgmap' => $matches[1]);

$output = json_encode($response);
print $output;

?>
