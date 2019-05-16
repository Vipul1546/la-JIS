@extends('backend.layout')

@section('content')

<!-- As a heading -->
<div class="uper container-fluid">
  <nav class="navbar navbar-light bg-light">
    <span class="navbar-brand mb-0 h1">Dashboard</span>
    <div class="dropdown">
    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
       {{ Auth::user()->name }}
    </button>
    <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
        <button class="dropdown-item" type="button"><a class="dropdown-item" href="{{ route('logout') }}"
            onclick="event.preventDefault();
            document.getElementById('logout-form').submit();">
            {{ __('Logout') }}
          </a>

          <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
          </form></button>
        <!-- <button class="dropdown-item" type="button">Another action</button> -->
      </div>
    </div>
</nav>
<div class="container">
  <div class="row">
    <div class="col-sm be-post be-block">
      <a href="{{ route('posts.index', 'type=post', false) }}"> Posts </a>
    </div>
    <div class="col-sm be-images be-block">
      <a href="{{ route('posts.index', 'type=image', false) }}"> Images </a>
    </div>
    <div class="col-sm be-video be-block">
      <a href="{{ route('posts.index', 'type=video', false) }}"> Videos </a>
    </div>
  </div>
</div>
</div>


@endsection('content')