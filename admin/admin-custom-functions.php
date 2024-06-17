<?php

/**
 * general setting functions.
 *
 */

	// load site logo
	function mpt_load_site_logo() {
		$themefolder = get_template_directory_uri();
		$mpt_logo_upload = esc_url(get_option('mpt_sitelogo'));
		if(!empty($mpt_logo_upload)) {
			echo '<center><a href="'.home_url().'"><img src="'.$mpt_logo_upload.'" alt="" /></a></center>';
		 } else {
			echo '<center><a href="'.home_url().'"><img src="'.$themefolder.'/img/site-logo.png" alt="" /></a></center>';
		}
	}

	//load site favicon
	function mpt_load_favicon() {
		$mpt_favicon_upload = esc_url(get_option('mpt_favicon'));
		if(!empty($mpt_favicon_upload)) {
			echo $mpt_favicon_upload;
		 } else {
			echo '';
		}
	}

	//load footer text
	function mpt_load_footer_text() {
		$customfooter = get_option('mpt_cus_footer');
		$custom = wp_kses( $customfooter, array(
					'a' => array(
						'href' => array(),
						'title' => array()
						),
					'br' => array(),
					'em' => array(),
					'strong' => array() 
					) ); 
		$date = date("Y");
		$sitename = esc_attr(get_bloginfo('name'));
			if(!empty($custom)) {
				echo '<p>'.$custom.'</p>';
			 } else {
				echo '<p>Copyright &copy;'.$date.' '.$sitename.' | Designed by <a href="https://github.com/cp-psource"><b>PSOURCE</b></a></p>';
			}
	}
	
/**
 * Styling Options.
 *
 */	

	function mpt_load_base_style() {
		$themefolder = get_template_directory_uri();

		echo '<link href="'.$themefolder.'/styles/color-black.css" type="text/css" rel="stylesheet" />';
	}
	
	function mpt_load_google_web_font_header() {
		$selected = get_option('mpt_theme_header_font');
		$customfont = get_option('mpt_theme_custom_web_font');
		$customheaderfont = esc_attr(get_option('mpt_theme_custom_web_font_header'));

		if ($customfont != 'true' || empty($customheaderfont)) {
			$selected = str_replace(' ', '+', $selected);
			echo '<link href="http://fonts.googleapis.com/css?family='.$selected.'" rel="stylesheet" type="text/css">';
		}
	}
	
	function mpt_load_google_web_font_body() {
		$selected = get_option('mpt_theme_body_font');
		$customfont = get_option('mpt_theme_custom_web_font');
		$custombodyfont = esc_attr(get_option('mpt_theme_custom_web_font_body'));

		if ($customfont != 'true' || empty($custombodyfont)) {
			$selected = str_replace(' ', '+', $selected);
			echo '<link href="http://fonts.googleapis.com/css?family='.$selected.'" rel="stylesheet" type="text/css">';
		}
	}

	function mpt_load_custom_google_font_header() {
		$customfont = get_option('mpt_theme_custom_web_font');
		$customheaderfont = esc_attr(get_option('mpt_theme_custom_web_font_header'));

		if ($customfont == 'true' && !empty($customheaderfont)) {
			echo '<link href="http://fonts.googleapis.com/css?family='.$customheaderfont.'" rel="stylesheet" type="text/css">';
		}
	}

	function mpt_load_custom_google_font_body() {
		$customfont = get_option('mpt_theme_custom_web_font');
		$custombodyfont = esc_attr(get_option('mpt_theme_custom_web_font_body'));

		if ($customfont == 'true' && !empty($custombodyfont)) {
			echo '<link href="http://fonts.googleapis.com/css?family='.$custombodyfont.'" rel="stylesheet" type="text/css">';
		}
	}

	function mpt_load_bg_patterns($bgpattern) {
		$themefolder =  get_template_directory_uri();
		switch ($bgpattern) {
			case 'pattern_1':
				return "background-image: url('".$themefolder."/img/patterns/pat_01.png');";
			break;
			case 'pattern_2':
				return "background-image: url('".$themefolder."/img/patterns/pat_02.png');";
			break;
			case 'pattern_3':
				return "background-image: url('".$themefolder."/img/patterns/pat_03.png');";
			break;
			case 'pattern_4':
				return "background-image: url('".$themefolder."/img/patterns/pat_04.png');";
			break;
			case 'pattern_5':
				return "background-image: url('".$themefolder."/img/patterns/pat_05.png');";
			break;
			case 'pattern_6':
				return "background-image: url('".$themefolder."/img/patterns/pat_06.png');";
			break;
			case 'pattern_7':
				return "background-image: url('".$themefolder."/img/patterns/pat_07.png');";
			break;
			case 'pattern_8':
				return "background-image: url('".$themefolder."/img/patterns/pat_08.png');";
			break;
			case 'pattern_9':
				return "background-image: url('".$themefolder."/img/patterns/pat_09.png');";
			break;
			case 'pattern_10':
				return "background-image: url('".$themefolder."/img/patterns/pat_10.png');";
			break;

		}
	}	
	
