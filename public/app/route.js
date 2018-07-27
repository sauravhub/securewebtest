var app =  angular.module('main-App',['ngRoute','angularUtils.directives.dirPagination']);
app.config(['$routeProvider',
    function($routeProvider) {
        $routeProvider.
            when('/', {
                templateUrl: 'htmltemplates/home.html',
                controller: 'AdminController'
            }).
            when('/products', {
                templateUrl: 'htmltemplates/products.html',
                controller: 'ProductController'
            });
}]);
app.value('apiUrl', 'public path url');