<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="zxx">
@include('layouts.guest-head')
<body>
        <div id="app">
            <div id="preloader">
                <div id="status"></div>
            </div>
            @include('layouts.guest-header')
            <div class="tet"></div>
            
            @yield('content')
            @include('layouts.guest-footer')
            <div id="back-to-top">
                <a href="#"></a>
            </div>
            <div id="search1">
                <button type="button" class="close">×</button>
                <form>
                <input type="search" value="" placeholder="type keyword(s) here" />
                <button type="submit" class="btn btn-primary">Search</button>
                </form>
            </div>
        </div>
            @include('layouts.guest-script')
    
   
</body>
</html>