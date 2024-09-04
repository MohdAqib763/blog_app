@include('header')
<div class="container">
<h3 class="mb-3 pt-3">{{$post->post_title}}</h3>
<p>Posted on : {{ date('dS F Y',strtotime($post->created_at)) }}</p>
<?php

?>
<div class="row">
    <div class="col-md-10">
        <p>{{strip_tags($post->post_desc)}}</p>
    </div>
</div>