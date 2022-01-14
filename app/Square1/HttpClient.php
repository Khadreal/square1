<?php

namespace App\Square1;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;

/**
 * Http client act as faker for external api call
 */
class HttpClient
{
    public function get()
    {
        return Http::get('https://sq1-api-test.herokuapp.com/posts');
    }

    public static function getPosts(int $number) : Collection
    {
        return Collection::make();
    }
}
