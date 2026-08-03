<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\EnquiryMail;

class ContactController
{
    public function send(Request $request)
    {
        $validated = $request->validate([
            'name'    => 'required|string|max:100',
            'phone'   => 'nullable|string|max:20',
            'email'   => 'required|email|max:100',
            'service' => 'nullable|string|max:100',
            'message' => 'required|string|max:2000',
        ]);

        $enquiry = [
            'name'    => $validated['name'],
            'phone'   => $validated['phone'] ?? null,
            'email'   => $validated['email'],
            'service' => $validated['service'] ?? null,
            'message' => $validated['message'],
        ];

        // Send email to admin
        Mail::to(config('mail.from.address'))->send(new EnquiryMail($enquiry));

        return back()->with('success', 'Thank you! Your enquiry has been received. We will be in touch shortly.');
    }
}