@include('header')
<div class="container">
<div class="row justify-content-center">
<br>
<div class="mb-5">
</div>
<div class="col-md-8">
<h2 class="text-center mb-4">Edit Post</h2>
@if(session()->has('success'))
    <div class="alert alert-success">
        {{ session()->get('success') }}
    </div>
@endif
@if (count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<form  action="{{url('/update_post')}}" method="post" class="needs-validation" >
    @csrf
  <div class="form-group">
    <label for="exampleInputEmail1">Post Title</label>
    <input type="text" class="form-control" id="post_title" value="{{$post->post_title}}"  name="post_title" placeholder="Enter post title" required>
   <input type="hidden" name="post_id" value="{{ $post->post_id }}">
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Post Description</label>
    <textarea id="summernote" name="post_desc">{{$post->post_desc}}</textarea>
  
  </div>
 
  <button type="submit" class="btn btn-primary">Update</button>
</form>
</div>
</div>
</div>
@include('footer')