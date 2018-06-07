@extends('layouts.default')

@section('content')
<header class="header">
    @include('layouts.navbar')
</header>
<div id="app" class="content-area">
    <main id="main" class="site-main" role="main">
        <article {!! post_class() !!} id="post-@id">
            <div class="entry-content">
                @wpposts
                    <?php the_content(); ?>
                @endposts
            </div>

            <?php comments_template('/resources/views/layouts/comments.blade.php') ?>
        </article>
    </main>
</div>
@endsection