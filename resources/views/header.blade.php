<header>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="{{ url('index') }}">
            <img alt="Logo" class="d-inline-block align-text-top" height="30" src="{{ asset('images/loogo.png') }}"
                 width="30">
            Funkolandia
        </a>
        <button aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation" class="navbar-toggler"
                data-target="#navbarNav" data-toggle="collapse" type="button">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item mr-2">
                    @if (Route::has('login'))
                        @auth
                            <a class="nav-link btn btn-outline-secondary" href="{{route ('logout')}}">Logout</a>
                        @else
                            <a class="nav-link btn btn-secondary" href="{{route ('login')}}">Login</a>
                        @endauth
                    @endif
                </li>
                <li class="nav-item mr-2">
                    @if (Route::has('admin'))
                        @auth
                            <a class="nav-link btn btn-outline-secondary" href="{{route ('create')}}">New Funko</a>
                        @endauth
                    @endif
                </li>
                <li class="nav-item mr-2">
                    @if (Route::has('admin'))
                        @auth
                            <a class="nav-link btn btn-outline-secondary" href="{{route ('indexCat')}}">Categories</a>
                        @endauth
                    @endif
                </li>
            </ul>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <span class="navbar-text">
                          {{ auth()->user()->role ?? 'invitado/a' }}
                    </span>
                </li>
            </ul>
        </div>
    </nav>
</header>
