<?php

namespace app\models;
use Illuminate\Database\Eloquent\Model;

class Character extends Model{

  protected $table = 'character';
  protected $primaryKey = 'id';

  public function played_game(){
    $this->belongsToMany(
                    'app\models\Game',
                    'game2character',
                    'character_id', 'game_id');
  }

}
