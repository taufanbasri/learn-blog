<?php

namespace App\Http\Controllers;

use App\Post;
use App\Repositories\Posts;
use Illuminate\Http\Request;
use Carbon\Carbon;

class PostController extends Controller
{
    public function __construct()
    {
      $this->middleware('auth')->except(['index', 'show']);
    }

    public function index(Posts $posts)
    {
      // ini jika menggunakan resulotion di App\Repositories\Posts
      $posts = $posts->all();


      // $posts = Post::latest();
        //
        // $posts = Post::latest()
        //   ->filter(request(['month', 'year']))
        //   ->get();

        // kode ini untuk memperbagus kodingan di pindahkan ke scope di model post menjadi scopeFilter.
        // if ($month = request('month')) {
        //   $posts->whereMonth('created_at', Carbon::parse($month)->month);
        // }
        //
        // if ($year = request('year')) {
        //   $posts->whereYear('created_at', $year);
        // }
        //
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

    public function show(Post $post)
    {
        return view('posts.show', compact('post'));
    }
}
