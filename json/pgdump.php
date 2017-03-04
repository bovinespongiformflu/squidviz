<?php

header("Content-Type: application/json");

$pools = array();

$file = shell_exec('ceph osd dump --format=json');
$osd_dump = json_decode($file);
foreach ( $osd_dump->pools as $pool ) { $pools[$pool->pool] = $pool->pool_name; }

$file = shell_exec('ceph pg dump --format=json');
$pg_dump = json_decode(preg_replace('/^.+\n/', '', $file));

$pgTree = array('name' => 'cluster', 'version' => $pg_dump->version, 'children' => array());

foreach ( $pg_dump->pg_stats as $pg )
{
	if (strpos($pg->state, 'active+clean') !== false) {
        continue;
    	}
	list ($pool, $group) = explode('.', $pg->pgid);
	
	$poolindex = -1;

       	for ($x = 0; $x < count($pgTree['children']); $x++)
	{
		if ($pgTree['children'][$x]['name'] == $pool) { $poolindex = $x; }
	}

	$pgNode = array(
		"name" => $group,
		"pool_name" => $pools[$pool],
		"pgid" => $pg->pgid,
		"objects" => $pg->stat_sum->num_objects,
		"state" => $pg->state
	);

	// if ($pools[$pool] != "data" && $pools[$pool] != "metadata" && $pools[$pool] != "rbd") {
		if ($poolindex != -1) // existing pool
		{
			$pgTree['children'][$poolindex]['children'][] = $pgNode;
		}
		else
		{
			$pgTree['children'][] = array(
				"name" => $pool,
				"pool_name" => $pools[$pool],
				"children" => array($pgNode)
			);
   		}
	//}
}

$output = json_encode($pgTree);

//var_dump($pgTree);
print $output;

?>
