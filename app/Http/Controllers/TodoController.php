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
        $request->validate([
            'name' => 'required|string|max:10'
        ],
        [
            'date' => 'required|string|max:10'
        ],
        [
            'name.required' => 'イベント名は必須です。',
            'name.sting'  => '文字列を入力してください。',
            'name.max'  => '最大max文字です。',
            'date.required' => 'イベント名は必須です。',
            'date.sting'  => '日付を入力してください',
            'date.max'  => '日付を入力してください',
        ]);

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
