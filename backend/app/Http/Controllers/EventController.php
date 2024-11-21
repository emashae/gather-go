<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Http\Requests\EventRequest;
use App\Http\Resources\EventResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Response;
use Log;

class EventController extends Controller
{
    use AuthorizesRequests;

    /**
     * Display a listing of events.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        try {
            Log::info("Fetching events list");

            // Authorize the action
            $this->authorize('viewAny', Event::class);

            // Fetch events 
            $events = Event::paginate(10); 
            return response()->json(EventResource::collection($events), Response::HTTP_OK);
        } catch (\Illuminate\Auth\Access\AuthorizationException $e) {
            Log::error('Authorization failed: ' . $e->getMessage());
            return response()->json(['error' => 'Unauthorized'], Response::HTTP_FORBIDDEN);
        }
    }

    /**
     * Display the specified event.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Event $event)
    {
        try {
            $this->authorize('view', $event);

            return response()->json(new EventResource($event), Response::HTTP_OK);
        } catch (\Illuminate\Auth\Access\AuthorizationException $e) {
            Log::error('Authorization failed: ' . $e->getMessage());
            return response()->json(['error' => 'Unauthorized'], Response::HTTP_FORBIDDEN);
        }
    }

    /**
     * Store a newly created event in storage.
     *
     * @param  \App\Http\Requests\EventRequest  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(EventRequest $request)
    {
        try {
            $this->authorize('create', Event::class);

            
            $event = Event::create([
                'title' => $request->validated()['title'],
                'description' => $request->validated()['description'],
                'date' => $request->validated()['date'],
                'location' => $request->validated()['location'],
                'organizer_id' => Auth::id(),
            ]);

            return response()->json(['message' => 'Event created successfully', 'event' => new EventResource($event)], Response::HTTP_CREATED);
        } catch (\Illuminate\Auth\Access\AuthorizationException $e) {
            Log::error('Authorization failed: ' . $e->getMessage());
            return response()->json(['error' => 'Unauthorized'], Response::HTTP_FORBIDDEN);
        }
    }

    /**
     * Update the specified event in storage.
     *
     * @param  \App\Http\Requests\EventRequest  $request
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(EventRequest $request, Event $event)
    {
        try {
            $this->authorize('update', $event);

            
            $event->update($request->validated());

            return response()->json(['message' => 'Event updated successfully', 'event' => new EventResource($event)], Response::HTTP_OK);
        } catch (\Illuminate\Auth\Access\AuthorizationException $e) {
            Log::error('Authorization failed: ' . $e->getMessage());
            return response()->json(['error' => 'Unauthorized'], Response::HTTP_FORBIDDEN);
        }
    }

    /**
     * Remove the specified event from storage.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Event $event)
    {
        try {
            $this->authorize('delete', $event);

            
            $event->delete();

            return response()->json(['message' => 'Event deleted successfully'], Response::HTTP_OK);
        } catch (\Illuminate\Auth\Access\AuthorizationException $e) {
            Log::error('Authorization failed: ' . $e->getMessage());
            return response()->json(['error' => 'Unauthorized'], Response::HTTP_FORBIDDEN);
        }
    }
}
