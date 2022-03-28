<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
            <div class="nav">
                <div class="sb-sidenav-menu-heading">Core</div>
                <a class="nav-link {{ Route::is('admin.dashboard') ? 'active' : '' }}"
                    href="{{ route('admin.dashboard') }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                    Dashboard
                </a>
                <a class="nav-link {{ Route::is('admin.setting') ? 'active' : '' }}"
                    href="{{ route('admin.setting') }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                    Settings
                </a>
                <a class="nav-link {{ Route::is('admin.user') ? 'active' : '' }} collapsed"
                    href="{{ route('admin.user') }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                    Users
                </a>
                <a class="nav-link {{ Request::is('admin/category*') ? 'collapse active' : '' }}" href="#"
                    data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false"
                    aria-controls="collapseLayouts">
                    <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                    Category
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse {{ Request::is('admin/category*') ? 'show' : '' }}" id="collapseLayouts"
                    aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link {{ Route::is('category.create') ? 'active' : '' }}"
                            href="{{ route('category.create') }}">Add Category</a>
                        <a class="nav-link {{ Route::is('category.index') ? 'active' : '' }}"
                            href="{{ route('category.index') }}">View Category</a>
                    </nav>
                </div>
                <a class="nav-link {{ Request::is('admin/post*') ? 'collapse active' : '' }}" href="#"
                    data-bs-toggle="collapse" data-bs-target="#collapseLayoutspost" aria-expanded="false"
                    aria-controls="collapseLayouts">
                    <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                    Post
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse {{ Request::is('admin/post*') ? 'show' : '' }}" id="collapseLayoutspost"
                    aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link {{ Route::is('post.create') ? 'active' : '' }}"
                            href="{{ route('post.create') }}">Create Post</a>
                        <a class="nav-link {{ Route::is('post.index') ? 'active' : '' }}"
                            href="{{ route('post.index') }}">View Post</a>
                    </nav>
                </div>
            </div>
        </div>
        <div class="sb-sidenav-footer">
            <div class="small">Logged in as:</div>
            Start Bootstrap
        </div>
    </nav>
</div>
