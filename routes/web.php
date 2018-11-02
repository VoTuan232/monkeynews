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
// use App\Models\Post;
// Route::get('/test/{id}', 'HomeController@getAllPostsBaseCategory');

// Route::get('/welcome', function () {
//     return view('welcome');
// });

Route::get('/test', function() {
    return view('test.index');
});
Route::get('/', 'HomeController@index')->name('pages.index');

Auth::routes();
Route::get('logout','Auth\LoginController@logout');

Route::get('/home', 'HomeController@index')->name('home');



Route::group(['middleware' => ['auth', 'admin']], function(){
    // Route::get('test', 'admin\PostController@test');
    // Route::post('/{slug-category}/{slug}', 'HomeController@single')->name('home.single');
    Route::post('manager/categories/destroy', 'admin\CategoryController@destroy')->name('categories.destroy');
    Route::post('manager/categories/update', 'admin\CategoryController@update')->name('categories.update');
    Route::get('manager/categories/edit', 'admin\CategoryController@edit')->name('categories.edit');
    Route::post('manager/categories/search', 'admin\CategoryController@search')->name('categories.search');
    Route::get('manager/categories/test', 'admin\CategoryController@test');
    Route::post('manager/categories/store', 'admin\CategoryController@store')->name('categories.store');
    Route::get('manager/categories', 'admin\CategoryController@index')->name('categories.index');
    Route::post('manager/tags/update', 'admin\TagController@update')->name('tags.update');
    Route::post('manager/tags/destroy', 'admin\TagController@destroy')->name('tags.destroy');
    Route::get('manager/tags/edit', 'admin\TagController@edit')->name('tags.edit');
    Route::post('manager/tags', 'admin\TagController@store')->name('tags.store');
    Route::get('manager/tags', 'admin\TagController@index')->name('tags.index');

    // Route::post('manager/posts/update/', 'admin\PostController@update')->name('posts.update');
    Route::get('manager/posts/edit/{id}', 'admin\PostController@edit')->name('posts.edit');
    Route::get('manager/posts/edit','admin\PostController@edit');
	Route::post('manager/posts/destroy', 'admin\PostController@destroy');
	Route::get('manager/posts/read-data', 'admin\PostController@readData');
    Route::resource('admin', 'admin\AdminController');
    Route::get('manager/posts', 'admin\PostController@index')->name('posts.index');

    Route::post('manager/posts', 'admin\PublishController@closeRequest')->name('posts.draft.close');
    // Route::post('manager/posts/store', 'admin\PostController@store')->name('posts.store')->middleware('can:post.create');

	Route::post('manager/ajax/getCategoriesChildren', 'admin\PostController@getCategoriesChildren');

    Route::get('manager/users', 'admin\UserController@index')->name('users.index');
    Route::post('manager/users/store', 'admin\UserController@store')->name('users.store');
    Route::get('manager/users/edit', 'admin\UserController@edit')->name('users.edit');
    Route::post('manager/users/update', 'admin\UserController@update')->name('users.update');

    Route::get('manager/roles', 'admin\RoleController@index')->name('roles.index');
    Route::post('manager/roles/update', 'admin\RoleController@update')->name('roles.update');

    Route::get('manager/ajax/getPermissions', 'admin\RoleController@getPermissions')->name('roles.getPermissions');

    Route::get('manager/comments', 'admin\CommentController@index')->name('comments.index');

    Route::get('manager/publish', 'admin\RequestController@index')->name('publish.index');
    Route::post('manager/publish/close/{id}', 'admin\RequestController@closeRequest')->name('posts.draft.close');
    Route::post('manager/publish/accept/{id}', 'admin\RequestController@accept')->name('posts.draft.accept');

    Route::post('manager/comments/destroyComment', 'admin\CommentController@destroyComment')->name('comments.destroy');


});

    Route::post('/post/comment/store', 'CommentController@store')->name('comment.add');
    Route::group(['middleware' => 'auth'], function() {
        Route::get('storage/posts', 'StorageController@getPost')->name('storages.posts.index');
    });

    Route::get('storages/posts/save', 'StorageController@savePost')->name('storages.posts.save'); 
    Route::get('storages/posts/remove', 'StorageController@removePost')->name('storages.posts.remove'); 

    Route::post('manager/posts/store', 'admin\PostController@store')->name('posts.store');

    Route::get('draft/posts', 'DraftController@index')->name('draft.posts.index');
    Route::post('draft/posts/store/{id}', 'DraftController@store')->name('draft.posts.store');
    Route::post('draft/posts/close/{id}', 'DraftController@close')->name('draft.posts.destroy');
    Route::get('draft/posts/edit/{id}', 'DraftController@edit')->name('draft.posts.edit');
    Route::get('draft/posts/single/{id}', 'DraftController@getSingle')->name('draft.posts.single');
    Route::post('manager/posts/update/', 'admin\PostController@update')->name('posts.update');
    
    Route::get('state/posts/like', 'StatePostController@likePost')->name('state.posts.like'); 
    Route::get('state/posts/removeLike', 'StatePostController@removeLikePost')->name('state.posts.removeLike'); 
    Route::get('state/posts/dislike', 'StatePostController@dislikePost')->name('state.posts.dislike'); 
    Route::get('state/posts/removeDislike', 'StatePostController@removeDislikePost')->name('state.posts.removeDislike');

    Route::get('/search', 'HomeController@getSearch')->name('home.getSearch'); 
    // Route::post('/search', 'HomeController@postSearch')->name('home.postSearch'); 
    // Route::get('/search/{text}', 'HomeController@getSearch')->name('home.getSearch'); 
    // Route::get('/search/{text}', 'HomeController@search')->name('home.search'); 

    Route::get('/tags/{id}', 'HomeController@getPostsBaseTag')->name('home.tags.posts');

    Route::get('/{id}/{slug}', 'HomeController@getPosts')->name('home.posts');
    Route::get('/{slug}', 'HomeController@getSingle')->name('home.single');
    // Route::get('/{category}/{slug}', 'HomeController@getSingle')->name('home.single');

