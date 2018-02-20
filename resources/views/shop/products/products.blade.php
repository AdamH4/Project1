@extends('master')

@section('body')

    @foreach($types as $type)

        <a href="/product/type/{{ $type->type }}">
            <p>{{ ucfirst($type->type) }}</p>
        </a>

    @endforeach
    <br>
    <br>

    @foreach($products as $product)

        <img src="{{ asset('images/'. $product->picture) }}" height="200" width="200">

        <a href="/product/{{ $product->id }}">
            <h4>{{ ucfirst($product->name) }}</h4>
        </a>

        <a href="/type/{{ $type->type }}">
            <p>{{ ucfirst($product->type) }}</p>
        </a>
        <hr>
    @endforeach

@endsection()