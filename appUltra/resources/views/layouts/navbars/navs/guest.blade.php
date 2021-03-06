<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-transparent navbar-absolute fixed-top text-white">
  <div class="container">
    <div class="navbar-wrapper">
      <a class="navbar-brand" href="{{ route('welcome') }}">{{ $title }}</a>
    </div>
    <button class="navbar-toggler" type="button" data-toggle="collapse" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
      <span class="sr-only">Toggle navigation</span>
      <span class="navbar-toggler-icon icon-bar"></span>
      <span class="navbar-toggler-icon icon-bar"></span>
      <span class="navbar-toggler-icon icon-bar"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-end">
      <ul class="navbar-nav">
        <li class="nav-item{{ $activePage == 'registro' ? ' active' : '' }}">
          <a href="{{ route('registro.index') }}" class="nav-link">
            <i class="material-icons">person_add</i> {{ __('Registrarse') }}
          </a>
        </li>
        <li class="nav-item{{ $activePage == 'lista-registro' ? ' active' : '' }}">
          <a href="{{ route('registro.show') }}" class="nav-link">
            <i class="material-icons">list_alt</i> {{ __('Ver listado') }}
          </a>
        </li>
      </ul>
    </div>
  </div>
</nav>
<!-- End Navbar -->