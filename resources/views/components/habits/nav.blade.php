<nav class="app">
    {{-- Close icon --}}
    <img id="close-nav" class="close hover-white" src="{{ asset('icons/close-black.png') }}" />
    
    {{-- Logo --}}
    <img class="logo" src="{{ asset('logos/logo-white.png') }}" onclick="location.href='{{ route('home') }}'"/>

    <ul class="list">
        @if(in_array('back', $show))
            <a href="{{ route('habits') }}"><li>Back To Habits</li></a>
        @endif

        @if(in_array('back-habit', $show))
            <a href="{{ route('habits.view', ['habit' => $habit->uuid]) }}"><li>Back To Habit</li></a>
        @endif

        @if(in_array('create', $show))
            <a href="{{ route('habits.create') }}"><li>Create New Habit</li></a>
        @endif

        @if(in_array('color-key', $show))
            <a href="{{ route('habits.colors') }}"><li>Color Guide</li></a>
        @endif

        @if(in_array('edit', $show))
            <a href="{{ route('habits.edit', ['habit' => $habit->uuid]) }}"><li>Edit Habit</li></a>
        @endif

        @if(in_array('reminders', $show))
            <a href="{{ route('habits.edit.reminders', ['habit' => $habit->uuid]) }}"><li>Edit Reminders</li></a>
        @endif

        @if(in_array('delete', $show))
            <form id="delete-habit-form" class="verify-delete" action="{{ route('habits.destroy', ['habit' => $habit->uuid]) }}" method="POST">
                @csrf
            </form>
            <a href="{{ route('habits.destroy', ['habit' => $habit->uuid]) }}" class="destructive-option"
                onclick="event.preventDefault(); verifyDeleteForm('Delete Habit?', '#delete-habit-form')">
                <li>Delete Habit</li>
            </a>
        @endif 
    </ul>
</nav>