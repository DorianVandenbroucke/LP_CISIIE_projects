
angular.module("shop").controller(
  "ProductController",
  [
    "$scope",
    function($scope){

      $scope.products = [
                          {
                          name: 'atmega328',
                          description: 'atmel microcontroller as used in arduino',
                          price: '2€'
                          },
                          {
                            name: 'attiny85',
                            description: 'one of the smallest atmel microcontroller',
                            price: '1€'
                          },
                          {
                            name: 'esp8266',
                            description: 'microcontroller for wifi with a tcp/ip stack',
                            price: '3€'
                          },
                          {
                            name: 'cortex-m4',
                            description: '32 bits ARM processor',
                            price: '4€'
                          }
                        ];

    }
  ]
);
