<?php
/**
 * Template Name: Sitemap
 *
 * The template for rendering an SEO-friendly site map.
 * 
 * @package Standard
 * @since 	3.0
 * @version	3.0
 */
?>
<?php get_header(); ?>
<?php $has_left_sidebar = is_active_sidebar('left-sidebar'); ?>
<?php $has_right_sidebar = is_active_sidebar('right-sidebar'); ?>
<?php 
	if ($has_left_sidebar && $has_right_sidebar) {
		$main = '6';
	} elseif ($has_left_sidebar) {
		$main = '8';
	} elseif ($has_right_sidebar) {
		$main = '8';
	} else {
		$main = '12';
	}
?>

<div id="wrapper">
	<div class="container">
		<div class="row">

				<?php if ($has_left_sidebar) { ?>
					<div class="sidebar span<?php echo ($has_right_sidebar) ? '3' : '4'?>">
						<?php dynamic_sidebar('left-sidebar'); ?>
					</div>
				<?php } ?>
							
				<div id="main" class="span<?php echo $main; ?> clearfix" role="main">
				
					<?php get_template_part( 'breadcrumbs' ); ?>
				
					<?php if ( have_posts() ) { ?>
						<?php while ( have_posts() ) {
							 the_post(); ?>
							<div id="post-<?php the_ID(); ?> format-standard" <?php post_class( 'post' ); ?>>
								<div class="post-header clearfix">
									<h1 class="post-title entry-title"><?php the_title(); ?></h1>	
								</div> <!-- /.post-header -->						
								<div id="content-<?php the_ID(); ?>" class="entry-content clearfix">
									<div id="sitemap-authors">
										<h2 id="authors"><?php _e( 'Authors', 'standard' ); ?></h2>
				
										<ul id="sitemap-authors" class="inline-grid four-up">
											<?php
											foreach( get_users() as $user ) {
												$query = new WP_Query( 'author=' . $user->ID . '&posts_per_page=1' );
												if( $query->have_posts() ) {
													echo '<li>';
														echo '<div class="sitemap-author-meta">';
															echo get_avatar( $user->user_email, $size = '80' );
															$query->the_post();
															echo '<span class="badge">';
																the_author_posts();
															echo '</span>';
															echo '<br>';
															the_author_posts_link();
														echo '</div>';
													echo '</li>';
												} // end if
												wp_reset_postdata();
											} // end foreach
											?>
										</ul>
									</div><!-- /#sitemap-authors -->
									
										<h2 id="pages"><?php _e( 'Pages', 'standard' ); ?></h2>
										<ul id="sitemap-pages">
											<?php
												wp_list_pages(
													array(
														'exclude'	=> get_the_ID(),
														'title_li' 	=> '',
													)
												);
											?>
										</ul>
										
										<h2 id="posts"><?php _e( 'Posts', 'standard' ); ?></h2>
										<ul id="sitemap-posts">
											<?php
												$category_list = '';
												foreach ( get_categories() as $category ) {
																										
													$category_list .= '<li><h3>' . $category->cat_name . '</h3></li>';
													$category_list .= '<ul>';
													
													$category_query = new WP_Query( 'posts_per_page=-1&cat=' . $category->cat_ID ); 
													if( $category_query->have_posts() ) {
													
														while( $category_query->have_posts() ) {
														
															$category_query->the_post();
															$cat = get_the_category();
															if ( '' != get_the_title() ) {
															  $category_list .= '<li><a href="' . get_permalink() . '">' . get_the_title() . '</a></li>';
															} // end if
															
														} // end while

														$category_list .= '</ul>';
														$category_list .= '</li>';
														
													} // end if
																								  
												} // end foreach
												wp_reset_postdata();
												
												echo $category_list;
											?>
										</ul>

								</div><!-- /.entry-content -->
							</div> <!-- /#post- -->
						<?php } // end while ?>
					<?php } // end if ?>
				</div><!-- /#main -->
			
				<?php if ($has_right_sidebar) { ?>
					<div class="sidebar span<?php echo ($has_left_sidebar) ? '3' : '4'?>">
						<?php dynamic_sidebar('right-sidebar'); ?>
					</div>
				<?php } ?>
				
		</div><!--/ row -->
	</div><!--/container -->
</div> <!-- /#wrapper -->
<?php get_footer(); ?>