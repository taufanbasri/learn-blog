<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Post;
use Carbon\Carbon;

class ExampleTest extends TestCase
{
  use DatabaseTransactions;
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testBasicTest()
    {
        // $this->assertTrue(true);

        // Given I have two records in the database thar are posts, and each one is posted a month apart.
        $first = factory(Post::class)->create();
        $second = factory(Post::class)->create([
          'created_at' => Carbon::now()->subMonth()
        ]);

        // When i fetch the archive
        $post = Post::archives();

        // Then the response should be in the proper format.
        $this->assertEquals([
          [
            "year" => $first->created_at->format('Y'),
            "month" => $first->created_at->format('F'),
            "published" => 1
          ],
          [
            "year" => $second->created_at->format('Y'),
            "month" => $second->created_at->format('F'),
            "published" => 1
          ]
        ], $post);
    }
}
