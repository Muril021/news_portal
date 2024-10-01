<nav class="navbar navbar-dark navbar-expand-lg bg-dark mb-4">
    <div class="container bg-dark w-75">
      <a class="navbar-brand fw-bold" href="{{ route('welcome') }}">i10</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse bg-dark navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            @php
                $currentUrl = request()->getRequestUri();
            @endphp
            @auth
                <li class="nav-item">
                    <a
                        class="nav-link {{ $currentUrl == '/' ? 'nav-link-actived' : '' }}"
                        aria-current="page"
                        href="{{ route('welcome') }}"
                    >
                        Início
                    </a>
                </li>
                <li class="nav-item">
                    <a
                        class="nav-link {{ $currentUrl == '/perfil' ? 'nav-link-actived' : '' }}"
                        href="{{ route('profile.edit') }}"
                    >
                        Perfil
                    </a>
                </li>
                @if (Auth::user()->hasRole('admin'))
                <li class="nav-item">
                    <a
                        class="nav-link {{ $currentUrl == '/noticias/lista' ? 'nav-link-actived' : '' }}"
                        href="{{ route('news.all') }}"
                    >
                        Notícias
                    </a>
                </li>
                @else
                    <li class="nav-item">
                        <a
                            class="nav-link {{ $currentUrl == '/noticias/minhas-noticias' ? 'nav-link-actived' : '' }}"
                            href="{{ route('news.my-news') }}"
                        >
                            Minhas notícias
                        </a>
                    </li>
                @endif
                <li class="nav-item">
                    <a
                        class="nav-link {{ $currentUrl == '/categorias' ? 'nav-link-actived' : '' }}"
                        href="{{ route('category.index') }}"
                    >
                        Categorias
                    </a>
                </li>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <a
                        class="nav-link"
                        href="{{ route('logout') }}"
                        onclick="event.preventDefault(); this.closest('form').submit();"
                    >
                        Sair
                    </a>
                </form>
            @endauth
            @guest
                <a
                    class="nav-link {{ $currentUrl == '/' ? 'nav-link-actived' : '' }}"
                    href="{{ route('welcome') }}"
                >
                    Início
                </a>
                <a class="nav-link" href="{{ route('login') }}">Login</a>
                <a class="nav-link" href="{{ route('register') }}">Cadastre-se</a>
            @endguest
        </ul>
        <form action="{{ route('welcome') }}" id="search" class="d-flex rounded" role="search">
            <input
                class="form-control me-2 border-0 shadow-none bg-transparent"
                type="search"
                placeholder="Pesquisar"
                aria-label="Search"
                name="search"
                value="{{ request('search') }}"
            >
            <button class="btn border-0 shadow-none" type="submit">
                <i class="fa-solid fa-magnifying-glass yellow-color"></i>
            </button>
        </form>
      </div>
    </div>
</nav>
