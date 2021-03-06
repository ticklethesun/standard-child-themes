<?php
/**
 * The template for providing pagination throughout the theme.
 *
 * @package Standard
 * @since 3.0
 */
?>
<?php global $wp_query; ?>

<?php if( is_single() && 'post' == get_post_type() ) { ?>

	<div id="single-post-nav">
		<ul class="pager">
		
			<?php $trunc_limit = 30; ?>
			
			<?php if( '' != get_previous_post() ) { ?>
				<li class="previous">
					<?php previous_post_link( '<span class="previous-page">%link</span>', __( '<i class="icon-chevron-left icon-white"></i>', 'standard' ) . '&nbsp;' . standard_truncate_text( get_previous_post()->post_title, $trunc_limit ) ); ?>
				</li>
			<?php } // end if ?>
			
			<?php if( '' != get_next_post() ) { ?>
				<li class="next">
				<?php next_post_link( '<span class="no-previous-page-link next-page">%link</span>', '&nbsp;' . standard_truncate_text( get_next_post()->post_title, $trunc_limit ) . __( '<i class="icon-chevron-right icon-white"></i>', 'standard' ) ); ?>
				</li>
			<?php } // end if ?>
		</ul>	
	</div><!-- /#single-post-nav -->

<?php } elseif ( $wp_query->max_num_pages > 1 && ( is_home() || is_archive() || is_search() ) ) { ?>

	<div id="post-nav">
		<ul class="pager">
		
			<?php if( get_next_posts_link() ) { ?>
				<li class="previous">
					<?php next_posts_link( __( '<span class="nav-previous meta-nav"><i class="icon-chevron-left icon-white"></i> Older</span>', 'standard' ) ); ?>
				</li>			
			<?php } // end if ?>
			
			<?php if( get_previous_posts_link() ) { ?>
				<li class="next">
					<?php previous_posts_link( __( '<span class="nav-next meta-nav">Newer <i class="icon-chevron-right icon-white"></i></span>', 'standard' ) ); ?>
				</li>
			<?php } // end if ?>
		
		</ul><!-- /.pager -->
	</div><!-- /#post-nav -->

<?php } // end if/else ?>