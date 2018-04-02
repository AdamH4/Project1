@extends('master')
@section('body')
    <div class="container col-7">
        @if(session()->has('transaction_success'))
            <div class="alert alert-success">
                {{session()->get('transaction_success')}}
            </div>
        @endif
    @if(session()->has('success_upgrade'))
        <div class="alert alert-success">
            {{session()->get('success_upgrade')}}
        </div>
    @endif
    @if(session()->has('success_demote'))
        <div class="alert alert-danger">
            {{session()->get('success_demote')}}
        </div>
    @endif
    <h2>All users:</h2>
    <hr>
    @foreach($users as $user)
        <form action="{{route('admin.user.transactions',$user)}}" method="POST">
            {{csrf_field()}}
            <button type="submit" id="purple-tag" class="btn btn-link"><b>{{$user->name}}</b></button>
        </form>
        User account created at: {{ $user->created_at->toFormattedDateString() }}
        <form action="{{ route('admin.users.delete', $user->id) }}" method="POST">
            {{ csrf_field() }}
            <button type="submit" class="btn btn-dark" name="delete"><i class="far fa-trash-alt"></i></button>
        </form>

        @if(! $user->isAdmin())
        <h5>Status: User</h5>
        <form action="{{route('admin.promote',$user->id)}}" method="POST">
            {{csrf_field()}}
            <button type="submit" class="btn btn-success">Promote</button>
        </form>
        @else
        <h5>Status: Admin</h5>
        <form action="{{route('admin.demote',$user->id)}}" method="POST">
            {{csrf_field()}}
            <button type="submit" class="btn btn-danger">Demote</button>
        </form>
        @endif
    @endforeach
    <hr>
    </div>
@endsection
