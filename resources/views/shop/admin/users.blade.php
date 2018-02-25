@extends('master')

@section('body')
    @if(session()->has('success_upgrade'))
        <div class="alert-success">
            {{session()->get('success_upgrade')}}
        </div>
    @endif
    <p>
        @lang('message.welcome')
    </p>
    @foreach($users as $user)
        <hr>
        <li>
            {{ $user->name }}
        </li>
        {{ $user->created_at }}
        <form action="{{ route('admin.users.delete', $user->id) }}" method="POST">
            {{ csrf_field() }}
            <button type="submit" name="delete">X</button>
        </form>

        @if(! $user->isAdmin())
            <p>User</p>
            <form action="{{route('admin.create',$user->id)}}" method="POST">
                {{csrf_field()}}
                <button type="submit">Make Admin</button>
            </form>
        @else
        <p>Admin</p>
        @endif
    @endforeach
@endsection