/**
 * Footer Setting functions.
 *
 */	

	function mpt_footer_widget_setting_1() {
		$selected = get_option('mpt_footer_widget_setting');
		if($selected == 'widget633') {
				echo '6';
		} elseif ($selected == 'widget336') {
				echo '3';
		} else {
				echo '4';
		}
	}
	
	function mpt_footer_widget_setting_2() {
		$selected = get_option('mpt_footer_widget_setting');
		if($selected == 'widget633') {
				echo '3';
		} elseif ($selected == 'widget336') {
				echo '3';
		} else {
				echo '4';
		}
	}
	
	function mpt_footer_widget_setting_3() {
		$selected = get_option('mpt_footer_widget_setting');
		if($selected == 'widget633') {
				echo '3';
		} elseif ($selected == 'widget336') {
				echo '6';
		} else {
				echo '4';
		}
	}


/**
 * Social Icon functions.
 *
 */	

	//show facebook icon
	function mpt_show_fb_icon() {
		$fburl = esc_url(get_option('mpt_fb_link'));
		$selected = get_option('mpt_enable_fb_icon');
		$themefolder = get_template_directory_uri();
		if($selected == 'true') {
			if(!empty($fburl)) {
				echo '<li><a href="'.$fburl.'" target="_blank"><img src="'.$themefolder.'/img/icon/24/social-icon-circle-fb.png" width="24" height="24" title="Facebook"></a></li>';
			 } else {
				echo '<li><a href="http://www.facebook.com" target="_blank"><img src="'.$themefolder.'/img/icon/24/social-icon-circle-fb.png" width="24" height="24" title="Facebook"></a></li>';
			}
		} else {
				echo '';
			}
	}

	//show twitter icon
	function mpt_show_twit_icon() {
		$twiturl = esc_url(get_option('mpt_twitter_link'));
		$selected = get_option('mpt_enable_twitter_icon');
		$themefolder = get_template_directory_uri();
		if($selected == 'true') {
			if(!empty($twiturl)) {
				echo '<li><a href="'.$twiturl.'" target="_blank"><img src="'.$themefolder.'/img/icon/24/social-icon-circle-twit.png" width="24" height="24" title="Twitter"></a></li>';
			 } else {
				echo '<li><a href="http://www.twitter.com" target="_blank"><img src="'.$themefolder.'/img/icon/24/social-icon-circle-twit.png" width="24" height="24" title="Twitter"></a></li>';
			}
		} else {
				echo '';
			}
	}

	//show Google+ icon
	function mpt_show_gplus_icon() {
		$gplusurl = esc_url(get_option('mpt_gplus_link'));
		$selected = get_option('mpt_enable_gplus_icon');
		$themefolder = get_template_directory_uri();
		if($selected == 'true') {
			if(!empty($gplusurl)) {
				echo '<li><a href="'.$gplusurl.'" target="_blank"><img src="'.$themefolder.'/img/icon/24/social-icon-circle-gplus.png" width="24" height="24" title="Google+"></a></li>';
			 } else {
				echo '<li><a href="http://plus.google.com" target="_blank"><img src="'.$themefolder.'/img/icon/24/social-icon-circle-gplus.png" width="24" height="24" title="Google+"></a></li>';
			}
		} else {
				echo '';
			}
	}
	 
	//show Dribbble icon
	function mpt_show_dribbble_icon() {
		$dribbbleurl = esc_url(get_option('mpt_dribbble_link'));
		$selected = get_option('mpt_enable_dribbble_icon');
		$themefolder = get_template_directory_uri();
		if($selected == 'true') {
			if(!empty($dribbbleurl)) {
				echo '<li><a href="'.$dribbbleurl.'" target="_blank"><img src="'.$themefolder.'/img/icon/24/social-icon-circle-dribbble.png" width="24" height="24" title="Dribble"></a></li>';
			 } else {
				echo '<li><a href="http://dribbble.com" target="_blank"><img src="'.$themefolder.'/img/icon/24/social-icon-circle-dribbble.png" width="24" height="24" title="Dribble"></a></li>';
			}
		} else {
				echo '';
			}
	}

	//show Vimeo icon
	function mpt_show_vimeo_icon() {
		$vimeourl = esc_url(get_option('mpt_vimeo_link'));
		$selected = get_option('mpt_enable_vimeo_icon');
		$themefolder = get_template_directory_uri();
		if($selected == 'true') {
			if(!empty($vimeourl)) {
				echo '<li><a href="'.$vimeourl.'" target="_blank"><img src="'.$themefolder.'/img/icon/24/social-icon-circle-vimeo.png" width="24" height="24" title="Vimeo"></a></li>';
			 } else {
				echo '<li><a href="http://vimeo.com" target="_blank"><img src="'.$themefolder.'/img/icon/24/social-icon-circle-vimeo.png" width="24" height="24" title="Vimeo"></a></li>';
			}
		} else {
				echo '';
			}
	}


	//show rss icon
	function mpt_show_rss_icon() {
		$rssurl = esc_url(get_option('mpt_rss_link'));
		$selected = get_option('mpt_enable_rss_icon');
		$themefolder = get_template_directory_uri();
		$blogrss = get_bloginfo('rss_url');
		if($selected == 'true') {
			if(!empty($rssurl)) {
				echo '<li><a href="'.$rssurl.'" target="_blank"><img src="'.$themefolder.'/img/icon/24/social-icon-circle-rss.png" width="24" height="24" title="RSS"></a></li>';
			 } else {
				echo '<li><a href="'.$blogrss.'" target="_blank"><img src="'.$themefolder.'/img/icon/24/social-icon-circle-rss.png" width="24" height="24" title="RSS"></a></li>';
			}
		} else {
				echo '';
			}
	}

	
