@extends('layouts.app')

@section('title')
<h1 >All Users</h1> 
@endsection
@section('content')
<div class="movie items-center">
    <table class="min-w-full table-auto border border-gray-200">
        <thead class='table-header-group'>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Created At</th>
                <th>Admin</th>
            </tr>
        </thead>
        <tbody >
            @foreach($users as $user)
                    <tr class="table-row">
                        <td class="text-blue-600 underline"> 
                            <a href="{{route('users.show',$user)}}"> 
                                {{ $user->id }} 
                            </a>
                    </td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->created_at->format('Y-m-d') }}</td>
                        <td>
                            @if($user->admin)
                                *
                            @endif
                        </td>
                    </tr>
            @endforeach
        </tbody>
    </table>
</div>
<div class="fixed bottom-0 left-0 w-full bg-white shadow-lg h-16 z-10 flex items-center justify-center">
    @if($users->count())
            {{ $users->links() }}
    @endif
</div>
@endsection