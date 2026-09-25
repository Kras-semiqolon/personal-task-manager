<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Task</title>

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
            background: white;
            border-bottom: 1px solid #dce6df;
        }

        .header-inner {
            max-width: 900px;
            margin: auto;
            padding: 20px 24px;
        }

        .header h2 {
            margin: 0;
            color: #1f5138;
        }

        .header p {
            margin: 4px 0 0;
            color: #75827a;
            font-size: 13px;
        }

        .container {
            max-width: 760px;
            margin: 42px auto;
            padding: 0 24px 50px;
        }

        .page-title {
            margin-bottom: 22px;
        }

        .page-title h1 {
            margin: 0 0 7px;
            color: #203a2b;
            font-size: 28px;
        }

        .page-title p {
            margin: 0;
            color: #718078;
        }

        .form-card {
            background: white;
            border: 1px solid #dfe8e2;
            border-radius: 13px;
            padding: 26px;
        }

        .field {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 7px;
            font-weight: bold;
            color: #344d3c;
            font-size: 14px;
        }

        input,
        textarea,
        select {
            width: 100%;
            padding: 12px 13px;
            border: 1px solid #cfdcd3;
            border-radius: 8px;
            background: #fbfdfb;
            font-size: 14px;
            color: #2c3f33;
        }

        input:focus,
        textarea:focus,
        select:focus {
            outline: none;
            border-color: #4c9b6b;
            box-shadow: 0 0 0 3px rgba(76, 155, 107, 0.12);
        }

        textarea {
            min-height: 120px;
            resize: vertical;
        }

        .row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 16px;
        }

        .buttons {
            display: flex;
            gap: 10px;
            margin-top: 10px;
            padding-top: 18px;
            border-top: 1px solid #edf1ee;
        }

        .save-button,
        .cancel-button {
            padding: 10px 16px;
            border-radius: 8px;
            font-size: 14px;
            font-weight: bold;
            text-decoration: none;
        }

        .save-button {
            border: none;
            background: #2f855a;
            color: white;
            cursor: pointer;
        }

        .cancel-button {
            background: #eef3ef;
            color: #4d6355;
            border: 1px solid #d6e1d9;
        }

        .error-box {
            background: #fdeaea;
            border: 1px solid #efc2c2;
            color: #8e3333;
            padding: 14px;
            border-radius: 8px;
            margin-bottom: 20px;
        }

        @media (max-width: 650px) {
            .row {
                grid-template-columns: 1fr;
            }

            .buttons {
                flex-direction: column;
            }
        }
    </style>
</head>

<body>

<div class="header">
    <div class="header-inner">
        <h2>Personal Task Manager</h2>
        <p>Organize your day one task at a time.</p>
    </div>
</div>

<div class="container">

    <div class="page-title">
        <h1>Edit Task</h1>
        <p>Update the task details below.</p>
    </div>

    @if ($errors->any())
        <div class="error-box">
            <strong>Please check the following:</strong>

            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="form-card">

        <form action="{{ route('tasks.update', $task) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="field">
                <label for="task_name">Task Name</label>

                <input
                    id="task_name"
                    type="text"
                    name="task_name"
                    value="{{ old('task_name', $task->task_name) }}"
                    required>
            </div>

            <div class="field">
                <label for="description">Description</label>

                <textarea
                    id="description"
                    name="description">{{ old('description', $task->description) }}</textarea>
            </div>

            <div class="row">

                <div class="field">
                    <label for="status">Status</label>

                    <select id="status" name="status" required>
                        <option
                            value="Pending"
                            {{ old('status', $task->status) === 'Pending' ? 'selected' : '' }}>
                            Pending
                        </option>

                        <option
                            value="Completed"
                            {{ old('status', $task->status) === 'Completed' ? 'selected' : '' }}>
                            Completed
                        </option>
                    </select>
                </div>

                <div class="field">
                    <label for="due_date">Due Date</label>

                    <input
                        id="due_date"
                        type="date"
                        name="due_date"
                        value="{{ old('due_date', $task->due_date->format('Y-m-d')) }}"
                        required>
                </div>

            </div>

            <div class="buttons">
                <button type="submit" class="save-button">
                    Update Task
                </button>

                <a href="{{ route('tasks.index') }}" class="cancel-button">
                    Cancel
                </a>
            </div>

        </form>

    </div>

</div>

</body>
</html>
