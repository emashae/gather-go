<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\Event;
use App\Http\Requests\TicketRequest;
use App\Http\Resources\TicketResource;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class TicketController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum');
    }

    /**
     * Display all tickets for the authenticated user.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        try {
            $tickets = Ticket::where('attendee_id', Auth::id())->get();

            // Return collection of tickets wrapped in a resource
            return TicketResource::collection($tickets);
        } catch (\Exception $e) {
            Log::error("Error fetching tickets: {$e->getMessage()}");
            return response()->json(['error' => 'Failed to fetch tickets.'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Store a new ticket for an event.
     *
     * @param \App\Http\Requests\TicketRequest $request
     * @param int $eventId
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(TicketRequest $request, $eventId)
    {
        try {
            // Ensure event exists
            $event = Event::findOrFail($eventId);

            // Create the ticket
            $ticket = Ticket::create([
                'event_id' => $event->id,
                'attendee_id' => Auth::id(),
                'price' => $request->price,
                'status' => 'booked',  // Default status
            ]);

            // Return the created ticket wrapped in a resource
            return new TicketResource($ticket);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            Log::error("Event not found: {$e->getMessage()}");
            return response()->json(['error' => 'Event not found.'], Response::HTTP_NOT_FOUND);
        } catch (\Exception $e) {
            Log::error("Error creating ticket: {$e->getMessage()}");
            return response()->json(['error' => 'Failed to create ticket.'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Display the specified ticket.
     *
     * @param int $ticketId
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($ticketId)
    {
        try {
            $ticket = Ticket::findOrFail($ticketId);  // Find ticket by ID

            // Return the ticket wrapped in a resource
            return new TicketResource($ticket);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            Log::error("Ticket not found: {$e->getMessage()}");
            return response()->json(['error' => 'Ticket not found.'], Response::HTTP_NOT_FOUND);
        } catch (\Exception $e) {
            Log::error("Error fetching ticket: {$e->getMessage()}");
            return response()->json(['error' => 'Failed to fetch ticket.'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Update the specified ticket.
     *
     * @param \App\Http\Requests\TicketRequest $request
     * @param int $ticketId
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(TicketRequest $request, $ticketId)
    {
        try {
            $ticket = Ticket::findOrFail($ticketId);  // Find ticket by ID
            $ticket->update([
                'price' => $request->price,
                'status' => $request->status,  // Update status
            ]);

            // Return the updated ticket wrapped in a resource
            return new TicketResource($ticket);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            Log::error("Ticket not found: {$e->getMessage()}");
            return response()->json(['error' => 'Ticket not found.'], Response::HTTP_NOT_FOUND);
        } catch (\Exception $e) {
            Log::error("Error updating ticket: {$e->getMessage()}");
            return response()->json(['error' => 'Failed to update ticket.'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Remove the specified ticket from storage.
     *
     * @param int $ticketId
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($ticketId)
    {
        try {
            $ticket = Ticket::findOrFail($ticketId);  // Find ticket by ID
            $ticket->delete();

            // Return success message
            return response()->json(['message' => 'Ticket deleted successfully.'], Response::HTTP_OK);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            Log::error("Ticket not found: {$e->getMessage()}");
            return response()->json(['error' => 'Ticket not found.'], Response::HTTP_NOT_FOUND);
        } catch (\Exception $e) {
            Log::error("Error deleting ticket: {$e->getMessage()}");
            return response()->json(['error' => 'Failed to delete ticket.'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}

