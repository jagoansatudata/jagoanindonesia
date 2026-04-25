<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $clients = Client::ordered()->get();
        return view('admin.clients.index', compact('clients'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.clients.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'website_url' => 'nullable|url',
            'description' => 'nullable|string',
            'is_active' => 'boolean',
            'sort_order' => 'integer|min:0'
        ]);

        $client = new Client();
        $client->name = $validated['name'];
        $client->website_url = $validated['website_url'] ?? null;
        $client->description = $validated['description'] ?? null;
        $client->is_active = $validated['is_active'] ?? true;
        $client->sort_order = $validated['sort_order'] ?? 0;

        if ($request->hasFile('logo')) {
            $logoPath = $request->file('logo')->store('clients', 'public');
            if (!$logoPath) {
                return back()->withInput()->withErrors([
                    'logo' => 'Failed to upload logo. Please try again.'
                ]);
            }

            $client->logo_path = $logoPath;
        }

        $client->save();

        return redirect()->route('clients.index')
            ->with('success', 'Client created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Client $client)
    {
        return view('admin.clients.show', compact('client'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Client $client)
    {
        return view('admin.clients.edit', compact('client'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Client $client)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'website_url' => 'nullable|url',
            'description' => 'nullable|string',
            'is_active' => 'boolean',
            'sort_order' => 'integer|min:0'
        ]);

        $client->name = $validated['name'];
        $client->website_url = $validated['website_url'] ?? null;
        $client->description = $validated['description'] ?? null;
        $client->is_active = $validated['is_active'] ?? true;
        $client->sort_order = $validated['sort_order'] ?? 0;

        if ($request->hasFile('logo')) {
            $newLogoPath = $request->file('logo')->store('clients', 'public');
            if (!$newLogoPath) {
                return back()->withInput()->withErrors([
                    'logo' => 'Failed to upload logo. Please try again.'
                ]);
            }

            // Delete old logo (only after new upload success)
            if ($client->logo_path) {
                Storage::disk('public')->delete($client->logo_path);
            }

            $client->logo_path = $newLogoPath;
        }

        $client->save();

        return redirect()->route('clients.index')
            ->with('success', 'Client updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Client $client)
    {
        // Delete logo if exists
        if ($client->logo_path) {
            Storage::disk('public')->delete($client->logo_path);
        }

        $client->delete();

        return redirect()->route('clients.index')
            ->with('success', 'Client deleted successfully.');
    }

    /**
     * Get active clients for public display
     */
    public function getActiveClients()
    {
        $clients = Client::active()->ordered()->get();
        return response()->json($clients);
    }
}
