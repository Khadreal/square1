<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{
    public function index( Request $request )
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
}
