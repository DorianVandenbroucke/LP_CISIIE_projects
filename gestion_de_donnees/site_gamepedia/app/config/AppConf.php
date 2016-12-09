<?php

namespace app\config;
use Illuminate\Database\Capsule\Manager;

class AppConf{

  public static function bootEloquent($init_file){
    $conf = parse_ini_file($init_file);
    $db = new Manager();

    $db->addConnection($conf);
    $db->setAsGlobal();
    $db->bootEloquent();
  }

}
