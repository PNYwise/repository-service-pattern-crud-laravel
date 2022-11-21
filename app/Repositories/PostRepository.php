<?php

namespace App\Repositories;

use App\Models\Post;
use App\Repositories\Interfaces\PostRepositoryInterface;

/**
 * * Welcome to Repository layer.
 * ----------------------------------------------------------------- 
 * 
 * Here, you can manipulating data after you get data from model with query 
 * builder, don't write any logic except that logic can related with 
 * DB, you have an access to manipating what do you want here. 
 * 
 * 
 */


class PostRepository implements PostRepositoryInterface
{

     public function getLatest()
     {
          return Post::all()->latest('created_at')->first();
     }

     public function getAll()
     {
          // return Post::all();

          $data = Post::all()->map(function ($v, $i) {
               //adding new field named "date" and the value is manipulation format date from "created_at" 
               $v->date = $v->created_at->format('d-m-Y');
               return $v;
          })->makeHidden('created_at'); //hiddenig created_at field 
          return $data;
     }


     public function getById($id)
     {
          return Post::find($id);
     }

     public function create($data)
     {
          $post = Post::create($data);
          return $post;
     }

     public function update($id, $data)
     {
          $post = Post::find($id);
          $post->update($data);
          return $post->fresh();
     }

     public function delete($id)
     {
          Post::find($id)->delete();
          return [];
     }
}
