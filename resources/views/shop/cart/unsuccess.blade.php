@extends('master')
@section('body')
    @if (session()->has('error'))
        <div class="alert alert-success">
            {{ session()->get('error') }}
        </div>
    @endif
    <form action="{{route('cart')}}" method="GET">
        <button type="submit" class="btn-outline-primary">Go back</button>
    </form>
@endsection