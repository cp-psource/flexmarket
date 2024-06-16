<?php
/** Slogan block **/
class AQ_CTA_Block extends AQ_Block {
	
	//set and create block
	function __construct() {
		$block_options = array(
			'name' => 'Call To Action',
			'size' => 'span12',
		);
		
		//create the block
		parent::__construct('aq_cta_block', $block_options);
	}
	
	function form($instance) {
		
		$defaults = array(
			'title' => '',
			'headline' => '',
			'subheadline' => '',
			'heading' => 'h2',
			'align' => 'left',
			'bgcolor' => '#F2EFEF',
			'textcolor'	=> '#676767',
			'bordercolor' => '#00a5f7',
			'btntext' => 'Learn More',
			'btncolor' => 'grey',
			'btnsize' => 'large',
			'btnlink' => '',
			'btnicon' => 'none',
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
			'large' => 'Large'
		);

		$btnlinkopen_options = array(
			'same' => 'Same Window',
			'new' => 'New Window'
		);

		$btnicontype_options = array(
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
		<div class="description">
			<label for="<?php echo $this->get_field_id('title') ?>">
				Title (optional)
				<?php echo aq_field_input('title', $block_id, $title, $size = 'full') ?>
			</label>
		</div>
		
		<div class="description">
			<label for="<?php echo $this->get_field_id('headline') ?>">
				Headline
				<?php echo aq_field_textarea('headline', $block_id, $headline, $size = 'full') ?>
			</label>
		</div>

		<div class="description">
			<label for="<?php echo $this->get_field_id('subheadline') ?>">
				Subheadline
				<?php echo aq_field_textarea('subheadline', $block_id, $subheadline, $size = 'full') ?>
			</label>
		</div>

		<div class="description half">
			<label for="<?php echo $this->get_field_id('heading') ?>">
				Heading Type<br/>
				<?php echo aq_field_select('heading', $block_id, $heading_style, $heading); ?>
			</label>
		</div>

		<div class="description half last">
			<label for="<?php echo $this->get_field_id('align') ?>">
				Text Align<br/>
				<?php echo aq_field_select('align', $block_id, $align_options, $align); ?>
			</label>
		</div>

		<div class="description third">
			<label for="<?php echo $this->get_field_id('bgcolor') ?>">
				Pick a background color<br/>
				<?php echo aq_field_color_picker('bgcolor', $block_id, $bgcolor) ?>
			</label>
		</div>

		<div class="description third">
			<label for="<?php echo $this->get_field_id('textcolor') ?>">
				Pick a text color<br/>
				<?php echo aq_field_color_picker('textcolor', $block_id, $textcolor) ?>
			</label>
		</div>

		<div class="description third last">
			<label for="<?php echo $this->get_field_id('bordercolor') ?>">
				Pick a border color<br/>
				<?php echo aq_field_color_picker('bordercolor', $block_id, $bordercolor) ?>
			</label>
		</div>

		<div class="description half">
			<label for="<?php echo $this->get_field_id('btntext') ?>">
				Button Text
				<?php echo aq_field_input('btntext', $block_id, $btntext, $size = 'full') ?>
			</label>
		</div>
		
		<div class="description half last">
			<label for="<?php echo $this->get_field_id('btnlink') ?>">
				Button Link
				<?php echo aq_field_input('btnlink', $block_id, $btnlink, $size = 'full') ?>
			</label>	
		</div>

		<div class="description fourth">
			<label for="<?php echo $this->get_field_id('btnlinkopen') ?>">
				Link Open In<br/>
				<?php echo aq_field_select('btnlinkopen', $block_id, $btnlinkopen_options, $btnlinkopen); ?>
			</label>
		</div>

		<div class="description fourth">
			<label for="<?php echo $this->get_field_id('btncolor') ?>">
				Button Color<br/>
				<?php echo aq_field_select('btncolor', $block_id, $btncolor_options, $btncolor); ?>
			</label>
		</div>

		<div class="description fourth">
			<label for="<?php echo $this->get_field_id('btnsize') ?>">
				Button Size<br/>
				<?php echo aq_field_select('btnsize', $block_id, $btnsize_options, $btnsize); ?>
			</label>
		</div>

		<div class="description fourth last">
			<label for="<?php echo $this->get_field_id('btnicon') ?>">
				Button Icon<br/>
				<?php echo aq_field_select('btnicon', $block_id, $btnicontype_options, $btnicon); ?>
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

		$btnclass = 'cta-btn btn';

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
		}
		
		$output = '';

		$output .= '<div'.$id.' class="cta well well-shadow'.$class.'" style="background: '.$bgcolor.'; border-left: 3px solid '.$bordercolor.'; '.$style.'">';

		$output .= '<div class="row-fluid">';
		$output .= '<div class="span10'.$alignclass.'">';
		$output .= '<'.$heading.' style="color: '.$textcolor.';">';
		$output .= do_shortcode(mpt_content_kses(htmlspecialchars_decode($headline)));
		$output .= '<br /><small style="color: '.$textcolor.';">';
		$output .= do_shortcode(mpt_content_kses(htmlspecialchars_decode($subheadline)));
		$output .= '</small>';
		$output .= '</'.$heading.'>';
		$output .= '</div>';
		$output .= '<div class="span2 align-center">';
		$output .= '<a href="'.esc_url($btnlink).'" '.($btnlinkopen == 'new' ? 'target="_blank"' : '' ).'>';
		$output .= '<button class="'.$btnclass.'">'.($btnicon == 'none' ? '' : '<i class="'.$btnicon.($btncolor == 'grey' ? '' : ' icon-white').'"></i> ').esc_attr($btntext).'</button>';
		$output .= '</a>';
		$output .= '</div>';
		$output .= '</div>';

		$output .= '</div>';

		echo $output;
	}
	
}