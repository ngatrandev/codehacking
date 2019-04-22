<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Role;
use App\Photo;
use App\Http\Requests\UsersRequest;
use App\Http\Requests\UsersEditRequest;
use Illuminate\Support\Facades\Session;
class AdminUsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $users = User::all();

        return view('admin.users.index', compact('users'));//dấu . như là đường dẫn
        //compact để biến users dùng cho file blade.php
        // lưu ý bỏ $
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $roles = Role::pluck('name', 'id')-> all();
        //laravel 5.8 bỏ list thay bằng pluck method

        return view('admin.users.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UsersRequest $request)
    {
        $input =$request->all();

        if($file = $request->file('photo_id')) {
            $name = date("y-m-d",time()). $file->getClientOriginalName();

            $file ->move('images', $name);
            $photo = Photo::create(['file'=>$name]);

            $input['photo_id']= $photo -> id;

        }
        $input['password']= bcrypt($request->password);
        User::create($input);

        return redirect("/admin/users");
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        return view('admin.users.show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $user = User::findOrFail($id);
        $roles = Role::pluck('name', 'id')-> all();
        return view('admin.users.edit', compact('user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UsersEditRequest $request, $id)
    {
        $pass = $request->password;
        $input = $request -> all();
        if(trim($pass)=="") {
            $input = $request -> except('password');//bỏ pass khỏi req

        } else {
            $input['password'] = \bcrypt($request->password);
        }
        
        /*
        Đoạn code trên để test có cần update cả pass hay k?
        */

        
        $user = User::findOrFail($id);
    
        if ($file = $request -> file('photo_id')) {
            $name = date('y-m-d', time()) . $file -> getClientOriginalName();
            $file -> move('images', $name);
            $photo = Photo::create(['file'=> $name] );
            $input['photo_id'] = $photo -> id;
        }

       
        $user -> update($input);
        return \redirect ('/admin/users');
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
       $user =  User::findOrFail($id);
       unlink(\public_path().'/images/'. $user->photo->file);
       $user->delete();
        Session::flash('deleted_user', 'The user has been deleted');
        //để thông báo khi user bị xóa
        return \redirect('/admin/users');
    }
}
