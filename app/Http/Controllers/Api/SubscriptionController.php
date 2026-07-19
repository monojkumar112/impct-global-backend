<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Subscription;
use Illuminate\Http\Request;

class SubscriptionController extends Controller
{
    public function store(Request $request)
    {
        $request->merge([
            'email' => strtolower(trim((string) $request->input('email', ''))),
        ]);

        $validated = $request->validate([
            'email' => ['required', 'email', 'max:255', 'unique:subscriptions,email'],
        ], [
            'email.unique' => 'This email is already subscribed.',
        ]);

        Subscription::create([
            'email' => $validated['email'],
            'status' => true,
        ]);

        return response()->json([
            'message' => 'Thank you for subscribing!',
        ], 201);
    }
}
