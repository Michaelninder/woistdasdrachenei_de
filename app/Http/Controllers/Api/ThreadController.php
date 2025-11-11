<?php

namespace App\Http\Controllers\Api;

use App\Models\Thread;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Enums\UserRole;
use App\Http\Controllers\Controller; // Import the base Controller

class ThreadController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show']);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Thread::query();

        if ($request->has('pinned') && $request->boolean('pinned')) {
            $query->where('is_pinned', true);
        }

        return response()->json($query->with('user')->get());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
        ]);

        $thread = Auth::user()->threads()->create([
            'title' => $request->title,
            'is_pinned' => false, // Only admins can pin, handled in update
        ]);

        return response()->json($thread->load('user'), 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Thread $thread)
    {
        return response()->json($thread->load('user', 'messages.user', 'messages.media'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Thread $thread)
    {
        if (Auth::id() !== $thread->user_id && Auth::user()->role !== UserRole::Admin) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $request->validate([
            'title' => 'sometimes|required|string|max:255',
            'is_pinned' => 'sometimes|boolean',
        ]);

        $thread->title = $request->input('title', $thread->title);

        if ($request->has('is_pinned') && Auth::user()->role === UserRole::Admin) {
            $thread->is_pinned = $request->is_pinned;
        } elseif ($request->has('is_pinned') && Auth::user()->role !== UserRole::Admin) {
            return response()->json(['message' => 'Only administrators can pin threads.'], 403);
        }

        $thread->save();

        return response()->json($thread->load('user'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Thread $thread)
    {
        if (Auth::id() !== $thread->user_id && Auth::user()->role !== UserRole::Admin) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $thread->delete();

        return response()->json(['message' => 'Thread deleted successfully.']);
    }
}
