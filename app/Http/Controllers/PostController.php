<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;
use Carbon\Carbon;

class PostController extends Controller
{
    public function __construct()
    {
      $this->middleware('auth')->except(['index', 'show']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      // $posts = Post::latest();

        $posts = Post::latest()
          ->filter(request(['month', 'year']))
          ->get();

        // kode ini untuk memperbagus kodingan di pindahkan ke scope di model post menjadi scopeFilter.
        // if ($month = request('month')) {
        //   $posts->whereMonth('created_at', Carbon::parse($month)->month);
        // }
        //
        // if ($year = request('year')) {
        //   $posts->whereYear('created_at', $year);
        // }

        // $posts = $posts->get();

        // cara ini menggunakan dedicated method archives yang ada di model. sehingga kode lebih bersih
        // $archives = Post::archives();

        // ini jika tidak menggunakan dedicated method
        // $archives = Post::selectRaw('year(created_at) year, monthname(created_at) month, count(*) published')
        // ->groupBy('year', 'month')
        // ->orderByRaw('min(created_at) desc')
        // ->get()
        // ->toArray();

        // return $archives;

        return view('posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
      $this->validate(request(), [
        'title' => 'required',
        'body' => 'required',
      ]);
//        Cara 1
//        $post = new Post;
//
//        $post->title = request('title');
//        $post->body = request('body');
//
//        $post->save();

//        cara 2
//        Post::create([
//            'title' => request('title'),
//          'body' => request('body'),
//        ]);

//        cara 3, recomend
        // Post::create([
        //   'title' => request('title'),
        //   'body' => request('body'),
        //   'user_id' => auth()->id(),
        // ]);

        // kode dibawah save terletak di model Post
        auth()->user()->publish(
          new Post(request(['title', 'body']))
        );

        return redirect('/');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        //
    }
}
