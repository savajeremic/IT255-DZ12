<?php
header("Access-Control-Allow-Origin: *");
header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
header("Access-Control-Allow-Headers: X-XSRF-TOKEN");
include("functions.php");

if(isset($_POST['type']) && isset($_POST['price']) && ($_POST['price'] <= 5000)){
	$type = $_POST['type'];
	$price = intval($_POST['price']);

	echo addClothing($type, $price);
}
?>