<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HeroSection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class HeroSectionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $heroSections = HeroSection::orderBy('created_at', 'desc')->get();
        return view('admin.hero-sections.index', compact('heroSections'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.hero-sections.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'subtitle' => 'required|string',
            'button_text' => 'required|string|max:255',
            'button_url' => 'required|string|max:255',
            'background_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:5120',
            'is_active' => 'boolean',
        ]);

        $validated['is_active'] = $request->has('is_active');

        // Handle file upload
        if ($request->hasFile('background_image')) {
            $image = $request->file('background_image');
            $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
            $storedPath = $image->storeAs('images/hero', $imageName, 'public');
            if ($storedPath) {
                $validated['background_image'] = $storedPath;
            } else {
                $validated['background_image'] = null;
            }
        } else {
            $validated['background_image'] = null;
        }

        HeroSection::create($validated);

        return redirect()
            ->route('admin.hero-sections.index')
            ->with('success', 'Hero section created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(HeroSection $heroSection)
    {
        return view('admin.hero-sections.edit', compact('heroSection'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, HeroSection $heroSection)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'subtitle' => 'required|string',
            'button_text' => 'required|string|max:255',
            'button_url' => 'required|string|max:255',
            'background_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:5120',
            'is_active' => 'boolean',
        ]);

        $validated['is_active'] = $request->has('is_active');

        // Handle file upload
        if ($request->hasFile('background_image')) {
            // Delete old image if exists
            if ($heroSection->background_image) {
                Storage::disk('public')->delete(ltrim($heroSection->background_image, '/'));
            }

            $image = $request->file('background_image');
            $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
            $storedPath = $image->storeAs('images/hero', $imageName, 'public');
            $validated['background_image'] = $storedPath ?: $heroSection->background_image;
        } else {
            // Keep existing image if no new file uploaded
            $validated['background_image'] = $heroSection->background_image;
        }

        $heroSection->update($validated);

        return redirect()
            ->route('admin.hero-sections.index')
            ->with('success', 'Hero section updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(HeroSection $heroSection)
    {
        // Delete image file if exists
        if ($heroSection->background_image) {
            Storage::disk('public')->delete(ltrim($heroSection->background_image, '/'));
        }

        $heroSection->delete();

        return redirect()
            ->route('admin.hero-sections.index')
            ->with('success', 'Hero section deleted successfully.');
    }
}
