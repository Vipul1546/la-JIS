@extends('backend.layout')

@section('content')
<div class="uper container-fluid">
  <div class="card">
    <div class="card-header">
      <b>Edit Post</b>
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
        <form method="post" action="{{ route('posts.update', $post->id) }}">
            <div class="form-group">
                @csrf
                @method('PATCH')
                <label for="title">Title:</label>
                <input type="text" class="form-control" name="title" value="{{$post->title}}"/>
                <input type="hidden" class="form-control" name="type" value="{{ $post->type }}"/>
            </div>
            <div class="form-group">
                <label for="featuredImg">Permalink:</label>
                <input type="text" class="form-control" name="permalink" value="{{$post->permalink}}"/>
            </div>
            <div class="form-group">
                <label for="content">Content:</label>
                <textarea class="form-control my-editor " name="content" rows="10">{{$post->content}}</textarea>
            </div>
            <div class="form-group">
                <label for="featuredImg">Featured Image</label>
                <input type="text" class="form-control" name="featuredImg" value="{{$post->featuredImg}}"/>
            </div>
            <div class="form-group">
                <label for="tag">Tag</label>
                <input type="text" class="form-control" name="tag" value="{{$post->tag}}"/>
            </div>
            <div class="form-group">
            <label for="category">Category</label>
              <select class="form-control" id="category" name="category">
                @foreach($data['catData']['list'] as $cat)
                    @if($cat['slug'] == $post->category) 
                        {{ $seleted = 'selected' }}
                    @else
                        {{ $seleted = '' }}
                    @endif
                  <option value="{{ $cat['slug'] }}" {{ $seleted }}>{{ $cat['title'] }}</option>
                @endforeach
              </select>
            </div>
            <div class="form-group">
            <label for="category">Author</label>
              <select class="form-control" id="post_author" name="post_author">
                @foreach($data['authorData']['list'] as $user)
                    @if($user['id'] == $post->post_author) 
                        {{ $seleted = 'selected' }}
                    @else
                        {{ $seleted = '' }}
                    @endif
                  <option value="{{ $user['id'] }}" {{ $seleted }}>{{ $user['name'] }}</option>
                @endforeach
              </select>
            </div>
            <button type="submit" class="btn btn-primary">Update Post</button>
        </form>
    </div>
  </div>
</div>
@endsection