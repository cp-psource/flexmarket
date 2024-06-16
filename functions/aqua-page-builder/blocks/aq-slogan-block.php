<?php
/** Slogan block **/
class AQ_Slogan_Block extends AQ_Block {
	
	//set and create block
	function __construct() {
		$block_options = array(
			'name' => 'Slogan',
			'size' => 'span12',
		);
		
		//create the block
		parent::__construct('aq_slogan_block', $block_options);
	}
	
	function form($instance) {
		
		$defaults = array(
			'title' => '',
			'slogan' => '',
			'heading' => 'h1',
			'align' => 'center',
			'bgcolor' => '#f1f1f1',
			'textcolor'	=> '#676767',
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

		$align_options = array(
			'left' => 'Left',
			'center' => 'Center',
			'right' => 'Right'
		);

		
		?>
		<div class="description">
			<label for="<?php echo $this->get_field_id('title') ?>">
				Title (optional)
				<?php echo aq_field_input('title', $block_id, $title, $size = 'full') ?>
			</label>
		</div>
		
		<div class="description">
			<label for="<?php echo $this->get_field_id('slogan') ?>">
				Slogan
				<?php echo aq_field_textarea('slogan', $block_id, $slogan, $size = 'full') ?>
			</label>
		</div>

		<div class="description fourth">
			<label for="<?php echo $this->get_field_id('heading') ?>">
				Heading Type<br/>
				<?php echo aq_field_select('heading', $block_id, $heading_style, $heading); ?>
			</label>
		</div>

		<div class="description fourth">
			<label for="<?php echo $this->get_field_id('align') ?>">
				Align<br/>
				<?php echo aq_field_select('align', $block_id, $align_options, $align); ?>
			</label>
		</div>

		<div class="description fourth">
			<label for="<?php echo $this->get_field_id('bgcolor') ?>">
				Pick a background color<br/>
				<?php echo aq_field_color_picker('bgcolor', $block_id, $bgcolor) ?>
			</label>
		</div>

		<div class="description fourth last">
			<label for="<?php echo $this->get_field_id('textcolor') ?>">
				Pick a text color<br/>
				<?php echo aq_field_color_picker('textcolor', $block_id, $textcolor) ?>
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
		$class = (!empty($class) ? ' '.esc_attr($class) : '');
		$style = (!empty($style) ? ' ' . esc_attr($style) : '');

		switch ($align) {
			case 'left':
				$alignclass = ' align-left';
				break;
			case 'center':
				$alignclass = ' align-center';
				break;
			case 'right':
				$alignclass = ' align-right';
				break;

		}
		
		$output = '';

		$output .= '<div'.$id.' class="hero-unit'.$alignclass.$class.'" style="background: '.$bgcolor.'; color: '.$textcolor.';'.$style.'"">';
		$output .= '<'.$heading.'>';
		$output .= do_shortcode(mpt_content_kses(htmlspecialchars_decode($slogan)));
		$output .= '</'.$heading.'>';
		$output .= '</div>';

		echo $output;
	}
	
}