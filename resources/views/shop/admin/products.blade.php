@extends('master')

@section('body')

    @foreach($products as $product)

        <li>
            {{ $product->name }}
        </li>
        <li>
            {{ $product->type }}
        </li>
        <li>
            {{ $product->price }}
        </li>

        <img src="{{ asset('images/'. $product->picture) }}" height="100" width="100">
        <form action="{{ route('admin.products.delete', $product->id) }}" method="POST">
            {{ csrf_field() }}
            <button type="submit" name="delete">X</button>
        </form>
        <hr>
    @endforeach

@endsection