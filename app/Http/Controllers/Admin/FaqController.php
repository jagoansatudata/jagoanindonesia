<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Faq\StoreFaqRequest;
use App\Http\Requests\Faq\UpdateFaqRequest;
use App\Models\Faq;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class FaqController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $faqs = Faq::ordered()->paginate(10);
        return view('admin.faqs.index', compact('faqs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('admin.faqs.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreFaqRequest $request): RedirectResponse
    {
        $validated = $request->validated();
        
        // Get the highest sort_order and increment
        $maxSortOrder = Faq::max('sort_order') ?? 0;
        $validated['sort_order'] = $maxSortOrder + 1;
        
        Faq::create($validated);
        
        return redirect()
            ->route('admin.faqs.index')
            ->with('success', 'FAQ berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Faq $faq): View
    {
        return view('admin.faqs.show', compact('faq'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Faq $faq): View
    {
        return view('admin.faqs.edit', compact('faq'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateFaqRequest $request, Faq $faq): RedirectResponse
    {
        $validated = $request->validated();
        $faq->update($validated);
        
        return redirect()
            ->route('admin.faqs.index')
            ->with('success', 'FAQ berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Faq $faq): RedirectResponse
    {
        $faq->delete();
        
        return redirect()
            ->route('admin.faqs.index')
            ->with('success', 'FAQ berhasil dihapus!');
    }

    /**
     * Toggle the published status of the FAQ.
     */
    public function togglePublished(Faq $faq): RedirectResponse
    {
        $faq->update(['is_published' => !$faq->is_published]);
        
        return redirect()
            ->route('admin.faqs.index')
            ->with('success', 'Status FAQ berhasil diperbarui!');
    }

    /**
     * Reorder FAQs.
     */
    public function reorder(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'faqs' => 'required|array',
            'faqs.*.id' => 'required|exists:faqs,id',
            'faqs.*.sort_order' => 'required|integer|min:1',
        ]);

        foreach ($validated['faqs'] as $faqData) {
            Faq::where('id', $faqData['id'])
                ->update(['sort_order' => $faqData['sort_order']]);
        }

        return redirect()
            ->route('admin.faqs.index')
            ->with('success', 'Urutan FAQ berhasil diperbarui!');
    }
}
