app = (function(){

  var myApp = {};

  var products = [];
  var articles_basket = [];

  // On crée un objet pour chaque produit
  var Product = function(data){
    this.name = data.nom;
    this.description = data.description;
    this.price = data.prix;
  };

  // On crée un objet pour chaque panier
  var Basket = function(data){
    this.name = data.nom;
    this.number = data.nombre;
    this.price = data.prix;
    this.articles = articles_basket;
  };

  // On affiche les produits
  var displayProducts = function(){
    var container = $("<ul>").addClass("list-without-style");
    products.forEach(function(product){
      var productContainer = $("<li>").addClass("info-alert");
      productContainer.append($("<h3>").text(product.name));
      productContainer.append($("<p>").text(product.description));
      productContainer.append($("<strong>").text(product.price));
      var addButton = $("<button>").addClass("yellow-btn offset_1");
      addButton.text("Acheter");
      addButton.click(addProduct);
      productContainer.append(addButton);
      container.append(productContainer);
    });
    $("#products_list").append(container);
  };

  // On affiche le panier
  var displayBasket = function(){
    var container = $("<ul>").addClass("list-without-style warning-alert");
    container.append($("<li>").text("Bonjour " + basket.name + ","));
    container.append($("<li>").text("Nombre de produits: " + basket.number));
    container.append($("<li>").text("Prix total: " + basket.price));
    var articles_container = $("<li>");
    articles_container.append($("<strong>").text("Articles dans le panier: "));
    articles_basket.forEach(function(art){
      articles_container.append($("<span>").text(art + " "));
    });
    container.append(articles_container);
    $("#basket").append(container);
  };

  getCommand = function(){
    $.get("json/command.php").done(function(data){
      var data = $.parseJSON(data);
    });
  };

  // On récupère les produits
  myApp.getProducts = function(){
    $.get("json/products.php").done(function(data){
      var data = $.parseJSON(data);
      data.forEach(function(item){
        products.push(new Product(item));
      });
      displayProducts();
    });
  };

  // On récupère le panier
  myApp.getBasket = function(){
    $.get("json/basket.php").done(function(data){
      var data = $.parseJSON(data);
      basket = new Basket(data);
      displayBasket();
    });
  };

  // On ajoute un produit
  var addProduct = function(){
    var article = $(this).parent().children("h3").text();
    article = articles_basket.push(article);
    var nombre = parseInt(basket.number) + 1;
    var prix = parseFloat(basket.price) + parseFloat($(this).parent().children("strong").text());
    $.post(
      "json/basket.php",
      {
        number_product: nombre,
        price_product: prix,
        article: article,
      },
    ).done(function(data){
      var data = $.parseJSON(data);
      basket = new Basket(data);
      console.log(basket);
      displayBasket();
    });
  };

  // On commande
  myApp.command = function(){
    articles_command = $("#basket li:nth-child(4) span");
    articles_command.each(function(item){
      getCommand();
      $(this).css("color", "green");
    });
    $("#basket").append($("<strong>").text("Les articles on été envoyés."));
  };

  return myApp;

})();

$(function(){

  app.getProducts();
  app.getBasket();
  $("#command").on("click", app.command);

});
