angular.module('app').config(BindingSymbols);
angular.module('app').config(Routing);
BindingSymbols.$inject = ['$interpolateProvider'];

function BindingSymbols($interpolateProvider) {
    $interpolateProvider.startSymbol('[[').endSymbol(']]');
}

Routing.$inject = ['$stateProvider', '$urlRouterProvider']

function Routing($stateProvider, $urlRouterProvider) {
    // Define routing states
    var main = {
        url: '/',
        templateUrl: '/app/product/product.template.html',
        controller: 'ProductController',
        controllerAs: 'product'
    };
    // Register routing states
    $stateProvider.state('main', main);
    // if none of the above states are matched, use this as the fallback
    $urlRouterProvider.otherwise('/');
}