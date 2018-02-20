@extends('master')

@section('body')

    <form action="{{ route('checkout') }}" method="POST" id="checkout-form">
        {{ csrf_field() }}
        <div class="row">
            <div class="col-xs-12">
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" id="name" class="form-control" required>
                </div>
            </div>
            <div class="col-xs-12">
                <div class="form-group">
                    <label for="address">Address</label>
                    <input type="text" id="address" class="form-control" required>
                </div>
            </div>
            <div class="col-xs-12">
                <div class="form-group">
                    <label for="card-name">Card Holder Name</label>
                    <input type="text" id="card-name" class="form-control" data-stripe="name" required>
                </div>
            </div>
            <div class="col-xs-12">
                <div class="form-group">
                    <label for="card-number">Credit Card Number</label>
                    <input type="text" id="card-number" class="form-control" data-stripe="number" required>
                </div>
            </div>
            <div class="col-xs-12">
                <div class="row">
                    <div class="col-xs-6">
                        <div class="form-group">
                            <label for="card-expiry-month">Expiration Month</label>
                            <input type="text" id="card-expiry-month" class="form-control" data-stripe="exp_month" required>
                        </div>
                    </div>
                    <div class="col-xs-6">
                        <div class="form-group">
                            <label for="card-expiry-year">Expiration Year</label>
                            <input type="text" id="card-expiry-year" class="form-control" data-stripe="exp_year" required>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xs-12">
                <div class="form-group">
                    <label for="card-cvc">CVC</label>
                    <input type="text" id="card-cvc" class="form-control" data-stripe="cvc" required>
                </div>
            </div>
        </div>

        <button type="submit" class="submit btn btn-success">Buy Now!</button>
    </form>
@endsection()