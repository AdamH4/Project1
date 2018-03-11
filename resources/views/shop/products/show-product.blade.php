@extends('master')

@section('body')
<div class="container">
    @if(session()->has('success_delete'))
        <div class="alert alert-success">
            {{ session()->get('success_delete') }}
        </div>
    @endif
    <ul class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('products')}}">@lang('navigation.products')</a></li>
        <li class="breadcrumb-item active">{{ucfirst($product->name)}}</li>
    </ul>
    <img id="product-image" class="img-fluid img-thumbnail" src="{{ asset('images/'. $product->picture) }}" height="300" width="300">
    <h3>{{ ucfirst($product->name) }}</h3>
    <p>{{ $product->text }}</p>
    <p>{{ $product->price }} €</p>
    @if(auth()->check())
        <form action="{{route('cart.add', $product->id) }}" method="POST">
            {{ csrf_field() }}
            <label for="quantity" id="quantity">@lang('message.select_quantity'): </label>
            <input type="number" id="quantity" name="quantity" value="1" class="form-control col-1">
            <button type="submit" class="btn btn-dark">@lang('message.cart')</button>
        </form>
    @else
        <p><a href="{{route('login')}}">@lang('message.product_sign_in') </a>@lang('message.product_sign_in_for_payment')</p>
    @endif
    @if(! $rating == 0)
        <h4>
            @lang('message.average_rating'){{number_format($rating,2)/0.05 }}%
        </h4>
    @else
        <h5>@lang('message.nobody_rated')</h5>
    @endif
    @if( auth()->check())
        @if($rated->isEmpty())
            <form>
                <div class="star-box">
                    <a class="fas fa-star"></a>
                    <a href="{{route('rating',$product->id)}}" name="2" id="star2" class="fas fa-star"></a>
                    <a href="{{route('rating',$product->id)}}" name="3" id="star3" class="fas fa-star"></a>
                    <a href="{{route('rating',$product->id)}}" name="4" id="star4" class="fas fa-star"></a>
                    <a href="{{route('rating',$product->id)}}" name="5" id="star5" class="fas fa-star"></a>
                </div>
            </form>
        @else
            <p>@lang('message.already_rated')</p>
            <form action="{{ route('rating.delete',$product->id)}}" method="POST">
                {{csrf_field()}}
                <button type="submit" class="btn btn-dark">@lang('message.reset_rating')</button>
            </form>
        @endif
    @endif
    <h4>@lang('message.comments')</h4>
    <hr>
    @foreach($product->comments as $comment)
        <div class="comments">
            <li class="list-group-item">
                <b>{{ $comment->user->name }} on </b>
                <b>{{ $comment->created_at }} :</b>
                {{ $comment->body }}
                @if(! auth()->check())
                @elseif($comment->user_id == auth()->user()->id)
                    <form id="comment-delete" action="{{route('comment.delete',$comment->id)}}" method="POST">
                        {{csrf_field()}}
                        <button type="submit" class="btn btn-dark"><i class="far fa-trash-alt"></i></button>
                    </form>
                @endif
            </li>
        </div>
    @endforeach
    <div class="card=block">
        <form method="POST" action="{{route('comment.create', $product->id)}}">
            {{ csrf_field() }}
            <div class="form-group">
                <textarea name="body" placeholder="Add Comment." class="form-control" required ></textarea>
            </div>
            <button type="submit" class="btn btn-dark">@lang('message.add_comment')</button>
        </form>
    </div>
</div>

@endsection
