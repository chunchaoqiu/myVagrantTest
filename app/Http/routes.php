<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

use App\Task;
use App\Post;
use Illuminate\Http\Request;


Route::group(['middleware' => ['web']], function(){
   /* Route::get('/Posts', function(){
        $mongo = DB::connection('mongodb');
        $data = $mongo->table('post')->take(1)->get();
        return $data;
    });

    Route::get('/Posts', function(){
        $mongo = DB::connection('mongodb');
        $data = $mongo->table('post')->take(1)->get();
        return $data;
    });*/

    Route::get('/test', function(){
        $mongo = DB::connection('mongodb');
        $data = $mongo->table('post')->get();
        return $data;
    });

    Route::get('/', function () {
        return view('posts', [
            'posts' => Post::all()
        ]);
    });

    /**
     * Add New post
     */
    Route::post('/post', function (Request $request) {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
        ]);

        if ($validator->fails()) {
            return redirect('/')
                ->withInput()
                ->withErrors($validator);
        }

        $post = new Post;
        $post->title = $request->name;
        $post->save();

        return redirect('/');
    });

    /**
     * Delete Post
     */
    Route::delete('/post/{title}', function ($title) {
        Post::where('title', $title)->delete();

        return redirect('/');
    });


});





//Route::group(['middleware' => ['web']], function () {
//    /**
//     * Show Task Dashboard
//     */
//    Route::get('/', function () {
//        return view('tasks', [
//            'tasks' => Task::orderBy('created_at', 'asc')->get()
//        ]);
//    });
//
//    /**
//     * Add New Task
//     */
//    Route::post('/task', function (Request $request) {
//        $validator = Validator::make($request->all(), [
//            'name' => 'required|max:255',
//        ]);
//
//        if ($validator->fails()) {
//            return redirect('/')
//                ->withInput()
//                ->withErrors($validator);
//        }
//
//        $task = new Task;
//        $task->name = $request->name;
//        $task->save();
//
//        return redirect('/');
//    });
//
//    /**
//     * Delete Task
//     */
//    Route::delete('/task/{id}', function ($id) {
//        Task::findOrFail($id)->delete();
//
//        return redirect('/');
//    });
//});
