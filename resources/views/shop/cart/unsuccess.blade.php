@extends('master')
@section('body')
    <div class="container col-6">
        @if (session()->has('error'))
        <div class="alert alert-danger">
            {{ session()->get('error') }}
        </div>
        @endif
        <form action="{{route('cart')}}" method="GET">
            <button type="submit" class="btn btn-dark">Go back</button>
        </form>
    </div>
@endsection