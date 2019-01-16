<?php

namespace Tests\Unit;

use App\Models\Post;
use App\Models\User;
use App\Repositories\PostRepository;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Validator;
use App\Http\Requests\PostRequest;
use Illuminate\Foundation\Http\FormRequest;
use DB;
use Illuminate\Support\Facades\Schema;

class PostTest extends TestCase
{
    use WithFaker;
    // use RefreshDatabase;

    protected $user;
    protected $post;

    public function setUp()
    {
        parent::setUp();

        $this->user = factory(User::class)->create();
        $this->post = factory(Post::class)->create();

        $this->rules = (new PostRequest())->rulesTest();
        $this->validator = $this->app['validator'];
    }

    

    /*Test relationship*/
    public function test_relationship_with_user() {
        $this->assertInstanceOf('App\Models\User', $this->post->user);
        $this->assertEquals($this->post->user_id, $this->post->user->id);
    }

    public function test_relationship_with_category() {
        // $this->assertEquals('Illuminate\Database\Eloquent\Relations\BelongsTo', get_class($this->post->categories));
        $this->assertEquals('Illuminate\Database\Eloquent\Collection', get_class($this->post->categories));
        // $this->assertInstanceOf('App\Models\Category', $this->post->categories->rand());
    }

    public function test_relationship_with_tag() {
        $this->assertEquals('Illuminate\Database\Eloquent\Collection', get_class($this->post->tags));
    }

    /*Test field exist*/
    public function test_field_exist() {
        $this->assertTrue(Schema::hasColumn('posts', 'slug'));
        $this->assertTrue(Schema::hasColumn('posts', 'title'));
        $this->assertTrue(Schema::hasColumn('posts', 'id'));
        $this->assertTrue(Schema::hasColumn('posts', 'body'));
        $this->assertTrue(Schema::hasColumn('posts', 'user_id'));
        $this->assertFalse(Schema::hasColumn('posts', 'name'));
    }
}
