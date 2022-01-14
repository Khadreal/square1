<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;

class AdminController extends Controller
{
    public function index(Request $request)
    {
        $filter = ( new Post )->newQuery()->with('user');

        if( $request->q ) {
            $filter->where( 'title', 'like', '%' . $request->q . '%' );
        }

        if($request->filter){
            $posts = $filter->orderBy('publication_date', $request->filter);
        }else{
            $filter->latest();
        }

        $posts = $filter->paginate( $this->perPage );
        $allPost = Post::count();
        $adminPost = Post::where('author_id', 1)->count(); //This is under the assumption that we would only have one admin user.



        return view( 'admin.index', [ 
            'posts' => $posts,
            'contributorCount' => $allPost - $adminPost,
            'adminPostCount' => $adminPost,
            'allPostCount' => $allPost,
            'title' => 'Admin'
        ] );
    }

    public function users(Request $request)
    {
        $filter = ( new User )->newQuery()->with('posts');

        if( $request->q ) {
            $filter->where( 'name', 'like', '%' . $request->q . '%')
                ->orWhere('username', 'like', '%' . $request->q . '%');
        }

        $users = $filter->latest()->paginate( $this->perPage );

         return view( 'admin.users', [ 
            'users' => $users,
            'title' => 'Admin | Users'
        ] );
    }
}
