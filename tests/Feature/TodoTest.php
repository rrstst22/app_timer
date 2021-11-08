<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TodoTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testRegisterTodo()
    {
        $response = $this->post('vue/register-todo', [
            'date' => "31-12-2021",
            'name' => "Test",
        ]);

        $response->assertStatus(200);
    }

    // public function testDeleteTodo()
    // {
    //     $response = $this->delete('vue/delete-todo', [
    //         'id' => "15"
    //     ]);

    //     $response->assertStatus(200);
    // }

    public function testGetTodo()
    {
        $response = $this->get('get-todo', [
            'id' => "17"
        ]);

        $response->assertStatus(200);
    }
}
