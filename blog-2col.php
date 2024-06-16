						<div class="span6">
							<div class="blog-post">

								<?php $temp = get_post_meta( $post->ID, '_mpt_post_select_temp', true ); ?>
								<?php if (has_post_thumbnail($post->ID) || $temp == 'video' ) : ?>
									
								<div class="align-center">
									<?php
										$id = get_the_ID(); 

										if ($temp == 'image-carousel') {
											mpt_load_image_carousel( $id , 'tb-860');
										} else if ($temp == 'video') {
											mpt_load_video_post( $id , '195');
										} else {
											mpt_load_featured_image( $id , 'tb-860');
										}
									?>
								</div>

								<div class="clear padding10"></div> 								

								<?php endif; ?>

								<div class="row-fluid">

									<div class="span2">

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

										<div class="comments" style="font-size: 0.75em;"><a href="<?php comments_link(); ?>"><?php comments_number( 'No Comments' , '1 Comment' , '% Comments' ); ?></a></div>

									</div>

									<div class="clear padding10 visible-phone"></div>

									<div class="span10">

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
						</div>