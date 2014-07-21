<?php
// rpc.php
// Remote Procedure Handler
session_start();

include_once("songs.php");

$jraw = file_get_contents('php://input');
$json = json_decode($jraw);

if ( $json === null ) {
	$json = new stdClass();
	$json->method = null;
	$json->id = null;
}

$r = new stdClass();
$r->error = null;
$r->id = $json->id;

if ( function_exists("rpc_init") ) { call_user_func("rpc_init"); }

// auto check function exists
if ( function_exists( $json->method ) ) {
	$array = object2array( $json->params );

	try {
		$r->result = call_user_func_array( $json->method, $array );
	}
	catch (Exception $e) {
		$r->error = $e->getMessage();
	}
}
else {

	switch ( $json->method ) {
	default:
		$r->result = "Bad input: " . $jraw;
	}
}

echo json_encode($r);

if ( function_exists("rpc_close") ) { call_user_func("rpc_close"); }

exit(0);

function object2array($object) {
	if (is_object($object)) {
		foreach ($object as $key => $value) {
			$array[$key] = $value;
		}
	}
	else {
		$array = $object;
	}
	return $array;
}