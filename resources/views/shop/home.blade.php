@extends('master')
@section('body')
    @if(session()->has('success_verify'))
        <div class="alert alert-success">
            {{session()->get('success_verify')}}
        </div>
    @endif
    @if(! auth()->check())
        @elseif(! $u->isEmpty())
            <p>Your email is verified</p>
    @else
        <p>Your email wasn t verified</p>
    @endif
@endsection