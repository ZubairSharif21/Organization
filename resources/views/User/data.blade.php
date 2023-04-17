@extends('Layout.layout')
@section('title')
All Users
@endsection
@section('content')
<div class="container">

    <div class="d-flex justify-content-around w-100 align-items-center my-3">
    <div class="heading">
    <h1 class=" text-danger ">All Users</h1>
    </div>
    <div class="add">
<button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#exampleModal">
Add New</button>
    </div>
    </div>
    <!-- Button trigger modal -->

  <!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Add New User</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form action="{{ url('users_signup') }}" method="post">
@csrf

                <div class="mb-3">
                  <label for="exampleInputEmail1" class="form-label">Email address</label>
                  <input type="email" class="form-control" name="email" value="{{ old('email') }}" id="exampleInputEmail1" aria-describedby="emailHelp">
                </div>
                <div class="mb-3">
                  <label for="exampleInputPassword1" class="form-label">Password</label>
                  <input type="password" class="form-control" name="password" id="exampleInputPassword1">
                </div>
                  <div class="mb-3">
                  <label for="exampleInputPassword1" class="form-label">Confirm Password</label>
                  <input type="password" class="form-control" name="confirm_password" id="exampleInputPassword1">
                </div>
<div class="d-flex justify-content-center">
                <button type="submit" class="btn btn-primary justify-content-center">Submit</button>
            </div>
              </form>
        </div>

      </div>
    </div>
  </div>
    @if (session('message'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    <p>{{ session('message') }}</p>
    <button type="button" class="btn-close" data-bs-dismiss="alert"
        aria-label="Close"></button>
</div>
@endif
@if ($errors->any())
<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <p>{{ $errors->first() }}</p>
    <button type="button" class="btn-close" data-bs-dismiss="alert"
        aria-label="Close"></button>
</div>
@endif
<table class="table-striped table-hover table ">
<tr>
    <th>Id</th>
    <th>Email</th>
    <th>Email-verified</th>
    <th>password</th>
    <th>Operations</th>
</tr>
@foreach ($users as $user)
<tr>
    <td>{{ $user->id }}</td>
    <td>{{ $user->email }}</td>
    <td>{{ $user->email_verified_at }}</td>
    <td>{{ $user->password }}</td>
    <td class="d-flex flex-shrink-0 ">
    <a href="user_delete/{{ $user->id }}"><button class="btn btn-danger mx-2">Delete</button></a>
    <a href="users_update/{{ $user->id }}"><button class="btn btn-success">Update</button></a>
</td>
</tr>
@endforeach


</div>



</table>

@endsection


