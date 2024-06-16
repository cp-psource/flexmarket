<?php

function flexmarket_advance_product_sort( $unique_id = '' , $sort = false, $align = 'align-right', $context = 'list' ,$echo = true , $paginate = '' , $page = '', $per_page = '', $order_by = '', $order = '', $category = '', $tag = '' , $counter = '3' , $span = 'span4' , $btnclass = '' , $iconclass = '' , $tagcolor = '' , $boxclass = '' , $boxstyle = '') {

	$output = '';

	if ($sort) {

		global $mp;

		$mp->start_session();

		if(isset($_POST['advancedsortformsubmitted'.$unique_id])) {

			if ($context == 'list') {
				$_SESSION['advancedsortcategory'.$unique_id] = (!empty($_POST['advancedsortcategory'.$unique_id])) ? esc_html(esc_attr(trim($_POST['advancedsortcategory'.$unique_id]))) : '';
			} else {
				$_SESSION['advancedsortcategory'.$unique_id] = '';
			}
			$_SESSION['advancedsortby'.$unique_id] = (!empty($_POST['advancedsortby'.$unique_id])) ? esc_html(esc_attr(trim($_POST['advancedsortby'.$unique_id]))) : '';
			$_SESSION['advancedsortdirection'.$unique_id] = (!empty($_POST['advancedsortdirection'.$unique_id])) ? esc_html(esc_attr(trim($_POST['advancedsortdirection'.$unique_id]))) : '';
		}

		$category = (!empty($_SESSION['advancedsortcategory'.$unique_id])) ? esc_html(esc_attr(trim($_SESSION['advancedsortcategory'.$unique_id]))) : $category;
		$order_by = (!empty($_SESSION['advancedsortby'.$unique_id])) ? esc_html(esc_attr(trim($_SESSION['advancedsortby'.$unique_id]))) : $order_by;
		$order = (!empty($_SESSION['advancedsortdirection'.$unique_id])) ? esc_html(esc_attr(trim($_SESSION['advancedsortdirection'.$unique_id]))) : $order;

		$output = apply_filters( 'flexmarket_listing_before_advanced_sort' , $output , $unique_id , $context , $category , $tag );

		$output .= '<div id="advanced-sort" class="'.$align.'">';
			$output .= '<a href="#adv-sort" role="button" data-toggle="modal" class="btn btn-large'.$btnclass.'"><i class="icon-th'.$iconclass.'"></i> '.__('Advanced Sort' , 'flexmarket').'</a>';
			$output .= '<div class="clear padding20"></div>';
		$output .= '</div>';

		// Advanced Modal
		$output .= '<div id="adv-sort" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="advancedSort" aria-hidden="true">';
			
			$output .= '<div class="modal-header">';
		    	$output .= '<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>';
		    	$output .= '<h4>'.__('Advanced Sort' , 'flexmarket').'</h4>';
			$output .= '</div>';

			$output .= '<div class="modal-body">';

				$output .= '<div class="row-fluid">';

					$output .= '<form class="form-horizontal" action="'.$_SERVER["REQUEST_URI"].'#advanced-sort" id="advanced-sort-form" method="post">';

						if ($context == 'list') {

							// By Category   
							$output .= '<div class="input-prepend">';
								$output .= '<span class="add-on">'.__('By Category' , 'flexmarket').':</span>';
								$output .= '<select name="advancedsortcategory'.$unique_id.'" id="advancedsortcategory'.$unique_id.'">';
									$output .= '<option value="">Show All</option>';

										$args = array(
											'taxonomy' => 'product_category',
											'orderby' => 'name',
											'order' => 'ASC'
										  );

										$categories = get_categories($args);

										if  ($categories) {
										  foreach($categories as $cat) {
										    $output .= '<option value="'.$cat->category_nicename.'"'.($cat->category_nicename == $category ? ' selected="selected"' : '').'>'.$cat->name.'</option>';
										  }
										}

								$output .= '</select>';
							$output .= '</div>';

							$output .= '<div class="clear padding10"></div>';

						}

						// Sort By
						$output .= '<div class="input-prepend">';
							$output .= '<span class="add-on">'.__('Sort By' , 'flexmarket').':</span>';
							$output .= '<select name="advancedsortby'.$unique_id.'" id="advancedsortby'.$unique_id.'">';
								$output .= '<option value="date"'.($order_by == 'date' ? ' selected="selected"' : '').'>Release Date</option>';
								$output .= '<option value="title"'.($order_by == 'title' ? ' selected="selected"' : '').'>Name</option>';
								$output .= '<option value="price"'.($order_by == 'price' ? ' selected="selected"' : '').'>Price</option>';
								$output .= '<option value="sales"'.($order_by == 'sales' ? ' selected="selected"' : '').'>Sales</option>';
							$output .= '</select>';
						$output .= '</div>';

						$output .= '<div class="clear padding10"></div>';

						// Sort Direction
						$output .= '<div class="input-prepend">';
							$output .= '<span class="add-on">'.__('Sort Direction' , 'flexmarket').':</span>';
							$output .= '<select name="advancedsortdirection'.$unique_id.'" id="advancedsortdirection'.$unique_id.'">';
								$output .= '<option value="DESC"'.($order == 'DESC' ? ' selected="selected"' : '').'>Descending</option>';
								$output .= '<option value="ASC"'.($order == 'ASC' ? ' selected="selected"' : '').'>Ascending</option>';
							$output .= '</select>';
						$output .= '</div>';

						$output .= '<div class="clear padding10"></div>';

						$output .= '<button type="submit" class="btn'.$btnclass.' advanced-sort-btn pull-right" data-toggle="button"><i class="icon-th'.$iconclass.'"></i> Sort</button>';

						$output .= '<input type="hidden" name="advancedsortformsubmitted'.$unique_id.'" id="advancedsortformsubmitted'.$unique_id.'" value="true" />';

					$output .= '</form>';

			    $output .= '</div>'; // row-fluid

			$output .= '</div>'; // modal body

		$output .= '</div>'; // advanced-sort

		$output = apply_filters( 'flexmarket_listing_after_advanced_sort' , $output , $unique_id , $context , $category , $tag );

	}

	$output = apply_filters( 'flexmarket_listing_before_grid' , $output , $unique_id , $context , $category , $tag );
	$output .= '<div id="mpt-product-grid">';

		$output .= flexmarket_list_product_in_grid( false , $paginate , $page , $per_page, $order_by, $order, $category , $tag , $counter, $span, $btnclass, $iconclass, $tagcolor , $boxclass , $boxstyle);

	$output .= '</div>';
	$output = apply_filters( 'flexmarket_listing_after_grid' , $output , $unique_id , $context , $category , $tag );

  	if ($echo)
    	echo $output;
  	else
    	return $output;

}

function flexmarket_list_product_in_grid( $echo = true , $paginate = '' , $page = '', $per_page = '', $order_by = '', $order = '', $category = '', $tag = '' , $counter = '3' , $span = 'span4' , $btnclass = '' , $iconclass = '' , $tagcolor = '' , $boxclass = '' , $boxstyle = '') { 

	  global $wp_query, $mp;

	  //setup taxonomy if applicable
	  if ($category) {
	    $taxonomy_query = '&product_category=' . sanitize_title($category);
	  } else if ($tag) {
	    $taxonomy_query = '&product_tag=' . sanitize_title($tag);
	  } else if (isset($wp_query->query_vars['taxonomy']) && ($wp_query->query_vars['taxonomy'] == 'product_category' || $wp_query->query_vars['taxonomy'] == 'product_tag')) {
	    $term = get_queried_object(); //must do this for number tags
	    $taxonomy_query = '&' . $term->taxonomy . '=' . $term->slug;
	  } else {
	    $taxonomy_query = '';
	  }
	  
	  //setup pagination
	  $paged = false;
	  if ($paginate) {
	  	if ($paginate === 'nopagingblock') {
	  		$paginate_query = '&showposts='.intval($per_page);
	  	} else {
	  		$paged = true;	
	  	}
	  } else if ($paginate === '') {
	    if ($mp->get_setting('paginate'))
	      $paged = true;
	    else
	      $paginate_query = '&nopaging=true';
	  } else {
	    $paginate_query = '&nopaging=true';
	  }

	  //get page details
	  if ($paged) {
	    //figure out perpage
	    if (intval($per_page)) {
	      $paginate_query = '&posts_per_page='.intval($per_page);
	    } else {
	      $paginate_query = '&posts_per_page='.$mp->get_setting('per_page');
			}

	    //figure out page
	    if (isset($wp_query->query_vars['paged']) && $wp_query->query_vars['paged'])
	      $paginate_query .= '&paged='.intval($wp_query->query_vars['paged']);

	    if (intval($page))
	      $paginate_query .= '&paged='.intval($page);
	    else if ($wp_query->query_vars['paged'])
	      $paginate_query .= '&paged='.intval($wp_query->query_vars['paged']);
	  }

	  //get order by
	  if (!$order_by) {
	    if ($mp->get_setting('order_by') == 'price')
	      $order_by_query = '&meta_key=mp_price_sort&orderby=meta_value_num';
	    else if ($mp->get_setting('order_by') == 'sales')
	      $order_by_query = '&meta_key=mp_sales_count&orderby=meta_value_num';
	    else
	      $order_by_query = '&orderby='.$mp->get_setting('order_by');
	  } else {
	  	if ('price' == $order_by)
	  		$order_by_query = '&meta_key=mp_price_sort&orderby=meta_value_num';
	    else if('sales' == $order_by)
	      $order_by_query = '&meta_key=mp_sales_count&orderby=meta_value_num';
	    else
	    	$order_by_query = '&orderby='.$order_by;
	  }

	  //get order direction
	  if (!$order) {
	    $order_query = '&order='.$mp->get_setting('order');
	  } else {
	    $order_query = '&order='.$order;
	  }

	  //The Query
	  $the_query = new WP_Query('post_type=product&post_status=publish' . $taxonomy_query . $paginate_query . $order_by_query . $order_query);

	  $output = '<div class="row-fluid">';

	  $count = 1;

	  if ($the_query->have_posts()) : while ($the_query->have_posts()) : $the_query->the_post();

	  	$id = get_the_ID();

		$output .= flexmarket_load_single_product_in_box( $span , $id , 'tb-360' , $btnclass , $iconclass , $tagcolor , $boxclass , $boxstyle , false);
		
		if ($count == $counter) {
			
			$count = 0;
			$output .= '</div>';
			$output .= '<div class="clear padding20"></div>';
			$output .= '<div class="row-fluid">';
		}

		$count++;

	  endwhile; endif;

	  $output .= '</div>';

	  // load pagination
	  if ($paged) {

	  	  $output .= '<div class="clear"></div>';
		  $output .= '<div class="pull-right">';

		    $total_pages = $the_query->max_num_pages;  

		    if ($total_pages > 1){ 

		      $current_page = max(1, get_query_var('paged')); 

		       $output .= '<div class="pagination">';
		       $output .= paginate_links(array(  
		          'base' => get_pagenum_link(1) . '%_%',  
		          'format' => 'page/%#%',  
		          'current' => $current_page,  
		          'total' => $total_pages,  
		          'type'  => 'list'
		        ));  
		       $output .= '</div>';
		    }

		  $output .= '</div>';

	  }

	  $output .= wp_reset_query();
	  $output .= '<div class="clear padding20"></div>';


  	if ($echo)
    	echo $output;
  	else
    	return $output;

}

