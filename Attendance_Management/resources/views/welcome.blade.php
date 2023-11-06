@include('layouts.welcome')
  
    <div class="flex-center position-ref full-height">
        @if (Route::has('login'))
        <div class="top-right links color-white">
            @auth
            <a href="{{ url('/admin') }}">DCS Admin</a>
            @else
            <button class = "btn btn-success btn-lg"> <a style="color: white" href="{{ route('login') }}">Login</a></button>

            @if (Route::has('register'))
            <a href="{{ route('register') }}">Register</a>
            @endif
            @endauth
        </div>
        @endif

        <div class = "content">
            <div class="title ">
                <div class = "display-3 text-success">Department Of Computer Science</div>
                <div class = "h1" style = "text-align: center";>University Of Jaffna</footer>
            </div>

            
        </div>
    </div>

