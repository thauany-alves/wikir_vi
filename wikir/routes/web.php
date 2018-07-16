<?php



Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/endereco', 'EnderecoController@index')->name('endereco');
Route::post('/endereco-create', 'EnderecoController@create')->name('create.endereco');
Route::post('/endereco', 'EnderecoController@update')->name('update.endereco');

Route::get('/perfil','UserController@perfil')->name('perfil');
Route::post('/perfil','UserController@updateUser')->name('edit.perfil');
Route::post('/perfil/image','ImageUserController@update')->name('img.change');



Route::get('/posts','PostController@posts')->name('posts');

Route::get('/posts-user','PostController@postsUser')->name('posts.user');
Route::get('/posts/delete/{id}','PostController@delete')->name('del.post');

//criacao de post
Route::get('/newpost','PostController@newPost')->name('new.post');
Route::post('/newpost','PostController@postStore')->name('post.store');

//edição de post
Route::get('/post/edit/{id}','PostController@editPost')->name('postedit');
Route::post('/post/edit/{id}','PostController@editPostStore')->name('postedit.store');
