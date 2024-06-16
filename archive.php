<?php get_header(); ?>

	<!-- Page -->
	<div id="page-wrapper">

		<div class="header-section">
			<div class="outercontainer">
				<div class="container">

					<div class="clear padding30"></div>					
							
						<?php if (have_posts()) : ?>

							<?php get_template_part('archive', 'haveposts'); ?>

						<?php else : ?>

							<?php get_template_part('archive', 'none'); ?>

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