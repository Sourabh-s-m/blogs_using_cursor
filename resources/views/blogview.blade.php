<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $blog->title }} - Blog Management</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased bg-gray-50 dark:bg-gray-900">
    <!-- Fixed Navbar -->
    <nav class="fixed top-0 w-full bg-white dark:bg-gray-800 shadow z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <a href="/"
                        class="flex items-center text-gray-700 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white">
                        <i class="bi bi-arrow-left me-2"></i>
                        Back to Blogs
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="flex items-center space-x-4">
                    @if (Route::has('login'))
                        @auth
                            <a href="{{ url('/home') }}"
                                class="text-gray-700 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white px-3 py-2 rounded-md text-sm font-medium">
                                <i class="bi bi-speedometer2 me-2"></i>
                                Dashboard
                            </a>
                        @else
                            <a href="{{ route('login') }}"
                                class="text-gray-700 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white px-3 py-2 rounded-md text-sm font-medium">
                                Log in
                            </a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}"
                                    class="text-gray-700 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white px-3 py-2 rounded-md text-sm font-medium">
                                    Register
                                </a>
                            @endif
                        @endauth
                    @endif
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section with Image -->
    <div class="relative w-full h-[60vh] overflow-hidden mt-16">
        @if ($blog->image)
            <img src="{{ asset('storage/' . $blog->image) }}" alt="{{ $blog->title }}"
                class="w-full h-full object-cover">
        @else
            <img src="{{ asset('images/login.jpeg') }}" alt="Default Blog Image" class="w-full h-full object-cover">
        @endif
        <div class="absolute inset-0 bg-gradient-to-b from-transparent to-black/70"></div>
        <div class="absolute bottom-0 left-0 right-0 p-8 text-white">
            <div class="max-w-4xl mx-auto">
                <div class="mb-4">
                    <span class="bg-blue-500 text-white px-4 py-1 rounded-full text-sm">
                        {{ $blog->category->name }}
                    </span>
                </div>
                <h1 class="text-4xl sm:text-5xl font-bold mb-4">{{ $blog->title }}</h1>
                <div class="flex items-center space-x-4 text-white/90">
                    <div class="flex items-center">
                        <i class="bi bi-person-circle me-2"></i>
                        <span>{{ $blog->user->name }}</span>
                    </div>
                    <div class="flex items-center">
                        <i class="bi bi-calendar3 me-2"></i>
                        <span>{{ $blog->created_at->format('F j, Y') }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <main class="{{ $blog->image ? 'pt-12' : 'pt-24' }}">
        <article class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Blog Content Card -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg overflow-hidden">
                <div class="p-8">
                    @if (!$blog->image)
                        <!-- Show title and meta info here if no hero image -->
                        <div class="mb-8">
                            <div class="mb-4">
                                <span
                                    class="bg-blue-100 dark:bg-blue-900 text-blue-800 dark:text-blue-200 px-3 py-1 rounded-full text-sm">
                                    {{ $blog->category->name }}
                                </span>
                            </div>
                            <h1 class="text-4xl font-bold text-gray-900 dark:text-white mb-4">
                                {{ $blog->title }}
                            </h1>
                            <div class="flex items-center space-x-4 text-gray-500 dark:text-gray-400">
                                <div class="flex items-center">
                                    <i class="bi bi-person-circle me-2"></i>
                                    <span>{{ $blog->user->name }}</span>
                                </div>
                                <div class="flex items-center">
                                    <i class="bi bi-calendar3 me-2"></i>
                                    <span>{{ $blog->created_at->format('F j, Y') }}</span>
                                </div>
                            </div>
                        </div>
                    @endif

                    <!-- Blog Content -->
                    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg overflow-hidden">
                        <div class="p-8">
                            <!-- Blog Content with white text -->
                            <div class="prose prose-lg max-w-none dark:prose-invert text-gray-600 dark:text-gray-300">
                                <div
                                    class="prose-headings:text-gray-900 dark:prose-headings:text-white 
                                            prose-p:text-gray-600 dark:prose-p:text-gray-300
                                            prose-strong:text-gray-900 dark:prose-strong:text-white
                                            prose-ul:text-gray-600 dark:prose-ul:text-gray-300
                                            prose-ol:text-gray-600 dark:prose-ol:text-gray-300
                                            prose-li:text-gray-600 dark:prose-li:text-gray-300">
                                    {!! $blog->description !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Related Posts -->
            @if (isset($relatedBlogs) && $relatedBlogs->count() > 0)
                <div class="mt-12">
                    <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-6">More from
                        {{ $blog->category->name }}</h2>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        @foreach ($relatedBlogs as $relatedBlog)
                            <a href="{{ route('blog.show', $relatedBlog) }}"
                                class="bg-white dark:bg-gray-800 rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition duration-300">
                                <div class="aspect-w-16 aspect-h-9">
                                    @if ($relatedBlog->image)
                                        <img src="{{ asset('storage/' . $relatedBlog->image) }}"
                                            alt="{{ $relatedBlog->title }}" class="w-full h-48 object-cover">
                                    @else
                                        <img src="{{ asset('images/login.jpeg') }}" alt="Default Image"
                                            class="w-full h-48 object-cover">
                                    @endif
                                </div>
                                <div class="p-6">
                                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-2">
                                        {{ $relatedBlog->title }}
                                    </h3>
                                    <p class="text-gray-600 dark:text-gray-300 line-clamp-2">
                                        {{ Str::limit(strip_tags($relatedBlog->description), 100) }}
                                    </p>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
            @endif
        </article>
    </main>

    <!-- Footer -->
    <footer class="bg-white dark:bg-gray-800 shadow mt-12">
        <div class="max-w-7xl mx-auto py-4 px-4 sm:px-6 lg:px-8">
            <div class="text-center text-gray-500 dark:text-gray-400">
                © {{ date('Y') }} Blog Management. All rights reserved.
            </div>
        </div>
    </footer>
</body>

</html>
