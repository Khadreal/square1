<?php

namespace App\Square1;

use App\Models\Post;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ExternalPost
{
	/**
	 * @var string
	*/
	private $endpoint = 'https://sq1-api-test.herokuapp.com/posts';
	/**
	 * Initialisation
	 *
	 * @return void
	*/
	public function init() : void
	{
		$this->getPost();
	}

	/**
	 * Get post
	 *
	 * @return mixed
	*/
	public function getPost()
	{
	    $retval = false;
		try{
			$retval = Http::get( $this->endpoint );
		} catch(ConnectionException $e){
            Log::warning( 'external endpoint timeout' );
		}

		if($retval && $retval->successful()) {
		    return $retval->object()->data;
        }

		return $retval;
	}

	/**
	 * Save external publication to posts table
	 *
	 * @return bool;
	*/
	public function savePostToDB() : bool
    {
        $posts = $this->getPost();

        if( !$posts ) {
        	return false;
        }

        foreach( $posts as $post){
            //If publication date is not today, bail early-- This means it's an old post and we already have it on our system
            if( date('y-m-d', strtotime($post->publication_date) !== date('y-m-d') ) ) {
                //continue;
            }

            //Bail early if psot already exist
            if( Post::where('title', $post->title)->first() ) {
                continue;
            }
            $data = [
                'title' => $post->title,
                'content' => $post->description,
                'publication_date' => $post->publication_date,
                'author_id' => 1 //Default admin user id is 1
            ];
            Post::create( $data );
        }

        return true;
    }
}
