<?php
/*
Template name: Browse Deals
*/
get_header();
?>

<div id="post-<?php the_ID(); ?>" <?php post_class('page-wrapper'); ?>>

	<div class="container">
		
		<div class="row">

			<div class="col-sm-8 col-md-9 <?php echo fw_ssd_get_option('sidebar-switch') == 'left' ? 'col-sm-push-4 col-md-push-3' : '' ?>">

				<?php if ( get_the_title() ) : ?>
					<div class="section-title-block">
						<h1 class="section-title"><?php echo get_the_title(); ?></h1>
						<?php 
						if ( function_exists('fw_ext_breadcrumbs') ) {
							fw_ext_breadcrumbs( '>' );
						}
						?>
					</div><!-- end section-title-block -->
				<?php endif; ?>

				<?php 
				/**
				*  Posts Filter
				*/
				get_template_part( 'partials/content', 'sort-deals' );
				?>
				<?php 
				/**
				*  Posts Loop
				*/
				get_template_part( 'loop/loop', 'deals' );
				?>

			</div><!-- end col-sm-8 col-md-9 -->
			<?php get_sidebar(); ?>
		</div><!-- end rows cols-np -->

	</div><!-- end container -->

</div><!-- end post-id -->

<?php
get_footer();
?>