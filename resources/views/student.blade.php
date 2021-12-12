@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <form class="new-entry" action="{{ route('students.update', $student['id']) }}" method="POST">
                    @method('PUT')
                    @csrf
                    <label for="fname">Update student name:</label><br>
                    <input style="margin-bottom: 10px;" type="text" name="fname" value="{{ $student['name'] }}"
                        required><br>
                    @error('fname')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <label for="assign_proj">Assign/Re-assign project:</label><br>
                    <select style="margin-bottom: 10px; width: 190px;" name="assign_proj">
                        <label for=""></label>
                        <option></option>
                        @foreach (App\Models\Project::all() as $project)
                            <option value="{{ $project['id'] }}" @if ($project['id'] == $student['project_id']) selected="selected" @endif>{{ $project['title'] }}
                            </option>
                        @endforeach
                    </select><br>
                    <button type="submit">Update</button>
                </form>
            </div>
        </div>
    </div>
@endsection
