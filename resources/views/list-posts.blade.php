@extends('profile')
@section('content')


<div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Manage My Posts</h3>

                <div class="card-tools">
                  <div class="input-group input-group-sm" style="width: 150px;">
                    <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

                    <div class="input-group-append">
                      <button type="submit" class="btn btn-default">
                      </button>
                    </div>
                  </div>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0" style="height: 300px;">
                <table class="table table-head-fixed text-nowrap">
                  <thead>
                    <tr>
                      <th>Description</th>
                      <th>Category</th>
                      <th>Photo</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                  
                  @foreach ($posts as $post)
                  @can('view-posts', $post)
                    <tr>
                      <td>{{$post->description}}</td>
                      <td><span class="tag tag-success">{{$post->category}}</span></td>
                      <td><img src="{{ asset($post->photo)}}" style = "width:70px; height:70px" class="product-image" alt="Product Image"></td>
                      <td>
                          <a href="{{ route('post.edit', $post->id)}}" class="btn btn-info">Edit</a>
                          <a href="{{ route('post.delete', $post->id)}}" onclick="return confirm('Are you sure to delete this post ?!')" class="btn btn-danger">Delete</a>
                      </td>
                    </tr>
                    @endcan
                 @endforeach

                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
            @if(session('success'))
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
         <strong>{{session('success')}}</strong> 
        </div>
      @endif
          </div>
        </div>

@endsection 