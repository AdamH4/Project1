@extends('master')

@section('body')

    <h3>{{ $product->name }}</h3>

    <p>{{ $product->text }}</p>

    <form action="/" method="GET">
        <button type="submit">@lang('message.cart')</button>
    </form>


@endsection