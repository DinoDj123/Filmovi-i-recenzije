@extends('layouts.app')
@section('title')
Login
@endsection
@section('content')
    <form action="{{route('login.store')}}" method="POST" enctype="multipart/form-data" class="form">
            @csrf
            <div>
                <label for="email">Email:</label> <br>
                <input type="text" name="email" id="email" placeholder="example@gmail.com" required class='input'>
            </div>
            <div>
                <label for="password">Password:</label> <br>
                <input type="password" name="password" id="password" placeholder="Enter password here" required class='input'>
            </div>
            <button type="submit" class="button">
                Login
            </button>
    </form>
@endsection