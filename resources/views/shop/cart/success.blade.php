@extends('master')
@section('body')
    <div class="container col-6" id="success-message">
        <h1>@lang('message.success_payment_article')</h1>
        <hr>
        <h6>@lang('message.success_payment')</h6>
        <form action="{{route('home')}}" method="GET">
            <button type="submit" class="btn btn-dark">OK</button>
        </form>
    </div>
@endsection