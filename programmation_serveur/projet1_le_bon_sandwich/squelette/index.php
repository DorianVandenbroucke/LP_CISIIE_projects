<?php

require_once("vendor/autoload.php");
src\utils\AppInit::bootEloquent('conf/conf.ini');

use src\controllers\CommandeController as CommandeController;
$args = $_POST;
var_dump(CommandeController::add($args));
