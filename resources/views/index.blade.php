@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-md-4">
        <countdown-component v-bind:selected_time="selected_time" v-bind:selected_todo="selected_todo"></countdown-component>
    </div>
    <div class="col-md-4">
        <todo-component v-on:todo-click="updateTodo"></todo-component>
    </div>
    <div class="col-md-4">
        <holiday-component v-on:holiday-click="updateTime"></holiday-component>
    </div>
</div>
@endsection