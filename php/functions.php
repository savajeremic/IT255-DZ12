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

function addGame($gameName, $gamePegi, $gameGenreID){
	global $conn;
	$rarray = array();
	if(checkIfLoggedIn()){
		$stmt = $conn->prepare("INSERT INTO game (gameName, gamePegi, gameGenreID) VALUES (?, ?, ?)");
		$stmt->bind_param("ssi", $gameName, $gamePegi, $gameGenreID);
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

function addClothing($type, $price){
	global $conn;
	$rarray = array();
	if(checkIfLoggedIn()){
		$stmt = $conn->prepare("INSERT INTO clothing (type, price) VALUES (?, ?)");
		$stmt->bind_param("ss", $type, $price);
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
		$result = $conn->query("SELECT game.id, gameName, gamePegi, (SELECT name FROM gamegenre WHERE id=game.gameGenreID) as gamegenre FROM game");
		$num_rows = $result->num_rows;
		$games = array();
		if($num_rows > 0)
		{
			$result2 = $conn->query("SELECT game.id, gameName, gamePegi, (SELECT name FROM gamegenre WHERE id=game.gameGenreID) as gamegenre FROM game");
			while($row = $result2->fetch_assoc()) {
				$one_game = array();
				$one_game['id'] = $row['id'];
				$one_game['gameName'] = $row['gameName'];
				$one_game['gamePegi'] = $row['gamePegi'];
				$one_game['gamegenre'] = $row['gamegenre'];
				array_push($games, $one_game);
			}
		}
		$rarray['games'] = $games;
		return json_encode($rarray);
	} else{
		$rarray['error'] = "Please log in";
		header('HTTP/1.1 401 Unauthorized');
		return json_encode($rarray);
	}
}

function getGame($id){
	global $conn;
	$rarray = array();
	if(checkIfLoggedIn()){
		$result = $conn->query("SELECT game.id, gameName, gamePegi, (SELECT name FROM gamegenre WHERE id=game.gameGenreID) as gamegenre FROM game WHERE id=".$id);
		$num_rows = $result->num_rows;
		$games = array();
		if($num_rows > 0)
		{
			$result2 = $conn->query("SELECT game.id ,gameName, gamePegi, (SELECT name FROM gamegenre WHERE id=game.gameGenreID) as gamegenre FROM game WHERE id=".$id);
			while($row = $result2->fetch_assoc()) {
				$one_game = array();
				$one_game['id'] = $row['id'];
				$one_game['gameName'] = $row['gameName'];
				$one_game['gamePegi'] = $row['gamePegi'];
				$one_game['gamegenre'] = $row['gamegenre'];
				$games = $one_game;
			}
		}
		$rarray['data'] = $games;
		return json_encode($rarray);
	} else{
		$rarray['error'] = "Please log in";
		header('HTTP/1.1 401 Unauthorized');
		return json_encode($rarray);
	}
}

function editGame($id, $gameName, $gamePegi, $gameGenreID){
    global $conn;
    $rarray = array();
    if(checkIfLoggedIn()){
		$stmt = $conn->prepare("UPDATE game SET gameName=?, gamePegi=?, gameGenreID=? WHERE id=?");
		$stmt->bind_param("ssii", $gameName, $gamePegi, $gameGenreID, $id);
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

function deleteGame($id){
	global $conn;
	$rarray = array();
	if(checkIfLoggedIn()){
		$result = $conn->prepare("DELETE FROM game WHERE id=?");
		$result->bind_param("i", $id);
		$result->execute();
		$rarray['success'] = "Deleted successfully";
	} else{
		$rarray['error'] = "Please log in";
		header('HTTP/1.1 401 Unauthorized');
	}
	return json_encode($rarray);
}

function addGameGenre($name){
	global $conn;
	$rarray = array();
	if(checkIfLoggedIn()){
		$stmt = $conn->prepare("INSERT INTO gamegenre (name) VALUES (?)");
		$stmt->bind_param("s", $name);
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

function getGameGenres(){
	global $conn;
	$rarray = array();
	if(checkIfLoggedIn()){
		$result = $conn->query("SELECT * FROM gamegenre");
		$num_rows = $result->num_rows;
		$gamegenres = array();
		if($num_rows > 0)
		{
			$result2 = $conn->query("SELECT * FROM gamegenre");
			while($row = $result2->fetch_assoc()) {
				$one_room = array();
				$one_room['id'] = $row['id'];
				$one_room['name'] = $row['name'];
				array_push($gamegenres,$one_room);
			}
		}
		$rarray['gamegenres'] = $gamegenres;
		return json_encode($rarray);
	} else{
		$rarray['error'] = "Please log in";
		header('HTTP/1.1 401 Unauthorized');
		return json_encode($rarray);
	}
}

function deleteGameGenre($id){
	global $conn;
	$rarray = array();
	if(checkIfLoggedIn()){
		$result = $conn->prepare("DELETE FROM gamegenre WHERE id=?");
		$result->bind_param("i",$id);
		$result->execute();
		$rarray['success'] = "Deleted successfully";
	} else{
		$rarray['error'] = "Please log in";
		header('HTTP/1.1 401 Unauthorized');
	}
	return json_encode($rarray);
}

?>