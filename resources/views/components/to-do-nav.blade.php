<nav class="app">
    {{-- Close icon --}}
    <img id="close-nav" class="close" src="{{ asset('icons/close-white.png') }}" />
    {{-- Logo --}}
    <img class="logo" src="{{ asset('logos/logo-white.png') }}" />

    @switch($page)
        @case('list')
            <ul class="list">
                <a href="{{ route('todo.create') }}"><li class="top">Create New To-Do Item</li></a>

                {{-- Todo: Change route to import todo from habit route --}}
                <a href="{{ route('todo.create') }}"><li>Create From Habit</li></a>

                {{-- Todo: Change route to import todo from action item route --}}
                <a href="{{ route('todo.create') }}"><li>Create From Goal</li></a>
            </ul>
            @break
        @case('edit')
            
            @break
        @default
            <ul class="default">
                <a href="{{ route('todo.list') }}"><li>Back To List</li></a>
            </ul>
    @endswitch
</nav>