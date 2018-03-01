@extends('master')
@section('body')
    <div class="container">
    @foreach($products as $product)
        <hr>
        <a href="{{route('product.show',$product->id)}}">
            <img src="{{ asset('images/'. $product->options->picture) }}" height="100" width="100">
            <p>
                {{$product->name}}
            </p>
        </a>
        <p>{{$product->price}}</p>
        <form action="{{route('cart.minus',$product->rowId)}}" method="POST">
            {{csrf_field()}}
            <button type="submit">-</button>
        </form>
        {{$product->qty}}
        <form action="{{route('cart.plus',$product->rowId)}}" method="POST">
            {{csrf_field()}}
            <button type="submit">+</button>
        </form>
        <form action="{{route('cart.delete',$product->rowId)}}" method="POST">
            {{csrf_field()}}
            <button type="submit">X</button>
        </form>
    @endforeach
    @if(! $products->isEmpty())
        {{$total}}
        <form action="{{route('cart.select.payment',$total)}}" method="POST">
        {{csrf_field()}}
        <button type="submit" class="btn btn-success">Next</button>
    </form>
    @else
        <p>Nothing in cart go to a <a href="{{route('products')}}">shop</a></p>
    @endif
    </div>
@endsection
