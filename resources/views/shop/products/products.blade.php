@extends('master')
@section('body')
    <div class="container">
        <div class="nav-products">
        <a href="{{route('product.favourite')}}" id="purple-tag">
            <p>@lang('message.favourite_products')</p>
        </a>
        <p>@lang('message.categories'):</p>
        @foreach($categories as $category)
            <a href="{{ route('product.category', $category->category) }}" id="purple-tag">
                <p>{{ ucfirst($category->category) }}</p>
            </a>
        @endforeach
        <h6>Order by price</h6>
            <a href="?orderByPrice=asc" id="purple-tag"><i class="fas fa-angle-up"></i>Od najmensej</a>
            <br>
            <br>
            <a href="?orderByPrice=desc" id="purple-tag"><i class="fas fa-angle-down"></i>Od najvacsej</a>
        </div>
        <div class="row" >
        @foreach($products as $product)
            <div class="col-3">
            <a href="{{route('product.show' ,$product->id) }}" id="black-tag">
                <img class="img-fluid img-thumbnail" src="{{ asset('images/'. $product->picture) }}" height="200" width="200">
                <h4 >{{ ucfirst($product->name) }}</h4>
                <h3>{{$product->price}},- €</h3>
            </a>
            <a href="{{ route('product.category', $product->category) }}" id="black-tag">
                <p>{{ ucfirst($product->category) }}</p>
            </a>
            </div>
        @endforeach
        </div>
        <div class="pagination">
        {{$products->links()}}
        </div>
    </div>
@endsection()