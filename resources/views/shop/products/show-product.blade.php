@extends('master')

@section('body')

    <h3>{{ $product->name }}</h3>

    <img src="{{ asset('images/'. $product->picture) }}" height="200" width="200">

    <p>{{ $product->text }}</p>

    <p>{{ $product->price  }} E</p>



    @if(auth()->check())
        <form action="{{route('cart.add', $product->id) }}" method="POST">
            {{ csrf_field() }}
            <button type="submit">@lang('message.cart')</button>
        </form>
    @endif

    @if(! auth()->check())

        <p>Prihlas sa aby si nakupil !</p>

    @endif
    @if( auth()->check())
        <div class="card=block">
            <form method="POST" action="{{route('comment.create', $product->id)}}">
                {{ csrf_field() }}
                <div class="form-group">
                    <textarea name="body" placeholder="Add Comment." class="form-control" required ></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Add</button>
            </form>
        </div>

    @endif
@endsection