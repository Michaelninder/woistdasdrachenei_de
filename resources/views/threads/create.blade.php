@extends('layouts.app')

@section('title', 'Neues Thema erstellen')

@section('content')
    <div class="card shadow-sm">
        <div class="card-header h3">
            <i class="bi bi-plus-circle-fill me-2"></i> Neues Thema erstellen
        </div>
        <div class="card-body">
            <form action="/threads" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="title" class="form-label">Titel:</label>
                    <input
                        type="text"
                        name="title"
                        id="title"
                        class="form-control"
                        required
                    >
                </div>
                <button type="submit" class="btn btn-success">
                    <i class="bi bi-send-fill me-2"></i> Thema erstellen
                </button>
            </form>
        </div>
    </div>
@endsection