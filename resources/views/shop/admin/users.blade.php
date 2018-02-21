@extends('master')

@section('body')
    <p>
        @lang('message.welcome')
    </p>

    @foreach($users as $user)

        <li>
            {{ $user->name }}
        </li>
        {{ $user->created_at }}
        <form action="{{ route('admin.users.delete', $user->id) }}" method="POST">
            {{ csrf_field() }}
            <button type="submit" name="delete">X</button>
        </form>

        <hr>

    @endforeach

@endsection
