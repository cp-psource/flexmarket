<?php
/* List Block */
if(!class_exists('AQ_Progress_Block')) {
	class AQ_Progress_Block extends AQ_Block {
	
		function __construct() {
			$block_options = array(
				'name' => 'Progress Bars',
				'size' => 'span6',
			);
			
			//create the widget
			parent::__construct('AQ_Progress_Block', $block_options);
			
			//add ajax functions
			add_action('wp_ajax_aq_block_bar_add_new', array($this, 'add_bar'));
			
		}
		
		function form($instance) {
		
			$defaults = array(
				'title' => '',
				'heading' => 'h4',
				'bars' => array(
					1 => array(
						'title' => 'New Bar',
						'width' => '80',
						'barcolor' => 'blue',
					)
				),
				'type' => 'basic',
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

			$type_options = array(
				'basic' => 'Basic',
				'striped' => 'Striped',
				'animated' => 'Animated',
				'stacked' => 'Stacked',
			);
			
			?>

			<div class="description">
				<label for="<?php echo $this->get_field_id('title') ?>">
					Title (optional)
					<?php echo aq_field_input('title', $block_id, $title, $size = 'full') ?>
				</label>
			</div>

			<div class="description cf">
				<ul id="aq-sortable-list-<?php echo $block_id ?>" class="aq-sortable-list" rel="<?php echo $block_id ?>">
					<?php
					$bars = is_array($bars) ? $bars : $defaults['bars'];
					$count = 1;
					foreach($bars as $bar) {	
						$this->bar($bar, $count);
						$count++;
					}
					?>
				</ul>
				<p></p>
				<a href="#" rel="bar" class="aq-sortable-add-new button">Add New</a>
				<p></p>
			</div>

			<div class="description">
				<label for="<?php echo $this->get_field_id('type') ?>">
					Type<br/>
					<?php echo aq_field_select('type', $block_id, $type_options, $type) ?>
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
		
		function bar($bar = array(), $count = 0) {

			$barcolor_options = array(
				'blue' => 'Blue',
				'green' => 'Green',
				'yellow' => 'Yellow',
				'red' => 'Red',
			);

			?>
			<li id="sortable-item-<?php echo $count ?>" class="sortable-item" rel="<?php echo $count ?>">
				
				<div class="sortable-head cf">
					<div class="sortable-title">
						<strong><?php echo $bar['title'] ?></strong>
					</div>
					<div class="sortable-handle">
						<a href="#">Open / Close</a>
					</div>
				</div>
				
				<div class="sortable-body">
					<div class="tab-desc description">
						<label for="<?php echo $this->get_field_id('bars') ?>-<?php echo $count ?>-title">
							Name<br/>
							<input type="text" id="<?php echo $this->get_field_id('bars') ?>-<?php echo $count ?>-title" class="input-full" name="<?php echo $this->get_field_name('bars') ?>[<?php echo $count ?>][title]" value="<?php echo $bar['title'] ?>" />
						</label>
					</div>

					<div class="tab-desc description">
						<label for="<?php echo $this->get_field_id('bars') ?>-<?php echo $count ?>-width">
							Width<br/>
							<input type="text" id="<?php echo $this->get_field_id('bars') ?>-<?php echo $count ?>-width" class="input-min" name="<?php echo $this->get_field_name('bars') ?>[<?php echo $count ?>][width]" value="<?php echo $bar['width'] ?>" /> %
						</label>
					</div>

					<div class="tab-desc description">
						<label for="<?php echo $this->get_field_id('bars') ?>-<?php echo $count ?>-barcolor">
							Color<br/>
							<select id="<?php echo $this->get_field_id('bars') ?>-<?php echo $count ?>-barcolor" name="<?php echo $this->get_field_name('bars') ?>[<?php echo $count ?>][barcolor]">
								<?php 
									foreach($barcolor_options as $key=>$value) {
										echo '<option value="'.$key.'" '.selected($bar['barcolor'] , $key, false ).'>'.htmlspecialchars($value).'</option>';
									}
								?>
							</select>
						</label>
					</div>

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
			$style = (!empty($style) ? ' style="'.esc_attr($style).'"' : '');

			$classoutput = '';

			switch ($type) {
				case 'basic':
					$classoutput .= 'progress';
					break;
				case 'striped':
					$classoutput .= 'progress progress-striped';
					break;
				case 'animated':
					$classoutput .= 'progress progress-striped active';
					break;
				case 'stacked':
					$classoutput .= 'progress';
					break;
			}


			$output .= '';
			$output .= '<div'.$id.' class="well well-shadow'.$userclass.'"'.$style.'>';

			if ($type == 'stacked') {

				if (!empty($bars)) {

					$output .= ( !empty($title) ? '<p>'.esc_attr($title).'</p>' : '');
					$output .= '<div class="'.$classoutput.'">';

					foreach( $bars as $bar ) {

						switch ($bar['barcolor']) {
							case 'blue':
								$barclass = ' bar-info';
								break;
							case 'green':
								$barclass = ' bar-success';
								break;
							case 'yellow':
								$barclass = ' bar-warning';
								break;
							case 'red':
								$barclass = ' bar-danger';
								break;							
						}

						$output .= '<div class="bar'.$barclass.'" style="width: '.esc_attr($bar['width']).'%"></div>';
					}

					$output .= '</div>';
				}

			} else {

				if (!empty($bars)) {

					foreach( $bars as $bar ) {

						switch ($bar['barcolor']) {
							case 'blue':
								$colorclass = ' progress-info';
								break;
							case 'green':
								$colorclass = ' progress-success';
								break;
							case 'yellow':
								$colorclass = ' progress-warning';
								break;
							case 'red':
								$colorclass = ' progress-danger';
								break;							
						}

						$output .= (!empty($bar['title']) ? '<p>'.esc_attr($bar['title']).'</p>' : '');
						$output .= '<div class="'.$classoutput.$colorclass.'">';
						$output .= '<div class="bar" style="width: '.esc_attr($bar['width']).'%"></div>';
						$output .= '</div>';
					}
				}
			
			}

			$output .= '</div>';
				
			echo $output;
			
		}
		
		/* AJAX add bar */
		function add_bar() {
			$nonce = $_POST['security'];	
			if (! wp_verify_nonce($nonce, 'aqpb-settings-page-nonce') ) die('-1');
			
			$count = isset($_POST['count']) ? absint($_POST['count']) : false;
			$this->block_id = isset($_POST['block_id']) ? $_POST['block_id'] : 'aq-block-9999';
			
			//default key/value for the bar
			$bar = array(
				'title' => 'New Bar',
				'width' => '80',
				'barcolor' => 'blue',
			);
			
			if($count) {
				$this->bar($bar, $count);
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
