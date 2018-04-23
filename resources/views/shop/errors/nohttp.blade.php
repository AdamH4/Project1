@extends('master')
@section('body')
    <div class="container col-8">
        <div class="text-center">
            <h2>@lang('errors.noHttp') <a href="{{route('home')}}" id="purple-tag">@lang('errors.noHttp_return')</a></h2>
        </div>
    </div>
@endsection