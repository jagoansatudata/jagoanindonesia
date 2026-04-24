<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

class CommentController extends Controller
{
    public function index(Request $request)
    {
        if (!Schema::hasTable('comments')) {
            return view('admin.comments.index', ['comments' => collect()->paginate(15)]);
        }

        $query = Comment::query()
            ->with(['blog', 'parent'])
            ->latest();

        if ($request->filled('blog_id')) {
            $query->where('blog_id', $request->integer('blog_id'));
        }

        if ($request->filled('status')) {
            if ($request->get('status') === 'approved') {
                $query->where('is_approved', true);
            }

            if ($request->get('status') === 'pending') {
                $query->where('is_approved', false);
            }
        }

        $comments = $query->paginate(15)->withQueryString();

        return view('admin.comments.index', compact('comments'));
    }

    public function show(Comment $comment)
    {
        if (!Schema::hasTable('comments')) {
            return redirect()->route('admin.comments.index')->with('success', 'Comments feature is not available yet. Please run migrations.');
        }

        $comment->load(['blog', 'parent', 'approvedReplies', 'user']);

        return view('admin.comments.show', compact('comment'));
    }

    public function toggle(Comment $comment)
    {
        if (!Schema::hasTable('comments')) {
            return redirect()->back()->with('success', 'Comments feature is not available yet. Please run migrations.');
        }

        $comment->is_approved = !$comment->is_approved;
        $comment->approved_at = $comment->is_approved ? now() : null;
        $comment->save();

        return redirect()->back()->with('success', 'Comment updated successfully.');
    }

    public function destroy(Comment $comment)
    {
        if (!Schema::hasTable('comments')) {
            return redirect()->back()->with('success', 'Comments feature is not available yet. Please run migrations.');
        }

        $comment->delete();

        return redirect()->back()->with('success', 'Comment deleted successfully.');
    }

    public function batch(Request $request)
    {
        if (!Schema::hasTable('comments')) {
            return redirect()->back()->with('success', 'Comments feature is not available yet. Please run migrations.');
        }

        $request->validate([
            'action' => 'required|in:approve,unapprove,delete',
            'ids' => 'required|string',
        ]);

        $ids = explode(',', $request->input('ids'));
        $comments = Comment::whereIn('id', $ids)->get();

        $count = 0;
        foreach ($comments as $comment) {
            switch ($request->action) {
                case 'approve':
                    $comment->is_approved = true;
                    $comment->approved_at = now();
                    $comment->save();
                    $count++;
                    break;
                case 'unapprove':
                    $comment->is_approved = false;
                    $comment->approved_at = null;
                    $comment->save();
                    $count++;
                    break;
                case 'delete':
                    $comment->delete();
                    $count++;
                    break;
            }
        }

        $message = match ($request->action) {
            'approve' => "Approved {$count} comment(s) successfully.",
            'unapprove' => "Unapproved {$count} comment(s) successfully.",
            'delete' => "Deleted {$count} comment(s) successfully.",
        };

        return redirect()->back()->with('success', $message);
    }
}
