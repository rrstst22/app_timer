<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Todo;
use DateTime;

class TodoController extends Controller
{
    public function getTodos()
    {
        $todos = Todo::orderBy('date')->get();
        return $todos;
    }

    public function getTodo(Request $request)
    {
        $todo = Todo::where('id', $request->id)->get();
        return $todo;
    }

    public function registerTodo(Request $request)
    {
        Todo::create(
            array(
                'date' => new DateTime($request->date),
                'name' => $request->name,
                'detail' => "テスト",
            )
        );
    }

    public function deleteTodo(Request $request)
    {
        Todo::findOrFail($request->id)->delete();
    }
}
