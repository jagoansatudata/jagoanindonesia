<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\ActivityController as AdminActivityController;
use App\Http\Controllers\Admin\BlogAnalyticsController;
use App\Http\Controllers\Admin\BlogCategoryController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\CommentController as AdminCommentController;
use App\Http\Controllers\Admin\CareerStatsController;
use App\Http\Controllers\Admin\FaqController;
use App\Http\Controllers\Admin\HeroSectionController;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\MessageController as AdminMessageController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ClientReviewController;
use App\Http\Controllers\InternExperienceController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\TeamMemberController;
use App\Http\Controllers\UniversityController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/storage/team/{filename}', function (string $filename) {
    $filename = basename($filename);
    $path = 'team/' . $filename;

    if (!Storage::disk('public')->exists($path)) {
        abort(404);
    }

    return response()->file(Storage::disk('public')->path($path));
})->where('filename', '[^/]+');

Route::get('/storage/activities/{filename}', function (string $filename) {
    $filename = basename($filename);
    $path = 'activities/' . $filename;

    if (!Storage::disk('public')->exists($path)) {
        abort(404);
    }

    return response()->file(Storage::disk('public')->path($path));
})->where('filename', '[^/]+');

Route::get('/storage/clients/{filename}', function (string $filename) {
    $filename = basename($filename);
    $path = 'clients/' . $filename;

    if (!Storage::disk('public')->exists($path)) {
        abort(404);
    }

    return response()->file(Storage::disk('public')->path($path));
})->where('filename', '[^/]+');

Route::get('/storage/images/blog/{filename}', function (string $filename) {
    $filename = basename($filename);
    $path = 'images/blog/' . $filename;

    if (!Storage::disk('public')->exists($path)) {
        abort(404);
    }

    return response()->file(Storage::disk('public')->path($path));
})->where('filename', '[^/]+');

Route::get('/storage/images/blog/content/{filename}', function (string $filename) {
    $filename = basename($filename);
    $path = 'images/blog/content/' . $filename;

    if (!Storage::disk('public')->exists($path)) {
        abort(404);
    }

    return response()->file(Storage::disk('public')->path($path));
})->where('filename', '[^/]+');

Route::get('/career', [HomeController::class, 'career'])->name('career');

Route::get('/news', [NewsController::class, 'index'])->name('news');
Route::get('/news/{slug}', [NewsController::class, 'show'])->name('news.show');
Route::post('/news/{slug}/comments', [NewsController::class, 'storeComment'])->name('news.comments.store');

Route::post('/messages', [MessageController::class, 'store'])->name('messages.store');

// CKEditor Image Upload Route
Route::post('/admin/upload-image', function (Illuminate\Http\Request $request) {
    $request->validate([
        'upload' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
    ]);

    if ($request->hasFile('upload')) {
        $file = $request->file('upload');
        $filename = time() . '.' . $file->getClientOriginalExtension();
        $path = $file->storeAs('images/blog/content', $filename, 'public');
        if (!$path) {
            return response()->json(['error' => 'Failed to store file'], 500);
        }

        $url = asset('storage/' . $path);
        
        return response()->json([
            'url' => $url
        ]);
    }
    
    return response()->json(['error' => 'No file uploaded'], 400);
})->middleware(['auth', 'admin'])->name('admin.upload.image');

Route::get('/dashboard', [App\Http\Controllers\Admin\AdminController::class, 'dashboard'])->middleware(['auth', 'verified', 'page.access:admin.dashboard'])->name('dashboard');

