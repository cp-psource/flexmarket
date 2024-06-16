<?php
/* Table Block */
if(!class_exists('AQ_Table_Block')) {
	class AQ_Table_Block extends AQ_Block {
	
		function __construct() {
			$block_options = array(
				'name' => 'Table',
				'size' => 'span12',
			);
			
			//create the widget
			parent::__construct('AQ_Table_Block', $block_options);
			
			//add ajax functions
			add_action('wp_ajax_aq_block_row_add_new', array($this, 'add_row'));
			
		}
		
		function form($instance) {
		
			$defaults = array(
				'rows' => array(
					1 => array(
						'title' => 'New Row',
						'rowcolor' => 'default',
						'column1' => '',
						'column2' => '',
						'column3' => '',
						'column4' => '',
						'column5' => '',
						'column6' => '',
						'column7' => '',
						'column8' => '',
						'column9' => '',
						'column10' => '',
						'column11' => '',
						'column12' => '',
					)
				),
				'columns' => '4',
				'types'	=> array('default'),
				'id' => '',
				'class' => '',
				'style' => ''
			);
			
			$instance = wp_parse_args($instance, $defaults);
			extract($instance);
			
			$table_type = array(
				'default' => 'Default',
				'striped' => 'Striped',
				'bordered' => 'Bordered',
				'hover' => 'Hover',
				'condensed' => 'Condensed'
			);

			$columns_per_row = array(
				'2' => '2',
				'3' => '3',
				'4' => '4',
				'5' => '5',
				'6' => '6',
				'7' => '7',
				'8' => '8',
				'9' => '9',
				'10' => '10',
				'11' => '11',
				'12' => '12'
			);
			
			?>
			<div class="description cf">
				<ul id="aq-sortable-list-<?php echo $block_id ?>" class="aq-sortable-list" rel="<?php echo $block_id ?>">
					<?php
					$rows = is_array($rows) ? $rows : $defaults['rows'];
					$count = 1;
					foreach($rows as $row) {	
						$this->row($row, $count, $columns);
						$count++;
					}
					?>
				</ul>
				<p></p>
				<a href="#" rel="row" class="aq-sortable-add-new button">Add New</a>
				<p></p>
			</div>
			<div class="description half">
				<label for="<?php echo $this->get_field_id('columns') ?>">
					Number of Columns (per row)<br/>
					<?php echo aq_field_select('columns', $block_id, $columns_per_row, $columns) ?>
				</label>
			</div>
			<div class="description half last">
				<label for="<?php echo $this->get_field_id('types') ?>">
					Table Type <em style="font-size: 0.8em;">(CTRL + click to select multiple options)</em><br/>
					<?php echo aq_field_multiselect('types', $block_id, $table_type, $types) ?>
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
		
		function row($row = array(), $count = 0, $columns = 4 ) {

			$color_options = array(
				'default' => 'Default',
				'green' => 'Green',
				'blue' => 'Blue',
				'red' => 'Red',
				'yellow' => 'Yellow'
			);

			?>
			<li id="sortable-item-<?php echo $count ?>" class="sortable-item" rel="<?php echo $count ?>">
				
				<div class="sortable-head cf">
					<div class="sortable-title">
						<strong><?php echo $row['title'] ?></strong>
					</div>
					<div class="sortable-handle">
						<a href="#">Open / Close</a>
					</div>
				</div>
				
				<div class="sortable-body">
					<div class="tab-desc description">
						<label for="<?php echo $this->get_field_id('rows') ?>-<?php echo $count ?>-title">
							Row Name<br/>
							<input type="text" id="<?php echo $this->get_field_id('rows') ?>-<?php echo $count ?>-title" class="input-full" name="<?php echo $this->get_field_name('rows') ?>[<?php echo $count ?>][title]" value="<?php echo $row['title'] ?>" />
						</label>
					</div>

					<div class="tab-desc description">
						<label for="<?php echo $this->get_field_id('rows') ?>-<?php echo $count ?>-rowcolor">
							Row Color<br/>
							<select id="<?php echo $this->get_field_id('rows') ?>-<?php echo $count ?>-rowcolor" name="<?php echo $this->get_field_name('rows') ?>[<?php echo $count ?>][rowcolor]">
								<?php 
									foreach($color_options as $key=>$value) {
										echo '<option value="'.$key.'" '.selected( $row['rowcolor'] , $key, false ).'>'.htmlspecialchars($value).'</option>';
									}
								?>
							</select>
							
						</label>
					</div>
					
					<div class="cf"></div>

					<?php for ($i=1; $i <= $columns; $i++) { ?>

					<p class="tab-desc description">
						<label for="<?php echo $this->get_field_id('rows') ?>-<?php echo $count ?>-column-<?php echo $i; ?>">
							Column <?php echo $i; ?><br/>
							<input type="text" id="<?php echo $this->get_field_id('rows') ?>-<?php echo $count ?>-column-<?php echo $i; ?>" class="input-full" name="<?php echo $this->get_field_name('rows') ?>[<?php echo $count ?>][column<?php echo $i; ?>]" value="<?php echo $row['column'.$i] ?>" />
						</label>
					</p>

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
			$class = (!empty($class) ? 'table '. esc_attr($class) : 'table');
			$style = (!empty($style) ? ' style="'.esc_attr($style).'"' : '');

			foreach( $types as $type ) {

				switch ($type) {
					case 'striped':
						$class .= ' table-striped';
						break;
					case 'bordered':
						$class .= ' table-bordered';
						break;	
					case 'hover':
						$class .= ' table-hover';
						break;	
					case 'condensed':
						$class .= ' table-condensed';
						break;	
				}

			}
			
			$output .= '<table'.$id.' class="'.$class.'"'.$style.'>';
				
				foreach( $rows as $row ) {

					switch ($row['rowcolor']) {
						case 'default':
							$colorclass = '';
							break;

						case 'blue':
							$colorclass = ' class="info"';
							break;

						case 'green':
							$colorclass = ' class="success"';
							break;

						case 'yellow':
							$colorclass = ' class="warning"';
							break;

						case 'red':
							$colorclass = ' class="error"';
							break;
					
						default:
							$colorclass = '';
							break;
					}

					$output .= '<tr'.$colorclass.'>';

					for ($i=1; $i <= $columns; $i++) {
						$output .= '<td>';
						$output .= wpautop(do_shortcode(mpt_content_kses(htmlspecialchars_decode($row['column'.$i]))));
						$output .= '</td>';
					}

					$output .= '</tr>';
				}
			
			$output .= '</table>';
				
			echo $output;
			
		}
		
		/* AJAX add row */
		function add_row() {
			$nonce = $_POST['security'];	
			if (! wp_verify_nonce($nonce, 'aqpb-settings-page-nonce') ) die('-1');
			
			$count = isset($_POST['count']) ? absint($_POST['count']) : false;
			$this->block_id = isset($_POST['block_id']) ? $_POST['block_id'] : 'aq-block-9999';
			
			//default key/value for the row
			$row = array(
				'title' => 'New Row',
				'rowcolor' => 'default',
				'column1' => '',
				'column2' => '',
				'column3' => '',
				'column4' => '',
				'column5' => '',
				'column6' => '',
				'column7' => '',
				'column8' => '',
				'column9' => '',
				'column10' => '',
				'column11' => '',
				'column12' => '',
			);
			
			if($count) {
				$this->row($row, $count);
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
