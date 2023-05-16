<?php

namespace Tests\Feature;

use App\Models\Post;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PostControllerTest extends TestCase
{

    public function it_shows_list_of_posts(): void
    {
        // Post::factory()->count(15)->create();

        // $posts = Post::all();

        // $this->assertEquals(15, $posts->count());
    }
}
