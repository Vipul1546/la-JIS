@extends('backend.layout')

@section('customStyles')
  <link href="{{ asset('css/vtPageBuilder.css') }}" rel="stylesheet" type="text/css" />
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"> </script>
  <script defer src="https://use.fontawesome.com/releases/v5.8.2/js/all.js" integrity="sha384-DJ25uNYET2XCl5ZF++U8eNxPWqcKohUUBUpKGlNLMchM7q4Wjg2CUpjHLaL8yYPH" crossorigin="anonymous"></script>
@endsection

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
                <div class="switchContent">
                  <button type="button" class="btn btn-warning ClassicEditor">Classic Editior</button> &nbsp; &nbsp;
                  <button type="button" class="btn btn-info vtPageB">vtPage Builder</button>
                </div>
                <div class="content" style="display: none;">
                  <textarea class="form-control my-editor" name="content" rows="10"></textarea> 
                </div>
                @include('backend.post.page.vtPageBuilder.pageBuilder')
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

@section('customScripts')
    <!-- flot charts scripts-->
    <script src="{{ asset('js/vtPageBuilder.js') }}"></script>
    <script type="text/javascript">
      $(document).ready(function (){
        $('.ClassicEditor').click(function(){ console.log('content');
          $('.content').show();
          $('vtPageBuilder').hide();
        });
        $('.vtPageB').click(function(){ console.log('builder');
          $('vtPageBuilder').show();
          $('.content').hide();
        });
      });
      // $("form").submit(function(e){
      //   e.preventDefault();
      //   var postData = $('#pageData :input');
      //   var values = {};
      //   postData.each(function() {
      //     if(this.name == '')
      //       values[this.name] = $(this).val();
      //   });

      //   console.log(values);
      // });
    </script>

@stop