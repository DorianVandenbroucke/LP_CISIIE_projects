
angular.module("shop").directive(
  "product",
  [
    function(){
      return {
              restrict: "E",
              templateUrl: "app/templates/product.html"
            };
    }
  ]
);
