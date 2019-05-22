@extends('backend.layout')

@section('content')
<div class="uper container-fluid">
  <div class="card">
    <div class="card-header">
      <b>Edit User</b>
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
        <form method="post" action="{{ route('users.update', $user[0]->id) }}">
            <div class="form-group">
                @csrf
                @method('PATCH')
                <label for="title">Name:</label>
                <input type="text" class="form-control" name="title" value="{{$user[0]->name}}"/>
            </div>
            <div class="form-group">
                <label for="content">About:</label>
                <textarea class="form-control my-editor " name="about" rows="10">{{$userMeta['about']}}</textarea>
            </div>
            <div class="form-group">
                <label for="featuredImg">Email</label>
                <input type="text" class="form-control" name="email" value="{{$user[0]->email}}"/>
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
                <label for="tag">Access Tocken</label>
                <a href="{{ route('users.generateAccessTocken') }}" class="accessTockenGen">Generate Access Token</a>
                <textarea class="form-control" name="accessTocken" rows="10" disabled>{{ $userMeta['accessToken'] }}</textarea>
            </div>
             <div class="form-group">
            <label for="category">User Role</label>
              <select class="form-control" id="userRole" name="userRole">
                <option value="">Select Role</option>
                @for($i = 1; $i <= 4; $i++)
                    @if($i == $userMeta['userRole']) 
                        {{ $seleted = 'selected' }}
                    @else
                        {{ $seleted = '' }}
                    @endif
                  <option value="{{ $i }}" {{ $seleted }}>{!! Helper::getUserRoles($i) !!}</option>
                @endfor
              </select>
          </div>
            <button type="submit" class="btn btn-primary">Update User</button>
        </form>
    </div>
  </div>
</div>
@endsection