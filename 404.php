<?php get_header(); ?>

	<!-- Page -->
	<div id="page-wrapper">

		<div class="header-section">
			<div class="outercontainer">
				<div class="container">
						
					<div class="clear padding30"></div>
							
						<h1 class="page-header"><span>Page Not Found</span></h1>

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

							<p>It seems that we are unable to find what you are looking for. Perhaps try one of the links below:</p>
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
						
						</div><!-- / span8 -->
						
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