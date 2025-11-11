@extends('layouts.app')

@section('title', 'Create New Thread')

@section('content')
    <h1>Create New Thread</h1>

    <form action="/threads" method="POST">
        @csrf
        <div>
            <label for="title">Title:</label>
            <input type="text" name="title" id="title" required>
        </div>
        <button type="submit">Create Thread</button>
    </form>
@endsection
