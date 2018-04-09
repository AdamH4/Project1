@extends('master')
@section('body')
<div class="container col-6">
    @if(session()->has('add_comment'))
        <div class="alert alert-success" id="flash-message">
            @lang('success.add_comment')
        </div>
    @endif
    <h3>@lang('message.about_us')</h3>
    <hr>
    <h6>@lang('message.about_welcome')</h6>
    <h6>@lang('message.about_core')</h6>
    <br>
    <h6>@lang('message.about_comments')</h6>
    <br>
    <button type="button" class="btn btn-dark" data-toggle="collapse" data-target="#comments"><i class="fas fa-arrow-circle-down"></i>  @lang('message.show_comments')</button>
    <div id="comments" class="collapse">
        <br>
        @foreach($comments as $comment)
            <div class="comments">
                <li class="list-group-item">
                    <b>{{$comment->author}} :</b>
                    {{ $comment->body }}
                </li>
            </div>
        @endforeach
        <br>
        <form method="POST" action="{{route('about.us.add.comment')}}">
            {{ csrf_field() }}
            <div class="form-group">
                <textarea name="body" placeholder="" class="form-control" required ></textarea>
            </div>
            <button type="submit" class="btn btn-dark">@lang('message.add_comment')</button>
        </form>
        <div class="pagination">
            {{$comments->links()}}
        </div>
    </div>
</div>
<script>
    setTimeout(function() {
        $('#flash-message').fadeOut(1000);
    }, 3000); // milliseconds
</script>
@endsection