@extends('layouts.admin')



@section('content')

<h1>Create Users</h1>

{!! Form::open(['method'=>'POST', 'action'=> 'AdminUsersController@store','files'=>true]) !!}


      <div class="form-group">
             {!! Form::label('name', 'Name:') !!}
             {!! Form::text('name', null, ['class'=>'form-control'])!!}
      </div>
      <div class="form-group">
            {!! Form::label('email', 'Email:') !!}
            {!! Form::email('email', null, ['class'=>'form-control']) !!}
      </div>
      <div class="form-group">
            {!! Form::label('role_id', 'Role:') !!}
            {!! Form::select('role_id', [''=>'Choose Options']+ $roles, null, ['class'=>'form-control']) !!}
      </div>
      <div class="form-group">
            {!! Form::label('is_active', 'Status:') !!}
            {!! Form::select('is_active', [1=>'Active', 0=>'Not active'], 1, ['class'=>'form-control']) !!}
      </div>
      <div class="form-group">
            {!! Form::label('photo_id', 'Photo:') !!}
            {!! Form::file('photo_id', null, ['class'=>'form-control']) !!}
      </div>
      <div class="form-group">
            {!! Form::label('password', 'Password:') !!}
            {!! Form::password('password', null, ['class'=>'form-control']) !!}
      </div>
      <div class="form-group">
            {!! Form::submit('Create User', ['class'=>'btn btn-primary']) !!}
      </div>

{!!Form::close()!!}

@include('includes.form_error')



@stop

<!-- HTML form builder là bên thứ 3 nhằm đơn giản hóa code trong form
trang collective đã k còn hoạt động, tham khảo cách cài HTML Form và 
các syntax ở các trang khác, vẫn chạy tốt trên Laravel 5+
Các giá trị như is_active, photo_id ... là viết theo ten của column
trong database để request có thể tương tác với database
 -->