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
    @foreach($comments as $comment)
        <div class="comments">
            <li class="list-group-item">
                <b>{{$comment->author}}</b>
                <b>{{$comment->created_at}}</b>
                {{ $comment->body }}
                <form id="comment-delete" action="{{route('admin.about.us.delete.comment',$comment->id)}}" method="POST">
                    {{csrf_field()}}
                    <button type="submit" class="btn btn-dark"><i class="far fa-trash-alt"></i></button>
                </form>

            </li>
        </div>
    @endforeach
    @if(auth()->check())
        <form method="POST" action="{{route('about.us.add.comment')}}">
            {{ csrf_field() }}
            <div class="form-group">
                <textarea name="body" placeholder="Add Comment." class="form-control" required ></textarea>
            </div>
            <button type="submit" class="btn btn-dark">@lang('message.add_comment')</button>
        </form>
    @endif
</div>
@endsection