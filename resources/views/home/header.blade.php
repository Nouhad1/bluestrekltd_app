<header class="header_section">
    <div class="container">
       <nav class="navbar navbar-expand-lg custom_nav-container ">
        <a class="navbar-brand" href="{{ url('/') }}">
            <img width="210" src="{{ asset('images/bluestrek.png') }}" alt="Logo" />
        </a>
        {{-- <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" 
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class=""> </span>
        </button>  --}}
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav">

                <!-- Accueil -->
                <li class="nav-item active">
                   <a class="nav-link" href="{{ url('/') }}">Accueil <span class="sr-only">(current)</span></a>
                </li>

                <!-- Produits Dropdown -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                       data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Produits
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        @foreach($categories as $cat)
                            <a class="dropdown-item" href="{{ route('products.byCategory', $cat->id) }}">
                                {{ $cat->catagory_name }}
                            </a>
                        @endforeach
                    </div>
                </li>

                @if (Auth::guard('client')->check())
    <!-- Si le client est connecté -->
    <li class="nav-item">
        <a class="nav-link" href="{{ url('client/show_cart') }}">
            Panier
        </a>
    </li>
@else
    <!-- Si aucun client connecté -->
    <li class="nav-item">
        <a class="nav-link" href="{{route('client.login') }}">
            Panier
        </a>
    </li>
@endif
       
                    

                <!-- À propos -->
                <li class="nav-item"><a class="nav-link" href="{{ url('/about') }}">À propos</a></li>

                <!-- Contact -->
                <li class="nav-item"><a class="nav-link" href="{{ route('contact') }}">Contact</a></li>

                <!-- Connexion / Profil -->
                @if (Route::has('login'))
                    @auth('client') 
                        <!-- Dropdown profil client -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="profileDropdown" role="button"
                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                {{ Auth::guard('client')->user()->name }}
                                {{-- Optionnel : avatar --}}
                                {{-- <img src="{{ Auth::guard('client')->user()->avatar }}" alt="Avatar" class="rounded-circle" width="30"> --}}
                            </a>
                            <div class="dropdown-menu" aria-labelledby="profileDropdown">
                                <a class="dropdown-item" href="{{ route('client.profile') }}">Mon profil</a>
                                <div class="dropdown-divider"></div>
                                <form action="{{ route('client.logout') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="dropdown-item text-danger">Déconnexion</button>
                                </form>
                            </div>
                        </li>
                    @else
                        <!-- Boutons connexion / inscription -->
                        <li class="nav-item">
                             <a class="btn btn-dark" id="logincss" href="{{ route('client.login') }}">Connexion</a> 
                        </li> 
                        <li class="nav-item"> 
                            <a class="btn btn-light" style="background-color: #7529CC; color: white;" href="{{ route('client.register') }}">Inscription</a>
                        </li>
                    @endauth
                @endif

            </ul>
        </div>
       </nav>
    </div>
</header>
