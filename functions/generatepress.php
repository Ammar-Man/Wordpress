<?php

// Filter (lite som middleware), kan användas fär att behandla innehåll i temat
add_filter('generate_post_author_output', function($output) {
    // $output tex.  "by welandfr@arcada.fi
    return $output . " HELLO from filter!!!";
});

// Exempel: Hook, körs på ett visst ställe i temat
function arcada_content() {

    echo '<div class="arcada-content entry-content">
        <p><small>HELLO from <i>generate_after_content</i>-hook!!!!!</small></p>
        </div>';

}
// T.ex. körs vid "generate_after_content"
add_action( 'generate_after_content', 'arcada_content', 10, 0 );