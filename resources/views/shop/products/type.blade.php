@extends('master')

@section('body')


    @foreach($products as $product)

        <a href="/product/{{ $product->id }}">
            <p>
                {{ $product->name }}

            </p>
        </a>

        {{  $product->type }}

        <hr>

    @endforeach

@endsection