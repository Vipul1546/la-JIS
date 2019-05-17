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
		.admin-logo{
			width: 200px;
		}
	</style>
</head>
<body>
	<div class="container-fluid">
	<!-- <admin-header>
		<div class="row align-items-center">
	        <div class="col">
	            
	        </div>
	        <div class="col">
	            <img class="admin-logo" src="http://journeyinshots.com/wp-content/uploads/2019/01/JIS_Logo_White.png"/>
	        </div>
	        <div class="col">
	            
	        </div>
	  </div>
	</admin-header> -->
	<div class="container-fluid globalNav sticky-top">
		<div class="be-logo">
			<img class="admin-logo" src="http://journeyinshots.com/wp-content/uploads/2019/01/JIS_Logo_White.png"/>
		</div>
		<nav class="nav flex-column">
			<a class="nav-link be-back" href="{{ url()->previous() }}"> < BACK</a>
			<a class="nav-link" href="/admin"> Dashboard </a>
			<hr/>
			<a class="nav-link be-page" href="{{ route('posts.index', 'type=page', false) }}"> Pages </a>
			<hr/>
			<a class="nav-link be-post" href="{{ route('posts.index', 'type=post', false) }}"> Posts </a>
			<a class="nav-link be-image" href="{{ route('posts.index', 'type=image', false) }}"> Images </a>
			<a class="nav-link be-video" href="{{ route('posts.index', 'type=video', false) }}"> Videos </a>	
			<hr />
			<a class="nav-link be-users" href="{{ route('users.index') }}"> Users </a>	
		</nav>
	</div>
	@yield('content')
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
<script src="{{ asset('js/app.js') }}" type="text/js"></script>
<script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
<script src="{{ asset('js/main.js') }}"></script>

</body>
</html>