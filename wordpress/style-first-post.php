
<!-- #First Loop -->

<?php $featured_loop = new WP_Query( array( 'post_type' => 'related_videos', 'tag' => 'minitab', 'posts_per_page' => 1 ) ); ?>
<?php while( $featured_loop->have_posts() ) : $featured_loop->the_post(); ?>
// Content Here
<?php endwhile; wp_reset_query(); ?>


<!-- #Second Loop -->
<?php $related_loop = new WP_Query( array( 'post_type' => 'related_videos', 'tag' => 'minitab', 'offset' => 1 ) ); ?>
<?php while( $related_loop->have_posts() ) : $related_loop->the_post();?>
<!-- // Content Here -->
<?php endwhile; wp_reset_query(); ?>
