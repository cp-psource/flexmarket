<?php
/** Contact Form block **/

if(!class_exists('AQ_Contact_Block')) {
	class AQ_Contact_Block extends AQ_Block {

		public $name;
		public $block_id;
		
		//set and create block
		function __construct() {
			$block_options = array(
				'name' => 'Contact Form',
				'size' => 'span6',
			);
			
			//create the block
			parent::__construct('aq_contact_block', $block_options);
		}
		
		function form($instance) {
			
			$defaults = array(
				'title' => '',
				'sendtoemail' => '',
				'btntext' => 'Send Message',
				'btncolor' => 'black',
				'btnsize' => 'large',
				'shortcode' => '',
				'id' => '',
				'class' => '',
				'style' => ''
			);
			$instance = wp_parse_args($instance, $defaults);
			extract($instance);

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
				'large' => 'Large',
				'block' => 'Block',
			);
			
			?>
			
			<div class="description">
				<label for="<?php echo $this->get_field_id('title') ?>">
					Title (optional)<br/>
					<?php echo aq_field_input('title', $block_id, $title) ?>
				</label>
			</div>

			<div class="description">
				<label for="<?php echo $this->get_field_id('sendtoemail') ?>">
					Send To Email<br/>
					<?php echo aq_field_input('sendtoemail', $block_id, $sendtoemail) ?>
				</label>
			</div>

			<div class="description third">
				<label for="<?php echo $this->get_field_id('btntext') ?>">
					Button Text<br/>
					<?php echo aq_field_input('btntext', $block_id, $btntext) ?>
				</label>
			</div>

			<div class="description third">
				<label for="<?php echo $this->get_field_id('btnsize') ?>">
					Button Size<br/>
					<?php echo aq_field_select('btnsize', $block_id, $btnsize_options, $btnsize); ?>
				</label>
			</div>

			<div class="description third last">
				<label for="<?php echo $this->get_field_id('btncolor') ?>">
					Button Color<br/>
					<?php echo aq_field_select('btncolor', $block_id, $btncolor_options, $btncolor); ?>
				</label>
			</div>

			<div class="cf"></div>

			<div class="description">
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

			$userclass = (!empty($class) ? ' '.esc_attr($class) : '');
			$style = (!empty($style) ? ' style="'.esc_attr($style).'"' : '');

			$btnclass = 'btn';
			$theemailsent = '';

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
				case 'block':
					$btnclass .= ' btn-block';
					break;	
			}

			  if(isset($_POST['submitted'])) {

			    if(sanitize_text_field($_POST['inputname']) === '') {
			      $thenameerror = 'Please enter your name below.';
			      $haserror = true;
			    } else {
			      $thename = sanitize_text_field($_POST['inputname']);
			    }

			    if(sanitize_text_field($_POST['inputemail']) === '')  {
			      $theemailerror = 'Please enter your valid email address below.';
			      $haserror = true;
			    } else if (!is_email(sanitize_text_field($_POST['inputemail']))) {
			      $theemailerror = 'You entered an invalid email address.';
			      $haserror = true;
			    } else {
			      $theemail = sanitize_text_field($_POST['inputemail']);
			    }

			    if(sanitize_text_field($_POST['inputsubject']) === '') {
			      $subjecterror = 'Please enter the subject line below.';
			      $haserror = true;
			    } else {
			      $subject = sanitize_text_field($_POST['inputsubject']);
			    }

			    if(sanitize_text_field($_POST['themessage']) === '') {
			      $commenterror = 'Please enter a message below.';
			      $haserror = true;
			    } else {
			      if(function_exists('stripslashes')) {
			        $comments = stripslashes(sanitize_text_field($_POST['themessage']));
			      } else {
			        $comments = sanitize_text_field($_POST['themessage']);
			      }
			    }

			    if(!isset($haserror)) {
			      $sendtoemail = is_email($sendtoemail);

			      if (!empty($sendtoemail) && $sendtoemail !="false") {
			      	$theemailto = $sendtoemail;
			      } else {
			      	$theemailto = get_bloginfo('admin_email');
			      }
			      
			      $body = "Name: $thename \n\nEmail: $theemail \n\nMessage: $comments";
			      $headers = 'From: '.$thename.' <'.$theemailto.'>' . "\r\n" . 'Reply-To: ' . $theemail;

			      wp_mail($theemailto, $subject, $body, $headers);
			      $theemailsent = 'true';
			    }			    

			  }
			
			?>

			<div id="contact-form-<?php echo $block_id; ?>" class="contact-form-block well<?php echo $userclass; ?>"<?php echo $style; ?>>

	            <form action="<?php echo (is_home() ? home_url().'/' : get_permalink()); ?>#contact-form-<?php echo $block_id; ?>" id="contact-form" method="post">

	            	<?php echo ($theemailsent == 'true' ? '<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert">×</button><strong>Your message was sent successfully.</strong> We will get back to you as soon as possible.</div>' : ''); ?>
	            	<!-- name -->
	              	<div class="control-group">
		              	<label class="control-label" for="inputname"><b>Your Name:</b></label>
		              	<?php echo (!empty($thenameerror) ? '<div class="alert alert-error"><button type="button" class="close" data-dismiss="alert">×</button>'.$thenameerror.'</div>' : ''); ?>
			              <div class="controls">
		              		<input name="inputname" class="input-max" id="inputname" type="text" value="<?php if (!empty($thename)) {echo $thename;} ?>">
			            	</div>
	            	</div>
	            	<!-- email -->
	              	<div class="control-group">
		              	<label class="control-label" for="inputemail"><b>Your Email:</b></label>
		              	<?php echo (!empty($theemailerror) ? '<div class="alert alert-error"><button type="button" class="close" data-dismiss="alert">×</button>'.$theemailerror.'</div>' : ''); ?>
			              <div class="controls">
		              		<input name="inputemail" class="input-max" id="inputemail" type="text" value="<?php if (!empty($theemail)) {echo $theemail;} ?>">
			            	</div>
	            	</div>
	            	<!-- subject -->
	              	<div class="control-group">
		              	<label class="control-label" for="inputsubject"><b>Subject:</b></label>
		              	<?php echo (!empty($subjecterror) ? '<div class="alert alert-error"><button type="button" class="close" data-dismiss="alert">×</button>'.$subjecterror.'</div>' : ''); ?>
			              <div class="controls">
		              		<input name="inputsubject" class="input-max" id="inputsubject" type="text" value="<?php if (!empty($subject)) {echo $subject;} ?>">
			            	</div>
	            	</div>
	            	<!-- message -->
	              	<div class="control-group">
		              	<label class="control-label" for="inputmessage"><b>Message:</b></label>
		              	<?php echo (!empty($commenterror) ? '<div class="alert alert-error"><button type="button" class="close" data-dismiss="alert">×</button>'.$commenterror.'</div>' : ''); ?>
			              <div class="controls">
			              	<textarea rows="5" class="input-max" name="themessage" id="themessage"><?php if (!empty($comments)) {echo $comments;} ?></textarea>
			            	</div>
	            	</div>
	            	<!-- button -->
	            	<div class="align-left">
	            		<button type="submit" class="<?php echo $btnclass; ?>"><?php echo esc_attr($btntext); ?></button>
	            	</div>
	              	<input type="hidden" name="submitted" id="submitted" value="true" />
	            
	            </form>

			</div>

			<?php
			
		}
		
	}
}