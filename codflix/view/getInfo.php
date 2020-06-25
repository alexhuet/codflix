<?php
require_once( '/wamp/www/codflix/model/database.php' );
$db   = init_db();
error_reporting(E_ALL);
ini_set('display_errors', 1);
$key = "36107050bada16c1bb7861e5187a4f09";

$json = file_get_contents("https://api.themoviedb.org/3/movie/571?api_key=36107050bada16c1bb7861e5187a4f09");


//GENRE//

// for ($idMovie=0; $idMovie  <500;$idMovie++){
// 	$json = file_get_contents("https://api.themoviedb.org/3/movie/$idMovie?api_key=$key&language=en-US&page=1");
// 	$result = json_decode($json, true);

// 	// -------Remplissage tab genre-----------//
// 	$req = $db->prepare('INSERT INTO genre (name, id) VALUES(:name , :id)');
// 	for($i = 0; $i < count($result["genres"]) ; $i++) {
// 		$genre = $result["genres"][$i];
// 		try {
// 			$req->bindValue(':name', $genre["name"], PDO::PARAM_STR);
// 			$req->bindValue(':id', $genre["id"], PDO::PARAM_INT);
// 			$req->execute();
// 			var_dump($req->errorInfo());
// 		} catch(PDOException $e) {
// 			echo $e->getMessmeage();
// 		}
// 	}

// }

$json = file_get_contents("https://api.themoviedb.org/3/movie/popular?api_key=$key&language=en-US&page=1"); // recup les films les plus polulaire



	// -------Remplissage tab media-----------//
//for ($idMovie=0;$idMovie<300;$idMovie++){
	$json = file_get_contents("https://api.themoviedb.org/3/movie/550?api_key=$key");
	var_dump("https://api.themoviedb.org/3/movie/$idMovie?api_key=$key");
	$result = json_decode($json, true);
	if (isset($result['original_title'])){
		$titre = $result['original_title'];
		$genre_id = $result['genres'][0]['id'];
		$poster = 'https://image.tmdb.org/t/p/w500/' . $result['backdrop_path'];
		$type = 'movie';
		$status = $result['status'];
		$release = $result['release_date'];
		$vote_count = $result['vote_count'];
		$vote_avertage = $result['vote_average'];
		$summary = $result['overview'];
		$runtime = $result['runtime'];
		$trailer_url = NULL;
//	Var_dump
		var_dump('$titre: ' . $titre);
		var_dump('$genre_id: ' . $genre_id);
		var_dump('$poster: ' . $poster);
		var_dump('$type: ' . $type);
		var_dump('$status: ' . $status);
		var_dump('$release: ' . $release);
		var_dump('$vote_count: ' . $vote_count);
		var_dump('$vote_avertage: ' . $vote_avertage);
		var_dump('$summary: ' . $summary);
		var_dump('$runtime: ' . $runtime);
		var_dump('$trailer_url: ' . $trailer_url);
		$reqInsert = "INSERT INTO media (genre_id, title, poster, type, status, release_date, vote_count, vote_avertage, summary, runtime, trailer_url) VALUES ('$genre_id','$titre','$poster','$type','$status','$release','$vote_count','$vote_avertage','$summary','$runtime','$trailer_url')";
		$sqlInsert = $db->prepare($reqInsert);
		$sqlInsert->execute();
	}else{
		$idMovie=$idMovie++;
	}
//}

