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
        <!--<p>@lang('message.products_price'):</p>
        <form action="{{route('product.price.up',$products->all())}}" method="POST">
            {{csrf_field()}}
            <button type="submit" class="btn btn-dark"><i class="fas fa-caret-up"></i></button>
        </form>
        <form action="{{route('product.price.down',$products->all())}}" method="POST">
            {{csrf_field()}}
            <button type="submit" class="btn btn-dark"><i class="fas fa-caret-down"></i></button>
        </form>-->
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