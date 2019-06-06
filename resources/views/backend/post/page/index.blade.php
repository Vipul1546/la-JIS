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
    <a class="navbar-brand" href="{{ route('posts.create','type='.app('request')->input('type')) }}">Create new {{ app('request')->input('type') }}</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
  </nav>
  <table class="table table-striped">
    <thead>
      <tr>
        <td>ID</td>
        <td>Post Name</td>
        <td>Author</td>
        <td>Status</td>
        <td>Publish Date</td>
        <td colspan="2">Action</td>
      </tr>
    </thead>
    <tbody>
      @foreach($posts as $post) 
      <tr>
        <td>{{$post->id}}</td>
        <td>{{$post->title}}</td>
        <td>{!! Helper::getAuthorById($post->post_author, 'name') !!}</td>
        <td>{{$post->tag}}</td>
        <td>{{$post->created_at}}</td>
        <td><a href="{{ route('posts.edit',$post->id)}}" class="btn btn-primary">Edit</a></td>
        <td>
          <form action="{{ route('posts.destroy', ['id'=>$post->id, 'type' => app('request')->input('type')])}}" method="post">
            @csrf
            @method('DELETE')
            <button class="btn btn-danger" type="submit">Delete</button>
          </form>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>
@endsection
 

@section('javascript')
<script src="{{ asset('js/main.js') }}"></script>
@endsection