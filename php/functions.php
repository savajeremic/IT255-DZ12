<?php
include("config.php");
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
	die();
}

function checkIfLoggedIn(){
	global $conn;
	if(isset($_SERVER['HTTP_TOKEN'])){
		$token = $_SERVER['HTTP_TOKEN'];
		$result = $conn->prepare("SELECT * FROM korisnici WHERE token=?");
		$result->bind_param("s", $token);
		$result->execute();
		$result->store_result();
		$num_rows = $result->num_rows;
		if($num_rows > 0)
		{
			return true;
		} else{
			return false;
		}
	}
	else{
		return false;
	}
}

function login($username, $password){
	global $conn;
	$rarray = array();
	if(checkLogin($username, $password)){
		$id = sha1(uniqid());
		$result2 = $conn->prepare("UPDATE korisnici SET token=? WHERE username=?");
		$result2->bind_param("ss", $id, $username);
		$result2->execute();
		$rarray['token'] = $id;
	} else{
		header('HTTP/1.1 401 Unauthorized');
		$rarray['error'] = "Invalid username/password";
	}
	return json_encode($rarray);
}

function checkLogin($username, $password){
	global $conn;
	$password = md5($password);
	$result = $conn->prepare("SELECT * FROM korisnici WHERE username=? AND password=?");
	$result->bind_param("ss", $username, $password);
	$result->execute();
	$result->store_result();
	$num_rows = $result->num_rows;
	if($num_rows > 0)
	{
		return true;
	}
	else{
		return false;
	}
}

function register($username, $password, $email, $ime, $prezime){
	global $conn;
	$rarray = array();
	$errors = "";
	if(checkIfUserExists($username)){
		$errors .= "Username already exists\r\n";
	}
	if(strlen($username) < 5 || $username == ""){
		$errors .= "Username must have at least 5 characters\r\n";
	}
	if(strlen($password) < 5 || $password == ""){
		$errors .= "Password must have at least 5 characters\r\n";
	}/*
	if(strlen($email) < 5){
		$errors .= "Email must contain @gmail.com\r\n";
	}*/
	if(strlen($ime) < 3 || $ime == ""){
		$errors .= "First name must have at least 3 characters\r\n";
	}
	if(strlen($prezime) < 3 || $prezime == ""){
		$errors .= "Last name must have at least 3 characters\r\n";
	}
	if($errors == ""){
		$stmt = $conn->prepare("INSERT INTO korisnici (username,password,email,ime,prezime) VALUES (?,?,?,?,?)");
		$pass = md5($password);
		$stmt->bind_param("sssss", $username, $pass, $email, $ime, $prezime);
		if($stmt->execute()){
			$id = sha1(uniqid());
			$result2 = $conn->prepare("UPDATE korisnici SET token=? WHERE username=?");
			$result2->bind_param("ss", $id, $username);
			$result2->execute();
			$rarray['token'] = $id;
		}else{
			header('HTTP/1.1 400 Bad request');
			$rarray['error'] = "Database connection error";
		}
	} else{
		header('HTTP/1.1 400 Bad request');
		$rarray['error'] = json_encode($errors);
	}
	return json_encode($rarray);
}

function checkIfUserExists($username){
	global $conn;
	$result = $conn->prepare("SELECT * FROM korisnici WHERE username=?");
	$result->bind_param("s",$username);
	$result->execute();
	$result->store_result();
	$num_rows = $result->num_rows;
	if($num_rows > 0)
	{
		return true;
	}
	else{
		return false;
	}
}

function addGame($gameName, $gameGenre, $gamePegi){
	global $conn;
	$rarray = array();
	if(checkIfLoggedIn()){
		$stmt = $conn->prepare("INSERT INTO game (gameName, gameGenre, gamePegi) VALUES (?, ?, ?)");
		$stmt->bind_param("sss", $gameName, $gameGenre, $gamePegi);
		if($stmt->execute()){
		$rarray['success'] = "ok";
		}else{
			$rarray['error'] = "Database connection error";
		}
	} else{
		$rarray['error'] = "Please log in";
		header('HTTP/1.1 401 Unauthorized');
	}
	return json_encode($rarray);
}

function getGames(){
	global $conn;
	$rarray = array();
	if(checkIfLoggedIn()){
		$result = $conn->query("SELECT * FROM game");
		$num_rows = $result->num_rows;
		$game = array();
		if($num_rows > 0)
		{
			$result2 = $conn->query("SELECT * FROM game");
			while($row = $result2->fetch_assoc()) {
				$one_game = array();
				$one_game['id'] = $row['id'];
				$one_game['gameName'] = $row['gameName'];
				$one_game['gameGenre'] = $row['gameGenre'];
				$one_game['gamePegi'] = $row['gamePegi'];
				array_push($game, $one_game);
			}
		}
		$rarray['game'] = $game;
		return json_encode($rarray);
	} else{
		$rarray['error'] = "Please log in";
		header('HTTP/1.1 401 Unauthorized');
		return json_encode($rarray);
	}
}
?>