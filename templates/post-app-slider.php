<?php
/**
 * Post App Slider template.
 *
 * This template can be overriden by copying this file to your-theme/bs5-post-app-slider/post-app-slider.php
 *
 * @author 		Bastian Kreiter
 * @package 	bS5 Post App Slider
 * @version     1.0.0
 */



// Post App Slider Shortcode
add_shortcode( 'bs-post-app-slider', 'bootscore_post_app_slider' );
function bootscore_post_app_slider( $atts ) {
	ob_start();
	extract( shortcode_atts( array (
		'type' => 'post',
		'order' => 'date',
		'orderby' => 'date',
		'posts' => -1,
		'category' => '',
	), $atts ) );
	$options = array(
		'post_type' => $type,
		'order' => $order,
		'orderby' => $orderby,
		'posts_per_page' => $posts,
		'category_name' => $category,
	);
	$query = new WP_Query( $options );
	if ( $query->have_posts() ) { ?>


<div class="slider-wrapper">
    <div class="scrolling-wrapper w-100">

        <?php while ( $query->have_posts() ) : $query->the_post(); ?>


        <div class="card text-white border-0">
            <!-- Featured Image-->
            <?php the_post_thumbnail('medium', array('class' => 'card-img')); ?>
            <!--<img class="card-img" src="https://projekte.crftwrk.de/bootcommerce-development/wp-content/uploads/2019/12/dark.png" alt="Card image">-->
            <div class="card-img-overlay d-flex align-items-center justify-content-center">

                <div class="overlay-card card-body text-center">
                    <!-- Title -->
                    <h2 class="blog-post-title h4">
                        <?php the_title(); ?>
                    </h2>

                    <p><?php the_excerpt(); ?></p>

                    <div class="readmore">
                        <a class="btn btn-outline-light" href="<?php the_permalink(); ?>"><?php _e('Read more', 'bootscore'); ?> »</a>
                    </div>
                </div>
            </div>
        </div>

        <?php endwhile; wp_reset_postdata(); ?>

    </div><!-- scrolling-wrapper -->
</div><!-- slider-wrapper -->

<?php $myvariable = ob_get_clean();
	return $myvariable;
	}	
}

// Post App Slider Shortcode End
