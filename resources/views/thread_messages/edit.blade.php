@extends('layouts.app')

@section('title', 'Nachricht bearbeiten')

@section('content')
    <div class="card shadow-sm">
        <div class="card-header h3">
            <i class="bi bi-pencil-square me-2"></i> Nachricht bearbeiten
        </div>
        <div class="card-body">
            <form
                action="/threads/{{ $thread->id }}/messages/{{ $message->id }}"
                method="POST"
                enctype="multipart/form-data"
            >
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="content" class="form-label">Nachrichtsinhalt:</label>
                    <textarea
                        name="content"
                        id="content"
                        rows="4"
                        class="form-control"
                        required
                    >{{ $message->content }}</textarea>
                </div>
                <div class="mb-3">
                    <label for="media_files" class="form-label">
                        <i class="bi bi-file-earmark-arrow-up-fill me-1"></i> Neue Medien
                        hochladen (ersetzt bestehende):
                    </label>
                    <input
                        type="file"
                        name="media_files[]"
                        id="media_files"
                        class="form-control"
                        multiple
                    >
                </div>
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-arrow-repeat me-2"></i> Nachricht aktualisieren
                </button>
            </form>
        </div>
    </div>
@endsection