@extends('layouts.app')

@section('title', $thread->title)

@section('content')
    <h1>{{ $thread->title }}</h1>
    <p>Created by: {{ $thread->user->name }} on {{ $thread->created_at->format('d.m.Y H:i') }}</p>
    @if ($thread->is_pinned)
        <p><strong>PINNED</strong></p>
    @endif

    <div>
        <h2>Messages</h2>
        @forelse ($thread->messages as $message)
            <div>
                <p><strong>{{ $message->user->name }}:</strong> {{ $message->content }}</p>
                @if ($message->media->count() > 0)
                    <div>
                        @foreach ($message->media as $media)
                            @if (Str::startsWith($media->file_type, 'image'))
                                <img src="{{ asset('storage/' . $media->file_path) }}" alt="Media" width="200">
                            @elseif (Str::startsWith($media->file_type, 'video'))
                                <video controls width="200">
                                    <source src="{{ asset('storage/' . $media->file_path) }}" type="{{ $media->file_type }}">
                                    Your browser does not support the video tag.
                                </video>
                            @endif
                        @endforeach
                    </div>
                @endif
                <p><small>{{ $message->created_at->format('d.m.Y H:i') }}</small></p>
            </div>
        @empty
            <p>No messages yet.</p>
        @endforelse
    </div>

    @auth
        <form action="/threads/{{ $thread->id }}/messages" method="POST" enctype="multipart/form-data">
            @csrf
            <div>
                <label for="content">New Message:</label>
                <textarea name="content" id="content" rows="3" required></textarea>
            </div>
            <div>
                <label for="media_files">Upload Media:</label>
                <input type="file" name="media_files[]" id="media_files" multiple>
            </div>
            <button type="submit">Post Message</button>
        </form>
    @endauth
@endsection
