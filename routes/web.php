<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/post/{id}', 'AdminPostsController@post')->name('home.post');

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => 'admin'], function(){

        Route::get('/admin', function(){
            return view('admin.index');
        });

        Route::resource('/admin/users', 'AdminUsersController', ['names'=>[


            'index'=>'admin.users.index',
            'create'=>'admin.users.create',
            'store'=>'admin.users.store',
            'edit'=>'admin.users.edit'
        ]]);

        Route::resource('/admin/posts', 'AdminPostsController', ['names'=>[


            'index'=>'admin.posts.index',
            'create'=>'admin.posts.create',
            'store'=>'admin.posts.store',
            'edit'=>'admin.posts.edit'
        ]]);

        Route::resource('/admin/categories', 'AdminCategoriesController', ['names'=>[


            'index'=>'admin.categories.index',
            'create'=>'admin.categories.create',
            'store'=>'admin.categories.store',
            'edit'=>'admin.categories.edit'
        ]]);

        Route::resource('/admin/media', 'AdminMediaController', ['names'=>[


            'index'=>'admin.media.index',
            'create'=>'admin.media.create',
            'store'=>'admin.media.store',
            'edit'=>'admin.media.edit'
        ]]);

        Route::resource('/admin/comments', 'PostCommentsController', ['names'=>[


            'index'=>'admin.comments.index',
            'create'=>'admin.comments.create',
            'store'=>'admin.comments.store',
            'edit'=>'admin.comments.edit'
        ]]);

        Route::resource('/admin/comment/replies', 'CommentRepliesController', ['names'=>[


            'index'=>'admin.comment.replies.index',
            'create'=>'admin.comment.replies.create',
            'store'=>'admin.comment.replies.store',
            'edit'=>'admin.comment.replies.edit'
        ]]);
});



Route::group(['middleware' => ['auth']], function () {
    Route::post('comment/reply', 'CommentRepliesController@createReply');

});
// middleware auth yêu cầu user phải login
