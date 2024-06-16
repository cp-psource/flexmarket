<?php
/* MarketPress Shopping Cart Blocks */
class AQ_MPcart_Block extends AQ_Block {

	public $name;
	
	function __construct() {
		$block_options = array(
			'name' => '[MP] Shopping Cart',
			'size' => 'span4',
		);
		
		parent::__construct('AQ_MPcart_Block', $block_options);
	}
	
	function form($instance) {

	    $instance = wp_parse_args( (array) $instance, array( 'title' => __('Shopping Cart', 'flexmarket'), 'custom_text' => '', 'only_store_pages' => 0 ) );
			$title = $instance['title'];
			$custom_text = $instance['custom_text'];
			/*
			$show_thumbnail = isset( $instance['show_thumbnail'] ) ? (bool) $instance['show_thumbnail'] : false;
			$size = !empty($instance['size']) ? intval($instance['size']) : 25;
			*/
	  ?>
			<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'flexmarket') ?> <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></label></p>
			<p><label for="<?php echo $this->get_field_id('custom_text'); ?>"><?php _e('Custom Text:', 'flexmarket') ?><br />
	    <textarea class="widefat" id="<?php echo $this->get_field_id('custom_text'); ?>" name="<?php echo $this->get_field_name('custom_text'); ?>"><?php echo esc_attr($custom_text); ?></textarea></label>
	    </p>
	  <?php
			/* Disable untill we can mod the cart
			<p><input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id('show_thumbnail'); ?>" name="<?php echo $this->get_field_name('show_thumbnail'); ?>"<?php checked( $show_thumbnail ); ?> />
			<label for="<?php echo $this->get_field_id('show_thumbnail'); ?>"><?php _e( 'Show Thumbnail', 'flexmarket' ); ?></label><br />
			<label for="<?php echo $this->get_field_id('size'); ?>"><?php _e('Thumbnail Size:', 'flexmarket') ?> <input id="<?php echo $this->get_field_id('size'); ?>" name="<?php echo $this->get_field_name('size'); ?>" type="text" size="3" value="<?php echo $size; ?>" /></label></p>
			*/
	}
	
	function block($instance) {
		global $mp;


		echo '<div id="sidebar" style="border-left: none; padding: 0px; margin-bottom: 0px;">';

			echo '<div class="well well-small">';

			  $title = $instance['title'];
				if ( !empty( $title ) ) { echo '<h4 class="page-header">' . apply_filters('widget_title', $title) . '</h4>'; };

		    if ( !empty($instance['custom_text']) )
		      echo '<div class="custom_text">' . $instance['custom_text'] . '</div>';

			    echo '<div class="mp_cart_widget_content">';
			    $btnclass = mpt_load_mp_btn_color();
			    flexmarket_show_cart('widget' , NULL , true , $btnclass);
			    echo '</div>';

		    echo '</div>';

		echo '</div>';
	}
	
}