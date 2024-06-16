<?php
/** بسم الله الرحمن الرحيم **
 *
 * Plugin Name: Aqua Page Builder
 * Plugin URI: http://aquagraphite.com/page-builder
 * Description: Easily create custom page templates with drag-and-drop interface.
 * Version: 1.0.4
 * Author: Syamil MJ
 * Author URI: http://aquagraphite.com
 * License: GPLV3
 *
 * @package   Aqua Page Builder
 * @author    Syamil MJ <http://aquagraphite.com>
 * @copyright Copyright (c) 2012, Syamil MJ
 * @license   http://www.gnu.org/copyleft/gpl.html
 *
 * @todo      - Preview template
 			  - Inactive blocks (for staging)
 			  - TinyMCE integration
 */

$themefolder = get_template_directory_uri();
$themepath = get_template_directory();

//definitions
if(!defined('AQPB_VERSION')) define( 'AQPB_VERSION', '1.0.4' );
if(!defined('AQPB_PATH')) define( 'AQPB_PATH', $themepath . '/functions/aqua-page-builder/' );
if(!defined('AQPB_DIR')) define( 'AQPB_DIR', $themefolder.'/functions/aqua-page-builder/' );
if(!defined('AQPB_DIRNAME')) define( 'AQPB_DIRNAME', basename(dirname(__FILE__)) );
if(!defined('AQPB_FILENAME')) define( 'AQPB_FILENAME', basename(__FILE__));

//required functions & classes
require_once($themepath . '/functions/aqua-page-builder/functions/aqpb_config.php');
require_once($themepath . '/functions/aqua-page-builder/functions/aqpb_blocks.php');
require_once($themepath . '/functions/aqua-page-builder/classes/class-aq-page-builder.php');
require_once($themepath . '/functions/aqua-page-builder/classes/class-aq-block.php');
require_once($themepath . '/functions/aqua-page-builder/functions/aqpb_functions.php');

//some default blocks
require_once($themepath . '/functions/aqua-page-builder/blocks/aq-text-block.php');
require_once($themepath . '/functions/aqua-page-builder/blocks/aq-column-block.php');
require_once($themepath . '/functions/aqua-page-builder/blocks/aq-widgets-block.php');
require_once($themepath . '/functions/aqua-page-builder/blocks/aq-alert-block.php');

//custom blocks
require_once($themepath . '/functions/aqua-page-builder/blocks/aq-separator-block.php');
require_once($themepath . '/functions/aqua-page-builder/blocks/aq-tabs-block.php');
require_once($themepath . '/functions/aqua-page-builder/blocks/aq-button-block.php');
require_once($themepath . '/functions/aqua-page-builder/blocks/aq-table-block.php');
require_once($themepath . '/functions/aqua-page-builder/blocks/aq-heading-block.php');
require_once($themepath . '/functions/aqua-page-builder/blocks/aq-well-block.php');
require_once($themepath . '/functions/aqua-page-builder/blocks/aq-blog-block.php');
require_once($themepath . '/functions/aqua-page-builder/blocks/aq-features-block.php');
require_once($themepath . '/functions/aqua-page-builder/blocks/aq-image-block.php');
require_once($themepath . '/functions/aqua-page-builder/blocks/aq-staff-block.php');
require_once($themepath . '/functions/aqua-page-builder/blocks/aq-list-block.php');
require_once($themepath . '/functions/aqua-page-builder/blocks/aq-video-block.php');
require_once($themepath . '/functions/aqua-page-builder/blocks/aq-map-block.php');
require_once($themepath . '/functions/aqua-page-builder/blocks/aq-pricing-block.php');
require_once($themepath . '/functions/aqua-page-builder/blocks/aq-contact-block.php');
require_once($themepath . '/functions/aqua-page-builder/blocks/aq-shortcode-block.php');
require_once($themepath . '/functions/aqua-page-builder/blocks/aq-cta-block.php');
require_once($themepath . '/functions/aqua-page-builder/blocks/aq-testimonials-block.php');
require_once($themepath . '/functions/aqua-page-builder/blocks/aq-slider-block.php');
require_once($themepath . '/functions/aqua-page-builder/blocks/aq-progress-block.php');
require_once($themepath . '/functions/aqua-page-builder/blocks/aq-mpproductgrid-block.php');
require_once($themepath . '/functions/aqua-page-builder/blocks/aq-mpproductcarousel-block.php');
require_once($themepath . '/functions/aqua-page-builder/blocks/aq-mpcart-block.php');

//register blocks
aq_register_block('AQ_Text_Block');
aq_register_block('AQ_Heading_Block');
aq_register_block('AQ_Separator_Block');
aq_register_block('AQ_Button_Block');
aq_register_block('AQ_Image_Block');
aq_register_block('AQ_Video_Block');
aq_register_block('AQ_Column_Block');
aq_register_block('AQ_Well_Block');
aq_register_block('AQ_List_Block');
aq_register_block('AQ_Table_Block');
aq_register_block('AQ_CTA_Block');
aq_register_block('AQ_Alert_Block');
aq_register_block('AQ_Tabs_Block');
aq_register_block('AQ_Progress_Block');
aq_register_block('AQ_Features_Block');
aq_register_block('AQ_Staff_Block');
aq_register_block('AQ_Pricing_Block');
aq_register_block('AQ_Blog_Updates_Block');
aq_register_block('AQ_Map_Block');
aq_register_block('AQ_Contact_Block');
aq_register_block('AQ_Testimonials_Block');
aq_register_block('AQ_Slider_Block');
aq_register_block('AQ_Widgets_Block');
aq_register_block('AQ_Shortcode_Block');

if ( class_exists( 'MarketPress' ) ) {
	aq_register_block('AQ_MP_Product_Grid_Block');
	aq_register_block('AQ_MP_Product_Carousel_Block');
	aq_register_block('AQ_MPcart_Block');
}

// Fire up page builder
$aqpb_config = aq_page_builder_config();
$aq_page_builder = new AQ_Page_Builder($aqpb_config);
if (!is_network_admin()) $aq_page_builder->init();