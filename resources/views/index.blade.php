@extends('layouts.app')
@section('content')

<button type="button" class="btn-light" v-on:click="openTodo" v-show=on_modal_mode>
    <i class="fas fa-sticky-note m-1"></i>
    Todoを開く
</button>

<button type="button" class="btn-light" v-on:click="openHoliday" v-show=on_modal_mode>
    <i class="fas fa-mug-hot m-1"></i>
    祝日を開く
</button>

<div class="row">

    <!-- カウントダウン画面 -->
    <div class="col-md-4">
        <div class="vue-section">
            <countdown-component v-bind:selected_holiday="selected_holiday" v-bind:selected_todo="selected_todo"></countdown-component>
        </div>
    </div>

    <!-- Todo画面 -->
    <div v-bind:class="{'col-md-4':!on_modal_mode, overlay:on_modal_mode}" v-show="show_todo">

        <!-- 閉じるボタン -->
        <div><button class="btn btn-light close-btn" v-show="on_modal_mode" v-on:click="closeTodo">×</button></div>

        <transition name="vbounce">
            <div class="vue-section" v-bind:class="{content:on_modal_mode}" v-show="show_todo">
                <todo-component v-on:todo-click="updateTodo" v-on:todo-click-c="closeTodo"></todo-component>
            </div>
        </transition>

    </div>

    <!-- 祝日画面 -->
    <div v-bind:class="{'col-md-4':!on_modal_mode, overlay:on_modal_mode}" v-show="show_holiday">

        <!-- 閉じるボタン -->
        <div><button class="btn btn-light close-btn" v-show="on_modal_mode" v-on:click="closeHoliday">×</button></div>

        <transition name="vbounce">
            <div class="vue-section" v-bind:class="{content:on_modal_mode}" v-show="show_holiday">
                <holiday-component v-on:holiday-click="updateHoliday" v-on:todo-click-c="closeHoliday"></holiday-component>
            </div>
        </transition>

    </div>

</div>
@endsection