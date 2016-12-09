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

/*// lister les jeux dont le nom contient 'Mario', afficher leur nom et deck
$games =
        Game::select('name','deck')
        ->where('name', 'like', '%Mario%')
        ->get();
foreach($games as $game) {
  print_r($game->name .' '. $game->deck .'<br />');
}

// lister 442 jeux à partir du 21173ème, afficher leur nom, deck
$games =
        Game::select('name', 'deck')
        ->skip(21173)->take(442)
        ->get();
foreach($games as $game){
  print_r($game->name .' '. $game->deck .'<br />');
}

// lister les compagnies installées au Japon
$companies = Company::where('location_country', 'like', 'Japan')->get();
foreach($companies as $company){
  print_r($company->name .'<br />');
}

// afficher (name , deck) les personnages du jeu 12342
$game = Game::find(12342);
$characters = $game->characters;
foreach ($characters as $character){
  print_r($character->name . '<br />');
}

// les personnages des jeux dont le nom (du jeu) débute par 'Mario'
$games = Game::where('name', 'like', 'Mario%')->get();
foreach($games as $game){
  print_r("<h4>" . $game->name . "</h4>");
  $characters = $game->characters;
  foreach($characters as $character){
    print_r($character->name . "<br />");
  }
}

// les jeux développés par une compagnie dont le nom contient 'Sony'
$companies = Company::where('name', 'like', '%Sony%')->get();
foreach($companies as $company){
  $games = $company->games;
  print_r("<h4>" . $company->name . "</h4>");
  foreach($games as $game){
    print_r($game->name . "<br />");
  }
}

// le rating initial (indiquer le rating board) des jeux dont le nom contient Mario
$games = Game::where('name', 'like', '%Mario%')->get();
foreach($games as $game){
  print_r("<h2>" . $game->name . "</h2>");
  $ratings = $game->ratings;
  foreach($ratings as $rating){
    print_r("<h4>" . $rating->name . "</h4>");
    $rating_board = RatingBoard::find($rating->rating_board_id);
    print_r($rating_board->name . "<br />");
  }
}

// les jeux dont le nom débute par Mario et ayant plus de 3 personnages
$games = Game::where('name', 'like', 'Mario%')->get();
foreach($games as $game){
  print_r("<h2>". $game->name ."</h2>");
  $characters_number = $game->characters->count();
  if($characters_number > 3){
    $characters = $game->characters;
    foreach($characters as $character){
      print_r($character->name . "<br />");
    }
  }
}

// les jeux dont le nom débute par Mario et dont le rating initial contient "3+"
$games = Game::where('name', 'like', 'Mario%')->get();
foreach($games as $game){
  $ratings = $game->ratings->where('name', 'like', '%3+%')->get();
  foreach($ratings as $rating){
    print_r($rating->name . "<br />");
  }
}

// les jeux dont le nom débute par Mario, publiés par une compagnie dont le nom contient "Inc." et dont le rating initial contient "3+"
$companies = Company::where('name', 'like', '%Inc.%')->get();
foreach($companies as $company){
  $games = $company->games->where('name', 'like', 'Mario%');
  foreach($games as $game){
    $ratings = $game->ratings->where('name','like', '%3+%')->get();
    if(isset($ratings)){
      print_r($game . "<br />");
    }
  }
}*/

$queries = DB::getQueryLog();
echo "<h1>Requêtes SQL générées</h1>";
foreach($queries as $query){
  echo "<pre>";
  var_dump($query['query']);
  echo "</pre>";
}
