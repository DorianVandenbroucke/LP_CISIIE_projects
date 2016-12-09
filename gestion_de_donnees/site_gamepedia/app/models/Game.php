<?php

namespace app\models;
use Illuminate\Database\Eloquent\Model;

class Game extends Model{

  protected $table = 'game';
  protected $primaryKey = 'id';

  public function characters(){
    return $this->belongsToMany(
                    'app\models\Character',
                    'game2character',
                    'game_id', 'character_id');
  }

  public function ratings(){
    return $this->belongsToMany(
                    'app\models\GameRating',
                    'game2rating',
                    'game_id', 'rating_id');
  }

}
