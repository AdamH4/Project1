@extends('master')
@section('body')
    <h5>{{$products->count()}} Vysledky</h5>
    @foreach($types as $type)
        <a href="{{ route('product.type', $type->type) }}">
            <p>{{ ucfirst($type->type) }}</p>
        </a>
    @endforeach
    <br>
    <br>
    @foreach($products as $product)
        <a href="{{route('product.show' ,$product->id) }}">
            <img src="{{ asset('images/'. $product->picture) }}" height="200" width="200">
            <h4>{{ ucfirst($product->name) }}</h4>
        </a>
        <a href="{{ route('product.type', $type->type) }}">
            <p>{{ ucfirst($product->type) }}</p>
        </a>
        <hr>
    @endforeach
    {{ $products->links() }}
@endsection()