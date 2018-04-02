@extends('master')
@section('body')
    <div class="container">
        <div class="col-" id="nav-products">
            <a href="{{route('product.favourite')}}" id="purple-tag">
                <p>@lang('message.favourite_products')</p>
            </a>
            <p>@lang('message.categories'):</p>
            @foreach($categories as $category)
                <a href="{{ route('product.category', $category->category) }}" id="purple-tag">
                    <p>{{ ucfirst($category->category) }}</p>
                </a>
            @endforeach
        </div>
        <div class="col-">
            <h4 id="no_results">@lang('errors.no_results'){{$query}}".</h4>
        </div>
    </div>
@endsection