@extends('master')
@section('body')
@if(session()->has('success_delete'))
    <div class="alert alert-success">
        {{ session()->get('success_delete') }}
    </div>
@endif
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
            Average rating for this product: {{number_format($rate,2)}}/5
        </h4>
    @else
        <h5>Nobody rate yet, be the first one.</h5>
    @endif

@if( auth()->check())
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
    @foreach($product->comments as $comment)
        <li class="list-group-item">
            <b>{{ $comment->user->name }} on </b>
            <b>{{ $comment->created_at }} :</b>
            {{ $comment->body }}
            <form action="{{route('admin.comment.delete',$comment->id)}}" method="POST">
                {{csrf_field()}}
                <button type="submit" class="btn btn-outline-danger">Delete</button>
            </form>
        </li>
    @endforeach

@endsection