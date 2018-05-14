@extends('layouts.default')

@section('content')
<header class="header">
    <nav class="topnav">
        <div class="topnav-container">
            @unless(has_custom_logo()) 
                <a class="topnav-brand" rel="home" href="{{ home_url( '/' ) }}" title="{{ esc_attr( get_bloginfo( 'name', 'display' ) ) }}"><?php bloginfo( 'name' ); ?></a>
            @else 
                <?php the_custom_logo(); ?>
            @endunless
            
            <button class="topnav-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
                <span class="topnav-toggler-icon fa fa-bars"></span>
            </button>
            <div class="topnav-collapse" id="navbarTogglerDemo02">
                <ul class="topnav-main-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="/blog">Blog</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div id="home" class="hero">
        <div class="hero-container">
            <div class="hero-message">
                <h2 class="hero-title">Make your dream game. Fast.</h2>
            </div>
            <a class="hero-cta-btn" href="">
                <i class="fas fa-gamepad"></i>
                <span>Get Started</span>
            </a>
        </div>
    </div>
</header>
@endsection
