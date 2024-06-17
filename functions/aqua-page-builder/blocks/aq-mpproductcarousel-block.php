<?php
/** [MP] Product Carousel block **/
class AQ_MP_Product_Carousel_Block extends AQ_Block {

	public $name;
	
	//set and create block
	function __construct() {
		$block_options = array(
			'name' => '[MP] Product Carousel',
			'size' => 'span12',
		);
		
		//create the block
		parent::__construct('aq_mp_product_carousel_block', $block_options);
	}
	
	function form($instance) {
		
		$defaults = array(
			'layout' => '3col',
			'entries' => '9',
			'showcategory' => 'no',
			'order_by' => 'date', 
			'arrange' => 'DESC',
			'taxonomy_type' => 'none',
			'taxonomy' => '',
			'bgcolor' => '#f1f1f1',
			'textcolor' => '#676767',
			'btncolor' => 'yellow',
			'iconcolor' => 'black',
			'speed' => '4000',
			'pause' => 'yes'
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

		$btncolor_options = array(
			'grey' => 'Grey',
			'blue' => 'Blue',
			'lightblue' => 'Light Blue',
			'green' => 'Green',
			'red' => 'Red',
			'yellow' => 'Yellow',
			'black' => 'Black',
		);

		$iconcolor_options = array(
			'blue' => 'Blue',
			'lightblue' => 'Light Blue',
			'green' => 'Green',
			'red' => 'Red',
			'yellow' => 'Yellow',
			'white' => 'White',
			'black' => 'Black',
		);

		$taxonomy_type_options = array(
			'none' => 'No Filter',
			'category' => 'Category',
			'tag' => 'Tag',
		);

		$pause_options = array(
			'yes' => 'Yes',
			'no' => 'No',
		);

		$order_by_options = array(
			'title' => 'Product Name',
			'date' => 'Publish Date',
			'ID' => 'Product ID',
			'author' => 'Product Author',
			'sales' => 'Number of Sales',
			'price' => 'Product Price',
			'rand' => 'Random',
		);

		$order_options = array(
			'DESC' => 'Descending',
			'ASC' => 'Ascending',
		);
		
		?>

		<div class="description half">
			<label for="<?php echo $this->get_field_id('layout') ?>">
				<?php _e('Layout', 'flexmarket') ?><br/>
				<?php echo aq_field_select('layout', $block_id, $layout_options, $layout); ?>
			</label>
		</div>

		<div class="description half last">
			<label for="<?php echo $this->get_field_id('entries') ?>">
				<?php _e('Number of Entries', 'flexmarket') ?><br/>
				<?php echo aq_field_select('entries', $block_id, $entries_options, $entries); ?>
			</label>
		</div>

		<div class="description fourth">
			<label for="<?php echo $this->get_field_id('speed') ?>">
				<?php _e('interval (in millisecond)', 'flexmarket') ?><br />
				<?php echo aq_field_input('speed', $block_id, $speed, $size = 'full') ?>
			</label>
		</div>

		<div class="description fourth">
			<label for="<?php echo $this->get_field_id('pause') ?>">
				<?php _e('Pause on hover?', 'flexmarket') ?><br />
				<?php echo aq_field_select('pause', $block_id, $pause_options, $pause); ?>
			</label>
		</div>
		
		<div class="description half last">
			<label for="<?php echo $this->get_field_id('taxonomyfilter') ?>">
				<?php _e('Taxonomy Filter:', 'flexmarket') ?><br />
				<?php echo aq_field_select('taxonomy_type', $block_id, $taxonomy_type_options, $taxonomy_type); ?> <?php echo aq_field_input('taxonomy', $block_id, $taxonomy, $size = 'full') ?>
			</label>
		</div>

		<div class="description half">
			<label for="<?php echo $this->get_field_id('order_by') ?>">
				<?php _e('Order Products By:', 'flexmarket') ?><br />
				<?php echo aq_field_select('order_by', $block_id, $order_by_options, $order_by); ?>
			</label>
		</div>	

		<div class="description half last">
			<label for="<?php echo $this->get_field_id('arrange') ?>">
				<br />
				<?php echo aq_field_select('arrange', $block_id, $order_options, $arrange); ?>
			</label>
		</div>	

		<div class="description fourth">
			<label for="<?php echo $this->get_field_id('bgcolor') ?>">
				Pick a background color<br/>
				<?php echo aq_field_color_picker('bgcolor', $block_id, $bgcolor) ?>
			</label>
		</div>

		<div class="description fourth">
			<label for="<?php echo $this->get_field_id('textcolor') ?>">
				Pick a text color<br/>
				<?php echo aq_field_color_picker('textcolor', $block_id, $textcolor) ?>
			</label>
		</div>

		<div class="description fourth last">
			<label for="<?php echo $this->get_field_id('btncolor') ?>">
				Button Color<br/>
				<?php echo aq_field_select('btncolor', $block_id, $btncolor_options, $btncolor); ?>
			</label>
		</div>

		<div class="description fourth last">
			<label for="<?php echo $this->get_field_id('iconcolor') ?>">
				Icon Color<br/>
				<?php echo aq_field_select('iconcolor', $block_id, $iconcolor_options, $iconcolor); ?>
			</label>
		</div>
		
		<?php
	}
	
	function block($instance) {
		extract($instance);

		$themefolder = get_template_directory_uri();

	    //setup taxonomy if applicable
	    if ($taxonomy_type == 'category') {
	      $taxonomy_query = '&product_category=' . $taxonomy;
	    } else if ($taxonomy_type == 'tag') {
	      $taxonomy_query = '&product_tag=' . $taxonomy;
	    } else {
	    	$taxonomy_query = '';
	    }

	    //get order by
	    if ($order_by) {
	      if ($order_by == 'price')
	        $order_by_query = '&meta_key=mp_price&orderby=mp_price';
	      else if ($order_by == 'sales')
	        $order_by_query = '&meta_key=mp_sales_count&orderby=mp_sales_count';
	      else
	        $order_by_query = '&orderby='.$order_by;
	    } else {
	      $order_by_query = '&orderby=title';
	    }

		switch ($btncolor) {
			case 'grey':
				$btnclass = '';
				$iconclass = '';
				break;
			case 'blue':
				$btnclass = ' btn-primary';
				$iconclass = ' icon-white';
				break;
			case 'lightblue':
				$btnclass = ' btn-info';
				$iconclass = ' icon-white';
				break;
			case 'green':
				$btnclass = ' btn-success';
				$iconclass = ' icon-white';
				break;
			case 'yellow':
				$btnclass = ' btn-warning';
				$iconclass = ' icon-white';
				break;
			case 'red':
				$btnclass = ' btn-danger';
				$iconclass = ' icon-white';
				break;
			case 'black':
				$btnclass = ' btn-inverse';
				$iconclass = ' icon-white';
				break;
			
		}

		switch ($iconcolor) {
			case 'blue':
				$tagcolor = ' icon-blue';
				break;
			case 'lightblue':
				$tagcolor = ' icon-lightblue';
				break;
			case 'green':
				$tagcolor = ' icon-green';
				break;
			case 'yellow':
				$tagcolor = ' icon-yellow';
				break;
			case 'red':
				$tagcolor = ' icon-red';
				break;
			case 'white':
				$tagcolor = ' icon-white';
				break;		
			case 'black':
				$tagcolor = '';
				break;
			
		}

	?>

		<div id="productCarousel-<?php echo $block_id; ?>" class="carousel productcarousel slide" style="background: <?php echo esc_attr($bgcolor) ?>; color: <?php echo esc_attr($textcolor) ?>;">

			<!-- Control -->
            <div class="pull-right">
	            <a class="fade-in-effect" href="#productCarousel-<?php echo $block_id; ?>" data-slide="prev"><i class="icon-circle-arrow-left"></i></a>
	            <a class="fade-in-effect" href="#productCarousel-<?php echo $block_id; ?>" data-slide="next"><i class="icon-circle-arrow-right"></i></a>
            </div>

            <div class="clear padding10"></div>
           
            <div class="carousel-inner">

				<div class="item active">
					<div class="row-fluid">

				<?php

					switch ($layout) {
						case '2col':
							$span = 'span6';
							$imagesize = 'tb-860';
							$counter = '2';
							break;
						case '3col':
							$span = 'span4';
							$imagesize = 'tb-360';
							$counter = '3';
							break;
						case '4col':
							$span = 'span3';
							$imagesize = 'tb-360';
							$counter = '4';
							$style = 'false';
							break;							
						default:
							$span = 'span4';
							$imagesize = 'tb-360';
							$counter = '3';
							break;
					}

					query_posts( 'post_type=product&showposts=' . $entries . $taxonomy_query . $order_by_query . '&order=' . $arrange );
					$count = 1;
					$num = 1;
				?>

					<?php if (have_posts()) : while (have_posts()) : the_post(); ?>	

						<?php $id = get_the_ID(); ?>

						<?php flexmarket_load_single_product_in_box($span , $id , $imagesize , $btnclass , $iconclass , $tagcolor) ?>

						<?php if ( $num == $entries ): ?>

						<?php else: ?>

							<?php if ( $count == $counter ): ?>
								</div><!-- / row-fluid -->
								</div><!-- / item -->
								<div class="item">
								<div class="row-fluid">
								<?php $count = 0; ?>
							<?php endif; ?>

						<?php endif; ?>

						<?php $count++; ?>
						<?php $num++; ?>

					<?php endwhile; endif; ?>

					</div><!-- / row-fluid -->

				</div><!-- / item -->

				<?php wp_reset_query(); ?>

			</div> <!-- / carousel-inner --> 

		</div> <!-- / product-carousel -->

		<script type="text/javascript">

			jQuery(document).ready(function () {
				jQuery(".productcarousel").carousel({
					interval: <?php echo esc_attr($speed); ?>
					<?php echo ($pause == 'yes' ? ',pause: "hover"' : ''); ?>
				})
			});

		</script>

	<?php

	}
	
}