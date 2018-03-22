@extends('master')
@section('body')
<div class="container col-8">
    @if(session()->has('add_comment'))
        <div class="alert alert-success" id="flash-message">
            {{session()->get('add_comment')}}
        </div>
    @endif
    <h3>O nas</h3>
    <hr>
    <h6>Sme internetovy obchod ktory nema kamennu predajnu, ponukane produkty su len ilustracne a cela tato stranka je len pre studijne ucely</h6>
    <br>
    <br>
    @foreach($comments as $comment)
        <div class="comments">
            <li class="list-group-item">
                <b>{{$comment->author}}</b>
                <b>{{$comment->created_at}}</b>
                {{ $comment->body }}
            </li>
        </div>
    @endforeach
    <form method="POST" action="{{route('about.us.add.comment')}}">
        {{ csrf_field() }}
        <div class="form-group">
            <textarea name="body" placeholder="Add Comment." class="form-control" required ></textarea>
        </div>
        <button type="submit" class="btn btn-dark">@lang('message.add_comment')</button>
    </form>
</div>
<script>
    setTimeout(function() {
        $('#flash-message').fadeOut(1000);
    }, 4000); // <-- time in milliseconds
</script>
@endsection