function flexmarket_load_single_product_in_box( $span = 'span4' , $post_id = NULL , $imagesize = 'tb-360' , $btnclass = '' , $iconclass = '' , $tagcolor = '' , $class = '' , $style = '' , $echo = true ) {

	if (is_multisite()) {
		$blog_id = get_current_blog_id();
	} else {
		$blog_id = 1;
	}

	if ($class == 'thetermsclass') {
		$class = '';
	  	$terms = get_the_terms( $post_id, 'product_category' );
		if (!empty($terms)) {
			foreach ($terms as $thesingleterm) {
				$class .= ' '.$thesingleterm->slug;
			}
		}
	}

	switch ($span) {
		case 'span6':
			$maxwidth = '560';
			$imagesize = 'tb-860';
			$btnsize = '';
			break;
		case 'span3':
			$maxwidth = '360';
			$btnsize = ' btn-small';
			break;
		case 'span4':
			$maxwidth = '360';
			$btnsize = '';
			break;
	}

	$output = '';

	$output .= '<div class="'.$span.' well well-small'.$class.'"'.$style.'>';

	if (has_post_thumbnail( $post_id ) ) {

		$fullimage = wp_get_attachment_image_src( get_post_thumbnail_id($post_id), 'full');

		$output = apply_filters('flexmarket_product_box_before_image' , $output , $post_id , $blog_id );
		$output .= '<div class="image-box" style="max-width: '.$maxwidth.'px;">';
		$output .= get_the_post_thumbnail($post_id , $imagesize); 
			$output .= '<div class="hover-block hidden-phone">';
					$output .= '<div class="btn-group">';
						$button = '<a href="'.get_permalink($post_id).'" class="btn'.$btnclass.'">'.get_the_title($post_id).'</a>';
						$button .= '<a href="'.$fullimage[0].'" rel="prettyPhoto[mp-product-'.$post_id.'" class="btn'.$btnclass.'"><i class="icon-zoom-in'.$iconclass.'"></i></a>';
						$output .= apply_filters( 'flexmarket_product_box_btn_group' , $button , $post_id , $blog_id , $btnclass , $iconclass , $fullimage[0] );
					$output .= '</div>';
			$output .= '</div>';
		$output .= '</div>';
		$output = apply_filters('flexmarket_product_box_after_image' , $output , $post_id , $blog_id );
	}

	$output .= '<div class="clear padding5"></div>';

		$output .= '<div class="hidden-phone">';
			$output .= '<div class="product-meta row-fluid">';
				$output .= '<div class="span6">';
				$output .= '<p>';
				$output .= ($span == 'span3' ? '<small>' : '');
				$output .= flexmarket_product_price(false, $post_id, '' , $tagcolor);
				$output .= ($span == 'span3' ? '</small>' : '');
				$output .= '</p>';
				$output .= '</div>';
				$output .= '<div class="span6 atc">';
				$output .= flexmarket_buy_button(false, 'list', $post_id, $btnclass.$btnsize , $iconclass);
				$output .= '</div>';
			$output .= '</div>';
		$output .= '</div>';

		$output .= '<div class="visible-phone align-center">';

			$output .= '<p>';
			$output .= apply_filters( 'flexmarket_product_box_title_mobile' , get_the_title($post_id) . '<br />' , $post_id , $blog_id );
			$output .= flexmarket_product_price(false, $post_id, '' , $tagcolor);
			$output .= '</p>';
			$output .= flexmarket_buy_button(false, 'list', $post_id, $btnclass, $iconclass);

		$output .= '</div>';	

	$output .= '</div>';

  	if ($echo)
    	echo $output;
  	else
    	return $output;
	
}


/*
 * Displays the buy or add to cart button
 *
 * @param bool $echo Optional, whether to echo
 * @param string $context Options are list or single
 * @param int $post_id The post_id for the product. Optional if in the loop
 */
function flexmarket_buy_button( $echo = true, $context = 'list', $post_id = NULL , $btnclass = '') {
  global $id, $mp;
  $post_id = ( NULL === $post_id ) ? $id : $post_id;

  $meta = get_post_custom($post_id);
  //unserialize
  foreach ($meta as $key => $val) {
	  $meta[$key] = maybe_unserialize($val[0]);
	  if (!is_array($meta[$key]) && $key != "mp_is_sale" && $key != "mp_track_inventory" && $key != "mp_product_link" && $key != "mp_file")
	    $meta[$key] = array($meta[$key]);
	}

  //check stock
  $no_inventory = array();
  $all_out = false;
  if ($meta['mp_track_inventory']) {
    $cart = $mp->get_cart_contents();
    if (isset($cart[$post_id]) && is_array($cart[$post_id])) {
	    foreach ($cart[$post_id] as $variation => $data) {
	      if ($meta['mp_inventory'][$variation] <= $data['quantity'])
	        $no_inventory[] = $variation;
			}
			foreach ($meta['mp_inventory'] as $key => $stock) {
	      if (!in_array($key, $no_inventory) && $stock <= 0)
	        $no_inventory[] = $key;
			}
		}

		//find out of stock items that aren't in the cart
		foreach ($meta['mp_inventory'] as $key => $stock) {
      if (!in_array($key, $no_inventory) && $stock <= 0)
        $no_inventory[] = $key;
		}

		if (count($no_inventory) >= count($meta["mp_price"]))
		  $all_out = true;
  }

  //display an external link or form button
  if (isset($meta['mp_product_link']) && $product_link = $meta['mp_product_link']) {

    $button = '<a class="mp_link_buynow btn'.$btnclass.'" href="' . esc_url($product_link) . '">' . __('Buy Now', 'flexmarket') . '</a>';

  } else if ($mp->get_setting('disable_cart')) {
    
    $button = '';
    
  } else {
    $variation_select = '';
    $button = '<form class="mp_buy_form'.($context == 'list' ? '' : ' form-inline').'" method="post" action="' . mp_cart_link(false, true) . '">';

    if ($all_out) {
      $button .= '<span class="mp_no_stock btn disabled'.$btnclass.'">' . __('Out of Stock', 'flexmarket') . '</span>';
    } else {

	    $button .= '<input type="hidden" name="product_id" value="' . $post_id . '" />';

			//create select list if more than one variation
		  if (is_array($meta["mp_price"]) && count($meta["mp_price"]) > 1 && empty($meta["mp_file"])) {
	      $variation_select = '<select class="mp_product_variations" name="variation">';
				foreach ($meta["mp_price"] as $key => $value) {
				  $disabled = (in_array($key, $no_inventory)) ? ' disabled="disabled"' : '';
				  $variation_select .= '<option value="' . $key . '"' . $disabled . '>' . esc_html($meta["mp_var_name"][$key]) . ' - ';
					if ($meta["mp_is_sale"] && $meta["mp_sale_price"][$key]) {
		        $variation_select .= $mp->format_currency('', $meta["mp_sale_price"][$key]);
		      } else {
		        $variation_select .= $mp->format_currency('', $value);
		      }
		      $variation_select .= "</option>\n";
		    }
	      $variation_select .= "</select>&nbsp;\n";
	 		} else {
	      $button .= '<input type="hidden" name="variation" value="0" />';
			}

	    if ($context == 'list') {
	      if ($variation_select) {
        	$button .= '<a class="mp_link_buynow" href="' . get_permalink($post_id) . '"><span class="btn'.$btnclass.'">' . __('Choose Option', 'flexmarket') . '</span></a>';
	      } else if ($mp->get_setting('list_button_type') == 'addcart') {
	        $button .= '<input type="hidden" name="action" value="mp-update-cart" />';
	        $button .= '<input class="mp_button_addcart btn'.$btnclass.'" type="submit" name="addcart" value="' . __('Add To Cart', 'flexmarket') . '" />';
	      } else if ($mp->get_setting('list_button_type') == 'buynow') {
	        $button .= '<input class="mp_button_buynow btn'.$btnclass.'" type="submit" name="buynow" value="' . __('Buy Now', 'flexmarket') . '" />';
	      }
	    } else {

	      $button .= $variation_select;

	      //add quantity field if not downloadable
	      if ($mp->get_setting('show_quantity') && empty($meta["mp_file"])) {
	        $button .= '<span class="mp_quantity"><label>' . __('Quantity:', 'flexmarket') . ' <input class="mp_quantity_field input-mini" type="text" name="quantity" value="1" /></label></span>&nbsp;';
	      }

	      if ($mp->get_setting('product_button_type') == 'addcart') {
	        $button .= '<input type="hidden" name="action" value="mp-update-cart" />';
	        $button .= '<input class="mp_button_addcart btn'.$btnclass.'" type="submit" name="addcart" value="' . __('Add To Cart', 'flexmarket') . '" />';
	      } else if ($mp->get_setting('product_button_type') == 'buynow') {
	        $button .= '<input class="mp_button_buynow btn'.$btnclass.'" type="submit" name="buynow" value="' . __('Buy Now', 'flexmarket') . '" />';
	      }
	    }

    }

    $button .= '</form>';
  }

  $button = apply_filters( 'flexmarket_buy_button_tag', $button, $post_id, $context, $btnclass );

  if ($echo)
    echo $button;
  else
    return $button;
}


/*
 * Displays the product price (and sale price)
 *
 * @param bool $echo Optional, whether to echo
 * @param int $post_id The post_id for the product. Optional if in the loop
 * @param sting $label A label to prepend to the price. Defaults to "Price: "
 */
