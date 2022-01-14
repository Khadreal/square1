<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostFormRequest;
use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{
    public function index(Request $request)
    {
        $perPage = $request->per_page ?: $this->perPage;

        $user = auth()->user();
        $filter = ( new Post )->newQuery()->with('user');

        if($request->filter){
            $posts = $filter->orderBy('publication_date', $request->filter);
        }else{
            $filter->latest();
        }

        $posts = $filter->paginate( $perPage);

        return view( 'frontend.index', [ 
            'posts' => $posts,
            'title' => 'My posts'
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
    public function add(Request $request)
    {
        return view('frontend.posts.add',[
            'title' => 'Add new post'
        ]);
    }

    /**
     * Edit post
    */
    public function edit($id)
    {
        $whereArgs = [
            'author_id' => auth()->user()->id,
            'id' => $id
        ];
        $post = Post::where($whereArgs)->firstOrFail();
        $title = 'Edit '. $post->title;

        return view('frontend.posts.edit',[
            'post' => $post,
            'title' => $title
        ]);
    }

    /**
    * update post
    * @param PostFormRequest $request
    * @param $id
    */
    public function update(PostFormRequest $request, $id)
    {
        $post = Post::findOrFail($id);
        $post->title = $request->title;
        $post->content = $request->description;
        $post->status = $request->status;

        $post->save();

        return redirect()->route('my.posts')->with('success', 'post updated');
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
