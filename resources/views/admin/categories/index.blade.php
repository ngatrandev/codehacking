@extends('layouts.admin')


@section('content')

<h1>Categories</h1>
<div class="col-sm-6">
        {!! Form::open( ['method'=>'POST', 'action'=> ['AdminCategoriesController@store']]) !!}
        <div class="form-group">
            {!! Form::label('name', 'Name:') !!}
            {!! Form::text('name', null, ['class'=>'form-control'])!!}
        </div>
        <div class="form-group">
                {!! Form::submit('Create category', ['class'=>'btn btn-primary col-sm-3']) !!}
        </div>
        {!!Form::close()!!}
</div>


<div class="col-sm-6">
        <table class="table">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Category</th>
                    <th>Created_at</th>
                    <th>Updated_at</th>
                </tr>
            </thead>
            <tbody>
            @if ($categories)
            @foreach ($categories as $category)

            <tr>
                    <td scope="row">{{$category->id}}</td>
                    <td><a href="{{route('admin.categories.edit', $category->id), $category->id}}">{{$category->name}}</a></td>
                    <td>{{$category->created_at->diffForHumans()}}</td>
                    <td>{{$category->updated_at->diffForHumans()}}</td>
                </tr>

            @endforeach

            @endif


            </tbody>
        </table>
</div>



@endsection
