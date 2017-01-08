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
}

// les personnages des jeux dont le nom (du jeu) débute par 'Mario'
$games = Game::where('name', 'like', '%Mario')->get();
foreach($games as $game){
  echo "<pre><h2>$game->name</h2></pre>";
  foreach($game->characters as $character){
    echo "<pre>$character->name<br /></pre>";
  }
}
*/
// les jeux développés par une compagnie dont le nom contient 'Sony'
$companies = Company::where('name', 'like', '%Sony%')->get();
foreach($companies as $company){
  echo "<h4>$company->name</h4>";
  foreach($company->games as $game){
    echo "<pre>$game->name<br /></pre>";
  }
}
/*
// le rating initial (indiquer le rating board) des jeux dont le nom contient Mario
$games = Game::where('name', 'like', '%Mario%')->get();
foreach($games as $game){
  echo "<h2>$game->name</h2>";
  $ratings = $game->ratings;
  foreach($ratings as $rating){
    echo "<h4>$rating->name</h4>";
    $rating_board = RatingBoard::find($rating->rating_board_id);
    echo "$rating_board->name<br />";
  }
}

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

// les jeux dont le nom débute par Mario et dont le rating initial contient "3+"
$games = Game::where('name', 'like', 'Mario%')->get();
foreach($games as $game){
  $ratings = $game->ratings()->where('name', 'like', '%3+%')->get();
  foreach($ratings as $rating){
    echo "$game->name<br />";
  }
}

// les jeux dont le nom débute par Mario, publiés par une compagnie dont le nom contient "Inc." et dont le rating initial contient "3+"
$games = Game::where('name', 'like', 'Mario%')->get();
foreach($games as $game){
  $companies = $game->companies()->where('name', 'like', '%Inc.')->get();
  $ratings = $game->ratings()->where('name', 'like', '%3+%')->get();
  if(isset($companies[0]) && isset($ratings[0])){
    echo "$game->name<br />";
  }
}

// les jeux dont le nom débute Mario, publiés par une compagnie dont le nom contient "Inc", dont le rating initial contient "3+" et ayant reçu un avis de la part du rating board nommé "CERO"
$games = Game::where('name', 'like', 'Mario%')->get();
$cero = RatingBoard::where('name', 'like', 'CERO')->first();
$cero_id = $cero->id;
foreach($games as $game){
  $companies = $game->companies()->where('name', 'like', '%Inc.')->get();
  $ratings = $game->ratings()->whereRaw("'name' like '%3+%' AND 'rating_board_id' = $cero_id")->get();
  if(isset($companies[0]) && isset($ratings[0])){
    echo "$game->name<br />";
  }
}*/

$queries = DB::getQueryLog();
echo "<h1>Requêtes SQL générées</h1>";
foreach($queries as $query){
  echo "<pre>";
  var_dump($query['query']);
  echo "</pre>";
}
