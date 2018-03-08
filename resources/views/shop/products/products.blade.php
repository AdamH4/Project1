@extends('master')
@section('body')
    <div class="container col-8">
        <div class="nav-products">
        <h5>{{$products->count()}} Vysledky</h5>
        <h6>Order By:</h6>
        <p>Categories:</p>
        @foreach($categories as $category)
            <a href="{{ route('product.category', $category->category) }}">
                <p>{{ ucfirst($category->category) }}</p>
            </a>
        @endforeach
        <a href="{{route('product.favourite')}}">
            <p>Most viewed products</p>
        </a>
        </div>
        <span id="products">
        <div class="row">
        @foreach($products as $product)
            <div class="col-3">
            <a href="{{route('product.show' ,$product->id) }}">
                <img class="img-fluid img-thumbnail" src="{{ asset('images/'. $product->picture) }}" height="200" width="200">
                <h4>{{ ucfirst($product->name) }}</h4>
            </a>
            <a href="{{ route('product.category', $product->category) }}">
                <p>{{ ucfirst($product->category) }}</p>
            </a>
            </div>
        @endforeach
        </div>
        </span>
        <div class="pagination">
        {{$products->links()}}
        </div>
    </div>
@endsection()