Route::prefix('admin')->middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');

    Route::resource('activities', AdminActivityController::class)
        ->names('admin.activities')
        ->except(['show']);

    Route::resource('users', UserController::class)->names('admin.users')->except(['show']);

    Route::resource('pages', PageController::class)->names('admin.pages')->except(['show']);
    Route::patch('pages/{page}/toggle', [PageController::class, 'toggleStatus'])->name('admin.pages.toggle');
    Route::patch('pages/{page}/users/{user}', [PageController::class, 'toggleUserAccess'])->name('admin.pages.toggle-user');
    Route::patch('pages/{page}/bulk-toggle', [PageController::class, 'bulkToggleUserAccess'])->name('admin.pages.bulk-toggle');

    Route::resource('clients', ClientController::class)->names('clients');

    Route::resource('team-members', TeamMemberController::class)->names('team-members');

    Route::resource('client-reviews', ClientReviewController::class)->names('client-reviews');
    Route::patch('client-reviews/{clientReview}/toggle', [ClientReviewController::class, 'toggle'])->name('client-reviews.toggle');

    Route::resource('universities', UniversityController::class)->names('universities');

    Route::resource('intern-experiences', InternExperienceController::class)
        ->names('intern-experiences')
        ->except(['show']);
    Route::patch('intern-experiences/{internExperience}/toggle', [InternExperienceController::class, 'toggle'])
        ->name('intern-experiences.toggle');

    Route::resource('faqs', FaqController::class)->names('admin.faqs');
    Route::patch('faqs/{faq}/toggle-published', [FaqController::class, 'togglePublished'])->name('admin.faqs.toggle-published');
    Route::post('faqs/reorder', [FaqController::class, 'reorder'])->name('admin.faqs.reorder');

    Route::resource('career-stats', CareerStatsController::class)->names('admin.career-stats');
    Route::patch('career-stats/{careerStat}/toggle', [CareerStatsController::class, 'toggle'])->name('admin.career-stats.toggle');

    Route::resource('hero-sections', HeroSectionController::class)->names('admin.hero-sections')->except(['show']);

    Route::delete('blogs/bulk-delete', [BlogController::class, 'bulkDelete'])->name('admin.blogs.bulk-delete');
    Route::post('blogs/bulk-restore', [BlogController::class, 'bulkRestore'])->name('admin.blogs.bulk-restore');
    Route::delete('blogs/bulk-force-delete', [BlogController::class, 'bulkForceDelete'])->name('admin.blogs.bulk-force-delete');
    Route::resource('blogs', BlogController::class)->names('admin.blogs');
    Route::patch('blogs/{blog}/restore', [BlogController::class, 'restore'])->name('admin.blogs.restore');
    Route::delete('blogs/{blog}/force-delete', [BlogController::class, 'forceDelete'])->name('admin.blogs.force-delete');

    Route::resource('blog-categories', BlogCategoryController::class)->names('admin.blog-categories');
    Route::patch('blog-categories/{blogCategory}/restore', [BlogCategoryController::class, 'restore'])->name('admin.blog-categories.restore');
    Route::delete('blog-categories/{blogCategory}/force-delete', [BlogCategoryController::class, 'forceDelete'])->name('admin.blog-categories.force-delete');

    Route::get('comments', [AdminCommentController::class, 'index'])->name('admin.comments.index');
    Route::get('comments/{comment}', [AdminCommentController::class, 'show'])->name('admin.comments.show');
    Route::patch('comments/{comment}/toggle', [AdminCommentController::class, 'toggle'])->name('admin.comments.toggle');
    Route::delete('comments/{comment}', [AdminCommentController::class, 'destroy'])->name('admin.comments.destroy');
    Route::post('comments/batch', [AdminCommentController::class, 'batch'])->name('admin.comments.batch');

    Route::get('messages', [AdminMessageController::class, 'index'])->name('admin.messages.index');
    Route::get('messages/{message}', [AdminMessageController::class, 'show'])->name('admin.messages.show');
    Route::patch('messages/{message}/toggle', [AdminMessageController::class, 'toggle'])->name('admin.messages.toggle');
    Route::delete('messages/{message}', [AdminMessageController::class, 'destroy'])->name('admin.messages.destroy');
    Route::post('messages/batch', [AdminMessageController::class, 'batch'])->name('admin.messages.batch');

    // Analytics Routes
    Route::get('analytics/blogs', [BlogAnalyticsController::class, 'index'])->name('admin.analytics.blogs');
    Route::get('analytics/blogs/chart-data', [BlogAnalyticsController::class, 'getChartData'])->name('admin.analytics.blogs.chart-data');
    Route::get('analytics/blogs/export', [BlogAnalyticsController::class, 'export'])->name('admin.analytics.blogs.export');
});

Route::get('/api/clients', [ClientController::class, 'getActiveClients'])->name('clients.api');

Route::get('/api/universities', [UniversityController::class, 'getActiveUniversities'])->name('universities.api');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
