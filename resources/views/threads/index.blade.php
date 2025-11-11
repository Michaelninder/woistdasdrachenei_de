@extends('layouts.app')

@section('title', 'Forum Themen')

@section('content')
    <div
        class="d-flex justify-content-between align-items-center mb-4 border-bottom pb-3"
    >
        <h1 class="h2">
            <i class="bi bi-chat-square-text-fill me-2"></i>Forum Themen
        </h1>
        @auth
            <a href="/threads/create" class="btn btn-primary">
                <i class="bi bi-plus-circle-fill me-2"></i> Neues Thema erstellen
            </a>
        @endauth
    </div>

    @forelse ($threads as $thread)
        <div class="card mb-3 shadow-sm">
            <div class="card-body">
                <h2 class="card-title h4">
                    <a href="/threads/{{ $thread->id }}" class="text-decoration-none">
                        {{ $thread->title }}
                    </a>
                    @if ($thread->is_pinned)
                        <span class="badge bg-secondary ms-2">
                            <i class="bi bi-pin-angle-fill"></i> Angepinnt
                        </span>
                    @endif
                </h2>
                <p class="card-text text-muted">
                    <small>
                        Erstellt von: {{ $thread->user->name }} am
                        {{ $thread->created_at->format('d.m.Y H:i') }}
                    </small>
                </p>
            </div>
        </div>
    @empty
        <div class="alert alert-info text-center" role="alert">
            <i class="bi bi-info-circle-fill me-2"></i> Es wurden keine Themen gefunden.
        </div>
    @endforelse
@endsection