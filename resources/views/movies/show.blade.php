@extends('layouts.app')

@php
use Illuminate\Support\Facades\Storage;
@endphp

@section('title')
{{$movie->title}}
@endsection

@section('content')
<div class="movie justify-center items-center">
    <div class="p-3 bg-gray-200 border-gray-200 rounded-2xl">
        @if($movie->picture && Storage::disk('public')->exists($movie->picture))
            <img src="{{ asset('storage/' . $movie->picture) }}" alt="{{ $movie->title }}" width="400">
        @else
            <img src="{{ asset('storage/posters/default.jpg') }}" alt="Placeholder" width="400">
        @endif
    </div>
    <div class="textcontainer gap-y-1">
        <p class="">{{ $movie->short_description }}</p>
        <p class="">{{$movie->published_at}}</p>
        <div class="textcontainer gap-y-1">
            <p class="">Review: <br>{{$movie->review}}</p>
        <p class="">Rated: {{$movie->rating}}</p>
        <p class="">Posted on: {{$movie->updated_at}}</p>
            <div class="flex space-x-2 items-center  justify-between">
                <p>Written by: </p>
                <a href="{{route('users.show',['user'=>$movie->user])}}" class="flex items-center  justify-between" >
                    <div>
                        @if($movie->picture && Storage::disk('public')->exists($movie->picture))
                            <img src="{{ asset('storage/' . $movie->user->picture) }}" alt="{{ $movie->user->name }}" width="30">
                        @else
                            <img src="{{ asset('storage/avatars/defaultAvatar.jpg') }}" alt="Placeholder" width="30">
                        @endif
                    </div>
                    <p class="underline italic">{{$movie->user->name ?? 'unknown'}} </p>
                </a>
            </div>
        </div>
        
    </div>
    @if(auth()->check() && (auth()->user()->isAdmin() || $movie->user_id === auth()->id()))
        <div class="mt-4 flex items-center justify-center gap-x-2">
            <a href="{{ route('movies.edit', $movie) }}" class="button">Edit</a>
            
            <form action="{{ route('movies.destroy', $movie) }}" method="POST" >
                @csrf
                @method('DELETE')
                <button type="submit" class=" redbutton" onclick="return confirm('Are you sure?')">Delete</button>
            </form>
        </div>
    @endif
</div>
@endsection