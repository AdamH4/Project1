@extends('master')

@section('body')

    <h3>{{ $product->name }}</h3>

    <img src="{{ asset('images/'. $product->picture) }}" height="200" width="200">

    <p>{{ $product->text }}</p>

    <p>{{ $product->price  }} E</p>



    @if(auth()->check())
        <form action="/cart/{{ $product->id }}" method="POST">
            {{ csrf_field() }}
            <button type="submit">@lang('message.cart')</button>
        </form>
    @endif

    @if(! auth()->check())

        <p>Prihlas sa aby si nakupil !</p>

    @endif
@endsection