/**
 * SEO functions.
 *
 */	
	//load site title
	function mpt_load_site_title() {
		$customtitle = esc_attr(get_option('mpt_cus_title'));
		$selected = get_option('mpt_enable_custom_title');
		$blogtitle = esc_attr(get_bloginfo('name'));
		if($selected == 'true') {
			if(!empty($customtitle)) {
				echo $customtitle;
			 } else {
				echo $blogtitle;
			}
		} else {
				echo $blogtitle;
			}
	}
	
	//load meta description
	function mpt_load_meta_desc() {
		$metadesc = esc_attr(get_option('mpt_cus_meta_desc'));
		$selected = get_option('mpt_enable_meta_desc');
		$blogdesc = esc_attr(get_bloginfo('description'));
		if($selected == 'true') {
			if(!empty($metadesc)) {
				echo $metadesc;
			 } else {
				echo $blogdesc;
			}
		} else {
				echo $blogdesc;
			}
	}

	//load meta keywords
	function mpt_load_meta_keywords() {
		$metakey = esc_attr(get_option('mpt_cus_meta_keywords'));
		$selected = get_option('mpt_enable_meta_keywords');
		if($selected == 'true') {
			if(!empty($metakey)) {
				echo $metakey;
			 } else {
				echo '';
			}
		} else {
				echo '';
			}
	}

/**
 * Code Integration function.
 *
 */
	function mpt_load_header_code() {
		$headercode = get_option('mpt_header_code');
		$selected = get_option('mpt_enable_header_code');
		if($selected == 'true') {
			if(!empty($headercode)) {
				echo $headercode;
			 }
		}
	}

	function mpt_load_body_code() {
		$bodycode = get_option('mpt_body_code');
		$selected = get_option('mpt_enable_body_code');
		if($selected == 'true') {
			if(!empty($bodycode)) {
				echo $bodycode;
			 }
		}
	}
	
	function mpt_load_top_code() {
		$topcode = get_option('mpt_top_code');
		$selected = get_option('mpt_enable_top_code');
		if($selected == 'true') {
			if(!empty($topcode)) {
				echo $topcode.'<div class="clear padding10"></div>';
			 }
		}
	}
	
	function mpt_load_bottom_code() {
		$bottomcode = get_option('mpt_bottom_code');
		$selected = get_option('mpt_enable_bottom_code');
		if($selected == 'true') {
			if(!empty($bottomcode)) {
				echo $bottomcode.'<div class="clear padding10"></div>';
			 }
		}
	}

