@extends('master')

@section('body')

    @if(isset($details))

        @foreach($details as $result)
            <a href="/product/{{ $result->id }}">
                <p>
                    {{ $result->name }}

                </p>
            </a>

            {{  $result->type }}

            <hr>

        @endforeach

    @elseif(isset($message))
        {{$message}}

    @endif

@endsection