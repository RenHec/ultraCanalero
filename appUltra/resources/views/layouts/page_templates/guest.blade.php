@include('layouts.navbars.navs.guest')
<div class="wrapper wrapper-full-page">
  <div class="page-header login-page header-filter" filter-color="black" style="background-image: url('{{ asset('material') }}/img/login.webp'); background-size: cover; background-position: top center;align-items: center;" data-color="purple"> 
    <audio src="{{ asset('audio') }}/cuatro.mp3" loop autoplay preload="auto"></audio>
    <!--   you can change the color of the filter page using: data-color="blue | purple | green | orange | red | rose " -->
    @yield('content')
    <!-- Messenger plugin de chat Code
    <div id="fb-root"></div>  -->

    <!-- Your plugin de chat code 
    <div id="fb-customer-chat" class="fb-customerchat"> -->
    </div>
  </div>
  @include('layouts.footers.guest')
</div>
