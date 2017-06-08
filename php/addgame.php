<?php
header("Access-Control-Allow-Origin: *");
header('Access-Control-Allow-Methods: GET, POST');
header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token , Authorization, Token, token, TOKEN');
include("functions.php");

if(isset($_POST['gameName']) && isset($_POST['gamePegi']) && ($_POST['gamePegi'] <= 18)){
	$gameName = $_POST['gameName'];
	$gamePegi = intval($_POST['gamePegi']);
	
	if(isset($_POST['gameGenreID']) && !empty($_POST['gameGenreID'])){
		$gameGenreID = intval($_POST['gameGenreID']);
	} else{
		$gameGenreID = null;
	}
	
	echo addGame($gameName,$gamePegi,$gameGenreID);
}
?>