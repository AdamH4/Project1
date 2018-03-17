@extends('master')
@section('body')
    <div class="container col-9">
    <form action="{{route('cart.select.payment',$type)}}" method="POST">
        {{csrf_field()}}
        <button class="btn btn-dark"><i class="fas fa-arrow-alt-circle-left"></i></button>
    </form>
    <form action="{{route('cart.dobierka.checkout',$type)}}" method="POST">
        {{csrf_field()}}
        @if($information->isEmpty())
        <h2>@lang('message.informations')</h2>
        <hr>
        <div class="form-group" id="cashondelivery-form">
            <label for="first_name">@lang('message.first_name')</label>
            <input type="text" id="first_name" name="first_name" class="form-control" required>
            <label for="second_name">@lang('message.second_name')</label>
            <input type="text" id="second_name" name="second_name" class="form-control" required>
            <input type="hidden"  id="name_on_card" name="name_on_card" value="{{auth()->user()->name}}" required>
            <label for="city">@lang('message.city')</label>
            <input type="text" id="city" name="city" class="form-control" required>
            <label for="street">@lang('message.street')</label>
            <input type="text" id="street" name="street" class="form-control" required>
            <label for="postcode">@lang('message.postcode')</label>
            <input type="text" id="postcode" name="postcode" class="form-control" required>
            <label for="country">@lang('message.country')</label>
            <input type="text" id="country" name="country" class="form-control" required>
            <label for="phone_number">@lang('message.phone_number')</label>
            <input type="text" name="phone_number" id="phone_number" class="form-control" required>
            <label for="note">@lang('message.note')</label>
            <textarea name="note" id="note" class="form-control"></textarea>
            <br>
            <button type="submit" class="btn btn-dark form-control" id="payment">@lang('message.submit_payment')</button>
        </div>
            @else
                <div class="form-group" id="cashondelivery-form">
                    <h2>@lang('message.use_information') <a href="{{route('user.add.information')}}" id="purple-tag">@lang('message.it')</a></h2>
                    <hr>
                    <label for="note">@lang('message.note')</label>
                    <textarea name="note" id="note" class="form-control"></textarea>
                    <br>
                    <button type="submit" class="btn btn-dark form-control" id="payment">@lang('message.submit_payment')</button>
                </div>
            @endif
    </form>
        <div id="cashondelivery-table">
            <table class="table table-striped col-4">
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
                </tr>
                </tbody>
            </table>
        </div>
    </div>
    </div>
@endsection