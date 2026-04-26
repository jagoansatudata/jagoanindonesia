<?php

namespace App\Http\Controllers;

use App\Models\InternExperience;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class InternExperienceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $experiences = InternExperience::ordered()->paginate(10);
        return view('admin.intern-experiences.index', compact('experiences'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.intern-experiences.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'intern_name' => 'required|string|max:255',
            'intern_role' => 'nullable|string|max:255',
            'experience_content' => 'required|string|max:200',
            'rating' => 'required|integer|min:1|max:5',
            'avatar_path' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'is_active' => 'boolean',
            'sort_order' => 'integer|min:0',
        ]);

        if ($request->hasFile('avatar_path')) {
            $avatarPath = $request->file('avatar_path')->store('intern-avatars', 'public');
            $validated['avatar_path'] = $avatarPath;
        }

        $validated['is_active'] = $request->boolean('is_active', true);
        $validated['sort_order'] = $request->integer('sort_order', 0);

        InternExperience::create($validated);

        return redirect()->route('intern-experiences.index')
            ->with('success', 'Intern experience created successfully.');
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
    public function edit(InternExperience $internExperience)
    {
        return view('admin.intern-experiences.edit', compact('internExperience'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, InternExperience $internExperience)
    {
        $validated = $request->validate([
            'intern_name' => 'required|string|max:255',
            'intern_role' => 'nullable|string|max:255',
            'experience_content' => 'required|string|max:200',
            'rating' => 'required|integer|min:1|max:5',
            'avatar_path' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'is_active' => 'boolean',
            'sort_order' => 'integer|min:0',
        ]);

        if ($request->hasFile('avatar_path')) {
            if ($internExperience->avatar_path) {
                Storage::disk('public')->delete(ltrim($internExperience->avatar_path, '/'));
            }

            $avatarPath = $request->file('avatar_path')->store('intern-avatars', 'public');
            $validated['avatar_path'] = $avatarPath;
        }

        $validated['is_active'] = $request->boolean('is_active', true);
        $validated['sort_order'] = $request->integer('sort_order', 0);

        $internExperience->update($validated);

        return redirect()->route('intern-experiences.index')
            ->with('success', 'Intern experience updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(InternExperience $internExperience)
    {
        if ($internExperience->avatar_path) {
            Storage::disk('public')->delete(ltrim($internExperience->avatar_path, '/'));
        }

        $internExperience->delete();

        return redirect()->route('intern-experiences.index')
            ->with('success', 'Intern experience deleted successfully.');
    }

    public function toggle(InternExperience $internExperience)
    {
        $internExperience->update(['is_active' => !$internExperience->is_active]);

        $status = $internExperience->is_active ? 'activated' : 'deactivated';
        return redirect()->route('intern-experiences.index')
            ->with('success', "Intern experience {$status} successfully.");
    }
}
