@extends('layouts.app')
@section('content')

    <countdown-component v-bind:selected_time="selected_time"></countdown-component>
    <holiday-component></holiday-component>
    <todo-component></todo-component>

@endsection