<?php
/** Google Map block **/

if(!class_exists('AQ_Map_Block')) {
	class AQ_Map_Block extends AQ_Block {
		
		//set and create block
		function __construct() {
			$block_options = array(
				'name' => 'Google Map',
				'size' => 'span6',
			);
			
			//create the block
			parent::__construct('aq_map_block', $block_options);
		}
		
		function form($instance) {
			
			$defaults = array(
				'title' => '',
				'heading' => 'h3',
				'address' => '',
				'width' => '560',
				'height' => '280',
				'id' => '',
				'class' => '',
				'style' => ''
			);
			$instance = wp_parse_args($instance, $defaults);
			extract($instance);
			
			$heading_style = array(
				'h1' => 'H1',
				'h2' => 'H2',
				'h3' => 'H3',
				'h4' => 'H4',
				'h5' => 'H5',
				'h6' => 'H6',
			);
			
			?>
			
			<div class="description two-third">
				<label for="<?php echo $this->get_field_id('title') ?>">
					Title (optional)<br/>
					<?php echo aq_field_input('title', $block_id, $title) ?>
				</label>
			</div>

			<div class="description third last">
				<label for="<?php echo $this->get_field_id('heading') ?>">
					Heading Type<br/>
					<?php echo aq_field_select('heading', $block_id, $heading_style, $heading); ?>
				</label>
			</div>

			<div class="description">
				<label for="<?php echo $this->get_field_id('address') ?>">
					Address<br/>
					<?php echo aq_field_textarea('address', $block_id, $address, $size = 'full') ?>
				</label>
			</div>

			<div class="description half">
				<label for="<?php echo $this->get_field_id('width') ?>">
					Map Width<br/>
					<?php echo aq_field_input('width', $block_id, $width) ?>
				</label>
			</div>

			<div class="description half last">
				<label for="<?php echo $this->get_field_id('height') ?>">
					Map Height<br/>
					<?php echo aq_field_input('height', $block_id, $height) ?>
				</label>
			</div>

			<div class="description half">
				<label for="<?php echo $this->get_field_id('id') ?>">
					id (optional)<br/>
					<?php echo aq_field_input('id', $block_id, $id, $size = 'full') ?>
				</label>
			</div>

			<div class="description half last">
				<label for="<?php echo $this->get_field_id('class') ?>">
					class (optional)<br/>
					<?php echo aq_field_input('class', $block_id, $class, $size = 'full') ?>
				</label>
			</div>

			<div class="cf"></div>

			<div class="description">
				<label for="<?php echo $this->get_field_id('style') ?>">
					Additional inline css styling (optional)<br/>
					<?php echo aq_field_input('style', $block_id, $style) ?>
				</label>
			</div>

			<?php
			
		}
		
		function block($instance) {
			extract($instance);

			$id = (!empty($id) ? ' id="'.esc_attr($id).'"' : '');
			$userclass = (!empty($class) ? ' '.esc_attr($class) : '');
			$style = (!empty($style) ? ' style="'.esc_attr($style).'"' : '');
			
			$output = '';

			$addresscode = str_replace(" ", "+", esc_attr($address));

			$output .= '<div'.$id.' class="google-map-block'.$userclass.'"'.$style.'>';
			$output .= (!empty($title) ? '<'.$heading.' class="page-header">'.strip_tags($title).'</'.$heading.'>' : '');
			$output .= '<div class="well well-small">';
			$output .= '<img src="http://maps.google.com/maps/api/staticmap?size='.esc_attr($width).'x'.esc_attr($height).'&zoom=15&maptype=roadmap&markers=color:green|'.$addresscode.'&sensor=false" alt="Business Location" />';
			$output .= '</div>';
			$output .= '</div>';

			echo $output;
			
		}
		
	}
}