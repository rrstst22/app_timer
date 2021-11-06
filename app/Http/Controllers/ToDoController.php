<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Todo;

class ToDoController extends Controller
{
    public function getTodos()
    {
        $todos = Todo::all();
        return $todos;
    }

    public function registerTodo(Request $request)
    {
        $date = $request->date;
        $date = strtotime($date);

        Todo::create(
            array(
                'date' => $date,
                'name' => request->name,
                'detail' => "テスト",
            )
        );
    }
}
