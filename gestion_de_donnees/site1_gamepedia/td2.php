<?php

require_once("vendor/autoload.php");

app\config\AppConf::bootEloquent('game.conf.ini');

use Illuminate\Database\Capsule\Manager as DB;
DB::connection()->enableQueryLog();

Use app\models\Game;
Use app\models\Character;
Use app\models\Company;
Use app\models\GameRating;
Use app\models\RatingBoard;
Use app\models\Platform;

/*
// afficher (name , deck) les personnages du jeu 12342
$characters = Game::find(12342)->characters()->select('name', 'deck')->get();
foreach($characters as $character){
  echo "<pre>"; var_dump($character); echo "</pre>";
}*/

// les personnages des jeux dont le nom (du jeu) débute par 'Mario'
$games = Game::where('name', 'like', '%Mario')->get();
foreach($games as $game){
  echo "<pre><h2>$game->name</h2></pre>";
  foreach($game->characters as $character){
    echo "<pre>$character->name<br /></pre>";
  }
}

$queries = DB::getQueryLog();
echo "<h1>Requêtes SQL générées</h1>";
foreach($queries as $query){
  echo "<pre>";
  var_dump($query['query']);
  echo "</pre>";
}
