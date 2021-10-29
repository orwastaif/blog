@extends('profile')
@section('content')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>


<form class="content" action="{{ route('post.update', $posts->id)}}" method="POST" enctype="multipart/form-data">
      @csrf
      <input type="hidden" name="id" value="{{ $posts->id }}">
      <input type="hidden" name="old_image" value="{{ $posts->photo }}">
      <div class="row">
        <div class="col-md-6">
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Edit Post</h3>

              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                </button>
              </div>
            </div>
            <div class="card-body">
              <div class="form-group">
                <label for="inputDescription">Description</label>
                <textarea name="Description" id="inputDescription" class="form-control" rows="4" placeholder="{{ $posts->description}}" required></textarea>
                @error('Description')
                <span class="text-danger"> {{ $message }}</span>
                @enderror
              </div>
              <div class="form-group">
                <label for="inputStatus">Category</label>
                <select name="category" id="inputStatus" class="form-control custom-select" required>
                  <option selected disabled>{{ $posts->category}}</option>
                  <option>category 1</option>
                  <option>category 2</option>
                  <option>category 3</option>
                </select>
                @error('category')
                <span class="text-danger"> {{ $message }}</span>
                @enderror
              </div>
              <div class="form-group">
              <label  for="inputClientCompany">Photo</label>

              <div class="input-group">
              
                <div class="custom-file">
                <input type="file" name="photo" class="custom-file-input" id="exampleInputFile"  onChange="photoURL(this)">
                <label class="custom-file-label" for="exampleInputFile">{{ $posts->photo}}</label>
                </div>
            </div>
            <div>
              <img src="" id="photo">
            </div>
                @error('photo')
                <span class="text-danger"> {{ $message }}</span>
                    @enderror
                      
            </div>
            <div class="row">
        <div class="col-12">
          <a href="{{route('profile')}}" class="btn btn-secondary">Cancel</a>
          <input type="submit" value="Update" class="btn btn-success float-right">
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
        @if(session('success'))
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
         <strong>{{session('success')}}</strong> 
        </div>
      @endif
      </div>
      
    </form>

    <script type="text/javascript">
        function photoURL(input){
          if(input.files && input.files[0]){
            var reader = new FileReader();
            reader.onload = function(e){
              $('#photo').attr('src',e.target.result).width(140).height(140);

            };
            reader.readAsDataURL(input.files[0]);
          }
        }
  </script>

@endsection