function flexmarket_product_price( $echo = true, $post_id = NULL, $label = true , $iconclass = '' , $context = '' ) {
  global $id, $mp;
  $post_id = ( NULL === $post_id ) ? $id : $post_id;

  $label = ($label === true) ? __('Price: ', 'flexmarket') : $label;

	$meta = get_post_custom($post_id);
  //unserialize
  foreach ($meta as $key => $val) {
	  $meta[$key] = maybe_unserialize($val[0]);
	  if (!is_array($meta[$key]) && $key != "mp_is_sale" && $key != "mp_track_inventory" && $key != "mp_product_link" && $key != "mp_file" && $key != "mp_price_sort")
	    $meta[$key] = array($meta[$key]);
	}

  if ((is_array($meta["mp_price"]) && count($meta["mp_price"]) == 1) || !empty($meta["mp_file"])) {
    if ($meta["mp_is_sale"]) {
	    $price = '<span class="mp_special_price"><del class="mp_old_price">'.$mp->format_currency('', $meta["mp_price"][0]).'</del> ';
	    $price .= '<span itemprop="price" class="mp_current_price">'.$mp->format_currency('', $meta["mp_sale_price"][0]).'</span></span>';
	  } else {
	    $price = '<span itemprop="price" class="mp_normal_price"><span class="mp_current_price">'.$mp->format_currency('', $meta["mp_price"][0]).'</span></span>';
	  }
	} else if (is_array($meta["mp_price"]) && count($meta["mp_price"]) > 1 && !is_singular('product')) { //only show from price in lists
	    if ($meta["mp_is_sale"]) {
	        //do some crazy stuff here to get the lowest price pair ordered by sale prices
	      	asort($meta["mp_sale_price"], SORT_NUMERIC);
	      	$lowest = array_slice($meta["mp_sale_price"], 0, 1, true);
	      	$keys = array_keys($lowest);
	      	$mp_price = $meta["mp_price"][$keys[0]];
	     	$mp_sale_price = array_pop($lowest);
		    $price = __('from', 'mp').' <span class="mp_special_price"><del class="mp_old_price">'.$mp->format_currency('', $mp_price).'</del>';
		    $price .= '<span itemprop="price" class="mp_current_price">'.$mp->format_currency('', $mp_sale_price).'</span></span>';
		  } else {
	      	sort($meta["mp_price"], SORT_NUMERIC);
		    $price = __('from', 'mp').' <span itemprop="price" class="mp_normal_price"><span class="mp_current_price">'.$mp->format_currency('', $meta["mp_price"][0]).'</span></span>';
		  }
	} else {
		if ($context == 'widget') {
		    if ($meta["mp_is_sale"]) {
		        //do some crazy stuff here to get the lowest price pair ordered by sale prices
		      	asort($meta["mp_sale_price"], SORT_NUMERIC);
		      	$lowest = array_slice($meta["mp_sale_price"], 0, 1, true);
		      	$keys = array_keys($lowest);
		      	$mp_price = $meta["mp_price"][$keys[0]];
		     	$mp_sale_price = array_pop($lowest);
			    $price = __('from', 'mp').' <span class="mp_special_price"><del class="mp_old_price">'.$mp->format_currency('', $mp_price).'</del>';
			    $price .= '<span itemprop="price" class="mp_current_price">'.$mp->format_currency('', $mp_sale_price).'</span></span>';
			  } else {
		      	sort($meta["mp_price"], SORT_NUMERIC);
			    $price = __('from', 'mp').' <span itemprop="price" class="mp_normal_price"><span class="mp_current_price">'.$mp->format_currency('', $meta["mp_price"][0]).'</span></span>';
			  }
		} else {
			return '';
		}
	}

  $price = apply_filters( 'flexmarket_product_price_tag', '<i class="icon-tags'.$iconclass.'"></i> ' . $label . $price, $post_id, $label, $iconclass , $context );

  if ($echo)
    echo $price;
  else
    return $price;
}


/**
 * Echos the current shopping cart contents. Use in the cart template.
 *
 * @param string $context Optional. Possible values: widget, checkout
 * @param string $checkoutstep Optional. Possible values: checkout-edit, shipping, checkout, confirm-checkout, confirmation
 * @param bool $echo Optional. default true
 */
function flexmarket_show_cart($context = '', $checkoutstep = null, $echo = true , $btnclass = '') {
  global $mp, $blog_id;
  $content = '';

  if ( $checkoutstep == null )
    $checkoutstep = get_query_var( 'checkoutstep' );

  if ( mp_items_in_cart() || $checkoutstep == 'confirmation') {

    // type = widget

    if ($context == 'widget') {
      $content .= _flexmarket_cart_table('widget' , false , $btnclass);
      $content .= '<div class="mp_cart_actions_widget">';
      $content .= '<a class="mp_empty_cart" href="'.mp_cart_link(false, true).'?empty-cart=1" title="'.__('Empty your shopping cart', 'flexmarket').'">'.__('Empty Cart', 'flexmarket').'</a>';
      $content .= '<a class="mp_checkout_link" href="'.mp_cart_link(false, true).'" title="'.__('Go To Checkout Page', 'flexmarket').'">'.__('Checkout &raquo;', 'flexmarket').'</a>';
      $content .= '<div class="clear"></div>';
      $content .= '</div>';
    } 

    // type = checkout 

    else if ($context == 'checkout') {

      //generic error message context for plugins to hook into
      $content .= apply_filters( 'mp_checkout_error_checkout', '' );

      if( $mp->get_setting('show_purchase_breadcrumbs') == 1 ){
        $content .= flexmarket_cart_breadcrumbs($checkoutstep);
      }

      //handle checkout steps
      switch($checkoutstep) {

        case 'shipping':
          $content .= do_shortcode($mp->get_setting('msg->shipping'));
          $content .= _flexmarket_cart_shipping(true , false , $btnclass);
          break;

        case 'checkout':
          $content .=  do_shortcode($mp->get_setting('msg->checkout'));
          $content .= _flexmarket_cart_payment('form' , false , $btnclass);
          break;

        case 'confirm-checkout':
          $content .=  do_shortcode($mp->get_setting('msg->confirm_checkout'));
          $content .= _flexmarket_cart_table('checkout' , false , $btnclass);
          $content .= _flexmarket_cart_shipping(false , false , $btnclass);
          $content .= _flexmarket_cart_payment('confirm' , false , $btnclass);
          break;

        case 'confirmation':
          $content .=  do_shortcode($mp->get_setting('msg->success'));
          $content .= _flexmarket_cart_payment('confirmation' , false , $btnclass);
          break;

        default:
          $content .= do_shortcode($mp->get_setting('msg->cart'));
          $content .= _flexmarket_cart_table('checkout-edit' , false , $btnclass);
          $content .= '<div class="clear padding20"></div>';
          $content .= _flexmarket_cart_login(false , $btnclass);
          break;
      }

    } else {
      $content .= _flexmarket_cart_table('checkout' , false , $btnclass);
      $content .= '<div class="mp_cart_actions">';
      $content .= '<a class="mp_empty_cart btn'.$btnclass.'" href="'.mp_cart_link(false, true).'?empty-cart=1" title="'.__('Empty your shopping cart', 'flexmarket').'">'.__('Empty Cart', 'flexmarket').'</a>';
			$content .= '<a class="mp_checkout_link btn'.$btnclass.'" href="'.mp_cart_link(false, true).'" title="'.__('Go To Checkout Page', 'flexmarket').'">'.__('Checkout &raquo;', 'flexmarket').'</a>';
      $content .= '</div>';
    }
  } else {
    if ($context != 'widget')
      $content .= do_shortcode($mp->get_setting('msg->cart'));
      
    $content .= '<div class="mp_cart_empty"><p>'.__('There are no items in your cart.', 'flexmarket').'</p></div>';
    $content .= '<div id="mp_cart_actions_widget"><a class="mp_store_link btn'.$btnclass.'" href="'.mp_products_link(false, true).'">'.__('Browse Products &raquo;', 'flexmarket').'</a></div>';
  }

  if ($echo) {
    echo $content;
  } else {
    return $content;
  }
}

/**
 * @return string HTML that shows the user their current position in the purchase process.
 */
function flexmarket_cart_breadcrumbs($current_step){	
	$steps = array(
		'checkout-edit'=>__('Review Cart','flexmarket'),
		'shipping'=>__('Shipping','flexmarket'),
		'checkout'=>__('Checkout','flexmarket'),
		'confirm-checkout'=>__('Confirm','flexmarket'),
		'confirmation'=>__('Thankyou','flexmarket')
	);

	$order = array_keys($steps);
	$current = array_search($current_step, $order);
	$all = array();

	foreach($steps as $str => $human){
		$i = array_search($str, $order);

		if($i >= $current){
			// incomplete
			$all[] = '<li class="'.($i==$current?'active':'').'">'.($i==$current?'<span class="label label-current">':'').$human.($i==$current?'</span>':'');
		}else{
			// done
			$all[] = '<li><a href="'.mp_checkout_step_url($str).'">'.$human.'</a>';
		}
	}
	
	return '<ul class="breadcrumb cart-breadcrumbs">'.implode(apply_filters('mp_cart_breadcrumbs_seperator', ' <span class="divider">&raquo;</span></li>'), $all).'</li></ul>';
}

//Prints cart table, for internal use

