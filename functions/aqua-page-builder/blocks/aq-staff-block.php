<?php
/** Staff block **/
class AQ_Staff_Block extends AQ_Block {

	public $name;
	
	//set and create block
	function __construct() {
		$block_options = array(
			'name' => 'Team Member',
			'size' => 'span3',
		);
		
		//create the block
		parent::__construct('aq_staff_block', $block_options);
	}
	
	function form($instance) {
		
		$defaults = array(
			'title' => '',
			'position' => '',
			'media' => '',
			'text' => '',
			'fb' => '',
			'twitter' => '',
			'email' => '',
			'bgcolor' => '#F8F8F8',
			'textcolor' => '#676767',
			'id' => '',
			'class' => '',
			'style' => ''
		);
		$instance = wp_parse_args($instance, $defaults);
		extract($instance);
		
		?>
		<div class="description half">
			<label for="<?php echo $this->get_field_id('title') ?>">
				Name
				<?php echo aq_field_input('title', $block_id, $title, $size = 'full') ?>
			</label>
		</div>

		<div class="description half last">
			<label for="<?php echo $this->get_field_id('position') ?>">
				Title
				<?php echo aq_field_input('position', $block_id, $position, $size = 'full') ?>
			</label>
		</div>

		<div class="cf" style="height: 10px"></div>
		
		<div class="description">
			<label for="<?php echo $this->get_field_id('media') ?>">
				Upload Photo
				<?php echo aq_field_upload('media', $block_id, $media, 'image') ?>
				<em style="font-size: 0.8em; padding-left: 5px;">Recommended size: 360 x 270 pixel</em>
			</label>
		</div>

		<div class="cf" style="height: 10px"></div>

		<div class="description">
			<label for="<?php echo $this->get_field_id('text') ?>">
				Description
				<?php echo aq_field_textarea('text', $block_id, $text, $size = 'full') ?>
			</label>
		</div>

		<div class="cf" style="height: 10px"></div>

		<div class="description third">
			<label for="<?php echo $this->get_field_id('fb') ?>">
				Facebook Profile
				<?php echo aq_field_input('fb', $block_id, $fb, $size = 'full') ?>
			</label>
		</div>

		<div class="description third">
			<label for="<?php echo $this->get_field_id('twitter') ?>">
				Twitter Profile
				<?php echo aq_field_input('twitter', $block_id, $twitter, $size = 'full') ?>
			</label>
		</div>

		<div class="description third last">
			<label for="<?php echo $this->get_field_id('email') ?>">
				Email
				<?php echo aq_field_input('email', $block_id, $email, $size = 'full') ?>
			</label>
		</div>

		<div class="cf" style="height: 10px"></div>

		<div class="description half">
			<label for="<?php echo $this->get_field_id('bgcolor') ?>">
				Pick a background color<br/>
				<?php echo aq_field_color_picker('bgcolor', $block_id, $bgcolor) ?>
			</label>
		</div>

		<div class="description half last">
			<label for="<?php echo $this->get_field_id('textcolor') ?>">
				Pick a text color<br/>
				<?php echo aq_field_color_picker('textcolor', $block_id, $textcolor) ?>
			</label>
		</div>

		<div class="cf" style="height: 10px"></div>

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
		$style = (!empty($style) ? ' '.esc_attr($style) : '');

		?>

		<div id="staff-block">
			<div<?php echo $id; ?> class="well well-small<?php echo $userclass; ?>" style="background: <?php echo $bgcolor; ?>; color: <?php echo $textcolor; ?>;<?php echo $style;?>">

				<?php if (!empty($media)) { 
					$attachid = get_image_id(esc_url($media));
				?> 
					<center>
						<?php echo wp_get_attachment_image($attachid , 'tb-360'); ?>
					</center>
				<?php } ?>

				<div class="inner">		
					
					<h3 style="color: <?php echo $textcolor; ?>;"><?php echo strip_tags($title); ?> <small style="color: <?php echo $textcolor; ?>;"><?php echo strip_tags($position); ?></small></h3>

					<?php echo wpautop(do_shortcode(mpt_content_kses(htmlspecialchars_decode($text)))); ?>
					
					<center><div class="btn-group">
				    
						<?php if (!empty($fb)) { ?> 
						    <a href="<?php echo esc_url($fb); ?>" class="btn"><img src="<?php echo get_template_directory_uri(); ?>/img/icon/14/facebook.png" height="14" width="14"></a>
					    <?php } ?>
						   
						<?php if (!empty($twitter)) { ?> 
						    <a href="<?php echo esc_url($twitter); ?>" class="btn"><img src="<?php echo get_template_directory_uri(); ?>/img/icon/14/twitter.png" height="14" width="14"></a>
					    <?php } ?>

					    <?php if (!empty($email) && is_email($email) != 'false') { ?> 
						    <a href="mailto:<?php echo is_email($email); ?>" class="btn"><i class="icon-envelope"></i></a>
					    <?php } ?>
			    	
			    	</div></center>

			    </div>

			</div>

		</div>

		<?php
	}
	
}