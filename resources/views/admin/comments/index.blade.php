@extends('layouts.admin')

@section('content')

@if (count($comments)>0)
<h1>Comments</h1>
<div>
    <table class="table">
        <thead>
            <tr>
                <th>Id</th>
                <th>Author</th>
                <th>Photo</th>
                <th>Email</th>
                <th>Body</th>
                <th>Post Link</th>
                <th>Reply Link</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($comments as $comment)
                <tr>
                    <td scope="row">{{$comment->id}}</td>
                    <td>{{$comment->author}}</td>
                    <td><img height="50" src="{{asset('/images/'.$comment->photo)}}" alt=""></td>
                    <td>{{$comment->email}}</td>
                    <td>{{Str::limit($comment->body,30)}}</td>
                <td><a href="{{route('home.post', $comment ->post->slug)}}">{{$comment->post->title}}</a></td>
                <td><a href="{{route('replies.show', $comment->id)}}">View Replies</a></td>
                    <td>
                        @if ($comment->is_active==1)
                        <div>
                            {!! Form::open(['method'=>'PATCH', 'action'=> ['PostCommentsController@update', $comment->id]]) !!}
                            <input type="hidden" name="is_active" value="0">
                            <div class="form-group">
                                {!! Form::submit('Un-approve', ['class'=>'btn btn-success']) !!}
                            </div>
                            {!!Form::close()!!}
                        </div>
                        @else
                        <div>
                            {!! Form::open(['method'=>'PATCH', 'action'=> ['PostCommentsController@update', $comment->id]]) !!}
                            <input type="hidden" name="is_active" value="1">
                            <div class="form-group">
                                {!! Form::submit('Approve', ['class'=>'btn btn-warning']) !!}
                            </div>
                            {!!Form::close()!!}
                        </div>
                        @endif
                    </td>
                    <td>
                        <div>
                            {!! Form::open(['method'=>'DELETE', 'action'=> ['PostCommentsController@destroy', $comment->id]]) !!}
                            <div class="form-group">
                                {!! Form::submit('Delete', ['class'=>'btn btn-danger']) !!}
                            </div>
                            {!!Form::close()!!}
                        </div>
                    </td>
                </tr>
            @endforeach


        </tbody>
    </table>
</div>

@else
<h1>No Comment</h1>

@endif





@endsection
