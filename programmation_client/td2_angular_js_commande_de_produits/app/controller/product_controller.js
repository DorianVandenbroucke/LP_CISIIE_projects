
angular.module("shop").controller(
  "ProductController",
  [
    "$scope", "$http", "Product",
    function($scope, $http, Product){

      $http.get("json/products.php").then(function($response){
        $scope.products = [];
        $response.data.forEach(function(data){
          var newProduct = new Product(data);
          $scope.products.push(newProduct);
        });
      },
      function(error){
        console.log(error);
      }
    );

    }
  ]
);
