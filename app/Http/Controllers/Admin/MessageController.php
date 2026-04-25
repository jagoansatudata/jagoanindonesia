<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

class MessageController extends Controller
{
    public function index(Request $request)
    {
        if (!Schema::hasTable('messages')) {
            return view('admin.messages.index', ['messages' => collect()->paginate(15)]);
        }

        $query = Message::query()->latest();

        if ($request->filled('status')) {
            if ($request->get('status') === 'unread') {
                $query->where('is_read', false);
            }

            if ($request->get('status') === 'read') {
                $query->where('is_read', true);
            }
        }

        if ($request->filled('q')) {
            $q = $request->get('q');
            $query->where(function ($sub) use ($q) {
                $sub
                    ->where('name', 'like', "%{$q}%")
                    ->orWhere('email', 'like', "%{$q}%")
                    ->orWhere('phone', 'like', "%{$q}%")
                    ->orWhere('message', 'like', "%{$q}%");
            });
        }

        $messages = $query->paginate(15)->withQueryString();

        return view('admin.messages.index', compact('messages'));
    }

    public function show(Message $message)
    {
        if (!Schema::hasTable('messages')) {
            return redirect()->route('admin.messages.index')->with('success', 'Messages feature is not available yet. Please run migrations.');
        }

        if (!$message->is_read) {
            $message->is_read = true;
            $message->read_at = now();
            $message->save();
        }

        return view('admin.messages.show', compact('message'));
    }

    public function toggle(Message $message)
    {
        if (!Schema::hasTable('messages')) {
            return redirect()->back()->with('success', 'Messages feature is not available yet. Please run migrations.');
        }

        $message->is_read = !$message->is_read;
        $message->read_at = $message->is_read ? now() : null;
        $message->save();

        return redirect()->back()->with('success', 'Message updated successfully.');
    }

    public function destroy(Message $message)
    {
        if (!Schema::hasTable('messages')) {
            return redirect()->back()->with('success', 'Messages feature is not available yet. Please run migrations.');
        }

        $message->delete();

        return redirect()->back()->with('success', 'Message deleted successfully.');
    }

    public function batch(Request $request)
    {
        if (!Schema::hasTable('messages')) {
            return redirect()->back()->with('success', 'Messages feature is not available yet. Please run migrations.');
        }

        $request->validate([
            'action' => 'required|in:read,unread,delete',
            'ids' => 'required|string',
        ]);

        $ids = explode(',', $request->input('ids'));
        $messages = Message::whereIn('id', $ids)->get();

        $count = 0;
        foreach ($messages as $message) {
            switch ($request->action) {
                case 'read':
                    $message->is_read = true;
                    $message->read_at = now();
                    $message->save();
                    $count++;
                    break;
                case 'unread':
                    $message->is_read = false;
                    $message->read_at = null;
                    $message->save();
                    $count++;
                    break;
                case 'delete':
                    $message->delete();
                    $count++;
                    break;
            }
        }

        $flash = match ($request->action) {
            'read' => "Marked {$count} message(s) as read successfully.",
            'unread' => "Marked {$count} message(s) as unread successfully.",
            'delete' => "Deleted {$count} message(s) successfully.",
        };

        return redirect()->back()->with('success', $flash);
    }
}
