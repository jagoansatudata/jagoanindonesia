@php
    use App\Models\Blog;
    use Illuminate\Support\Str;
@endphp

@php
    $shareDescription = $news->excerpt ?: Str::limit(strip_tags($news->content ?? ''), 160);
    $shareImage = $news->image_url ?: asset('images/hero/hero-1.jpg');

    $pageTitle = $pageTitle ?? 'News';
    $breadcrumb = $breadcrumb ?? ('Beranda / ' . $pageTitle);
    $indexRouteName = $indexRouteName ?? 'news';
    $showRouteName = $showRouteName ?? 'news.show';
    $commentStoreRouteName = $commentStoreRouteName ?? 'news.comments.store';
@endphp
<x-layouts.app :title="$news->title . ' - Jagoan Indonesia'" :description="$shareDescription" :image="$shareImage" :url="url()->current()" type="article">
    <x-navbar />

    <div class="bg-gray-100 pt-40 pb-12">
        <div class="container mx-auto px-4 flex justify-between items-center">
            <h1 class="text-2xl font-bold text-left">{{ $pageTitle }}</h1>
            <p class="text-gray-600 text-right">{{ $breadcrumb }}</p>
        </div>
    </div>
    
    <div class="pt-12">
        <div class="container mx-auto px-4 py-8">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Main Content -->
            <div class="lg:col-span-2">
                <!-- Article Image -->
                @php
                    $featuredImage = $news->image_url ?: asset('images/hero/hero-1.jpg');
                @endphp
                <div class="w-full h-96 bg-cover bg-center rounded-[16px] mb-8" style="background-image: url('{{ $featuredImage }}');">
                </div>
                
                <!-- Article Title and Meta -->
                <h1 class="text-3xl font-bold text-gray-900 mb-4">{{ $news->title }}</h1>
                
                <div class="flex items-center justify-between text-gray-600 mb-8">
                    <span class="flex items-center gap-2">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M20 21V19C20 17.9391 19.5786 16.9217 18.8284 16.1716C18.0783 15.4214 17.0609 15 16 15H8C6.93913 15 5.92172 15.4214 5.17157 16.1716C4.42143 16.9217 4 17.9391 4 19V21" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            <circle cx="12" cy="7" r="4" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        {{ $news->author ?? 'Admin Jagoan Indonesia' }}
                    </span>
                    <span class="flex items-center gap-2">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <rect x="3" y="4" width="18" height="18" rx="2" ry="2" stroke="currentColor" stroke-width="2"/>
                            <line x1="16" y1="2" x2="16" y2="6" stroke="currentColor" stroke-width="2"/>
                            <line x1="8" y1="2" x2="8" y2="6" stroke="currentColor" stroke-width="2"/>
                            <line x1="3" y1="10" x2="21" y2="10" stroke="currentColor" stroke-width="2"/>
                        </svg>
                        {{ $news->formatted_date ?? '21 Jan 2026' }}
                    </span>
                </div>
                
                <!-- Article Content -->
                <div class="prose prose-lg max-w-none mb-8">
                    {!! $news->rendered_content !!}
                </div>
                
                <!-- Tags -->
                <div class="flex flex-wrap gap-2 mb-8">
                    <span class="inline-flex items-center rounded-[16px] bg-[#F3F5F4] text-gray-800 px-3 py-1 text-sm font-semibold">
                        {{ $news->category }}
                    </span>
                    @if($news->featured)
                        <span class="inline-flex items-center rounded-[16px] bg-[#F3F5F4] text-gray-800 px-3 py-1 text-sm font-semibold">
                            Featured
                        </span>
                    @endif
                </div>
                
                <!-- Share Section -->
                <div class="bg-gray-50 rounded-lg p-6 mb-8">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center gap-2">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M4 12V16C4 16.5304 4.21071 17.0391 4.58579 17.4142C4.96086 17.7893 5.46957 18 6 18H18C18.5304 18 19.0391 17.7893 19.4142 17.4142C19.7893 17.0391 20 16.5304 20 16V12" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M16 8L12 12L8 8" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M12 12V2" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        Share this article
                    </h3>
                    
                    <div class="flex flex-wrap gap-3">
                        <!-- Copy Link -->
                        <button onclick="copyLink()" class="share-btn share-btn--copy" title="Copy link">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M10 13C10 13.5304 10.2107 14.0391 10.5858 14.4142C10.9609 14.7893 11.4696 15 12 15H16C16.5304 15 17.0391 14.7893 17.4142 14.4142C17.7893 14.0391 18 13.5304 18 13V9C18 8.46957 17.7893 7.96086 17.4142 7.58579C17.0391 7.21071 16.5304 7 16 7H12C11.4696 7 10.9609 7.21071 10.5858 7.58579C10.2107 7.96086 10 8.46957 10 9V13Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M6 17C6 17.5304 6.21071 18.0391 6.58579 18.4142C6.96086 18.7893 7.46957 19 8 19H12C12.5304 19 13.0391 18.7893 13.4142 18.4142C13.7893 18.0391 14 17.5304 14 17V13" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M6 11C6 11.5304 6.21071 12.0391 6.58579 12.4142C6.96086 12.7893 7.46957 13 8 13H12C12.5304 13 13.0391 12.7893 13.4142 12.4142C13.7893 12.0391 14 11.5304 14 11V7C14 6.46957 13.7893 5.96086 13.4142 5.58579C13.0391 5.21071 12.5304 5 12 5H8C7.46957 5 6.96086 5.21071 6.58579 5.58579C6.21071 5.96086 6 6.46957 6 7V11Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                            <span>Copy Link</span>
                        </button>
                        
                        <!-- WhatsApp -->
                        <a href="https://wa.me/?text={{ urlencode($news->title . ' - ' . route($showRouteName, $news->slug)) }}" target="_blank" class="share-btn share-btn--whatsapp" title="Share on WhatsApp">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M17.472 14.382C17.136 14.202 15.634 13.466 15.326 13.342C15.018 13.218 14.792 13.156 14.566 13.492C14.34 13.828 13.746 14.522 13.548 14.748C13.35 14.974 13.152 15.008 12.816 14.828C12.48 14.648 11.518 14.342 10.384 13.324C9.504 12.53 8.938 11.55 8.74 11.214C8.542 10.878 8.712 10.68 8.892 10.5C9.058 10.334 9.25 10.08 9.43 9.882C9.61 9.684 9.672 9.514 9.796 9.288C9.92 9.062 9.858 8.864 9.762 8.684C9.666 8.504 9.072 7.002 8.792 6.33C8.512 5.658 8.232 5.734 8.006 5.734C7.78 5.734 7.554 5.734 7.328 5.734C7.102 5.734 6.738 5.816 6.43 6.152C6.122 6.488 5.342 7.224 5.342 8.726C5.342 10.228 6.458 11.688 6.638 11.914C6.818 12.14 9.072 14.682 11.546 15.998C12.342 16.404 13.014 16.64 13.548 16.82C14.344 17.084 15.068 17.042 15.648 16.96C16.298 16.868 17.526 16.204 17.806 15.496C18.086 14.788 18.086 14.178 17.99 14.054C17.894 13.93 17.668 13.848 17.332 13.668L17.472 14.382Z" fill="currentColor"/>
                                <path d="M12 2C6.48 2 2 6.48 2 12C2 16.84 5.44 20.87 10 21.82V18.66C7.93 17.77 6.5 15.67 6.5 13.23C6.5 10.13 9.13 7.5 12.23 7.5C15.33 7.5 17.96 10.13 17.96 13.23C17.96 15.67 16.53 17.77 14.46 18.66V21.82C19.02 20.87 22.46 16.84 22.46 12C22.46 6.48 17.98 2 12.23 2H12Z" fill="currentColor"/>
                            </svg>
                            <span>WhatsApp</span>
                        </a>
                        
                        <!-- Facebook -->
                        <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(route($showRouteName, $news->slug)) }}&title={{ urlencode($news->title) }}" target="_blank" class="share-btn share-btn--facebook" title="Share on Facebook">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M18 2H15C13.6739 2 12.4021 2.52678 11.4645 3.46447C10.5268 4.40215 10 5.67392 10 7V10H7V14H10V22H14V14H17L18 10H14V7C14 6.73478 14.1054 6.48043 14.2929 6.29289C14.4804 6.10536 14.7348 6 15 6H18V2Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                            <span>Facebook</span>
                        </a>
                        
                        <!-- Twitter/X -->
                        <a href="https://twitter.com/intent/tweet?text={{ urlencode($news->title) }}&url={{ urlencode(route($showRouteName, $news->slug)) }}" target="_blank" class="share-btn share-btn--twitter" title="Share on X">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M4 4L11.5 11.5L4 19" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M19 4L11.5 11.5L19 19" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M11.5 11.5L4 4L19 19" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                            <span>X (Twitter)</span>
                        </a>
                        
                        <!-- LinkedIn -->
                        <a href="https://www.linkedin.com/sharing/share-offsite/?url={{ urlencode(route($showRouteName, $news->slug)) }}" target="_blank" class="share-btn share-btn--linkedin" title="Share on LinkedIn">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M16 8C16 6.89543 16.8954 6 18 6C19.1046 6 20 6.89543 20 8C20 9.10457 19.1046 10 18 10C16.8954 10 16 9.10457 16 8Z" fill="currentColor"/>
                                <path d="M13 17V11H16.5V13.5C16.5 14.3284 17.1716 15 18 15C18.8284 15 19.5 14.3284 19.5 13.5V11H20.5C21.3284 11 22 11.6716 22 12.5V17C22 17.8284 21.3284 18.5 20.5 18.5H19.5V17H13Z" fill="currentColor"/>
                                <path d="M2 11H5V18.5H8V11H11V8.5H8V6C8 5.44772 8.44772 5 9 5H11V2.5H9C6.79086 2.5 5 4.29086 5 6.5V8.5H2V11Z" fill="currentColor"/>
                            </svg>
                            <span>LinkedIn</span>
                        </a>
                        
                        <!-- Email -->
                        <a href="mailto:?subject={{ urlencode($news->title) }}&body={{ urlencode('Check out this article: ' . $news->title . ' - ' . route($showRouteName, $news->slug)) }}" class="share-btn share-btn--email" title="Share via Email">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M4 4H20C21.1 4 22 4.9 22 6V18C22 19.1 21.1 20 20 20H4C2.9 20 2 19.1 2 18V6C2 4.9 2.9 4 4 4Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <polyline points="22,6 12,13 2,6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                            <span>Email</span>
                        </a>
                    </div>
                    
                    <!-- Copy success message -->
                    <div id="copy-success" class="hidden mt-3 text-sm text-green-600 flex items-center gap-2">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M20 6L9 17L4 12" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        Link copied to clipboard!
                    </div>
                </div>

                <!-- Comments -->
                @if (session('success'))
                    <div class="mb-6 rounded-xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-800">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="mb-10">
                    <h3 class="text-xl font-bold text-gray-900 mb-6">Comments</h3>

                    <div class="space-y-8">
                        @forelse($comments as $comment)
                            <div>
                                <div class="flex gap-4">
                                    <div class="w-12 h-12 rounded-[12px] overflow-hidden bg-gray-200 flex-shrink-0">
                                        <img src="{{ asset('images/logo-ji.svg') }}" alt="" class="w-full h-full object-cover" />
                                    </div>

                                    <div class="flex-1">
                                        <div class="flex items-start justify-between gap-4">
                                            <div>
                                                <div class="text-base font-semibold text-gray-900 leading-tight">{{ $comment->name }}</div>
                                                <div class="text-xs text-gray-500 mt-1">{{ $comment->created_at?->format('F d, Y \a\t h:i A') }}</div>
                                            </div>

                                            <button onclick="toggleReplyForm({{ $comment->id }})" class="text-sm text-gray-500 hover:text-blue-600 font-medium inline-flex items-center gap-2">
                                                Reply
                                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M5 12h14" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                                                    <path d="M13 6l6 6-6 6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                                </svg>
                                            </button>
                                        </div>

                                        <p class="mt-3 text-sm text-gray-600 leading-relaxed">{{ $comment->body }}</p>

                                        <!-- Reply Form (hidden by default) -->
                                        <div id="reply-form-{{ $comment->id }}" class="mt-4 hidden">
                                            <div class="bg-gray-50 rounded-lg p-4">
                                                <form method="POST" action="{{ route($commentStoreRouteName, $news->slug) }}" class="space-y-3">
                                                    @csrf
                                                    <input type="hidden" name="parent_id" value="{{ $comment->id }}">
                                                    <div>
                                                        <textarea 
                                                            name="body" 
                                                            rows="3" 
                                                            class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-blue-500 focus:border-transparent resize-none" 
                                                            placeholder="Write a reply..."
                                                            required
                                                        ></textarea>
                                                    </div>
                                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                                                        <input 
                                                            type="text" 
                                                            name="name" 
                                                            class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-blue-500 focus:border-transparent" 
                                                            placeholder="Your name"
                                                            required
                                                        />
                                                        <input 
                                                            type="email" 
                                                            name="email" 
                                                            class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-blue-500 focus:border-transparent" 
                                                            placeholder="Your email"
                                                            required
                                                        />
                                                    </div>
                                                    <div class="flex gap-2">
                                                        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg text-sm font-medium hover:bg-blue-700">
                                                            Post Reply
                                                        </button>
                                                        <button type="button" onclick="toggleReplyForm({{ $comment->id }})" class="px-4 py-2 border border-gray-300 text-gray-700 rounded-lg text-sm font-medium hover:bg-gray-50">
                                                            Cancel
                                                        </button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                @if($comment->approvedReplies->isNotEmpty())
                                    <div class="mt-6 pl-16 space-y-6">
                                        @foreach($comment->approvedReplies as $reply)
                                            <div class="flex gap-4">
                                                <div class="w-10 h-10 rounded-[12px] overflow-hidden bg-gray-200 flex-shrink-0">
                                                    <img src="{{ asset('images/logo-ji.svg') }}" alt="" class="w-full h-full object-cover" />
                                                </div>

                                                <div class="flex-1">
                                                    <div class="flex items-start justify-between gap-4">
                                                        <div>
                                                            <div class="text-sm font-semibold text-gray-900 leading-tight">{{ $reply->name }}</div>
                                                            <div class="text-xs text-gray-500 mt-1">{{ $reply->created_at?->format('F d, Y \a\t h:i A') }}</div>
                                                        </div>

                                                        <button onclick="toggleReplyForm({{ $reply->id }})" class="text-sm text-gray-500 hover:text-blue-600 font-medium inline-flex items-center gap-2">
                                                            Reply
                                                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <path d="M5 12h14" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                                                                <path d="M13 6l6 6-6 6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                                            </svg>
                                                        </button>
                                                    </div>

                                                    <p class="mt-3 text-sm text-gray-600 leading-relaxed">{{ $reply->body }}</p>

                                                    <!-- Reply Form (hidden by default) -->
                                                    <div id="reply-form-{{ $reply->id }}" class="mt-4 hidden">
                                                        <div class="bg-gray-50 rounded-lg p-4">
                                                            <form method="POST" action="{{ route($commentStoreRouteName, $news->slug) }}" class="space-y-3">
                                                                @csrf
                                                                <input type="hidden" name="parent_id" value="{{ $reply->id }}">
                                                                <div>
                                                                    <textarea 
                                                                        name="body" 
                                                                        rows="3" 
                                                                        class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-blue-500 focus:border-transparent resize-none" 
                                                                        placeholder="Write a reply..."
                                                                        required
                                                                    ></textarea>
                                                                </div>
                                                                <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                                                                    <input 
                                                                        type="text" 
                                                                        name="name" 
                                                                        class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-blue-500 focus:border-transparent" 
                                                                        placeholder="Your name"
                                                                        required
                                                                    />
                                                                    <input 
                                                                        type="email" 
                                                                        name="email" 
                                                                        class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-blue-500 focus:border-transparent" 
                                                                        placeholder="Your email"
                                                                        required
                                                                    />
                                                                </div>
                                                                <div class="flex gap-2">
                                                                    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg text-sm font-medium hover:bg-blue-700">
                                                                        Post Reply
                                                                    </button>
                                                                    <button type="button" onclick="toggleReplyForm({{ $reply->id }})" class="px-4 py-2 border border-gray-300 text-gray-700 rounded-lg text-sm font-medium hover:bg-gray-50">
                                                                        Cancel
                                                                    </button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        @empty
                            <div class="text-sm text-gray-600">No comments yet.</div>
                        @endforelse
                    </div>
                </div>
                
                <!-- Comment Section -->
                <div class="border-t border-gray-200 mb-8"></div>
                <div class="bg-white rounded-lg p-8 mb-20">
                    <h3 class="text-xl font-bold text-gray-900 mb-6">Leave a comment</h3>
                    <form class="space-y-4" method="POST" action="{{ route($commentStoreRouteName, $news->slug) }}">
                        @csrf
                        <div>
                            <textarea 
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent resize-none" 
                                rows="4" 
                                placeholder="Your comment"
                                name="body"
                            ></textarea>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <input 
                                    type="text" 
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" 
                                    placeholder="Your name"
                                    name="name"
                                />
                            </div>
                            <div>
                                <input 
                                    type="email" 
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" 
                                    placeholder="Your email"
                                    name="email"
                                />
                            </div>
                        </div>
                        <button type="submit" class="bg-white text-gray-700 px-10 py-3 rounded-full font-semibold border-2 border-gray-400 hover:bg-gray-50 transition-colors">
                            Submit
                        </button>
                    </form>
                </div>
            </div>
            
            <!-- Sidebar -->
            <div class="lg:col-span-1">
                <!-- Categories -->
                <div class="p-6 mb-6 shadow-sm" style="background:#F3F5F4;border-radius:16px;">
                    <h3 class="text-lg font-bold text-gray-900 mb-4">Categories</h3>
                    <ul class="divide-y divide-gray-200">
                        @forelse($categories as $category)
                            <li class="py-3">
                                <a href="{{ route('news', ['category' => $category->slug]) }}" class="text-gray-600 hover:text-blue-600 flex items-center justify-between">
                                    <span>{{ $category->name }}</span>
                                    <span class="text-gray-400 text-sm">({{ $category->blogs_count }})</span>
                                </a>
                            </li>
                        @empty
                            <li class="py-3">
                                <span class="text-gray-500">No categories available</span>
                            </li>
                        @endforelse
                    </ul>
                </div>
                
                <!-- Search -->
                <div class="p-6 mb-6 shadow-sm" style="background:#ffffff;border-radius:16px;">
                    <h3 class="text-lg font-bold text-gray-900 mb-4">Search</h3>
                    <div class="relative">
                        <input 
                            type="text" 
                            class="w-full px-4 py-3 pr-10 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" 
                            placeholder="Search..."
                        />
                        <button class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-gray-600">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <circle cx="11" cy="11" r="8" stroke="currentColor" stroke-width="2"/>
                                <path d="M21 21l-4.35-4.35" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </button>
                    </div>
                </div>
                
                <!-- Top Posts -->
                <div class="p-6 shadow-sm" style="background:#F3F5F4;border-radius:16px;">
                    <h3 class="text-lg font-bold text-gray-900 mb-4">Top Posts</h3>
                    <div class="space-y-4">
                        @forelse($topPosts as $post)
                            @php
                                $topPostImage = $post->image_url ?: asset('images/hero/hero-1.jpg');
                            @endphp
                            <div class="flex gap-3">
                                <div class="w-16 h-16 bg-cover bg-center rounded-lg flex-shrink-0" style="background-image: url('{{ $topPostImage }}');">
                                </div>
                                <div>
                                    <a href="{{ route($showRouteName, $post->slug) }}" class="block">
                                        <h4 class="text-sm font-medium text-gray-900 line-clamp-2 mb-1 hover:text-blue-600 transition-colors">
                                            {{ $post->title }}
                                        </h4>
                                    </a>
                                    <p class="text-xs text-gray-500">{{ $post->formatted_date }}</p>
                                </div>
                            </div>
                        @empty
                            <div class="text-gray-500 text-sm">No top posts available</div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    
    <!-- Contact Section -->
    <section class="section section-contact" id="contact">
        <div class="container">
            <div class="contact-main-grid">
                <!-- Left Column -->
                <div class="contact-left">
                    <div class="contact-info-block">
                        <div class="contact-header">
                            <h2 class="contact-heading">
                                <span class="contact-heading-line">
                                    Mari Wujudkan <span class="contact-heading-bold">Strategi</span>
                                </span>
                                <span class="contact-heading-line">
                                    yang <span class="contact-heading-accent">Berdampak Nyata</span>
                                </span>
                            </h2>
                            <p class="contact-info-desc">Mari berkolaborasi bersama JagoanIndonesia untuk mewujudkan strategi yang dapat diekskusi dan berdampak nyata bagi pertumbuhan bisnis Anda.</p>
                            <a href="#" class="contact-cta">Hubungi Kami <img src="{{ asset('images/icon-arrow.svg') }}" alt="Arrow" class="contact-cta-icon"></a>
                        </div>

                        <div class="contact-info-grid">
                            <div class="contact-info-title">Hubungi Kami</div>
                            <ul class="contact-info-list">
                                <li class="contact-info-item">
                                    <span class="contact-info-icon" aria-hidden="true">
                                        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M22 16.92V19.92C22 20.92 21 21.92 20 21.92C11 21.92 3 13.92 3 4.92C3 3.92 4 2.92 5 2.92H8C8.5 2.92 9 3.42 9 3.92V7.92C9 8.42 8.5 8.92 8 8.92H6C6 13.92 10 17.92 15 17.92V15.92C15 15.42 15.5 14.92 16 14.92H20C20.5 14.92 21 15.42 21 15.92V16.92Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                    </span>
                                    <span>+62 21 1234 5678</span>
                                </li>
                                <li class="contact-info-item">
                                    <span class="contact-info-icon" aria-hidden="true">
                                        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M4 4H20C21.1 4 22 4.9 22 6V18C22 19.1 21.1 20 20 20H4C2.9 20 2 19.1 2 18V6C2 4.9 2.9 4 4 4Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                            <polyline points="22,6 12,13 2,6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                    </span>
                                    <span>jagoanindonesiaku@gmail.com</span>
                                </li>
                                <li class="contact-info-item">
                                    <span class="contact-info-icon" aria-hidden="true">
                                        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M21 10C21 16 12 22 12 22C12 22 3 16 3 10C3 5.58172 6.58172 2 11 2C13.5 2 15.5 3 16.5 4.5C17.5 3 19.5 2 22 2C22 2 21 5.58172 21 10Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                    </span>
                                    <span>Jl. Letjen S. Parman Gang IIIA No.19 Kel. Purwantoro, Kec. Blimbing, Kota Malang, Jawa Timur</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Right Column -->
                <div class="contact-right">
                    <form class="contact-form contact-form--card" aria-label="Form kontak">
                        <h3 class="contact-form-title">Jangan ragu untuk menghubungi atau mengunjungi kami</h3>
                        <div class="contact-form-fields">
                            <div class="contact-form-group">
                                <input type="text" name="name" class="contact-form-input" placeholder="Nama" />
                            </div>
                            <div class="contact-form-group">
                                <input type="email" name="email" class="contact-form-input" placeholder="Email" />
                            </div>
                            <div class="contact-form-group">
                                <input type="tel" name="phone" class="contact-form-input" placeholder="No. Telepon" />
                            </div>
                            <div class="contact-form-group">
                                <textarea name="message" class="contact-form-input contact-form-textarea" placeholder="Tulis pesan Anda"></textarea>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-dark contact-submit">Kirim</button>
                    </form>
                </div>
            </div>

        </div>

        <!-- Footer -->
        <div class="contact-footer">
            <div class="container contact-footer-inner">
                <a href="{{ route('home') }}" class="contact-footer-logo" aria-label="Jagoan Indonesia - Beranda">
                    <img src="{{ asset('images/logo-ji.svg') }}" alt="" width="154" height="62" decoding="async">
                </a>
                <nav class="contact-footer-nav" aria-label="Menu bawah">
                    <a href="{{ route('home') }}" class="contact-footer-link">Beranda</a>
                    <span class="contact-footer-separator">|</span>
                    <a href="#" class="contact-footer-link">Tentang</a>
                    <span class="contact-footer-separator">|</span>
                    <a href="#" class="contact-footer-link">Portofolio</a>
                    <span class="contact-footer-separator">|</span>
                    <a href="{{ route('news') }}" class="contact-footer-link">Blog</a>
                    <span class="contact-footer-separator">|</span>
                    <a href="{{ route('career') }}" class="contact-footer-link">Karir</a>
                </nav>
            </div>
        </div>
    </section>

    <style>
        .line-clamp-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
        
        .prose {
            color: #374151;
            line-height: 1.75;
        }
        
        .prose p {
            margin-bottom: 1.25rem;
        }
        
        .prose h1, .prose h2, .prose h3 {
            color: #111827;
            font-weight: 600;
            margin-top: 2rem;
            margin-bottom: 1rem;
        }
        
        .prose ul, .prose ol {
            margin: 1.25rem 0;
            padding-left: 1.5rem;
        }
        
        .prose li {
            margin-bottom: 0.5rem;
        }
        
        @media (max-width: 768px) {
            .container {
                padding-left: 1rem;
                padding-right: 1rem;
            }
            
            .grid {
                grid-template-columns: 1fr;
            }
            
            .lg\:col-span-2 {
                grid-column: span 1;
            }
        }
        
        /* Share Button Styles */
        .share-btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 8px 16px;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 500;
            text-decoration: none;
            border: 1px solid #e5e7eb;
            background: white;
            color: #374151;
            transition: all 0.2s ease;
            cursor: pointer;
        }
        
        .share-btn:hover {
            transform: translateY(-1px);
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }
        
        .share-btn--copy:hover {
            background: #f3f4f6;
            border-color: #9ca3af;
        }
        
        .share-btn--whatsapp:hover {
            background: #25d366;
            color: white;
            border-color: #25d366;
        }
        
        .share-btn--facebook:hover {
            background: #1877f2;
            color: white;
            border-color: #1877f2;
        }
        
        .share-btn--twitter:hover {
            background: #000000;
            color: white;
            border-color: #000000;
        }
        
        .share-btn--linkedin:hover {
            background: #0077b5;
            color: white;
            border-color: #0077b5;
        }
        
        .share-btn--email:hover {
            background: #ea4335;
            color: white;
            border-color: #ea4335;
        }
        
        .share-btn svg {
            flex-shrink: 0;
        }
    </style>

    <script>
        function copyLink() {
            const url = window.location.href;
            navigator.clipboard.writeText(url).then(function() {
                const successMessage = document.getElementById('copy-success');
                successMessage.classList.remove('hidden');
                
                // Hide the success message after 3 seconds
                setTimeout(function() {
                    successMessage.classList.add('hidden');
                }, 3000);
            }).catch(function(err) {
                // Fallback for older browsers
                const textArea = document.createElement('textarea');
                textArea.value = url;
                textArea.style.position = 'fixed';
                textArea.style.opacity = '0';
                document.body.appendChild(textArea);
                textArea.focus();
                textArea.select();
                
                try {
                    document.execCommand('copy');
                    const successMessage = document.getElementById('copy-success');
                    successMessage.classList.remove('hidden');
                    
                    setTimeout(function() {
                        successMessage.classList.add('hidden');
                    }, 3000);
                } catch (err) {
                    console.error('Failed to copy link: ', err);
                }
                
                document.body.removeChild(textArea);
            });
        }
        
        function toggleReplyForm(commentId) {
            const form = document.getElementById('reply-form-' + commentId);
            if (form) {
                form.classList.toggle('hidden');
                
                // Clear form when hiding
                if (form.classList.contains('hidden')) {
                    const textarea = form.querySelector('textarea');
                    const nameInput = form.querySelector('input[name="name"]');
                    const emailInput = form.querySelector('input[name="email"]');
                    if (textarea) textarea.value = '';
                    if (nameInput) nameInput.value = '';
                    if (emailInput) emailInput.value = '';
                } else {
                    // Focus on textarea when showing
                    const textarea = form.querySelector('textarea');
                    if (textarea) textarea.focus();
                }
            }
        }

        // Close all reply forms when opening a new one
        document.addEventListener('DOMContentLoaded', function() {
            const replyButtons = document.querySelectorAll('[onclick^="toggleReplyForm"]');
            
            replyButtons.forEach(button => {
                button.addEventListener('click', function(e) {
                    const commentId = this.getAttribute('onclick').match(/toggleReplyForm\((\d+)\)/);
                    if (commentId) {
                        const targetId = commentId[1];
                        
                        // Close all other reply forms
                        document.querySelectorAll('[id^="reply-form-"]').forEach(form => {
                            if (form.id !== 'reply-form-' + targetId) {
                                form.classList.add('hidden');
                            }
                        });
                    }
                });
            });
        });
    </script>
</x-layouts.app>
