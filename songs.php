<?php

$pg;

function rpc_init() {
	global $pg;
	$pg = pg_connect("dbname=songs user=rat");
}

function rpc_close() {
	global $pg;
	@pg_close($pg);
}

function list_songs($arg) {

	global $pg;

	$array = Array();

	$r = pg_query($pg, 'select * from songs limit 50');

	while ( $song = pg_fetch_assoc($r) ) {
		array_push( $array, $song );
	}

	return $array;

}

