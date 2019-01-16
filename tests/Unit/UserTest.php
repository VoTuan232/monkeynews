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

class UserTest extends TestCase
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
        // $this->rules = (new UserRequest())->rulesTest();
        // $this->validator = $this->app['validator'];
    }
}
