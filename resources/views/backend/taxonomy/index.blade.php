<!-- index.blade.php -->

@extends('backend.layout')

@section('content')
<div class="uper container-fluid">
  @if(session()->get('success'))
  <div class="alert alert-success">
    {{ session()->get('success') }}  
  </div><br />
  @endif

  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="{{ route('taxonomies.create',['type'=> \Request::segment(4), 'post_type' => \Request::segment(3)]) }}">Create new Category</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <!-- <li class="nav-item active">
          <a class="nav-link" href="{{ route('indexx',['postype'=> app('request')->input('type'),'type'=>'category']) }}">Category </a> 
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ route('indexx',['postype'=> app('request')->input('type'),'type'=>'tag']) }}">Tag </a>
        </li> -->
      </ul>
    </div>
  </nav>
  <table class="table table-striped">
    <thead>
      <tr>
        <td>ID</td>
        <td><span class="fixText">{{ app('request')->input('type') }}</span> Name</td>
        <td>Description</td>
        <td colspan="2">Action</td>
      </tr>
    </thead>
    <tbody>
      @foreach($taxonomies as $taxonomy)
      <tr>
        <td>{{$taxonomy->id}}</td>
        <td>{{$taxonomy->title}}</td>
        <td>{{$taxonomy->description}}</td>
        <td><a href="{{ route('taxonomies.edit',$taxonomy->id)}}" class="btn btn-primary">Edit</a></td>
        <td>
          <form action="{{ route('taxonomies.destroy', $taxonomy->id)}}" method="post">
            @csrf
            @method('DELETE')
            <button class="btn btn-danger" type="submit">Delete</button>
          </form>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
  <div>
    @endsection