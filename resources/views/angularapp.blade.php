<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel 5.2</title>
    <!-- Fonts -->
    <link href='//fonts.googleapis.com/css?family=Roboto:400,300' rel='stylesheet' type='text/css'>
    
    <link rel="stylesheet" href="http://www.expertphp.in/css/bootstrap.css">
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.1/js/bootstrap.min.js"></script>
    
    <!-- Angular JS -->
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.3.2/angular.min.js"></script>  
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.3.2/angular-route.min.js"></script>
    <!-- MY App -->
    <script src="{{ asset('app/packages/dirPagination.js') }}"></script>
    <script src="{{ asset('app/routes.js') }}"></script>
    <script src="{{ asset('app/myservices/services.js') }}"></script>
    <script src="{{ asset('app/myhelper/helper.js') }}"></script>
    <!-- App Controller -->
    <script src="{{ asset('/app/controllers/ProductController.js') }}"></script>
    
</head>
<body ng-app="main-App">
    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#collapse-1-example">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">Laravel 5.2</a>
            </div>
            <div class="collapse navbar-collapse" id="collapse-1-example">
                <ul class="nav navbar-nav">
                    <li><a href="#/">Home</a></li>
                    <li><a href="#/products">Product</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <div id="container_area" class="container">
        <ng-view></ng-view>
    </div>
    <!-- Scripts -->
</body>
</html>