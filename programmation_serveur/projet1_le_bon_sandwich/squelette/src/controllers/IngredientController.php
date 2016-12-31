<?php

namespace src\controllers;

use src\models\Categorie as Categorie;
use src\models\Ingredient as Ingredient;

class IngredientController extends AbstractController{

  private $request = null;
  private $auth;

  public function __construct(HttpRequest $http_req){
    $this->request = $http_req;
    $this->auth = new Authentification();
  }

  static public function detailIngredient($id){
    $ingredient = Ingredient::findOrFail($id);
    $chaine = [
                "id" => $ingredient->id,
                "description" => $ingredient->description,
                "fournisseur" => $ingredient->fournisseur,
                "img" => $ingredient->img,
                "lien" => "/ingredients/$ingredient->id/categories",
              ];
    return $chaine;
  }

  static public function categorieByIngredient($id){
    $ingredient = Ingredient::findOrFail($id);
    $categorie = Categorie::findOrFail($ingredient->cat_id);

    $chaine = [
                "ingrédient" => $ingredient->nom,
                "categorie" => [
                                "nom" => $categorie->nom,
                                "lien" => "/categories/$categorie->id"
                               ]
              ];
    return $chaine;
  }

}
