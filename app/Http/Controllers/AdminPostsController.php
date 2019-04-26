<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Photo;
use App\Category;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\PostsCreateRequest;
class AdminPostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $posts = Post::all();
        return view('admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $categories = Category::pluck('name', 'id')->all();

        return view('admin.posts.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostsCreateRequest $request)
    {
        //
        $user=Auth::user();
        $input=$request->all();
        if($file=$request->file('photo_id')) {
            $name=date('y-m-d', time()).$file->getClientOriginalName();

            $file -> move('images',$name);

            $photo = Photo::create(['file'=>$name]);

            $input['photo_id']=$photo->id;


        }
        $user->post()->create($input);
        /*
        Không viết Post::create($input) vì post không lấy được user_id
        Phải viết qua relationship (post())
        Mối liên hệ create()-store() ; edit()-update()
        Ở create() submit sẽ send req vào store()
        Ở edit() submit sẽ send req vào update()
        */

        return \redirect('/admin/posts');
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
        $post = Post::findOrFail($id);
        $categories=Category::pluck('name', 'id')->all();
        return view('admin.posts.edit', compact('post', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $input = $request -> all();
        if($file=$request->file('photo_id')) {
            $name=date('y-m-d', time()).$file->getClientOriginalName();

            $file -> move('images',$name);

            $photo = Photo::create(['file'=>$name]);

            $input['photo_id']=$photo->id;


        }

        Auth::user()->post()->whereId($id)->first()->update($input);

        return \redirect('/admin/posts');

         /*
        Không viết Post::update($input) vì post qua user_id
        Viết Auth::user để user chỉ được quyền edit bài post của mình

        */
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
        $post = Auth::user()->post()->whereId($id)->first();

        unlink(\public_path() . '/images/' . $post->photo->file);//xóa file ảnh trong public folder
        $post->photo->delete();//xóa photo trong database

        $post->delete();//xóa post trong database

        return \redirect('/admin/posts');
    }
}
