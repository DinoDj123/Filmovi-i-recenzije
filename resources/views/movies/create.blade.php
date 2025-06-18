@extends('layouts.app')
@section('title')
Add movie
@endsection
@section('content')
    <form action="{{route('movies.store')}}" method="POST" enctype="multipart/form-data" class="form">
        <div>
            @csrf
            <div>
                <label for="title">Title: </label> <br>
                <input type="text" class="input" name="title" id="title" required />
            </div>
            <div>
                <label for="short_description">Short Description: </label> <br>
                <textarea type="text" class="input" name="short_description" id="short_description"></textarea>
            </div>
            <div>
                <label for="review">Review: </label> <br>
                <textarea type="text" class="input" name="review" id="review" required></textarea>
            </div>
            <div>
                <label for="rating">Rating: </label> <br>
                <select type="text" class="input" name="rating" id="rating" required>
                    <option value="">Select rating</option>
                        @for($i = 1; $i <= 10; $i++)
                            <option value="{{ $i }}" {{ old('rating') == $i ? 'selected' : '' }}>{{ $i }}</option>
                        @endfor
                </select>
            </div>
            <div>
                <label for="published_at">Published at: </label> <br>
                <input type="date" class="input" name="published_at" id="published_at" placeholder="YYYY-MM-DD" required>
            </div>
            <div>
                <label for="picture">Movie Poster: </label>
                <input type="file" class="input" id="picture" name="picture" accept="image/*" required />
                <p class="text-xs m-1 text-gray-500">Upload an image (JPG, PNG, JPEG only, max 2MB)</p>
            </div>
        </div>
        <button type="submit" class="button">Add</button>
    </form>
@endsection