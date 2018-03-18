@extends('master')
@section('body')
<div class="container">
    @if(session()->has('success_delete'))
        <div class="alert alert-success">
            {{ session()->get('success_delete') }}
        </div>
    @endif
        <form action="{{route('admin.products')}}" method="GET">
            <button class="btn btn-dark"><i class="fas fa-arrow-alt-circle-left"></i></button>
        </form>
        <h3>{{ ucfirst($product->name) }}</h3>
        <img src="{{ asset('images/'. $product->picture) }}" height="200" width="200">
        <p>{{ $product->text }}</p>
        <p>{{ $product->price  }} E</p>

        @if(! auth()->check())
            <p>Prihlas sa aby si nakupil !</p>
        @endif
        @foreach($product->ratings as $rating)
            <li>
                {{$rating->user->name}} rated:
                {{$rating->rating}}
            </li>
        @endforeach

        @if(! $rate == 0)
            <h4>
                @lang('message.average_rating'){{number_format($rate,2)/0.04 }}%
            </h4>
        @else
            <h5>0 Ratings.</h5>
        @endif
        <div class="star-box">
            <a href="{{route('rating',['id'=>$product->id,'rating'=>'4'])}}" id="star1" class="fas fa-star"></a>
            <a href="{{route('rating',['id'=>$product->id,'rating'=>'3'])}}" id="star2" class="fas fa-star"></a>
            <a href="{{route('rating',['id'=>$product->id,'rating'=>'2'])}}" id="star3" class="fas fa-star"></a>
            <a href="{{route('rating',['id'=>$product->id,'rating'=>'1'])}}" id="star4" class="fas fa-star"></a>
            <a href="{{route('rating',['id'=>$product->id,'rating'=>'0'])}}" id="star5" class="fas fa-star"></a>
        </div>
        <br>
        @foreach($product->comments as $comment)
            <li class="list-group-item">
                <b>{{ $comment->user->name }} on </b>
                <b>{{ $comment->created_at }} :</b>
                {{ $comment->body }}
                <form id="comment-delete" action="{{route('admin.comment.delete',$comment->id)}}" method="POST">
                    {{csrf_field()}}
                    <button type="submit" class="btn btn-dark"><i class="far fa-trash-alt"></i></button>
                </form>
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