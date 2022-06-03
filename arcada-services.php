<?php

/* Template Name: Arcada Services */

get_header();

?>

<?php if( have_posts() ): ?>

    <?php while( have_posts() ) : the_post(); ?>

    <div id="primary" class="content-area">
            <main id="main" class="site-main">
            <article class="page type-page status-publish">
                    <div class="inside-article">
                            <header class="entry-header">
                                    <h1 class="entry-title" itemprop="headline"><?php the_title(); ?></h1>
                            </header>

                            <div class="entry-content" itemprop="text">
                                    <?php the_content(); ?>
                            </div>
                    </div>

            </article>

            <?php

            $args = array(
                    'posts_per_page' => -1,
                    'post_type' => 'services',
                    'post_status' => 'publish',
                    'orderby' => 'title',
                    'order' => 'ASC',
            );

            $our_services = get_posts( $args );

            if( is_array( $our_services ) && !empty( $our_services ) ) {
                    echo '<div class="services-wrapper">';
                    foreach( $our_services as $postdata ) {
                            $background = '';
                            $get_image = wp_get_attachment_image_src( get_post_thumbnail_id( $postdata->ID ), 'large', false );
                            if( is_array( $get_image ) && !empty( $get_image ) ) {
                              $background = ' style="background-image:url('.$get_image[0].');"';
                            }

                            echo '
                            <div class="service"'.$background.'>
                                    <div style="background-color:rgba(255,255,255,.5);">
                                    <h2><a href="'.get_permalink( $postdata->ID ).'">'.$postdata->post_title.'</a></h2>
                                    <p>'.$postdata->post_excerpt.'</p>
                                    </div>
                            </div>';

                    }

                    echo '</div>';

            }

            ?>

            </main>

    </div>

    <?php endwhile; ?>

<?php endif; ?>

<?php get_footer(); ?>