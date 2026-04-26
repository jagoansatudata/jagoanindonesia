@extends('layouts.admin')

@section('content')
    <div class="mb-6">
        <div class="flex items-center gap-4 mb-4">
            <a href="{{ route('admin.blogs.index') }}" class="inline-flex items-center gap-2 text-gray-600 hover:text-gray-900 text-sm">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
                Back to News & Blogs
            </a>
        </div>
        <div>
            <h1 class="text-2xl font-semibold text-gray-900">Edit Post</h1>
            <p class="text-sm text-gray-600 mt-1">Update the news post or blog information.</p>
        </div>
    </div>

    <div class="bg-white border border-gray-200 rounded-2xl shadow-sm overflow-hidden">
        <form method="POST" action="{{ route('admin.blogs.update', $blog) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            <div class="p-6 space-y-6">
                <!-- Type -->
                <div>
                    <label for="type" class="block text-sm font-semibold text-gray-900 mb-2">Type *</label>
                    <select id="type" name="type" required
                            class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500">
                        <option value="">Select type</option>
                        <option value="news" {{ old('type', $blog->type) == 'news' ? 'selected' : '' }}>News</option>
                        <option value="blog" {{ old('type', $blog->type) == 'blog' ? 'selected' : '' }}>Blog</option>
                    </select>
                    @error('type')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                    <p class="mt-1 text-xs text-gray-500">Choose whether this is a news post or blog article</p>
                </div>

                <!-- Title -->
                <div>
                    <label for="title" class="block text-sm font-semibold text-gray-900 mb-2">Title</label>
                    <input type="text" id="title" name="title" required
                           class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500"
                           value="{{ old('title', $blog->title) }}" placeholder="Enter blog post title">
                    @error('title')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Status & Publish Date -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="status" class="block text-sm font-semibold text-gray-900 mb-2">Status</label>
                        <select id="status" name="status" required
                                class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500">
                            <option value="">Select status</option>
                            <option value="draft" {{ old('status', $blog->status) == 'draft' ? 'selected' : '' }}>Draft</option>
                            <option value="published" {{ old('status', $blog->status) == 'published' ? 'selected' : '' }}>Published</option>
                        </select>
                        @error('status')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="published_at" class="block text-sm font-semibold text-gray-900 mb-2">Publish Date</label>
                        <input type="datetime-local" id="published_at" name="published_at"
                               class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500"
                               value="{{ old('published_at', $blog->published_at ? $blog->published_at->format('Y-m-d\TH:i') : now()->format('Y-m-d\TH:i')) }}">
                        @error('published_at')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                        <p class="mt-1 text-xs text-gray-500">Leave empty to use current time when publishing</p>
                    </div>
                </div>

                <!-- Excerpt -->
                <div>
                    <label for="excerpt" class="block text-sm font-semibold text-gray-900 mb-2">Excerpt</label>
                    <textarea id="excerpt" name="excerpt" rows="3"
                              class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500"
                              placeholder="Brief description of the blog post">{{ old('excerpt', $blog->excerpt) }}</textarea>
                    @error('excerpt')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Content -->
                <div>
                    <label for="content" class="block text-sm font-semibold text-gray-900 mb-2">Content</label>
                    <div id="editor-container">
                        <textarea id="content" name="content" rows="12"
                                  class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500"
                                  placeholder="Full blog post content">{{ old('content', $blog->content) }}</textarea>
                    </div>
                    @error('content')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Author -->
                    <div>
                        <label for="author" class="block text-sm font-semibold text-gray-900 mb-2">Author</label>
                        <input type="text" id="author" name="author" required
                               class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500"
                               value="{{ old('author', $blog->author) }}" placeholder="Author name">
                        @error('author')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Category -->
                    <div>
                        <label for="category_id" class="block text-sm font-semibold text-gray-900 mb-2">Category</label>
                        <select id="category_id" name="category_id" required
                                class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500">
                            <option value="">Select category</option>
                            @php
                                $categories = \App\Models\BlogCategory::active()->ordered()->get();
                            @endphp
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category_id', $blog->category_id) == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Image -->
                    <div>
                        <label for="image" class="block text-sm font-semibold text-gray-900 mb-2">Featured Image</label>
                        <input type="file" id="image" name="image" accept="image/*"
                               class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500">
                        @error('image')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                        <p class="mt-1 text-xs text-gray-500">Optional. Max size: 2MB. Allowed formats: JPEG, PNG, JPG, GIF</p>
                        @if($blog->image)
                            <div class="mt-2">
                                <p class="text-xs text-gray-600 mb-1">Current image:</p>
                                <img src="{{ $blog->image_url }}" alt="Current image" class="h-20 w-20 object-cover rounded-lg border border-gray-200">
                            </div>
                        @endif
                    </div>

                    <!-- Status & Publish Date -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="status" class="block text-sm font-semibold text-gray-900 mb-2">Status</label>
                        <select id="status" name="status" required
                                class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500">
                            <option value="">Select status</option>
                            <option value="draft" {{ old('status', $blog->status) == 'draft' ? 'selected' : '' }}>Draft</option>
                            <option value="published" {{ old('status', $blog->status) == 'published' ? 'selected' : '' }}>Published</option>
                        </select>
                        @error('status')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Featured -->
                <div>
                    <div class="flex items-center">
                        <input type="checkbox" id="featured" name="featured" value="1"
                               {{ old('featured', $blog->featured) ? 'checked' : '' }}
                               class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                        <label for="featured" class="ml-2 text-sm text-gray-700">Featured post</label>
                    </div>
                    <p class="mt-1 text-xs text-gray-500">Featured posts will be highlighted on the blog page</p>
                </div>
            </div>

            <div class="px-6 py-4 bg-gray-50 border-t border-gray-200 flex items-center justify-end gap-3">
                <a href="{{ route('admin.blogs.index') }}" class="rounded-lg border border-gray-300 bg-white px-4 py-2 text-sm font-semibold text-gray-700 hover:bg-gray-50">
                    Cancel
                </a>
                <button type="submit" class="rounded-lg bg-gray-900 text-white px-4 py-2 text-sm font-semibold hover:bg-gray-800">
                    Update Post
                </button>
            </div>
        </form>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    let editor;

    function UploadAdapter(loader) {
        this.loader = loader;
    }

    UploadAdapter.prototype.upload = function () {
        return this.loader.file.then(function (file) {
            return new Promise(function (resolve, reject) {
                var data = new FormData();
                data.append('upload', file);

                fetch('{{ route('admin.upload.image') }}', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: data
                })
                    .then(function (response) {
                        if (!response.ok) {
                            throw new Error('Upload failed: ' + response.status);
                        }
                        return response.json();
                    })
                    .then(function (result) {
                        if (!result || !result.url) {
                            throw new Error('Invalid upload response');
                        }
                        resolve({ default: result.url });
                    })
                    .catch(function (error) {
                        reject(error);
                    });
            });
        });
    };

    function UploadAdapterPlugin(editor) {
        editor.plugins.get('FileRepository').createUploadAdapter = function (loader) {
            return new UploadAdapter(loader);
        };
    }
    
    ClassicEditor
        .create(document.querySelector('#content'), {
            toolbar: {
                items: [
                    'heading', '|',
                    'bold', 'italic', '|',
                    'link', 'bulletedList', 'numberedList', '|',
                    'outdent', 'indent', '|',
                    'blockQuote', 'insertTable', '|',
                    'imageUpload', '|',
                    'undo', 'redo'
                ]
            },
            heading: {
                options: [
                    { model: 'paragraph', title: 'Paragraph', class: 'ck-heading_paragraph' },
                    { model: 'heading1', view: 'h1', title: 'Heading 1', class: 'ck-heading_heading1' },
                    { model: 'heading2', view: 'h2', title: 'Heading 2', class: 'ck-heading_heading2' },
                    { model: 'heading3', view: 'h3', title: 'Heading 3', class: 'ck-heading_heading3' }
                ]
            },
            placeholder: 'Start writing your blog post content here...',
            height: 400,
            image: {
                toolbar: [
                    'imageTextAlternative',
                    'imageStyle:full',
                    'imageStyle:side',
                    'link'
                ]
            },
            extraPlugins: [ UploadAdapterPlugin ]
        })
        .then(newEditor => {
            editor = newEditor;
            
            // Update the hidden textarea when form is submitted
            const form = document.querySelector('form');
            form.addEventListener('submit', function(e) {
                // Update textarea with CKEditor content
                document.querySelector('#content').value = editor.getData();
            });
        })
        .catch(error => {
            console.error('CKEditor initialization error:', error);
        });
});
</script>
@endsection
