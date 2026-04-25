<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TeamMember;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class TeamMemberController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $teamMembers = TeamMember::orderBy('order')->orderBy('name')->get();
        return view('admin.team-members.index', compact('teamMembers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.team-members.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'order' => 'nullable|integer|min:0',
            'is_active' => 'boolean'
        ]);

        if ($request->hasFile('photo')) {
            $photo = $request->file('photo');
            $photoName = time() . '_' . Str::random(10) . '.' . $photo->getClientOriginalExtension();

            $destinationPath = public_path('images/team');
            File::ensureDirectoryExists($destinationPath);

            $photo->move($destinationPath, $photoName);
            $validated['photo'] = $photoName;
        }

        $validated['order'] = $validated['order'] ?? 0;
        $validated['is_active'] = $validated['is_active'] ?? true;

        TeamMember::create($validated);

        return redirect()->route('team-members.index')
            ->with('success', 'Team member created successfully.');
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
    public function edit(TeamMember $teamMember)
    {
        return view('admin.team-members.edit', compact('teamMember'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TeamMember $teamMember)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'order' => 'nullable|integer|min:0',
            'is_active' => 'boolean'
        ]);

        if ($request->hasFile('photo')) {
            // Delete old photo
            if ($teamMember->photo && file_exists(public_path('images/team/' . $teamMember->photo))) {
                unlink(public_path('images/team/' . $teamMember->photo));
            }

            $photo = $request->file('photo');
            $photoName = time() . '_' . Str::random(10) . '.' . $photo->getClientOriginalExtension();

            $destinationPath = public_path('images/team');
            File::ensureDirectoryExists($destinationPath);

            $photo->move($destinationPath, $photoName);
            $validated['photo'] = $photoName;
        }

        $validated['order'] = $validated['order'] ?? $teamMember->order;
        $validated['is_active'] = $validated['is_active'] ?? $teamMember->is_active;

        $teamMember->update($validated);

        return redirect()->route('team-members.index')
            ->with('success', 'Team member updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TeamMember $teamMember)
    {
        // Delete photo
        if ($teamMember->photo && file_exists(public_path('images/team/' . $teamMember->photo))) {
            unlink(public_path('images/team/' . $teamMember->photo));
        }

        $teamMember->delete();

        return redirect()->route('team-members.index')
            ->with('success', 'Team member deleted successfully.');
    }
}
