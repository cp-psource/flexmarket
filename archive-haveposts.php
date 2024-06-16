							<?php $post = $posts[0]; ?>

							<?php /* If this is a category archive */ if (is_category()) { ?>
								<h2 class="page-header"><span>Archive for the &#8216;<?php single_cat_title(); ?>&#8217; Category</span></h2>

							<?php /* If this is a tag archive */ } elseif( is_tag() ) { ?>
								<h2 class="page-header"><span>Posts Tagged &#8216;<?php single_tag_title(); ?>&#8217;</span></h2>

							<?php /* If this is a daily archive */ } elseif (is_day()) { ?>
								<h2 class="page-header"><span>Archive for <?php the_time('F jS, Y'); ?></span></h2>

							<?php /* If this is a monthly archive */ } elseif (is_month()) { ?>
								<h2 class="page-header"><span>Archive for <?php the_time('F, Y'); ?></span></h2>

							<?php /* If this is a yearly archive */ } elseif (is_year()) { ?>
								<h2 class="page-header"><span>Archive for <?php the_time('Y'); ?></span></h2>

							<?php /* If this is an author archive */ } elseif (is_author()) { ?>
								<h2 class="page-header"><span>Author Archive</span></h2>

							<?php /* If this is a paged archive */ } elseif (isset($_GET['paged']) && !empty($_GET['paged'])) { ?>
								<h2 class="page-header"><span>Blog Archives</span></h2>
							
							<?php } ?>
						
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
													mpt_load_video_post($id);
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
												<button class="btn btn-large hidden-phone" type="button">Read More &raquo;</button>
												<!-- Button (visible phone) -->
												<button class="btn btn-large btn-block visible-phone" type="button">Read More &raquo;</button>
											</a>
										</div>

									</div>

								</div>

							</div>

							<?php endwhile; ?>