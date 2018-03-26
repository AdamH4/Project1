@extends('master')
@section('body')
    <div class="container">
        <div id="quantity" class="col-5">
            <h3>@lang('contacts.article1')</h3>
            <hr>
            <h6>@lang('contacts.email')</h6>
            <h6>@lang('contacts.phone_number')</h6>
            <br>
            <h3>@lang('contacts.article2')</h3>
            <hr>
            <h6>@lang('contacts.address')</h6>
            <h6>@lang('contacts.ico')</h6>
            <h6>@lang('contacts.dic')</h6>
            <br>
            <h3>@lang('contacts.article3')</h3>
            <hr>
            <h6>@lang('contacts.contact_person')</h6>
            <h6>@lang('contacts.email')</h6>
            <h6></h6>
            <br>
            <br>
        </div>
        <div class="col-7" id="product-image">
            {!! $map['html'] !!}
        </div>
        {!! $map['js'] !!}
        <br>
        <br>
        <br>
        <br>
    </div>
@endsection