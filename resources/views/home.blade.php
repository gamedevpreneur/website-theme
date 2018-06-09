@extends('layouts.default')

@section('content')
<header class="header">
    @include('layouts.navbar')
    <div id="home" class="home-header">
        <div class="home-signup-container">
            <div class="home-signup-message">
                <h2 class="home-signup-title">Sign up for exclusive game development tips.</h2>
            </div>
            <div class="home-signup-box">
                <div class="home-signup-form-wrap">
                    <form id="ck_subscribe_form" class="ck_subscribe_form main-signup-form" action="" data-remote="true">
                        <input type="hidden" value="{&quot;form_style&quot;:&quot;minimal&quot;,&quot;embed_style&quot;:&quot;inline&quot;,&quot;embed_trigger&quot;:&quot;scroll_percentage&quot;,&quot;scroll_percentage&quot;:&quot;70&quot;,&quot;delay_seconds&quot;:&quot;10&quot;,&quot;display_position&quot;:&quot;br&quot;,&quot;display_devices&quot;:&quot;all&quot;,&quot;days_no_show&quot;:&quot;15&quot;,&quot;converted_behavior&quot;:&quot;show&quot;}" id="ck_form_options">       <input type="hidden" name="id" value="141553" id="landing_page_id">
                        <input type="hidden" name="ck_form_recaptcha" value="" id="ck_form_recaptcha">
                        <input type="text" name="name" class="form-control" id="ck_emailField" placeholder="your name" required />
                        <input type="email" name="email" class="form-control" placeholder="your-best@email.com" required/>
                        <button class="subscribe_button ck_subscribe_button btn-subscribe fields" id="ck_subscribe_button">         Subscribe       </button>       
                    </form>
                </div>
            </div>
        </div>
    </div>
</header>
<div class="entry-content">
    <div class="posts">
        @wpposts
            <article id="post-<?php the_ID(); ?>" <?php post_class("post-summary"); ?>>
                <h2 class="entry-title"><a href="{{ esc_url( get_permalink() ) }}" rel="bookmark">{{ get_the_title() }}</a></h2>
                <div class="entry-summary">
                    <?php the_excerpt(); ?>
                </div>
                <a href="{{ esc_url( get_permalink() ) }}" class="btn-continue-reading">Continue Reading</a>
            </article>
        @endposts
        @include('layouts.pagination')
    </div>
    <aside class="sidebar">
        <div>
            Signup box
        </div>
    </aside>
</div>
@endsection