<?php
/** [MarketPress] Product Grid block **/
class AQ_MP_Product_Grid_Block extends AQ_Block {
	
	//set and create block
	function __construct() {
		$block_options = array(
			'name' => '[MP] Product Grid',
			'size' => 'span12',
		);
		
		//create the block
		parent::__construct('aq_mp_product_grid_block', $block_options);
	}
	
	function form($instance) {
		
		$defaults = array(
			'layout' => '3col',
			'entries' => '9',
			'showcategory' => 'no',
			'align' => 'align-center',
			'order_by' => 'date', 
			'arrange' => 'DESC',
			'taxonomy_type' => 'none',
			'taxonomy' => '',
			'bgcolor' => '#fff',
			'textcolor' => '#676767',
			'btncolor' => 'yellow',
			'iconcolor' => 'black',
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

		$showcategory_options = array(
			'yes' => 'Show Category Menu',
			'advsoft' => 'Show Advanced Sort Button',
			'no' => 'Nothing',
		);

		$align_options = array(
			'align-left' => 'Align Left',
			'align-center' => 'Align Center',
			'align-right' => 'Align Right',
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

		<div class="description half">
			<label for="<?php echo $this->get_field_id('showcategory') ?>">
				<?php _e('Additional Functions', 'flexmarket') ?><br />
				<?php echo aq_field_select('showcategory', $block_id, $showcategory_options, $showcategory); ?> 
			</label><div class="cf"></div>
			<label for="<?php echo $this->get_field_id('align') ?>">
			<?php echo aq_field_select('align', $block_id, $align_options, $align); ?>
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

	    //setup taxonomy if applicable
	    if ($taxonomy_type == 'category') {
	      $taxonomy_category = esc_attr($taxonomy);
	      $taxonomy_tag = '';
	      $context = $taxonomy_type;
	    } else if ($taxonomy_type == 'tag') {
	      $taxonomy_tag = esc_attr($taxonomy);
	      $taxonomy_category = '';
	      $context = $taxonomy_type;
	    } else {
	    	$taxonomy_category = '';
	    	$taxonomy_tag = '';
	    	$context = 'list';
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

		switch ($layout) {
			case '2col':
				$span = 'span6';
				$counter = '2';
				break;
			case '3col':
				$span = 'span4';
				$counter = '3';
				break;
			case '4col':
				$span = 'span3';
				$counter = '4';
				break;							
			default:
				$span = 'span4';
				$counter = '3';
				break;
		}

	?>

		<?php if ($showcategory == 'yes') { ?>

			<ul class="mpt-product-categories <?php echo $align; ?>">
				<li>By Category: </li>
				<li id="all">All</li>
				<?php
					$args = array(
						'taxonomy' => 'product_category',
						'orderby' => 'name',
						'order' => 'ASC'
					  );

					$categories = get_categories($args);

					if  ($categories) {
					  foreach($categories as $category) {
					    echo '<li id="'.$category->slug. '">'.$category->name. '</li>';
					  }
					}
				?>
			</ul>

			<div class="clear padding15"></div>

		<?php } ?>

		<?php flexmarket_advance_product_sort( $block_id , ($showcategory == 'advsoft' ? true : false) , $align , $context , true , 'nopagingblock' , '' , $entries, $order_by , $arrange, $taxonomy_category , $taxonomy_tag , $counter, $span, $btnclass, $iconclass, $tagcolor , 'thetermsclass' , ' style="background: '.esc_attr($bgcolor).'; color: '.esc_attr($textcolor).';"'); ?>

	<?php

	}
	
}