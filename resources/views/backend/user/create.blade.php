@extends('backend.layout')

@section('content')
<div class="container-fluid uper">
  <div class="card">
    <div class="card-header">
      New User
    </div>
    <div class="card-body">
      @if ($errors->any())
        <div class="alert alert-danger">
          <ul>
              @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
              @endforeach
          </ul>
        </div><br />
      @endif
        <form method="post" action="{{ route('users.store') }}">
            <div class="form-group">
                @csrf
                <label for="title">Name:</label>
                <input type="text" class="form-control" name="name"/>
              <!--   <input type="hidden" class="form-control" name="type" value="{{ app('request')->input('type') }}"/>
                <input type="hidden" class="form-control" name="post_author" value="{{ Auth::user()->id }}"/> -->
            </div>
            <div class="form-group">
                <label for="content">About:</label>
                <textarea class="form-control my-editor" name="about" rows="10"></textarea>
            </div>
            <div class="email">
                <label for="featuredImg">Enter Email:</label>
                <input type="email" class="form-control" name="email" autocomplete="off"/>
            </div>
            <div class="form-group">
                <label for="tag">New Password</label>
                <input type="password" class="form-control" name="password" autocomplete="off"/>
            </div>
            <div class="form-group">
                <label for="tag">Confirm Password</label>
                <input type="confirmPassword" class="form-control" name="confirmPassword" autocomplete="off"/>
            </div>
            <div class="form-group">
            <label for="category">User Role</label>
              <select class="form-control" id="userRole" name="userRole">
              	<option value="">Select Role</option>
                @for($i = 1; $i <= 4; $i++)
                  <option value="{{ $i }}">{!! Helper::getUserRoles($i) !!}</option>
                @endfor
              </select>
          </div>
            <button type="submit" class="btn btn-primary">Add User</button>
        </form>
    </div>
  </div>
</div>
@endsection