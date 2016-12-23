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
// lister les jeux dont le nom contient 'Mario', afficher leur nom et deck
$games = Game::where('name', 'like', '%Mario%')->get();
foreach($games as $game){
  echo "<pre>"; var_dump($game); echo "</pre>";
}

// lister 442 jeux à partir du 21173ème, afficher leur nom, deck
$games = Game::select('name', 'deck')
                ->skip(21173)->take(442)
                ->get();
foreach($games as $game){
  echo "<pre>"; var_dump($game); echo "</pre>";
}

// lister les compagnies installées au Japon
$companies = Company::where('location_country', 'like', 'Japan')->get();
foreach($companies as $company){
  echo "<pre>"; var_dump($company); echo "</pre>";
}

// lister les plateformes dont la base installée est >= 10 000 000
$platforms = Platform::where('install_base', '>=', 10000000)->get();
foreach($platforms as $platform){
  echo "<pre>"; var_dump($platform); echo "</pre>";
}*/

// compter les personnages dont le genre (gender) est 1
$count_characters = Character::where('gender', '=', 1)->count();
var_dump($count_characters);

$queries = DB::getQueryLog();
echo "<h1>Requêtes SQL générées</h1>";
foreach($queries as $query){
  echo "<pre>";
  var_dump($query['query']);
  echo "</pre>";
}
