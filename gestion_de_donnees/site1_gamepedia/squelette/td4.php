<?php

require_once("vendor/autoload.php");

app\config\AppConf::bootEloquent('game.conf.ini');

use Illuminate\Database\Capsule\Manager as DB;
DB::connection()->enableQueryLog();

Use app\models\Game;
Use app\models\User;
Use app\models\Comment;

echo  "
      <a href='td4.php?id=1'>Créer 2 utilisateurs, 3 commentaires par utilisateurs, tous concernant le jeu 12342.</a>
      <br />
      <a href='td4.php?id=2'>Générer 25 000 utilisateurs et 250 000 commentaires.</a>";

// On crée 2 utilisateurs, 3 commentaires par utilisateurs, tous concernant le jeu 12342
if(isset($_GET['id']) && $_GET['id'] == 1){

  // On crée un premier utilisateur
  $user1 = new User();
  $user1->mail = "user1@mail.fr";
  $user1->save();

  // On crée un deuxième utilisateur
  $user2 = new User();
  $user2->mail = "user2@mail.fr";
  $user2->save();

  // On insère les 3 commentaires par utilisateur pour le jeu 12342
  $users = User::get();

  for($i = 0; $i < 3; $i++){
    $comments = $users->each(function($user){
      $comment = new Comment();
      $comment->text = "C";
      $comment->user_id = $user->id;
      $comment->game_id = 12342;
      $comment->save();
    });
  }

}

// On génére 25000 utilisateurs et 250 000 commentaires
if(isset($_GET['id']) && $_GET['id'] == 2){

  require_once("vendor/fzaninotto/faker/src/autoload.php");
  $faker = Faker\Factory::create();

  // On crée 25 000 utilisateurs
  for($i = 0; $i < 25000; $i++){
    $new_user = new User();
    $new_user->mail = $faker->email;
    $new_user->save();
  }

  $users = User::select('id')->get();
  $users_id_tab = [];
  foreach($users as $user){
    array_push($users_id_tab, $user->id);
  }

  $games = Game::select('id')->get();
  $games_id_tab = [];
  foreach($games as $game){
    array_push($games_id_tab, $game->id);
  }

  // On crée les 250 000 commentaires
  for($i = 0; $i < 250000; $i++){

    // On récupère une clé primaire dans la table user
    $key_id_user = array_rand($users_id_tab);
    $key_id_game = array_rand($games_id_tab);
    $id_user = $users_id_tab[$key_id_user];
    $id_game = $games_id_tab[$key_id_game];
    echo "$id_user $id_game<br />";

    $new_comment = new Comment();
    $new_comment->text = $faker->text;
    $new_comment->user_id = $id_user;
    $new_comment->game_id = $id_game;
    $new_comment->save();
  }

}
