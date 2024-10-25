@if (Auth::check())
    <nav id="sidebar" class="col-md-3 col-lg-2 d-md-block d-none bg-light sidebar">
        <div class="position-sticky pt-3">
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('home') ? 'active' : '' }}" href="{{ route('home') }}"><i
                            class="bi bi-house-door"></i>
                        Dashboard</a>
                </li>
                @if (Auth::user()->role === 'admin')
                    <li class="nav-item mt-2">
                        <a class="nav-link {{ Request::is('users*') ? 'active' : '' }}"
                            href="{{ route('users.index') }}">
                            <i class="bi bi-people"></i>
                            Users
                        </a>
                    </li>
                    <li class="nav-item mt-2">
                        <a class="nav-link {{ Request::is('categories*') ? 'active' : '' }}"
                            href="{{ route('categories.index') }}">
                            <i class="bi bi-grid"></i>
                            Categories
                        </a>
                    </li>
                @endif
                <li class="nav-item mt-2">
                    <a class="nav-link {{ Request::is('blogs*') ? 'active' : '' }}" href="{{ route('blogs.index') }}">
                        <i class="bi bi-file-earmark-text"></i>
                        Blogs
                    </a>
                </li>
            </ul>
        </div>
    </nav>
@endif
