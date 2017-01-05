
angular.module("shop").controller(
  "ProductController",
  [
    "$scope", "$http",
    function($scope, $http){

      $http.get("json/products.php").then(function($response){
        $scope.products = [];
        $response.data.forEach(function(p){
          $scope.products.push(p);
        });
      },
      function(error){
        console.log(error);
      }
    );

    }
  ]
);
