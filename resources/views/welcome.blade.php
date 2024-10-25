<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Blog Management</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased">
    <!-- Fixed Navbar -->
    <nav class="fixed top-0 w-full bg-white dark:bg-gray-800 shadow z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <!-- Logo -->
                <div class="flex-shrink-0 flex items-center">
                    <a href="{{ url('/') }}" class="text-xl font-bold text-gray-800 dark:text-white">
                        Blog Management
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="flex items-center space-x-4">
                    @if (Route::has('login'))
                        @auth
                            <a href="{{ url('/home') }}"
                                class="text-gray-700 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white px-3 py-2 rounded-md text-sm font-medium">
                                <i class="bi bi-speedometer2 me-2"></i> Dashboard
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

    <!-- Search and Filter Section -->
    <div class="pt-20"> <!-- Added padding-top to account for fixed navbar -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row justify-between items-center gap-4 mb-6">
                <!-- Category Dropdown -->
                <div class="w-full md:w-48">
                    <select id="categoryFilter"
                        class="w-full rounded-lg border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300 focus:border-blue-500 focus:ring-blue-500 p-3"
                        onchange="filterByCategory(this.value)">
                        <option value="">All Categories</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}"
                                {{ request('category') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Search Bar -->
                <div class="w-full md:w-64">
                    <form action="{{ url('/') }}" method="GET" class="relative flex items-center">
                        @if (request('category'))
                            <input type="hidden" name="category" value="{{ request('category') }}">
                        @endif
                        <input type="text" name="search" placeholder="Search blogs..."
                            value="{{ request('search') }}"
                            class="w-full rounded-lg border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300 focus:border-blue-500 focus:ring-blue-500 pl-10 p-3">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="bi bi-search text-gray-400"></i>
                        </div>
                        <button type="submit"
                            class="ml-2 px-3 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                            Search
                        </button>
                    </form>
                </div>

                <!-- Reset Button -->
                @if (request('category') || request('search'))
                    <div class="w-full md:w-auto">
                        <a href="{{ url('/') }}"
                            class="inline-flex items-center justify-center px-4 py-2 bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300 rounded-lg hover:bg-gray-200 dark:hover:bg-gray-600 transition-colors duration-200">
                            <i class="bi bi-x-circle me-2"></i>
                            Reset Filters
                        </a>
                    </div>
                @endif
            </div>

            <!-- No Results Message -->
            @if ($blogs->isEmpty())
                <div class="text-center py-12">
                    <div class="text-gray-500 dark:text-gray-400 mb-4">
                        <i class="bi bi-search text-4xl"></i>
                    </div>
                    <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-2">
                        No blogs found
                    </h3>
                    <p class="text-gray-500 dark:text-gray-400">
                        Try adjusting your search or filter to find what you're looking for.
                    </p>
                    <a href="{{ url('/') }}"
                        class="inline-flex items-center mt-4 text-blue-600 dark:text-blue-400 hover:underline">
                        <i class="bi bi-arrow-left me-2"></i>
                        Clear all filters
                    </a>
                </div>
            @endif

            <!-- Blog Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($blogs as $blog)
                    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg overflow-hidden">
                        <!-- Image Section -->
                        <div class="aspect-w-16 aspect-h-9">
                            @if ($blog->image)
                                <img src="{{ asset('storage/' . $blog->image) }}" alt="{{ $blog->title }}"
                                    class="w-full h-48 object-cover">
                            @else
                                <img src="{{ asset('images/login.jpeg') }}" alt="Default Image"
                                    class="w-full h-48 object-cover">
                            @endif
                        </div>
                        <div class="p-6">
                            <h2 class="text-xl font-semibold text-gray-800 dark:text-white mb-2">
                                {{ $blog->title }}
                            </h2>
                            <p class="text-gray-600 dark:text-gray-300 mb-4">
                                {{ Str::limit($blog->description, 150) }}
                            </p>
                            <div class="flex justify-between items-center">
                                <span class="text-sm text-gray-500 dark:text-gray-400">
                                    {{ $blog->created_at->format('M d, Y') }}
                                </span>
                                <a href="{{ route('blog.show', $blog) }}"
                                    class="text-blue-600 dark:text-blue-400 hover:underline">
                                    Read more
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="mt-8">
                {{ $blogs->links() }}
            </div>
        </div>
    </div>
    <footer class="bg-white dark:bg-gray-800 shadow mt-12">
        <div class="max-w-7xl mx-auto py-4 px-4 sm:px-6 lg:px-8">
            <div class="text-center text-gray-500 dark:text-gray-400">
                © {{ date('Y') }} Blog Management. All rights reserved.
            </div>
        </div>
    </footer>
</body>

</html>

<script>
    function filterByCategory(categoryId) {
        const currentUrl = new URL(window.location.href);
        const searchParams = new URLSearchParams(currentUrl.search);

        if (categoryId) {
            searchParams.set('category', categoryId);
        } else {
            searchParams.delete('category');
        }

        // Preserve search query if exists
        const searchQuery = searchParams.get('search');
        if (searchQuery) {
            searchParams.set('search', searchQuery);
        }

        window.location.href = `${currentUrl.pathname}?${searchParams.toString()}`;
    }
</script>