function _flexmarket_cart_table($type = 'checkout', $echo = false , $btnclass='') {
  global $mp, $blog_id;
  $blog_id = (is_multisite()) ? $blog_id : 1;
  $current_blog_id = $blog_id;

	$global_cart = $mp->get_cart_contents(true);
  if (!$mp->global_cart)  //get subset if needed
  	$selected_cart[$blog_id] = $global_cart[$blog_id];
  else
    $selected_cart = $global_cart;

  $content = '';

  // type = checkout-edit 

	  if ($type == 'checkout-edit') {
	    $content .= apply_filters( 'mp_cart_updated_msg', '' );

	    $content .= '<form id="mp_cart_form" method="post" action="">';
	    $content .= '<table class="mp_cart_contents table table-bordered table-striped table-hover"><thead><tr>';
	    $content .= '<th class="mp_cart_col_product" colspan="2">'.__('Item:', 'flexmarket').'</th>';
	    $content .= '<th class="mp_cart_col_price">'.__('Price:', 'flexmarket').'</th>';
	    $content .= '<th class="mp_cart_col_quant">'.__('Quantity:', 'flexmarket').'</th></tr></thead><tbody>';

	    $totals = array();
	    $shipping_prices = array();
	    $shipping_tax_prices = array();
	    $tax_prices = array();
	    foreach ($selected_cart as $bid => $cart) {

				if (is_multisite())
	        switch_to_blog($bid);

	      foreach ($cart as $product_id => $variations) {
	        foreach ($variations as $variation => $data) {
	          $totals[] = $mp->before_tax_price($data['price'], $product_id) * $data['quantity'];

	          $content .=  '<tr>';
	          $content .=  '  <td class="mp_cart_col_thumb span1">' . mp_product_image( false, 'widget', $product_id, 50 ) . '</td>';
	          $content .=  '  <td class="mp_cart_col_product_table span9"><a href="' . apply_filters('mp_product_url_display_in_cart', $data['url'], $product_id) . '">' . apply_filters('mp_product_name_display_in_cart', $data['name'], $product_id) . '</a>' . '</td>'; // Added WPML
	          $content .=  '  <td class="mp_cart_col_price">' . $mp->format_currency('', $data['price'] * $data['quantity']) . '</td>';
	          $content .=  '  <td class="mp_cart_col_quant"><input type="text" class="input-mini" name="quant[' . $bid . ':' . $product_id . ':' . $variation . ']" value="' . $data['quantity'] . '" /><label><input type="checkbox" name="remove[]" value="' . $bid . ':' . $product_id . ':' . $variation . '" /> <small>' . __('Remove', 'flexmarket') . '</small></label></td>';
	          $content .=  '</tr>';
	        }
	      }

	      if ( ($shipping_price = $mp->shipping_price()) !== false )
	        $shipping_prices[] = $shipping_price;

	      if ( ($shipping_tax_price = $mp->shipping_tax_price($shipping_price)) !== false )
	        $shipping_tax_prices[] = $shipping_tax_price;
	        
	      if ( ($tax_price = $mp->tax_price()) !== false )
	        $tax_prices[] = $tax_price;
	    }
	    //go back to original blog
	    if (is_multisite())
	      switch_to_blog($current_blog_id);

	    $total = array_sum($totals);

	    //coupon line TODO - figure out how to apply them on global checkout
		  $coupon_code = $mp->get_coupon_code();
	    if ( $coupon = $mp->coupon_value($coupon_code, $total) ) {
	      $content .=  '<tr>';
	      $content .=  '  <td class="mp_cart_subtotal_lbl align-right" colspan="2">' . __('Subtotal:', 'flexmarket') . '</td>';
	      $content .=  '  <td class="mp_cart_col_subtotal">' . $mp->format_currency('', $total) . '</td>';
	      $content .=  '  <td>&nbsp;</td>';
	      $content .=  '</tr>';
	      $content .=  '<tr>';
	      $content .=  '  <td class="mp_cart_subtotal_lbl align-right" colspan="2">' . __('Discount:', 'flexmarket') . '</td>';
	      $content .=  '  <td class="mp_cart_col_discount">' . $coupon['discount'] . '</td>';
	      $content .=  '  <td class="mp_cart_remove_coupon"><a href="?remove_coupon=1" class="btn btn-mini'.$btnclass.'">' . __('Remove Coupon &raquo;', 'flexmarket') . '</a></td>';
	      $content .=  '</tr>';
	      $total = $coupon['new_total'];
	    } else {
	      $content .=  '<tr>';
	      $content .=  '  <td class="mp_cart_subtotal_lbl" colspan="4">
	            <a id="coupon-link" class="alignright btn'.$btnclass.'" href="#coupon-code">' . __('Have a coupon code?', 'flexmarket') . '</a>
	            <div id="coupon-code" class="alignright" style="display: none;">
	              <label for="coupon_code">' . __('Enter your code:', 'flexmarket') . '</label>
	              <input type="text" name="coupon_code" id="coupon_code" /><br />
	              <input type="submit" class="btn'.$btnclass.' pull-right" name="update_cart_submit" value="' . __('Apply Code &raquo;', 'flexmarket') . '" />
	            </div>
	        </td>';
	      $content .=  '</tr>';
	    }

	    //shipping line
	    if ( $shipping_price = array_sum($shipping_prices) ) {
	      $shipping_tax_price = array_sum($shipping_tax_prices);
	      if (!$mp->global_cart && apply_filters( 'mp_shipping_method_lbl', '' ))
	        $shipping_method = apply_filters( 'mp_shipping_method_lbl', '' );
	      else
	        $shipping_method = '';
	      $content .=  '<tr>';
	      $content .=  '  <td class="mp_cart_subtotal_lbl align-right" colspan="2">' . __('Shipping:', 'flexmarket') . '</td>';
	      $content .=  '  <td class="mp_cart_col_shipping">' . $mp->format_currency('', $shipping_tax_price) . '</td>';
	      $content .=  '  <td>' . $shipping_method . '</td>';
	      $content .=  '</tr>';
	      $total = $total + $shipping_price;
	    }

	    //tax line
	    if ( $tax_price = array_sum($tax_prices) ) {
	      $content .=  '<tr>';
	      $content .=  '  <td class="mp_cart_subtotal_lbl align-right" colspan="2">' . __('Taxes:', 'flexmarket') . '</td>';
	      $content .=  '  <td class="mp_cart_col_tax">' . $mp->format_currency('', $tax_price) . '</td>';
	      $content .=  '  <td>&nbsp;</td>';
	      $content .=  '</tr>';
	      $total = $total + $tax_price;
	    }

	    $content .=  '</tbody><tfoot><tr>';
	    $content .=  '  <td class="mp_cart_subtotal_lbl align-right" colspan="2">' . __('Cart Total:', 'flexmarket') . '</td>';
	    $content .=  '  <td class="mp_cart_col_total">' . $mp->format_currency('', $total) . '</td>';
	    $content .=  '  <td class="mp_cart_col_updatecart"><input class="btn'.$btnclass.'" type="submit" name="update_cart_submit" value="' . __('Update Cart &raquo;', 'flexmarket') . '" /></td>';
	    $content .=  '</tr></tfoot>';

	    $content .= '</table></form>';

	  } 

	// type = checkout 

	  else if ($type == 'checkout') {

	    $content .= '<table class="mp_cart_contents table table-bordered table-striped table-hover"><thead><tr>';
	    $content .= '<th class="mp_cart_col_product" colspan="2">'.__('Item:', 'flexmarket').'</th>';
	    $content .= '<th class="mp_cart_col_quant">'.__('Qty:', 'flexmarket').'</th>';
	    $content .= '<th class="mp_cart_col_price">'.__('Price:', 'flexmarket').'</th></tr></thead><tbody>';

	    $totals = array();
	    $shipping_prices = array();
	    $shipping_tax_prices = array();
	    $tax_prices = array();
	    foreach ($selected_cart as $bid => $cart) {

				if (is_multisite())
	        switch_to_blog($bid);

	      foreach ($cart as $product_id => $variations) {
	        foreach ($variations as $variation => $data) {
	          $totals[] = $mp->before_tax_price($data['price'], $product_id) * $data['quantity'];

	          $content .=  '<tr>';
	          $content .=  '  <td class="mp_cart_col_thumb span2">' . mp_product_image( false, 'widget', $product_id, 75 ) . '</td>';
	          $content .=  '  <td class="mp_cart_col_product_table"><a href="' . apply_filters('mp_product_url_display_in_cart', $data['url'], $product_id) . '">' . apply_filters('mp_product_name_display_in_cart', $data['name'], $product_id) . '</a>';

	          // FPM: Output product custom field information
	          $cf_key = $bid .':'. $product_id .':'. $variation;
	          if (isset($_SESSION['mp_shipping_info']['mp_custom_fields'][$cf_key])) {
	            $cf_item = $_SESSION['mp_shipping_info']['mp_custom_fields'][$cf_key];
	    
	            $mp_custom_field_label 		= get_post_meta($product_id, 'mp_custom_field_label', true);
	            if (isset($mp_custom_field_label[$variation]))
	              $label_text = $mp_custom_field_label[$variation];
	            else
	              $label_text = __('Product Extra Fields:', 'flexmarket');
	            
	            $content .=  '<div class="mp_cart_custom_fields"><i class="icon-pencil opacity5"></i> '. $label_text .'<br /><ol>';
	            foreach($cf_item as $item) {
	              $content .=  '<li>'.(!empty($item) ? '<i class="icon-minus opacity5"></i> ' : ''). $item .'</li>';
	            }
	            $content .=  '</ol></div>';
	          }
	          $content .=  '</td>'; // Added WPML

	          $content .=  '  <td class="mp_cart_col_quant">' . number_format_i18n($data['quantity']) . '</td>';
	          $content .=  '  <td class="mp_cart_col_price">' . $mp->format_currency('', $data['price'] * $data['quantity']) . '</td>';
	          $content .=  '</tr>';
	        }
	      }

	      if ( ($shipping_price = $mp->shipping_price()) !== false )
	        $shipping_prices[] = $shipping_price;
	      
	      if ( ($shipping_tax_price = $mp->shipping_tax_price($shipping_price)) !== false )
	        $shipping_tax_prices[] = $shipping_tax_price; 

	      if ( ($tax_price = $mp->tax_price()) !== false )
	        $tax_prices[] = $tax_price;
	    }
	    //go back to original blog
	    if (is_multisite())
	      switch_to_blog($current_blog_id);

	    $total = array_sum($totals);

	    //coupon line TODO - figure out how to apply them on global checkout
		  $coupon_code = $mp->get_coupon_code();
	    if ( $coupon = $mp->coupon_value($coupon_code, $total) ) {
	      $content .=  '<tr>';
	      $content .=  '  <td class="mp_cart_subtotal_lbl align-right" colspan="3">' . __('Subtotal:', 'flexmarket') . '</td>';
	      $content .=  '  <td class="mp_cart_col_subtotal">' . $mp->format_currency('', $total) . '</td>';
	      $content .=  '</tr>';
	      $content .=  '<tr>';
	      $content .=  '  <td class="mp_cart_subtotal_lbl align-right" colspan="3">' . __('Discount:', 'flexmarket') . '</td>';
	      $content .=  '  <td class="mp_cart_col_discount">' . $coupon['discount'] . '</td>';
	      $content .=  '</tr>';
	      $total = $coupon['new_total'];
	    }

	    //shipping line
	    if ( $shipping_price = array_sum($shipping_prices) ) {
	      $shipping_tax_price = array_sum($shipping_tax_prices);
	      if (!$mp->global_cart && apply_filters( 'mp_shipping_method_lbl', '' ))
	        $shipping_method = ' (' . apply_filters( 'mp_shipping_method_lbl', '' ) . ')';
	      else
	        $shipping_method = '';
	      $content .=  '<tr>';
	      $content .=  '  <td class="mp_cart_subtotal_lbl align-right" colspan="3">' . __('Shipping:', 'flexmarket') . $shipping_method . '</td>';
	      $content .=  '  <td class="mp_cart_col_shipping">' . $mp->format_currency('', $shipping_tax_price) . '</td>';
	      $content .=  '</tr>';
	      $total = $total + $shipping_price;
	    }

	    //tax line
	    if ( $tax_price = array_sum($tax_prices) ) {
	      $content .=  '<tr>';
	      $content .=  '  <td class="mp_cart_subtotal_lbl align-right" colspan="3">' . __('Taxes:', 'flexmarket') . '</td>';
	      $content .=  '  <td class="mp_cart_col_tax">' . $mp->format_currency('', $tax_price) . '</td>';
	      $content .=  '</tr>';
	      $total = $total + $tax_price;
	    }

	    $content .=  '<tr>';
	    $content .=  '  <td class="mp_cart_subtotal_lbl align-right" colspan="3">' . __('Cart Total:', 'flexmarket') . '</td>';
	    $content .=  '  <td class="mp_cart_col_total">' . $mp->format_currency('', $total) . '</td>';
	    $content .=  '</tr>';

	    $content .= '</tbody></table>';

	  } 

  // type = widget

	  else if ($type == 'widget') {

	    $content .= '<table class="mp_cart_contents_widget table table-hover"><thead><tr>';
	    $content .= '<th class="mp_cart_col_product" colspan="2">'.__('Item:', 'flexmarket').'</th>';
	    $content .= '<th class="mp_cart_col_quant">'.__('Qty:', 'flexmarket').'</th>';
	    $content .= '<th class="mp_cart_col_price">'.__('Price:', 'flexmarket').'</th></tr></thead><tbody>';

	    $totals = array();
	    foreach ($selected_cart as $bid => $cart) {

				if (is_multisite())
	        switch_to_blog($bid);

	      foreach ($cart as $product_id => $variations) {
	        foreach ($variations as $variation => $data) {
	          $totals[] = $data['price'] * $data['quantity'];
	          $content .=  '<tr>';
	          $content .=  '  <td class="mp_cart_col_thumb span1">' . mp_product_image( false, 'widget', $product_id, 25 ) . '</td>';
	          $content .=  '  <td class="mp_cart_col_product_table span9"><a href="' . apply_filters('mp_product_url_display_in_cart', $data['url'], $product_id) . '">' . apply_filters('mp_product_name_display_in_cart', $data['name'], $product_id) . '</a>' . '</td>'; // Added WPML
	          $content .=  '  <td class="mp_cart_col_quant">' . number_format_i18n($data['quantity']) . '</td>';
	          $content .=  '  <td class="mp_cart_col_price">' . $mp->format_currency('', $data['price'] * $data['quantity']) . '</td>';
	          $content .=  '</tr>';
	        }
	      }
	    }

			if (is_multisite())
	      switch_to_blog($current_blog_id);

	    $total = array_sum($totals);

	    $content .=  '<tr>';
	    $content .=  '  <td class="mp_cart_subtotal_lbl" colspan="3">' . __('Subtotal:', 'flexmarket') . '</td>';
	    $content .=  '  <td class="mp_cart_col_total">' . $mp->format_currency('', $total) . '</td>';
	    $content .=  '</tr>';

	    $content .= '</tbody></table>';
	  }



  if ($echo) {
    echo $content;
  } else {
    return $content;
  }

}

