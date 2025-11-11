@extends('layouts.app')

@section('title', $thread->title)

@section('content')
    <div class="mb-4 pb-3 border-bottom">
        <h1 class="h2">
            {{ $thread->title }}
            @if ($thread->is_pinned)
                <span class="badge bg-secondary ms-2">
                    <i class="bi bi-pin-angle-fill"></i> Angepinnt
                </span>
            @endif
        </h1>
        <p class="text-muted">
            <small>
                Erstellt von: {{ $thread->user->name }} am
                {{ $thread->created_at->format('d.m.Y H:i') }}
            </small>
        </p>
    </div>

    <h2 class="h4 mb-3">
        <i class="bi bi-chat-right-text-fill me-2"></i>Nachrichten
    </h2>
    <div class="mb-5">
        @forelse ($thread->messages as $message)
            <div class="card mb-3 shadow-sm">
                <div class="card-body">
                    <p class="card-text mb-1">
                        <strong>{{ $message->user->name }}:</strong>
                        {{ $message->content }}
                    </p>
                    @if ($message->media->count() > 0)
                        <div class="mt-3">
                            <h6 class="text-muted">Medien:</h6>
                            <div class="d-flex flex-wrap gap-2">
                                @foreach ($message->media as $media)
                                    @if (Str::startsWith($media->file_type, 'image'))
                                        <a
                                            href="{{ asset('storage/' . $media->file_path) }}"
                                            target="_blank"
                                        >
                                            <img
                                                src="{{ asset('storage/' . $media->file_path) }}"
                                                alt="Medien"
                                                class="img-thumbnail"
                                                style="max-width: 150px; height: auto;"
                                            >
                                        </a>
                                    @elseif (Str::startsWith($media->file_type, 'video'))
                                        <video
                                            controls
                                            class="img-thumbnail"
                                            style="max-width: 200px; height: auto;"
                                        >
                                            <source
                                                src="{{ asset('storage/' . $media->file_path) }}"
                                                type="{{ $media->file_type }}"
                                            >
                                            Ihr Browser unterstützt das Video-Tag nicht.
                                        </video>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    @endif
                    <p class="card-text text-end mb-0">
                        <small class="text-muted">
                            {{ $message->created_at->format('d.m.Y H:i') }}
                        </small>
                    </p>
                </div>
            </div>
        @empty
            <div class="alert alert-info text-center" role="alert">
                <i class="bi bi-info-circle-fill me-2"></i> Noch keine Nachrichten.
            </div>
        @endforelse
    </div>

    @auth
        <div class="card shadow-sm mt-4">
            <div class="card-header h5">
                <i class="bi bi-chat-left-text-fill me-2"></i> Neue Nachricht posten
            </div>
            <div class="card-body">
                <form
                    action="/threads/{{ $thread->id }}/messages"
                    method="POST"
                    enctype="multipart/form-data"
                >
                    @csrf
                    <div class="mb-3">
                        <label for="content" class="form-label">Ihre Nachricht:</label>
                        <textarea
                            name="content"
                            id="content"
                            rows="4"
                            class="form-control"
                            required
                        ></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="media_files" class="form-label">
                            <i class="bi bi-file-earmark-arrow-up-fill me-1"></i> Medien
                            hochladen:
                        </label>
                        <input
                            type="file"
                            name="media_files[]"
                            id="media_files"
                            class="form-control"
                            multiple
                        >
                    </div>
                    <button type="submit" class="btn btn-success">
                        <i class="bi bi-send-fill me-2"></i> Nachricht posten
                    </button>
                </form>
            </div>
        </div>
    @endauth
@endsection