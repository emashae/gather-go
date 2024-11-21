<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Event;

class EventPolicy
{
    /**
     * Determine whether the user can view any events.
     */
    public function viewAny(User $user)
    {
        // Allow admins to view any event
        if ($user->role === 'admin') {
            return true;
        }

        // Allow organizers to view events that they organize or public events
        if ($user->role === 'organizer') {
            return $user->events()->exists() || Event::where('is_public', true)->exists();
        }

        // Allow attendees to only view public events
        if ($user->role === 'attendee') {
            return Event::where('is_public', true)->exists();
        }

        return false;  // By default, deny access
    }

    /**
     * Determine whether the user can view the event.
     */
    public function view(User $user, Event $event)
    {
        // Admin can view any event
        if ($user->role === 'admin') {
            return true;
        }

        // Organizers can view their own events
        if ($user->role === 'organizer' && $user->id === $event->organizer_id) {
            return true;
        }

        // Attendees can view public events
        if ($user->role === 'attendee' && $event->is_public) {
            return true;
        }

        return false;  // By default, deny access
    }

    /**
     * Determine whether the user can create events.
     */
    public function create(User $user)
    {
        // Only admins and organizers can create events
        return in_array($user->role, ['admin', 'organizer']);
    }

    /**
     * Determine whether the user can update the event.
     */
    public function update(User $user, Event $event)
    {
        // Admins can update any event
        if ($user->role === 'admin') {
            return true;
        }

        // Organizers can update their own events
        if ($user->role === 'organizer' && $user->id === $event->organizer_id) {
            return true;
        }

        return false;  // By default, deny access
    }

    /**
     * Determine whether the user can delete the event.
     */
    public function delete(User $user, Event $event)
    {
        // Admins can delete any event
        if ($user->role === 'admin') {
            return true;
        }

        // Organizers can delete their own events
        if ($user->role === 'organizer' && $user->id === $event->organizer_id) {
            return true;
        }

        return false;  // By default, deny access
    }
}
