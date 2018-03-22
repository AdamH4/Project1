@extends('master')
@section('body')
<div class="container">
    @if(session()->has('success_delete'))
        <div class="alert alert-success" id="flash-message">
            @lang('success.delete_rating')
        </div>
    @endif
    @if(session()->has('add_cart'))
        <div class="alert alert-success" id="flash-message">
            @lang('success.add_cart')
        </div>
    @endif
    @if(session()->has('success_rate'))
        <div class="alert alert-success" id="flash-message">
            @lang('success.create_rating')
        </div>
    @endif
    @if(session()->has('add_comment'))
        <div class="alert alert-success" id="flash-message">
            @lang('success.add_comment')
        </div>
    @endif
    @if(session()->has('delete_comment'))
        <div class="alert alert-success" id="flash-message">
            @lang('success.delete_comment')
        </div>
    @endif
    <ul class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('products')}}" id="purple-tag">@lang('navigation.products')</a></li>
        <li class="breadcrumb-item active">{{ucfirst($product->name)}}</li>
    </ul>
    <hr>
    <img id="product-image" class="img-fluid img-thumbnail" src="{{ asset('images/'. $product->picture) }}" height="400" width="400">
    <div class="select-payment col-7">
    <h3>{{ ucfirst($product->name) }}</h3>
    <p>@lang('message.category'){{$product->category}}</p>
    <p>@lang('message.product_price'){{ $product->price }} €</p>
    <p>{{ $product->text }}</p>
    <h5>@lang('message.description'):</h5>
    <p>{{$product->description}}</p>
    <br>
    <br>
    @if(auth()->check())
        <form action="{{route('cart.add', $product->id) }}" method="POST">
            {{ csrf_field() }}
            <label for="quantity" class="add-text" id="quantity">@lang('message.select_quantity'): </label>
            <input type="number" id="quantity" name="quantity" value="1" class="form-control col-1 add-button">
            <button type="submit" id="add-button" class="btn btn-dark"><i class="fas fa-cart-plus"></i></button>
        </form>
    @else
        <p><a href="{{route('login')}}">@lang('message.product_sign_in')</a>@lang('message.product_sign_in_for_payment')</p>
    @endif
    @if(! $rating == 0)
        <h4>
            @lang('message.average_rating'){{number_format($rating,2)/0.04 }}%
        </h4>
    @else
        <h5>@lang('message.nobody_rated')</h5>
    @endif
    @if( auth()->check())
        @if($rated->isEmpty())
            <div class="star-box">
                <a href="{{route('rating',['id'=>$product->id,'rating'=>'4'])}}" id="star1" class="fas fa-star"></a>
                <a href="{{route('rating',['id'=>$product->id,'rating'=>'3'])}}" id="star2" class="fas fa-star"></a>
                <a href="{{route('rating',['id'=>$product->id,'rating'=>'2'])}}" id="star3" class="fas fa-star"></a>
                <a href="{{route('rating',['id'=>$product->id,'rating'=>'1'])}}" id="star4" class="fas fa-star"></a>
                <a href="{{route('rating',['id'=>$product->id,'rating'=>'0'])}}" id="star5" class="fas fa-star"></a>
            </div>
            <br>
        @else
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
                <b>{{ $comment->user->name }}, </b>
                <b>{{ $comment->created_at->toFormattedDateString() }} :</b>
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
    @if(auth()->check())
        <form method="POST" action="{{route('comment.create', $product->id)}}">
            {{ csrf_field() }}
            <div class="form-group">
                <textarea name="body" placeholder="Add Comment." class="form-control" required ></textarea>
            </div>
            <button type="submit" class="btn btn-dark">@lang('message.add_comment')</button>
        </form>
    </div>
    @endif
</div>
<script>
    setTimeout(function() {
        $('#flash-message').fadeOut(1000);
    }, 3000); // <-- time in milliseconds
</script>
@endsection
