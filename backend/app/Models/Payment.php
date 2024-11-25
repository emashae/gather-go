<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'ticket_id', 
        'amount', 
        'payment_status', 
        'payment_method'
    ];

    public function ticket() {
        return $this->belongsTo(Ticket::class);
    }
}
