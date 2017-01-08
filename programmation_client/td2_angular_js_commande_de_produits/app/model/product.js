
angular.module("shop").service(
  "Product",
  [
    "$http",
    function($http){
      var Product = function(data){
        this.name = data.name;
        this.description = data.description;
        this.price = data.price;
      }

      Product.prototype.buy = function(){
        console.log(this.name);
      }

      return Product;
    }
  ]
);
