<?php
 /* 
 Template Name: Homepage 
 */
 ?>
 <?php get_header(); ?>





<div id="main" class="main">
	
	<?php
			if ( have_posts() ) {
				while ( have_posts() ) :
					the_post();
				?>
							<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<div class="page-content">
					<?php the_content(); ?>
				</div>
			</div>
			<?php
			endwhile;
			};
?>


</div>






<?php get_footer(); ?>

