<?php
/* List Block */
if(!class_exists('AQ_Slider_Block')) {
	class AQ_Slider_Block extends AQ_Block {
	
		function __construct() {
			$block_options = array(
				'name' => 'Slider Block',
				'size' => 'span12',
			);
			
			//create the widget
			parent::__construct('AQ_Slider_Block', $block_options);
			
			//add ajax functions
			add_action('wp_ajax_aq_block_slide_add_new', array($this, 'add_slide'));
			
		}
		
		function form($instance) {
		
			$defaults = array(
				'title' => '',
				'slides' => array(
					1 => array(
						'title' => '1st Slide',
						'content' => '',
						'button' => 'yes',
						'btntext' => 'Learn More',
						'btncolor' => 'yellow',
						'linkopen' => 'same',
						'link' => '',
						'image' => '',
					)
				),
				'speed' => '4000',
				'pause' => 'yes',
				'class' => '',
				'style' => ''
			);
			
			$instance = wp_parse_args($instance, $defaults);
			extract($instance);

			$pause_options = array(
				'yes' => 'Yes',
				'no' => 'No',
			);
			
			?>

			<div class="description cf">
				<ul id="aq-sortable-list-<?php echo $block_id ?>" class="aq-sortable-list" rel="<?php echo $block_id ?>">
					<?php
					$slides = is_array($slides) ? $slides : $defaults['slides'];
					$count = 1;
					foreach($slides as $slide) {	
						$this->slide($slide, $count);
						$count++;
					}
					?>
				</ul>
				<p></p>
				<a href="#" rel="slide" class="aq-sortable-add-new button">Add New</a>
				<p></p>
			</div>

			<div class="description half">
				<label for="<?php echo $this->get_field_id('speed') ?>">
					interval (in millisecond)<br/>
					<?php echo aq_field_input('speed', $block_id, $speed, $size = 'full') ?>
				</label>
			</div>

			<div class="description half last">
				<label for="<?php echo $this->get_field_id('pause') ?>">
					Pause on hover?<br/>
					<?php echo aq_field_select('pause', $block_id, $pause_options, $pause); ?>
				</label>
			</div>

			<div class="cf"></div>

			<div class="description">
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
		
		function slide($slide = array(), $count = 0) {

			$btncolor_options = array(
				'grey' => 'Grey',
				'blue' => 'Blue',
				'lightblue' => 'Light Blue',
				'green' => 'Green',
				'red' => 'Red',
				'yellow' => 'Yellow',
				'black' => 'Black',
			);

			$enablebtn_options = array(
				'yes' => 'Yes',
				'no' => 'No',
			);

			$linkopen_options = array(
				'same' => 'Same Window',
				'new' => 'New Window'
			);

			?>
			<li id="sortable-item-<?php echo $count ?>" class="sortable-item" rel="<?php echo $count ?>">
				
				<div class="sortable-head cf">
					<div class="sortable-title">
						<strong><?php echo $slide['title'] ?></strong>
					</div>
					<div class="sortable-handle">
						<a href="#">Open / Close</a>
					</div>
				</div>
				
				<div class="sortable-body">
					<div class="tab-desc description">
						<label for="<?php echo $this->get_field_id('slides') ?>-<?php echo $count ?>-title">
							Title<br/>
							<input type="text" id="<?php echo $this->get_field_id('slides') ?>-<?php echo $count ?>-title" class="input-full" name="<?php echo $this->get_field_name('slides') ?>[<?php echo $count ?>][title]" value="<?php echo $slide['title'] ?>" />
						</label>
					</div>

					<div class="tab-desc description">
						<label for="<?php echo $this->get_field_id('slides') ?>-<?php echo $count ?>-content">
							Content<br/>
							<textarea id="<?php echo $this->get_field_id('slides') ?>-<?php echo $count ?>-content" class="textarea-full" name="<?php echo $this->get_field_name('slides') ?>[<?php echo $count ?>][content]" rows="5"><?php echo $slide['content'] ?></textarea>
						</label>
					</div>

					<div class="tab-desc description">
						<label for="<?php echo $this->get_field_id('slides') ?>-<?php echo $count ?>-image">
							Image <em style="font-size: 0.8em;">(Recommended width: 1170 px)</em><br/>
							<input type="text" id="<?php echo $this->get_field_id('slides') ?>-<?php echo $count ?>-image" class="input-full input-upload" value="<?php echo $slide['image'] ?>" name="<?php echo $this->get_field_name('slides') ?>[<?php echo $count ?>][image]">
							<a href="#" class="aq_upload_button button" rel="image">Upload</a><p></p>
						</label>
					</div>

					<div class="tab-desc description two-third">
						<label for="<?php echo $this->get_field_id('slides') ?>-<?php echo $count ?>-link">
							Link To<br/>
							<input type="text" id="<?php echo $this->get_field_id('slides') ?>-<?php echo $count ?>-link" class="input-full" name="<?php echo $this->get_field_name('slides') ?>[<?php echo $count ?>][link]" value="<?php echo $slide['link'] ?>" />
						</label>
					</div>

					<div class="tab-desc description third last">
						<label for="<?php echo $this->get_field_id('slides') ?>-<?php echo $count ?>-linkopen">
							Link Open In<br/>
							<select id="<?php echo $this->get_field_id('slides') ?>-<?php echo $count ?>-linkopen" name="<?php echo $this->get_field_name('slides') ?>[<?php echo $count ?>][linkopen]">
								<?php 
									foreach($linkopen_options as $key=>$value) {
										echo '<option value="'.$key.'" '.selected( $slide['linkopen'] , $key, false ).'>'.htmlspecialchars($value).'</option>';
									}
								?>
							</select>
						</label>
					</div>				

					<div class="tab-desc description third">
						<label for="<?php echo $this->get_field_id('slides') ?>-<?php echo $count ?>-button">
							Show Button<br/>
							<select id="<?php echo $this->get_field_id('slides') ?>-<?php echo $count ?>-button" name="<?php echo $this->get_field_name('slides') ?>[<?php echo $count ?>][button]">
								<?php 
									foreach($enablebtn_options as $key=>$value) {
										echo '<option value="'.$key.'" '.selected( $slide['button'] , $key, false ).'>'.htmlspecialchars($value).'</option>';
									}
								?>
							</select>
							
						</label>
					</div>

					<div class="tab-desc description third">
						<label for="<?php echo $this->get_field_id('slides') ?>-<?php echo $count ?>-btntext">
							Button Text<br/>
							<input type="text" id="<?php echo $this->get_field_id('slides') ?>-<?php echo $count ?>-btntext" class="input-full" name="<?php echo $this->get_field_name('slides') ?>[<?php echo $count ?>][btntext]" value="<?php echo $slide['btntext'] ?>" />
						</label>
					</div>

					<div class="tab-desc description third last">
						<label for="<?php echo $this->get_field_id('slides') ?>-<?php echo $count ?>-btncolor">
							Button Color<br/>
							<select id="<?php echo $this->get_field_id('slides') ?>-<?php echo $count ?>-btncolor" name="<?php echo $this->get_field_name('slides') ?>[<?php echo $count ?>][btncolor]">
								<?php 
									foreach($btncolor_options as $key=>$value) {
										echo '<option value="'.$key.'" '.selected( $slide['btncolor'] , $key, false ).'>'.htmlspecialchars($value).'</option>';
									}
								?>
							</select>
					</div>


					<p class="tab-desc description"><a href="#" class="sortable-delete">Delete</a></p>
				</div>
				
			</li>
			<?php
		}
		
		function block($instance) {
			extract($instance);

			$themefolder = get_template_directory_uri();
			
			$output = '';
			$class = (!empty($class) ? ' '.esc_attr($class) : '');
			$style = (!empty($style) ? ' style="'.esc_attr($style).'"' : '');

			$output .= '<div id="sliderCarousel-'.$block_id.'" class="carousel slider-block slide'.$class.'"'.$style.'>';
			$output .= '<div class="carousel-inner">';

				if (!empty($slides)) {

					$i = 1;

					foreach( $slides as $slide ) {

						switch ($slide['btncolor']) {
							case 'grey':
								$btnclass = '';
								break;
							case 'blue':
								$btnclass = ' btn-primary';
								break;
							case 'lightblue':
								$btnclass = ' btn-info';
								break;
							case 'green':
								$btnclass = ' btn-success';
								break;
							case 'yellow':
								$btnclass = ' btn-warning';
								break;
							case 'red':
								$btnclass = ' btn-danger';
								break;
							case 'black':
								$btnclass = ' btn-inverse';
								break;
							
						}

						$output .= '<div class="'.($i == 1 ? 'active ' : '').'item">';					

						$output .= (!empty($slide['link']) ? '<a href="'.esc_url($slide['link']).'"'.($slide['linkopen'] == 'same' ? '' : ' target="_blank"').'>' : '');
						$output .= (!empty($slide['image']) ? '<img src="'.esc_url($slide['image']).'" />' : '');
						$output .= (!empty($slide['link']) ? '</a>' : '');

						if (!empty($slide['content']) || !empty($slide['title']) || $slide['button'] == 'yes') {

							$output .= '<div class="carousel-caption">';
								$output .= '<div class="row-fluid">';
									$output .= '<div class="'.($slide['button'] == 'yes' ? 'span9' : 'span12').'">';
										$output .= '<h4>'.strip_tags($slide['title']).'</h4>';
										$output .= wpautop(do_shortcode(strip_tags($slide['content'])));
									$output .= '</div>';

									if ($slide['button'] == 'yes') {
										$output .= '<div class="span3 align-right" style="line-height: 60px;">';
											$output .= '<a href="'.esc_url($slide['link']).'" class="btn btn-large'.$btnclass.'">';
											$output .= strip_tags($slide['btntext']);
											$output .= '</a>';
										$output .= '</div>';
									}

								$output .= '</div>';
							$output .= '</div>';
						}

						$output .= '';
						
						$output .= '</div>';

						$i++;
					}
				}
			
			$output .= '</div>'; // End carouse-inner
			$output .= '<a class="carousel-control left" href="#sliderCarousel-'.$block_id.'" data-slide="prev"><img src="'.$themefolder.'/img/back.png"></a>';
			$output .= '<a class="carousel-control right" href="#sliderCarousel-'.$block_id.'" data-slide="next"><img src="'.$themefolder.'/img/next.png"></a>';
			$output .= '</div>'; // End sliderCarousel

			$output .= '<script type="text/javascript">jQuery(document).ready(function () {jQuery(".slider-block").carousel({interval: '.esc_attr($speed).($pause == 'yes' ? ',pause: "hover"' : '').'})});</script>';

				
			echo $output;
			
		}
		
		/* AJAX add testimonial */
		function add_slide() {
			$nonce = $_POST['security'];	
			if (! wp_verify_nonce($nonce, 'aqpb-settings-page-nonce') ) die('-1');
			
			$count = isset($_POST['count']) ? absint($_POST['count']) : false;
			$this->block_id = isset($_POST['block_id']) ? $_POST['block_id'] : 'aq-block-9999';
			
			//default key/value for the testimonial
			$slide = array(
				'title' => 'New Slide',
				'content' => '',
				'button' => 'yes',
				'btntext' => 'Learn More',
				'btncolor' => 'yellow',
				'linkopen' => 'same',
				'link' => '',
				'image' => '',
			);
			
			if($count) {
				$this->slide($slide, $count);
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
