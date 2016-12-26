<?php

namespace app\models;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model{

  protected $table = 'comment';
  protected $primaryKey = 'id';
	public $timestamps = false;

}
