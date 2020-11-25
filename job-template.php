<?php
/*
Template Name:  Job
*/
get_header();
?>

	<main id="primary" class="site-main">
        <div class="container fl-content-full">
            <div class="row">
                <div class="col-sm-12 fl-content">
                <?php
                    // Get all the categories
                    $i=1;
                    $categories = get_terms( 'job_category' ); // taxonomy category

                    // Loop through all the returned terms
                    foreach ( $categories as $category ):

                        // set up a new query for each category, pulling in related posts.
                        $services = new WP_Query(
                            array(
                                'post_type' => 'job', // custom post type name
                                'showposts' => -1,
                                'tax_query' => array(
                                    array(
                                        'taxonomy'  => 'job_category',
                                        'terms'     => array( $category->slug ),
                                        'field'     => 'slug'
                                    )
                                )
                            )
                        );
                    ?>

                    <h3><?php echo str_pad($i++, 2, "0", STR_PAD_LEFT); ?>. <?php echo $category->name; ?></h3>
                    <ul>
                    <?php while ($services->have_posts()) : $services->the_post(); ?>
                        <li><?php the_title(); ?></li>
                    <?php endwhile; ?>
                    </ul>

                    <?php
                        // Reset things, for good measure
                        $services = null;
                        wp_reset_postdata();

                    // end the loop
                    endforeach;
                    ?>
                </div>
            </div>
        </div>
	</main><!-- #main -->

<?php
get_footer();