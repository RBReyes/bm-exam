<!DOCTYPE html>
<html lang="en">
    @include('layouts.admin-head')
<body>
    <div class="main-wrapper" id="app">
        @auth
        @include('layouts.admin-sidebar')
        <div class="page-wrapper">
        @include('layouts.admin-navbar')
        <div class="page-content">
            @yield('content')
        </div>
        @include('layouts.admin-footer')
        </div>
    </div>
    @include('layouts.admin-script')
    @endauth
    
    @guest
            @include('layouts.admin-login')      
    @endguest
    
</body>
</html>