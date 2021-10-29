@extends('profile')
@section('content')



<!-- Default box -->
<div class="card card-solid">
  <div class="card-body">
    <div class="row">
      <div class="col-12 col-sm-6">
        <div class="col-12">
        @if(session('success'))
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
         <strong>{{session('success')}}</strong> 
        </div>
      @endif
      @if(Session::has('fail'))
      <div class="alert alert-danger">{{Session::get('fail')}}</div>
      @endif
        @foreach($posts as $post)
          <img src="{{ asset($post->photo)}}" style = "width:400px; height:400px" class="product-image" alt="Product Image">
        </div>
      </div>
      <div class="col-12 col-sm-6">
        <p class="my-3">{{$post->description}}</p>
        <p class="my-3">{{$post->category}}</p>
      </div>
    </div><br>
    <div>
    
    <a href="{{ route('liked', $post->id) }}" class="btn btn-info">Like ()</a>
    <a href="{{ route('disliked', $post->id) }}" class="btn btn-info">Dislike ()</a>
    </div>
    <div>
    
    <h1>Comments</h1>
    @foreach($comments as $comment)
    @if($post->id == $comment->post_id)
   
    <p class="my-3">{{$comment->text}}</p>
    
    @endif
    @endforeach
    </div>
    <form class="content" action="{{ route('create.comment', $post->id )}}" method="POST" enctype="multipart/form-data">
      @csrf
            <div class="card-body">
              <div class="form-group">
                <label for="inputDescription">Comment</label>
                <textarea name="text" id="inputDescription" class="form-control" rows="4" ></textarea>
                @error('Description')
                <span class="text-danger"> {{ $message }}</span>
                @enderror
              </div>         
            <div class="row">
        <div class="col-12">
          <input type="submit" value="Publish" class="btn btn-success float-right">
        </div>
         <div>   
       </div>
      </div>
        </div>
        </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        
      </div>
      
    </form>
  </div>
  <!-- /.card-body -->
</div>
<!-- /.card -->
@endforeach

@endsection