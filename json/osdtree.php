<?php

header("Content-Type: application/json");

//$name = 'cephdemo-tree.json';
//$fp = fopen($name, 'r');
//$file = file_get_contents($name,0,null,null);

$file = shell_exec('ceph osd tree --format=json');

$input_json = json_decode($file);

$nodes = array();

foreach ( $input_json->nodes as $node )
{
	$nodes[$node->id] = $node;
}

function buildNode($nodeID) {
	global $nodes;

	$return = array(
		"name" => $nodes[$nodeID]->name,
		"status" => $nodes[$nodeID]->status,
		"children" => array()
	);

	if (count($nodes[$nodeID]->children)) {
		foreach ($nodes[$nodeID]->children as $child) {
			$return['children'][] = buildNode($child);
		}
	}

	return $return;
}

$nodeTree = buildNode(-1);

$output = json_encode($nodeTree);

//var_dump($nodeTree);;
print $output;

?>
