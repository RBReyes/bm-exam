<nav class="sidebar">
    <div class="sidebar-header">
        <a href="/admin" class="sidebar-brand">
        <img src="../jpn_eb/images/logo.png" alt="logo" class="w-75">
        </a>
        <div class="sidebar-toggler not-active">
            <span></span>
            <span></span>
            <span></span>
        </div>
    </div>
    <div class="sidebar-body">
    <ul class="nav">
        <li class="nav-item">
            <a href="{{route('admin.app-setting')}}" class="nav-link">
            <i class="link-icon" data-feather="settings"></i>
            <span class="link-title">App Settings</span>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{route('admin.city')}}" class="nav-link">
            <i class="link-icon" data-feather="file"></i>
            <span class="link-title">Cities</span>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{route('admin.category')}}" class="nav-link">
            <i class="link-icon" data-feather="type"></i>
            <span class="link-title">Categories</span>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{route('admin.guideline')}}" class="nav-link">
            <i class="link-icon" data-feather="columns"></i>
            <span class="link-title">Trip Guidelines</span>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{route('admin.todo')}}" class="nav-link">
            <i class="link-icon" data-feather="image"></i>
            <span class="link-title">Things To do</span>
            </a>
        </li>
        {{-- <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#users" role="button" aria-expanded="false" aria-controls="users">
            <i class="link-icon" data-feather="user"></i>
            <span class="link-title">User Management</span>
            <i class="link-arrow" data-feather="chevron-down"></i>
            </a>
            <div class="collapse" id="users">
            <ul class="nav sub-menu">
                <li class="nav-item">
                    <a href="user-manage.html" class="nav-link">All User Lists</a>
                </li>
                <li class="nav-item">
                    <a href="adduser.html" class="nav-link">Add User</a>
                </li>
            </ul>
            </div>
        </li> --}}
        
    </ul>
    </div>
</nav>