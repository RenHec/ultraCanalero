@include('layouts.navbars.navs.guest')
<div class="wrapper wrapper-full-page">
  <div class="page-header login-page header-filter" filter-color="black" style="background-image: url('{{ asset('material') }}/img/login.webp'); background-size: cover; background-position: top center;align-items: center;" data-color="purple"> 
    <audio src="{{ asset('audio') }}/cuatro.mp3" loop autoplay preload="auto"></audio>
    <!--   you can change the color of the filter page using: data-color="blue | purple | green | orange | red | rose " -->
    @yield('content')
    <!-- Messenger plugin de chat Code -->
    <div id="fb-root"></div>

    <!-- Your plugin de chat code -->
    <div id="fb-customer-chat" class="fb-customerchat">
    </div>
    @include('layouts.footers.guest')
  </div>
</div>
@push('js')
  <script>
    var chatbox = document.getElementById('fb-customer-chat');
    chatbox.setAttribute("page_id", "1941669916118053");
    chatbox.setAttribute("attribution", "biz_inbox");
    window.fbAsyncInit = function() {
      FB.init({
        xfbml            : true,
        version          : 'v11.0'
      });
    };

    (function(d, s, id) {
      var js, fjs = d.getElementsByTagName(s)[0];
      if (d.getElementById(id)) return;
      js = d.createElement(s); js.id = id;
      js.src = 'https://connect.facebook.net/es_ES/sdk/xfbml.customerchat.js';
      fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));
  </script>
@endpush
