@extends('layouts.app')

@php
use Illuminate\Support\Facades\Storage;
@endphp

@section('title')
    User profile
@endsection
@section('content')
<div class="movie justify-center items-center">
    <div class="p-3 bg-gray-200 border-gray-200 rounded-4xl">
        @if($user->picture && Storage::disk('public')->exists($user->picture))
                <img src="{{ asset('storage/' . $user->picture) }}" alt="{{ $user->name }}" width="200">
            @else
                <img src="{{ asset('storage/avatars/defaultAvatar.jpg') }}" alt="Placeholder" width="200">
            @endif
    </div>
    <h1 class="font-semibold text-2xl"> {{ $user->name }} <br>{{$user->email}}</h1>
    <div class="textcontainer gap-y-2">
        
        <p class="">{{ $user->about }}</p>
        <p class="">Joined: {{$user->created_at}}</p>
        <p class="">Updated: {{$user->updated_at}}</p>
        </div>
        
    </div>
</div>
@endsection