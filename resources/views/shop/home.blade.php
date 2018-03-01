@extends('master')
@section('body')
    @if(! auth()->check())
        @elseif(! $u->isEmpty())
            <p>Your email is verified</p>
    @else
        <p>Your email wasn t verified</p>
    @endif
@endsection