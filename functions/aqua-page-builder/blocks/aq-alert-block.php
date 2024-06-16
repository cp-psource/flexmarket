<?php
/** Notifications block **/

if(!class_exists('AQ_Alert_Block')) {
	class AQ_Alert_Block extends AQ_Block {
		
		//set and create block
		function __construct() {
			$block_options = array(
				'name' => 'Alerts',
				'size' => 'span6',
			);
			
			//create the block
			parent::__construct('aq_alert_block', $block_options);
		}
		
		function form($instance) {
			
			$defaults = array(
				'content' => '',
				'type' => 'note',
				'style' => ''
			);
			$instance = wp_parse_args($instance, $defaults);
			extract($instance);
			
			$type_options = array(
				'default' => 'Standard',
				'info' => 'Info',
				'note' => 'Notification',
				'warn' => 'Warning',
				'tips' => 'Tips'
			);
			
			?>
			
			<div class="description">
				<label for="<?php echo $this->get_field_id('title') ?>">
					Title (optional)<br/>
					<?php echo aq_field_input('title', $block_id, $title) ?>
				</label>
			</div>
			<div class="description">
				<label for="<?php echo $this->get_field_id('content') ?>">
					Alert Text (required)<br/>
					<?php echo aq_field_textarea('content', $block_id, $content) ?>
				</label>
			</div>
			<div class="description half">
				<label for="<?php echo $this->get_field_id('type') ?>">
					Alert Type<br/>
					<?php echo aq_field_select('type', $block_id, $type_options, $type) ?>
				</label>
			</div>
			<div class="description half last">
				<label for="<?php echo $this->get_field_id('style') ?>">
					Additional inline css styling (optional)<br/>
					<?php echo aq_field_input('style', $block_id, $style) ?>
				</label>
			</div>
			<?php
			
		}
		
		function block($instance) {
			extract($instance);
			
			echo '<div class="aq_alert '.$type.' cf" style="'. $style .'">' . do_shortcode(mpt_content_kses(htmlspecialchars_decode($content))) . '</div>';
			
		}
		
	}
}