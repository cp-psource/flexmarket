<?php
/** Image block **/
class AQ_Image_Block extends AQ_Block {

	public $name;
	public $block_id;
	
	//set and create block
	function __construct() {
		$block_options = array(
			'name' => 'Image',
			'size' => 'span6',
		);
		
		//create the block
		parent::__construct('aq_image_block', $block_options);
	}
	
	function form($instance) {
		
		$defaults = array(
			'text' => '',
			'link' => '',
			'media' => '',
			'imagesize' => 'full',
			'type' => 'none',
			'align' => 'none',
			'id' => '',
			'class' => '',
			'style' => ''
		);
		$instance = wp_parse_args($instance, $defaults);
		extract($instance);

		$align_options = array(
			'none' => 'None',
			'left' => 'Left',
			'center' => 'Center',
			'right' => 'Right'
		);

		$imagetype_options = array(
			'none' => 'None',
			'rounded' => 'Rounded',
			'circle' => 'Circle',
			'polaroid' => 'Polaroid'
		);

		$imagesize_options = array(
			'thumbnail' => 'Thumbnail',
			'medium' => 'Medium',
			'large' => 'Large',
			'full' => 'Full',
		);
		
		?>
		<div class="description">
			<label for="<?php echo $this->get_field_id('title') ?>">
				Image Title (optional)<br />
				<?php echo aq_field_input('title', $block_id, $title, $size = 'full') ?>
			</label>
		</div>
		
		<div class="description">
			<label for="<?php echo $this->get_field_id('media') ?>">
				Upload Your Image<br />
				<?php echo aq_field_upload('media', $block_id, $media, 'image') ?>
			</label>
		</div>

		<div class="description">
			<label for="<?php echo $this->get_field_id('link') ?>">
				Link to Page / Post<br />
				<?php echo aq_field_input('link', $block_id, $link, $size = 'full') ?><br />
				<em style="font-size: 0.8em; padding-left: 5px;">Leave it blank if you want to link to image</em>
			</label>
		</div>

		<div class="description third">
			<label for="<?php echo $this->get_field_id('imagesize') ?>">
				Image Size<br/>
				<?php echo aq_field_select('imagesize', $block_id, $imagesize_options, $imagesize); ?>
			</label>
		</div>

		<div class="description third">
			<label for="<?php echo $this->get_field_id('type') ?>">
				Image Type<br/>
				<?php echo aq_field_select('type', $block_id, $imagetype_options, $type); ?>
			</label>
		</div>

		<div class="description third last">
			<label for="<?php echo $this->get_field_id('align') ?>">
				Align<br/>
				<?php echo aq_field_select('align', $block_id, $align_options, $align); ?>
			</label>
		</div>

		<div class="cf"></div>

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

		$classoutput = '';

		$id = (!empty($id) ? ' id="'.esc_attr($id).'"' : '');
		$userclass = (!empty($class) ? esc_attr($class) : '');
		$style = (!empty($style) ? ' style="'.esc_attr($style).'"' : '');

		switch ($type) {
			case 'none':
				$classoutput .= '';
				break;
			case 'rounded':
				$classoutput .= 'img-rounded ';
				break;
			case 'circle':
				$classoutput .= 'img-circle ';
				break;
			case 'polaroid':
				$classoutput .= 'img-polaroid ';
				break;			
		}

		switch ($align) {
			case 'none':
				$classoutput .= '';
				$frontdiv = '';
				$enddiv = '';
				break;
			case 'left':
				$classoutput .= 'pull-left ';
				$frontdiv = '';
				$enddiv = '';
				break;
			case 'center':
				$frontdiv = '<center>';
				$enddiv = '</center>';
				break;
			case 'right':
				$classoutput .= 'pull-right ';
				$frontdiv = '';
				$enddiv = '';
				break;

		}

		$classoutput .= $userclass;

		$imageid = get_image_id(esc_url($media));

		$fullimage = wp_get_attachment_image_src( $imageid , 'full');

		$image = wp_get_attachment_image_src( $imageid , $imagesize);
		
		$output = '';

		$output .= $frontdiv;
		$output .= (!empty($link) ? '<a href="'.esc_url($link).'">' : '<a href="'.$fullimage[0].'" rel="prettyPhoto[image-block]">'); 
		$output .= '<img src="'.$image[0].'"'.$id.(!empty($classoutput) ? ' class="'.$classoutput.'"' : '').$style.' />';
		$output .= '</a>';
		$output .= $enddiv;

		echo $output;
	}
		
}