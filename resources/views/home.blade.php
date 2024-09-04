@include('header')
<?php
use App\Posts;
$user_id = Auth::id();
$posts = Posts::where('user_id',$user_id)->get();
?>
<div class="container">
@if(session()->has('success'))
    <div class="alert alert-success">
        {{ session()->get('success') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
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
<h3 class="mb-3 pt-3">Posts</h3>

    <div class="row">
        <div class="col-md-10">
        @foreach($posts as $row)
        <div class="card">
            <span class="p-4">Posted On: {{ date('dS F Y',strtotime($row->created_at)) }}</span>
        <div class="card-body">
           <h2>{{ ucfirst($row->post_title) }}</h2> 
            <a href="{{url('/view_post',[$row->post_id])}}" class="btn btn-info">View</a>
            <a href="{{url('/edit_post',[$row->post_id])}}" class="btn btn-secondary">Edit</a>
            <a href="{{url('/delete_post',[$row->post_id])}}" class="btn btn-danger">Delete</a>
        </div>
        </div>
        @endforeach
        </div>
    </div>
</div>
