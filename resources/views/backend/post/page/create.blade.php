@extends('backend.layout')

@section('customStyles')
  <link href="{{ asset('css/vtPageBuilder.css') }}" rel="stylesheet" type="text/css" />
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"> </script>
  <script defer src="https://use.fontawesome.com/releases/v5.8.2/js/all.js" integrity="sha384-DJ25uNYET2XCl5ZF++U8eNxPWqcKohUUBUpKGlNLMchM7q4Wjg2CUpjHLaL8yYPH" crossorigin="anonymous"></script>
@endsection

@section('content')
<div class="container-fluid uper">
  <div class="card">
    <div class="card-header">
      New Page
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
        <form id="pageData" method="post" action="{{ route('posts.store') }}">
            <div class="form-group">
                @csrf
                <label for="title">Page Title:</label>
                <input type="text" class="form-control" name="title"/>
                <input type="hidden" class="form-control" name="type" value="{{ app('request')->input('type') }}"/>
                <input type="hidden" class="form-control" name="post_author" value="{{ Auth::user()->id }}"/>
            </div>
            <div class="form-group">
                <label for="content">Content:</label>
                <div class="switchContent">
                  <button type="button" class="btn btn-warning ClassicEditor">Classic Editior</button> &nbsp; &nbsp;
                  <button type="button" class="btn btn-info vtPageB">vtPage Builder</button>
                </div>
                <div class="content">
                  <textarea class="form-control my-editor" name="content" rows="10"></textarea> 
                </div>
                @include('backend.post.page.vtPageBuilder.pageBuilder')
            </div>
            <div class="form-group">
                <label for="featuredImg">Featured Image</label>
                <input type="text" class="form-control" name="featuredImg"/>
            </div>
            <div class="form-group">
                <label for="tag">Tag</label>
                <input type="text" class="form-control" name="tag"/>
            </div>
            <div style="height: 150px"></div>
            <button class="savePost" type="submit" class="btn btn-primary">Publish Post</button>
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