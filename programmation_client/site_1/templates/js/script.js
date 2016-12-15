
$(document).ready(function(){

  // On ajoute un produit en POST
  var addProduct = function(){
    var prix = $(this).parent().attr("id");
    var number = $("#basket li:nth-child(2)").text();
    $.post(
        "json/basket.php",
        {
          add_product: true,
          number_product: number,
          price_product: prix
        },
        function(data){
          var data = $.parseJSON(data);
          var container = $("<ul>");
          container.append($("<li>").text(data.nom));
          container.append($("<li>").text(data.nombre));
          container.append($("<li>").text(data.prix));
          $("#basket").replaceWith(container);
        }
    );
  };

  var command = function(){};

  // On récupère la liste des produits
  $.get(
      "json/products.php",
      function(data){
        var data = $.parseJSON(data);
        for(var i = 0; i< data.length; i++){
          var container = $("<ul id='"+data[i].prix+"'>");
          container.append($("<li>").text(data[i].nom));
          container.append($("<li>").text(data[i].description));
          container.append($("<li>").text(data[i].prix));
          var button = $('<button>');
          container.append(button.text("Acheter"));
          button.click(addProduct);
          $("#products_list").append(container);
        }
      }
    );

    // On récupére le panier de l'utilisateur
    $.get(
        "json/basket.php",
        function(data){
          var data = $.parseJSON(data);
          var container = $("<ul>");
          container.append($("<li>").text(data.nom));
          container.append($("<li>").text(data.nombre));
          container.append($("<li>").text(data.prix));
          $("#basket").append(container);
        }
      );

});
