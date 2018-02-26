@extends('master')

@section('body')
    <h5>{{$products->count()}} Vysledky</h5>
    <br>
    @foreach($products as $product)

        <a href="{{route('admin.product.show' ,$product->id) }}">
            <img src="{{ asset('images/'. $product->picture) }}" height="200" width="200">
            <h4>{{ ucfirst($product->name) }}</h4>
        </a>
        <p>{{ ucfirst($product->type) }}</p>
        <form action="{{ route('admin.products.delete', $product->id) }}" method="POST">
            {{ csrf_field() }}
            <button type="submit" name="delete">
                X
            </button>
        </form>
        <hr>
    @endforeach
    {{ $products->links() }}
@endsection