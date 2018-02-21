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
        <form action="{{ route('cart.minus', $product->id)}}" method="POST">
           {{ csrf_field()}}
            <button type="submit" name="minus">-</button>
        </form>
        <li>
            {{$product->quantity}}
        </li>
        <form action="{{ route('cart.plus', $product->id)}}" method="POST">
            {{ csrf_field()}}
            <button type="submit" name="plus">+</button>
        </form>
        <form action="{{ route('cart.delete', $product->id)}}" method="GET">
            <button type="submit" name="delete">X</button>
        </form>

    @endforeach
    <br>
    <hr>
    @if(! $total == 0)
        <form action="{{ route('cart.delete.all') }}" method="GET">
            <button type="submit" name="delete">Delete All</button>
        </form>
        {{$total}}
    @endif
    <br>

    <br>
    @if(!$total == 0)
        <form action="{{route('cart.card')}}" method="GET">

            <button type="submit">Pay online</button>
        </form>
    @endif

@endsection
