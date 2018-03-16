@extends('master')
@section('body')
<div class="container col-4">
    @if($add->isEmpty())
    <h2>@lang('message.insert_information')</h2>
    @else()
        <h2>@lang('message.update_information')</h2>
    @endif
    <hr>
    <form action="{{route('user.update.information')}}" method="POST">
        {{csrf_field()}}
        @include('shop.errors.error')
        <div class="form-group">
            <label for="first_name">@lang('message.first_name')</label>
            <input type="text" id="first_name" name="first_name" class="form-control" required>
            <label for="second_name">@lang('message.second_name')</label>
            <input type="text" id="second_name" name="last_name" class="form-control" required>
            <input type="hidden" id="name_on_card" name="name_on_card" value="{{auth()->user()->name}}" required>
            <label for="city">@lang('message.city')</label>
            <input type="text" id="city" name="city" class="form-control" required>
            <label for="street">@lang('message.street')</label>
            <input type="text" id="street" name="street" class="form-control" required>
            <label for="postcode">@lang('message.postcode')</label>
            <input type="text" id="postcode" name="postcode" class="form-control" required>
            <label for="country">@lang('message.country')</label>
            <input type="text" id="country" name="country" class="form-control" required>
            <label for="phone_number">@lang('message.phone_number')</label>
            <input type="text" name="phone_number" id="phone_number" class="form-control" >
            <br>
            <button type="submit" class="btn btn-dark form-control" id="payment">@lang('message.add_information')</button>
        </div>
    </form>
@endsection()