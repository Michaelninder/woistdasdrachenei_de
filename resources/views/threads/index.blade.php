@extends('layouts.app')

@section('title', 'Forum Threads')

@section('content')
    <h1>Forum Threads</h1>

    @auth
        <a href="/threads/create">Create New Thread</a>
    @endauth

    @forelse ($threads as $thread)
        <div>
            <h2><a href="/threads/{{ $thread->id }}">{{ $thread->title }}</a></h2>
            <p>Created by: {{ $thread->user->name }} on {{ $thread->created_at->format('d.m.Y H:i') }}</p>
            @if ($thread->is_pinned)
                <p><strong>PINNED</strong></p>
            @endif
        </div>
    @empty
        <p>No threads found.</p>
    @endforelse
@endsection
