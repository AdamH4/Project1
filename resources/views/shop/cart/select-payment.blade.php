@extends('master')
@section('body')
<div class="container col-4">
    <h2>
        Select type of payment:
    </h2>
    <h3>
        Your total:{{$total}}E
    </h3>
    <form action="{{route('cart.card', $total)}}" method="POST">
        {{csrf_field()}}
        <button type="submit" class="btn btn-dark" id="card-button"><i class="far fa-credit-card"></i></button>
    </form>
    <form action="{{route('cart.dobierka', $total)}}" method="POST">
        {{csrf_field()}}
        <button type="submit" class="btn btn-dark" id="card-button"><i class="far fa-money-bill-alt"></i></button>
    </form>
</div>
@endsection