@extends('master')
@section('body')
    <div class="container col-9" id="cart-table">
        @if(! $products->isEmpty())
        <form action="{{route('products')}}" method="GET">
            <button class="btn btn-dark"><i class="fas fa-arrow-alt-circle-left">  @lang('message.to_products')</i></button>
        </form>
        <table class="table table-striped">
            <thead class="thead-dark">
            <tr>
                <th>@lang('message.product')</th>
                <th>@lang('message.quantity')</th>
                <th>@lang('message.price')</th>
                <th>@lang('message.delete')</th>
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
                    <form action="{{route('cart.minus',$product->rowId)}}" method="POST" id="quantity-minus">
                        {{csrf_field()}}
                        <button type="submit" class="btn btn-dark"><i class="fas fa-minus"></i></button>
                    </form>
                    <div class="quantity col-2">
                        {{$product->qty}}
                    </div>
                    <form action="{{route('cart.plus',$product->rowId)}}" method="POST" id="quantity-plus">
                        {{csrf_field()}}
                        <button type="submit" class="btn btn-dark"><i class="fas fa-plus"></i></button>
                    </form>
                </td>
                <td>
                    <div class="price">
                        {{$product->price}}
                    </div>
                </td>
                <td>
                    <form action="{{route('cart.delete',$product->rowId)}}" method="POST" id="delete-item">
                        {{csrf_field()}}
                        <button type="submit" class="btn btn-dark"><i class="far fa-trash-alt"></i></button>
                    </form>
                </td>
            </tr>
            @endforeach
            <tr>
                <td>
                    <form action="{{route('cart.delete.all')}}" method="POST">
                        {{csrf_field()}}
                        <button type="submit" class="btn btn-danger">@lang('message.delete_all')</button>
                    </form>
                </td>
                <td></td>
                <td>@lang('message.total') {{$total}}</td>
                <td></td>
            </tr>
            </tbody>
        </table>
            @if(! $u->isEmpty())
            <form action="{{route('cart.select.payment',$total)}}" method="POST">
                {{csrf_field()}}
                <button type="submit" class="btn btn-dark">@lang('message.next')</button>
            </form>
            @else
                <h5>@lang('message.notverified_email')</h5>
            @endif
            @else
                <h5>@lang('message.empty_cart')<a href="{{route('products')}}">@lang('message.empty_cart_shop')</a></h5>
        @endif
    </div>
@endsection

