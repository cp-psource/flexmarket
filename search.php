<?php get_header(); ?>

	<!-- Page -->
	<div id="page-wrapper">

		<div class="header-section">
			<div class="outercontainer">
				<div class="container">

					<div class="clear padding30"></div>	

						<?php if (have_posts()) : ?>

							<h2 class="page-header"><span><?php _e('Search Results' , 'flexmarket'); ?></span></h2>

						<div class="clear padding15"></div>

				</div><!-- / container -->
			</div><!-- / outercontainer -->	
		</div><!-- / header-section -->	


		<div class="content-section">
			<div class="outercontainer">
				<div class="clear padding30"></div>	
				<div class="container">

					<div class="row-fluid">
						<div class="span8">

							<?php while (have_posts()) : the_post(); ?>	

							<div class="blog-post">

								<div class="row-fluid">

									<div class="span2">

										<center>

										<?php 
											$year  = get_the_time('Y'); 
											$month = get_the_time('M'); 
											$day   = get_the_time('j'); 
										?>

										<div class="date">

											<span class="month"><?php echo $month; ?></span>

											<div class="clear"></div>

											<span class="day"><?php echo $day; ?></span>

											<div class="clear"></div>

											<span class="year"><?php echo $year; ?></span>

										</div>

										<div class="comments"><a href="<?php comments_link(); ?>"><?php comments_number( 'No Comments' , '1 Comment' , '% Comments' ); ?></a></div>

										</center>

									</div>

									<div class="clear padding10 visible-phone"></div>

									<?php $temp = get_post_meta( $post->ID, '_mpt_post_select_temp', true ); ?>
									<?php if (has_post_thumbnail($post->ID) || $temp == 'video' ) : ?>

									<div class="span5">										
										<div class="align-center">
											<?php
												$id = get_the_ID(); 

												if ($temp == 'image-carousel') {
													mpt_load_image_carousel($id);
												} else if ($temp == 'video') {
													mpt_load_video_post($id , '195');
												} else {
													mpt_load_featured_image($id);
												}
											?>
										</div> 								
									</div>

									<?php endif; ?>

									<div class="clear padding10 visible-phone"></div>

									<div class="span<?php echo (has_post_thumbnail($post->ID) ? '5' : '10'); ?>">

										<a href="<?php the_permalink(); ?>"><h3 class="post-title"><?php the_title(); ?></h3></a>
										
										<div class="post-meta muted">
											<span>Posted By <?php the_author(); ?> In <?php the_category(', '); ?><?php the_tags(' Tagged with ', ', '); ?> </span>
										</div>

										<div class="clear padding5"></div>

										<div class="post-excerpt"><?php the_excerpt();?></div>

										<div class="align-right">
											<a href="<?php the_permalink(); ?>">
												<!-- Button (hidden phone) -->
												<button class="btn btn-large hidden-phone" type="button"><?php _e('Read More &raquo;', 'flexmarket'); ?></button>
												<!-- Button (visible phone) -->
												<button class="btn btn-large btn-block visible-phone" type="button"><?php _e('Read More &raquo;', 'flexmarket'); ?></button>
											</a>
										</div>

									</div>

								</div>

							</div>

							<?php endwhile; ?>

						<?php else : ?>

							<h2 class="page-header"><span>Search Results</span></h2>

							<div class="clear padding10"></div>
						
						</div>

						<div class="span6 hidden-phone"></div>

					</div>

				</div><!-- / container -->
			</div><!-- / outercontainer -->	
		</div><!-- / header-section -->	


		<div class="content-section">
			<div class="outercontainer">
				<div class="clear padding30"></div>	
				<div class="container">

					<div class="row-fluid">
						<div class="span8" style="min-height: 450px;">

							<h2>No posts found.</h2>

							<p>Perhaps try one of the links below:</p>
							<div class="padding10"></div>
							<h4>Most Used Categories</h4>
							<ul>
								<?php wp_list_categories( array( 'orderby' => 'count', 'order' => 'DESC', 'show_count' => 1, 'title_li' => '', 'number' => 10 ) ); ?>
							</ul>
							<div class="padding10"></div>
								<?php
									$archive_stuff = '<p>Try looking in the monthly archives:</p>';
									the_widget( 'WP_Widget_Archives', array('count' => 0 , 'dropdown' => 1 ), array( 'before_title' => '<h4>', 'after_title' => '</h4>'.$archive_stuff ) );
								?>					
							<div class="padding20"></div>
							<p>Or, use the search box below:</p>
							<?php get_search_form(); ?>
							<div class="padding20"></div>

						<?php endif; ?>

						<div class="clear"></div>

						<div class="pull-right">
						
							<?php 

							    $total_pages = $wp_query->max_num_pages;  
							    if ($total_pages > 1){  
							      $current_page = max(1, get_query_var('paged'));  
							      echo '<div class="pagination">';
							      echo paginate_links(array(  
							          'base' => get_pagenum_link(1) . '%_%',  
							          'format' => '/page/%#%',  
							          'current' => $current_page,  
							          'total' => $total_pages,  
							          'type'  => 'list'
							        ));  
							      echo '</div>';
							    }  
							
							 ?>

						</div>

						<?php wp_reset_query(); ?>

						</div><!-- / span9 -->
						
						<div id="sidebar" class="span4">
								<?php get_sidebar(); ?>
						</div>

					</div><!-- / row-fluid -->

					
					<div class="padding20"></div>

				</div><!-- / container -->
			</div><!-- / outercontainer -->	
		</div><!-- / content-section -->	

	</div><!-- / page-wrapper -->

<?php get_template_part('footer', 'widget'); ?>

<?php get_footer(); ?>