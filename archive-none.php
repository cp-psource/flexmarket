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
						<div class="span8" style="min-height: 450px;">

							<h2>Nothing Found.</h2>

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
