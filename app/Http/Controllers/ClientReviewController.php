<?php

namespace App\Http\Controllers;

use App\Models\ClientReview;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ClientReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $reviews = ClientReview::active()->ordered()->paginate(10);
        return view('admin.client-reviews.index', compact('reviews'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.client-reviews.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'reviewer_name' => 'required|string|max:255',
            'reviewer_title' => 'nullable|string|max:255',
            'review_content' => 'required|string|max:1000',
            'rating' => 'required|integer|min:1|max:5',
            'avatar_path' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'is_active' => 'boolean',
            'sort_order' => 'integer|min:0'
        ]);

        if ($request->hasFile('avatar_path')) {
            $avatarPath = $request->file('avatar_path')->store('avatars', 'public');
            $validated['avatar_path'] = $avatarPath;
        }

        $validated['is_active'] = $request->boolean('is_active', true);
        $validated['sort_order'] = $request->integer('sort_order', 0);

        ClientReview::create($validated);

        return redirect()->route('client-reviews.index')
            ->with('success', 'Client review created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ClientReview $clientReview)
    {
        return view('admin.client-reviews.edit', compact('clientReview'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ClientReview $clientReview)
    {
        $validated = $request->validate([
            'reviewer_name' => 'required|string|max:255',
            'reviewer_title' => 'nullable|string|max:255',
            'review_content' => 'required|string|max:1000',
            'rating' => 'required|integer|min:1|max:5',
            'avatar_path' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'is_active' => 'boolean',
            'sort_order' => 'integer|min:0'
        ]);

        if ($request->hasFile('avatar_path')) {
            // Delete old avatar if exists
            if ($clientReview->avatar_path) {
                Storage::disk('public')->delete(ltrim($clientReview->avatar_path, '/'));
            }
            
            $avatarPath = $request->file('avatar_path')->store('avatars', 'public');
            $validated['avatar_path'] = $avatarPath;
        }

        $validated['is_active'] = $request->boolean('is_active', true);
        $validated['sort_order'] = $request->integer('sort_order', 0);

        $clientReview->update($validated);

        return redirect()->route('client-reviews.index')
            ->with('success', 'Client review updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ClientReview $clientReview)
    {
        // Delete avatar if exists
        if ($clientReview->avatar_path) {
            Storage::disk('public')->delete(ltrim($clientReview->avatar_path, '/'));
        }

        $clientReview->delete();

        return redirect()->route('client-reviews.index')
            ->with('success', 'Client review deleted successfully.');
    }

    /**
     * Toggle the active status of the specified resource.
     */
    public function toggle(ClientReview $clientReview)
    {
        $clientReview->update(['is_active' => !$clientReview->is_active]);
        
        $status = $clientReview->is_active ? 'activated' : 'deactivated';
        return redirect()->route('client-reviews.index')
            ->with('success', "Client review {$status} successfully.");
    }
}
