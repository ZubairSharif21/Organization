@extends('Layout.layout')
@section('title')
    Update User
@endsection
@section('content')
    <div class="conteiner-fluied bg-light">
        <div class="d-flex align-items-center" style="height: 700px">
            <form action="{{ route('users.update', ['id' => $user->id]) }}" method="POST" class="w-25 mx-auto shadow p-3">

                @csrf
                <h2 class="text-center text-danger my-4">Update User</h2>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Email address</label>
                    <input type="email" name="email" id="email" class="form-control" value="{{ $user->email }}">
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
@endsection
