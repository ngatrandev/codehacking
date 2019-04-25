@extends('layouts.admin')


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
            <td scope="row">{{$post->id}}</td>
            <td>{{$post->user->name}}</td>
            <td>{{$post->category? $post->category->name: 'Uncategorized'}}</td>
            <td>{{$post->photo? $post->photo->file:"no photo"}}</td>
            <td>{{$post->title}}</td>
            <td>{{$post->body}}</td>
            <td>{{$post->created_at->diffForhumans()}}</td>
            <td>{{$post->updated_at->diffForhumans()}}</td>
        </tr>
       @endforeach
    @endif
    </tbody>
</table>


@stop
