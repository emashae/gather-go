<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EventController extends Controller
{
    public function __construct()
    {
        // Apply authorization checks for specific actions
        $this->authorizeResource(Event::class, 'event');
    }

    public function index()
    {
        $events = Event::all();
        return view('events.index', compact('events'));
    }

    public function show(Event $event)
    {
        // Authorization will be handled by the EventPolicy
        $this->authorize('view', $event);

        return view('events.show', compact('event'));
    }

    public function create()
    {
        // Authorization will be handled by the EventPolicy
        $this->authorize('create', Event::class);

        return view('events.create');
    }

    public function store(Request $request)
    {
        $this->authorize('create', Event::class);

        $validated = $request->validate([
            'title' => 'required|string',
            'description' => 'required|string',
            'date' => 'required|date',
            'location' => 'required|string',
        ]);

        Event::create([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'date' => $validated['date'],
            'location' => $validated['location'],
            'organizer_id' => Auth::id(),
        ]);

        return redirect()->route('events.index');
    }

    public function edit(Event $event)
    {
        // Authorization will be handled by the EventPolicy
        $this->authorize('update', $event);

        return view('events.edit', compact('event'));
    }

    public function update(Request $request, Event $event)
    {
        $this->authorize('update', $event);

        $validated = $request->validate([
            'title' => 'required|string',
            'description' => 'required|string',
            'date' => 'required|date',
            'location' => 'required|string',
        ]);

        $event->update($validated);

        return redirect()->route('events.index');
    }

    public function destroy(Event $event)
    {
        $this->authorize('delete', $event);

        $event->delete();

        return redirect()->route('events.index');
    }
}
