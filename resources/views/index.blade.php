@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-md-4">
        <countdown-component v-bind:selected_time="selected_time"></countdown-component>
    </div>
    <div class="col-md-4">
        <holiday-component v-on:holiday-click="updateTime"></holiday-component>
    </div>
    <div class="col-md-4">
        <todo-component></todo-component>
    </div>
</div>
@endsection