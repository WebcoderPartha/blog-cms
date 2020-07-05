<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container">
        <a class="navbar-brand" href="#">WebCoder</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="{{route('home')}}">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">About</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Services</a>
                </li>
                @if(Auth::check())
                <li class="nav-item">
                    <a class="nav-link" href="{{route('admin.deshboard')}}">Admin</a>
                </li>
                @else
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('home')}}/login">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('home')}}/register">Register</a>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</nav>
