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

$start_date = microtime(true);

/*
// lister 442 jeux à partir du 21173ème, afficher leur nom, deck
$games = Game::select('name', 'deck')
                ->skip(21173)->take(442)
                ->get();
foreach($games as $game){
  echo "<pre>"; var_dump($game); echo "</pre>";
}

// les personnages des jeux dont le nom (du jeu) débute par 'Mario'
$games = Game::where('name', 'like', '%Mario')->get();
foreach($games as $game){
  //echo "<pre><h2>$game->name</h2></pre>";
  foreach($game->characters as $character){
    //echo "<pre>$character->name<br /></pre>";
  }
}
$end_date = microtime(true);
print_r("Le programme s'est exéuté en ".($end_date - $start_date)." secondes.");


// les jeux dont le nom débute par Mario et ayant plus de 3 personnages
$games = Game::where('name', 'like', 'Mario%')->get();
foreach($games as $game){
  $characters_number = $game->characters->count();
  if($characters_number > 3){
    echo "<h2>$game->name</h2>";
    foreach($game->characters as $character){
      echo "$character->name<br />";
    }
  }
}

// lister les jeux dont le nom débute par 'Mario'
$games = Game::where('name', 'like', 'Mario%')->get();
$end_date = microtime(true);
print_r("Le programme s'est exéuté en ".($end_date - $start_date)." secondes.");

// lister les jeux dont le nom contient 'Mario'
$games = Game::where('name', 'like', 'Mario')->get();
$end_date = microtime(true);
print_r("Le programme s'est exéuté en ".($end_date - $start_date)." secondes.");


// les jeux dont le nom débute par 'Mario' et dont le rating initial contient '3+'
$games = Game::where('name', 'like', 'Mario%')->get();
foreach($games as $game){
  $ratings = $game->ratings()->where('name', 'like', '%3+%')->get();
}
$end_date = microtime(true);
print_r("Le programme s'est exéuté en ".($end_date - $start_date)." secondes.");


// on recherche souvent des compagnies à partir de leur nom
$companies = Company::where('name', 'like', 'Electronic Arts')->get();
$end_date = microtime(true);
print_r("Le programme s'est exéuté en ".($end_date - $start_date)." secondes.");


// on recherche des compagnies par pays (location_country)
$companies = Company::where('location_country', 'like', 'United Kingdom')->get();
$end_date = microtime(true);
print_r("Le programme s'est exéuté en ".($end_date - $start_date)." secondes.");


// lister les plateformes dont la base installée est >= 10 000 000
$platforms = Platform::where('install_base', '>=', 10000000)->get();
$end_date = microtime(true);
print_r("Le programme s'est exéuté en ".($end_date - $start_date)." secondes.");


// afficher le nom des personnages des jeux dont le nom contient 'Mario'
$characters = Character::select('name')->with(['games' => function($query){
  $query->where('name', 'like', '%Mario%');
}])->get();
foreach($characters as $character){
  echo "$character->name<br />";
}*/

// les jeux développés par une compagnie dont le nom contient 'Sony'
$games = Game::select('name')->with(['companies' => function($query){
  $query->where('name', 'like','%Sony%');
}])->get();
foreach($games as $game){
  echo "$game->name<br />";
}

/*
// les jeux dont le nom débute par Mario et dont le rating initial contient "3+"
$games = Game::where('name', 'like', 'Mario%')->get();
foreach($games as $game){
  $ratings = $game->ratings()->where('name', 'like', '%3+%')->get();
}
$end_date = microtime(true);
print_r("Le programme s'est exéuté en ".($end_date - $start_date)." secondes.");
*/


$queries = DB::getQueryLog();
echo "<h1>Requêtes SQL générées</h1>";
echo "<strong>Nombre de requêtes générées</strong>:".count($queries)."<br /><pre>";
var_dump($queries); echo "</pre>";
