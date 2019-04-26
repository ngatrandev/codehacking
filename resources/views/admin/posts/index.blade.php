@extends('layouts.admin')
use Illuminate\Support\Str;

@section('content')
<h1>Posts</h1>
<table class="table">
    <thead>
        <tr>
            <th>Id</th>
            <th>Owner</th>
            <th>Category</th>
            <th>Photo</th>
            <th>Title</th>
            <th>Body</th>
            <th>Created</th>
            <th>Updated</th>
        </tr>
    </thead>
    <tbody>
    @if($posts)

        @foreach($posts as $post)
        <tr>
            <td scope="row"><a href="{{route('admin.posts.edit', $post ->id)}}" >{{$post->id}} </a></td>
            <td>{{$post->user->name}}</td>
            <td>{{$post->category? $post->category->name: 'Uncategorized'}}</td>
            <td><img height="30" src="{{$post->photo ? asset('/images/'.$post->photo->file) : $post->photoPlaceholder()}}" alt="" ></td>
            <td>{{$post->title}}</td>
            <td>{{Str::limit($post->body,20)}}</td>
            <td>{{$post->created_at->diffForhumans()}}</td>
            <td>{{$post->updated_at->diffForhumans()}}</td>
        </tr>
       @endforeach
    @endif
    </tbody>
</table>


@stop
