@extends('master')
@section('body')
    <h2>Your order {{$total}}</h2>
    <form action="{{route('cart.dobierka.checkout',$total)}}" method="POST">
        {{csrf_field()}}
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" placeholder="Your name">
        <label for="address">Address:</label>
        <input type="text" id="address" name="address" placeholder="Your Address">
        <label for="postcode">Post Code:</label>
        <input type="text" id="postcode" name="postcode" placeholder="Your postcode">
        <label for="phone">Phone:</label>
        <input type="text" id="phone" name="phone" placeholder="Your phone number">
        <button type="submit" class="btn-success">Order</button>
    </form>
@endsection