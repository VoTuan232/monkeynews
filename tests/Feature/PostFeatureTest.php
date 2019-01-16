<?php

namespace Tests\Feature;

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

class PostFeatureTest extends TestCase
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

    /** @test */
    
    /* Check name validate of position */
    public function valid_name()
    {
        $this->assertTrue($this->validateField('title', str_random())); //check requierd
        $this->assertTrue($this->validateField('title', str_random(255))); //check max 255
        $this->assertFalse($this->validateField('title', str_random(256))); //check max 255
        $this->assertFalse($this->validateField('title', '')); //check required
        $this->assertFalse($this->validateField('title', '')); //check required
    }

    protected function getFieldValidator($field, $value)
    {
        return $this->validator->make(
            [$field => $value], 
            [$field => $this->rules[$field]]
        );
    }

    protected function validateField($field, $value)
    {
        return $this->getFieldValidator($field, $value)->passes();
    }
   
    /* check function update */
    public function test_update_function()
    {
        // $user = factory(User::class)->create();
        // $post = factory(Post::class)->create();
        
        $data = [
            'title' => $this->faker->sentence,
            'slug' =>  $this->faker->slug,
            'body' =>  $this->faker->sentence,
            'user_id' => $this->user->id,
        ];
        $postRepo = new PostRepository();
        $update = $postRepo->update($data, $this->post->id);
        $new_post = $postRepo->find($this->post->id);
        
        $this->assertTrue($update);
        $this->assertEquals($data['title'], $new_post->title);
        $this->assertEquals($data['slug'], $new_post->slug);
        $this->assertEquals($data['body'], $new_post->body);
        $this->assertEquals($data['user_id'], $new_post->user_id);
    }

    /* check function find */
     public function test_find_function()
     {
         // $post = factory(Post::class)->create();
         $postRepo = new PostRepository();
         $found = $postRepo->find($this->post->id);
        
         $this->assertInstanceOf(Post::class, $found);
         $this->assertEquals($found->title, $this->post->title);
         $this->assertEquals($found->slug, $this->post->slug);
         $this->assertEquals($found->body, $this->post->body);
     }
    
    /* check function create */
    public function test_create_function()
    {
        // $user = factory(User::class)->create();

        //do not check validate of data
        $data = [
            'title' => $this->faker->sentence,
            'slug' =>  $this->faker->slug,
            'body' =>  $this->faker->sentence,
            'user_id' => $this->user->id,
        ];

        $postRepo = new PostRepository();
        $post = $postRepo->create($data);
      
        $this->assertInstanceOf(Post::class, $post);
        $this->assertEquals($data['title'], $post->title);
        $this->assertEquals($data['slug'], $post->slug);
        $this->assertEquals($data['body'], $post->body);
        $this->assertEquals($data['user_id'], $post->user_id);
    }

    /*check login create post*/
    // public function check_login_can_create_post() {
    //     $this->singIn();

    //     $post = make(Post::class);
    //     $response = $this->post('/manager/posts', $post->toArray());

    //     $this->get($response->headers->get('Location'))
    //     ->assertSee($post->title)
    //     ->assertSee($post->body);
    // }
     
    /*check required field*/
    // public function a_post_required_a_title() {
    //     $this->publishedPost(['title' => null])
    //     ->assertSessionHasErrors('title');
    // }

    // public function publishPost($overrides = []) {
    //     $this->singIn();
    //     $post = make(Post::class, $overrides);

    //     return $this->post('/manager/posts', $post->toArray());
    // }
}
