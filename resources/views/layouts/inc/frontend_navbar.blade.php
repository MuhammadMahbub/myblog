<div class="sticky-top">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            @php
                $setting = App\Models\Setting::find(1);
            @endphp
            <a class="navbar-brand" href="#">
                <img src="{{ asset('uploads/settings') . '/' . $setting->web_logo }}" alt="" width="50" height="50">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav m-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="{{ url('/') }}">Home</a>
                    </li>
                    @php
                        $categories = App\Models\Category::where('nav_status', 0)->get();
                    @endphp
                    @foreach ($categories as $category)
                        <li class="nav-item">
                            <a class="nav-link"
                                href="{{ route('viewcategory', $category->category_name) }}">{{ $category->category_name }}</a>
                        </li>
                    @endforeach
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            Dropdown
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="#">Action</a></li>
                            <li><a class="dropdown-item" href="#">Another action</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="#">Something else here</a></li>
                        </ul>
                    </li>

                    @if (Auth::check())
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                Logout
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                class="d-none">
                                @csrf
                            </form>
                        <li>
                        @else
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">Login</a>
                        </li>
                    @endif
            </div>
        </div>
    </nav>
</div>
