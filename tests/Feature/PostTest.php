<?php

namespace Tests\Feature;

use Tests\TestCase;

class PostTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testGetAllPostData()
    {
        $response = $this->get('/api/post');
        $response->assertStatus(200);
    }

    public function testGetByIdPostData()
    {
        $response = $this->get('/api/post/' . mt_rand(1, 100));
        $response->assertStatus(200);
    }

    public function testSuccessStorePostData()
    {
        $data = array(
            'title' => 'test post',
            'body' => '<p>Eum possimus vel sit. Voluptatem quod doloribus ut est placeat repellat. Distinctio sed ut voluptatem ut ut. Ut et eligendi ut earum dolore ipsa.</p><p>Et eos soluta placeat qui tempore ducimus. Cupiditate molestiae et tempore quis et debitis ut. Tempora qui mollitia aut ut.</p><p>Rem natus commodi est est veniam blanditiis quas. Facilis quo explicabo error cumque.</p><p>Qui iusto a cum dolor. Sequi doloremque necessitatibus voluptas aut at labore. Repellendus ea ab provident amet aut.</p><p>Architecto ea sunt tempora eum odio. Voluptatem eum nobis sunt qui vel. Quia ea incidunt dolorem voluptas labore sunt consequuntur.</p><p>Sint porro dolore eius ex voluptatibus. Non qui autem commodi voluptatem temporibus eum ut. Consequatur ut explicabo tenetur veniam. Eos quod animi sed officia necessitatibus rerum.</p><p>Saepe tempore et sequi dicta provident quam. Non quaerat dolorem incidunt aut enim. Sapiente non modi et ratione in ea. Dolorem qui fuga facilis voluptatum.</p>',
            'category_id' => 1,
            'user_id' => 18
        );
        $response = $this->post('/api/post', $data);
        $response->assertStatus(201);
    }

    public function testUnvalidatedStorePostData()
    {
        $data = array(
            'category_id' => 1,
            'user_id' => 18
        );
        $response = $this->post('/api/post', $data);
        $response->assertStatus(400);
    }

    public function testSuccessUpdatePostData()
    {
        $data = array(
            'title' => 'test post update',
        );
        $response = $this->put('/api/post/1001', $data);
        $response->assertStatus(200);
    }
    public function testSuccessDeletePostData()
    {
        $response = $this->delete('/api/post/1001');
        $response->assertStatus(204);
    }
}
