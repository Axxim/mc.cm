<?php

require 'libraries/klein.php';
require 'libraries/Mongo_db.php';
include 'config/config.php';

respond(function ($request, $response, $app) {
	global $config;

	$app->db = new Mongo_db($config['mongo']);
});

respond('/', function ($request, $response) {
    $response->render('html/home.html');
});

respond('/shorten?', function($request, $response, $app) {
	global $config;

	$url = $request->param('url');
	if(!filter_var($url, FILTER_VALIDATE_URL)) exit(json_encode(array('status' => 'error', 'message' => 'This is not a url!')));

	$short = getShort();

	if(!$app->db->where(array('short' => $short))->get('urls')) {

		$app->db->insert('urls', array('url' => $url, 'short' => $short));
		echo json_encode(array('status' => 'success', 'short' => $config['site']['base_url'].'s/'.$short));

	}

});

respond('/s/[:shorturl]', function ($request, $response, $app) {
    $shorturl = $request->param('shorturl');
    
    $url = $app->db->where(array('short' => $shorturl))->get('urls');
    $url = $url[0];

    $response->redirect($url['url']);
});

function getShort() {
	$uniqid = uniqid(); 
	$length = strlen($uniqid); 
	$characters = 5; 
	$start = $length - $characters; 
	$uniqid = substr($uniqid , $start ,$characters); 
	return $uniqid; 
}

dispatch();