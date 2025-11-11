<?php

namespace App\Http\Controllers;

use App\Models\Thread;
use App\Models\ThreadMessage;
use App\Models\ThreadMessageMedia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Enums\UserRole;
use Illuminate\Support\Facades\Storage;

class ThreadMessageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show', 'store']);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Thread $thread)
    {
        $request->validate([
            'content' => 'required|string',
            'media_files' => 'array',
            'media_files.*' => 'file|mimes:jpeg,png,jpg,gif,mp4,mov,avi|max:10240', // Max 10MB
        ]);

        $userId = null;
        if (Auth::check()) {
            $userId = Auth::id();
        } elseif ($thread->title === 'Anonyme Diskussion') {
            // Allow anonymous posting in the "Anonyme Diskussion" thread
            $userId = null;
        } else {
            abort(403, 'Unauthorized action. You must be logged in to post messages.');
        }

        $message = $thread->messages()->create([
            'user_id' => $userId,
            'content' => $request->content,
        ]);

        if ($request->hasFile('media_files')) {
            foreach ($request->file('media_files') as $file) {
                $path = $file->store('thread_media', 'public');
                $message->media()->create([
                    'file_path' => $path,
                    'file_type' => $file->getClientMimeType(),
                ]);
            }
        }

        return redirect()->route('threads.show', $thread);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Thread $thread, ThreadMessage $message)
    {
        if ($message->thread_id !== $thread->id) {
            abort(404, 'Message not found in this thread.');
        }

        if (Auth::id() !== $message->user_id && Auth::user()->role !== UserRole::Admin) {
            abort(403, 'Unauthorized action.');
        }
        return view('thread_messages.edit', compact('thread', 'message'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Thread $thread, ThreadMessage $message)
    {
        if ($message->thread_id !== $thread->id) {
            abort(404, 'Message not found in this thread.');
        }

        if (Auth::id() !== $message->user_id && Auth::user()->role !== UserRole::Admin) {
            abort(403, 'Unauthorized action.');
        }

        $request->validate([
            'content' => 'sometimes|required|string',
            'media_files' => 'array',
            'media_files.*' => 'file|mimes:jpeg,png,jpg,gif,mp4,mov,avi|max:10240', // Max 10MB
        ]);

        $message->content = $request->input('content', $message->content);
        $message->save();

        if ($request->hasFile('media_files')) {
            // Delete existing media if any, or handle updates
            foreach ($message->media as $media) {
                Storage::disk('public')->delete($media->file_path);
                $media->delete();
            }

            foreach ($request->file('media_files') as $file) {
                $path = $file->store('thread_media', 'public');
                $message->media()->create([
                    'file_path' => $path,
                    'file_type' => $file->getClientMimeType(),
                ]);
            }
        }

        return redirect()->route('threads.show', $thread);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Thread $thread, ThreadMessage $message)
    {
        if ($message->thread_id !== $thread->id) {
            return response()->json(['message' => 'Message not found in this thread.'], 404);
        }

        if (Auth::id() !== $message->user_id && Auth::user()->role !== UserRole::Admin) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        // Delete associated media files
        foreach ($message->media as $media) {
            Storage::disk('public')->delete($media->file_path);
        }

        $message->delete();

        return redirect()->route('threads.show', $thread);
    }
}
