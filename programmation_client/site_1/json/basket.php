<?php

//Faites un nouveau script PHP qui vous retourne, en GET, le panier de l'utilisateur (nom, nombre, prix des produits achetés), et qui, en POST, permet d'ajouter un produit au panier.

$user_basket = [
  "nom" => "Arthur",
  "nombre" => 0,
  "prix" => 0
];

if(isset($_POST['add_product'])){
  $user_basket['nombre'] = 1 + $_POST['number_product'];
  $user_basket['prix'] += $_POST['price_product'];
}

echo json_encode($user_basket);
