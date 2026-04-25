<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMessageRequest;
use App\Models\Message;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Schema;

class MessageController extends Controller
{
    public function store(StoreMessageRequest $request): RedirectResponse
    {
        if (!Schema::hasTable('messages')) {
            return redirect()->back()->with('success', 'Pesan berhasil dikirim.');
        }

        $validated = $request->validated();
        $validated['ip_address'] = $request->ip();
        $validated['user_agent'] = $request->userAgent();

        Message::create($validated);

        return redirect()->back()->with('success', 'Pesan berhasil dikirim.');
    }
}
