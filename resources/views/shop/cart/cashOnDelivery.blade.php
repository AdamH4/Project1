@extends('master')
@section('body')
    <div class="container col-4">
    <h2>Your order {{$total}}</h2>
    <form action="{{route('cart.dobierka.checkout')}}" method="POST">
    {{csrf_field()}}
    <div class="form-group">
        <label for="first_name">First name</label>
        <input type="text" id="first_name" name="first_name" class="form-control" required>
        <label for="second_name">Second name</label>
        <input type="text" id="second_name" name="second_name" class="form-control" required>
        <input type="hidden"  id="name_on_card" name="name_on_card" value="{{auth()->user()->name}}" required>
        <label for="city">City</label>
        <input type="text" id="city" name="city" class="form-control" required>
        <label for="street">Street</label>
        <input type="text" id="street" name="street" class="form-control" required>
        <label for="postcode">Postcode</label>
        <input type="text" id="postcode" name="postcode" class="form-control" required>
        <label for="country">Country</label>
        <input type="text" id="country" name="country" class="form-control" required>
        <label for="phone_number">Phone number</label>
        <input type="text" name="phone_number" id="phone_number" class="form-control" required>
        <br>
        <button type="submit" class="btn btn-dark" id="payment">Submit Payment</button>
    </div>
    </form>

    </div>
@endsection