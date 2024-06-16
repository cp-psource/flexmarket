	<!-- Footer section-->
	<div class="footer-wrapper">
		<div class="outercontainer">
		<div class="clear padding10"></div>
			<div class="container">

				<div class="row-fluid">

					<div class="span4 pull-left">
						<ul class="social-links">
							<?php mpt_show_fb_icon(); ?>
							<?php mpt_show_twit_icon(); ?>
							<?php mpt_show_gplus_icon(); ?>
							<?php mpt_show_dribbble_icon(); ?>
							<?php mpt_show_vimeo_icon(); ?>
							<?php mpt_show_rss_icon(); ?>
						</ul>
					</div>

					<div class="span8">
						<div class="pull-right">
							<?php mpt_load_footer_text(); ?>
						</div>
					</div>

				</div>

			</div>
		</div>
		<div class="clear"></div>
	</div>
	<!-- End Footer section -->

	<?php get_template_part('js') ?>

	<?php mpt_load_body_code(); ?>

	<?php wp_footer();?>
	
</body>
</html>