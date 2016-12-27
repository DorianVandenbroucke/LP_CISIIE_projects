<?php

namespace src\controllers;

use src\models\Commande as Commande;

class CommandeController extends AbstractController{

  private $request = null;
  private $auth;

  public function __construct(HttpRequest $http_req){
    $this->request = $http_req;
    $this->auth = new Authentification();
  }

  static public function add($args){

    var_dump($args); die;

    if(!isset($args['etat'])){
      $etat = "En attente";
    }

    $commande = new Commande();
    $commande->montant = $args['montant'];
    $commande->date_de_livraison = $args['date_de_livraison'];
    $commande->etat = $args['etat'];

    $commande->save();

    $chaine = [
                "id" => $commande->id,
                "lien" => "/commandes/$commande->id"
              ];
    return $chaine;

  }

}
