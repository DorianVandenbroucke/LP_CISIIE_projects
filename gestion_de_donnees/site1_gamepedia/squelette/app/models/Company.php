<?php

namespace app\models;
use Illuminate\Database\Eloquent\Model;

class Company extends Model{

  protected $table = 'company';
  protected $primaryKey = 'id';

  public function games(){
    return $this->belongsToMany(
                    'app\models\Game',
                    'game_developers',
                    'comp_id', 'game_id');
  }

}
