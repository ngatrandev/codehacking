@extends('layouts.admin')


@section('content')
<h1>Media</h1>
<form action="{{route('admin.delete.media')}}" method="post" class="form-inline">
    {{csrf_field()}}
    {{method_field('DELETE')}} <!--phải tạo method DELETE ẩn-->
    <div class="form-group">
        <select name="checkBoxArray" id="" class="form-control">
            <option value="delete">Delete</option>
        </select>
    </div>
    <div class="form-group">
        <input type="submit" name="delete_all" class="btn btn-danger" value="DELETE">
    </div>
    <div>
        <table class="table">
            <thead>
                <tr>
                    <th><input type="checkbox" name="" id="options"></th>
                    <th>Id</th>
                    <th>Picture</th>
                    <th>Created_at</th>

                </tr>
            </thead>
            <tbody>
                @foreach ($photos as $photo)
                    <tr>
                        <td><input class="checkBoxes" type="checkbox" name="checkBoxArray[]" value="{{$photo->id}}"></td>
                        <td scope="row">{{$photo->id}}</td>
                        <td><img height="50" src="{{$photo->file? asset("/images/".$photo->file) : 'http://placehold.it/400x400'}}" alt=""></td>
                        <td>{{$photo->created_at->diffForhumans()}}</td>
                    </tr>
                @endforeach

            </tbody>
        </table>
    </div>
</form>

@endsection
@section('scripts')
    <script>
    $(document).ready(function(){
        $('#options').click(function(){
            if(this.checked) {
                $('.checkBoxes').each(function(){
                    this.checked = true;
                })
            } else {
                $('.checkBoxes').each(function(){
                    this.checked = false;
                })
            }
        })
    })
    </script>
@endsection
