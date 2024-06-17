<?php
/** Blog Updates block **/
class AQ_Blog_Updates_Block extends AQ_Block {

	public $name;
	public $block_id;
	
	//set and create block
	function __construct() {
		$block_options = array(
			'name' => 'Blog Updates',
			'size' => 'span12',
		);
		
		//create the block
		parent::__construct('aq_blog_updates_block', $block_options);
	}
	
	function form($instance) {
		
		$defaults = array(
			'layout' => '4col',
			'entries' => '4',
			'excerpt' => '100',
		);
		$instance = wp_parse_args($instance, $defaults);
		extract($instance);

		$layout_options = array(
			'2col' => '2 Columns',
			'3col' => '3 Columns',
			'4col' => '4 Columns'
		);

		$entries_options = array(
			'2' => '2',
			'3' => '3',
			'4' => '4',
			'5' => '5',
			'6' => '6',
			'7' => '7',
			'8' => '8',
			'9' => '9',
			'10' => '10',
			'11' => '11',
			'12' => '12',
			'13' => '13',
			'14' => '14',
			'15' => '15',
			'16' => '16',
			'17' => '17',
			'18' => '18',
			'19' => '19',
			'20' => '20'
		);
		
		?>

		<div class="description half">
			<label for="<?php echo $this->get_field_id('layout') ?>">
				Layout<br/>
				<?php echo aq_field_select('layout', $block_id, $layout_options, $layout); ?>
			</label>
		</div>

		<div class="description half last">
			<label for="<?php echo $this->get_field_id('entries') ?>">
				Number of Entries<br/>
				<?php echo aq_field_select('entries', $block_id, $entries_options, $entries); ?>
			</label>
		</div>

		<div class="description half">
			<label for="<?php echo $this->get_field_id('excerpt') ?>">
				Maximum Character in Excerpt<br/>
				<?php echo aq_field_input('excerpt', $block_id, $excerpt, $size = 'full') ?>
				<em style="padding-left: 5px; font-size: 0.75em;">Leave it blank or enter "0" to disable excerpt.</em>
			</label>
		</div>
		
		<?php
	}
	
	function block($instance) {
		extract($instance);

		switch ($layout) {
			case '2col':
				$span = 'span6';
				$imagesize = 'tb-860';
				$counter = '2';
				$videoheight = '195';
				break;
			case '3col':
				$span = 'span4';
				$imagesize = 'tb-360';
				$counter = '3';
				$videoheight = '245';
				break;
			case '4col':
				$span = 'span3';
				$imagesize = 'tb-360';
				$counter = '4';
				$videoheight = '145';
				break;							
			default:
				$span = 'span3';
				$imagesize = 'tb-360';
				$counter = '4';
				$videoheight = '145';
				break;
		}

	?>

	<div id="blog-updates">

		<div class="row-fluid">

		<?php
			$count = 1;
			query_posts( 'showposts='.$entries.'&post_type=post' );
		?>

		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>	
			
			<div class="<?php echo $span; ?> well well-small">

				<?php
					$id = get_the_ID(); 
					$temp = get_post_meta( $id, '_mpt_post_select_temp', true );

					if ($temp == 'image-carousel') {
						mpt_load_image_carousel($id , $imagesize);
					} else if ($temp == 'video') {
						mpt_load_video_post($id , $videoheight);
					} else {
						mpt_load_featured_image($id , $imagesize);
					}
				?>
				
				<a href="<?php the_permalink(); ?>"><h3 class="post-title"><?php the_title(); ?></h3></a>
				<p class="post-meta">Posted By <?php the_author(); ?> on <?php the_date(); ?></p>
				<?php if (!empty($excerpt) || $excerpt == '0') { ?>
					<p><?php the_excerpt_max_charlength(esc_attr($excerpt));?></p>
				<?php } ?>
			</div>

			<?php if ( $count == $counter ): ?>
				</div>
				<div class="row-fluid">
				<?php $count = 0; ?>
			<?php endif; ?>

			<?php $count++; ?>	

		<?php endwhile; endif; ?>

		<?php wp_reset_query(); ?>

		</div>

	</div>

	<?php

	}
	
}