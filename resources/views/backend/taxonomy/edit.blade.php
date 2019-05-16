@extends('backend.layout')

@section('content')
<div class="uper container-fluid">
  <div class="card-header">
    Edit {{ $taxonomy->taxonomy }}
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
      <form method="post" action="{{ route('taxonomies.update', $taxonomy->id) }}">
          <div class="form-group">
              @csrf
              @method('PATCH')
              <label for="title">Title:</label>
              <input type="text" class="form-control" name="title" value="{{$taxonomy->title}}"/>
              <input type="hidden" class="form-control" name="taxonomy" value="{{ $taxonomy->taxonomy }}"/>
          </div>
          <div class="form-group">
              <label for="featuredImg">Slug:</label>
              <input type="text" class="form-control" name="slug" value="{{$taxonomy->slug}}"/>
          </div>
          <div class="form-group">
              <label for="content">Content:</label>
              <textarea class="form-control" name="description">{{$taxonomy->description}}</textarea>
          </div>
          <button type="submit" class="btn btn-primary">Update {{ $taxonomy->taxonomy }}</button>
      </form>
  </div>
</div>
@endsection