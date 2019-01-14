<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Auth;
use App\Http\Resources\Post as PostResource;

class User extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    // public function toArray($request)
    // {
    //     return [
    //         'id' => $this->id,
    //         'name' => $this->name,
    //         'email' => $this->email,
    //         'created_at' => $this->created_at,
    //         'updated_at' => $this->updated_at,
    //     ];
    // }
    // public function toArray($request)
    // {
    //     $user = User::find(1);

    //     return [
    //         'id' => $this->id,
    //         'name' => $this->name,
    //         'email' => $this->email,
    //         $this->mergeWhen($this->isAdmin(), [
    //             'first-secret' => 'value',
    //             'second-secret' => 'value',
    //         ]),
    //         'created_at' => $this->created_at,
    //         'updated_at' => $this->updated_at,
    //     ];
    // } 
    // public function toArray($request)
    // {
    //     $user = User::find(1);

    //     return [
    //         'id' => $this->id,
    //         'name' => $this->name,
    //         'email' => $this->email,
    //         'secret' => $this->when($this->isAdmin(), function () {
    //             return 'secret-value';
    //         }),
    //         'created_at' => $this->created_at,
    //         'updated_at' => $this->updated_at,
    //     ];
    // }
    // public function toArray($request)
    // {
    //     return [
    //         'id' => $this->id,
    //         'name' => $this->name,
    //         'email' => $this->email,
    //         'posts' => PostResource::collection($this->posts),
    //         'created_at' => $this->created_at,
    //         'updated_at' => $this->updated_at,
    //     ];
    // }

    public function toArray($request)
    {
        // return parent::toArray($request);
        return [
            'name' => $this->name,
            'email' => $this->email,
            'avatar' => url('/user/'.$this->id.'/'),
            'posts' => $this->posts,
        ];    
    }

   

    public function with($requesst) {
        return [
            'version' => '2.0.0',
            'attribute' => url('/term-of-service'),
            'valid_as_of' => date('D, d M Y H:i:s'),
            // 'api_calls_remaining' => Auth::user()->api_calls_remaining()
        ];
    }
}