//Prints cart payment gateway form, for internal use
function _flexmarket_cart_payment($type, $echo = false , $btnclass = '') {
  global $mp, $blog_id, $mp_gateway_active_plugins;
  $blog_id = (is_multisite()) ? $blog_id : 1;

	$cart = $mp->get_cart_contents($mp->global_cart);

  $content = '';
  if ($type == 'form') {
    $content = '<form id="mp_payment_form" method="post" action="'.mp_checkout_step_url('checkout').'">';
    if (count((array)$mp_gateway_active_plugins) == 1) {
      $content .= '<input type="hidden" name="mp_choose_gateway" value="'.$mp_gateway_active_plugins[0]->plugin_name.'" />';
    } else if (count((array)$mp_gateway_active_plugins) > 1) {
      $content .= '<table class="mp_cart_payment_methods table table-striped table-bordered table-hover">';
      $content .= '<thead><tr>';
      $content .= '<th>'.__('Choose a Payment Method:', 'flexmarket').'</th>';
      $content .= '</tr></thead>';
      $content .= '<tbody><tr><td>';
      foreach ((array)$mp_gateway_active_plugins as $plugin) {
        $content .= '<label>';
        $content .= '<input type="radio" class="mp_choose_gateway" name="mp_choose_gateway" value="'.$plugin->plugin_name.'" '.checked($_SESSION['mp_payment_method'], $plugin->plugin_name, false).' />';
        if ($plugin->method_img_url) {
          $content .= '<img src="' . $plugin->method_img_url . '" alt="' . $plugin->public_name . '" style="padding: 10px;" />';
        }
        $content .= $plugin->public_name;
        $content .= '</label>';
      }
      $content .= '</td>';
      $content .= '</tr>';
      $content .= '</tbody>';
      $content .= '</table>';
    }

    $content .= apply_filters( 'mp_checkout_payment_form', '', $cart, $_SESSION['mp_shipping_info'] );

    $content .= '</form>';

  } else if ($type == 'confirm') {

    //if skipping a step
    if (empty($_SESSION['mp_payment_method'])) {
      $content .= '<div class="mp_checkout_error">' . sprintf(__('Whoops, looks like you skipped a step! Please <a href="%s">go back and try again</a>.', 'flexmarket'), mp_checkout_step_url('checkout')) . '</div>';
      return $content;
    }
    $content .= '<form id="mp_payment_form" method="post" action="'.mp_checkout_step_url('confirm-checkout').'">';

    $content .= apply_filters( 'mp_checkout_confirm_payment_' . $_SESSION['mp_payment_method'], $cart, $_SESSION['mp_shipping_info'] );

    $content .= '<p class="mp_cart_direct_checkout align-right">';
    $content .= '<input type="submit" class="btn btn-large'.$btnclass.'" name="mp_payment_confirm" id="mp_payment_confirm" value="'.__('Confirm Payment &raquo;', 'flexmarket').'" />';
    $content .= '</p>';
    $content .= '</form>';

  } else if ($type == 'confirmation') {

    //if skipping a step
    if (empty($_SESSION['mp_payment_method'])) {
      //$content .= '<div class="mp_checkout_error">' . sprintf(__('Whoops, looks like you skipped a step! Please <a href="%s">go back and try again</a>.', 'flexmarket'), mp_checkout_step_url('checkout')) . '</div>';
    }

    //gateway plugin message hook
    $content .= apply_filters( 'mp_checkout_payment_confirmation_' . $_SESSION['mp_payment_method'], '', $mp->get_order($_SESSION['mp_order']) );
    
    if (!$mp->global_cart) {
      //tracking information
      $track_link = '<a href="' . mp_orderstatus_link(false, true) . $_SESSION['mp_order'] . '/' . '">' . mp_orderstatus_link(false, true) . $_SESSION['mp_order'] . '/' . '</a>';
      $content .= '<p>' . sprintf(__('You may track the latest status of your order(s) here:<br />%s', 'flexmarket'), $track_link) . '</p>';
    }
    
    //add ecommerce JS
    $mp->create_ga_ecommerce( $mp->get_order($_SESSION['mp_order']) );

    //clear cart session vars
    unset($_SESSION['mp_payment_method']);
    unset($_SESSION['mp_order']);
  }

  if ($echo) {
    echo $content;
  } else {
    return $content;
  }
}

//Prints cart login/register form, for internal use
function _flexmarket_cart_login($echo = false , $btnclass = '') {
  global $mp;
  
  $content = '';
  //don't show if logged in
  if ( is_user_logged_in() || defined('MP_HIDE_LOGIN_OPTION') ) {
    $content .= '<p class="mp_cart_direct_checkout align-right">';
    $content .= '<a class="mp_cart_direct_checkout_link btn btn-large'.$btnclass.'" href="'.mp_checkout_step_url('shipping').'">'.__('Checkout Now &raquo;', 'flexmarket').'</a>';
    $content .= '</p>';
  } else {
    $content .= '<table class="mp_cart_login table table-striped">';
    $content .= '<thead><tr>';
    $content .= '<th class="mp_cart_login">'.__('Have a User Account?', 'flexmarket').'</th>';
    $content .= '<th>&nbsp;</th>';
    if ($mp->get_setting('force_login'))
      $content .= '<th>'.__('Register To Checkout', 'flexmarket').'</th>';
		else
      $content .= '<th>'.__('Checkout Directly', 'flexmarket').'</th>';
    $content .= '</tr></thead>';
    $content .= '<tbody>';
    $content .= '<tr>';
    $content .= '<td class="mp_cart_login">';
    $content .= '<form name="loginform" id="loginform" class="form-inline" action="' . wp_login_url() .'" method="post">';
    $content .= '<label>'.__('Username', 'flexmarket').'<br />';
    $content .= '<input type="text" name="log" id="user_login" class="input" value="" size="20" /></label>';
    $content .= ' ';
    $content .= '<label>'.__('Password', 'flexmarket').'<br />';
    $content .= '<input type="password" name="pwd" id="user_pass" class="input" value="" size="20" /></label>';
    $content .= ' ';
    $content .= '<input type="submit" name="wp-submit" id="mp_login_submit" class=" btn'.$btnclass.'" value="'.__('Login and Checkout &raquo;', 'flexmarket').'" />';
    $content .= '<input type="hidden" name="redirect_to" value="'.mp_checkout_step_url('shipping').'" />';
    $content .= '</form>';
    $content .= '</td>';
    $content .= '<td class="mp_cart_or_label">'.__('or', 'flexmarket').'</td>';
    $content .= '<td class="mp_cart_checkout">';
    if ($mp->get_setting('force_login'))
    	$content .= apply_filters('register', '<a class="mp_cart_direct_checkout_link btn'.$btnclass.'" href="'.site_url('wp-login.php?action=register', 'login').'">'.__('Register Now To Checkout &raquo;', 'flexmarket').'</a>');
		else
      $content .= '<a class="mp_cart_direct_checkout_link btn'.$btnclass.'" href="' . mp_checkout_step_url('shipping') . '">' . __('Checkout Now &raquo;', 'flexmarket') . '</a>';
		$content .= '</td>';
    $content .= '</tr>';
    $content .= '</tbody>';
    $content .= '</table>';
  }
  if ($echo)
    echo  $content;
  else
    return $content;
}

