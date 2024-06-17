<?php
/** Separator block 
 * 
 * Separate the floats vertically
 * Optional to use horizontal lines/images
**/
class AQ_Separator_Block extends AQ_Block {

	public $block_id;

	public $name;
	
	//set and create block
	function __construct() {
		$block_options = array(
			'name' => 'Separator',
			'size' => 'span12',
		);
		
		//create the block
		parent::__construct('aq_separator_block', $block_options);
	}
	
	function form($instance) {
		
		$defaults = array(
			'horizontal_line' => 'none',
			'line_color' => '#e5e5e5',
			'pattern' => '1',
			'height' => '5'
		);
		
		$line_options = array(
			'none' => 'None',
			'solid' => 'Solid',
			'dashed' => 'Dashed',
			'dotted' => 'Dotted',
		);
		
		$instance = wp_parse_args($instance, $defaults);
		extract($instance);
		
		$line_color = isset($line_color) ? $line_color : '#353535';
		
		?>
		<div class="description note">
			<?php _e('Use this block to clear the floats between two or more separate blocks vertically.', 'framework') ?>
		</div>

		<div class="description fourth">
			<label for="<?php echo $this->get_field_id('horizontal_line') ?>">
				Pick a horizontal line<br/>
				<?php echo aq_field_select('horizontal_line', $block_id, $line_options, $horizontal_line); ?>
			</label>
		</div>
		<div class="description fourth">
			<label for="<?php echo $this->get_field_id('height') ?>">
				Height<br/>
				<?php echo aq_field_input('height', $block_id, $height, 'min', 'number') ?> px
			</label>
			
		</div>
		<div class="description half last">
			<label for="<?php echo $this->get_field_id('line_color') ?>">
				Pick a line color<br/>
				<?php echo aq_field_color_picker('line_color', $block_id, $line_color, $defaults['line_color']) ?>
			</label>
			
		</div>
		<?php
		
	}
	
	function block($instance) {
		extract($instance);
		
		switch($horizontal_line) {
			case 'none':
				echo '<div class="cf" style="height: '.esc_attr($height).'px;margin-bottom: '.esc_attr($height).'px;"></div>';
				break;
			case 'solid':
				echo '<div class="cf" style="border-bottom: 1px solid '.$line_color.';height: '.esc_attr($height).'px;margin-bottom: '.esc_attr($height).'px;"></div>';
				break;
			case 'dashed':
				echo '<div class="cf" style="border-bottom: 1px dashed '.$line_color.';height: '.esc_attr($height).'px;margin-bottom: '.esc_attr($height).'px;"></div>';
				break;
			case 'dotted':
				echo '<div class="cf" style="border-bottom: 1px dotted '.$line_color.';height: '.esc_attr($height).'px;margin-bottom: '.esc_attr($height).'px;"></div>';
				break;
		}
		
	}
	
}