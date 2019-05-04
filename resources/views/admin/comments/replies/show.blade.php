@extends('layouts.admin')

@section('content')

@if (count($replies)>0)
<h1>Replies</h1>
<div>
    <table class="table">
        <thead>
            <tr>
                <th>Id</th>
                <th>Author</th>
                <th>Photo</th>
                <th>Email</th>
                <th>Body</th>
                <th>Link</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($replies as $reply)
                <tr>
                    <td scope="row">{{$reply->id}}</td>
                    <td>{{$reply->author}}</td>
                    <td><img height="50" src="{{asset('/images/'.$reply->photo)}}" alt=""></td>
                    <td>{{$reply->email}}</td>
                    <td>{{Str::limit($reply->body,30)}}</td>
                    <td><a href="{{route('home.post', $post->slug)}}">View Post</a></td>
                    <td>
                        @if ($reply->is_active==1)
                        <div>
                            {!! Form::open(['method'=>'PATCH', 'action'=> ['CommentRepliesController@update', $reply->id]]) !!}
                            <input type="hidden" name="is_active" value="0">
                            <div class="form-group">
                                {!! Form::submit('Un-approve', ['class'=>'btn btn-success']) !!}
                            </div>
                            {!!Form::close()!!}
                        </div>
                        @else
                        <div>
                            {!! Form::open(['method'=>'PATCH', 'action'=> ['CommentRepliesController@update', $reply->id]]) !!}
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
                            {!! Form::open(['method'=>'DELETE', 'action'=> ['CommentRepliesController@destroy', $reply->id]]) !!}
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
<h1>No Reply</h1>

@endif





@endsection
