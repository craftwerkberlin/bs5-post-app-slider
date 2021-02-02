<?php
/*Plugin Name: bS5 Post App Slider
Plugin URI: https://bootscore.me/plugins/bs-post-app-slider/
Description: Post App Slider for bootScore theme https://bootscore.me. Use Shortcode like this [bs-post-app-slider type="post" category="sample-category" order="ASC" orderby="title" posts="12"] and read readme.txt in PlugIn folder for options.
Version: 5.0.0
Author: Bastian Kreiter
Author URI: https://crftwrk.de
License: GPLv2
*/




// Register Styles and Scripts
function app_slider_scripts() {
    
    wp_register_style( 'app-style', plugins_url('css/app-style.css', __FILE__) );
        wp_enqueue_style( 'app-style' );
    }

add_action('wp_enqueue_scripts','app_slider_scripts');
// Register Styles and Scripts End




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
    <div class="scrolling-wrapper">

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
