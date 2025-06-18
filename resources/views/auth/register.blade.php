@extends('layouts.app')
@section('title')
Register account
@endsection
@section('content')
    <form action="{{route('register.store')}}" method="POST" enctype="multipart/form-data" class="form">
            @csrf
            <div>
                <label for="name">Name: </label> <br>
                <input type="text" name='name' id="name" placeholder="Enter Username"required class='input'>
            </div>
            <div>
                <label for="email">Email:</label> <br>
                <input type="text" name="email" id="email" placeholder="example@gmail.com" required class='input'>
            </div>
            <div>
                <label for="password">Password:</label> <br>
                <input type="password" name="password" id="password" placeholder="Enter password" required class='input'>
            </div>
            <div>
             <label for="password_confirmation">Confirm Password:</label> <br>
                <input type="password" name="password_confirmation" id="password_password_confirmation" placeholder="Confirm password" required class='input'>
            </div>
            <div>
                <label for="picture">Profile Picture:</label> <br>
                <input type="file" name="picture" id="picture" accept='image/*' class='input' required>
                <p class=" text-lg font-light text-gray-500" >(jpg, png, jpeg) Maximum size: 2MB</p>
            </div>
            <button type="submit" class="button">
                Register
            </button>
    </form>
@endsection