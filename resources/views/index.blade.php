Hallo feom blade template!

<div>
    @if (count($tasks))
        <div>There Are tasks!</div>
        @foreach ($tasks as $task)
            <li>{{ $task->title }}</li>
        @endforeach
    @else
        <div>There are no tasks!</div>
    @endif
</div>
