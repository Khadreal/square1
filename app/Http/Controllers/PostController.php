<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostFormRequest;
use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{
    public function index(Request $request)
    {
        $perPage = $request->per_page ?: 20;

        $user = auth()->user();
        $filter = ( new Post )->newQuery()/*->where( 'author_id', $user->id )*/;

        if( $request->q ) {
            $filter->where( 'title', 'like', '%' . $request->q . '%' );
        }

        $posts = $filter->latest()->paginate( $perPage );


        return view( 'frontend.index', [ 
            'posts' => $posts
        ] );
    }

    /**
     * My posts -> Returns logged-in user posts
     * 
    */
    public function myPosts()
    {
        $user = auth()->user();
        $whereArgs = [
            'author_id' => $user->id
        ];

        $posts = Post::where($whereArgs)->latest()->paginate(30);

        return view('frontend.posts.index',[
            'posts' => $posts
        ]);
    }

    /**
     * Add new post
    */
    public function add()
    {
        return view('frontend.posts.add',[
            'categories' => '',
            'title' => 'Add new post'
        ])->with( 'title', 'Add new post');
    }

    /**
     * @param PostFormRequest $request
    */
    public function store( PostFormRequest $request )
    {
        $user = auth()->user();
        $data = $request->all();
        $data['content'] = $data['description'];

        $user->posts()->create($data);

        return redirect()->route('my.posts')->with('success', 'New post created');
    }
}
