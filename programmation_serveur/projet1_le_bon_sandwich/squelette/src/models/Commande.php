<?php

namespace src\models;

use Illuminate\Database\Eloquent\Model;

class Commande extends Model{

  protected $table = "commande";
  protected $primaryKey = "id";
  protected $fillable = ["montant", "date_de_livraison", "etat"];
  public $timestamps = false;

  public function sandwichs(){
    return $this->belongsToMany(
                                  "src\models\Sandwich",
                                  "sandwich_commande",
                                  "id_commande", "id_sandwich"
                               );
  }

}
