@extends('layouts.default')

@section('content')
<header class="front-page header">
    @include('layouts.navbar')
    <div id="home" class="hero">
        <div class="hero-container">
            <div class="hero-message">
                <h2 class="hero-title">Make your dream game. Fast.</h2>
                <h3 class="hero-subhead">Enter your email below and don't miss my step-by-step game development tips.</h3>
            </div>
            <div class="hero-signup-box">
                <div class="hero-signup-form-wrap">
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
@endsection
