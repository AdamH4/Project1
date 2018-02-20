@extends('master')


@section('body')

    @foreach($products as $product)
        <hr>
        <img src="{{ asset('images/'. $product->picture) }}" height="100" width="100">
        <li>
            {{$product->name}}
        </li>
        <li>
            {{$product->type}}
        </li>
        <li>
            {{$product->name}}
        </li>
        <li>
            {{$product->price}}
        </li>
        <form action="/cart/quantity/minus/{{$product->id}}" method="POST">
           {{ csrf_field()}}
            <button type="submit" name="minus">-</button>
        </form>
        <li>
            {{$product->quantity}}
        </li>
        <form action="/cart/quantity/plus/{{$product->id}}" method="POST">
            {{ csrf_field()}}
            <button type="submit" name="plus">+</button>
        </form>
        <form action="/cart/delete/item/{{$product->id}}" method="GET">
            <button type="submit" name="delete">X</button>
        </form>

    @endforeach
    <br>
    <hr>
    @if(! $total == 0)
        <form action="/cart/delete/items" method="GET">
            <button type="submit" name="delete">Delete All</button>
        </form>
        {{$total}}
    @endif
    <br>

    <br>
    @if(! $total == 0)
        <form action="{{route('cart.card')}}" method="POST">
            {{ csrf_field()}}
            <button type="submit" name="pay" value="pay">Pay</button>
        </form>
    @endif

@endsection
