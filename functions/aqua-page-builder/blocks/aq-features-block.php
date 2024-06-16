<?php
/** Features block **/
class AQ_Features_Block extends AQ_Block {
	
	//set and create block
	function __construct() {
		$block_options = array(
			'name' => 'Features',
			'size' => 'span3',
		);
		
		//create the block
		parent::__construct('aq_features_block', $block_options);
	}
	
	function form($instance) {
		
		$defaults = array(
			'title' => '',
			'heading' => 'h3',
			'text' => '',
			'align' => 'center',
			'bgcolor' => '#fff',
			'textcolor' => '#676767',
			'media' => '',
			'imagesize' => 'full',
			'imagetype' => 'none',
			'enablebtn' => '1',
			'btntext' => 'Learn More',
			'btnlink' => '',
			'btncolor' => 'black',
			'btnsize' => 'default',
			'btnlinkopen' => 'same',
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

		$btncolor_options = array(
			'grey' => 'Grey',
			'blue' => 'Blue',
			'lightblue' => 'Light Blue',
			'green' => 'Green',
			'red' => 'Red',
			'yellow' => 'Yellow',
			'black' => 'Black',
		);

		$btnsize_options = array(
			'default' => 'Default',
			'mini' => 'Mini',
			'small' => 'Small',
			'large' => 'Large',
			'block' => 'Block',
		);

		$btnlinkopen_options = array(
			'same' => 'Same Window',
			'new' => 'New Window'
		);
		
		?>
		<div class="description two-third">
			<label for="<?php echo $this->get_field_id('title') ?>">
				Title
				<?php echo aq_field_input('title', $block_id, $title, $size = 'full') ?>
			</label>
		</div>

		<div class="description third last">
			<label for="<?php echo $this->get_field_id('heading') ?>">
				Heading Style<br/>
				<?php echo aq_field_select('heading', $block_id, $heading_style, $heading); ?>
			</label>
		</div>

		<div class="cf" style="height: 20px"></div>
		
		<div class="description">
			<label for="<?php echo $this->get_field_id('media') ?>">
				Upload an Image
				<?php echo aq_field_upload('media', $block_id, $media, 'image') ?>
			</label>
		</div>

		<div class="description half">
			<label for="<?php echo $this->get_field_id('imagesize') ?>">
				Image Size<br/>
				<?php echo aq_field_select('imagesize', $block_id, $imagesize_options, $imagesize); ?>
			</label>
		</div>

		<div class="description half last">
			<label for="<?php echo $this->get_field_id('imagetype') ?>">
				Image Type<br/>
				<?php echo aq_field_select('imagetype', $block_id, $imagetype_options, $imagetype); ?>
			</label>
		</div>

		<div class="cf" style="height: 20px"></div>

		<div class="description">
			<label for="<?php echo $this->get_field_id('text') ?>">
				Content
				<?php echo aq_field_textarea('text', $block_id, $text, $size = 'full') ?>
			</label>
		</div>

		<div class="cf" style="height: 20px"></div>

		<div class="description">
			<label for="<?php echo $this->get_field_id('enablebtn') ?>">
				Enable Button <?php echo aq_field_checkbox('enablebtn', $block_id, $enablebtn); ?>
			</label>
		</div>

		<div class="description half">
			<label for="<?php echo $this->get_field_id('btntext') ?>">
				Button Text
				<?php echo aq_field_input('btntext', $block_id, $btntext, $size = 'full') ?>
			</label>
		</div>

		<div class="description fourth">
			<label for="<?php echo $this->get_field_id('btncolor') ?>">
				Button Color<br/>
				<?php echo aq_field_select('btncolor', $block_id, $btncolor_options, $btncolor); ?>
			</label>
		</div>

		<div class="description fourth last">
			<label for="<?php echo $this->get_field_id('btnsize') ?>">
				Button Size<br/>
				<?php echo aq_field_select('btnsize', $block_id, $btnsize_options, $btnsize); ?>
			</label>
		</div>

		<div class="description two-third">
			<label for="<?php echo $this->get_field_id('btnlink') ?>">
				Button Link
				<?php echo aq_field_input('btnlink', $block_id, $btnlink, $size = 'full') ?>
			</label>	
		</div>

		<div class="description third last">
			<label for="<?php echo $this->get_field_id('btnlinkopen') ?>">
				Link Open In<br/>
				<?php echo aq_field_select('btnlinkopen', $block_id, $btnlinkopen_options, $btnlinkopen); ?>
			</label>	
		</div>

		<div class="cf" style="height: 20px"></div>

		<div class="description third">
			<label for="<?php echo $this->get_field_id('align') ?>">
				Align<br/>
				<?php echo aq_field_select('align', $block_id, $align_options, $align); ?>
			</label>
		</div>

		<div class="description third">
			<label for="<?php echo $this->get_field_id('bgcolor') ?>">
				Pick a background color<br/>
				<?php echo aq_field_color_picker('bgcolor', $block_id, $bgcolor) ?>
			</label>
		</div>

		<div class="description third last">
			<label for="<?php echo $this->get_field_id('textcolor') ?>">
				Pick a text color<br/>
				<?php echo aq_field_color_picker('textcolor', $block_id, $textcolor) ?>
			</label>
		</div>

		<div class="cf" style="height: 20px"></div>

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
		$style = (!empty($style) ? esc_attr($style) : '');

		switch ($imagetype) {
			case 'none':
				$imageclass = '';
				break;
			case 'rounded':
				$imageclass = ' class="img-rounded"';
				break;
			case 'circle':
				$imageclass = ' class="img-circle"';
				break;
			case 'polaroid':
				$imageclass = ' class="img-polaroid"';
				break;			
		}

		$imageid = get_image_id(esc_url($media));
		$image = wp_get_attachment_image_src( $imageid , $imagesize);

		$btnclass = 'btn';

		switch ($btncolor) {
			case 'grey':
				$btnclass .= '';
				break;
			case 'blue':
				$btnclass .= ' btn-primary';
				break;
			case 'lightblue':
				$btnclass .= ' btn-info';
				break;
			case 'green':
				$btnclass .= ' btn-success';
				break;
			case 'yellow':
				$btnclass .= ' btn-warning';
				break;
			case 'red':
				$btnclass .= ' btn-danger';
				break;
			case 'black':
				$btnclass .= ' btn-inverse';
				break;
			
		}

		switch ($btnsize) {
			case 'default':
				$btnclass .= '';
				break;
			case 'large':
				$btnclass .= ' btn-large';
				break;
			case 'small':
				$btnclass .= ' btn-small';
				break;
			case 'mini':
				$btnclass .= ' btn-mini';
				break;	
			case 'block':
				$btnclass .= ' btn-block';
				break;	
		}

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

		$output .= '<div'.$id.' class="features well well-shadow'.$alignclass.$userclass.'" style="background: '.$bgcolor.';color: '.$textcolor.';'.$style.'">';
		$output .= '<img src="'.$image[0].'"'.$imageclass.' />';
		$output .= '<div class="clear padding5"></div>';
		$output .= '<'.$heading.'>'.strip_tags($title).'</'.$heading.'>';
		$output .= '<div class="opacity8">'.wpautop(do_shortcode(mpt_content_kses(htmlspecialchars_decode($text)))).'</div>';

		if ($enablebtn == '1') {
			$output .= '<a href="'.esc_url($btnlink).'"'.($btnlinkopen == 'new' ? ' target="_blank"' : '').'>';
			$output .= '<button class="'.$btnclass.'">'.esc_attr($btntext).'</button>';
			$output .= '</a>';
		}

		$output .= '</div>';

		echo $output;
	}
	
}