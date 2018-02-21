@extends('master')

@section('body')

    @foreach($types as $type)

        <a href="{{ route('product.type', $type->type) }}">
            <p>{{ ucfirst($type->type) }}</p>
        </a>

    @endforeach
    <br>
    <br>

    @foreach($products as $product)

        <img src="{{ asset('images/'. $product->picture) }}" height="200" width="200">

        <a href="{{route('product.show' ,$product->id) }}">
            <h4>{{ ucfirst($product->name) }}</h4>
        </a>

        <a href="{{ route('product.type', $type->type) }}">
            <p>{{ ucfirst($product->type) }}</p>
        </a>
        <hr>
    @endforeach

@endsection()