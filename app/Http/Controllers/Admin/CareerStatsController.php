<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CareerStats;
use Illuminate\Http\Request;

class CareerStatsController extends Controller
{
    public function index()
    {
        $careerStats = CareerStats::ordered()->get();
        return view('admin.career-stats.index', compact('careerStats'));
    }

    public function create()
    {
        return view('admin.career-stats.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'value' => 'required|string|max:255',
            'description' => 'required|string',
            'icon_path' => 'nullable|string|max:255',
            'sort_order' => 'nullable|integer|min:0',
            'is_active' => 'boolean',
        ]);

        $validated['sort_order'] = $validated['sort_order'] ?? 0;
        $validated['is_active'] = $validated['is_active'] ?? true;

        CareerStats::create($validated);

        return redirect()
            ->route('admin.career-stats.index')
            ->with('success', 'Career statistics created successfully.');
    }

    public function edit(CareerStats $careerStat)
    {
        return view('admin.career-stats.edit', compact('careerStat'));
    }

    public function update(Request $request, CareerStats $careerStat)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'value' => 'required|string|max:255',
            'description' => 'required|string',
            'icon_path' => 'nullable|string|max:255',
            'sort_order' => 'nullable|integer|min:0',
            'is_active' => 'boolean',
        ]);

        $validated['sort_order'] = $validated['sort_order'] ?? 0;
        $validated['is_active'] = $validated['is_active'] ?? true;

        $careerStat->update($validated);

        return redirect()
            ->route('admin.career-stats.index')
            ->with('success', 'Career statistics updated successfully.');
    }

    public function destroy(CareerStats $careerStat)
    {
        $careerStat->delete();

        return redirect()
            ->route('admin.career-stats.index')
            ->with('success', 'Career statistics deleted successfully.');
    }

    public function toggle(CareerStats $careerStat)
    {
        $careerStat->update(['is_active' => !$careerStat->is_active]);

        return redirect()
            ->route('admin.career-stats.index')
            ->with('success', 'Career statistics status updated successfully.');
    }
}
