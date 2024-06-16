<?php
/* List Block */
if(!class_exists('AQ_List_Block')) {
	class AQ_List_Block extends AQ_Block {

		public $name;
	
		function __construct() {
			$block_options = array(
				'name' => 'List',
				'size' => 'span6',
			);
			
			//create the widget
			parent::__construct('AQ_List_Block', $block_options);
			
			//add ajax functions
			add_action('wp_ajax_aq_block_list_add_new', array($this, 'add_list_item'));
			
		}
		
		function form($instance) {
		
			$defaults = array(
				'title' => '',
				'heading' => 'h4',
				'items' => array(
					1 => array(
						'title' => 'New Item',
						'content' => '',
						'icontype' => 'none',
						'iconcolor' => 'black',
					)
				),
				'type'	=> 'bullet',
				'id' => '',
				'class' => '',
				'style' => ''
			);
			
			$instance = wp_parse_args($instance, $defaults);
			extract($instance);
			
			$list_type = array(
				'bullet' => 'Bullet',
				'number' => 'Number',
				'icon' => 'Icon',
				'unstyled' => 'Unstyled',
			);

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
					Title (optional)
					<?php echo aq_field_input('title', $block_id, $title, $size = 'full') ?>
				</label>
			</div>

			<div class="description third last">
				<label for="<?php echo $this->get_field_id('heading') ?>">
					Heading Type<br/>
					<?php echo aq_field_select('heading', $block_id, $heading_style, $heading); ?>
				</label>
			</div>

			<div class="description cf">
				<ul id="aq-sortable-list-<?php echo $block_id ?>" class="aq-sortable-list" rel="<?php echo $block_id ?>">
					<?php
					$items = is_array($items) ? $items : $defaults['items'];
					$count = 1;
					foreach($items as $item) {	
						$this->item($item, $count, $type);
						$count++;
					}
					?>
				</ul>
				<p></p>
				<a href="#" rel="list" class="aq-sortable-add-new button">Add New</a>
				<p></p>
			</div>

			<div class="description">
				<label for="<?php echo $this->get_field_id('type') ?>">
					List Type<br/>
					<?php echo aq_field_select('type', $block_id, $list_type, $type) ?>
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
		
		function item($item = array(), $count = 0, $type = '') {

			$iconcolor_options = array(
				'black' => 'Black',
				'blue' => 'Blue',
				'green' => 'Green',
				'lightblue' => 'Light Blue',
				'red' => 'Red',
				'white' => 'White',
				'yellow' => 'Yellow',
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
			<li id="sortable-item-<?php echo $count ?>" class="sortable-item" rel="<?php echo $count ?>">
				
				<div class="sortable-head cf">
					<div class="sortable-title">
						<strong><?php echo $item['title'] ?></strong>
					</div>
					<div class="sortable-handle">
						<a href="#">Open / Close</a>
					</div>
				</div>
				
				<div class="sortable-body">
					<div class="tab-desc description">
						<label for="<?php echo $this->get_field_id('items') ?>-<?php echo $count ?>-title">
							Item Name<br/>
							<input type="text" id="<?php echo $this->get_field_id('items') ?>-<?php echo $count ?>-title" class="input-full" name="<?php echo $this->get_field_name('items') ?>[<?php echo $count ?>][title]" value="<?php echo $item['title'] ?>" />
						</label>
					</div>

					<div class="tab-desc description">
						<label for="<?php echo $this->get_field_id('items') ?>-<?php echo $count ?>-content">
							Item Content<br/>
							<textarea id="<?php echo $this->get_field_id('items') ?>-<?php echo $count ?>-content" class="textarea-full" name="<?php echo $this->get_field_name('items') ?>[<?php echo $count ?>][content]" rows="5"><?php echo $item['content'] ?></textarea>
						</label>
					</div>

				<?php if ($type == 'icon') { ?> 	

					<?php $specialid = $this->get_field_id('items').'-'.$count; ?>

					<div class="tab-desc description half">
						<label for="<?php echo $this->get_field_id('items') ?>-<?php echo $count ?>-icontype">
							Icon type<br/>
							<select id="<?php echo $this->get_field_id('items') ?>-<?php echo $count ?>-icontype" name="<?php echo $this->get_field_name('items') ?>[<?php echo $count ?>][icontype]">
								<?php 
									foreach($icontype_options as $key=>$value) {
										echo '<option value="'.$key.'" '.selected( $item['icontype'] , $key, false ).'>'.htmlspecialchars($value).'</option>';
									}
								?>
							</select>
							
						</label>
					</div>

					<div class="tab-desc description half last">
						<label for="<?php echo $this->get_field_id('items') ?>-<?php echo $count ?>-iconcolor">
							Icon Color<br/>
							<select id="<?php echo $this->get_field_id('items') ?>-<?php echo $count ?>-iconcolor" name="<?php echo $this->get_field_name('items') ?>[<?php echo $count ?>][iconcolor]">
								<?php 
									foreach($iconcolor_options as $key=>$value) {
										echo '<option value="'.$key.'" '.selected( $item['iconcolor'] , $key, false ).'>'.htmlspecialchars($value).'</option>';
									}
								?>
							</select>
					</div>

				<?php } ?>

					<p class="tab-desc description"><a href="#" class="sortable-delete">Delete</a></p>
				</div>
				
			</li>
			<?php
		}
		
		function block($instance) {
			extract($instance);
			
			$output = '';
			$id = (!empty($id) ? ' id="'.esc_attr($id).'"' : '');
			$userclass = (!empty($class) ? ' '.esc_attr($class) : '');
			$style = (!empty($style) ? ' '.esc_attr($style) : '');

			$classoutput = '';

			switch ($type) {
				case 'bullet':
					$classoutput .= '';
					$liststyle = 'list-style-type:disc;';
					break;
				case 'number':
					$classoutput .= '';
					$liststyle = 'list-style-type:decimal;';
					break;	
				case 'icon':
					$classoutput .= 'unstyled';
					$liststyle = '';
					break;	
				case 'unstyled':
					$classoutput .= 'unstyled';
					$liststyle = 'list-style-type:none;';
					break;	
			}

			$classoutput .= $userclass;

			$output .= (!empty($title) ? '<'.$heading.'>'.esc_attr($title).'</'.$heading.'>' : '' );
			$output .= '<'.($type == 'number' ? 'ol' : 'ul').$id.(!empty($classoutput) ? ' class=" '.$classoutput.'"' : '').' style="'.$liststyle.$style.'">';

			if ($type == 'icon') {

				if (!empty($items)) {

					foreach( $items as $item ) {

						switch ($item['iconcolor']) {
							case 'blue':
								$tagcolor = ' icon-blue';
								break;
							case 'lightblue':
								$tagcolor = ' icon-lightblue';
								break;
							case 'green':
								$tagcolor = ' icon-green';
								break;
							case 'yellow':
								$tagcolor = ' icon-yellow';
								break;
							case 'red':
								$tagcolor = ' icon-red';
								break;
							case 'white':
								$tagcolor = ' icon-white';
								break;		
							case 'black':
								$tagcolor = '';
								break;			
						}

						$output .= '<li>';
						$output .= '<i class="'.$item['icontype'].$tagcolor.'"></i> ';
						$output .= do_shortcode(mpt_content_kses(htmlspecialchars_decode($item['content'])));
						$output .= '</li>';
					}
				}

			} else {

				if (!empty($items)) {

					foreach( $items as $item ) {
						
						$output .= '<li>';
						$output .= do_shortcode(mpt_content_kses(htmlspecialchars_decode($item['content'])));
						$output .= '</li>';
					}

				}

			}
			
			$output .= '</'.($type == 'number' ? 'ol' : 'ul').'>';
				
			echo $output;
			
		}
		
		/* AJAX add row */
		function add_list_item() {
			$nonce = $_POST['security'];	
			if (! wp_verify_nonce($nonce, 'aqpb-settings-page-nonce') ) die('-1');
			
			$count = isset($_POST['count']) ? absint($_POST['count']) : false;
			$this->block_id = isset($_POST['block_id']) ? $_POST['block_id'] : 'aq-block-9999';
			
			//default key/value for the row
			$item = array(
				'title' => 'New Item',
				'content' => '',
				'icontype' => 'none',
				'iconcolor' => 'black',
			);
			
			if($count) {
				$this->item($item, $count);
			} else {
				die(-1);
			}
			
			die();
		}
		
		function update($new_instance, $old_instance) {
			$new_instance = aq_recursive_sanitize($new_instance);
			return $new_instance;
		}
	}
}