/**
 * Post Functions.
 *
 */

	function mpt_load_featured_image( $id , $imagesize = 'tb-360' , $prettyphoto = false , $btnclass = '' , $iconclass = '') {
		$output = '';
		$fullimage = wp_get_attachment_image_src( get_post_thumbnail_id($id), 'full');


		if ($imagesize == 'tb-860') {
			$style = ' style="max-width: 860px;"';
		} else {
			$style = '';
		}

		$output .= '<div class="image-box transparent add-shadow-effect"'.$style.'>';
		$output .= '<div class="hover-btn">';

			if ($prettyphoto == 'true') {
				$output .= '<a href="'.$fullimage[0].'" class="btn btn-block" rel="prettyPhoto[post-'.$id.']"><i class="icon-search"></i> View Image';
			} else {
				$output .= '<a href="'.get_permalink($id).'" class="btn btn-block"><i class="icon-search"></i> Read Post';
			}
			$output .= '</a>';

		$output .= '</div>';

		if ($prettyphoto == 'true') {
			$output .= '<a href="'.$fullimage[0].'" rel="prettyPhoto[post-'.$id.']">';
		} else {
			$output .= '<a href="'.get_permalink($id).'" >';
		}
			
		$output .= get_the_post_thumbnail($id,$imagesize);
		$output .= '</a>';

		$output .= '</div>';
		
		echo $output;
	}

	function mpt_load_image_carousel( $id , $imagesize = 'tb-360' , $prettyphoto = false) {
		$themefolder = get_template_directory_uri();
		$output = '';
		$image1 = get_post_meta( $id, '_mpt_video_featured_image_2', true );
		$imageurl1 = esc_url($image1);
		$attachid1 = get_image_id($imageurl1);
		$image2 = get_post_meta( $id, '_mpt_video_featured_image_3', true );
		$imageurl2 = esc_url($image2);
		$attachid2 = get_image_id($imageurl2);
		$fullimage = wp_get_attachment_image_src( get_post_thumbnail_id($id), 'full');

		if ($imagesize == 'tb-860') {
			$style = ' style="max-width: 860px;"';
		} else {
			$style = '';
		}

		$output .= '<div id="image-carousel-'.$id.'" class="image-carousel carousel slide add-shadow-effect"'.$style.'>';
		$output .= '<div class="carousel-inner">';
		$output .= '<div class="active item">';

		if ($prettyphoto == 'true') {
			$output .= '<a href="'.$fullimage[0].'" rel="prettyPhoto[carousel-'.$id.']">';
		} else {
			$output .= '<a href="'.get_permalink($id).'">';
		}

		$output .= get_the_post_thumbnail($id,$imagesize);
		$output .= '</a></div>';

		if (!empty($image1)) {

			$output .= '<div class="item">';

			if ($prettyphoto == 'true') {
				$output .= '<a href="'.$imageurl1.'" rel="prettyPhoto[carousel-'.$id.']">';
			} else {
				$output .= '<a href="'.get_permalink($id).'">';
			}

			$output .= wp_get_attachment_image( $attachid1, $imagesize );
			$output .= '</a></div>';
		}

		if (!empty($image2)) {

			$output .= '<div class="item">';

			if ($prettyphoto == 'true') {
				$output .= '<a href="'.$imageurl2.'" rel="prettyPhoto[carousel-'.$id.']">';
			} else {
				$output .= '<a href="'.get_permalink($id).'">';
			}

			$output .= wp_get_attachment_image( $attachid2, $imagesize );
			$output .= '</a></div>';
		}

		$output .= '</div>';
		$output .= '<a class="carousel-control left" href="#image-carousel-'.$id.'" data-slide="prev"><img src="'.$themefolder.'/img/back.png"></a>';
		$output .= '<a class="carousel-control right" href="#image-carousel-'.$id.'" data-slide="next"><img src="'.$themefolder.'/img/next.png"></a>';
		$output .= '</div>';
		$output .= '<script type="text/javascript">';
		$output .= 'jQuery(document).ready(function () {jQuery("#image-carousel-'.$id.'").carousel({interval: 3000,pause: "hover"})});';
		$output .= '</script>';
		
		echo $output;
	}

	function get_image_id($image_url) {
		global $wpdb;
		$query = "SELECT ID FROM {$wpdb->posts} WHERE guid='$image_url'";
		$id = $wpdb->get_var($query);
		return $id;
	}

	function mpt_load_video_post( $id , $height = null) {
		$output = '';
		$video = get_post_meta( $id, '_mpt_post_video_url', true );
		$videourl = esc_url($video);
		$videotype = get_post_meta( $id, '_mpt_post_video_type', true );
		$videocode = '';

		if (!empty($height)) {
			$videoheight = ' height="'.$height.'"';
		} else {
			$videoheight = '';
		}

		switch ($videotype) {
			case 'youtube':
				$youtube = array(
					"http://youtu.be/",
					"http://www.youtube.com/watch?v=",
					"http://www.youtube.com/embed/"
					);
				$videonum = str_replace($youtube, "", $videourl);
				$videocode = 'http://www.youtube.com/embed/' . $videonum;
				break;
			case 'vimeo':
				$vimeo = array(
					"http://vimeo.com/",
					"http://player.vimeo.com/video/"
					);
				$videonum = str_replace($vimeo, "", $videourl);
				$videocode = 'http://player.vimeo.com/video/' . $videonum;
				break;
		}

		$output .= '<div class="video-box">';
		$output .= '<iframe src="'.$videocode.'?title=1&amp;byline=1&amp;portrait=1" width="100%"'.$videoheight.' frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>';
		$output .= '</div>';
		
		echo $output;
	}


