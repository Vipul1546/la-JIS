@extends('backend.layout')

@section('content')
<div class="container-fluid uper">
  <div class="card">
    <div class="card-header">
      New Post
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
        <form method="post" action="{{ route('posts.store') }}">
            <div class="form-group">
                @csrf
                <label for="title">Title:</label>
                <input type="text" class="form-control" name="title"/>
                <input type="hidden" class="form-control" name="type" value="{{ app('request')->input('type') }}"/>
                <input type="hidden" class="form-control" name="post_author" value="{{ Auth::user()->id }}"/>
            </div>
            <div class="form-group">
                <label for="content">Content:</label>
                <textarea class="form-control my-editor" name="content" rows="10"></textarea>
            </div>
            <div class="form-group">
                <label for="featuredImg">Featured Image</label>
                <input type="text" class="form-control" name="featuredImg"/>
            </div>
            <div class="form-group">
                <label for="tag">Tag</label>
                <input type="text" class="form-control" name="tag"/>
            </div>
            <div class="form-group">
            <label for="category">Category</label>
              <select class="form-control" id="category" name="category">
                @foreach($catList['list'] as $cat)
                    @if($cat['slug'] == 'undefined') 
                        {{ $selected = 'selected' }}
                    @else
                        {{ $selected = '' }}
                    @endif
                  <option value="{{ $cat['slug'] }}" {{ $selected }}>{{ $cat['title'] }}</option>
                @endforeach
              </select>
          </div>
            <button type="submit" class="btn btn-primary">Publish Post</button>
        </form>
    </div>
  </div>
</div>
@endsection