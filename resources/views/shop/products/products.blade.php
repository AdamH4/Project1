@extends('master')
@section('body')
    <h5>{{$products->count()}} Vysledky</h5>
    <h6>Order By:</h6>
    <p>Categories:</p>
    @foreach($categories as $category)
        <a href="{{ route('product.category', $category->category) }}">
            <p>{{ ucfirst($category->category) }}</p>
        </a>
    @endforeach
    <a href="{{route('product.favourite')}}">
        <p>Visit</p>
    </a>
    <br>
    <hr>
    @foreach($products as $product)
    <div class="row">
        <div class="col-sm-2">
        <a href="{{route('product.show' ,$product->id) }}">
            <img src="{{ asset('images/'. $product->picture) }}" height="200" width="200">
            <h4>{{ ucfirst($product->name) }}</h4>
        </a>
        <a href="{{ route('product.category', $product->category) }}">
            <p>{{ ucfirst($product->category) }}</p>
        </a>
        </div>
    </div>
    @endforeach
    {{ $products->links() }}
@endsection()