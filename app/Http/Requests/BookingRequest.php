<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

class BookingRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'nullable|string|max:255',
            'start_date' => 'required|date|after_or_equal:today',
            'end_date' => 'required|date|after_or_equal:start_date',
            'address' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:255',
            'zip' => 'nullable|string|max:10',
            'payment_method' => 'nullable|string|in:midtrans,paypal,bank_transfer',
            'payment_status' => 'nullable|string|in:pending,paid,failed',
            'payment_url' => 'nullable|url',
            'total_price' => 'required|integer|min:0',
            'item_id' => 'required|exists:items,id',
            'user_id' => 'required|exists:users,id',
        ];
    }
}
