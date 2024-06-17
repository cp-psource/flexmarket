<?php
/**Well Box block **/
class AQ_Well_Block extends AQ_Block {

	public $name;
	public $block_id;
	
	/* PHP8 constructor */
	function __construct() {
		
		$block_options = array(
			'name' => 'Well Box',
			'size' => 'span6',
		);
		
		//create the widget
		parent::__construct('aq_well_block', $block_options);
		
	}

	function form($instance) {
		echo '<p class="empty-column">',
		__('Drag block items into this well box', 'framework'),
		'</p>';
		echo '<ul class="blocks column-blocks cf"></ul>';
	}
	
	function form_callback($instance = array()) {
		$instance = is_array($instance) ? wp_parse_args($instance, $this->block_options) : $this->block_options;
		
		//insert the dynamic block_id & block_saving_id into the array
		$this->block_id = 'aq_block_' . $instance['number'];
		$instance['block_saving_id'] = 'aq_blocks[aq_block_'. $instance['number'] .']';
		
		extract($instance);
		
		$col_order = $order;
		
		//column block header
		if(isset($template_id)) {
			echo '<li id="template-block-'.$number.'" class="block block-aq_column_block '.$size.'">',
					'<div class="block-settings-column cf" id="block-settings-'.$number.'">',
						'<p class="empty-column">',
							__('Drag block items into this Well box', 'framework'),
						'</p>',
						'<ul class="blocks column-blocks cf">';
					
			//check if column has blocks inside it
			$blocks = aq_get_blocks($template_id);
			
			//outputs the blocks
			if($blocks) {
				foreach($blocks as $key => $child) {
					global $aq_registered_blocks;
					extract($child);
					
					//get the block object
					$block = $aq_registered_blocks[$id_base];
					
					if($parent == $col_order) {
						$block->form_callback($child);
					}
				}
			} 
			echo 		'</ul>';
			
		} else {
			
	 		$title = $title ? '<span class="in-block-title"> : '.$title.'</span>' : '';
	 		$resizable = $resizable ? '' : 'not-resizable';
	 		
	 		echo '<li id="template-block-'.$number.'" class="block block-aq_column_block '. $size .' '.$resizable.'">',
	 				'<dl class="block-bar">',
	 					'<dt class="block-handle">',
	 						'<div class="block-title">',
	 							$name , $title, 
	 						'</div>',
	 						'<span class="block-controls">',
	 							'<a class="block-edit" id="edit-'.$number.'" title="Edit Block" href="#block-settings-'.$number.'">Edit Block</a>',
	 						'</span>',
	 					'</dt>',
	 				'</dl>',
	 				'<div class="block-settings cf" id="block-settings-'.$number.'">';

			$this->form($instance);
		}
				
		//form footer
		$this->after_form($instance);
	}
	
	//form footer
	function after_form($instance) {
		extract($instance);
		
		$block_saving_id = 'aq_blocks[aq_block_'.$number.']';
 		$userclass = !empty($userclass) ? esc_attr($userclass) : '';
 		$style = !empty($style) ? esc_attr($style) : '';

			echo '<div class="cf" style="height: 20px"></div>';
			echo 'Class (optional)<br/><input type="text" class="widefat" name="'.$this->get_field_name('userclass').'" value="'.$userclass.'" />';
			echo '<div class="cf" style="height: 10px"></div>';
			echo 'Additional inline css styling (optional)<br/><input type="text" class="widefat" name="'.$this->get_field_name('style').'" value="'.$style.'" />';
			echo '<div class="cf" style="height: 10px"></div>';
			echo '<div class="block-control-actions cf"><a href="#" class="delete">Delete</a></div>';
			echo '<input type="hidden" class="id_base" name="'.$this->get_field_name('id_base').'" value="'.$id_base.'" />';
			echo '<input type="hidden" class="name" name="'.$this->get_field_name('name').'" value="'.$name.'" />';
			echo '<input type="hidden" class="order" name="'.$this->get_field_name('order').'" value="'.$order.'" />';
			echo '<input type="hidden" class="size" name="'.$this->get_field_name('size').'" value="'.$size.'" />';
			echo '<input type="hidden" class="parent" name="'.$this->get_field_name('parent').'" value="'.$parent.'" />';
			echo '<input type="hidden" class="number" name="'.$this->get_field_name('number').'" value="'.$number.'" />';
		echo '</div>',
			'</li>';
	}
	
	function block_callback($instance) {
		$instance = is_array($instance) ? wp_parse_args($instance, $this->block_options) : $this->block_options;
		
		extract($instance);
		
		$col_order = $order;
		$col_size = absint(preg_replace("/[^0-9]/", '', $size));
		
		//column block header
		if(isset($template_id)) {

	 		$column_class = $first ? 'aq-first' : '';

	 		$userclass = (!empty($userclass) ? ' ' . esc_attr($userclass).'"' : '');
	 		$style = (!empty($style) ? ' style="' . esc_attr($style).'"' : '');
	 		
	 		echo '<div id="aq-block-'.$number.'" class="aq-block aq-block-'.$id_base.' '.$size.' '.$column_class.' well cf'.$userclass.'"'.$style.'>';
			
			//define vars
			$overgrid = 0; $span = 0; $first = false;
			
			//check if column has blocks inside it
			$blocks = aq_get_blocks($template_id);
			
			//outputs the blocks
			if($blocks) {
				foreach($blocks as $key => $child) {
					global $aq_registered_blocks;
					extract($child);
					
					if(class_exists($id_base)) {
						//get the block object
						$block = $aq_registered_blocks[$id_base];
						
						//insert template_id into $child
						$child['template_id'] = $template_id;
						
						//display the block
						if($parent == $col_order) {
							
							$child_col_size = absint(preg_replace("/[^0-9]/", '', $size));
							
							$overgrid = $span + $child_col_size;
							
							if($overgrid > $col_size || $span == $col_size || $span == 0) {
								$span = 0;
								$first = true;
							}
							
							if($first == true) {
								$child['first'] = true;
							}
							
							$block->block_callback($child);
							
							$span = $span + $child_col_size;
							
							$overgrid = 0; //reset $overgrid
							$first = false; //reset $first
						}
					}
				}
			} 
			
			$this->after_block($instance);
			
		} else {
			//show nothing
		}
	}
	
}