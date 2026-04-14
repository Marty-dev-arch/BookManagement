<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use App\Models\Ideas;
use App\Models\Post;
use App\Models\User;

Route::view('/', 'welcome', [
    'greeting' => 'Hello, World!',
    'name' => 'John Doe',
    'age' => 30,
    'tasks' => [
        'Learn Laravel',
        'Build a project',
        'Deploy to production',
    ],
]);

Route::view('/about', 'about');
Route::view('/contact', 'contact');

Route::get('/formtest', function(){
    $posts = Post::all();

    return view('formtest',[
        'posts' => $posts,
    ]);
});

Route::post('/formtest', function(){
    Post::create([
        'description' => request('description'),
    ]);

    return redirect('/formtest');
});

Route::delete('/formtest/{id}', function ($id) {
    Post::findOrFail($id)->delete();

    return redirect('/formtest');
});

Route::get('/delete', function(){
    Post::truncate();  

    return redirect('/formtest');
});


//index
Route::get('/posts', function(){
    $posts = Post::all();

    return view('posts.index', [
        'posts' => $posts,
    ]);
});

//show
Route::get('/posts/{post}', function (Post $post) {
    return view('posts.show', [
        'post' => $post,
    ]);
});

//edit
Route::get('/posts/{post}/edit', function (Post $post) {
    return view('posts.edit', [
        'post' => $post,
    ]);
}
);

//update
Route::patch('/posts/{post}', function (Post $post) {
    $post->update([
        'description' => request('description'),
        'updated_at' => now(),
    ]);

    return redirect('/posts' . '/' . $post->id);
}
);

// Users CRUD
Route::get('/users', function(){
    $users = User::all();

    return view('users.index', [
        'users' => $users,
    ]);
});

Route::get('/users/create', function(){
    return view('users.create');
});

Route::post('/users', function(){
    User::create([
        'email' => request('email'),
        'first_name' => request('first_name'),
        'last_name' => request('last_name'),
        'middle_name' => request('middle_name'),
        'nickname' => request('nickname'),
        'age' => request('age'),
        'address' => request('address'),
        'contact_number' => request('contact_number'),
        'password' => request('password'),
    ]);

    return redirect('/users');
});

Route::get('/users/{user}/edit', function (User $user) {
    return view('users.edit', [
        'user' => $user,
    ]);
});

Route::patch('/users/{user}', function (User $user) {
    $user->update([
        'email' => request('email'),
        'first_name' => request('first_name'),
        'last_name' => request('last_name'),
        'middle_name' => request('middle_name'),
        'nickname' => request('nickname'),
        'age' => request('age'),
        'address' => request('address'),
        'contact_number' => request('contact_number'),
    ]);

    return redirect('/users');
});

Route::delete('/users/{user}', function (User $user) {
    $user->delete();

    return redirect('/users');
});

// Books CRUD
Route::get('/books', [App\Http\Controllers\BookController::class, 'index']);
Route::get('/books/create', [App\Http\Controllers\BookController::class, 'create']);
Route::post('/books', [App\Http\Controllers\BookController::class, 'store']);
Route::get('/books/{book}', [App\Http\Controllers\BookController::class, 'show']);
Route::get('/books/{book}/edit', [App\Http\Controllers\BookController::class, 'edit']);
Route::patch('/books/{book}', [App\Http\Controllers\BookController::class, 'update']);
Route::delete('/books/{book}', [App\Http\Controllers\BookController::class, 'destroy']);

