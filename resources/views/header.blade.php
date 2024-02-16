<header>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="{{ url('/funkos') }}">
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
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button class="nav-link btn btn-outline-secondary" type="submit">Logout</button>
                            </form>
                        @else
                            <a class="nav-link btn btn-secondary" href="{{route ('login')}}">Login</a>
                        @endauth
                    @endif
                </li>
                @if(auth()->check() && auth()->user()->isAdmin())
                <li class="nav-item mr-2">
                            <a class="nav-link btn btn-outline-secondary" href="{{route ('funkos.create')}}">New Funko</a>
                </li>
                <li class="nav-item mr-2">
                            <a class="nav-link btn btn-outline-secondary" href="{{route ('category.index')}}">Categories</a>
                </li>
                @endif
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
