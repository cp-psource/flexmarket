<?php
/* List Block */
if(!class_exists('AQ_Testimonials_Block')) {
	class AQ_Testimonials_Block extends AQ_Block {

		public $name;
		public $block_id;
	
		function __construct() {
			$block_options = array(
				'name' => 'Testimonial Block',
				'size' => 'span4',
			);
			
			//create the widget
			parent::__construct('AQ_Testimonials_Block', $block_options);
			
			//add ajax functions
			add_action('wp_ajax_aq_block_test_add_new', array($this, 'add_test_item'));
			
		}
		
		function form($instance) {
		
			$defaults = array(
				'title' => 'What Our Clients Say',
				'items' => array(
					1 => array(
						'title' => 'New Testimonial',
						'content' => '',
						'position' => '',
						'link' => '',
						'photo' => '',
					)
				),
				'bgcolor' => '#f1f1f1',
				'textcolor' => '#676767',
				'id' => '',
				'class' => '',
				'style' => ''
			);
			
			$instance = wp_parse_args($instance, $defaults);
			extract($instance);
			
			?>

			<div class="description">
				<label for="<?php echo $this->get_field_id('title') ?>">
					Title
					<?php echo aq_field_input('title', $block_id, $title, $size = 'full') ?>
				</label>
			</div>

			<div class="cf"></div>

			<div class="description cf">
				<ul id="aq-sortable-list-<?php echo $block_id ?>" class="aq-sortable-list" rel="<?php echo $block_id ?>">
					<?php
					$items = is_array($items) ? $items : $defaults['items'];
					$count = 1;
					foreach($items as $item) {	
						$this->item($item, $count);
						$count++;
					}
					?>
				</ul>
				<p></p>
				<a href="#" rel="test" class="aq-sortable-add-new button">Add New</a>
				<p></p>
			</div>

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
		
		function item($item = array(), $count = 0) {

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
							Name<br/>
							<input type="text" id="<?php echo $this->get_field_id('items') ?>-<?php echo $count ?>-title" class="input-full" name="<?php echo $this->get_field_name('items') ?>[<?php echo $count ?>][title]" value="<?php echo $item['title'] ?>" />
						</label>
					</div>

					<div class="tab-desc description">
						<label for="<?php echo $this->get_field_id('items') ?>-<?php echo $count ?>-position">
							Position<br/>
							<input type="text" id="<?php echo $this->get_field_id('items') ?>-<?php echo $count ?>-position" class="input-full" name="<?php echo $this->get_field_name('items') ?>[<?php echo $count ?>][position]" value="<?php echo $item['position'] ?>" />
						</label>
					</div>

					<div class="tab-desc description">
						<label for="<?php echo $this->get_field_id('items') ?>-<?php echo $count ?>-photo">
							Photo <em style="font-size: 0.8em;">(Recommended size: 50 x 50 pixel)</em><br/>
							<input type="text" id="<?php echo $this->get_field_id('items') ?>-<?php echo $count ?>-photo" class="input-full input-upload" value="<?php echo $item['photo'] ?>" name="<?php echo $this->get_field_name('items') ?>[<?php echo $count ?>][photo]">
							<a href="#" class="aq_upload_button button" rel="image">Upload</a><p></p>
						</label>
					</div>

					<div class="tab-desc description">
						<label for="<?php echo $this->get_field_id('items') ?>-<?php echo $count ?>-link">
							Website<br/>
							<input type="text" id="<?php echo $this->get_field_id('items') ?>-<?php echo $count ?>-link" class="input-full" name="<?php echo $this->get_field_name('items') ?>[<?php echo $count ?>][link]" value="<?php echo $item['link'] ?>" />
						</label>
					</div>

					<div class="tab-desc description">
						<label for="<?php echo $this->get_field_id('items') ?>-<?php echo $count ?>-content">
							Testimonial<br/>
							<textarea id="<?php echo $this->get_field_id('items') ?>-<?php echo $count ?>-content" class="textarea-full" name="<?php echo $this->get_field_name('items') ?>[<?php echo $count ?>][content]" rows="5"><?php echo $item['content'] ?></textarea>
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
			$class = (!empty($class) ? ' '.esc_attr($class) : '');
			$style = (!empty($style) ? ' style="'.esc_attr($style).'"' : '');

			$output .= '<div'.$id.' class="well well-small well-shadow'.$class.'"'.$style.'>';

			$output .= (!empty($title) ? '<h5 class="page-header" style="color: '.$textcolor.';border-bottom: 1px dashed '.$textcolor.'">'.esc_attr($title).'</h5>' : '' );

			$output .= '<div id="testimonialsCarousel-'.$block_id.'" class="carousel testimonials carousel-fade slide" style="margin-bottom: 0px;">';
			$output .= '<div class="carousel-inner">';

				if (!empty($items)) {

					$i = 1;

					foreach( $items as $item ) {

						$output .= '<div class="'.($i == 1 ? 'active ' : '').'item">';

						$output .= '<p><em style="font-size: 0.9em;line-height: 1.5em;opacity: 0.8;">';
						$output .= do_shortcode(mpt_content_kses(htmlspecialchars_decode($item['content'])));
						$output .= '</em></p>';
						$output .= (!empty($item['photo']) ? '<img src="'.esc_url($item['photo']).'" class="img-circle pull-left" style="margin-right: 10px;" />' : '');
						$output .= '<h4>';
						$output .= (!empty($item['link']) ? '<a href="'.esc_url($item['link']).'" target="_blank">' : '');
						$output .= do_shortcode(strip_tags($item['title']));
						$output .= (!empty($item['link']) ? '</a>' : '');
						$output .= (!empty($item['position']) ? '<br /><small style="font-size: 0.8em;opacity: 0.8;">' : '');
						$output .= do_shortcode(strip_tags($item['position']));
						$output .= (!empty($item['position']) ? '</small>' : '');
						$output .= '</h4>';

						$output .= '</div>';


						$i++;
					}
				}
			
			$output .= '</div>';
			$output .= '</div>';

			$output .= '<div class="clear"></div>';
			$output .= '<div class="pull-right">';
			$output .= '<a class="fade-in-effect" href="#testimonialsCarousel-'.$block_id.'" data-slide="prev"><i class="icon-chevron-left"></i></a>';
			$output .= '<a class="fade-in-effect" href="#testimonialsCarousel-'.$block_id.'" data-slide="next"><i class="icon-chevron-right"></i></a>';
			$output .= '</div> ';
			$output .= '<div class="clear"></div>';

			$output .= '</div>';
			$output .= '<script type="text/javascript">jQuery(document).ready(function () {jQuery(".testimonials").carousel({interval: 4000,pause: "hover"})});</script>';

				
			echo $output;
			
		}
		
		/* AJAX add testimonial */
		function add_test_item() {
			$nonce = $_POST['security'];	
			if (! wp_verify_nonce($nonce, 'aqpb-settings-page-nonce') ) die('-1');
			
			$count = isset($_POST['count']) ? absint($_POST['count']) : false;
			$this->block_id = isset($_POST['block_id']) ? $_POST['block_id'] : 'aq-block-9999';
			
			//default key/value for the testimonial
			$item = array(
				'title' => 'New Testimonial',
				'content' => '',
				'position' => '',
				'link' => '',
				'photo' => '',
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
