<?php
header("Access-Control-Allow-Origin: *");
header('Access-Control-Allow-Methods: GET, POST');
header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token , Authorization, Token, token, TOKEN');
include("functions.php");

if(isset($_POST['gameName']) && isset($_POST['gameGenre']) && isset($_POST['gamePegi']) && ($_POST['gamePegi'] <= 18)){
	$gameName = $_POST['gameName'];
	$gameGenre = $_POST['gameGenre'];
	$gamePegi = intval($_POST['gamePegi']);

	echo addGame($gameName,$gameGenre,$gamePegi);
}
?>