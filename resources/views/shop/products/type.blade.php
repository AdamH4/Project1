@extends('master')

@section('body')


    @foreach($products as $product)

        <img src="{{ asset('images/'. $product->picture) }}" height="200" width="200">

        <a href="/product/{{ $product->id }}">
            <p>
                {{ $product->name }}

            </p>
        </a>

        {{  $product->type }}

        <hr>

    @endforeach

@endsection