@extends('layouts.app')
@section('content')

<button type="button" v-on:click="openTodo" v-show=on_modal_mode>Todoを開く</button>
<button type="button" v-on:click="openHoliday" v-show=on_modal_mode>祝日を開く</button>

<div class="row">

    <!-- カウントダウン画面 -->
    <div class="col-md-4">
        <countdown-component v-bind:selected_holiday="selected_holiday" v-bind:selected_todo="selected_todo"></countdown-component>
    </div>

    <!-- Todo画面 -->
    <div v-bind:class="{'col-md-4':!on_modal_mode, overlay:on_modal_mode}" v-show="show_todo">
        <div><button class="btn btn-light close-btn" v-show="on_modal_mode" v-on:click="closeTodo">×</button></div>
        <todo-component v-bind:class="{content:on_modal_mode}" v-on:todo-click="updateTodo" v-on:todo-click-c="closeTodo"></todo-component>
    </div>

    <!-- 祝日画面 -->
    <div v-bind:class="{'col-md-4':!on_modal_mode, overlay:on_modal_mode}" v-show="show_holiday">
        <div><button class="btn btn-light close-btn" v-show="on_modal_mode" v-on:click="closeHoliday">×</button></div>
        <holiday-component v-bind:class="{content:on_modal_mode}" v-on:holiday-click="updateHoliday" v-on:todo-click-c="closeHoliday"></holiday-component>
    </div>

</div>
@endsection