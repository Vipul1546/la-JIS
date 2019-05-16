@extends('backend.layout')

@section('content')
<div class="uper container-fluid">
  <div class="card">
    <div class="card-header">
      New Category
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
        <form method="post" action="{{ route('taxonomies.store') }}">
            <div class="form-group">
                @csrf
                <label for="title">Title:</label>
                <input type="text" class="form-control" name="title"/>
                <input type="hidden" class="form-control" name="taxonomy" value="{{ app('request')->input('type') }}"/>
                <input type="hidden" class="form-control" name="post_type" value="{{ app('request')->input('post_type') }}"/>
            </div>
            <div class="form-group">
                <label for="content">Description:</label>
                <textarea class="form-control" name="description"></textarea>
            </div>
            <div class="form-group">
                <label for="featuredImg">Featured Image</label>
                <input type="text" class="form-control" name="featuredImg"/>
            </div>
            <button type="submit" class="btn btn-primary">Publish Category</button>
        </form>
    </div>
  </div>
</div>
@endsection