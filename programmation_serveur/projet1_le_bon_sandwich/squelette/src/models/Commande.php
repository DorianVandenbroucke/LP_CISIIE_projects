<?php

namespace src\models;

use Illuminate\Database\Eloquent\Model;

class Commande extends Model{

  protected $table = "commande";
  protected $primaryKey = "id";
  protected $fillable = ["montant", "date_de_livraison", "etat"];
  public $timestamps = false;

  public function getIngredients(){
    return $this->belongsToMany(
                                  "src\models\Ingredient",
                                  "Ingredients_commande",
                                  "id_ingredient", "id_commande"
                               );
  }

}
