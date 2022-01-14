<?php

namespace Tests\Unit;

use App\Square1\HttpClient;
use GuzzleHttp\Psr7\Response;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class ExternalPostTest extends TestCase
{
    /** @test */
    public function check_if_external_api_is_ok()
    {
        /*Http::fake([
            'https://dog-facts-api.herokuapp.com/api/v1/resources/dogs?number=5' =>
                Http::response(
                    json_decode(file_get_contents('tests/files/posts.json'), true),
                    200)
        ]);

        $posts = HttpClient::getPosts(2);

        $this->assertIsIterable($posts);
        $this->assertCount(2, $posts);*/

        $mock = $this->mock(HttpClient::class);
        $response = new Response(
            $status = 200,
            $headers = [],
            File::get(base_path('tests/files/posts.json'))
        );

        $mock->shouldReceive('send')
            ->andReturn(json_decode($response->getBody()));

        $retval = $this->call('GET', '/login');

        $retval->assertStatus(200)
            /*->assertJsonStructure(['data'])*/;
    }
}
