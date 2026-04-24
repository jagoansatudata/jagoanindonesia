<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ActivityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $activities = Activity::query()
            ->orderBy('sort_order')
            ->orderByDesc('created_at')
            ->paginate(15);

        return view('admin.activities.index', compact('activities'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.activities.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255', 'unique:activities,slug'],
            'category' => ['nullable', 'string', 'max:255'],
            'image' => ['nullable', 'image', 'max:2048'],
            'is_published' => ['nullable', 'boolean'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
        ]);

        $slug = $validated['slug'] ?? Str::slug($validated['title']);
        if (Activity::where('slug', $slug)->exists()) {
            $slug = $slug.'-'.Str::random(6);
        }

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('activities', 'public');
        }

        Activity::create([
            'title' => $validated['title'],
            'slug' => $slug,
            'category' => $validated['category'] ?? null,
            'image_path' => $imagePath,
            'is_published' => (bool) ($validated['is_published'] ?? false),
            'sort_order' => (int) ($validated['sort_order'] ?? 0),
        ]);

        return redirect()->route('admin.activities.index')->with('status', 'Activity created');
    }

    /**
     * Display the specified resource.
     */
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Activity $activity)
    {
        return view('admin.activities.edit', compact('activity'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Activity $activity)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255', 'unique:activities,slug,'.$activity->id],
            'category' => ['nullable', 'string', 'max:255'],
            'image' => ['nullable', 'image', 'max:2048'],
            'is_published' => ['nullable', 'boolean'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'remove_image' => ['nullable', 'boolean'],
        ]);

        $slug = $validated['slug'] ?? Str::slug($validated['title']);
        if (Activity::where('slug', $slug)->where('id', '!=', $activity->id)->exists()) {
            $slug = $slug.'-'.Str::random(6);
        }

        if (!empty($validated['remove_image']) && $activity->image_path) {
            Storage::disk('public')->delete($activity->image_path);
            $activity->image_path = null;
        }

        if ($request->hasFile('image')) {
            if ($activity->image_path) {
                Storage::disk('public')->delete($activity->image_path);
            }
            $activity->image_path = $request->file('image')->store('activities', 'public');
        }

        $activity->fill([
            'title' => $validated['title'],
            'slug' => $slug,
            'category' => $validated['category'] ?? null,
            'is_published' => (bool) ($validated['is_published'] ?? false),
            'sort_order' => (int) ($validated['sort_order'] ?? 0),
        ]);
        $activity->save();

        return redirect()->route('admin.activities.index')->with('status', 'Activity updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Activity $activity)
    {
        if ($activity->image_path) {
            Storage::disk('public')->delete($activity->image_path);
        }

        $activity->delete();

        return redirect()->route('admin.activities.index')->with('status', 'Activity deleted');
    }
}
