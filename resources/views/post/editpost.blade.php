@extends('welcome')
@section('content')
<div class="container">
    <div class="row">
      <div class="col-lg-8 col-md-10 mx-auto">

      
            <a href="{{ route('all.post') }}" class="btn btn-info">All Post</a>
        
        <hr>
        @if ($errors->any())
                <div class="alert alert-danger">
                  <ul>
                      @foreach ($errors->all() as $error)
                          <li>{{ $error }}</li>
                      @endforeach
                  </ul>
                </div>
              @endif
        <form action="{{ url('update/post/'.$post->id) }}" method="post" enctype="multipart/form-data">
          @csrf
          <div class="control-group">
            <div class="form-group floating-label-form-group controls">
              <label>Post Title</label>
              <input type="text" class="form-control" value="{{ $post->title }}" name="title" required data-validation-required-message="Please enter your name.">
         
            </div>
          </div>
          <br>
          <div class="control-group">
            <div class="form-group floating-label-form-group controls">
              <label>Post Category</label>
              <select class="form-control" name="category_id">
                @foreach ( $category as $row )
                <option value="{{ $row->id }}"
                    <?php
                    if ($row->id == $post->category_id) 
                    echo"selected";
                    ?>
                    >{{ $row->name }}</option>
                @endforeach
               
                
             </select>
            </div>
          </div>
          <br>
          <div class="control-group">
            <div class="form-group floating-label-form-group controls">
              <label>New Image</label>
              <input type="file" class="form-control" placeholder="Post Image"   name="image"><br>
              Old Image: <img src="{{ URL :: to($post->image) }}" style="height: 200px; width: 400px;">
              <input type="hidden" name="old_photo" value="{{ $post->image }}">
            
            </div>
          </div><br>
          <div class="control-group">
            <div class="form-group floating-label-form-group controls">
              <label>Post Details</label>
              <textarea rows="5" class="form-control" required name="details">
                {{ $post->details }}
              </textarea>
         
            </div>
          </div>
          
          <br>
          <div id="success"></div>
          <button type="submit" class="btn btn-primary" id="sendMessageButton">Update</button>
        </form>
      </div>
    </div>
  </div>
@endsection