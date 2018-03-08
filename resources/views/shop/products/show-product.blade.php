@extends('master')

@section('body')
<div class="container">
    @if(session()->has('success_delete'))
        <div class="alert alert-success">
            {{ session()->get('success_delete') }}
        </div>
    @endif
    <h3>{{ $product->name }}</h3>
    <img class="img-fluid img-thumbnail" src="{{ asset('images/'. $product->picture) }}" height="200" width="200">
    <p>{{ $product->text }}</p>
    <p>{{ $product->price  }} E</p>
    @if(auth()->check())
        <form action="{{route('cart.add', $product->id) }}" method="POST">
            {{ csrf_field() }}
            <label for="quantity">Select quantity</label>
            <input type="number" id="quantity" name="quantity" value="1">
            <button type="submit">@lang('message.cart')</button>
        </form>
    @else
        <p><a href="{{route('login')}}">Prihlas sa</a> aby si nakupil !</p>
    @endif
    @if(! $rating == 0)
        <h4>
            Average rating for this product: {{number_format($rating,2)}}/5
        </h4>
    @else
        <h5>Nobody rate yet, be the first one.</h5>
    @endif
    @if( auth()->check())
        @if($rated->isEmpty())
            <div class="form-group">
                <form action="{{route('rating', $product->id)}}" method="POST">
                    {{csrf_field()}}
                    <label for="rating">Rating:</label>
                    <select name="rating" id="rating">
                        <option value="1">1 - Bad</option>
                        <option value="2">2 - Not good</option>
                        <option value="3">3 - Good</option>
                        <option value="4">4 - Very good</option>
                        <option value="5">5 - Awesome</option>
                    </select>
                    <button type="submit" class="btn btn-success">Rate</button>
                </form>
            </div>
        @else
            <p>You already rated this product</p>
            <form action="{{ route('rating.delete',$product->id)}}" method="POST">
                {{csrf_field()}}
                <button type="submit" class="btn btn-danger">Reset my rating</button>
            </form>
        @endif
    @endif
    @foreach($product->comments as $comment)
        <li class="list-group-item">
            <b>{{ $comment->user->name }} on </b>
            <b>{{ $comment->created_at }} :</b>
            {{ $comment->body }}
            @if(! auth()->check())
            @elseif($comment->user_id == auth()->user()->id)
                <form action="{{route('comment.delete',$comment->id)}}" method="POST">
                    {{csrf_field()}}
                    <button type="submit">X</button>
                </form>
            @endif
        </li>
    @endforeach
    <div class="card=block">
        <form method="POST" action="{{route('comment.create', $product->id)}}">
            {{ csrf_field() }}
            <div class="form-group">
                <textarea name="body" placeholder="Add Comment." class="form-control" required ></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Add</button>
        </form>
    </div>
</div>

@endsection
