@extends('master')
@section('body')
<h2>
    Select type of payment:
</h2>
<h3>
    Your total:{{$total}}E
</h3>
    <form action="{{route('cart.card',$total)}}" method="POST">
        {{csrf_field()}}
        <button type="submit" class="btn-success">Card</button>
    </form>
    <form action="{{route('cart.dobierka',$total)}}" method="POST">
        {{csrf_field()}}
        <button type="submit" class="btn-success">Cash on delivery</button>
    </form>
@endsection