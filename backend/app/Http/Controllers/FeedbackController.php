<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use App\Models\Event;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\FeedbackRequest;
use App\Http\Resources\FeedbackResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class FeedbackController extends Controller
{
    use AuthorizesRequests;

    /**
     * Store a newly created feedback.
     *
     * @param  \App\Http\Requests\FeedbackRequest  $request
     * @param  int  $eventId
     * @return \Illuminate\Http\Response
     */
    public function store(FeedbackRequest $request, $eventId)
    {
        try {
            // Validate request data
            $validated = $request->validated();

            // Find the event or fail
            $event = Event::findOrFail($eventId);

            // Get authenticated user
            $user = Auth::user();

            // Create a new feedback entry
            $feedback = Feedback::create([
                'event_id' => $event->id,
                'user_id' => $user->id,
                'rating' => $validated['rating'],
                'comment' => $validated['comment'] ?? null,
            ]);

            // Return the created feedback as a resource
            return new FeedbackResource($feedback);
        } catch (\Exception $e) {
            Log::error('Error creating feedback: ' . $e->getMessage());
            return response()->json(['error' => 'Failed to create feedback'], 500);
        }
    }

    /**
     * Display a listing of the feedback for an event.
     *
     * @param  int  $eventId
     * @return \Illuminate\Http\Response
     */
    public function index($eventId)
    {
        try {
            // Find the event or fail
            $event = Event::findOrFail($eventId);

            // Get all feedback for the event
            $feedback = $event->feedback()->get();

            // Return a collection of feedback as resources
            return FeedbackResource::collection($feedback);
        } catch (\Exception $e) {
            Log::error('Error fetching feedback: ' . $e->getMessage());
            return response()->json(['error' => 'Failed to retrieve feedback'], 500);
        }
    }

    /**
     * Display the specified feedback.
     *
     * @param  int  $feedbackId
     * @return \Illuminate\Http\Response
     */
    public function show($feedbackId)
    {
        try {
            // Find the feedback or fail
            $feedback = Feedback::findOrFail($feedbackId);

            // Return feedback as a resource
            return new FeedbackResource($feedback);
        } catch (\Exception $e) {
            Log::error('Error fetching feedback: ' . $e->getMessage());
            return response()->json(['error' => 'Feedback not found'], 404);
        }
    }

    /**
     * Update the specified feedback.
     *
     * @param  \App\Http\Requests\FeedbackRequest  $request
     * @param  int  $feedbackId
     * @return \Illuminate\Http\Response
     */
    public function update(FeedbackRequest $request, $feedbackId)
    {
        try {
            // Validate request data
            $validated = $request->validated();

            // Find the feedback or fail
            $feedback = Feedback::findOrFail($feedbackId);

            // Check if the user is authorized to update the feedback
            $this->authorize('update', $feedback);

            // Update the feedback
            $feedback->update([
                'rating' => $validated['rating'],
                'comment' => $validated['comment'] ?? $feedback->comment, // Don't overwrite if comment is not provided
            ]);

            // Return the updated feedback as a resource
            return new FeedbackResource($feedback);
        } catch (\Exception $e) {
            Log::error('Error updating feedback: ' . $e->getMessage());
            return response()->json(['error' => 'Failed to update feedback'], 500);
        }
    }

    /**
     * Remove the specified feedback.
     *
     * @param  int  $feedbackId
     * @return \Illuminate\Http\Response
     */
    public function destroy($feedbackId)
    {
        try {
            // Find the feedback or fail
            $feedback = Feedback::findOrFail($feedbackId);

            // Check if the user is authorized to delete the feedback
            $this->authorize('delete', $feedback);

            // Delete the feedback
            $feedback->delete();

            // Return success response
            return response()->json(['message' => 'Feedback deleted successfully'], 200);
        } catch (\Exception $e) {
            Log::error('Error deleting feedback: ' . $e->getMessage());
            return response()->json(['error' => 'Failed to delete feedback'], 500);
        }
    }
}