//Prints cart shipping form, for internal use
function _flexmarket_cart_shipping($editable = false, $echo = false , $btnclass = '') {
  global $mp, $current_user;

  $meta = get_user_meta($current_user->ID, 'mp_shipping_info', true);
  //get address
  $email = (!empty($_SESSION['mp_shipping_info']['email'])) ? $_SESSION['mp_shipping_info']['email'] : (isset($meta['email']) ? $meta['email']: $current_user->user_email);
  $name = (!empty($_SESSION['mp_shipping_info']['name'])) ? $_SESSION['mp_shipping_info']['name'] : (isset($meta['name']) ? $meta['name'] : $current_user->user_firstname . ' ' . $current_user->user_lastname);
  $address1 = (!empty($_SESSION['mp_shipping_info']['address1'])) ? $_SESSION['mp_shipping_info']['address1'] : $meta['address1'];
  $address2 = (!empty($_SESSION['mp_shipping_info']['address2'])) ? $_SESSION['mp_shipping_info']['address2'] : $meta['address2'];
  $city = (!empty($_SESSION['mp_shipping_info']['city'])) ? $_SESSION['mp_shipping_info']['city'] : $meta['city'];
  $state = (!empty($_SESSION['mp_shipping_info']['state'])) ? $_SESSION['mp_shipping_info']['state'] : $meta['state'];
  $zip = (!empty($_SESSION['mp_shipping_info']['zip'])) ? $_SESSION['mp_shipping_info']['zip'] : $meta['zip'];
  $country = (!empty($_SESSION['mp_shipping_info']['country'])) ? $_SESSION['mp_shipping_info']['country'] : $meta['country'];
  if (!$country)
    $country = $mp->get_setting('base_country', 'US');
  $phone = (!empty($_SESSION['mp_shipping_info']['phone'])) ? $_SESSION['mp_shipping_info']['phone'] : $meta['phone'];
  $special_instructions = (!empty($_SESSION['mp_shipping_info']['special_instructions'])) ? $_SESSION['mp_shipping_info']['special_instructions'] : '';

  $content = '';

  //don't show if logged in
  if ( !is_user_logged_in() && !defined('MP_HIDE_LOGIN_OPTION') && $editable) {
    $content .= '<p class="mp_cart_login_msg alert alert-info">';
    $content .= '<strong>'.__('Made a purchase here before?', 'mp').'</strong>  <a class="mp_cart_login_link btn btn-mini'.$btnclass.'" href="'.wp_login_url(mp_checkout_step_url('shipping')).'">'.__('Login now', 'mp').'</a> '.__('to retrieve your saved info!', 'mp');
    $content .= '</p>';
  }


  if ($editable) {
    $content .= '<form id="mp_shipping_form" method="post" action="">';

    $content .= apply_filters( 'mp_checkout_before_shipping', '' );

    $content .= '<table class="mp_cart_shipping table table-striped table-bordered table-hover">';
    $content .= '<thead><tr>';
    $content .= '<th colspan="2">'.($mp->download_only_cart($mp->get_cart_contents() && !$mp->global_cart) ? __('Enter Your Checkout Information:', 'mp') : __('Enter Your Shipping Information:', 'mp')).'</th>';
    $content .= '</tr></thead>';
    $content .= '<tbody>';
    $content .= '<tr>';
    $content .= '<td class="span4 align-right" align="right">'.__('Email:', 'mp').'*</td><td>';
    $content .= apply_filters( 'mp_checkout_error_email', '' );
    $content .= '<input size="35" name="email" type="text" value="'.esc_attr($email).'" /></td>';
    $content .= '</tr>';
    
    if ((!$mp->download_only_cart($mp->get_cart_contents()) || $mp->global_cart) && $mp->get_setting('shipping->method') != 'none') {
      $content .= '<tr>';
      $content .= '<td class="span4 align-right" align="right">'. __('Full Name:', 'mp').'*</td><td>';
      $content .= apply_filters( 'mp_checkout_error_name', '' );
      $content .= '<input size="35" name="name" type="text" value="'.esc_attr($name).'" /> </td>';
      $content .= '</tr>';
      $content .= '<tr>';
      $content .= '<td class="span4 align-right" align="right">'.__('Country:', 'mp').'*</td><td>';
      $content .= apply_filters( 'mp_checkout_error_country', '' );
      $content .= '<select id="mp_country" name="country" class="mp_shipping_field">';
      foreach ($mp->get_setting('shipping->allowed_countries', array()) as $code) {
        $content .= '<option value="'.$code.'"'.selected($country, $code, false).'>'.esc_attr($mp->countries[$code]).'</option>';
      }
      $content .= '</select>';
      $content .= '</td>';
      $content .= '</tr>';
      $content .= '<tr>';
      $content .= '<td class="span4 align-right" align="right">'. __('Address:', 'mp').'*</td><td>';
      $content .= apply_filters( 'mp_checkout_error_address1', '' );
      $content .= '<input class="input-xlarge" name="address1" type="text" value="'.esc_attr($address1).'" /><br />';
      $content .= '<small><em>'. __('Street address, P.O. box, company name, c/o', 'mp').'</em></small>';
      $content .= '</td>';
      $content .= '</tr>';
      $content .= '<tr>';
      $content .= '<td class="span4 align-right" align="right">'. __('Address 2:', 'mp').'&nbsp;</td><td>';
      $content .= '<input class="input-xlarge" name="address2" type="text" value="'.esc_attr($address2).'" /><br />';
      $content .= '<small><em>'.__('Apartment, suite, unit, building, floor, etc.', 'mp').'</em></small>';
      $content .= '</td>';
      $content .= '</tr>';
      $content .= '<tr>';
      $content .= '<td class="span4 align-right" align="right">'.__('City:', 'mp').'*</td><td>';
      $content .= apply_filters( 'mp_checkout_error_city', '' );
      $content .= '<input class="input-xlarge mp_shipping_field" id="mp_city" name="city" type="text" value="'.esc_attr($city).'" /></td>';
      $content .= '</tr>';
      $content .= '<tr>';
      $content .= '<td class="span4 align-right" align="right">'.__('State/Province/Region:', 'mp') . (($country == 'US' || $country == 'CA') ? '*' : '') . '</td><td id="mp_province_field">';
      $content .= apply_filters( 'mp_checkout_error_state', '' );
      $content .= mp_province_field($country, $state).'</td>';
      $content .= '</tr>';
      $content .= '<tr>';
      $content .= '<td class="span4 align-right" align="right">'.__('Postal/Zip Code:', 'mp').'*</td><td>';
      $content .= apply_filters( 'mp_checkout_error_zip', '' );
      $content .= '<input size="10" class="mp_shipping_field" id="mp_zip" name="zip" type="text" value="'.esc_attr($zip).'" /></td>';
      $content .= '</tr>';
      $content .= '<tr>';
      $content .= '<td class="span4 align-right" align="right">'.__('Phone Number:', 'mp').'</td><td>';
      $content .= '<input size="20" name="phone" type="text" value="'.esc_attr($phone).'" /></td>';
      $content .= '</tr>';
    }
    
    if ($mp->get_setting('special_instructions')) {
      $content .= '<tr>';
      $content .= '<td class="span4 align-right" align="right">'.__('Special Instructions:', 'mp').'</td><td>';
      $content .= '<textarea name="special_instructions" rows="3" style="width: 98%;">'.esc_textarea($special_instructions).'</textarea></td>';
      $content .= '</tr>';
    }
    
    $content .= apply_filters( 'mp_checkout_shipping_field', '' );

    $content .= '</tbody>';
    $content .= '</table>';
    
    $content .= apply_filters( 'mp_checkout_after_shipping', '' );

    $content .= '<div class="clear padding10"></div>';
    $content .= '<p class="mp_cart_direct_checkout align-right">';
    $content .= '<input type="submit" class="btn btn-large'.$btnclass.'" name="mp_shipping_submit" id="mp_shipping_submit" value="'.__('Continue Checkout &raquo;', 'mp').'" />';
    $content .= '</p>';
    $content .= '</form>';

  } else if (!$mp->download_only_cart($mp->get_cart_contents())) { //is not editable and not download only

    $content .= '<table class="mp_cart_shipping table table-striped table-bordered table-hover">';
    $content .= '<thead><tr>';
    $content .= '<th>'.__('Shipping Information:', 'mp').'</th>';
    $content .= '<th class="align-right" align="right"><a href="'.mp_checkout_step_url('shipping').'">'.__('Edit', 'mp').'</a></th>';
    $content .= '</tr></thead>';
    $content .= '<tbody>';
    $content .= '<tr>';
    $content .= '<td class="span4 align-right" align="right">'.__('Email:', 'mp').'</td><td>';
    $content .= esc_attr($email).' </td>';
    $content .= '</tr>';
    $content .= '<tr>';
    $content .= '<td class="span4 align-right" align="right">'.__('Full Name:', 'mp').'</td><td>';
    $content .= esc_attr($name).'</td>';
    $content .= '</tr>';
    $content .= '<tr>';
    $content .= '<td class="span4 align-right" align="right">'.__('Address:', 'mp').'</td>';
    $content .= '<td>'.esc_attr($address1).'</td>';
    $content .= '</tr>';

    if ($address2) {
      $content .= '<tr>';
      $content .= '<td class="span4 align-right" align="right">'.__('Address 2:', 'mp').'</td>';
      $content .= '<td>'.esc_attr($address2).'</td>';
      $content .= '</tr>';
    }

    $content .= '<tr>';
    $content .= '<td class="span4 align-right" align="right">'.__('City:', 'mp').'</td>';
    $content .= '<td>'.esc_attr($city).'</td>';
    $content .= '</tr>';

    if ($state) {
      $content .= '<tr>';
      $content .= '<td class="span4 align-right" align="right">'.__('State/Province/Region:', 'mp').'</td>';
      $content .= '<td>'.esc_attr($state).'</td>';
      $content .= '</tr>';
    }

    $content .= '<tr>';
    $content .= '<td class="span4 align-right" align="right">'.__('Postal/Zip Code:', 'mp').'</td>';
    $content .= '<td>'.esc_attr($zip).'</td>';
    $content .= '</tr>';

    $content .= '<tr>';
    $content .= '<td class="span4 align-right" align="right">'.__('Country:', 'mp').'</td>';
    $content .= '<td>'.$mp->countries[$country].'</td>';
    $content .= '</tr>';

    if ($phone) {
      $content .= '<tr>';
      $content .= '<td class="span4 align-right" align="right">'.__('Phone Number:', 'mp').'</td>';
      $content .= '<td>'.esc_attr($phone).'</td>';
      $content .= '</tr>';
    }
    
    $content .= apply_filters( 'mp_checkout_shipping_field_readonly', '' );
    
    $content .= '</tbody>';
    $content .= '</table>';
  }

  if ($echo) {
    echo $content;
  } else {
    return $content;
  }
}

/**
 * Echos the order status page. Use in the mp_orderstatus.php template.
 *
 */
