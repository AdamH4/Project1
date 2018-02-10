@extends('master')

@section('body')

    @foreach($types as $type)

        <a href="/type={{ $type->type }}">
            <p>{{ ucfirst($type->type) }}</p>
        </a>

    @endforeach

    <br>
    <br>

    @foreach($products as $product)

        <a href="/product/{{ $product->id }}">
            <h4>{{ ucfirst($product->name) }}</h4>
        </a>

        <a href="/?description={{ $type->type }}">
            <p>{{ $product->type }}</p>
        </a>
        <hr>
    @endforeach
@endsection()