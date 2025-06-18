{{-- EDIT.BLADE.PHP za profil korisnika --}}

@extends('layouts.app')
@section('title')
My profile
@endsection
@section('content')
<div class="form">
    <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data" >
        @csrf
        @method('PUT')
        <div class="grid col-1">
            <div>
                <label for="name">Name: </label>
                <input type="text" class="input" name="name" id="name" value="{{old('name',$user->name)}}">
            </div>
            <div>
                <label for="email">Email: </label>
                <input type="text" class="input" name="email" id="email" value="{{old('email',$user->email)}}">
            </div>
            <div>
                <label for="password">Password: </label>
                <input type="password" class="input" name="password" id="password" nullable>
            </div>
            <div>
                <label for="picture">Picture: </label>
                <input type="file" class="input" name="picture" id="picture">
                @if(old('picture'))
                <img src="{{ asset('storage/avatars/' . old('picture')) }}" alt="" class="w-32 h-32">
                @elseif($user->picture)
                <img src="{{ asset('storage/' . $user->picture) }}" alt="Placeholder" class="w-32 h-32">
                @endif
            </div>
            <div>
                <label for="about">About: </label>
                <input type="text" class="input" name="about" id="about" value="{{old('about',$user->about)}}">
            </div>
            <div>
                <label for="created_at">Created at: {{old('created_at',$user->created_at)}} </label>
            </div>
            <div>
                <label for="updated_at">Last time updated: {{old('updated_at',$user->updated_at)}} </label>
            </div>
            <div>
                <label for="id">Id : {{$user->id}}</label>
            </div>
        </div>
        <div class="flex justify-center">
        <button type="submit" class="button">Edit</button>
        </div>
    </form>
    @if(auth()->id()==$user->id)
        <form action="{{ route('users.destroy', auth()->user()) }}" method="POST" class='items-center flex justify-center'>
            @csrf
            @method('DELETE')
            <button type="submit" class=" redbutton" onclick="return confirm('Are you sure?')">Delete</button>
        </form>
    @endif
</div>
@endsection