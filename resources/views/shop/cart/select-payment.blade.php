@extends('master')
@section('body')
<div class="container col-9">
    <form action="{{route('cart')}}" method="GET">
        <button class="btn btn-dark"><i class="fas fa-arrow-alt-circle-left"></i></button>
    </form>
    <h2>@lang('message.select_payment')</h2>
    <hr>
    <div class="select-payment">
        <form action="{{route('cart.card', $total)}}" method="POST">
            {{csrf_field()}}
            <button type="submit" class="btn btn-dark" id="card-button">@lang('message.card') <i class="far fa-credit-card"></i></button>
        </form>
        <form action="{{route('cart.dobierka', $total)}}" method="POST">
            {{csrf_field()}}
            <button type="submit" class="btn btn-dark" id="card-button">@lang('message.cash') <i class="far fa-money-bill-alt"></i></button>
        </form>
    </div>
    <div id="cashondelivery-table">
        <table class="table table-striped col-3">
            <thead class="thead-dark">
            <tr>
                <th>@lang('message.product')</th>
                <th>@lang('message.quantity')</th>
                <th>@lang('message.price')</th>
            </tr>
            </thead>
            <tbody>
            @foreach($products as $product)
                <tr>
                    <td>
                        <a href="{{route('product.show',$product->id)}}">
                            <img src="{{ asset('images/'. $product->options->picture) }}" height="100" width="100">
                            {{$product->name}}
                        </a>
                    </td>
                    <td>
                        <div class="quantity col-2">
                            {{$product->qty}}
                        </div>
                    </td>
                    <td>
                        <div class="price">
                            {{$product->price}}
                        </div>
                    </td>
                </tr>
            @endforeach
            <tr>
                <td></td>
                <td></td>
                <td>@lang('message.total') {{$total}}</td>
            </tr>
            </tbody>
        </table>
    </div>
</div>

@endsection