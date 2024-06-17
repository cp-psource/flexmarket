<?php
/** Heading text block **/
class AQ_Heading_Block extends AQ_Block {

	public $block_id;

	public $name;
	
	//set and create block
	function __construct() {
		$block_options = array(
			'name' => 'Heading Text',
			'size' => 'span6',
		);
		
		//create the block
		parent::__construct('aq_heading_block', $block_options);
	}
	
	function form($instance) {
		
		$defaults = array(
			'title' => 'This is a heading text',
			'heading' => 'h1',
			'pageheader' => '0',
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
		<p class="description">
			<label for="<?php echo $this->get_field_id('title') ?>">
				Heading Text
				<?php echo aq_field_input('title', $block_id, $title, $size = 'full') ?>
			</label>
		</p>

		<div class="cf"></div>

		<div class="description half">
			<label for="<?php echo $this->get_field_id('heading') ?>">
				Heading Type<br/>
				<?php echo aq_field_select('heading', $block_id, $heading_style, $heading); ?>
			</label>
		</div>

		<div class="description half last">
			<label for="<?php echo $this->get_field_id('pageheader') ?>">
				Page Header? <?php echo aq_field_checkbox('pageheader', $block_id, $pageheader); ?>
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

		<p class="description">
			<label for="<?php echo $this->get_field_id('style') ?>">
				Additional inline css styling (optional)<br/>
				<?php echo aq_field_input('style', $block_id, $style) ?>
			</label>
		</p>
		
		<?php
	}
	
	function block($instance) {
		extract($instance);

		$headingclass = '';

		if ($pageheader == '1') {
			$headingclass = 'page-header';
		}
		
		$id = (!empty($id) ? ' id="'.esc_attr($id).'"' : '');
		$headingclass .= (!empty($class) ? ' '.esc_attr($class) : '');
		$style = (!empty($style) ? ' style="' . esc_attr($style).'"' : '');

		if (!empty($headingclass)) {
			$classoutput = ' class="'.$headingclass.'"';
		} else {
			$classoutput = '';
		}

		echo '<'.$heading.$id.$classoutput.$style.'>'.strip_tags($title).'</'.$heading.'>';
	}
	
}