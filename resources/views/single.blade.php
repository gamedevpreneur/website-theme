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
                        <a class="nav-link" href="{{ home_url( '/' ) }}/blog">Blog</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
<header>
<div id="primary" class="content-area">
    <main id="main" class="site-main" role="main">
        <article {!! post_class() !!} id="post-@id">
            <header class="entry-header">
                <?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
            </header>

            <?php echo get_the_post_thumbnail( $post->ID, 'large' ); ?>

            <div class="entry-content">
                @wpposts
                    <?php the_content(); ?>
                @endposts
            </div>

            @include('layouts.comments')
        </article>
    </main>
</div>
@endsection