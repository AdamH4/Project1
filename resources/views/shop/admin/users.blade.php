@extends('master')
@section('body')
    @if(session()->has('success_upgrade'))
        <div class="alert-success">
            {{session()->get('success_upgrade')}}
        </div>
    @endif
    @if(session()->has('success_demote'))
        <div class="alert-success">
            {{session()->get('success_demote')}}
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
            <form action="{{route('admin.promote',$user->id)}}" method="POST">
                {{csrf_field()}}
                <button type="submit" class="btn-success">Make Admin</button>
            </form>
        @else
        <p>Admin</p>
        <form action="{{route('admin.demote',$user->id)}}" method="POST">
            {{csrf_field()}}
            <button type="submit" class="btn-danger">Demote</button>
        </form>
        @endif
    @endforeach
    <hr>
@endsection
