<base href="/public">
@include('admin.css')
<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <div class="sidebar-brand-wrapper d-none d-lg-flex align-items-center justify-content-center fixed-top">
        <a class="sidebar-brand brand-logo" href="{{ route('redirect') }}" style="color: rgb(5, 47, 173)">
            <strong>Bluestrek</strong>
        </a>
        <a class="sidebar-brand brand-logo-mini" href="{{ route('redirect') }}" style="color: rgb(5, 47, 173)">
            <strong>B</strong>
        </a>
    </div>
    <ul class="nav">
      <li class="nav-item nav-category">
        <span class="nav-link">Navigation</span>
      </li>

      <li class="nav-item menu-items">
        <a class="nav-link" href="{{ route('admin.dashboard') }}">
          <span class="menu-icon"><i class="mdi mdi-speedometer"></i></span>
          <span class="menu-title">Dashboard</span>
        </a>
      </li>

      <li class="nav-item menu-items">
        <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
          <span class="menu-icon"><i class="mdi mdi-laptop"></i></span>
          <span class="menu-title">Produit</span>
          <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="ui-basic">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item">
              <a class="nav-link" href="{{ route('admin.products.add') }}">Ajouter Produit</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('admin.products.show') }}">Voir Produit</a>
            </li>
          </ul>
        </div>
      </li>

      <li class="nav-item menu-items">
        <a class="nav-link" href="{{ route('admin.categories') }}">
          <span class="menu-icon"><i class="mdi mdi-playlist-play"></i></span>
          <span class="menu-title">Catégorie</span>
        </a>
      </li>

       

      <li class="nav-item menu-items">
        <a class="nav-link" href="{{ route('admin.orders') }}">
          <span class="menu-icon"><i class="mdi mdi-playlist-play"></i></span>
          <span class="menu-title">Commande</span>
        </a>
      </li>

     <li class="nav-item menu-items">
    <a class="nav-link" data-toggle="collapse" href="#entry-menu" aria-expanded="false" aria-controls="entry-menu">
        <span class="menu-icon"><i class="mdi mdi-laptop"></i></span>
        <span class="menu-title">Entrée</span>
        <i class="menu-arrow"></i>
    </a>
    <div class="collapse" id="entry-menu">
        <ul class="nav flex-column sub-menu">
            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.add_entry') }}">Ajouter Entrée</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.entry') }}">Voir Entrée</a>
            </li>
        </ul>
    </div>
    </li>

    {{-- <li class="nav-item menu-items">
        <a class="nav-link" href="{{ route('admin.messages') }}">
          <span class="menu-icon"><i class="mdi mdi-playlist-play"></i></span>
          <span class="menu-title">Message</span>
        </a>
    </li> --}}

     <li class="nav-item menu-items">
        <a class="nav-link" href="{{ route('admin.messages') }}">
          <span class="menu-icon"><i class="mdi mdi mdi-email"></i></span>
          <span class="menu-title">Messages</span>
        </a>
      </li>

  </ul>
 
</nav>
