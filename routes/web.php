<?php

use App\Http\Requests\TaskRequest;
use App\Models\Task as ModelsTask;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Route;

class Task
{
    public function __construct(
        public int $id,
        public string $title,
        public string $description,
        public ?string $long_description,
        public bool $completed,
        public string $created_at,
        public string $updated_at
    ) {}
}

$tasks = [
    new Task(
        1,
        'Buy groceries',
        'Task 1 description',
        'Task 1 long description',
        false,
        '2023-03-01 12:00:00',
        '2023-03-01 12:00:00'
    ),
    new Task(
        2,
        'Sell old stuff',
        'Task 2 description',
        null,
        false,
        '2023-03-02 12:00:00',
        '2023-03-02 12:00:00'
    ),
    new Task(
        3,
        'Learn programming',
        'Task 3 description',
        'Task 3 long description',
        true,
        '2023-03-03 12:00:00',
        '2023-03-03 12:00:00'
    ),
    new Task(
        4,
        'Take dogs for a walk',
        'Task 4 description',
        null,
        false,
        '2023-03-04 12:00:00',
        '2023-03-04 12:00:00'
    ),
];

Route::get('/', function () {
    return redirect()->route('tasks.index');
});

Route::get('/tasks', function () {
    return view('index', [
        'tasks' => ModelsTask::latest()->paginate(10),
    ]);
})->name('tasks.index');

Route::view('tasks/create', 'create')->name('task.create');

Route::get('/tasks/{task}/edit', function (ModelsTask $task) {
    return view('edit', ['task' => $task]);
})->name('tasks.edit');

Route::get('/tasks/{task}', function (ModelsTask $task) {
    return view('show', ['task' => $task]);
})->name('tasks.show');

Route::post('/tasks', function (TaskRequest $request) {
    $task = ModelsTask::create($request->validated());

    return redirect()->route('tasks.show', ['task' => $task->id])->with('success', 'Task successfully created');
})->name('task.store');

Route::put('/tasks/{task}', function (ModelsTask $task, TaskRequest $request) {

    $task->update($request->validated());

    return redirect()->route('tasks.show', ['task' => $task->id])->with('success', 'Task successfully updated');
})->name('tasks.update');

Route::delete('/tasks/{task}', function (ModelsTask $task) {
    $task->delete();

    return redirect()->route('tasks.index')->with('success', 'Task is deleted!');
})->name('tasks.destroy');

Route::put('/tasks{task}/toggle-complete', function (ModelsTask $task) {
    $task->toggleComplete();

    return redirect()->back()->with('success', 'Task udated successfully');
})->name('task.toggle-complete');

Route::fallback(function () {
    return 'No Route';
});
