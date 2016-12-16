<?php

//Faites un nouveau script PHP qui vous retourne, en GET, le panier de l'utilisateur (nom, nombre, prix des produits achetés), et qui, en POST, permet d'ajouter un produit au panier.

$user_basket = [
  "nom" => "Arthur",
  "nombre" => 0,
  "prix" => 0
];

if(isset($_POST['article'])){
  $user_basket = [
    "nom" => "Arthur",
    "nombre" => $_POST['number_product'],
    "prix" => $_POST['price_product']
  ];
}

echo json_encode($user_basket);
