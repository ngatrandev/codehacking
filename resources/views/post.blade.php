@extends('layouts.blog-post')


@section('content')

  <!-- Blog Post -->

                <!-- Title -->
                <h1>{{$post->title}}</h1>

                <!-- Author -->
                <p class="lead">
                    by <a href="#">{{$post->user->name}}</a>
                </p>

                <hr>

                <!-- Date/Time -->
                <p><span class="glyphicon glyphicon-time"></span>{{$post->created_at->diffForHumans()}}</p>

                <hr>

                <!-- Preview Image -->
                <img class="img-responsive" src="{{asset('/images/'.$post->photo->file)}}" alt="">

                <hr>

                <!-- Post Content -->
                {{$post->body}}

                <hr>
                @if (Session::has('comment_message'))
                {{session('comment_message')}}

                @endif
                <!-- Blog Comments -->

                <!-- Comments Form -->
                @if (Auth::check())
                <!-- Dùng để check user có đăng nhập mới hiện form comment-->
                <div class="well">
                        <h4>Leave a Comment:</h4>

                        {!! Form::open(['method'=>'POST', 'action'=> 'PostCommentsController@store']) !!}
                            <input type="hidden" name="post_id" value="{{$post->id}}">
                            <div class="form-group">
                                {!! Form::label('body', 'Body:') !!}
                                {!! Form::textarea('body', null, ['class'=>'form-control', "rows"=>3])!!}
                            </div>
                            <div class="form-group">
                            {!! Form::submit('Post comment', ['class'=>'btn btn-primary col-sm-3']) !!}
                            </div>
                        {!!Form::close()!!}

                    </div>
                @endif


                <hr>

                <!-- Posted Comments -->

                <!-- Comment -->
                    @if (count($comments)>0)
                    @foreach ($comments ->reverse() as $comment)
                        <div class="media">
                            <a class="pull-left" href="#">
                            <img class="media-object" height="64" width="74" src="{{asset('/images/'.$comment->photo)}}" alt="">
                            </a>
                            <div class="media-body">
                                <h4 class="media-heading">{{$comment->author}}
                                <small>{{$comment->created_at->diffForHumans()}}</small>
                                </h4>
                                <p>{{$comment->body}}</p>
                                <div class="comment-reply-container">
                                        <button class="toggle-reply btn btn-primary pull-right">Reply</button>
                                        <div class="comment-reply">
                                        {!! Form::open(['method'=>'POST', 'action'=> 'CommentRepliesController@createReply']) !!}
                                        <div class="form-group">
                                        <input type="hidden" name="comment_id" value="{{$comment->id}}">
                                        {!! Form::label('body', 'Reply:') !!}
                                        {!! Form::textarea('body', null, ['class'=>'form-control', "rows"=>1])!!}
                                        </div>
                                        <div class="form-group">
                                        {!! Form::submit('Post', ['class'=>'btn btn-primary']) !!}
                                        </div>
                                        {!!Form::close()!!}
                                        </div>
                                  </div>
                                @if(count($comment->replies)>0)
                                    @foreach($comment->replies->reverse() as $reply)
                                        @if($reply->is_active==1)
                                        <div id="nested-comment" class="media">
                                            <a class="pull-left" href="#">
                                                <img class="media-object" height="40" src="{{asset('/images/'.$reply->photo)}}" alt="">
                                            </a>
                                            <div class="media-body">
                                                <h4 class="media-heading">{{$reply->author}}
                                                <small>{{$reply->created_at->diffForHumans()}}</small>
                                                </h4>
                                                <p>{{$reply->body}}</p>
                                            </div>


                                        </div>
                                        @endif
                                     @endforeach
                                @endif
                            </div>
                        </div>

                    @endforeach
                    @endif


<h1>POST</h1>
@endsection

@section('scripts')
<script>
    $(".comment-reply-container .toggle-reply").click(function(){

        $(this).next().slideToggle("slow");

    });

</script>
@endsection
