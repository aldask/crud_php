@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <form class="new-entry" action="{{ route('projects.update', $project['id']) }}" method="POST">
                    @method('PUT')
                    @csrf
                    <label for="fname">Update project title:</label><br>
                    <input style="margin-bottom: 10px;" type="text" name="upd_title" value="{{ $project['title'] }}"
                        required><br>
                    @error('upd_title')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <button type="submit">Update</button>
                </form>
            </div>
        </div>
    </div>
@endsection
