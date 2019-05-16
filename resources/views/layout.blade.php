<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Journey In Shots</title>
  <link href="{{ asset('css/app.css') }}" rel="stylesheet" type="text/css" />
  <link href="{{ asset('css/main.css') }}" rel="stylesheet" type="text/css" />
  <style>
		body{
			background: #4db786;
		}
	  	.uper {
	    	margin-top: 40px;
	  	}
	  	.admin-logo{
	  		width: 200px;
	  	}
	</style>
</head>
<body>
  <div class="container">
	<admin-header>
	</admin-header>
    @yield('content')
  </div>
  <script src="{{ asset('js/app.js') }}" type="text/js"></script>
</body>
</html>