/**
 * MarketPress Settings Functions.
 *
 */

	function mpt_load_mp_btn_color() {
		$selected = get_option('mpt_mp_main_btn_color');

		switch ($selected) {
			case 'Grey':
				$class = '';
				break;
			case 'Blue':
				$class = ' btn-primary';
				break;
			case 'Light Blue':
				$class = ' btn-info';
				break;
			case 'Green':
				$class = ' btn-success';
				break;
			case 'Yellow':
				$class = ' btn-warning';
				break;
			case 'Red':
				$class = ' btn-danger';
				break;
			case 'Black':
				$class = ' btn-inverse';
				break;
			
			default:
				$class = ' btn-inverse';
				break;
		}

		return $class;
	}

	function mpt_load_whiteicon_in_btn() {
		$selected = get_option('mpt_mp_main_btn_color');

		switch ($selected) {
			case 'Grey':
				$class = '';
				break;
			case 'Blue':
				$class = ' icon-white';
				break;
			case 'Light Blue':
				$class = ' icon-white';
				break;
			case 'Green':
				$class = ' icon-white';
				break;
			case 'Yellow':
				$class = ' icon-white';
				break;
			case 'Red':
				$class = ' icon-white';
				break;
			case 'Black':
				$class = ' icon-white';
				break;
			
			default:
				$class = ' icon-white';
				break;
		}

		return $class;
	}

	function mpt_load_icontag_color() {
		$selected = get_option('mpt_mp_main_icon_tag_color');

		switch ($selected) {
			case 'White':
				$class = ' icon-white';
				break;
			case 'Blue':
				$class = ' icon-blue';
				break;
			case 'Light Blue':
				$class = ' icon-lightblue';
				break;
			case 'Green':
				$class = ' icon-green';
				break;
			case 'Yellow':
				$class = ' icon-yellow';
				break;
			case 'Red':
				$class = ' icon-red';
				break;
			case 'Black':
				$class = '';
				break;
			
			default:
				$class = '';
				break;
		}

		return $class;
	}

	function mpt_load_product_listing_layout() {
		$selected = get_option('mpt_mp_listing_layout');

		switch ($selected) {
			case '2 Columns':
				return 'span6';
				break;
			case '3 Columns':
				return 'span4';
				break;
			case '4 Columns':
				return 'span3';
				break;
			
			default:
				return 'span4';
				break;
		}

	}

	function mpt_load_product_listing_counter() {
		$selected = get_option('mpt_mp_listing_layout');

		switch ($selected) {
			case '2 Columns':
				return '2';
				break;
			case '3 Columns':
				return '3';
				break;
			case '4 Columns':
				return '4';
				break;
			
			default:
				return '3';
				break;
		}
	}

	function mpt_enable_advanced_sort() {

		if (get_option('mpt_enable_advanced_sort') == 'true') 
			return true;
		else 
			return false;
	}

	function mpt_advanced_sort_btn_position() {
		$selected = get_option('mpt_advanced_soft_btn_position');

		switch ($selected) {
			case 'Left':
				return 'align-left';
				break;
			case 'Center':
				return 'align-center';
				break;
			case 'Right':
				return 'align-right';
				break;
			
			default:
				return 'align-right';
				break;
		}
	}
?>
