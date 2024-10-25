@extends('layouts.app')

@section('content')
    <div class="container">
        <!-- Back Button -->
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 pt-6">
            <a href="{{ route('blogs.index') }}" class="inline-flex items-center text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white">
                <i class="bi bi-arrow-left mr-2"></i>
                Back to Blogs
            </a>
        </div>

        <!-- Floating Action Bar -->
        <!-- Blog Content -->
        <div class="pt-20">
            <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 mb-8">
                <div class="bg-white dark:bg-gray-800 rounded-2xl p-5 shadow-lg overflow-hidden">
                    <!-- Blog Header with Side-by-Side Layout -->
                    <div class="md:flex">
                        <!-- Image Section - Now smaller and to the left -->
                        <div class="md:w-1/3 relative">
                            <div class="w-50">
                                @if ($blog->image)
                                    <img src="{{ asset('storage/' . $blog->image) }}" alt="{{ $blog->title }}" class="w-100">
                                @endif
                            </div>

                            <!-- Category Badge -->
                            <div class="absolute top-4 left-4">
                                <span class="bg-blue-500 text-white px-3 py-1 rounded-full text-sm shadow-lg">
                                    {{ $blog->category->name }}
                                </span>
                            </div>
                        </div>

                        <!-- Blog Info -->
                        <div class="md:w-2/3 p-6">
                            <h1 class="text-2xl font-bold text-gray-900 dark:text-white mb-4">
                                {{ $blog->title }}
                            </h1>

                            <!-- Meta Information -->
                            <div class="flex flex-wrap items-center gap-4 text-sm text-gray-500 dark:text-gray-400 mb-4">
                                <div class="flex items-center">
                                    <i class="bi bi-person-circle me-2"></i>
                                    <span>{{ $blog->user->name }}</span>
                                </div>
                                <div class="flex items-center">
                                    <i class="bi bi-calendar3 me-2"></i>
                                    <span>{{ $blog->created_at->format('F j, Y') }}</span>
                                </div>
                                <div class="flex items-center">
                                    <i class="bi bi-clock me-2"></i>
                                    <span>{{ $blog->created_at->diffForHumans() }}</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Blog Content -->
                    <div class="p-6 border-t border-gray-200 dark:border-gray-700">
                        <div class="prose prose-base max-w-none dark:prose-invert">
                            <div
                                class="prose-headings:text-gray-900 dark:prose-headings:text-white 
                                    prose-p:text-gray-600 dark:prose-p:text-white
                                    prose-strong:text-gray-900 dark:prose-strong:text-white
                                    prose-ul:text-gray-600 dark:prose-ul:text-white
                                    prose-ol:text-gray-600 dark:prose-ol:text-white
                                    prose-li:text-gray-600 dark:prose-li:text-white">
                                {!! $blog->description !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
