<?php
/** Button block **/
class AQ_Button_Block extends AQ_Block {

	public $name;
	
	//set and create block
	function __construct() {
		$block_options = array(
			'name' => 'Button',
			'size' => 'span6',
		);
		
		//create the block
		parent::__construct('aq_button_block', $block_options);
	}
	
	function form($instance) {
		
		$defaults = array(
			'text' => 'Button',
			'link' => '#',
			'color' => 'grey',
			'btnsize' => 'default',
			'icontype' => 'none',
			'whiteicon' => '0',
			'align' => 'none',
			'id' => '',
			'class' => '',
			'style' => ''
		);
		$instance = wp_parse_args($instance, $defaults);
		extract($instance);

		$color_options = array(
			'grey' => 'Grey',
			'blue' => 'Blue',
			'lightblue' => 'Light Blue',
			'green' => 'Green',
			'red' => 'Red',
			'yellow' => 'Yellow',
			'black' => 'Black',
		);

		$size_options = array(
			'default' => 'Default',
			'mini' => 'Mini',
			'small' => 'Small',
			'large' => 'Large',
			'huge' => 'Huge',
			'block' => 'Block',
		);

		$align_options = array(
			'none' => 'None',
			'left' => 'Left',
			'center' => 'Center',
			'right' => 'Right'
		);

		$icontype_options = array(
			'none' => 'none',
			'icon-adjust' => 'icon-adjust',
			'icon-align-center' => 'icon-align-center',
			'icon-align-justify' => 'icon-align-justify',
			'icon-align-left' => 'icon-align-left',
			'icon-align-right' => 'icon-align-right',
			'icon-arrow-down' => 'icon-arrow-down',
			'icon-arrow-left' => 'icon-arrow-left',
			'icon-arrow-right' => 'icon-arrow-right',
			'icon-arrow-up' => 'icon-arrow-up',
			'icon-asterisk' => 'icon-asterisk',
			'icon-backward' => 'icon-backward',
			'icon-ban-circle' => 'icon-ban-circle',
			'icon-barcode' => 'icon-barcode',
			'icon-bell' => 'icon-bell',
			'icon-bold' => 'icon-bold',
			'icon-book' => 'icon-book',
			'icon-bookmark' => 'icon-bookmark',
			'icon-briefcase' => 'icon-briefcase',
			'icon-bullhorn' => 'icon-bullhorn',
			'icon-calendar' => 'icon-calendar',
			'icon-camera' => 'icon-camera',
			'icon-certificate' => 'icon-certificate',
			'icon-check' => 'icon-check',
			'icon-chevron-down' => 'icon-chevron-down',
			'icon-chevron-left' => 'icon-chevron-left',
			'icon-chevron-right' => 'icon-chevron-right',
			'icon-chevron-up' => 'icon-chevron-up',
			'icon-circle-arrow-down' => 'icon-circle-arrow-down',
			'icon-circle-arrow-left' => 'icon-circle-arrow-left',
			'icon-circle-arrow-right' => 'icon-circle-arrow-right',
			'icon-circle-arrow-up' => 'icon-circle-arrow-up',
			'icon-cog' => 'icon-cog',
			'icon-comment' => 'icon-comment',
			'icon-download' => 'icon-download',
			'icon-download-alt' => 'icon-download-alt',
			'icon-edit' => 'icon-edit',
			'icon-eject' => 'icon-eject',
			'icon-envelope' => 'icon-envelope',
			'icon-exclamation-sign' => 'icon-exclamation-sign',
			'icon-eye-close' => 'icon-eye-close',
			'icon-eye-open' => 'icon-eye-open',
			'icon-facetime-video' => 'icon-facetime-video',
			'icon-fast-backward' => 'icon-fast-backward',
			'icon-fast-forward' => 'icon-fast-forward',
			'icon-file' => 'icon-file',
			'icon-film' => 'icon-film',
			'icon-filter' => 'icon-filter',
			'icon-fire' => 'icon-fire',
			'icon-flag' => 'icon-flag',
			'icon-folder-close' => 'icon-folder-close',
			'icon-folder-open' => 'icon-folder-open',
			'icon-font' => 'icon-font',
			'icon-forward' => 'icon-forward',
			'icon-fullscreen' => 'icon-fullscreen',
			'icon-gift' => 'icon-gift',
			'icon-globe' => 'icon-globe',
			'icon-hand-down' => 'icon-hand-down',
			'icon-hand-left' => 'icon-hand-left',
			'icon-hand-right' => 'icon-hand-right',
			'icon-hand-up' => 'icon-hand-up',
			'icon-hdd' => 'icon-hdd',
			'icon-headphones' => 'icon-headphones',
			'icon-heart' => 'icon-heart',
			'icon-home' => 'icon-home',
			'icon-inbox' => 'icon-inbox',
			'icon-indent-left' => 'icon-indent-left',
			'icon-indent-right' => 'icon-indent-right',
			'icon-info-sign' => 'icon-info-sign',
			'icon-italic' => 'icon-italic',
			'icon-leaf' => 'icon-leaf',
			'icon-list' => 'icon-list',
			'icon-list-alt' => 'icon-list-alt',
			'icon-lock' => 'icon-lock',
			'icon-magnet' => 'icon-magnet',
			'icon-map-marker' => 'icon-map-marker',
			'icon-minus' => 'icon-minus',
			'icon-minus-sign' => 'icon-minus-sign',
			'icon-move' => 'icon-move',
			'icon-music' => 'icon-music',
			'icon-off' => 'icon-off',
			'icon-ok' => 'icon-ok',
			'icon-ok-circle' => 'icon-ok-circle',
			'icon-ok-sign' => 'icon-ok-sign',
			'icon-pause' => 'icon-pause',
			'icon-pencil' => 'icon-pencil',
			'icon-picture' => 'icon-picture',
			'icon-plane' => 'icon-plane',
			'icon-play' => 'icon-play',
			'icon-play-circle' => 'icon-play-circle',
			'icon-plus' => 'icon-plus',
			'icon-plus-sign' => 'icon-plus-sign',
			'icon-print' => 'icon-print',
			'icon-qrcode' => 'icon-qrcode',
			'icon-question-sign' => 'icon-question-sign',
			'icon-random' => 'icon-random',
			'icon-refresh' => 'icon-refresh',
			'icon-remove' => 'icon-remove',
			'icon-remove-circle' => 'icon-remove-circle',
			'icon-remove-sign' => 'icon-remove-sign',
			'icon-repeat' => 'icon-repeat',
			'icon-resize-full' => 'icon-resize-full',
			'icon-resize-horizontal' => 'icon-resize-horizontal',
			'icon-resize-small' => 'icon-resize-small',
			'icon-resize-vertical' => 'icon-resize-vertical',
			'icon-retweet' => 'icon-retweet',
			'icon-road' => 'icon-road',
			'icon-screenshot' => 'icon-screenshot',
			'icon-search' => 'icon-search',
			'icon-share' => 'icon-share',
			'icon-share-alt' => 'icon-share-alt',
			'icon-shopping-cart' => 'icon-shopping-cart',
			'icon-signal' => 'icon-signal',
			'icon-star' => 'icon-star',
			'icon-star-empty' => 'icon-star-empty',
			'icon-step-backward' => 'icon-step-backward',
			'icon-step-forward' => 'icon-step-forward',
			'icon-stop' => 'icon-stop',
			'icon-tag' => 'icon-tag',
			'icon-tags' => 'icon-tags',
			'icon-tasks' => 'icon-tasks',
			'icon-text-height' => 'icon-text-height',
			'icon-text-width' => 'icon-text-width',
			'icon-th' => 'icon-th',
			'icon-th-large' => 'icon-th-large',
			'icon-th-list' => 'icon-th-list',
			'icon-thumbs-down' => 'icon-thumbs-down',
			'icon-thumbs-up' => 'icon-thumbs-up',
			'icon-time' => 'icon-time',
			'icon-tint' => 'icon-tint',
			'icon-trash' => 'icon-trash',
			'icon-upload' => 'icon-upload',
			'icon-user' => 'icon-user',
			'icon-volume-down' => 'icon-volume-down',
			'icon-volume-off' => 'icon-volume-off',
			'icon-volume-up' => 'icon-volume-up',
			'icon-warning-sign' => 'icon-warning-sign',
			'icon-wrench' => 'icon-wrench',
			'icon-zoom-in' => 'icon-zoom-in',
			'icon-zoom-out' => 'icon-zoom-out'
		);
		
		?>
		<p class="description">
			<label for="<?php echo $this->get_field_id('text') ?>">
				Button Text
				<?php echo aq_field_input('text', $block_id, $text, $size = 'full') ?>
			</label>
		</p>
		
		<p class="description">
			<label for="<?php echo $this->get_field_id('link') ?>">
				Button Link
				<?php echo aq_field_input('link', $block_id, $link, $size = 'full') ?>
			</label>	
		</p>

		<div class="description third">
			<label for="<?php echo $this->get_field_id('color') ?>">
				Button Color<br/>
				<?php echo aq_field_select('color', $block_id, $color_options, $color); ?>
			</label>
		</div>

		<div class="description third">
			<label for="<?php echo $this->get_field_id('btnsize') ?>">
				Button Size<br/>
				<?php echo aq_field_select('btnsize', $block_id, $size_options, $btnsize); ?>
			</label>
		</div>

		<div class="description third last">
			<label for="<?php echo $this->get_field_id('align') ?>">
				Align<br/>
				<?php echo aq_field_select('align', $block_id, $align_options, $align); ?>
			</label>
		</div>

		<div class="description half">
			<label for="<?php echo $this->get_field_id('icontype') ?>">
				Icon Type<br/>
				<?php echo aq_field_select('icontype', $block_id, $icontype_options, $icontype); ?>
			</label>
		</div>

		<div class="description half last">
			<label for="<?php echo $this->get_field_id('whiteicon') ?>">
				White Icon? <?php echo aq_field_checkbox('whiteicon', $block_id, $whiteicon); ?>
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
		$style = (!empty($style) ? ' style="'.esc_attr($style).'"' : '');

		$iconclass = '';

		if ($whiteicon == '1') { $iconclass .= ' icon-white';}
		
		if ($icontype == 'none') {
			$iconoutput = '';
		} else {
			$iconoutput = '<i class="'.$icontype.$iconclass.'"></i> ';
		}

		switch ($color) {
			case 'grey':
				$class .= '';
				break;
			case 'blue':
				$class .= ' btn-primary';
				break;
			case 'lightblue':
				$class .= ' btn-info';
				break;
			case 'green':
				$class .= ' btn-success';
				break;
			case 'yellow':
				$class .= ' btn-warning';
				break;
			case 'red':
				$class .= ' btn-danger';
				break;
			case 'black':
				$class .= ' btn-inverse';
				break;
			
		}

		switch ($btnsize) {
			case 'default':
				$class .= '';
				break;
			case 'large':
				$class .= ' btn-large';
				break;
			case 'small':
				$class .= ' btn-small';
				break;
			case 'mini':
				$class .= ' btn-mini';
				break;	
			case 'block':
				$class .= ' btn-block';
				break;	
			case 'huge':
				$class .= ' btn-big';
				break;	
		}

		switch ($align) {
			case 'none':
				$frontdiv = '';
				$enddiv = '';
				break;
			case 'left':
				$frontdiv = '<div class="align-left">';
				$enddiv = '</div>';
				break;
			case 'center':
				$frontdiv = '<div class="align-center">';
				$enddiv = '</div>';
				break;
			case 'right':
				$frontdiv = '<div class="align-right">';
				$enddiv = '</div>';
				break;

		}
		
		echo $frontdiv.'<a href="'.esc_url($link).'"><button'.$id.' class="btn'.$class.'"'.$style.'>'.$iconoutput.strip_tags($text).'</button></a>'.$enddiv;
		
	}
	
}