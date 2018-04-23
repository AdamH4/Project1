@extends('master')
@section('body')
    <div class="container col-8">
        <form action="{{route('cart')}}" method="GET">
            <button class="btn btn-dark"><i class="fas fa-arrow-alt-circle-left"></i></button>
        </form>
        <h2>@lang('message.select_delivery')</h2>
        <hr>
        <div class="row">
        <div class="col-4">
            <h5>@lang('message.free_delivery')</h5>
            <br>
            <form action="{{route('cart.select.payment','slovenska posta')}}" method="POST">
                {{csrf_field()}}
                <button class="btn btn-dark" id="card-button">@lang('message.slovak_post')</button>
            </form>
            <form action="{{route('cart.select.payment','UPC')}}" method="POST">
                {{csrf_field()}}
                <button class="btn btn-dark" id="card-button">@lang('message.upc')</button>
            </form>
            <form action="{{route('cart.select.payment','DHL')}}" method="POST">
                {{csrf_field()}}
                <button class="btn btn-dark" id="card-button">@lang('message.dhl')</button>
            </form>
        </div>
            <div class="col-7 offset-1">
            <table class="table table-striped">
                <thead class="thead-dark">
                <tr>
                    <th>@lang('message.product')</th>
                    <th>@lang('message.quantity')</th>
                    <th>@lang('message.price')</th>
                    <th>@lang('message.price_dph')</th>
                </tr>
                </thead>
                <tbody>
                @foreach($products as $product)
                    <tr>
                        <td>
                            <a href="{{route('product.show',$product->id)}}" id="purple-tag">
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
                                {{$product->price * 0.8}} €
                            </div>
                        </td>
                        <td>
                            <div class="price">
                                {{$product->price}} €
                            </div>
                        </td>
                    </tr>
                @endforeach
                <tr>
                    <td></td>
                    <td></td>
                    <td>@lang('message.total') {{$total}} €</td>
                    <td></td>
                </tr>
                </tbody>
            </table>
            </div>
        </div>
    </div>
@endsection