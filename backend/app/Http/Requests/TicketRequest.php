<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TicketRequest extends FormRequest
{
    public function authorize()
    {
        return true;  
    }

    public function rules()
    {
        return [
            'price' => 'required|numeric|min:0',
            'status' => 'required|in:booked,cancelled',
        ];
    }
}

