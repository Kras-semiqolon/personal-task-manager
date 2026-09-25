<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Personal Task Manager</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Arial, Helvetica, sans-serif;
            background: #f4f7f3;
            color: #24332a;
        }

        .header {
            background: #ffffff;
            border-bottom: 1px solid #dce6df;
        }

        .header-inner {
            max-width: 1100px;
            margin: auto;
            padding: 20px 24px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .brand h2 {
            margin: 0;
            color: #1f5138;
        }

        .brand p {
            margin: 4px 0 0;
            color: #75827a;
            font-size: 13px;
        }

        .container {
            max-width: 1100px;
            margin: 38px auto;
            padding: 0 24px 50px;
        }

        .welcome {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 20px;
            margin-bottom: 25px;
        }

        .welcome h1 {
            margin: 0 0 7px;
            font-size: 30px;
            color: #203a2b;
        }

        .welcome p {
            margin: 0;
            color: #718078;
        }

        .add-button {
            background: #2f855a;
            color: white;
            padding: 12px 18px;
            border-radius: 9px;
            text-decoration: none;
            font-weight: bold;
            white-space: nowrap;
        }

        .stats {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 15px;
            margin-bottom: 28px;
        }

        .stat {
            background: white;
            border: 1px solid #dfe8e2;
            border-radius: 12px;
            padding: 20px;
        }

        .stat-label {
            color: #79867e;
            font-size: 13px;
            margin-bottom: 7px;
        }

        .stat-number {
            font-size: 27px;
            font-weight: bold;
            color: #29573d;
        }

        .success {
            background: #e7f6ec;
            border: 1px solid #b9dfc6;
            color: #24613d;
            padding: 13px 15px;
            border-radius: 9px;
            margin-bottom: 20px;
        }

        .section-title {
            margin-bottom: 14px;
            font-size: 18px;
            color: #324b3b;
        }

        .task-list {
            display: grid;
            gap: 13px;
        }

        .task-card {
            background: white;
            border: 1px solid #dfe8e2;
            border-radius: 12px;
            padding: 19px;
        }

        .task-top {
            display: flex;
            justify-content: space-between;
            gap: 20px;
        }

        .task-name {
            margin: 0 0 7px;
            font-size: 18px;
            color: #22392b;
        }

        .task-description {
            margin: 0;
            color: #748078;
            line-height: 1.5;
        }

        .status {
            display: inline-block;
            padding: 6px 10px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: bold;
        }

        .pending {
            background: #fff4d6;
            color: #8a6214;
        }

        .completed {
            background: #dff4e7;
            color: #287548;
        }

        .task-details {
            margin-top: 14px;
            font-size: 13px;
            color: #7b8880;
        }

        .actions {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
            margin-top: 16px;
            padding-top: 14px;
            border-top: 1px solid #edf1ee;
        }

        .actions form {
            margin: 0;
        }

        .actions button,
        .edit-button {
            border: none;
            border-radius: 7px;
            padding: 8px 12px;
            font-size: 13px;
            cursor: pointer;
            text-decoration: none;
            font-weight: bold;
        }

        .status-button {
            background: #e6f2eb;
            color: #286244;
        }

        .edit-button {
            background: #eef2ff;
            color: #4658a8;
        }

        .delete-button {
            background: #fde8e8;
            color: #a33b3b;
        }

        .empty {
            background: white;
            border: 1px dashed #bdccc2;
            border-radius: 12px;
            text-align: center;
            padding: 50px 20px;
        }

        .empty h3 {
            margin: 0 0 7px;
            color: #355442;
        }

        .empty p {
            margin: 0;
            color: #7b8880;
        }

        @media (max-width: 700px) {
            .welcome,
            .task-top {
                flex-direction: column;
                align-items: flex-start;
            }

            .stats {
                grid-template-columns: 1fr;
            }

            .add-button {
                width: 100%;
                text-align: center;
            }
        }
    </style>
</head>

<body>

<div class="header">
    <div class="header-inner">
        <div class="brand">
            <h2>Personal Task Manager</h2>
            <p>Organize your day one task at a time.</p>
        </div>
    </div>
</div>

<div class="container">

    <div class="welcome">
        <div>
            <h1>Task Workspace</h1>
            <p>Keep track of your tasks and upcoming deadlines.</p>
        </div>

        <a href="{{ route('tasks.create') }}" class="add-button">
            + Create Task
        </a>
    </div>

    @if (session('success'))
        <div class="success">
            {{ session('success') }}
        </div>
    @endif

    <div class="stats">
        <div class="stat">
            <div class="stat-label">TOTAL TASKS</div>
            <div class="stat-number">{{ $tasks->count() }}</div>
        </div>

        <div class="stat">
            <div class="stat-label">PENDING</div>
            <div class="stat-number">
                {{ $tasks->where('status', 'Pending')->count() }}
            </div>
        </div>

        <div class="stat">
            <div class="stat-label">COMPLETED</div>
            <div class="stat-number">
                {{ $tasks->where('status', 'Completed')->count() }}
            </div>
        </div>
    </div>

    <h2 class="section-title">My Tasks</h2>

    <div class="task-list">
        @forelse ($tasks as $task)

            <div class="task-card">

                <div class="task-top">
                    <div>
                        <h3 class="task-name">
                            {{ $task->task_name }}
                        </h3>

                        <p class="task-description">
                            {{ $task->description ?: 'No description provided.' }}
                        </p>
                    </div>

                    <span class="status {{ $task->status === 'Completed' ? 'completed' : 'pending' }}">
                        {{ $task->status }}
                    </span>
                </div>

                <div class="task-details">
                    Due {{ $task->due_date->format('M d, Y') }}
                    · Task #{{ $task->id }}
                </div>

                <div class="actions">

                    <form action="{{ route('tasks.status', $task) }}" method="POST">
                        @csrf
                        @method('PATCH')

                        <input
                            type="hidden"
                            name="status"
                            value="{{ $task->status === 'Completed' ? 'Pending' : 'Completed' }}">

                        <button type="submit" class="status-button">
                            {{ $task->status === 'Completed' ? 'Mark Pending' : 'Mark Completed' }}
                        </button>
                    </form>

                    <a href="{{ route('tasks.edit', $task) }}" class="edit-button">
                        Edit
                    </a>

                    <form action="{{ route('tasks.destroy', $task) }}" method="POST">
                        @csrf
                        @method('DELETE')

                        <button type="submit" class="delete-button">
                            Delete
                        </button>
                    </form>

                </div>

            </div>

        @empty

            <div class="empty">
                <h3>No tasks available</h3>
                <p>Create your first task to get started.</p>
            </div>

        @endforelse
    </div>

</div>

</body>
</html>
