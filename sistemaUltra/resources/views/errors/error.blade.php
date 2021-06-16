@extends('errors.layout')

@section('content')
<a href="{{ route('welcome') }}">
    <header class="top-header"></header>

    <!--dust particel-->
    <div>
        <div class="starsec"></div>
        <div class="starthird"></div>
        <div class="starfourth"></div>
        <div class="starfifth"></div>
    </div>

    <!--Dust particle end--->
    <div class="lamp__wrap">
        <div class="lamp">
            <div class="cable"></div>
            <div class="cover"></div>
            <div class="in-cover"><div class="bulb"></div></div>
            <div class="light"></div>
        </div>
    </div>
    <!-- END Lamp -->

    <section class="error">
        <!-- Content -->
        <div class="error__content">
            <div class="error__message message">
            <h1 class="message__title">{{ $title }}</h1>
            <p class="message__text">{{ $description }}</p>
            </div>
            <div class="error__nav e-nav">
                <a href="{{ route('welcome') }}" class="e-nav__link"></a>
            </div>
        </div>
        <!-- END Content -->
    </section>
</a> 
@endsection
