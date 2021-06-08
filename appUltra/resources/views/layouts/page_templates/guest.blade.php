@include('layouts.navbars.navs.guest')
<div class="wrapper wrapper-full-page">
  <div class="page-header login-page header-filter" filter-color="black" style="background-image: url('{{ asset('material') }}/img/login.webp'); background-size: cover; background-position: top center;align-items: center;" data-color="purple"> 
    <audio autoplay="" loop controls="" preload="auto">
        <source src="/ultra/audio/tres.mp3" type="audio/mp3">
        <source src="/ultra/audio/uno.mp3" type="audio/mp3">
        <source src="/ultra/audio/dos.mp3" type="audio/mp3">
        Tu navegador no soporta audio HTML5.
    </audio>
    <!--   you can change the color of the filter page using: data-color="blue | purple | green | orange | red | rose " -->
    @yield('content')
    @include('layouts.footers.guest')
  </div>
</div>
