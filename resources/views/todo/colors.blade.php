@extends('layouts.app')

@section('template')
    {{-- Header --}}
    <x-app.header title="To-Do" />

    {{-- Side Nav --}}
    <x-todo.nav show="list|create|create-from-habit|create-from-goal" />

    <div class="app-container">
        <div class="color-guide">
            <div class="color-key"><input class="priority high" type="checkbox" checked disabled /><br/>High Priority </div>
            <div class="color-key"><input class="priority medium" type="checkbox" checked disabled /><br/>Medium Priority</div>
            <div class="color-key"><input class="priority low" type="checkbox" checked disabled /><br/>Low Priority</div>
            <div class="color-key"><input class="priority default" type="checkbox" checked disabled /><br/>Default Priority</div>
        </div>
    </div>

    {{-- Navigation Footer --}}
    <x-app.footer highlight="todo" />
@endsection