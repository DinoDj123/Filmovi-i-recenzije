@extends('layouts.app')
@section('title')
Edit movie
@endsection
@section('content')
    <form action="{{route('movies.update',$movie)}}" method="POST" enctype="multipart/form-data" class="form">
        <div>
            @csrf
            @method('PUT')
            <div>
                <label for="title">Title: </label> <br>
                <input type="text" class="input" name="title" id="title" 
                value="{{ old('title', $movie->title)}}" required />
            </div>
            <div>
                <label for="short_description">Short Description: </label> <br>
                <textarea type="text" class="input" name="short_description" id="short_description" >{{ old('short_description', $movie->short_description)}}</textarea>
            </div>
            <div>
                <label for="review">Review: </label> <br>
                <textarea type="text" class="input" name="review" id="review" required>{{ old('review', $movie->review)}}
                </textarea>
            </div>
            <div>
                <label for="rating">Rating: </label> <br>
                    <select class="input" name="rating" id="rating" required>
                        <option disabled {{ old('rating', $movie->rating) ? '' : 'selected' }}>Select rating</option>
                        @for($i = 1; $i <= 10; $i++)
                            <option value="{{ $i }}" {{ old('rating', $movie->rating) == $i ? 'selected' : '' }}>{{ $i }}</option>
                        @endfor
                    </select>
            </div>
            <div>
                <label for="published_at">Published at: </label> <br>
                <input type="date" class="input" name="published_at" id="published_at" 
                value="{{ old('published_at', $movie->published_at)}}" required>
            </div>
            <div>
                <label for="picture">Movie Poster: </label>
                    @if($movie->picture && Storage::disk('public')->exists($movie->picture))
                        <img src="{{ asset('storage/' . $movie->picture) }}" alt="" class="w-32 h-48">
                    @else
                        <img src="{{asset('storage/posters/default.jpg')}}" alt="placeholder" class="w-32 h-48">
                    @endif

                <input type="file" class="input" id="picture" name="picture" accept="image/*"/>
                <p class="text-xs m-1 text-gray-500">Upload an image (JPG, PNG, JPEG only, max 2MB)</p>
            </div>
        </div>
        <button type="submit" class="button">Add</button>
    </form>
@endsection