@extends('layouts.admin')


@section('content')
<h1>Media</h1>
<div>
    <table class="table">
        <thead>
            <tr>
                <th>Id</th>
                <th>Picture</th>
                <th>Created_at</th>
                <th>Delete_pic</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($photos as $photo)
                <tr>
                    <td scope="row">{{$photo->id}}</td>
                    <td><img height="50" src="{{$photo->file? asset("/images/".$photo->file) : 'http://placehold.it/400x400'}}" alt=""></td>
                    <td>{{$photo->created_at->diffForhumans()}}</td>
                    <td>
                            {!! Form::open( ['method'=>'DELETE', 'action'=> ['AdminMediaController@destroy', $photo->id]]) !!}
                            <div class="form-group">
                                    {!! Form::submit('Delete', ['class'=>'btn btn-danger col-sm-3']) !!}
                            </div>
                            {!!Form::close()!!}

                    </td>
                </tr>
            @endforeach

        </tbody>
    </table>
</div>


@endsection
