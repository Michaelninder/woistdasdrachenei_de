<?php

namespace App\Http\Controllers;

use App\Models\Thread;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Enums\UserRole;

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

        $threads = $query->with('user')->get();

        return view('threads.index', compact('threads'));
    }

    /**
     * Show the form for creating a new resource.s
     */
    public function create()
    {
        $this->authorize('create', Thread::class);
        return view('threads.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->authorize('create', Thread::class);

        $request->validate([
            'title' => 'required|string|max:255',
        ]);

        $thread = Auth::user()->threads()->create([
            'title' => $request->title,
            'is_pinned' => false,
        ]);

        return redirect()->route('threads.show', $thread);
    }

    /**
     * Display the specified resource.
     */
    public function show(Thread $thread)
    {
        $this->authorize('view', $thread);
        return view('threads.show', compact('thread'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Thread $thread)
    {
        $this->authorize('update', $thread);
        return view('threads.edit', compact('thread'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Thread $thread)
    {
        $this->authorize('update', $thread);

        $request->validate([
            'title' => 'sometimes|required|string|max:255',
            'is_pinned' => 'sometimes|boolean',
        ]);

        $thread->title = $request->input('title', $thread->title);

        if ($request->has('is_pinned')) {
            $this->authorize('pin', $thread); // Assuming a 'pin' ability in policy
            $thread->is_pinned = $request->is_pinned;
        }

        $thread->save();

        return redirect()->route('threads.show', $thread);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Thread $thread)
    {
        $this->authorize('delete', $thread);

        $thread->delete();

        return redirect()->route('threads.index');
    }
}
