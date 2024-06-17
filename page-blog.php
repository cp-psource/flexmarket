<?php get_header(); ?>

<?php
/*
Template Name: Blog Page
*/
?>

	<!-- Page -->
	<div id="page-wrapper">

					<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

					<?php 
						$headerbgcolor = esc_attr(get_post_meta( $post->ID, '_mpt_page_header_bg_color', true ));
						$headertextcolor = esc_attr(get_post_meta( $post->ID, '_mpt_page_header_text_color', true ));
						$contentbgcolor = esc_attr(get_post_meta( $post->ID, '_mpt_page_content_bg_color', true ));
						$contenttextcolor = esc_attr(get_post_meta( $post->ID, '_mpt_page_content_text_color', true ));

						$col = get_post_meta( $post->ID, '_mpt_blog_page_layout', true );
						$entries = get_post_meta( $post->ID, '_mpt_blog_page_entries', true );
					?>

		<div class="header-section"<?php echo ($headerbgcolor != '#' && !empty($headerbgcolor) ? ' style="background: '.$headerbgcolor.';"' : '') ?>>
			<div class="outercontainer">
				<div class="container">

					<div class="clear padding30"></div>				
							
						<h1 class="page-header"><span<?php echo ($headertextcolor != '#' && !empty($headertextcolor) ? ' style="color: '.$headertextcolor.';"' : '') ?>><?php the_title(); ?></span></h1>


					<div class="clear padding15"></div>

				</div><!-- / container -->
			</div><!-- / outercontainer -->	
		</div><!-- / header-section -->	


		<div class="content-section"<?php echo ($contentbgcolor != '#' && !empty($contentbgcolor) ? ' style="background: '.$contentbgcolor.';"' : '') ?>>
			<div class="outercontainer">
				<div class="clear padding30"></div>	
				<div class="container">

					<div class="row-fluid">
						<div class="span<?php echo ($col == '2col' || $col == '3col' ? '12' : '8') ?>"<?php echo ($contenttextcolor != '#' && !empty($contenttextcolor) ? ' style="color: '.$contenttextcolor.';"' : '') ?>>

							<?php the_content(); ?>					

					<?php endwhile; endif; ?>

							<?php echo ($col == '2col' || $col == '3col' ? '<div class="row-fluid">' : '') ?>

							<?php
								$count = 1;
								$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
								query_posts( 'post_type=post&paged='.$paged.'&posts_per_page='.$entries );
							?>

							<?php if (have_posts()) : while (have_posts()) : the_post(); ?>	

							<?php 
								switch ($col) {
									case '1col':
										get_template_part('blog', '1col');
										break;

									case '2col':
										get_template_part('blog', '2col');
										break;

									case '3col':
										get_template_part('blog', '3col');
										break;
									
									default:
										get_template_part('blog', '1col');
										break;
								}

							?>

							<?php 
								if ($col == '2col') {
									if ( $count == '2' ) { 
										echo '</div><div class="row-fluid">';
										$count = 0;
									} 
								}

								if ($col == '3col') {
									if ( $count == '3' ) { 
										echo '</div><div class="row-fluid">';
										$count = 0;
									} 
								}
							?>

							<?php $count++; ?>

							<?php endwhile; endif; ?>

							<?php echo ($col == '2col' || $col == '3col' ? '</div>' : '') ?>

							<div class="clear"></div>

							<div class="pull-right">
							
								<?php 

								    $total_pages = $wp_query->max_num_pages;  
								    if ($total_pages > 1){  
								      $current_page = max(1, get_query_var('paged'));  
								      echo '<div class="pagination">';
								      echo paginate_links(array(  
								          'base' => get_pagenum_link(1) . '%_%',  
								          'format' => 'page/%#%',  
								          'current' => $current_page,  
								          'total' => $total_pages,  
								          'type'  => 'list'
								        ));  
								      echo '</div>';
								    }  
								
								 ?>

							</div>

							<?php wp_reset_query(); ?>

						</div><!-- / span -->
						
						<?php if ($col == '2col' || $col == '3col') {} else { ?>
							<div id="sidebar" class="span4">
									<?php get_sidebar(); ?>
							</div>
						<?php } ?>

					</div><!-- / row-fluid -->

					
					<div class="padding20"></div>

				</div><!-- / container -->
			</div><!-- / outercontainer -->	
		</div><!-- / content-section -->	

	</div><!-- / page-wrapper -->

<?php get_template_part('footer', 'widget'); ?>

<?php get_footer(); ?>