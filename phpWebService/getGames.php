<?php
header("Access-Control-Allow-Origin:*");
header('Access-Control-Allow-Headers: X-Requested-With');
header("Content-type: application/json");
$test_array =  array(
	array
	(
		'id' => '1',
		'name' => 'The Witcher 1',
		'genre' => 'action role-playing',
		'pegi' => '18',
	),
	array
	(
		'id' => '2',
		'name' => 'The Witcher 2',
		'genre' => 'action role-playing,hack and slash',
		'pegi' => '18',
	),
	array
	(
		'id' => '3',
		'name' => 'The Witcher 3',
		'genre' => 'action role-playing',
		'pegi' => '18',
	),
	array
	(
		'id' => '4',
		'name' => 'Outlast 2',
		'genre' => 'first-person,survival horror',
		'pegi' => '18',
	),
	array
	(
		'id' => '5',
		'name' => 'Gwent',
		'genre' => 'free-to-play,collectible card game',
		'pegi' => '12',
	),
	array
	(
		'id' => '6',
		'name' => 'Rayman Legends',
		'genre' => 'platform',
		'pegi' => '7',
	),
	array
	(
		'id' => '7',
		'name' => 'The Elder Scrolls V Skyrim',
		'genre' => 'open world,action role-playing',
		'pegi' => '18',
	),
	array
	(
		'id' => '8',
		'name' => 'Worms',
		'genre' => 'artillery,strategy',
		'pegi' => '12',
	),
	array
	(
		'id' => '9',
		'name' => 'Heroes of Might and Magic III',
		'genre' => 'turn-based strategy',
		'pegi' => '18',
	),
	array
	(
		'id' => '10',
		'name' => 'Chivalry: Medieval Warfare',
		'genre' => 'multiplayer,hack and slash ',
		'pegi' => '18',
	)
);
echo json_encode($test_array);
?>