function flexmarket_order_status($btnclass = '') {
  global $mp, $wp_query, $blog_id;

	$bid = (is_multisite()) ? $blog_id : 1; // FPM: Used for Custom Field Processing
	
  echo do_shortcode($mp->get_setting('msg->order_status'));

  $order_id = isset($wp_query->query_vars['order_id']) ? $wp_query->query_vars['order_id'] : (isset($_GET['order_id']) ? $_GET['order_id'] : '');

  if (!empty($order_id)) {
    //get order
    $order = $mp->get_order($order_id);

    if ($order) { //valid order
      echo '<h2 class="page-header"><em>' . sprintf( __('Order Details (%s):', 'mp'), htmlentities($order_id)) . '</em></h2>';
      ?>

      <div class="row-fluid">
      	<div class="span6 well well-small well-shadow" style="min-height: 250px;">
	      <h3 class="page-header"><?php _e('Current Status', 'mp'); ?></h3>
	      <ul>
	      <?php
	      //get times
	      $received = isset($order->mp_received_time) ? date_i18n(get_option('date_format') . ' - ' . get_option('time_format'), $order->mp_received_time) : '';
	      if (!empty($order->mp_paid_time))
	        $paid = date_i18n(get_option('date_format') . ' - ' . get_option('time_format'), $order->mp_paid_time);
	      if (!empty($order->mp_shipped_time))
	        $shipped = date_i18n(get_option('date_format') . ' - ' . get_option('time_format'), $order->mp_shipped_time);

	      if ($order->post_status == 'order_received') {
	        echo '<li>' . __('Received:', 'mp') . ' <strong>' . $received . '</strong></li>';
	      } else if ($order->post_status == 'order_paid') {
	        echo '<li>' . __('Paid:', 'mp') . ' <strong>' . $paid . '</strong></li>';
	        echo '<li>' . __('Received:', 'mp') . ' <strong>' . $received . '</strong></li>';
	      } else if ($order->post_status == 'order_shipped' || $order->post_status == 'order_closed') {
	        echo '<li>' . __('Shipped:', 'mp') . ' <strong>' . $shipped . '</strong></li>';
	        echo '<li>' . __('Paid:', 'mp') . ' <strong>' . $paid . '</strong></li>';
	        echo '<li>' . __('Received:', 'mp') . ' <strong>' . $received . '</strong></li>';
	      }

	      $order_paid = $order->post_status != 'order_received';
	      $max_downloads = $mp->get_setting('max_downloads', 5);
	      ?>
	      </ul>

      	</div><!-- / span6 -->

      	<div class="span6 well well-small well-shadow" style="min-height: 250px;">

	      <h3 class="page-header"><?php _e('Payment Information:', 'mp'); ?></h3>
	      <ul>
	        <li>
	          <?php _e('Payment Method:', 'mp'); ?>
	          <strong><?php echo $order->mp_payment_info['gateway_public_name']; ?></strong>
	        </li>
	        <li>
	          <?php _e('Payment Type:', 'mp'); ?>
	          <strong><?php echo $order->mp_payment_info['method']; ?></strong>
	        </li>
	        <li>
	          <?php _e('Transaction ID:', 'mp'); ?>
	          <strong><?php echo $order->mp_payment_info['transaction_id']; ?></strong>
	        </li>
	        <li>
	          <?php _e('Payment Total:', 'mp'); ?>
	          <strong><?php echo $mp->format_currency($order->mp_payment_info['currency'], $order->mp_payment_info['total']) . ' ' . $order->mp_payment_info['currency']; ?></strong>
	        </li>
	      </ul>

      	</div><!-- / span6 -->

      </div><!-- / row-fluid -->

      <div class="clear padding20"></div>

      <h3><?php _e('Order Information:', 'mp'); ?></h3>
      <table id="mp-order-product-table" class="mp_cart_contents table table-striped table-bordered table-hover">
        <thead><tr>
          <th class="mp_cart_col_thumb">&nbsp;</th>
          <th class="mp_cart_col_product"><?php _e('Item', 'mp'); ?></th>
          <th class="mp_cart_col_quant"><?php _e('Quantity', 'mp'); ?></th>
          <th class="mp_cart_col_price"><?php _e('Price', 'mp'); ?></th>
          <th class="mp_cart_col_subtotal"><?php _e('Subtotal', 'mp'); ?></th>
          <th class="mp_cart_col_downloads"><?php _e('Download', 'mp'); ?></th>
        </tr></thead>
        <tbody>
        <?php
          if (is_array($order->mp_cart_info) && count($order->mp_cart_info)) {
						foreach ($order->mp_cart_info as $product_id => $variations) {
							//for compatibility for old orders from MP 1.x
							if (isset($variations['name'])) {
              	$data = $variations;
                echo '<tr>';
	              echo '  <td class="mp_cart_col_thumb">' . mp_product_image( false, 'widget', $product_id ) . '</td>';
	              echo '  <td class="mp_cart_col_product"><a href="' . apply_filters('mp_product_url_display_in_cart', get_permalink($product_id), $product_id) . '">' . apply_filters('mp_product_name_display_in_cart', $data['name'], $product_id) . '</a>' . '</td>'; // Added WPML (This differs than other code)
	              echo '  <td class="mp_cart_col_quant">' . number_format_i18n($data['quantity']) . '</td>';
	              echo '  <td class="mp_cart_col_price">' . $mp->format_currency('', $data['price']) . '</td>';
	              echo '  <td class="mp_cart_col_subtotal">' . $mp->format_currency('', $data['price'] * $data['quantity']) . '</td>';
	              echo '  <td class="mp_cart_col_downloads"></td>';
	              echo '</tr>';
							} else {
								foreach ($variations as $variation => $data) {
		              echo '<tr>';
		              echo '  <td class="mp_cart_col_thumb">' . mp_product_image( false, 'widget', $product_id ) . '</td>';
		              echo '  <td class="mp_cart_col_product"><a href="' . apply_filters('mp_product_url_display_in_cart', get_permalink($product_id), $product_id) . '">' . apply_filters('mp_product_name_display_in_cart', $data['name'], $product_id) . '</a>';
		
                  // Output product custom field information
                  $cf_key = $bid .':'. $product_id .':'. $variation;
                  if (isset($order->mp_shipping_info['mp_custom_fields'][$cf_key])) {
                    $cf_item = $order->mp_shipping_info['mp_custom_fields'][$cf_key];
      
                    $mp_custom_field_label 		= get_post_meta($product_id, 'mp_custom_field_label', true);
                    if (isset($mp_custom_field_label[$variation]))
                      $label_text = $mp_custom_field_label[$variation];
                    else
                      $label_text = __('Product Personalization:', 'mp');
      
                    echo '<div class="mp_cart_custom_fields">'. $label_text .'<br />';
                    foreach($cf_item as $item) {
                      echo (!empty($item) ? '<i class="icon-minus opacity5"></i> ' : ''). $item . '<br/>';
                    }
                    echo '</div>';
                  }
					
		              echo '</td>'; // Added WPML (This differs than other code)
		              echo '  <td class="mp_cart_col_quant">' . number_format_i18n($data['quantity']) . '</td>';
		              echo '  <td class="mp_cart_col_price">' . $mp->format_currency('', $data['price']) . '</td>';
		              echo '  <td class="mp_cart_col_subtotal">' . $mp->format_currency('', $data['price'] * $data['quantity']) . '</td>';
									if (is_array($data['download']) && $download_url = $mp->get_download_url($product_id, $order->post_title)) {
                    if ($order_paid) {
                      //check for too many downloads
											if (intval($data['download']['downloaded']) < $max_downloads)
												echo '  <td class="mp_cart_col_downloads"><a href="' . $download_url . '">' . __('Download&raquo;', 'mp') . '</a></td>';
											else
											  echo '  <td class="mp_cart_col_downloads">' . __('Limit Reached', 'mp') . '</td>';
										} else {
										  echo '  <td class="mp_cart_col_downloads">' . __('Awaiting Payment', 'mp') . '</td>';
										}
									} else {
										echo '  <td class="mp_cart_col_downloads"></td>';
									}
		              echo '</tr>';
								}
							}
            }
          } else {
            echo '<tr><td colspan="6">' . __('No products could be found for this order', 'mp') . '</td></tr>';
          }
          ?>
        </tbody>
      </table>

      <div class="clear padding5"></div>

      <table class="table table-striped table-bordered table-hover">
        <?php //coupon line
        if ( $order->mp_discount_info ) { ?>
          <tr>
          	<td class="align-right span8"><?php _e('Coupon Discount:', 'mp'); ?> </td>
          	<td class="span4"><strong><?php echo $order->mp_discount_info['discount']; ?></strong></td>
          </tr>
        <?php } ?>

        <?php //shipping line
        if ( $order->mp_shipping_total ) { ?>
          <tr>
          	<td class="align-right span8"><?php _e('Shipping:', 'mp'); ?> </td>
          	<td class="span4"><strong><?php echo $mp->format_currency('', $order->mp_shipping_total); ?></strong></td>
          </tr>
        <?php } ?>

        <?php //tax line
        if ( $order->mp_tax_total ) { ?>
           <tr>
          	<td class="align-right span8"><?php _e('Taxes:', 'mp'); ?> </td>
          	<td class="span4"><strong><?php echo $mp->format_currency('', $order->mp_tax_total); ?></strong></td>
          </tr>
        <?php } ?>

          <tr>
          	<td class="align-right span8"><?php _e('Order Total:', 'mp'); ?> </td>
          	<td class="span4"><strong><?php echo $mp->format_currency('', $order->mp_order_total); ?></strong></td>
          </tr>               

      </table>

      <div class="clear padding10"></div>

      <?php if (!defined('MP_HIDE_ORDERSTATUS_SHIPPING')) { ?>
      <h3><?php _e('Shipping Information:', 'mp'); ?></h3>
      <table class="table table-striped table-bordered table-hover">
        <tr>
      	<td class="span4 align-right" align="right"><?php _e('Full Name:', 'mp'); ?></td><td>
        <?php echo esc_attr($order->mp_shipping_info['name']); ?></td>
      	</tr>

      	<tr>
      	<td class="span4 align-right" align="right"><?php _e('Address:', 'mp'); ?></td>
        <td><?php echo esc_attr($order->mp_shipping_info['address1']); ?></td>
      	</tr>

        <?php if ($order->mp_shipping_info['address2']) { ?>
      	<tr>
      	<td class="span4 align-right" align="right"><?php _e('Address 2:', 'mp'); ?></td>
        <td><?php echo esc_attr($order->mp_shipping_info['address2']); ?></td>
      	</tr>
        <?php } ?>

      	<tr>
      	<td class="span4 align-right" align="right"><?php _e('City:', 'mp'); ?></td>
        <td><?php echo esc_attr($order->mp_shipping_info['city']); ?></td>
      	</tr>

      	<?php if ($order->mp_shipping_info['state']) { ?>
      	<tr>
      	<td class="span4 align-right" align="right"><?php _e('State/Province/Region:', 'mp'); ?></td>
        <td><?php echo esc_attr($order->mp_shipping_info['state']); ?></td>
      	</tr>
        <?php } ?>

      	<tr>
      	<td class="span4 align-right" align="right"><?php _e('Postal/Zip Code:', 'mp'); ?></td>
        <td><?php echo esc_attr($order->mp_shipping_info['zip']); ?></td>
      	</tr>

      	<tr>
      	<td class="span4 align-right" align="right"><?php _e('Country:', 'mp'); ?></td>
        <td><?php echo $mp->countries[$order->mp_shipping_info['country']]; ?></td>
      	</tr>

        <?php if ($order->mp_shipping_info['phone']) { ?>
      	<tr>
      	<td class="span4 align-right" align="right"><?php _e('Phone Number:', 'mp'); ?></td>
        <td><?php echo esc_attr($order->mp_shipping_info['phone']); ?></td>
      	</tr>
        <?php } ?>
        
        <?php if (isset($order->mp_shipping_info['tracking_num'])) { ?>
      	<tr>
      	<td class="span4 align-right" align="right"><?php _e('Tracking Number:', 'mp'); ?></td>
        <td><?php echo mp_tracking_link($order->mp_shipping_info['tracking_num'], $order->mp_shipping_info['method']); ?></td>
      	</tr>
        <?php } ?>
      </table>
      <?php } ?>
      
      <?php if (isset($order->mp_order_notes)) { ?>
      <h3><?php _e('Order Notes:', 'mp'); ?></h3>
      <div class="well">
     	 <?php echo wpautop($order->mp_order_notes); ?>
      </div>
      <?php } ?>
      
      <?php do_action('mp_order_status_output', $order); ?>
      
      <a class="btn btn-large<?php echo $btnclass; ?>" href="<?php mp_orderstatus_link(true, true); ?>" ><?php _e('&laquo; Back', 'mp'); ?></a>
      <?php

    } else { //not valid order id
      echo '<h3>' . __('Invalid Order ID. Please try again:', 'mp') . '</h3>';
      ?>
      <form action="<?php mp_orderstatus_link(true, true); ?>" method="get">
    		<label><?php _e('Enter your 12-digit Order ID number:', 'mp'); ?><br />
    		<input type="text" name="order_id" id="order_id" class="input" value="" size="20" /></label>
    		<input type="submit" class="btn<?php echo $btnclass; ?>" id="order-id-submit" value="<?php _e('Look Up &raquo;', 'mp'); ?>" />
      </form>
      <?php
    }

  } else {

    //get from usermeta
    $user_id = get_current_user_id();
    if ($user_id) {
      if (is_multisite()) {
        global $blog_id;
        $meta_id = 'mp_order_history_' . $blog_id;
      } else {
        $meta_id = 'mp_order_history';
      }
      $orders = get_user_meta($user_id, $meta_id, true);
    } else {
      //get from cookie
      if (is_multisite()) {
        global $blog_id;
        $cookie_id = 'mp_order_history_' . $blog_id . '_' . COOKIEHASH;
      } else {
        $cookie_id = 'mp_order_history_' . COOKIEHASH;
      }

      if (isset($_COOKIE[$cookie_id]))
        $orders = unserialize($_COOKIE[$cookie_id]);
    }

    if (is_array($orders) && count($orders)) {
      krsort($orders);
      //list orders
      echo '<h3>' . __('Your Recent Orders:', 'mp') . '</h3>';
      echo '<ul id="mp-order-list">';
      foreach ($orders as $timestamp => $order)
        echo '  <li><strong>' . date_i18n(get_option('date_format') . ' - ' . get_option('time_format'), $timestamp) . ':</strong> <a href="./' . trailingslashit($order['id']) . '">' . $order['id'] . '</a> - ' . $mp->format_currency('', $order['total']) . '</li>';
      echo '</ul>';

      ?>
      <div class="clear padding20"></div>
      <form action="<?php mp_orderstatus_link(true, true); ?>" method="get">
    		<label><?php _e('Or enter your 12-digit Order ID number:', 'mp'); ?><br />
    		<input type="text" name="order_id" id="order_id" class="input" value="" size="20" /></label>
    		<input type="submit" id="order-id-submit" class="btn<?php echo $btnclass; ?>" value="<?php _e('Look Up &raquo;', 'mp'); ?>" />
      </form>
      <?php

    } else {

      if (!is_user_logged_in()) {
        ?>
        <table class="mp_cart_login table table-striped">
          <thead><tr>
            <th class="mp_cart_login" colspan="2"><?php _e('Have a User Account? Login To View Your Order History:', 'mp'); ?>
            </th>
            <th>&nbsp;</th>
          </tr></thead>
          <tbody>
          <tr>
            <td class="mp_cart_login">
            <div class="padding20"></div>
              <form name="loginform" id="loginform" action="<?php echo wp_login_url(); ?>" method="post" class="form-inline">
            		<label><?php _e('Username', 'mp'); ?>
            		<input type="text" name="log" id="user_login" class="input" value="" size="20" /></label> 
            		<label><?php _e('Password', 'mp'); ?>
            		<input type="password" name="pwd" id="user_pass" class="input" value="" size="20" /></label> 
            		<input type="submit" name="wp-submit" class="btn<?php echo $btnclass; ?>" id="mp_login_submit" value="<?php _e('Login &raquo;', 'mp'); ?>" />
            		<input type="hidden" name="redirect_to" value="<?php mp_orderstatus_link(true, true); ?>" />
              </form>
            </td>
          </tr>
          </tbody>
        </table>
            
        <div class="clear padding10"></div>

        <div class="mp_cart_checkout">
          <form action="<?php mp_orderstatus_link(true, true); ?>" method="get">
        		<label><?php _e('Or, Enter your 12-digit Order ID number:', 'mp'); ?><br />
        		<input type="text" name="order_id" id="order_id" class="input" value="" size="20" /></label>
        		<input type="submit" id="order-id-submit" class="btn<?php echo $btnclass; ?>" value="<?php _e('Look Up &raquo;', 'mp'); ?>" />
          </form>
        </div>

        <?php
      } else {
        ?>
        <form action="<?php mp_orderstatus_link(true, true); ?>" method="get">
      		<label><?php _e('Enter your 12-digit Order ID number:', 'mp'); ?><br />
      		<input type="text" name="order_id" id="order_id" class="input" value="" size="20" /></label>
      		<input type="submit" id="order-id-submit" class="btn<?php echo $btnclass; ?>" value="<?php _e('Look Up &raquo;', 'mp'); ?>" />
        </form>
        <?php
      }

    }
  }
}


