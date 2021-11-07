@extends('layouts.app')
@section('content')
<button type="button" v-on:click="openModalTodo" v-show=on_modal_mode>Todoを開く</button>
<button type="button" v-on:click="openModalHoliday" v-show=on_modal_mode>祝日を開く</button>
<div class="row">
    <div class="col-md-4">
        <countdown-component v-bind:selected_time="selected_time" v-bind:selected_todo="selected_todo"></countdown-component>
    </div>
    <div v-bind:class="{'col-md-4':!on_modal_mode, overlay:on_modal_mode}" v-show="show_todo">
        <todo-component v-bind:class="{content:on_modal_mode}" v-on:todo-click="updateTodo" v-on:todo-click-c="closeModalTodo"></todo-component>
    </div>
    <div v-bind:class="{'col-md-4':!on_modal_mode, overlay:on_modal_mode}" v-show="show_room_content">
        <holiday-component v-bind:class="{content:on_modal_mode}" v-on:holiday-click="updateTime" v-on:todo-click-c="closeModal"></holiday-component>
    </div>
</div>
@endsection