<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="UTF-8">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Filmovi i recenzije</title>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>

    <style>
        .movie {
            margin: 1rem auto;
            padding: 2rem;
            max-width: 800px;
            max-height:1400px;
            display: flex;
            flex-direction: column;
            gap: 2rem;
            background: #fff;
            border-radius: 1rem;
            box-shadow: 0 4px 16px rgba(74, 144, 226, 0.10);
        }

        .form {
            margin: 2rem auto;
            padding: 2rem;
            max-width: 500px;
            display: flex;
            flex-direction: column;
            gap: 1.5rem;
            background: #fff;
            border-radius: 1rem;
            box-shadow: 0 4px 16px rgba(74, 144, 226, 0.10);
        }
        .input {
            border: 1px solid #ccc;
            background-color: #f8f9fa;
            padding: 0.5rem;
            border-radius: 0.25rem;
            width: 100%;
        }
        
        .input:focus {
            outline: none;
            border-color: #4a90e2;
            box-shadow: 0 0 0 2px rgba(74, 144, 226, 0.2);
        }
        .input:hover{
            outline: none;
            border-color: #4a90e2;
            box-shadow: 0 0 0 2px rgba(74, 144, 226, 0.2);
        }
        .button{
            border: 1px solid #ccc;
            background-color:lightblue;
            padding: 0.5rem;
            border-radius: 0.25rem;
        }
        .button:hover{
            outline: none;
            background-color: #4a90e2;
            box-shadow: 0 0 0 2px rgba(74, 144, 226, 0.2);
        }
        .redbutton{
            border: 1px solid #ccc;
            background-color:lightcoral;
            padding: 0.5rem;
            border-radius: 0.25rem;
        }
        .redbutton:hover{
            outline: none;
            background-color: red;
            box-shadow: 0 0 0 2px rgba(74, 144, 226, 0.2);
        }
        .textcontainer{
            margin-left: 1rem;
            padding: 2rem;
            display: flex;
            max-height:400px;
            flex-direction: column;
            background-color: rgba(255, 255, 255, 0.884);
            border:2px solid;
            border-color:var(--color-gray-200);
            border-radius: 1rem;
            box-shadow: 0 4px 16px rgba(74, 144, 226, 0.10);
            align-items: left;
        }
</style>
    <body class="bg-gray-200 ">
        <nav class="bg-white shadow-lg w-full fixed top-0 h-16 z-10">
            <div class="max-w-7xl mx-auto px-4 h-full">
                <div class="flex items-center justify-between h-full text-xl">
                
                    <div class="flex space-x-10 font-medium text-gray-600 items-center ">
                        <a href="{{ url('/') }}">Home</a>
                        @yield('nav')
                        <div class=" border-l-2 border-gray-400 h-12"></div>
                    </div>

                    <div class="font-semibold text-4xl text-gray-800 center">
                        @yield('title')
                    </div>

                    <div class="flex space-x-10 font-medium text-gray-600 items-center">
                        <div class="border-r-2 border-gray-400 h-12"></div>

                        @if(!Auth::user())
                            <a href="{{ route('login') }}">Login</a>
                            <a href="{{ route('register.create') }}">Register</a>
                        @else
                            <a href="{{ route('myprofile') }}">Profile: <strong>{{ Auth::user()->name }}</strong></a>
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit">Logout</button>
                            </form>
                        @endif
                    </div>

                </div>
                @if(auth()->user())
                    @if(auth()->user()->isAdmin())
                        <div class="bg-gray-300 border-2 border-gray-500 rounded flex justify-center items-center h-12 space-x-3">
                            <h1 class=" text-gray-500 text-xl">Admin active </h1>
                            <a href="{{route('users.index')}}" class="bg-gray-300 border-2 border-gray-500 rounded p-1 text-gray-500">Users</a>
                        </div>
                    @endif
                @endif

                <div class="m-2 text-xl items-center flex justify-center">
                    @if(session('success'))
                        <div class="bg-green-100 text-green-700 p-2 rounded">
                            {{ session('success') }}
                        </div>
                    @endif
                
                    @if($errors->any())
                        <div class="bg-red-100 text-red-600 p-2 rounded">
                            <ul class="list-disc pl-5">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>
            </div>
        </nav>
        <main class="m-10 pt-10 pb-10">
            @yield('content')  
        </main>
    </body>
</html>