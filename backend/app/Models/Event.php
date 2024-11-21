<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 
        'description', 
        'date', 
        'location', 
        'organizer_id'
    ];

    public function organizer() {
        return $this->belongsTo(User::class, 'organizer_id');
    }

    public function tickets() {
        return $this->hasMany(Ticket::class);
    }

    public function feedback() {
        return $this->hasMany(Feedback::class);
    }
}
