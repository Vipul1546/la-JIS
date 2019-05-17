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
    <a class="navbar-brand" href="{{ route('users.create') }}">Create new User</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
  </nav>
  <table class="table table-striped">
    <thead>
      <tr>
        <td>ID</td>
        <td>User name</td>
        <td>Email ID</td>
        <td>Role</td>
        <td colspan="2">Action</td>
      </tr>
    </thead>
    <tbody>
      @foreach($users as $user) 
      <tr>
        <td>{{$user->id}}</td>
        <td>{{$user->name}}</td>
        <td>{{$user->email}}</td>
        <td>{!! Helper::getUserMeta($user->id, 'userRole') !!}</td>
        <td><a href="{{ route('users.edit',$user->id)}}" class="btn btn-primary">Edit</a></td>
        <td>
          <form action="{{ route('users.destroy', ['id'=>$user->id, 'type' => app('request')->input('type')])}}" method="user">
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