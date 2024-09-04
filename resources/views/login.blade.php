@include('header')
<div class="container">
    <div class="row justify-content-center">
<br>
<div class="col-md-4">
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
<h2 class="text-center mb-4">Login</h2>
<form  action="{{url('/login_user')}}" method="post" class="needs-validation" novalidate>
  @csrf
  <div class="form-group">
    <label for="exampleInputEmail1">Email address</label>
    <input type="email" class="form-control" name="email" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email" required>
    <div class="invalid-feedback">Please enter a valid email address.</div>
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Password</label>
    <input type="password" class="form-control" name="password" id="exampleInputPassword1" placeholder="Password" required>
    <div class="invalid-feedback">Please enter a valid password.</div>
  </div>
  <button type="submit" class="btn btn-primary">Login</button>
</form>
</div>
</div>
</div>