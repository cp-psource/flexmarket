<?php
/** Video block **/
class AQ_Video_Block extends AQ_Block {

	public $name;
	public $block_id;
	
	//set and create block
	function __construct() {
		$block_options = array(
			'name' => 'Video Box',
			'size' => 'span6',
		);
		
		//create the block
		parent::__construct('aq_video_block', $block_options);
	}
	
	function form($instance) {
		
		$defaults = array(
			'title' => '',
			'height' => '260',
			'video' => '',
			'type' => 'youtube',
			'id' => '',
			'class' => '',
			'style' => ''
		);
		$instance = wp_parse_args($instance, $defaults);
		extract($instance);

		$videotype = array(
			'youtube' => 'Youtube',
			'vimeo' => 'Vimeo',
		);
		
		?>
		<div class="description">
			<label for="<?php echo $this->get_field_id('title') ?>">
				Title (optional)
				<?php echo aq_field_input('title', $block_id, $title, $size = 'full') ?>
			</label>
		</div>
		
		<div class="description">
			<label for="<?php echo $this->get_field_id('video') ?>">
				Video URL
				<?php echo aq_field_input('video', $block_id, $video, $size = 'full') ?>
				<em style="font-size: 0.8em; padding-left: 5px;">(example: <code>http://vimeo.com/51333291</code> or <code>http://youtu.be/iOiE6XMy0y8</code>)</em>
			</label>
		</div>

		<div class="description half">
			<label for="<?php echo $this->get_field_id('type') ?>">
				Video Type<br/>
				<?php echo aq_field_select('type', $block_id, $videotype, $type); ?>
			</label>
		</div>

		<div class="description half last">
			<label for="<?php echo $this->get_field_id('height') ?>">
				Video Height
				<?php echo aq_field_input('height', $block_id, $height, $size = 'full') ?>
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
		$class = (!empty($class) ? ' '. esc_attr($class) : '');
		$style = (!empty($style) ? ' style="'.esc_attr($style).'"' : '');

		$video = esc_url($video);

		switch ($type) {
			case 'youtube':
				$youtube = array(
					"http://youtu.be/",
					"http://www.youtube.com/watch?v=",
					"http://www.youtube.com/embed/"
					);
				$videonum = str_replace($youtube, "", $video);
				$videocode = 'http://www.youtube.com/embed/' . $videonum;
				break;
			case 'vimeo':
				$vimeo = array(
					"http://vimeo.com/",
					"http://player.vimeo.com/video/"
					);
				$videonum = str_replace($vimeo, "", $video);
				$videocode = 'http://player.vimeo.com/video/' . $videonum;
				break;
		}

		$output = '';

		$output .= '<div'.$id.' class="video-box'.$class.'"'.$style.'>';
		$output .= '<iframe src="'.$videocode.'" width="100%" height="'.esc_attr($height).'" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>';
		$output .= '</div>';


		echo $output;
	}
	
}