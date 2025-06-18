@extends('layouts.app')

@php
use Illuminate\Support\Facades\Storage;
@endphp

@section('title')
Movies
@endsection

@section('nav')
    <a href="{{route("movies.create")}}">Add a movie</a>
@endsection

@section('content')
<div class="grid grid-cols-2 gap-2">
    @foreach($movies as $movie)
    <div class="movie w-full h-80% justify-center items-center">
        <div class="bg-white shadow-md rounded-lg border-gray-100 overflow-hidden flex justify-center items-center">
            
                @if($movie->picture && Storage::disk('public')->exists($movie->picture))
                    <img src="{{ asset('storage/' . $movie->picture) }}" class="w-[350px] h-[500px]" alt="{{ $movie->title }}">
                @else
                    <img src="{{ asset('storage/posters/default.jpg') }}" class="w-[350px] h-[500px] object-cover" alt="No picture">
                @endif
        </div>
            <div class='textcontainer w-full h-50%'>
                <h5 class="">Title: {{ $movie->title }}</h5>
                <p class=" overflow-y-scroll border-1 rounded-lg p-2 border-gray-300">{{ $movie->short_description }}</p>
                <p>{{$movie->rating}}</p>
                <div class="flex items-center space-x-2 ">
                <p>Written by: </p>
                <a href="{{route('users.show',['user'=>$movie->user])}}" class="flex items-center  justify-between" >
                    <div>
                        @if($movie->user->picture && Storage::disk('public')->exists($movie->user->picture))
                            <img src="{{ asset('storage/' . $movie->user->picture) }}" alt="{{ $movie->user->name }}" width="30">
                        @else
                            <img src="{{ asset('storage/avatars/defaultAvatar.jpg') }}" alt="Placeholder" width="30">
                        @endif
                    </div>
                    <p class="underline italic">{{$movie->user->name ?? 'unknown'}} </p>
                </a>
            </div>
            </div>
            <div >
                <a href="{{route("movies.show",$movie)}}" class="button">Show more</a>
            </div>
    </div>
    @endforeach
</div>
<div class=" w-full bg-white shadow-lg flex items-center justify-center fixed bottom-0 left-0">
    @if($movies->count())
            {{ $movies->links() }}
    @endif
</div>

@endsection