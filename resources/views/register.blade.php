@include('header')
<div class="container">
<div class="row justify-content-center">
<br>
<div class="mb-5">
</div>
<div class="col-md-4">
<h2 class="text-center mb-4">Register</h2>
@if(session()->has('success'))
    <div class="alert alert-success">
        {{ session()->get('success') }}
    </div>
@endif
@if (count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </ul>
    </div>
@endif
<form  action="{{url('/register_user')}}" method="post" class="needs-validation" >
    @csrf
  <div class="form-group">
    <label for="exampleInputEmail1">Full Name</label>
    <input type="text" class="form-control" id="full_name"  name="full_name" placeholder="Enter full name" required>
   
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Email address</label>
    <input type="email" class="form-control" name="email"  id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email" required>
    <div class="invalid-feedback">Please enter a valid email address.</div>
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Password</label>
    <input type="password" class="form-control" name="password"  id="exampleInputPassword1" placeholder="Password" required>
    <div class="invalid-feedback">Please enter a valid password.</div>
  </div>
  <button type="submit" class="btn btn-primary">Register</button>
</form>
</div>
</div>
</div>