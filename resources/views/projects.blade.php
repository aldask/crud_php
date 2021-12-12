@extends('layouts.app')

@section('content')
    <?php $counter = 0; ?>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                @if (session('status_success'))
                    <p style="color: green"><b>{{ session('status_success') }}</b></p>
                @else
                    <p style="color: red"><b>{{ session('status_error') }}</b></p>
                @endif
                <table class="my_table">
                    <tr>
                        <th>#</th>
                        <th>Project</th>
                        <th>Student(s)</th>
                        @if (auth()->check())
                            <th>Actions</th>
                        @endif
                    </tr>
                    @foreach ($projects as $project)
                        <tr>
                            <td>{{ ++$counter }}</td>
                            <td>{{ $project['title'] }}</td>
                            <td>
                                @foreach ($project->students as $student)
                                    {{ $student['name'] }}
                                    {{ !$loop->last ? ', ' : '' }}
                                @endforeach
                            </td>
                            @if (auth()->check())
                                <td>
                                    <form action="{{ route('projects.destroy', $project['id']) }}" method="POST">
                                        @method('DELETE')
                                        @csrf
                                        <button type="submit" onclick="return confirm('Are you sure?')">Delete</button>
                                    </form>
                                    <form action="{{ route('projects.show', $project['id']) }}" method="GET">
                                        @method('PUT')
                                        @csrf
                                        <button type="submit">Update</button>
                                    </form>
                                </td>
                            @endif
                        </tr>
                    @endforeach
                </table>
                @if (auth()->check())
                    <form class="new-entry" action="/projects" method="POST">
                        @csrf
                        <label for="new_project">Create a new project:</label><br>
                        <input type="text" name="new_project" placeholder="Enter project title" required />
                        @error('new_project')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        <button type="submit" name="create">Create</button>
                    </form>
                @endif
            </div>
        </div>
    </div>
@endsection
