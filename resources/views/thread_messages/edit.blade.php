@extends('layouts.app')

@section('title', 'Edit Message')

@section('content')
    <h1>Edit Message</h1>

    <form action="/threads/{{ $thread->id }}/messages/{{ $message->id }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div>
            <label for="content">Message Content:</label>
            <textarea name="content" id="content" rows="3" required>{{ $message->content }}</textarea>
        </div>
        <div>
            <label for="media_files">Upload New Media (replaces existing):</label>
            <input type="file" name="media_files[]" id="media_files" multiple>
        </div>
        <button type="submit">Update Message</button>
    </form>
@endsection
