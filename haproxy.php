<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once('config.php');

if (isset($_GET['path'])) {
	if (isset($config['api_password'])) { $url = $config['hass_url'] . '/' . $_GET['path'] . '?api_password=' . $config['api_password']; }
	else { $url = $config['hass_url'] . '/' . $_GET['path']; }
	
	$data = file_get_contents($url);
	header('Content-Type: text/json');
	echo $data;
}
?>