/**
* This function hook into the shipping filter to add any product custom fields. Checks the cart items
 * If any cart items have associated custom fields then they will be displayed in a new section 'Product extra fields'
 * shown below the shipping form inputs. The custom fields will be one for each quantity. Via the product admin each 
 * custom field can be made required or optional. Standard error handling is provided per Market Press standard processing.
 *
 * @since 2.6.0
 * @see 
 *
 * @param $content - output content passed from caller (_mp_cart_shipping)
 * @return $content - Revised content with added information
 */

function flexmarket_custom_fields_checkout_after_shipping($content='') {
	global $mp, $blog_id, $current_user;
	
	if (isset($_SESSION['mp_shipping_info']['mp_custom_fields'])) {
		$mp_custom_fields = $_SESSION['mp_shipping_info']['mp_custom_fields'];
	} else {
		$mp_custom_fields = array();
	}
  
	$blog_id = (is_multisite()) ? $blog_id : 1;
	
	$current_blog_id = $blog_id;

	$global_cart = $mp->get_cart_contents(true);
	if (!$mp->global_cart)  //get subset if needed
		$selected_cart[$blog_id] = $global_cart[$blog_id];
	else
    $selected_cart = $global_cart;
  
	$content_product = '';
	
  foreach ($selected_cart as $bid => $cart) {

		if (is_multisite())
			switch_to_blog($bid);

      foreach ($cart as $product_id => $variations) {
	
        // Load the meta info for the custom fields for this product
        $mp_has_custom_field = get_post_meta($product_id, 'mp_has_custom_field', true);
        $mp_custom_field_required = get_post_meta($product_id, 'mp_custom_field_required', true);
        $mp_custom_field_per = get_post_meta($product_id, 'mp_custom_field_per', true);
        $mp_custom_field_label = get_post_meta($product_id, 'mp_custom_field_label', true);
    
        foreach ($variations as $variation => $data) {
		
          if (isset($mp_has_custom_field[$variation]) && $mp_has_custom_field[$variation]) {
  
            if (!empty($mp_custom_field_label[$variation]))
              $label_text = esc_attr($mp_custom_field_label[$variation]);
            else
              $label_text = "";
            
            if (isset($mp_custom_field_required[$variation]) && $mp_custom_field_required[$variation])
              $required_text = __('required', 'mp');
            else
              $required_text = __('optional', 'mp');									
              
            $content_product .= '<tr class="mp_product_name"><td align="right" colspan="2">';
            $content_product .= apply_filters( 'mp_checkout_error_custom_fields_'. $product_id .'_'. $variation, '' );
            $content_product .= $data['name'];
            $content_product .= '</td></tr>';
            $content_product .= '<tr class="mp_product_custom_fields">';
            $content_product .= '<td>';
            $content_product .= $label_text .' ('. $required_text .')<br />';
            //$content_product .=  '</td></tr>';
            //$content_product .= '<tr><td>';
            
            // If the mp_custom_field_per is set to 'line' we only show one input field per item in the cart. 
            // This input field will be a simply unordered list (<ul>). However, if the mp_custom_field_per
            // Then we need to show an input field per the quantity items. In this case we use an ordered list
            // to show the numbers to the user. 0-based.
            if ($mp_custom_field_per[$variation] == "line") {
              //$content_product .= '<ul>';
              $cf_limit = 1;
              
            } else if ($mp_custom_field_per[$variation] == "quantity") {
              //$content_product .= '<ol>';
              $cf_limit = $data['quantity'];
            }
            
            $output_cnt = 0;
            while($output_cnt < $cf_limit) {
  
              $cf_key = $bid .':'. $product_id .':'. $variation;
              if (isset($mp_custom_fields[$cf_key][$output_cnt])) 
                $output_value = $mp_custom_fields[$cf_key][$output_cnt];
              else
                $output_value = '';
                
              $content_product .= '<input type="text" style="width: 90%;" value="'. $output_value .'" name="mp_custom_fields[' . $bid . ':' . $product_id . ':' . $variation . ']['. $output_cnt .']" />';
              $output_cnt += 1;
            }
            /*
            if ($mp_custom_field_per[$variation] == "line")
              $content_product .= '<ul>';
            else if ($mp_custom_field_per[$variation] == "quantity")
              $content_product .= '<ol>';
            */
            $content_product .=  '</td>';
            $content_product .=  '</tr>';
          }
        }
      }

	    //go back to original blog
	    if (is_multisite())
	      switch_to_blog($current_blog_id);
	}
	
	if (strlen($content_product)) {
		
	    $content .= '<table class="mp_product_shipping_custom_fields table table-bordered table-striped">';
	    $content .= '<thead><tr><th colspan="2">'. __('Product Personalization:', 'mp') .'</th></tr></thead>';
	    $content .= '<tbody>';
	    $content .= $content_product;
	    $content .= '</tbody>';
	    $content .= '</table>';		
	}
	return $content;
}

remove_filter('mp_checkout_after_shipping', 'mp_custom_fields_checkout_after_shipping' , 10);
add_filter('mp_checkout_after_shipping', 'flexmarket_custom_fields_checkout_after_shipping' , 11);