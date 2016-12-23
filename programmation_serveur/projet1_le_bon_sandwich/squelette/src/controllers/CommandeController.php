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

  static public function add($montant, $date_de_livraison, $etat){

    if(!isset($etat)){
      $etat = "En attente";
    }

    $commande = new Commande();
    $commande->montant = $montant;
    $commande->date_de_livraison = $date_de_livraison;
    $commande->etat = $etat;

    $commande->save();

    $chaine = [
                "id" => $commande->id,
                "lien" => "/commandes/$commande->id"
              ];
    return $chaine;

  }

}
