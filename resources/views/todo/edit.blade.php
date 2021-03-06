@extends('layouts.app')

@section('template')
    {{-- Header --}}
    <x-app.header title="To-Do" />

    @switch($item->type_id)
        @case($type::RECURRING_HABIT_ITEM)
            <x-todo.nav show="back|create-from-habit|edit-categories|color-key" :item="$item" />
            @break
        @case($type::SINGULAR_HABIT_ITEM)
            <x-todo.nav show="back|create-from-habit|color-key|delete" :item="$item" />
            @break
        @case($type::ACTION_ITEM)
            {{-- Side Nav --}}
            <x-todo.nav show="back|create-from-goal" :item="$item" />
            @break
        @default
            {{-- Side Nav --}}
            <x-todo.nav show="back|create|delete" :item="$item" />
    @endswitch

    <div class="app-container">
        <x-todo.form :item="$item" />
    </div>

    {{-- Navigation Footer --}}
    <x-app.footer highlight="todo" />
@endsection
