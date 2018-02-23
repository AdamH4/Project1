@extends('master')
@section('body')
    <div class="container">
    @foreach($products as $product)
        <hr>
        {{$product->id}}
        {{$product->name}}
        {{$product->price}}
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
    <form action="{{route('cart.delete.all')}}" method="POST">
        {{ csrf_field() }}
        <button type="submit">Delete ALL</button>
    </form>
    {{$total}}
    <form action="{{route('cart.card', $total)}}" method="POST">
        {{csrf_field()}}
        <button type="submit" class="btn btn-outline-success">Pay by card</button>
        <label for="dobierka">Dobierka</label>
        <input type="" name="dobierka" id="dobierka">
        <label for="card">Karta</label>
        <input type="" name="card" id="card">
    </form>
    </div>
@endsection
