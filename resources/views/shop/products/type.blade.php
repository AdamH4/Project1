@extends('master')
@section('body')
    @foreach($products as $product)
        <a href="/product/{{ $product->id }}">
            <img src="{{ asset('images/'. $product->picture) }}" height="200" width="200">
            <p>{{ $product->name }}</p>
        </a>
        {{  $product->category }}
        <hr>
    @endforeach
@endsection