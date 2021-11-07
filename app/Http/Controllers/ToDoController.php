<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Todo;
use DateTime;

class ToDoController extends Controller
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
        $date = $request->date;
        $date = new DateTime($date);
        // $date = strtotime($date);

        Todo::create(
            array(
                'date' => $date,
                'name' => $request->name,
                'detail' => "テスト",
            )
        );
    }

    public function deleteTodo(Request $request) {
        Todo::findOrFail($request->id)->delete();
    }
}
