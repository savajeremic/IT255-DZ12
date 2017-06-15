<?php
header("Access-Control-Allow-Origin: *");
header('Access-Control-Allow-Methods: POST');  
header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token, Authorization, Token, token, TOKEN');
include("functions.php");

if(isset($_POST['id']) && isset($_POST['gameName']) && isset($_POST['gamePegi']) && isset($_POST['gameGenreID'])){ 
	
	$id = $_POST['id'];
	$gameName = $_POST['gameName'];
	$gamePegi = $_POST['gamePegi'];
	$gameGenreID = $_POST['gameGenreID'];

	echo editGame($id, $gameName, $gamePegi, $gameGenreID);
}
?>