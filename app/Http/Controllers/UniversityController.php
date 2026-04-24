<?php

namespace App\Http\Controllers;

use App\Models\University;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class UniversityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $universities = University::ordered()->get();
        return view('admin.universities.index', compact('universities'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.universities.create');
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

        $university = new University();
        $university->name = $validated['name'];
        $university->website_url = $validated['website_url'] ?? null;
        $university->description = $validated['description'] ?? null;
        $university->is_active = $validated['is_active'] ?? true;
        $university->sort_order = $validated['sort_order'] ?? 0;

        if ($request->hasFile('logo')) {
            $logoPath = $request->file('logo')->store('universities', 'public');
            $university->logo_path = $logoPath;
        }

        $university->save();

        return redirect()->route('universities.index')
            ->with('success', 'University created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(University $university)
    {
        return view('admin.universities.show', compact('university'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(University $university)
    {
        return view('admin.universities.edit', compact('university'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, University $university)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'website_url' => 'nullable|url',
            'description' => 'nullable|string',
            'is_active' => 'boolean',
            'sort_order' => 'integer|min:0'
        ]);

        $university->name = $validated['name'];
        $university->website_url = $validated['website_url'] ?? null;
        $university->description = $validated['description'] ?? null;
        $university->is_active = $validated['is_active'] ?? true;
        $university->sort_order = $validated['sort_order'] ?? 0;

        if ($request->hasFile('logo')) {
            // Delete old logo if exists
            if ($university->logo_path) {
                Storage::disk('public')->delete($university->logo_path);
            }
            
            $logoPath = $request->file('logo')->store('universities', 'public');
            $university->logo_path = $logoPath;
        }

        $university->save();

        return redirect()->route('universities.index')
            ->with('success', 'University updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(University $university)
    {
        // Delete logo if exists
        if ($university->logo_path) {
            Storage::disk('public')->delete($university->logo_path);
        }

        $university->delete();

        return redirect()->route('universities.index')
            ->with('success', 'University deleted successfully.');
    }

    /**
     * Get active universities for public display
     */
    public function getActiveUniversities()
    {
        $universities = University::active()->ordered()->get();
        return response()->json($universities);
    }
}
