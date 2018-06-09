<?php
if ( is_singular() ) {
    return;
}

global $wp_query;

// Stop execution if there's only 1 page 
if ( $wp_query->max_num_pages <= 1 ) {
    return;
}

$paged = get_query_var( 'paged' ) ? absint( get_query_var( 'paged' ) ) : 1;
$max   = intval( $wp_query->max_num_pages );

/**    Add current page to the array */
if ( $paged >= 1 ) {
    $links[] = $paged;
}

/**    Add the pages around the current page to the array */
if ( $paged >= 3 ) {
    $links[] = $paged - 1;
    $links[] = $paged - 2;
}

if ( ( $paged + 2 ) <= $max ) {
    $links[] = $paged + 2;
    $links[] = $paged + 1;
}

?>

<nav aria-label="Page navigation">
    <ul class="pagination">
        @if(!in_array( 1, $links )) 
            <li class="page-item @echoif('active', 1 == $paged)">
                <a class="page-link" href="{{ get_pagenum_link( 1 )}}"><i class="fa fa-step-backward" aria-hidden="true"></i></a>
            </li>

            @if($paged > 1)
                <li class="page-item page-item-direction page-item-prev">
                    <span class="page-link">
                        <a href="{{ get_pagenum_link( $paged -1) }}">
                            <span aria-hidden="true">&laquo;</span><span class="sr-only">Previous page</span>
                        </a>
                    </span> 
                </li>
            @endif

            @if(!in_array( 2, $links ))
                <li class="page-item"></li>
            @endif
        @endif

        <?php sort( $links ); ?>
        @foreach($links as $link) 
            <li class="page-item @echoif('active', $paged == $link)">
                <a class="page-link" href="{{ get_pagenum_link( $link ) }}">{{ $link }}</a>
            </li>
        @endforeach

        @if($paged < $max)
            <li class="page-item page-item-direction page-item-next">
                <span class="page-link">
                    <a href="{{ get_pagenum_link( $paged + 1) }}">
                        <span aria-hidden="true">&raquo;</span><span class="sr-only">Next page</span>
                    </a>
                </span> 
            </li>
        @endif

        @if(!in_array( $max, $links )) 
            @if(!in_array( $max - 1, $links )) 
                <li class="page-item"></li>
            @endif
            
            <li class="page-item @echoif('active', $paged == $max)">
                <a class="page-link" href="{{ get_pagenum_link( esc_html( $max ) ) }}" aria-label="Next">
                    <span aria-hidden="true"><i class="fa fa-step-forward" aria-hidden="true"></i></span><span class="sr-only">{{ esc_html( $max ) }}</span>
                </a>
            </li>
        @endif
    </ul>
</nav>
