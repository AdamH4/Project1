@extends('master')

@section('body')

    @if(isset($unsuccess_message))
        <div class="alert alert-danger">
            {{$unsuccess_message}}
        </div>
    @endif
    @if(isset($details))

        @foreach($details as $product)
            <hr>
            <img src="{{ asset('images/'. $product->picture) }}" height="200" width="200">

            <a href="/product/{{ $product->id }}">
                <p>
                    {{ $product->name }}

                </p>
            </a>
            <a href="/product/type/{{ $product->type }}">
                {{  $product->type }}
            </a>
        @endforeach

    @elseif(isset($message))
        {{$message}}
    @endif

@endsection