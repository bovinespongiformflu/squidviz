<?php

header("Content-Type: application/json");

#$file = shell_exec('ceph status --format=json');
#print $file;
#$input_json = json_decode($file);
#$pgmap = preg_match('/(\w*):.*/', $input_json->pgmap, $matches);
$matches[1]=100;
$response = array('pgmap' => $matches[1]);
$output = json_encode($response);
print $output;
?>
